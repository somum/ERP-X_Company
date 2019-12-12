<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index");
  exit;
}
require_once 'config.php';

$email=$_SESSION["email"];

if(isset($_POST['invoice_id'])){
  $invoice_id = $_POST["invoice_id"];
}
else
  {$invoice_id = $_SESSION["invoice_id"];}

$sql = "SELECT * FROM invoice_details WHERE invoice_id='$invoice_id';";
$result = mysqli_query($conn,$sql);

while( $row = mysqli_fetch_assoc($result)){

  $companyRef = $row['companyRef'];
  $cname = $row['cname'];
  $idate=$row['idate'];
  $individualName = $row['individualName'];
  $sector = $row['sector'];
  $airline=$row['airline'];
  $class = $row['class'];
  $ticketNo = $row['ticketNo'];
  $adultFare=$row['adultFare'];
  $adultQty=$row['adultQty'];
  $childFare = $row['childFare'];
  $childQty = $row['childQty'];
  $infantFare=$row['infantFare'];
  $infantQty=$row['infantQty'];
  $cPercentage = $row['cPercentage'];
  $cTk = $row['cTk'];
  $eAdultFare=$row['eAdultFare'];
  $eAdultQty=$row['eAdultQty'];
  $eChildFare = $row['eChildFare'];
  $eChildQty = $row['eChildQty'];
  $eInfantFare=$row['eInfantFare'];
  $eInfantQty=$row['eInfantQty'];
  $tAdultFare=$row['tAdultFare'];
  $tAdultQty=$row['tAdultQty'];
  $tChildFare = $row['tChildFare'];
  $tChildQty = $row['tChildQty'];
  $tInfantFare=$row['tInfantFare'];
  $tInfantQty=$row['tInfantQty'];

  $oAdultFare=$row['oAdultFare'];
  $oAdultQty=$row['oAdultQty'];
  $oChildFare = $row['oChildFare'];
  $oChildQty = $row['oChildQty'];
  $oInfantFare=$row['oInfantFare'];
  $oInfantQty=$row['oInfantQty'];



  $otherPurpose1=$row['otherPurpose1'];
  $otherPurpose2=$row['otherPurpose2'];
  $otherPurpose3=$row['otherPurpose3'];
  $otherPurpose4=$row['otherPurpose4'];
  $otherPurpose5=$row['otherPurpose5'];
  $otherPurpose6=$row['otherPurpose6'];



  $otherExpense1=$row['otherExpense1'];
  $otherExpense2=$row['otherExpense2'];
  $otherExpense3=$row['otherExpense3'];
  $otherExpense4=$row['otherExpense4'];
  $otherExpense5=$row['otherExpense5'];
  $otherExpense6=$row['otherExpense6'];

  $otherQty1=$row['otherQty1'];
  $otherQty2=$row['otherQty2'];
  $otherQty3=$row['otherQty3'];
  $otherQty4=$row['otherQty4'];
  $otherQty5=$row['otherQty5'];
  $otherQty6=$row['otherQty6'];



  $pAmount = $row['pAmount'];
  $pDate = $row['pDate'];
  $c_address = $row['c_address'];

  $bank_details = $row['bank_details'];


  $location = $row['location'];

  $pTotal = $sTotal = $oTotal = $cTotal = $total = $tTotal= $eTotal= $pTotal1 = $pTotal2 = $pTotal3 =$pTotal4 = $pTotal5 = $pTotal6= 0;
}
mysqli_close($conn);

?>

<?php 
function numberTowords($num)
{
  $ones = array(
    0 =>"Zero",
    1 => "One",
    2 => "Two",
    3 => "Three",
    4 => "Four",
    5 => "Five",
    6 => "Six",
    7 => "Seven",
    8 => "Eight",
    9 => "Nine",
    10 => "Ten",
    11 => "Eleven",
    12 => "Twelve",
    13 => "Thirteen",
    14 => "Fourteen",
    15 => "Fifteen",
    16 => "Sixteen",
    17 => "Seventeen",
    18 => "Eighteen",
    19 => "Nineteen",
    "014" => "Fourteen"
  );
  $tens = array( 
    0 => "Zero",
    1 => "Ten",
    2 => "Twenty",
    3 => "Thirty", 
    4 => "Forty", 
    5 => "Fifty", 
    6 => "Sixty", 
    7 => "Seventy", 
    8 => "Eighty", 
    9 => "Ninety" 
  ); 
  $hundreds = array( 
    "Hundred", 
    "Thousand", 
    "Million", 
    "Billion", 
    "Trillion",
    "Quardrillion" 
  ); /*limit t quadrillion */
  $num = number_format($num,2,".",","); 
  $num_arr = explode(".",$num); 
  $wholenum = $num_arr[0]; 
  $decnum = $num_arr[1]; 
  $whole_arr = array_reverse(explode(",",$wholenum)); 
  krsort($whole_arr,1); 
  $rettxt = ""; 
  foreach($whole_arr as $key => $i){

    while(substr($i,0,1)=="0")
      $i=substr($i,1,5);
    if($i < 20){ 
      /* echo "getting:".$i; */
      $rettxt .= $ones[$i]; 
    }elseif($i < 100){ 
      if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
      if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
    }else{ 
      if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
      if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
      if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
      $rettxt .= " ".$hundreds[$key]." "; 
    }
  } 
  if($decnum > 0){
    $rettxt .= " and ";
    if($decnum < 20){
      $rettxt .= $ones[$decnum];
    }elseif($decnum < 100){
      $rettxt .= $tens[substr($decnum,0,1)];
      $rettxt .= " ".$ones[substr($decnum,1,1)];
    }
  }
  return $rettxt;
}


?>


<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    SAir Air BD LTD.
  </title>

  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <link href="./css/invoiceCss.css" rel="stylesheet" id="bootstrap-css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
</head>

<body>

<div class="row" style="margin-top: 10px;">
   <input type="button" style="margin-left: 20px;" value="Back to home" class="btn btn-success" id="btnHome" onClick="document.location.href='./dashboard.php'" />
    <form onsubmit="return deleteAlert();" action="deleteInvoiceScript.php" method="POST" style="margin-left: 10px;">
      <button id="delete_invoice" name="delete_invoice" class="btn btn-danger" onclick="deleteAlert()" value="<?php echo $invoice_id ?>"><i class="fa fa-file-pdf-o"></i>Delete</button>
    </form>
    <form method="POST" action="updateInvoice.php" style="margin-left: 10px;">
      <div class="text-right">
        <button id="printInvoice" class="btn btn-info" onclick= "javascript:printDiv('invoice')"><i class="fa fa-print"  ></i> Print</button>

        <button id="printInvoice" class="btn btn-info" onclick= "javascript:printDiv('invoicePad')"><i class="fa fa-print"  ></i> Pad Print</button>
       
        <button id="edit" name="edit" class="btn btn-warning" value="<?php echo $invoice_id ?>"><i class="fa fa-file-pdf-o"></i>Edit</button>
        <button id="docInvoice" class="btn btn-info" onclick= "javascript:exportHTML()"><i class="fa fa-print"  ></i> Doc</button>
      </div>
    </form>
   
    <hr>
</div>

  <div id="invoice" style="font-size: 18px;">
    <div class="invoice overflow-auto">
      <div style="min-width: 600px;">
        <header>
          <div class="row">
            <div class="col">
              
            </div>
            <div class="col company-details">
              <a target="_blank" href="https://sairbd.com/">
                  <?php if($companyRef=="SKYLIGHT CORPORATION LTD."){?>
                <img src="./images/icons/Skylight.png" data-holder-rendered="true" />
            <?php }elseif ($companyRef=="SAIR AIR BD LTD.") { ?>
                <img src="./images/icons/sair.png" data-holder-rendered="true" />
            <?php } ?>
              </a>
              <div><?php if($companyRef=="SKYLIGHT CORPORATION LTD."){
                  echo "www.skylight.com.bd"; }
                  elseif($companyRef=="SAIR AIR BD LTD."){
                      echo "www.sairbd.com";
                      }?></div>
            </div>
          </div>
        </header>
        <main>
          <div class="row contacts">
            <div class="col invoice-to">
              <div class="text-gray-light">To,</div>
              <h5 class="to" style="padding-left: 30px;"><?php echo $cname ?></h5>
              <h6 style="padding-left: 30px;"><?php echo nl2br($c_address) ?></h6>
            </div>

            <div class="col invoice-details">
              <h4 class="invoice-id" style="margin-bottom: 0px;">Invoice # <?php echo $invoice_id ?></h4>
              <div class="date">Date: <?php echo $idate ?></div>
              <!--<div class="date">Due Date: <?php echo $pDate ?></div>-->
            </div>
          </div>

          <hr style="margin-bottom: 5px;">
          <h5><b>Name/s: </b></h5>
          <div style="font-size: 18px; margin-bottom: 20px; padding-left: 30px;">  <?php echo nl2br($individualName) ?>  </div>




          <div style="font-size: 18px">
            <b>Sector: </b><?php echo $sector ?> <br>

            <b>Airline: </b><?php echo $airline ?> <br>

            <b>Class: </b><?php echo $class ?> <br>

            <b>Ticket no: </b><?php echo $ticketNo ?> <br>

          </div>

          <hr style="margin-bottom:5px;">
          <div style="width: 100%">
           <h5 style="margin-bottom:0px;font-size: 18px"><b>Fare:</b></h5>
           <table align="right" class="tg" style="table-layout: fixed; width: 468px">
            <colgroup>
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 200px">
            </colgroup>
            <tr>
              <?php if($adultQty >0){ ?>
              <th class="tg-b0es">Adult</th>
              <th class="tg-b0es">Qty</th><?php } else{?>
              <th class="tg-b0es"></th>
              <th class="tg-b0es"></th> <?php } ?>
              <?php if($childQty >0){ ?>
              <th class="tg-b0es" >Child</th>
              <th class="tg-b0es">Qty</th><?php } else{?>
              <th class="tg-b0es"></th>
              <th class="tg-b0es"></th> <?php } ?>
              <?php if($infantQty >0) { ?> 
              <th class="tg-b0es">Infant</th>
              <th class="tg-b0es">Qty</th><?php } else{?>
              <th class="tg-b0es"></th>
              <th class="tg-b0es"></th> <?php } ?>
              <th class="tg-ref9">Sub Total</th>
            </tr>
            <tr>
              <td class="tg-wk8r"><?php echo $adultFare ?></td>
              <td class="tg-wk8r"><?php echo $adultQty ?></td>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $childFare ?></td>
              <td class="tg-wk8r"><?php echo $childQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $infantFare ?></td>
              <td class="tg-wk8r"><?php echo $infantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              
              <td class="tg-c1kk"> <?php echo number_format($total=$adultFare* $adultQty + $childFare* $childQty + $infantFare*$infantQty,2); ?></td>
            </tr>
          </table>
        </div>
        <!---testblabla-->
        <div style="margin-top: 90px;">
        <?php if($cPercentage>0 || $cTk >0 ){ ?>
    
        
          <div class="row">

          <div class="col-5">
          <b>Commercial Adjustment: </b>
          </div>
          <div class="col-5" style="padding-left: 45px;">
             <?php if($cPercentage>0) echo $cPercentage.'%' ?> 
                <?php if($cTk >0) echo $cTk ?>
              </div>
              <div class="col-2 text-right">
              	<?php if($cPercentage>0){?>
              		<?php echo number_format($cTotal=($cPercentage*$total)/100,2); }?>
              	<?php if($cTk >0){?>
              		<?php echo number_format( $cTotal=$cTk,2); }?>
           </div>       
          </div>        

        
<?php } ?>
      </div>

      
        <!--testblablabla-->
        




        <?php 
          if($eChildQty > 0 || $eAdultQty >0 || $eInfantQty> 0 || $oChildQty > 0 || $oAdultQty >0 || $oInfantQty> 0 || $tChildQty > 0 || $tAdultQty >0 || $tInfantQty> 0){ ?>
    
        <div style="width: 100%; margin-top: 10px;">
          <h5  style="margin-bottom:0px;font-size: 18px"><b>Tax: </b></h5>
          <?php $tcount=1;?>
          <table align="right" class="tg" style="table-layout: fixed; width: 569px">
            <colgroup>
              <col style="width: 350px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 200px">
            </colgroup>
            <?php if($eAdultQty > 0 || $eChildQty>0 || $eInfantQty>0){ ?>
            <tr>
              <td class="tg-3m6e">Govt. Tax</td>
              <?php if($adultQty >0) { ?>
              <td class="tg-wk8r"><?php echo $eAdultFare ?></td>
              <td class="tg-wk8r"><?php echo $eAdultQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $eChildFare ?></td>
              <td class="tg-wk8r"><?php echo $eChildQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $eInfantFare ?></td>
              <td class="tg-wk8r"><?php echo $eInfantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              <td class="tg-c1kk"> <?php echo number_format( $eTotal=$eAdultFare* $eAdultQty + $eChildFare* $eChildQty + $eInfantFare*$eInfantQty,2); ?></td>
            </tr> <?php } ?>

            <?php if($tAdultQty > 0 || $tChildQty>0 || $tInfantQty>0){ ?>
            <tr>
              <td class="tg-3m6e">Travel</td>
              <?php if($adultQty >0) { ?>
              <td class="tg-wk8r"><?php echo $tAdultFare ?></td>
              <td class="tg-wk8r"><?php echo $tAdultQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $tChildFare ?></td>
              <td class="tg-wk8r"><?php echo $tChildQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $tInfantFare ?></td>
              <td class="tg-wk8r"><?php echo $tInfantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              <td class="tg-c1kk"> <?php echo number_format( $tTotal= $tAdultFare* $tAdultQty + $tChildFare* $tChildQty + $tInfantFare*$tInfantQty,2); ?></td>
            </tr> <?php } ?>

            <?php if($oAdultQty > 0 || $oChildQty>0 || $oInfantQty>0){ ?>
            <tr>
              <td class="tg-3m6e">Others</td>
              <?php if($adultQty >0) { ?>
              <td class="tg-wk8r"><?php echo $oAdultFare ?></td>
              <td class="tg-wk8r"><?php echo $oAdultQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $oChildFare ?></td>
              <td class="tg-wk8r"><?php echo $oChildQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $oInfantFare ?></td>
              <td class="tg-wk8r"><?php echo $oInfantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              <td class="tg-c1kk"> <?php echo number_format( $oTotal=$oAdultFare* $oAdultQty + $oChildFare* $oChildQty + $oInfantFare*$oInfantQty,2); ?></td>
            </tr> <?php } ?>



            

          </table>
        </div>
<?php } ?>


        <?php 
          if($otherPurpose1 !="" || $otherPurpose2 !="" || $otherPurpose3 !="" || $otherPurpose4 !="" || $otherPurpose5 !="" || $otherPurpose6 !=""){ ?>
        <?php if($eTotal !=0 || $tTotal !=0 || $oTotal !=0)
          echo '<div style="width: 100%; margin-top: 100px;">';
          else
            echo '<div style="width: 100%; margin-top: 10px;">'; ?>
          <h5  style="margin-bottom:0px; font-size: 18px"><b>Others: </b></h5>
          <?php $ocount=1;?>
          <table align="right" class="tg" style="table-layout: fixed; width: 569px">
            <colgroup>
              <col style="width: 350px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 200px">
            </colgroup>
            <tr>
              <td class="tg-3m6e"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"></td>
            </tr>
            <?php if($otherPurpose1 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose1 ?></td>
              <td class="tg-wk8r"><?php if($otherQty1>0) echo $otherExpense1 ?></td>
              <td class="tg-wk8r"><?php if($otherQty1>0) echo $otherQty1 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty1>0) echo number_format( $pTotal1=$otherExpense1* $otherQty1,2); ?></td>
            </tr> <?php } ?>
               
 

          <?php if($otherPurpose2 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose2 ?></td>
              <td class="tg-wk8r"><?php if($otherQty2>0) echo $otherExpense2 ?></td>
              <td class="tg-wk8r"><?php if($otherQty2>0) echo $otherQty2 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty2>0) echo number_format( $pTotal2=$otherExpense2* $otherQty2,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose3 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose3 ?></td>
              <td class="tg-wk8r"><?php if($otherQty3>0) echo $otherExpense3 ?></td>
              <td class="tg-wk8r"><?php if($otherQty3>0) echo $otherQty3 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty3>0) echo number_format( $pTotal3=$otherExpense3* $otherQty3,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose4 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose4 ?></td>
              <td class="tg-wk8r"><?php if($otherQty4>0) echo $otherExpense4 ?></td>
              <td class="tg-wk8r"><?php if($otherQty4>0) echo $otherQty4 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty4>0) echo number_format( $pTotal4=$otherExpense4* $otherQty4,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose5 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose5 ?></td>
              <td class="tg-wk8r"><?php if($otherQty5>0) echo $otherExpense5 ?></td>
              <td class="tg-wk8r"><?php if($otherQty5>0) echo $otherQty5 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty5>0) echo number_format( $pTotal5=$otherExpense5* $otherQty5,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose6 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose6 ?></td>
              <td class="tg-wk8r"><?php if($otherQty6>0) echo $otherExpense6 ?></td>
              <td class="tg-wk8r"><?php if($otherQty6>0) echo $otherQty6 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty6>0) echo number_format( $pTotal6=$otherExpense6* $otherQty6,2); ?></td>
            </tr> <?php } ?>



          </table>
        </div>
<?php } ?>
      
      <?php if($bank_details != ""){

      echo '<h5  style="margin-bottom:0px;margin-top:170px;font-size: 18px"><b>Bank Details: </b></h5>';
      echo '<div style="padding-left: 30px;">';
      echo nl2br($bank_details); 
      echo '</div>'; } ?>

      </main>

      <?php $pTotal = $pTotal1+$pTotal2+$pTotal3+$pTotal4+$pTotal5+$pTotal6; ?>

      <footer  style="max-width: 1024px">
          <div style="text-align: right; margin-bottom: 70px; font-size: 20px">
                 <div style="text-align: right; margin-bottom: 40px; font-size: 20px">
      <hr style="border: .1px solid white;margin-bottom: 0px;">

      <table align="right" class="tg" style="undefined;table-layout: fixed; width: 382px;">
      <colgroup>
      <col style="width: 200px">
      <col style="width: 100px">
      </colgroup>
         <?php if($pAmount>0 ){ ?>
        <tr>
          <td class="tg-3m6e" style="font-weight:bold;">Paid Amount</td>
          <td class="tg-c1kk">
            <?php if($pAmount >0){?>
              <?php echo '- '.number_format($pAmount,2); }
              ?></td>
        </tr>
        <?php } ?>
      </table>
      </div>
      <hr style="border: 1px solid #5F5F5F;margin-bottom: 0px;">

      <table align="right" class="tg" style="undefined;table-layout: fixed; width: 382px;">
      <colgroup>
      <col style="width: 200px">
      <col style="width: 100px">
      </colgroup>
        <tr>
          <th class="tg-3m6e" style="font-weight:bold;">Total</th>
          <th class="tg-c1kk"><?php  $sTotal=(($pTotal+$total+$eTotal+$tTotal+$oTotal)-$cTotal); echo number_format( $t=round(($sTotal-$pAmount)),2);?></th>
        </tr>
      </table>
        <div style="padding-right: 420px;">
          <p align='left'style="float: left;width: 200px;font-weight:bold;">Total Amount (In Words):</p>
          <?php

          echo "<p align='left' style='color:black; padding-right: 20px;'>".numberTowords("$t")." Taka Only</p>"
          ?>
        </div>
      </div>


        <div align="left">
        <hr style="max-width: 200px; border: 1px solid #5F5F5F;" align="left">
      Prepared By</div>

        <b>Office Address: </b> <?php echo nl2br($location); ?>
      </footer>
    </div>
    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
    <div></div>
  </div>
</div>

<!----pad-->

  <div id="invoicePad" style="font-size: 18px;" hidden>
    <div class="invoice overflow-auto">
      <div style="min-width: 600px; margin-top: 130px;">
    
        <main>
          <div class="row contacts">
            <div class="col invoice-to">
              <div class="text-gray-light">To,</div>
              <h5 class="to" style="padding-left: 30px;"><?php echo $cname ?></h5>
              <h6 style="padding-left: 30px;"><?php echo nl2br($c_address) ?></h6>
            </div>

            <div class="col invoice-details">
              <h4 class="invoice-id" style="margin-bottom: 0px;">Invoice # <?php echo $invoice_id ?></h4>
              <div class="date">Date: <?php echo $idate ?></div>
              <!--<div class="date">Due Date: <?php echo $pDate ?></div>-->
            </div>
          </div>

          <hr style="margin-bottom: 5px;">
          <h5><b>Name/s: </b></h5>
          <div style="font-size: 18px; margin-bottom: 20px; padding-left: 30px;">  <?php echo nl2br($individualName) ?>  </div>




          <div style="font-size: 18px">
            <b>Sector: </b><?php echo $sector ?> <br>

            <b>Airline: </b><?php echo $airline ?> <br>

            <b>Class: </b><?php echo $class ?> <br>

            <b>Ticket no: </b><?php echo $ticketNo ?> <br>

          </div>

          <hr style="margin-bottom:5px;">
          <div style="width: 100%">
           <h5 style="margin-bottom:0px;font-size: 18px"><b>Fare:</b></h5>
           <table align="right" class="tg" style="table-layout: fixed; width: 468px">
            <colgroup>
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 200px">
            </colgroup>
            <tr>
              <?php if($adultQty >0){ ?>
              <th class="tg-b0es">Adult</th>
              <th class="tg-b0es">Qty</th><?php } else{?>
              <th class="tg-b0es"></th>
              <th class="tg-b0es"></th> <?php } ?>
              <?php if($childQty >0){ ?>
              <th class="tg-b0es" >Child</th>
              <th class="tg-b0es">Qty</th><?php } else{?>
              <th class="tg-b0es"></th>
              <th class="tg-b0es"></th> <?php } ?>
              <?php if($infantQty >0) { ?> 
              <th class="tg-b0es">Infant</th>
              <th class="tg-b0es">Qty</th><?php } else{?>
              <th class="tg-b0es"></th>
              <th class="tg-b0es"></th> <?php } ?>
              <th class="tg-ref9">Sub Total</th>
            </tr>
            <tr>
              <td class="tg-wk8r"><?php echo $adultFare ?></td>
              <td class="tg-wk8r"><?php echo $adultQty ?></td>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $childFare ?></td>
              <td class="tg-wk8r"><?php echo $childQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $infantFare ?></td>
              <td class="tg-wk8r"><?php echo $infantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              
              <td class="tg-c1kk"> <?php echo number_format($total=$adultFare* $adultQty + $childFare* $childQty + $infantFare*$infantQty,2); ?></td>
            </tr>
          </table>
        </div>
        <!---testblabla-->
        <div style="margin-top: 90px;">
        <?php if($cPercentage>0 || $cTk >0 ){ ?>
    
        
          <div class="row">

          <div class="col-5">
          <b>Commercial Adjustment: </b>
          </div>
          <div class="col-5" style="padding-left: 45px;">
             <?php if($cPercentage>0) echo $cPercentage.'%' ?> 
                <?php if($cTk >0) echo $cTk ?>
              </div>
              <div class="col-2 text-right">
                <?php if($cPercentage>0){?>
                  <?php echo number_format($cTotal=($cPercentage*$total)/100,2); }?>
                <?php if($cTk >0){?>
                  <?php echo number_format( $cTotal=$cTk,2); }?>
           </div>       
          </div>        

        
<?php } ?>
      </div>

      
        <!--testblablabla-->
        




        <?php 
          if($eChildQty > 0 || $eAdultQty >0 || $eInfantQty> 0 || $oChildQty > 0 || $oAdultQty >0 || $oInfantQty> 0 || $tChildQty > 0 || $tAdultQty >0 || $tInfantQty> 0){ ?>
    
        <div style="width: 100%; margin-top: 10px;">
          <h5  style="margin-bottom:0px;font-size: 18px"><b>Tax: </b></h5>
          <?php $tcount=1;?>
          <table align="right" class="tg" style="table-layout: fixed; width: 569px">
            <colgroup>
              <col style="width: 350px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 200px">
            </colgroup>
            <?php if($eAdultQty > 0 || $eChildQty>0 || $eInfantQty>0){ ?>
            <tr>
              <td class="tg-3m6e">Govt. Tax</td>
              <?php if($adultQty >0) { ?>
              <td class="tg-wk8r"><?php echo $eAdultFare ?></td>
              <td class="tg-wk8r"><?php echo $eAdultQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $eChildFare ?></td>
              <td class="tg-wk8r"><?php echo $eChildQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $eInfantFare ?></td>
              <td class="tg-wk8r"><?php echo $eInfantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              <td class="tg-c1kk"> <?php echo number_format( $eTotal=$eAdultFare* $eAdultQty + $eChildFare* $eChildQty + $eInfantFare*$eInfantQty,2); ?></td>
            </tr> <?php } ?>

            <?php if($tAdultQty > 0 || $tChildQty>0 || $tInfantQty>0){ ?>
            <tr>
              <td class="tg-3m6e">Travel</td>
              <?php if($adultQty >0) { ?>
              <td class="tg-wk8r"><?php echo $tAdultFare ?></td>
              <td class="tg-wk8r"><?php echo $tAdultQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $tChildFare ?></td>
              <td class="tg-wk8r"><?php echo $tChildQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $tInfantFare ?></td>
              <td class="tg-wk8r"><?php echo $tInfantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              <td class="tg-c1kk"> <?php echo number_format( $tTotal= $tAdultFare* $tAdultQty + $tChildFare* $tChildQty + $tInfantFare*$tInfantQty,2); ?></td>
            </tr> <?php } ?>

            <?php if($oAdultQty > 0 || $oChildQty>0 || $oInfantQty>0){ ?>
            <tr>
              <td class="tg-3m6e">Others</td>
              <?php if($adultQty >0) { ?>
              <td class="tg-wk8r"><?php echo $oAdultFare ?></td>
              <td class="tg-wk8r"><?php echo $oAdultQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($childQty >0) { ?>
              <td class="tg-wk8r"><?php echo $oChildFare ?></td>
              <td class="tg-wk8r"><?php echo $oChildQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>

              <?php if($infantQty >0) { ?>
              <td class="tg-wk8r"><?php echo $oInfantFare ?></td>
              <td class="tg-wk8r"><?php echo $oInfantQty ?></td>
              <?php } else{?>
              <th class="tg-wk8r"></th>
              <th class="tg-wk8r"></th> <?php } ?>
              <td class="tg-c1kk"> <?php echo number_format( $oTotal=$oAdultFare* $oAdultQty + $oChildFare* $oChildQty + $oInfantFare*$oInfantQty,2); ?></td>
            </tr> <?php } ?>



            

          </table>
        </div>
<?php } ?>


        <?php 
          if($otherPurpose1 !="" || $otherPurpose2 !="" || $otherPurpose3 !="" || $otherPurpose4 !="" || $otherPurpose5 !="" || $otherPurpose6 !=""){ ?>
        <?php if($eTotal !=0 || $tTotal !=0 || $oTotal !=0)
          echo '<div style="width: 100%; margin-top: 100px;">';
          else
            echo '<div style="width: 100%; margin-top: 10px;">'; ?>
          <h5  style="margin-bottom:0px; font-size: 18px"><b>Others: </b></h5>
          <?php $ocount=1;?>
          <table align="right" class="tg" style="table-layout: fixed; width: 569px">
            <colgroup>
              <col style="width: 350px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 81px">
              <col style="width: 41px">
              <col style="width: 200px">
            </colgroup>
            <tr>
              <td class="tg-3m6e"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"></td>
            </tr>
            <?php if($otherPurpose1 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose1 ?></td>
              <td class="tg-wk8r"><?php if($otherQty1>0) echo $otherExpense1 ?></td>
              <td class="tg-wk8r"><?php if($otherQty1>0) echo $otherQty1 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty1>0) echo number_format( $pTotal1=$otherExpense1* $otherQty1,2); ?></td>
            </tr> <?php } ?>
               
 

          <?php if($otherPurpose2 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose2 ?></td>
              <td class="tg-wk8r"><?php if($otherQty2>0) echo $otherExpense2 ?></td>
              <td class="tg-wk8r"><?php if($otherQty2>0) echo $otherQty2 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty2>0) echo number_format( $pTotal2=$otherExpense2* $otherQty2,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose3 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose3 ?></td>
              <td class="tg-wk8r"><?php if($otherQty3>0) echo $otherExpense3 ?></td>
              <td class="tg-wk8r"><?php if($otherQty3>0) echo $otherQty3 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty3>0) echo number_format( $pTotal3=$otherExpense3* $otherQty3,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose4 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose4 ?></td>
              <td class="tg-wk8r"><?php if($otherQty4>0) echo $otherExpense4 ?></td>
              <td class="tg-wk8r"><?php if($otherQty4>0) echo $otherQty4 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty4>0) echo number_format( $pTotal4=$otherExpense4* $otherQty4,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose5 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose5 ?></td>
              <td class="tg-wk8r"><?php if($otherQty5>0) echo $otherExpense5 ?></td>
              <td class="tg-wk8r"><?php if($otherQty5>0) echo $otherQty5 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty5>0) echo number_format( $pTotal5=$otherExpense5* $otherQty5,2); ?></td>
            </tr> <?php } ?>

            <?php if($otherPurpose6 !=""){ ?>
            <tr>
              <td class="tg-3m6e"><?php echo $otherPurpose6 ?></td>
              <td class="tg-wk8r"><?php if($otherQty6>0) echo $otherExpense6 ?></td>
              <td class="tg-wk8r"><?php if($otherQty6>0) echo $otherQty6 ?></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-wk8r"></td>
              <td class="tg-c1kk"> <?php if($otherQty6>0) echo number_format( $pTotal6=$otherExpense6* $otherQty6,2); ?></td>
            </tr> <?php } ?>



          </table>
        </div>
<?php } ?>
      
      <?php if($bank_details != ""){

      echo '<h5  style="margin-bottom:0px;margin-top:170px;font-size: 18px"><b>Bank Details: </b></h5>';
      echo '<div style="padding-left: 30px;">';
      echo nl2br($bank_details); 
      echo '</div>'; } ?>

      </main>

      <?php $pTotal = $pTotal1+$pTotal2+$pTotal3+$pTotal4+$pTotal5+$pTotal6; ?>

      <footer  style="max-width: 1024px; margin-bottom: 130px;">
          <div style="text-align: right; margin-bottom: 70px; font-size: 20px">
                 <div style="text-align: right; margin-bottom: 40px; font-size: 20px">
      <hr style="border: .1px solid white;margin-bottom: 0px;">

      <table align="right" class="tg" style="undefined;table-layout: fixed; width: 382px;">
      <colgroup>
      <col style="width: 200px">
      <col style="width: 100px">
      </colgroup>
         <?php if($pAmount>0 ){ ?>
        <tr>
          <td class="tg-3m6e" style="font-weight:bold;">Paid Amount</td>
          <td class="tg-c1kk">
            <?php if($pAmount >0){?>
              <?php echo '- '.number_format($pAmount,2); }
              ?></td>
        </tr>
        <?php } ?>
      </table>
      </div>
      <hr style="border: 1px solid #5F5F5F;margin-bottom: 0px;">

      <table align="right" class="tg" style="undefined;table-layout: fixed; width: 382px;">
      <colgroup>
      <col style="width: 200px">
      <col style="width: 100px">
      </colgroup>
        <tr>
          <th class="tg-3m6e" style="font-weight:bold;">Total</th>
          <th class="tg-c1kk"><?php  $sTotal=(($pTotal+$total+$eTotal+$tTotal+$oTotal)-$cTotal); echo number_format( $t=round(($sTotal-$pAmount)),2);?></th>
        </tr>
      </table>
        <div style="padding-right: 420px;">
          <p align='left'style="float: left;width: 200px;font-weight:bold;">Total Amount (In Words):</p>
          <?php

          echo "<p align='left' style='color:black; padding-right: 20px;'>".numberTowords("$t")." TAKA ONLY</p>"
          ?>
        </div>
      </div>


        <div align="left">
        <hr style="max-width: 200px; border: 1px solid #5F5F5F;" align="left">
      Prepared By</div>
      </footer>
    </div>
    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
    <div></div>
  </div>
</div>
<!---pad--->
</body>


<script language="javascript" type="text/javascript">
  function printDiv(divID) 
  {
    var divElements = document.getElementById(divID).innerHTML;
    var oldPage = document.body.innerHTML;

    document.body.innerHTML = 
    "<html><head><title></title></head><body>" + 
    divElements + "</body>";

    window.print();

    document.body.innerHTML = oldPage;
  }
    function deleteAlert(){
    if(confirm("Click Ok to confirm!!!")== false){
      return false;
    }
    else
      return true;
  }
  function exportHTML(){
       var header = "<html><head><title></title></head><body>";
       var footer = "</body>";
       var sourceHTML = header+document.getElementById("invoice").innerHTML+footer;
       var oldPage = document.body.innerHTML;
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'document.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);

       document.body.innerHTML = oldPage;
    }

</script>

</html>
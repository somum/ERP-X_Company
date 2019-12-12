<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index");
	exit;
}
require_once './config.php';


$invoice_id = $_SESSION["invoice_id"];


$companyRef = $_POST['companyRef'];
$cname = strtoupper($_POST['cname']);
$idate=$_POST['idate'];
$individualName = strtoupper($_POST['individualName']);
$sector = strtoupper($_POST['sector']);
$airline=strtoupper($_POST['airline']);
$class = strtoupper($_POST['class']);
$ticketNo = strtoupper($_POST['ticketNo']);
$adultFare=$_POST['adultFare'];
$adultQty=$_POST['adultQty'];
$childFare = $_POST['childFare'];
$childQty = $_POST['childQty'];
$infantFare=$_POST['infantFare'];
$infantQty=$_POST['infantQty'];
$cPercentage = $_POST['cPercentage'];
$cTk = $_POST['cTk'];
$eAdultFare=$_POST['eAdultFare'];
$eAdultQty=$_POST['eAdultQty'];
$eChildFare = $_POST['eChildFare'];
$eChildQty = $_POST['eChildQty'];
$eInfantFare=$_POST['eInfantFare'];
$eInfantQty=$_POST['eInfantQty'];
$tAdultFare=$_POST['tAdultFare'];
$tAdultQty=$_POST['tAdultQty'];
$tChildFare = $_POST['tChildFare'];
$tChildQty = $_POST['tChildQty'];
$tInfantFare=$_POST['tInfantFare'];
$tInfantQty=$_POST['tInfantQty'];

$oAdultFare=$_POST['oAdultFare'];
$oAdultQty=$_POST['oAdultQty'];
$oChildFare = $_POST['oChildFare'];
$oChildQty = $_POST['oChildQty'];
$oInfantFare=$_POST['oInfantFare'];
$oInfantQty=$_POST['oInfantQty'];



$otherPurpose1=strtoupper($_POST['otherPurpose1']);
$otherPurpose2=strtoupper($_POST['otherPurpose2']);
$otherPurpose3=strtoupper($_POST['otherPurpose3']);
$otherPurpose4=strtoupper($_POST['otherPurpose4']);
$otherPurpose5=strtoupper($_POST['otherPurpose5']);
$otherPurpose6=strtoupper($_POST['otherPurpose6']);

$otherExpense1=$_POST['otherExpense1'];
$otherExpense2=$_POST['otherExpense2'];
$otherExpense3=$_POST['otherExpense3'];
$otherExpense4=$_POST['otherExpense4'];
$otherExpense5=$_POST['otherExpense5'];
$otherExpense6=$_POST['otherExpense6'];

$otherQty1=$_POST['otherQty1'];
$otherQty2=$_POST['otherQty2'];
$otherQty3=$_POST['otherQty3'];
$otherQty4=$_POST['otherQty4'];
$otherQty5=$_POST['otherQty5'];
$otherQty6=$_POST['otherQty6'];



$pAmount = $_POST['pAmount'];
$pDate = $_POST['pDate'];

$reference = strtoupper($_POST['reference']);
$c_address = strtoupper($_POST['c_address']);

$poNo = strtoupper($_POST['poNo']);
$o_invoice = strtoupper($_POST['o_invoice']);
$poDate = $_POST['poDate'];
$check_ref=strtoupper($_POST['check_ref']);

$bank_details = $_POST['bank_details'];

$location = $_POST['location'];

if(isset($_POST["submit"])){

	$sql = "UPDATE invoice_details SET companyRef = '$companyRef', cname='$cname', individualName = '$individualName', idate = '$idate', sector = '$sector', airline = '$airline', class = '$class', ticketNo = '$ticketNo', adultFare = '$adultFare', adultQty = '$adultQty', childFare = '$childFare', childQty = '$childQty', infantFare = '$infantFare', infantQty = '$infantQty', cPercentage = '$cPercentage', cTk = '$cTk', eAdultFare='$eAdultFare', eAdultQty = '$eAdultQty', eChildFare = '$eChildFare', eChildQty = '$eChildQty', eInfantFare = '$eInfantFare', eInfantQty = '$eInfantQty', tAdultFare= '$tAdultFare', tAdultQty = '$tAdultQty', tChildFare = '$tChildFare',tChildQty='$tChildQty', tInfantFare='$tInfantFare', tInfantQty='$tInfantQty', oAdultFare='$oAdultFare', oAdultQty='$oAdultQty', oChildFare='$oChildFare', oChildQty='$oChildQty', oInfantFare='$oInfantFare', oInfantQty='$oInfantQty', otherPurpose1='$otherPurpose1', otherPurpose2='$otherPurpose2', otherPurpose3='$otherPurpose3',otherPurpose4='$otherPurpose4', otherPurpose5='$otherPurpose5', otherPurpose6='$otherPurpose6', otherExpense1='$otherExpense1', otherExpense2='$otherExpense2', otherExpense3='$otherExpense3',otherExpense4='$otherExpense4', otherExpense5='$otherExpense5', otherExpense6='$otherExpense6', otherQty1='$otherQty1', otherQty2='$otherQty2', otherQty3='$otherQty3',otherQty4='$otherQty4', otherQty5='$otherQty5', otherQty6='$otherQty6', pAmount='$pAmount', pDate='$pDate', reference='$reference',c_address='$c_address',poNo='$poNo',o_invoice='$o_invoice',poDate='$poDate',check_ref='$check_ref', bank_details = '$bank_details', location = '$location' WHERE invoice_id='$invoice_id' ";

		if (mysqli_query($conn, $sql)) {

			//echo "<br />Invoice Updated successfully.";
			$_SESSION["invoice_id"] = $invoice_id;
			 $sql5 = "DELETE FROM oinvoice_details WHERE invoice_id = '$invoice_id'";
		      mysqli_query($conn, $sql5);
		      $office_no_array = $_POST['o_invoice'];
		      $office_amount_array = $_POST['o_amount'];
		      $size = sizeof($office_amount_array);
		      for ($x = 0; $x < $size; $x++) {
		          $o_invoice = $office_no_array[$x];
		          $o_amount = $office_amount_array[$x];
		          
		          if($o_amount > 0)
		          {
		            $sql5 = "INSERT INTO oinvoice_details (invoice_id, o_invoice , total_amount) VALUES ('$invoice_id','$o_invoice', '$o_amount');";
		            if (mysqli_query($conn, $sql5)) {
		            echo "<br /> successfully." ;
		            }
		          }
		      }
            #header("location: ./test");
            #exit;
            echo "<script>window.location.href='test.php';</script>";

		} else {
			echo "<br />Invoice Failed to Updated.<br />";

		}

}
mysqli_close($conn);

// Redirect to login page


?>




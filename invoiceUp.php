<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php");
	exit;
}
require_once 'config.php';

$email=($_SESSION["email"]);
$refid = $_SESSION["refid"];

$invoice_id = strtoupper($_POST['invoice_id']);


$companyRef = strtoupper($_POST['companyRef']);
$class=strtoupper($_POST['class']);
$cname = strtoupper($_POST['cname']);
$idate=$_POST['idate'];
$individualName = strtoupper($_POST['individualName']);
$sector = strtoupper($_POST['sector']);
$airline=strtoupper($_POST['airline']);

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

$o_invoice = strtoupper($_POST['o_invoice']);
$poNo = strtoupper($_POST['poNo']);
$poDate = $_POST['poDate'];
$check_ref = strtoupper($_POST['check_ref']);

$bank_details = $_POST['bank_details'];

$location = $_POST['location'];



$office_no_array = $_POST['o_invoice'];
$office_amount_array = $_POST['o_amount'];
$size = sizeof($office_amount_array);



if(isset($_POST["submit"])){

		$sql = "INSERT INTO invoice_details(invoice_id, companyRef, cname, individualName, idate, sector, airline, class, ticketNo, adultFare, adultQty, childFare, childQty, infantFare, infantQty, cPercentage, cTk, eAdultFare, eAdultQty, eChildFare, eChildQty, eInfantFare, eInfantQty, tAdultFare, tAdultQty, tChildFare, tChildQty, tInfantFare, tInfantQty, oAdultFare, oAdultQty, oChildFare, oChildQty, oInfantFare, oInfantQty, otherPurpose1, otherPurpose2, otherPurpose3,otherPurpose4,otherPurpose5,otherPurpose6, otherExpense1, otherExpense2, otherExpense3,otherExpense4,otherExpense5,otherExpense6,otherQty1, otherQty2, otherQty3,otherQty4,otherQty5,otherQty6, pAmount, pDate,reference,c_address,o_invoice,poNo,poDate,check_ref,bank_details,location) VALUES ('$invoice_id', '$companyRef', '$cname','$individualName', '$idate', '$sector', '$airline', '$class', '$ticketNo', '$adultFare', '$adultQty', '$childFare', '$childQty', '$infantFare', '$infantQty', '$cPercentage', '$cTk', '$eAdultFare', '$eAdultQty', '$eChildFare', '$eChildQty', '$eInfantFare', '$eInfantQty', '$tAdultFare', '$tAdultQty', '$tChildFare', '$tChildQty', '$tInfantFare', '$tInfantQty', '$oAdultFare', '$oAdultQty', '$oChildFare', '$oChildQty', '$oInfantFare', '$oInfantQty', '$otherPurpose1', '$otherPurpose2', '$otherPurpose3','$otherPurpose4', '$otherPurpose5', '$otherPurpose6', '$otherExpense1', '$otherExpense2', '$otherExpense3','$otherExpense4', '$otherExpense5', '$otherExpense6', '$otherQty1', '$otherQty2', '$otherQty3','$otherQty4', '$otherQty5', '$otherQty6', '$pAmount', '$pDate','$reference','$c_address','$o_invoice','$poNo','$poDate','$check_ref', '$bank_details', '$location');";

		if (mysqli_query($conn, $sql)) {
		    
		    $sql2 = "UPDATE invoice_count SET sum = sum + 1 WHERE id = 1 ";
            mysqli_query($conn, $sql2);
            
			echo "<br />Invoice uploaded successfully.";
			$_SESSION["invoice_id"] = $invoice_id;
			for ($x = 0; $x < $size; $x++) {
			    $o_invoice = $office_no_array[$x];
			    $o_amount = $office_amount_array[$x];
			    
			    if($o_amount > 0)
			    {
			    	$sql3 = "INSERT INTO oinvoice_details (invoice_id, o_invoice , total_amount) VALUES ('$invoice_id','$o_invoice', '$o_amount');";
				    if (mysqli_query($conn, $sql3)) {
						echo "<br /> successfully." ;
					}
			    }
			} 
            echo "<script>window.location.href='test.php';</script>";

		} else {
			echo "<br />Invoice Failed to upload.<br />";
			echo $sql;
		}
}
mysqli_close($conn);
// Redirect to login page
#$_SESSION["invoice_id"] = $invoice_id;
#header('Location:test.php');
#exit();
echo "<script>window.location.href='test.php';</script>";
?>




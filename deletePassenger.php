<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index");
	exit;
}
require_once './config.php';


$passNo=$_SESSION['passNo'];


$sql = "DELETE FROM passenger_details where passport_no='$passNo' ";

mysqli_close($conn);

// Redirect to login page

header("location: ./viewPassenger");
exit;
?>

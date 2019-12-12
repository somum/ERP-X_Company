<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index");
	exit;
}
require_once './config.php';


$passNo=$_SESSION['passNo'];
$ref_id = $_SESSION['refid'];

$sql = "DELETE FROM passenger_details where passport_no='$passNo'";
mysqli_query($conn, $sql);


$sql2 = "DELETE FROM image_table where passport_no='$passNo'";
mysqli_query($conn, $sql2);


$sql3 = "UPDATE count_ref SET total_ref = total_ref - 1  WHERE ref_id = '$ref_id' ";
mysqli_query($conn, $sql3);

$sql4 = "DELETE FROM miles_table where passport_no='$passNo'";
mysqli_query($conn, $sql4);

mysqli_close($conn);

// Redirect to login page

header("location: ./viewPassengers");
exit;
?>

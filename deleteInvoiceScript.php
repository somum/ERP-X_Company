<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
require_once 'config.php';

$invoice_id = $_POST["delete_invoice"];


$sql = "DELETE FROM invoice_details WHERE invoice_id = '$invoice_id' ";
mysqli_query($conn, $sql);

$sql1 = "DELETE FROM oinvoice_details WHERE invoice_id = '$invoice_id' ";
mysqli_query($conn, $sql1);

mysqli_close($conn);

// Redirect to login page
header("location:viewInvoice");
exit;
?>
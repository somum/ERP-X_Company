<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;
}

$email=$_SESSION["email"];

require_once 'config.php';


// Date filter
if(isset($_POST['add_btn'])){
 if(isset($_POST['reference']) && isset($_POST['company_name']) && isset($_POST['c_address']) && ($_POST['reference'])!="" && ($_POST['company_name'])!="" && ($_POST['c_address'])!=""){
    $reference=strtoupper($_POST['reference']);
    $company_name=strtoupper($_POST['company_name']);
    $c_address=strtoupper($_POST['c_address']);

    $sql = "INSERT corp_details (company_name,reference,c_address) VALUES ('$company_name','$reference','$c_address' ) ;";
    mysqli_query($conn, $sql);
  }
}

header('Location:corporateDetails.php');
exit;

?>
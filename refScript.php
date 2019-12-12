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
 if(isset($_POST['reference']) && ($_POST['reference'])!=""){
    $reference=strtoupper($_POST['reference']);
    $sql = "INSERT ref_table (reference) VALUES ('$reference') ;";
    mysqli_query($conn, $sql);
  }
}

header('Location:refDetails');
exit;

?>
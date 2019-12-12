<?php
session_start();
require_once 'config.php';

if(isset($_POST["up_btn"]) && $_POST["up_btn"] != ""){
  $newReference = strtoupper($_POST['reference']);
  $oldReference = $_SESSION['oldReference'];
  $sql1 = "UPDATE ref_table SET reference= '$newReference' WHERE reference = '$oldReference' ";
  mysqli_query($conn,$sql1);

  $sql2 = "UPDATE crop_details SET reference= '$newReference' WHERE reference = '$oldReference' ";
  mysqli_query($conn,$sql2);

  $sql3 = "UPDATE passenger_details SET reference= '$newReference' WHERE reference = '$oldReference' ";
  mysqli_query($conn,$sql3);

  header("location:refDetails.php");
  exit;
}

else if(isset($_POST["dlt_btn"]) && $_POST["dlt_btn"] != ""){

  $oldReference = $_SESSION['oldReference'];
  $sql1 = "DELETE from ref_table WHERE reference = '$oldReference' ";
  mysqli_query($conn,$sql1);

  header("location:refDetails.php");
  exit;
}

?>
<?php
session_start();
require_once 'config.php';

$reference=strtoupper($_POST['reference']);
$company_name=strtoupper($_POST['company_name']);
$c_address=strtoupper($_POST['c_address']);

$corp_id = $_SESSION['corp_id'];
if(isset($_POST["up_btn"]) && $_POST["up_btn"] != ""){

  
  $sql1 = "UPDATE corp_details SET reference= '$reference',company_name='$company_name',c_address='$c_address' WHERE id = '$corp_id'";
  mysqli_query($conn,$sql1);
  header("location:corporateDetails.php");
  exit;
}

else if(isset($_POST["dlt_btn"]) && $_POST["dlt_btn"] != ""){

  $sql1 = "DELETE from corp_details WHERE id = '$corp_id' ";
  mysqli_query($conn,$sql1);

  header("location:corporateDetails.php");
  exit;
}

?>
<?php
session_start();
require_once 'config.php';

$employee_email=$_POST['employee_email'];
$password=$_POST['password'];

$oldEmail = $_SESSION['oldEmail'];
$id = $_SESSION['employee_id'];

if(isset($_POST["up_btn"]) && $_POST["up_btn"] != ""){

  
  $sql1 = "UPDATE login_table SET email= '$employee_email',password='$password' WHERE email = '$oldEmail'";
  mysqli_query($conn,$sql1);

  $sql3 = "UPDATE employee_details SET email= '$employee_email' WHERE email = '$oldEmail'";
  mysqli_query($conn,$sql3);

  header("location:admin.php");
  exit;
}

else if(isset($_POST["dlt_btn"]) && $_POST["dlt_btn"] != ""){

  $sql1 = "DELETE from login_table WHERE email = '$oldEmail' ";
  mysqli_query($conn,$sql1);

  $sql2 = "DELETE from employee_details WHERE email = '$oldEmail' ";
  mysqli_query($conn,$sql2);


  header("location:admin.php");
  exit;
}

?>
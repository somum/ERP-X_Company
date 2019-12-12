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
 if(isset($_POST['employee_email']) && isset($_POST['password']) ){
    $employee_email=$_POST['employee_email'];
    $password=$_POST['password'];
  
    $sql = "INSERT login_table (email,password) VALUES ('$employee_email','$password') ;";
    mysqli_query($conn, $sql);

    $sql2 = "INSERT employee_details (email) VALUES ('$employee_email') ;";
    mysqli_query($conn, $sql2);
  }
}

header('Location:admin.php');
exit;

?>
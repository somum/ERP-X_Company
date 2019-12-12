<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
require_once 'config.php';

$email=($_SESSION["email"]);

if(isset($_POST['name']) && isset($_POST['designation'])&& isset($_POST['company_name'])){

	$name = $_POST['name'];
	$designation = $_POST['designation'];
	$company_name = $_POST['company_name'];

	$password = $_POST['password'];
}

$sql = "UPDATE employee_details SET employee_name = '$name' , employee_deg = '$designation',company_name='$company_name'  WHERE email = '$email' ";
mysqli_query($conn, $sql);

$sql2 = "UPDATE login_table SET password = '$password' WHERE email = '$email' ";
mysqli_query($conn, $sql2);
        
mysqli_close($conn);

// Redirect to login page
header("location: dashboard");
exit;
?>
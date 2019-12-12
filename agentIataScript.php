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

    
    $agentNameIata=strtoupper($_POST['agentNameIata']);
    $iataNo=strtoupper($_POST['iataNo']);
    $zone=strtoupper($_POST['zone']);
    $bgToIata=strtoupper($_POST['bgToIata']);
    $sabreUtilised=strtoupper($_POST['sabreUtilised']);
    $amadeusUtilised=strtoupper($_POST['amadeusUtilised']);
    $galileoUtilised=strtoupper($_POST['galileoUtilised']);
    $sabreQuota=strtoupper($_POST['sabreQuota']);
    $amadeusQuota=strtoupper($_POST['amadeusQuota']);
    $galileoQuota=strtoupper($_POST['galileoQuota']);

    $agentCperson=strtoupper($_POST['agentCperson']);
    $agentCnumber=strtoupper($_POST['agentCnumber']);
    $agentEmail=$_POST['agentEmail'];


    $sql = "INSERT agent_iata_details (agentNameIata,iataNo,zone,bgToIata,sabreUtilised,amadeusUtilised,galileoUtilised,sabreQuota,amadeusQuota,galileoQuota,agentCperson,agentCnumber,agentEmail) VALUES ('$agentNameIata','$iataNo','$zone','$bgToIata','$sabreUtilised','$amadeusUtilised','$galileoUtilised','$sabreQuota','$amadeusQuota','$galileoQuota','$agentCperson','$agentCnumber','$agentEmail' ) ;";
    mysqli_query($conn, $sql);

}

header('Location:viewAgentIata.php');
exit;

?>
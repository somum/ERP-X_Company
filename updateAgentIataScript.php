<?php
session_start();
require_once 'config.php';

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

$agi_id = $_SESSION['agi_id'];
if(isset($_POST["up_btn"]) && $_POST["up_btn"] != ""){

  
  $sql1 = "UPDATE agent_iata_details SET agentNameIata= '$agentNameIata',iataNo= '$iataNo',zone= '$zone',bgToIata= '$bgToIata',sabreUtilised= '$sabreUtilised',amadeusUtilised= '$amadeusUtilised',galileoUtilised= '$galileoUtilised',sabreQuota= '$sabreQuota',amadeusQuota= '$amadeusQuota',galileoQuota= '$galileoQuota',agentCperson= '$agentCperson',agentCnumber= '$agentCnumber',agentEmail= '$agentEmail' WHERE ai_id = '$agi_id'";
  
  mysqli_query($conn,$sql1);
  header("location:viewAgentIata.php");
  exit;
}

else if(isset($_POST["dlt_btn"]) && $_POST["dlt_btn"] != ""){

  $sql1 = "DELETE from agent_iata_details WHERE ai_id = '$agi_id' ";
  mysqli_query($conn,$sql1);

  header("location:viewAgentIata.php");
  exit;
}

?>
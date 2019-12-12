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

$agi_id=$_POST['agi_id'];
$sql = "SELECT * FROM agent_iata_details WHERE ai_id='$agi_id' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);


$_SESSION['agi_id']=$agi_id;



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    SAir AIR BD LTD...
  </title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/typeahead.js"></script> 
</head>

<body class="">
  <?php include('nav.php'); ?>
  <!-- Page content -->
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-1">
      </div>
      
      <div class="col-xl-10" style="margin-top: 115px;min-height: 1000px;">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Agent Details</h3>
              </div>
              
            </div>
          </div>
          <div class="card-body">
            <form method="post" action="updateAgentIataScript.php">

              <div class="pl-lg-4">

                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group"style="margin-bottom:7px;">
                                          <label class="form-control-label" for="reference">Agency Name</label>
                                          <input type="text" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Agency Name" name="agentNameIata" id="agentNameIata" value="<?php echo $row['agentNameIata'] ?>" required>

                                        </div>
                                      </div>

                                      <div class="col-lg-6">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">IATA No</label>
                                          <input type="number" name="iataNo" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter IATA No" id="iataNo"  value="<?php echo $row['iataNo'] ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Contact Person</label>
                                          <input type="text" name="agentCperson" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Contact Person" id="agentCperson"  value="<?php echo $row['agentCperson'] ?>">
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Contact Number</label>
                                          <input type="number" name="agentCnumber" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Contact Number" id="agentCnumber" value="<?php echo $row['agentCnumber'] ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Email</label>
                                          <input type="text" name="agentEmail" class="form-control form-control-alternative" placeholder="Enter Email" id="agentEmail"  value="<?php echo $row['agentEmail'] ?>">
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Zone</label>
                                          <input type="text" name="zone" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Zone" id="zone" value="<?php echo $row['zone'] ?>">
                                        </div>
                                      </div>

                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">BG to IATA(BDT)</label>
                                          <input type="number" name="bgToIata" class="form-control form-control-alternative" placeholder="Enter BG to IATA(BDT)" id="bgToIata"  value="<?php echo $row['bgToIata'] ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Sabre Utilised</label>
                                          <input type="text" name="sabreUtilised" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Sabre Utilised" id="sabreUtilised" value="<?php echo $row['sabreUtilised'] ?>">
                                        </div>
                                      </div>

                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Amadeus Utilised</label>
                                          <input type="text" name="amadeusUtilised" class="form-control form-control-alternative" placeholder="Enter Amadeus Utilised" id="amadeusUtilised"  value="<?php echo $row['amadeusUtilised'] ?>">
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Galileo Utilised</label>
                                          <input type="text" name="galileoUtilised" class="form-control form-control-alternative" placeholder="Enter Galileo Utilised" id="galileoUtilised"  value="<?php echo $row['galileoUtilised'] ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Sabre Quota</label>
                                          <input type="number" name="sabreQuota" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Sabre Quota" id="sabreQuota" value="<?php echo $row['sabreQuota'] ?>">
                                        </div>
                                      </div>

                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Amadeus Quota</label>
                                          <input type="number" name="amadeusQuota" class="form-control form-control-alternative" placeholder="Enter Amadeus Quota" id="amadeusQuota"  value="<?php echo $row['amadeusQuota'] ?>">
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Galileo Quota</label>
                                          <input type="number" name="galileoQuota" class="form-control form-control-alternative" placeholder="Enter Galileo Quota" id="galileoQuota"  value="<?php echo $row['galileoQuota'] ?>">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                <div class="col-10 text-right" style="margin-top: 10px;">
                     <input type="submit" name="up_btn" class="btn btn-sm btn-primary" value="Update">
                </div>
                 </form>
                 <div class="col-1 text-right" style="margin-top: 10px;">
                  <input type="submit" name="dlt_btn" class="btn btn-sm btn-danger" value="Delete">
                   
                  </div>
                </div>  
              </div>
              
          
          </div>



        </div>
        </div>
      </div>
      <div class="col-xl-1">
      </div>

    </div>
    <?php include('footer.php'); ?>


    <!--   Core   -->
    <!--<script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>-->
    <script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Argon JS   -->
    <script src="./assets/js/argon-dashboard.min.js?v=1.1.0"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  </body>

  </html>
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


$sql = "SELECT * FROM agent_iata_details";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html> 

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <style> 
    /*Position and style for the sidebar*/ 

    .sidebar { 
      height: 100%; 
      width: 0; 
      position: fixed; 
      /*Stays in place */ 
      background-color: white; 
      /*green*/ 
      overflow-x: hidden; 
      /*for Disabling horizontal scroll */ 
    } 
    /* Position and style for the sidebar links */ 

    .sidebar a { 
      padding: 10px 10px 10px; 
      font-size: 14px; 
      color: #111; 
      display: block; 
      transition: 0.3s; 
    } 
    /* the links change color when mouse hovers upon them*/ 

    .sidebar a:hover { 
      color: #FFFFFF; 
    } 
    /* Position and style the for cross button */ 

    .sidebar .closebtn { 
      position: absolute; 
      top: 0; 
      right: 25px; 
    } 
    /* Style for the sidebar button */ 

    .openbtn { 
      font-size: 20px; 
      background-color: gray; 
      color: #111; 
      padding: 5px 5px 5px; 
      border: none; 
    } 
        /* the sidebar button changes  
        color when mouse hovers upon it */ 
        .openbtn:hover { 
          color: #FFFFFF; 
        } 

      /* pushes the page content to the right 
      when you open the side navigation */ 

      #main { 
        transition: margin-left .5s; 
        /* If you want a transition effect */ 
        padding: 10px; 
      } 
    </style> 
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
  </head> 
  
  <body> 
    <div id="sidebar" class="sidebar">
      <a>
        <img src="./assets/img/brand/sair.png" style="width: 240px;" alt="...">
      </a> 
      <!--the cross button-->
      <ul class="navbar-nav" style="padding-left: 25px; padding-top: 25px;">
        <li class="nav-item" >
          <a class=" nav-link " href=" ./index"> 
            <i class="ni ni-tv-2 text-primary"></i><span style="color: black;
            padding-left: 18px;">Dashboard<span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./viewAgentIata">
              <i class="ni ni-circle-08 text-primary"></i> <span style="color: black;padding-left: 10px;">Agent Details<span>
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link " href="./viewPassengers">
              <i class="ni ni-single-02 text-orange "></i> <span style="color: black;padding-left: 10px;">View Passengers<span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./addPassengers">
                <i class="fa fa-user-plus text-green"></i> <span style="color: black; padding-left: 10px;">Add Passengers<span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="./searchPassengers">
                  <i class="ni ni-circle-08 text-blue"></i> <span style="color: black;padding-left: 10px;">Search Passengers<span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="./corporateDetails">
                    <i class="ni ni-archive-2 text-black"></i> <span style="color: black;padding-left: 10px;">Corporate Details<span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="./refDetails">
                      <i class="ni ni-caps-small text-green"></i> <span style="color: black;padding-left: 10px;">Reference Details<span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="./createInvoice">
                        <i class="ni ni-ruler-pencil text-red"></i> <span style="color: black;padding-left: 10px;">Create Invoice<span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./viewInvoice">
                          <i class="ni ni-bullet-list-67 text-info"></i> <span style="color: black;padding-left: 10px;">View Invoice<span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link" href="./officeSearch">
                            <i class="ni ni-bullet-list-67 text-success"></i> <span style="color: black;padding-left: 10px;">Office Invoice<span>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" href="./logout">
                              <i class="ni ni-button-power text-red"></i> <span style="color: black;padding-left: 10px;">Logout<span>
                              </a>
                            </li>



                          </ul>
                        </div>
                        <div class="container-fluid" style="max-width: 1250px;"> 
                        <div id="main"> 
                          <button class="btn btn-info" onclick="sideBarHandle()">Menu</button> 
                          <div style="min-height: 1000px;">

                            <div class="card bg-secondary shadow" style="width: 800px; margin-left: 200px;">
                              <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                  <div class="col-8">
                                    <h3 class="mb-0">Agent Details</h3>
                                  </div>

                                </div>
                              </div>
                              <div class="card-body">
                                <form method="post" action="agentIataScript.php">
                                  <div class="pl-lg-4">

                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group"style="margin-bottom:7px;">
                                          <label class="form-control-label" for="reference">Agency Name</label>
                                          <input type="text" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Agency Name" name="agentNameIata" id="agentName"  value="" required>

                                        </div>
                                      </div>

                                      <div class="col-lg-6">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">IATA No</label>
                                          <input type="number" name="iataNo" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter IATA No" id="iataNo"  value="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Contact Person</label>
                                          <input type="text" name="agentCperson" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Contact Person" id="agentCperson"  value="">
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Contact Number</label>
                                          <input type="number" name="agentCnumber" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Contact Number" id="agentCnumber" value="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row mt-2">
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Email</label>
                                          <input type="text" name="agentEmail" class="form-control form-control-alternative" placeholder="Enter Email" id="agentEmail"  value="">
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Zone</label>
                                          <input type="text" name="zone" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Zone" id="zone" value="">
                                        </div>
                                      </div>

                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">BG to IATA(BDT)</label>
                                          <input type="number" name="bgToIata" class="form-control form-control-alternative" placeholder="Enter BG to IATA(BDT)" id="bgToIata"  value="">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row mt-2">
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Sabre Utilised</label>
                                          <input type="text" name="sabreUtilised" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Sabre Utilised" id="sabreUtilised" value="">
                                        </div>
                                      </div>

                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Amadeus Utilised</label>
                                          <input type="text" name="amadeusUtilised" class="form-control form-control-alternative" placeholder="Enter Amadeus Utilised" id="amadeusUtilised"  value="">
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Galileo Utilised</label>
                                          <input type="text" name="galileoUtilised" class="form-control form-control-alternative" placeholder="Enter Galileo Utilised" id="galileoUtilised"  value="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row mt-2">
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="c_address">Sabre Quota</label>
                                          <input type="number" name="sabreQuota" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Sabre Quota" id="sabreQuota" value="">
                                        </div>
                                      </div>

                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Amadeus Quota</label>
                                          <input type="number" name="amadeusQuota" class="form-control form-control-alternative" placeholder="Enter Amadeus Quota" id="amadeusQuota"  value="">
                                        </div>
                                      </div>
                                      <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:7px;">
                                          <label class="form-control-label" for="company_name">Galileo Quota</label>
                                          <input type="number" name="galileoQuota" class="form-control form-control-alternative" placeholder="Enter Galileo Quota" id="agentEmail"  value="">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-12 text-right" style="margin-top: 10px;">
                                      <input type="submit" name="add_btn" class="btn btn-sm btn-primary" value="Add Agent Details">
                                    </div>
                                  </div>

                                </form>
                              </div>



                            </div>

                            <div class="card shadow" style="margin-top: 30px;background-color:#575977; border: 0px solid white;">
                              <div class="row" style="color: white;">
                                <div class="card-header bg-transparent">
                                  <h3 class="text-white mb-0">View Agent Details</h3>
                                </div>
                                <!-- Search form -->
                                <div class="form-inline">
                                  <select id="searchby" class="form-control form-control-sm ml-3 w-85" style="color: #32325d">
                                    <option value="0">
                                      -- search by --  
                                    </option>
                                    <option value="0">Agency Name
                                    </option>
                                    <option value="1">IATA No
                                    </option>
                                    <option value="5">Zone
                                    </option>
                                  </select>
                                </div>

                                <form class="form-inline" style="margin-left: 10px">
                                  <i class="fas fa-search" aria-hidden="true"></i>
                                  <input class="form-control form-control-sm ml-3 w-75"style="color: #32325d;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Search"aria-label="Search">
                                </form>
                              </div>
                              <div class="table-responsive" style="max-height:500px;">
                                <table id="myTable"class="table align-items-center table-white" >
                                  <thead class="thead-white">
                                    <tr style="background-color: white;">
                                      <th style="color: white; font-weight:bold;background-color: #362F4B; border-color: 10px solid black;"scope="col">AGENCY NAME</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">IATA No</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Contact Person</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Contact Number</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Email</th>

                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Zone</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">BG to IATA(BDT)</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Sabre/U</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Amadeus/U</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">Galileo/U</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">S/Q</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">A/Q</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col">G/Q</th>
                                      <th style="color: white; font-weight:bold;background-color: #362F4B;"scope="col"  class="text-right">Options</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                    while( $row = mysqli_fetch_assoc($result))
                                      { ?>    
                                        <tr>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['agentNameIata']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <?php  echo $row['iataNo'] ?>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['agentCperson']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['agentCnumber']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['agentEmail']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['zone']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['bgToIata']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['sabreUtilised']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['amadeusUtilised']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['galileoUtilised']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['sabreQuota']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['amadeusQuota']; ?>
                                            </div>
                                          </td>
                                          <td scope="row" style="font-weight: bold;">
                                            <div class="media align-items-center">
                                              <?php echo $row['galileoQuota']; ?>
                                            </div>
                                          </td>

                                          <?php $agi_id = $row['ai_id']; ?>
                                          <td class="text-right">
                                            <form action="updateAgentIataDetails.php" method="post">
                                              <button type="submit" class="btn btn-sm btn-primary" name="agi_id" value= "<?php  echo $agi_id ?>">Edit</button>
                                            </form>
                                          </td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

                            </div>
                            <?php include('footer.php'); ?> 
                          </div>
                        </div>
                        </body> 
<script> 
    var flag = 0;
    function sideBarHandle() { 

      if(flag == 0)
      {
        flag = 1;
        openNav();
      }
      else{
        flag = 0;
        closeNav();
      }
    } 
    /* Sets the width of the sidebar  
    to 250 and the left margin of the  
    page content to 250 */ 
    function openNav() { 
      document.getElementById( 
        "sidebar").style.width = "250px"; 
      document.getElementById( 
        "main").style.marginLeft = "250px"; 
    } 

    /* Set the width of the sidebar  
    to 0 and the left margin of the  
    page content to 0 */ 
    function closeNav() { 
      document.getElementById( 
        "sidebar").style.width = "0"; 
      document.getElementById( 
        "main").style.marginLeft = "0"; 
    } 
  </script>
  <script type="text/javascript">

    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      var e = document.getElementById("searchby");
      var val = e.options[e.selectedIndex].value;
      for (i = 0; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("td")[val];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }

  </script>
  <script src='jquery-3.3.1.js' type='text/javascript'></script>
  <script src='jquery-ui.min.js' type='text/javascript'></script>



</body>

</html>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index");
  exit;
}

$email=($_SESSION["email"]);
$name= $_SESSION["employee_name"];
$fname=$lname=$file_name="";
require_once 'config.php';

$sql = "SELECT * FROM passenger_details";
$result = mysqli_query($conn,$sql);

$sql2 = "SELECT * FROM passenger_details WHERE 1";

// Date filter
if(isset($_POST['but_search'])){
 if(isset($_POST['searchDOB']) && ($_POST['searchDOB'])!=""){
  $month=$_POST['searchDOB'];
  $sql2 .= " and dob 
  like '$month' ";
}
        // Sort
$sql2 .= " ORDER BY dob DESC";
$result = mysqli_query($conn,$sql2);
}



?>
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
            padding-left: 10px;">Dashboard<span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./viewPassengers">
              <i class="ni ni-single-02 text-orange "></i> <span style="color: black;padding-left: 10px;">Search Passengers<span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./addPassengers">
                <i class="fa fa-user-plus text-green"></i> <span style="color: black; padding-left: 10px;">Add Passengers<span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="./searchPassengers">
                  <i class="ni ni-circle-08 text-blue"></i> <span style="color: black;padding-left: 10px;">Date Inquiry<span>
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
                      <div id="main"> 
                        <button class="btn btn-info" onclick="sideBarHandle()">Toggle</button> 
                        <div class="row mt-5" style="min-height: 1000px;">
                          <div class="col">
                            <div class="card bg-default shadow">
                              <div class="row">
                                <div class="card-header bg-transparent border-0">
                                  <h3 class="text-white mb-0">Passengers</h3>
                                </div>
                                <!-- Search form -->
                                <div class="form-inline">
                                  <select id="searchby" class="form-control form-control-sm ml-3 w-85" style="color: #32325d">
                                    <option value="0">
                                      -- search by --  
                                    </option>
                                    <option value="0">First Name
                                    </option>
                                    <option value="1">Last Name
                                    </option>
                                    <option value="2">Passport No
                                    </option>
                                    <option value="7">Crop. Details
                                    </option>
                                  </select>
                                </div>

                                <div class="form-inline" style="margin-left: 10px">
                                  <i class="fas fa-search" aria-hidden="true"></i>
                                  <input class="form-control form-control-sm ml-3 w-75"style="color: #32325d;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Search"aria-label="Search">
                                </div>

                                <div class="form-inline">
                                  <form method='post' action='' style="margin-bottom:0px;">
                                    <select name="searchDOB" class="form-control form-control-sm ml-3 w-85"style="color: #32325d;">
                                      <option value="">
                                        -- search by --  
                                      </option>
                                      <option value="%-01-%">January
                                      </option>
                                      <option value="%-02-%">February
                                      </option>
                                      <option value="%-03-%">March
                                      </option>
                                      <option value="%-04-%">April
                                      </option>
                                      <option value="%-05-%">May
                                      </option>
                                      <option value="%-06-%">June
                                      </option>
                                      <option value="%-07-%">July
                                      </option>
                                      <option value="%-08-%">August
                                      </option>
                                      <option value="%-09-%">September
                                      </option>
                                      <option value="%-10-%">October
                                      </option>
                                      <option value="%-11-%">November
                                      </option>
                                      <option value="%-12-%">December
                                      </option>
                                    </select>
                                    <input style='margin-left: 10px;' type='submit' name='but_search' class="btn btn-sm btn-primary" value='Search'>
                                  </form>
                                </div>

                              </div>
                              <div class="table-responsive" style="max-height: 500px;">
                                <table class="table align-items-center table-dark table-flush" id="myTable">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th scope="col" onclick="sortTable(0)" style="color: white; font-weight:bold;">First Name</th>
                                      <th scope="col"onclick="sortTable(1)"style="color: white; font-weight:bold;">Last Name</th>
                                      <th scope="col"onclick="sortTable(2)"style="color: white; font-weight:bold;">Passport No</th>
                                      <th scope="col"style="color: white; font-weight:bold;">Date of Expire</th>
                                      <th scope="col"style="color: white; font-weight:bold;">Date of Birth</th>
                                      <th scope="col"onclick="sortTable(5)"style="color: white; font-weight:bold;">Gender</th>
                                      <th scope="col"style="color: white; font-weight:bold;">Nationality</th>
                                      <th scope="col"style="color: white; font-weight:bold;">Corp. Details</th>
                                      <th scope="col"  class="text-right"style="color: white; font-weight:bold;">More</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                    while( $row = mysqli_fetch_assoc($result))
                                      { ?>    
                                        <tr>
                                          <td scope="row">

                                            <div class="media-body">
                                              <span class="mb-0 text-sm"><?php  echo $row['fname'] ?></span>
                                            </div>
                                          </td>
                                          <td>
                                            <?php  echo $row['lname'] ?>
                                          </td>
                                          <td>
                                            <?php  echo $row['passport_no'] ?>
                                          </td>
                                          <?php $passNo = $row['passport_no']; ?>
                                          <td>
                                            <?php  echo $row['passport_expire'] ?>
                                          </td>
                                          <td>
                                            <?php  echo $row['dob'] ?>
                                          </td>
                                          <td>
                                            <?php  echo $row['gender'] ?>
                                          </td>
                                          <td>
                                            <?php  echo $row['nationality'] ?>
                                          </td>
                                          <td>
                                            <?php  echo $row['corp_details'] ?>
                                          </td>
                                          <td class="text-right">
                                            <form action="passengerDashboard" method="post">
                                              <button type="submit" class="btn btn-sm btn-primary" name="passNo" value= "<?php  echo $passNo ?>">View</button>
                                            </form>
                                          </td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php include('footer.php'); ?> 
                        </div>

                      </body> 
                      <script> 
                        openNav();
                        var flag = 0;
                        function sideBarHandle() { 

                          if(flag == 0)
                          {
                            flag = 1;
                            closeNav();
                          }
                          else{
                            flag = 0;
                            openNav();
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

  <script>
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

    function sortTable(n) {
      var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
      table = document.getElementById("myTable");
      switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
          // Start by saying: no switching is done:
          switching = false;
          rows = table.rows;
          /* Loop through all table rows (except the
          first, which contains table headers): */
          for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            } else if (dir == "desc") {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
          }
          if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
          } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
            }
          }
        }
      }
    </script>

    <!--my-->

    <!-- Script -->
    <script src='jquery-3.3.1.js' type='text/javascript'></script>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
    <script type='text/javascript'>
     $(document).ready(function(){
       $('.dateFilter').datepicker({
        dateFormat: "yy-mm-dd"
      });
     });
   </script> 

   </html> 
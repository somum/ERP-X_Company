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

$sql2 = "SELECT fname,lname,passport_no,passport_expire,corp_details,nationality, gender,dob, DATE_FORMAT(dob, '%m%d') AS md, MONTH(dob) AS m, DAY(dob) AS d, YEAR(dob) AS y FROM passenger_details";

// Date filter
if(isset($_POST['up_search'])){
 if(isset($_POST['upDOB']) && ($_POST['upDOB'])!=""){
  $day=$_POST['upDOB'];
  if($day==7){
    $sql2 .= " WHERE  DATE_FORMAT(dob, '%m%d') 
    BETWEEN DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY),'%m%d') 
    AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY),'%m%d')  ";}
    
    elseif ($day==15) {
      $sql2 .= " WHERE  DATE_FORMAT(dob, '%m%d') 
      BETWEEN DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY),'%m%d') 
      AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 15 DAY),'%m%d')  ";
    }
  }
  
  $sql2 .= " ORDER BY m,d ASC";
  $result = mysqli_query($conn,$sql2);
}


$sql3 = "SELECT fname,lname,passport_no,passport_expire,corp_details,nationality, gender,dob, DATE_FORMAT(passport_expire, '%y%m%d') AS md, MONTH(passport_expire) AS m, DAY(passport_expire) AS d, YEAR(passport_expire) AS y FROM passenger_details";
// Date filter
if(isset($_POST['pass_expire_sub'])){
 if(isset($_POST['pass_expire']) && ($_POST['pass_expire'])!=""){
  $day=$_POST['pass_expire'];
  if($day==244){
    $sql3 .= " WHERE  DATE_FORMAT(passport_expire, '%y%m%d') 
    BETWEEN DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY),'%y%m%d') 
    AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 244 DAY),'%y%m%d')  ";}
    
    elseif ($day==365) {
      $sql3 .= " WHERE  DATE_FORMAT(passport_expire, '%y%m%d') 
      BETWEEN DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY),'%y%m%d') 
      AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 365 DAY),'%y%m%d')  ";
    }
  }
  
  $sql3 .= " ORDER BY m,d ASC";
  $result = mysqli_query($conn,$sql3);
}



?>



<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
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
</head>

<body class="">
  <?php include('nav.php'); ?>

  <!-- Page content -->
  <!-- Dark table -->
  <div class="row mt-5" style="min-height: 1000px;">
    <div class="col">
      <div class="card bg-default shadow">
        <div class="row">
          <div class="card-header bg-transparent border-0">
            <h3 class="text-white mb-0">Passengers</h3>
          </div>
          <!-- Search form -->

          <form class="form-inline" method='post' action=''>
            <div class="form-inline">
              <select name="upDOB" class="form-control form-control-sm ml-3 w-85"style="color: #32325d;">
                <option value="">
                  -- Upcoming --  
                </option>
                <option value="7">7 Days
                </option>
                <option value="15">15 Days
                </option>

              </select>
              <input style='margin-left: 10px;' type='submit' name='up_search' class="btn btn-sm btn-primary" value='Birthday Search'>
            </div>
          </form>
          <form class="form-inline" method='post' action=''>
            <div class="form-inline">
              <select name="pass_expire" class="form-control form-control-sm ml-3 w-85"style="color: #32325d;">
                <option value="">
                  -- Expire Within --  
                </option>
                <option value="244"> 8 Month
                </option>
                <option value="365"> 1 Year
                </option>

              </select>
              <input style='margin-left: 10px;' type='submit' name='pass_expire_sub' class="btn btn-sm btn-primary" value='Passport Expire'>
            </div>
            
          </form>

        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-dark table-flush" id="myTable">
            <thead class="thead-dark">
              <tr>
                <th scope="col" onclick="sortTable(0)" style="color: white; font-weight:bold;">First Name</th>
                <th scope="col"onclick="sortTable(1)"style="color: white; font-weight:bold;">Last Name</th>
                <th scope="col"onclick="sortTable(2)"style="color: white; font-weight:bold;">Passport No</th>
                <th scope="col"style="color: white; font-weight:bold;">Expire Date</th>
                <th scope="col"style="color: white; font-weight:bold;">Date of Birth</th>
                <th scope="col"onclick="sortTable(5)"style="color: white; font-weight:bold;">Gender</th>
                <th scope="col"style="color: white; font-weight:bold;">Nationality</th>
                <th scope="col"style="color: white; font-weight:bold;">Corp. Details</th>
                <th scope="col"  class="text-right"style="color: white; font-weight:bold;">Options</th>
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
    <!--   Core   -->
    <script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="./assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Optional JS   -->
    <script src="./assets/js/plugins/chart.js/dist/Chart.min.js"></script>
    <script src="./assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
    <!--   Argon JS   -->
    <script src="./assets/js/argon-dashboard.min.js?v=1.1.0"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

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
    

  </body>

  </html>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
  header("location: index");
  exit;
}

$email=($_SESSION["email"]);

$name=$designation="";
require_once 'config.php';

$sql = "SELECT employee_name, employee_deg, employee_refid , company_name FROM employee_details WHERE email =?";

if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
  mysqli_stmt_bind_param($stmt, "s", $param_email);
  
            // Set parameters
  $param_email = $email;
  
            // Attempt to execute the prepared statement
  if(mysqli_stmt_execute($stmt)){
                // Store result
    mysqli_stmt_store_result($stmt);
    
                // Check if username exists, if yes then verify password
    if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
      mysqli_stmt_bind_result($stmt, $name, $designation, $refid, $company_name);
      if(mysqli_stmt_fetch($stmt)){
       $_SESSION["employee_name"] = $name;
       $_SESSION["refid"] = $refid;
     }
   }
   
 } 
}





        // Close statement
mysqli_stmt_close($stmt);





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

<body class="" style="color: black;">
  <?php include('nav.php'); ?>
  <!-- Page content -->
  <div class="container-fluid" style=" ">
    <div class="col-xl-3"></div>
    <div class="center-block" style="margin-top: 15px;min-height: 1024px;">
      <div class="card card-profile shadow">

        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div class="d-flex justify-content-between">
            <a href="updateProfile" class="btn btn-sm btn-info mr-4">Update Profile</a>
            <?php if($email=='rose@sairbd.com' || $email=='saiful@sairbd.com' || $email=='sagor@sairbd.com')
              echo '<a href="admin" class="btn btn-sm btn-default float-right">Admin</a>'; ?>
          </div>
        </div>

        <div class="card-body pt-0 pt-md-4">

          <div class="text-center" style="margin-bottom:100px;">
            <h3 style="color: black;">
              <?php echo $name ?>
            </h3>
            <div class="h5 mt-4" style="color: black;">
              <i class="ni business_briefcase-24 mr-2"></i><?php echo $designation ?>
            </div>
            <div>
              <i class="ni education_hat mr-2"></i><?php echo $company_name ?>
            </div>
          </div>
          <!--
          <hr>
          <h4>Passenger Referred</h4>
          <div id="chart-container" style=" max-width: 500px; max-height: 400px; margin-left: 235px;">
            <canvas id="graphCanvas"></canvas>
          </div> -->
          <!---end graph--->
        </div>
      </div>



    </div>
    <div class="col-xl-3"></div>
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
<!--
  <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].ref_id);
                        marks.push(data[i].total_ref);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Passenger Referred',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            },   
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
</script>
-->
<script type="text/javascript" src="./graph/js/Chart.min.js"></script>
</body>

</html>
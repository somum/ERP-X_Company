<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;
}

$email=($_SESSION["email"]);

$name=$designation="";

$refid=0;
require_once 'config.php';

$sql = "SELECT employee_name, employee_deg,company_name, employee_refid FROM employee_details WHERE email =?";

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
      mysqli_stmt_bind_result($stmt, $name, $designation,$company_name,$refid);
      if(mysqli_stmt_fetch($stmt)){
       
      }
    }
    
  } 
}

        // Close statement
mysqli_stmt_close($stmt);





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
</head>

<body class="">
  <?php include('nav.php'); ?>
  <!-- Page content -->
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-2">
      </div>
      <div class="col-xl-8" style="margin-top: 115px;min-height: 1000px;">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">My account</h3>
              </div>
              
            </div>
          </div>
          <div class="card-body">
            <form method="post" action="update.php">

              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="name">Name</label>
                      <input type="text" name="name" class="form-control form-control-alternative" placeholder="Your Name"  value="<?php echo $name ?>">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="designation">Designation</label>
                      <input type="text" name="designation" class="form-control form-control-alternative" placeholder="Your Designation" value="<?php echo $designation ?>">
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="company_name">Company Name</label>
                      <input type="text" list="class1" name="company_name"class="form-control form-control-alternative" placeholder=""  value="<?php echo $company_name ?>"/>
                                <datalist name="class1" id="class1">
                                    <option value="SKYLIGHT CORPORATION LTD.">
                                        <option value="SAIR AIR BD LTD.">
                                            <option value="HIMALAYA AIRLINES">

                                            </datalist>
                    </div>
                  </div>
                  <?php 
                      $sql2 = "SELECT * FROM login_table";
                      $result2 = mysqli_query($conn, $sql2);

                      while($row = mysqli_fetch_assoc($result2)){ 
                         $password = $row['password'];
                      } 

                  ?>
                <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="company_name">Password</label>
                      <input type="password" list="class1" name="password"class="form-control form-control-alternative" placeholder=""  value="<?php echo $password ?>"/>
                    </div>
                  </div>
                  
                </div>
              </div>
              
              <div class="col-12 text-right">
                    <input type="submit" class="btn btn-sm btn-primary" value="Update">
                  </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-2">
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

    <script type="text/javascript">
      




    </script>


  </body>

  </html>
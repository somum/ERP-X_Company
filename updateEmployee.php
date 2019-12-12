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

$employee_email=$_POST['email'];

$sql = "SELECT * FROM login_table WHERE email='$employee_email' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);


$oldEmail=$row['email'];
$password = $row['password'];
$_SESSION['oldEmail']=$oldEmail;

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
                <h3 class="mb-0">Employee Details</h3>
              </div>
              
            </div>
          </div>
          <div class="card-body">
            <form method="post" action="updateEmployeeScript.php">

              <h6 class="heading-small text-muted mb-4">Information</h6>
              <div class="pl-lg-4">

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group"style="margin-bottom:7px;">
                      <label class="form-control-label" for="employee_email">Email:</label>
                      <input type="text" class="form-control form-control-alternative" placeholder="Enter new email" name="employee_email" id="employee_email"value="<?php echo $oldEmail ; ?>">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group"style="margin-bottom:7px;">
                      <label class="form-control-label" for="password">Password:</label>
                      <input type="text" class="form-control form-control-alternative" placeholder="" name="password" id="password"value="<?php echo $password ; ?>">
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
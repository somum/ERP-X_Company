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

$sql = "SELECT * FROM ref_table";
$result = mysqli_query($conn,$sql);
$result2 = mysqli_query($conn,$sql);

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
                <h3 class="mb-0">Corporate Details</h3>
              </div>
              
            </div>
          </div>
          <div class="card-body">
            <form method="post" action="refScript.php">

              <h6 class="heading-small text-muted mb-4">Information</h6>
              <div class="pl-lg-4">

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group"style="margin-bottom:7px;">
                      <label class="form-control-label" for="reference">Reference</label>
                      <input type="text" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter Reference" name="reference" id="reference" list="refList" value="">
                      <datalist name="refList" id="refList">
                          <?php while($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['reference']?>">
                            <?php  } ?> 
                      </datalist>
                    </div>
                  </div>
                </div>

                 <div class="col-12 text-right" style="margin-top: 10px;">
                    <input type="submit" name="add_btn" class="btn btn-sm btn-primary" value="Add Reference">
                  </div>
              </div>

            </form>
          </div>



        </div>

        <!--listView--->
        <div class="card bg-default shadow" style="margin-top: 30px;">
          <div class="row">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">View Reference Details</h3>
            </div>
          <form class="form-inline" style="margin-left: 10px">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75"style="color: #32325d;" id="myInput" onkeyup="myFunction()" type="text" placeholder="Search"aria-label="Search">
          </form>
          </div>
          <div class="table-responsive">
            <table id="myTable"class="table align-items-center table-dark table-flush">
              <thead class="thead-dark">
                <tr>
                  <th style="color: white; font-weight:bold;"scope="col">Reference Name</th>
                  <th style="color: white; font-weight:bold;"scope="col"  class="text-right">Options</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                while( $row2 = mysqli_fetch_assoc($result2))
                  { ?>    
                    <tr>
                      <td>
                        <?php  echo $row2['reference'] ?>
                      </td>
                      <?php $id = $row2['id']; ?>
                      <td class="text-right">
                        <form action="updateRefDetails.php" method="post">
                          <button type="submit" class="btn btn-sm btn-primary" name="id" value= "<?php  echo $id ?>">Edit</button>
                        </form>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!--endlistview-->
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

    <script type="text/javascript">

      function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        
        for (i = 0; i < tr.length; i++) {

          td = tr[i].getElementsByTagName("td")[0];
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



  </body>

  </html>
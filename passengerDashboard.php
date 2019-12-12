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

$passNo = $_POST['passNo'];

require_once 'config.php';

$sql = "SELECT * FROM passenger_details WHERE passport_no = '".$passNo ."'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
  $fname = $row['fname'];
  $lname = $row['lname'];

  $dob = $row['dob'];
  $passport_issue = $row['passport_issue'];
  $passport_expire = $row['passport_expire'];
  $contact_no = $row['contact_no'];
  $present_address = $row['present_address'];
  $permanent_address = $row['permanent_address'];
  $corp_details = $row['corp_details'];
  $alter_pname = $row['alter_pname'];
  $alter_pcontact = $row['alter_pcontact'];

  $dom = $row['dom'];
  $gender = $row['gender'];
  $issue_place = $row['issue_place'];

  $other_address = $row['other_address'];
  $pEmail = $row['pEmail'];
  $pEmail2 = $row['pEmail2'];
  $reference = $row['reference'];
  $nationality = $row['nationality'];
}

$sql2 = "SELECT * FROM miles_table WHERE passport_no = '".$passNo ."'";
$result2 = mysqli_query($conn, $sql2);


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
  <div class="container-fluid mt--7">
    <div class="row">
      <div class="col-xl-1">
      </div>
      <div class="col-xl-10" style="margin-top: 115px; min-height: 1000px;">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Passenger Profile</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="./updatePassenger.php" method="POST">
              <div class="text-right">
                <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Edit Passenger">
              </div>
              <h6 class="heading-small text-muted mb-4">User information</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="reference">Reference</label>
                      <input type="text"style="text-transform: uppercase;"name="reference" id="reference" class="form-control form-control-alternative" placeholder="Enter reference" value="<?php echo $reference?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Corporate Details</label>
                      <input type="text" style="text-transform: uppercase;"name="corp_details" id="corp_details" class="form-control form-control-alternative" value="<?php echo $corp_details ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="fname">First Name</label>
                      <input type="text" name="fname" class="form-control form-control-alternative" style="text-transform: uppercase;" placeholder="Enter First Name" value="<?php echo $fname?>" readonly>
                    </div>
                  </div>

                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="form-control-label" for="lname">Last Name</label>
                      <input type="text" name="lname" class="form-control form-control-alternative" style="text-transform: uppercase;"placeholder="Enter Last Name" value="<?php echo $lname?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label" for="lname">Gender</label>
                      <input type="text" name="gender" class="form-control form-control-alternative" style="text-transform: uppercase;" value="<?php echo $gender?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Passport No</label>
                      <input type="text" style="text-transform: uppercase;"name="passNo" class="form-control form-control-alternative" placeholder="Enter Passport No" value="<?php echo $passNo ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Date of Birth</label>
                      <input type="date" name="dob" class="form-control form-control-alternative" placeholder="Enter Date of Birth" value="<?php echo $passport_expire ?>" readonly>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="fname">Date of Issue</label>
                      <input type="date" name="passport_issue" class="form-control form-control-alternative" value="<?php echo $passport_issue ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="lname">Date of Expire</label>
                      <input type="date" name="passport_expire" class="form-control form-control-alternative"value="<?php echo $passport_expire ?>" readonly>
                    </div>
                  </div>


                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="fname">Place of Issue</label>
                      <input type="text" style="text-transform: uppercase;"name="issue_place" class="form-control form-control-alternative" placeholder="Enter Place of Issue"value="<?php echo $issue_place ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="nationality">Nationality</label>
                        <input type="text" style="text-transform: uppercase;" name="nationality" class="form-control form-control-alternative" placeholder="Nationality" value="<?php echo $nationality ?>" readonly="">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Date of Marriage</label>
                      <input type="date" name="dom" class="form-control form-control-alternative" value="<?php echo $dom ?>" readonly>
                    </div>
                  </div>
                </div>

                <h6 class="heading-small text-muted mb-4" style="margin-left: -28px; padding:10px;">Miles Info</h6>
                <div class="field_wrapper">
                  <div class="row">
                    <div class="col-lg-3" style="padding-left:15px; padding-right: 3px">
                      <label class="form-control-label">Miles Name</label>
                    </div>
                    <div class="col-lg-2" style="padding: 0px 3px;">
                      <label class="form-control-label">Miles No</label>
                    </div>
                    <div class="col-lg-2" style="padding: 0px 3px;">
                      <label class="form-control-label">Total Miles</label>
                    </div>
                    <div class="col-lg-2" style="padding: 0px 3px;">
                      <label class="form-control-label">P/W</label>
                    </div>
                    <div class="col-lg-2" style="padding: 0px 3px;">
                      <label class="form-control-label">Expire Date</label> 
                    </div>
                    
                  </div>
                  <?php while($row2 = mysqli_fetch_assoc($result2)) { ?>
                    <div class="row" style="margin-top: 5px">
                      <div class="col-lg-3" style="padding-left:15px; padding-right: 3px">
                        <input type="text" class="form-control form-control-alternative" name="miles_name[]" value="<?php echo $row2['miles_name'] ?>" readonly />
                      </div>
                      <div class="col-lg-2" style="padding: 0px 3px;">
                        
                        <input type="text" class="form-control form-control-alternative" name="miles_no[]" value="<?php echo $row2['miles_no'] ?>" readonly />
                      </div>
                      <div class="col-lg-2" style="padding: 0px 3px;">
                        
                        <input type="text" class="form-control form-control-alternative" name="total_miles[]" value="<?php echo $row2['total_miles'] ?>" readonly />
                      </div>
                       <div class="col-lg-2" style="padding: 0px 3px;">
                        
                        <input type="text" class="form-control form-control-alternative" name="pw[]" value="<?php echo $row2['miles_pw'] ?>" readonly />
                      </div>
                      <div class="col-lg-2" style="padding: 0px 3px;">
                        
                        <input type="date" class="form-control form-control-alternative" name="miles_expire[]" value="<?php echo $row2['miles_expire'] ?>" readonly />
                      </div>

                      
                    </div>
                  <?php } ?>
                </div>
                <div class="row" style="margin-top: 10px;">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="pEmail">Email 01</label>
                      <input type="text" name="pEmail" id="pEmail" class="form-control form-control-alternative" value="<?php echo $pEmail ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="pEmail2">Email 02</label>
                      <input type="text" name="pEmail2" id="pEmail2" class="form-control form-control-alternative" value="<?php echo $pEmail2 ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Contact No 01</label>
                      <input type="text" style="text-transform: uppercase;"name="contact_no" class="form-control form-control-alternative"value="<?php echo $contact_no ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Contact No 02</label>
                      <input type="text" style="text-transform: uppercase;"name="contact_no2" class="form-control form-control-alternative" alue="<?php echo $contact_no2 ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Other Address</label>
                      <textarea type="text" rows="4" style="text-transform: uppercase;"name="present_address" class="form-control form-control-alternative" placeholder="Enter Present Address" readonly><?php echo$present_address ?></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Permanent Address</label>
                      <textarea type="text" rows="4"style="text-transform: uppercase;"name="permanent_address"class="form-control form-control-alternative" readonly><?php echo $permanent_address ?></textarea>
                    </div>
                  </div>
                </div>





              </div>


              <div class="pl-lg-4">

              </div>

              <h6 class="heading-small text-muted mb-4">Alternative Contact Information</h6>
              <div class="pl-lg-4">

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="fname">Name</label>
                      <input type="text" style="text-transform: uppercase;"name="alter_pname" class="form-control form-control-alternative" value="<?php echo $alter_pname ?>" readonly>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="lname">Contact No</label>
                      <input type="text" style="text-transform: uppercase;"name="alter_pcontact" class="form-control form-control-alternative" value="<?php echo $alter_pcontact ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label" for="passNo">Other Address</label>
                      <input type="text" style="text-transform: uppercase;"name="other_address" class="form-control form-control-alternative" value="<?php echo ($other_address) ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
              

              <hr class="my-4" />

              <!---myExperiment-->

              
              
              <!--end my experiment--->
              <div id="image_data">
               <table class="table table-bordered table-striped">  
                <tbody><tr>
                 <th width="60%">File</th>
                 <th width="20%">File Name</th>
                 <th width="10%">Download</th>
               </tr>
               <?php 
               $sql = "SELECT * FROM image_table WHERE passport_no = '".$passNo."'";
               $result = mysqli_query($conn,$sql);
               while( $row = mysqli_fetch_assoc($result))
                 { ?>
                  <tr>
                   <td>
                    <?php 
                    if( $row['type'] =="application/pdf" )
                      echo '<img class="img-fluid img-thumbnail" style="width: 200px; height:200px" src="images/pdf.png"/>';
                    else
                      echo '<img class="img-fluid img-thumbnail" style="width: 200px; height:150px" src="data:image/jpeg;base64,'.base64_encode( $row['image_data'] ).'"/>';
                    $image_no=$row['image_no'];
                    ?>
                  </td>
                  <td>
                   <?php echo $row['image_name'];?>
                 </td>
                 <td><?php echo '<a  href="download.php?image_no='.$image_no.'">Download</a>';?></td>

               </tr>
             <?php }?>
           </tbody></table>
         </div>
         
       </form>
      
      
      <form onsubmit="return deleteAlert();" action="deletePassengerScript.php" method="POST" class="text-right" style="margin-top: 15px;">
          <?php $_SESSION['passNo']= $passNo ?>
      <button id="delete_invoice" name="delete" class="btn btn-sm btn-danger" onclick="deleteAlert()" value="<?php echo $passNo ?>"><i class="fa fa-file-pdf-o"></i>Delete</button>
    </form>
      
    </div>
  </div>
</div>
<div class="col-xl-1">
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
  
  $(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
        window.location.reload(); 
    }
});

</script>
<script language="javascript" type="text/javascript">
    function deleteAlert(){
    if(confirm("Click Ok to confirm!!!")== false){
      return false;
    }
    else
      return true;
  }
  

</script>
</body>
</html>
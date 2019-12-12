<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
require_once 'config.php';

$email=($_SESSION["email"]);
$oldPassNo=($_SESSION["oldPassNo"]);

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['passNo'])){

  $fname = strtoupper($_POST['fname']);
  $lname = strtoupper($_POST['lname']);

  $passNo = strtoupper($_POST['passNo']);
  $dob = $_POST['dob'];
  $passport_issue = $_POST['passport_issue'];
  $passport_expire = $_POST['passport_expire'];
  $contact_no = $_POST['contact_no'];
  $present_address = strtoupper($_POST['present_address']);
  $permanent_address = strtoupper($_POST['permanent_address']);
  $corp_details = strtoupper($_POST['corp_details']);
  $alter_pname = strtoupper($_POST['alter_pname']);
  $alter_pcontact = $_POST['alter_pcontact'];

  $dom = $_POST['dom'];
  $gender = strtoupper($_POST['gender']);
  $issue_place = strtoupper($_POST['issue_place']);
  $contact_no2 = $_POST['contact_no2'];
  $other_address = strtoupper($_POST['other_address']);
  $pEmail = $_POST['pEmail'];
  $pEmail2 = $_POST['pEmail2'];
  $reference = strtoupper($_POST['reference']);
  $nationality = strtoupper($_POST['nationality']);

}


if(isset($_POST["submit"])){

      $sql = "UPDATE passenger_details SET fname = '$fname' , lname = '$lname', passport_no = '$passNo',dob= '$dob',passport_issue= '$passport_issue',passport_expire= '$passport_expire',contact_no= '$contact_no',contact_no2= '$contact_no2',present_address= '$present_address',permanent_address= '$permanent_address',corp_details= '$corp_details',alter_pname= '$alter_pname',alter_pcontact= '$alter_pcontact',reference='$reference',other_address='$other_address',pEmail='$pEmail',pEmail2='$pEmail2'   ,reference='$reference',dom='$dom',gender='$gender',issue_place='$issue_place', nationality= '$nationality' WHERE passport_no = '$oldPassNo' ";


      if (mysqli_query($conn, $sql)) {

            echo "<br />Invoice Updated successfully.";

          } else {

            echo "<br />Invoice Failed to Updated.<br />";

          }
      $sql4 = "DELETE FROM miles_table WHERE passport_no = '$oldPassNo'";
          if (mysqli_query($conn, $sql4)) {
          echo "<br /> successfully." ;
        }
      $miles_no_array = $_POST['miles_no'];
      $miles_name_array = $_POST['miles_name'];
      $miles_total_array = $_POST['total_miles'];
      $miles_expire_array = $_POST['miles_expire'];
      $miles_pw_array = $_POST['pw'];

      $miles_size = sizeof($miles_no_array);
      for ($x = 0; $x < $miles_size; $x++) {
          $miles_no = strtoupper($miles_no_array[$x]);
          $miles_name = strtoupper($miles_name_array[$x]);
          $total_miles = $miles_total_array[$x];
          $miles_expire = $miles_expire_array[$x];
          $miles_pw = $miles_pw_array[$x];

          $sql3 = "INSERT INTO miles_table (passport_no,miles_no,miles_name,total_miles,miles_expire,miles_pw) VALUES ('$passNo','$miles_no','$miles_name','$total_miles','$miles_expire','$miles_pw')";
          if (mysqli_query($conn, $sql3)) {
          echo "<br /> successfully." ;
        }
      }
      $sql2 = "UPDATE image_table SET passport_no = '$passNo' WHERE passport_no = '$oldPassNo' ";

      if (mysqli_query($conn, $sql2)) {
            echo "<script>window.location.href='viewPassengers.php';</script>";
          } else {
            echo "<br />Invoice Failed to Updated.<br />";
          }
       
}

mysqli_close($conn);
echo "<script>window.location.href='viewPassengers.php';</script>";
?>

<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: index.php");
	exit;
}
require_once 'config.php';

$email=($_SESSION["email"]);
$fname = strtoupper($_POST['fname']);
$lname = strtoupper($_POST['lname']);
$passNo = strtoupper($_POST['passNo']);
$ref_id= $_SESSION["refid"];

$dob = $_POST['dob'];
$passport_issue = $_POST['passport_issue'];
$passport_expire = $_POST['passport_expire'];
$contact_no = $_POST['contact_no'];
$present_address = strtoupper($_POST['present_address']);
$permanent_address = strtoupper($_POST['permanent_address']);
$corp_details = strtoupper($_POST['corp_details']);
$alter_pname = strtoupper($_POST['alter_pname']);
$alter_pcontact = $_POST['alter_pcontact'];
$reference = strtoupper($_POST['reference']);

$dom = $_POST['dom'];
$gender = strtoupper($_POST['gender']);
$issue_place = strtoupper($_POST['issue_place']);
$contact_no2 = strtoupper($_POST['contact_no2']);
$other_address = strtoupper($_POST['other_address']);

$pEmail = $_POST['pEmail'];
$pEmail2 = $_POST['pEmail2'];
$nationality = strtoupper($_POST['nationality']);

$sql3= "SELECT total_ref FROM count_ref WHERE ref_id='$ref_id'";
$result3= mysqli_query($conn, $sql3);
$row3= mysqli_fetch_array($result3);
$total_ref=$row3['total_ref']+1;


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

    $sql5 = "INSERT INTO miles_table (passport_no,miles_no,miles_name,total_miles,miles_expire,miles_pw) VALUES ('$passNo','$miles_no','$miles_name','$total_miles','$miles_expire','$miles_pw')";
    if (mysqli_query($conn, $sql5)) {
		echo "<br /> successfully." ;
	}
} 

if(isset($_POST["submit"])){

	$sql = "INSERT INTO passenger_details (passport_no,fname, lname, dob,passport_issue,passport_expire, contact_no, present_address, permanent_address, corp_details,alter_pname, alter_pcontact,ref_id, dom, gender, issue_place, contact_no2, other_address,reference, pEmail, pEmail2, nationality) VALUES ('$passNo', '$fname','$lname','$dob','$passport_issue','$passport_expire','$contact_no', '$present_address', '$permanent_address', '$corp_details','$alter_pname', '$alter_pcontact','$ref_id','$dom', '$gender', '$issue_place', '$contact_no2', '$other_address','$reference', '$pEmail', '$pEmail2', '$nationality')";

	if (mysqli_query($conn, $sql)) {

		echo "<br /> successfully." ;

		$sql4= "UPDATE count_ref SET total_ref='$total_ref' WHERE ref_id='$ref_id'";
		if (mysqli_query($conn, $sql4)) {

			echo "<br /> successfully.";
		}


	} else {

		echo "<br /> Failed to upload.<br />";

	}

	if(count($_FILES) > 0){
		if(is_uploaded_file($_FILES['fileToUpload2']['tmp_name'])){
		#$filesCount = count($_FILES['fileToUpload2']['tmp_name']);
		#for($i = 0; $i < $filesCount; $i++){
			#$_FILES['userFile']['tmp_name'] = $_FILES['fileToUpload2']['tmp_name'][$i];
			$image2= addslashes(file_get_contents($_FILES['fileToUpload2']['tmp_name']));
			$fileName = $_FILES['fileToUpload2']['name'];
			$fileSize = $_FILES['fileToUpload2']['size'];
			$fileType = $_FILES['fileToUpload2']['type'];
			$sql2 = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$image2','$fileName', '$fileType', '$fileSize' )";

			if (mysqli_query($conn, $sql2)) {

				echo "<br />Image uploaded successfully.";
			} else {
				echo "<br />Image Failed to upload.<br />";
			}	
		#}
		}
		if(is_uploaded_file($_FILES['fileToUpload1']['tmp_name'])){
			$image2= addslashes(file_get_contents($_FILES['fileToUpload1']['tmp_name']));
			$fileName = $_FILES['fileToUpload1']['name'];
			$fileSize = $_FILES['fileToUpload1']['size'];
			$fileType = $_FILES['fileToUpload1']['type'];
			$sql2 = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$image2','$fileName', '$fileType', '$fileSize' )";

			if (mysqli_query($conn, $sql2)) {

				echo "<br />Image uploaded successfully.";
			} else {
				echo "<br />Image Failed to upload.<br />";
			}	
		#}
		}
		if(is_uploaded_file($_FILES['fileToUpload3']['tmp_name'])){
			$image2= addslashes(file_get_contents($_FILES['fileToUpload3']['tmp_name']));
			$fileName = $_FILES['fileToUpload3']['name'];
			$fileSize = $_FILES['fileToUpload3']['size'];
			$fileType = $_FILES['fileToUpload3']['type'];
			$sql2 = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$image2','$fileName', '$fileType', '$fileSize' )";

			if (mysqli_query($conn, $sql2)) {

				echo "<br />Image uploaded successfully.";
			} else {
				echo "<br />Image Failed to upload.<br />";
			}	
		#}
		}
		if(is_uploaded_file($_FILES['fileToUpload4']['tmp_name'])){
			$image2= addslashes(file_get_contents($_FILES['fileToUpload4']['tmp_name']));
			$fileName = $_FILES['fileToUpload4']['name'];
			$fileSize = $_FILES['fileToUpload4']['size'];
			$fileType = $_FILES['fileToUpload4']['type'];
			$sql2 = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$image2','$fileName', '$fileType', '$fileSize' )";

			if (mysqli_query($conn, $sql2)) {

				echo "<br />Image uploaded successfully.";
			} else {
				echo "<br />Image Failed to upload.<br />";
			}	
		#}
		}
		if(is_uploaded_file($_FILES['fileToUpload5']['tmp_name'])){
			$image2= addslashes(file_get_contents($_FILES['fileToUpload5']['tmp_name']));
			$fileName = $_FILES['fileToUpload5']['name'];
			$fileSize = $_FILES['fileToUpload5']['size'];
			$fileType = $_FILES['fileToUpload5']['type'];
			$sql2 = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$image2','$fileName', '$fileType', '$fileSize' )";

			if (mysqli_query($conn, $sql2)) {

				echo "<br />Image uploaded successfully.";
			} else {
				echo "<br />Image Failed to upload.<br />";
			}	
		#}
		}
		if(is_uploaded_file($_FILES['fileToUpload6']['tmp_name'])){
			$image2= addslashes(file_get_contents($_FILES['fileToUpload6']['tmp_name']));
			$fileName = $_FILES['fileToUpload6']['name'];
			$fileSize = $_FILES['fileToUpload6']['size'];
			$fileType = $_FILES['fileToUpload6']['type'];
			$sql2 = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$image2','$fileName', '$fileType', '$fileSize' )";

			if (mysqli_query($conn, $sql2)) {

				echo "<br />Image uploaded successfully.";
			} else {
				echo "<br />Image Failed to upload.<br />";
			}	
		#}
		}
	}
}
mysqli_close($conn);
echo "<script>window.location.href='viewPassengers.php';</script>";
#header('Location:viewPassengers.php');
#exit;
?>
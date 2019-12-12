<?php
//action.php
session_start();
$passNo=$_SESSION['oldPassNo'];

include 'config.php';
if(isset($_POST["action"]))
{

 if($_POST["action"] == "fetch")
 {
  
  $query = "SELECT * FROM image_table where passport_no='$passNo' ORDER BY image_no DESC";
  $result = mysqli_query($conn, $query);
  $output = '
   <table class="table table-bordered table-striped">  
    <tr>
     <th width="80%">Image</th>
     <th width="10%">Change</th>
     <th width="10%">Remove</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>
      <img src="data:image/jpeg;base64,'.base64_encode($row['image_data'] ).'" height="200" width="200" class="img-thumbnail" />
     </td>
     <td><button type="button" name="update" class="btn btn-warning bt-xs update" id="'.$row["image_no"].'">Change</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["image_no"].'">Remove</button></td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 if($_POST["action"] == "insert")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $fileName = $_FILES['image']['name'];
  $fileSize = $_FILES['image']['size'];
  $fileType = $_FILES['image']['type'];
  $query = "INSERT INTO image_table (passport_no, image_data,image_name, type, size) VALUES ('$passNo', '$file','$fileName', '$fileType', '$fileSize' )";
  if(mysqli_query($conn, $query))
  {
   echo 'Image Inserted into Database';
  }
 }
 if($_POST["action"] == "update")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $fileName = $_FILES['image']['name'];
  $fileSize = $_FILES['image']['size'];
  $fileType = $_FILES['image']['type'];
  $query = "UPDATE image_table SET image_data = '$file', image_name = '$fileName', size ='$fileSize', type='$fileType' WHERE image_no = '".$_POST["image_id"]."'";
  if(mysqli_query($conn, $query))
  {
   echo 'Image Updated into Database';
  }
 }
 if($_POST["action"] == "delete")
 {
  $query = "DELETE FROM image_table WHERE image_no = '".$_POST["image_id"]."'";
  if(mysqli_query($conn, $query))
  {
   echo 'Image Deleted from Database';
  }
 }
}
?>

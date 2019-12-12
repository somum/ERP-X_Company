<?php
	    include_once 'config.php';
	    if (isset($_GET['image_no'])) 
	           {
				     $id = $_GET['image_no'];
				     $query = "SELECT * FROM image_table WHERE image_no = '$id'";
				     $result = mysqli_query($conn,$query) or die('Error, query failed');
				     list($passport_no, $image_no, $image_data, $image_name,$type,$size) = mysqli_fetch_array($result);

				     header("Content-length: $size");
				     header("Content-type: $type");
				     header("Content-Disposition: attachment; filename=$image_name");
				     ob_clean();
				     flush();
		                     $content = ($image_data);
				     echo $content;
				     mysqli_close($conn);
				     exit;
	           }
	       ?>

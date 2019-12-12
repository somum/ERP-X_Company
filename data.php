<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "sairbd_main", "Sairbd123#", "sairbd_database");

$sqlQuery = "SELECT id,ref_id,total_ref FROM count_ref ORDER BY id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
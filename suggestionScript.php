<?php		
	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	$conn =new mysqli("localhost", "sairbd_main", "Sairbd123#", "sairbd_database");

	$sql = $conn->prepare("SELECT distinct(reference) FROM ref_table WHERE reference LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["reference"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();
?>


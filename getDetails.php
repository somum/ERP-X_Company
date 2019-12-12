<?php
require_once "config.php";

$request = $_POST['request'];   // request

// Get username list
if($request == 1){
    $search = $_POST['search'];

    $query = "SELECT * FROM corp_details WHERE company_name like'%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'],"label"=>$row['company_name']);
    }

    // encoding array to json format
    echo json_encode($response);
    exit;
}

// Get details
if($request == 2){
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM corp_details WHERE id=".$userid;

    $result = mysqli_query($conn,$sql);

    $users_arr = array();

    while( $row = mysqli_fetch_array($result) ){
        $userid = $row['id'];
        $c_address = $row['c_address'];

        $users_arr[] = array("id" => $userid, "c_address" =>$c_address);
    }

    // encoding array to json format
    echo json_encode($users_arr);
    exit;
}

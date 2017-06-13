<?php

include '../query/conn.php';

$result = array();

if(isset($_GET['car_id'])){
	$car_id = $_GET['car_id'];

	$sql = "SELECT * FROM `planning` WHERE `car_id` = '".$car_id."';";
	$exe = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_assoc($exe)){
		$jRow = array();

		$jRow["date"] = $row["date"];
		$jRow["target_km"] = $row["target_km"];	
		$jRow["route_type"] = $row["route_type"];
		array_push($result, $jRow);
	}

	echo json_encode($result);
}
else{
	$result["msg"] = "error";
	echo json_encode($result);	
}





?>
<?php

include '../query/conn.php';

$result = array();
$result["success"] = false;

if(isset($_GET['car_id'])){

	$car_id = $_GET['car_id'];

	// check if planning data exists	
	$sql = "SELECT * FROM `planning` WHERE `car_id` = '".$car_id."';";
	$exe = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($exe);

	if($num_rows > 0){
		$result["success"] = true;
	}
}

echo json_encode($result);

?>
<?php

include '../query/conn.php';

$result = array();

function plotAllPoints(&$conn, $car_id, &$result){

	$sql = "SELECT `date`, `stop` FROM `operations` WHERE `car_id` = $car_id";
	$exe = mysqli_query($conn,$sql);


	while($row = mysqli_fetch_assoc($exe)){
		$jRow = array();

		$jRow["date"] = $row["date"];
		$jRow["stop"] = $row["stop"];

		$jRow["target_km"] = null;
		$jRow["route_type"] = null;
		array_push($result, $jRow);
	}
}

function plot_Nth_Point(&$conn, $car_id, &$result, $nth){

	$counter = -1;

	$sql = "SELECT `date`, `stop` FROM `operations` WHERE `car_id` = $car_id";
	$exe = mysqli_query($conn,$sql);


	while($row = mysqli_fetch_assoc($exe)){
		

		if(($counter == $nth) || ($counter == -1)){

			$counter = 0;

			$jRow = array();
			$jRow["date"] = $row["date"];
			$jRow["stop"] = $row["stop"];

			$jRow["target_km"] = null;
			$jRow["route_type"] = null;
			array_push($result, $jRow);	
		}
		$counter++;
		
	}
}


function getPLanningData(&$conn, $car_id, &$result){

	$cum_km = 0;
	
	// $sql = "SELECT * FROM `planning` WHERE `car_id` = $car_id";
	$sql = "SELECT a.*,b.car_start_km FROM `planning` a 
			JOIN `cars` b 
			ON a.car_id = b.car_id
			WHERE a.car_id = $car_id";
	// $sql = "SELECT a.*,b.handover_km FROM `planning` a 
	// 	JOIN `cars` b 
	// 	ON a.car_id = b.car_id
	// 	WHERE a.car_id = $car_id";
	$exe = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_assoc($exe)) {

		// add start-km offset if exists
		if($cum_km == 0){
			$cum_km += $row['car_start_km'];
		}


		$jRow = array();

		$jRow["date"] = $row["date"];

		$jRow["stop"] = null;
		
		$jRow["target_km"] 	= (string) $cum_km;

		$jRow["route_type"] = $row["route_type"];

		array_push($result, $jRow);

		$cum_km += $row["target_km"];
	}

}




if(isset($_GET['car_id'])){

	$car_id = $_GET['car_id'];

	// get first date
	$sql_f = "SELECT MIN(`date`) as start FROM `operations` WHERE `car_id` = $car_id";
	// $sql_f = "SELECT MIN(`date`) as start FROM `planning` WHERE `car_id` = $car_id";
	$exe_f = mysqli_query($conn,$sql_f);
	while($row = mysqli_fetch_assoc($exe_f)){
		$jRow = array();

		$jRow["date"] = $row["start"];
		$jRow["stop"] = null;

		$jRow["target_km"] = null;
		$jRow["route_type"] = null;

		array_push($result, $jRow);
	}

	// first get count of rows in ops
	$sql_c = "SELECT 1 FROM `operations` WHERE `car_id` = $car_id";
	$exe_c = mysqli_query($conn, $sql_c);
	$count = mysqli_num_rows($exe_c);


	if($count < 15) {		
		plotAllPoints($conn, $car_id, $result);
	}
	else if($count < 30) {
		$nth = 2;
		plot_Nth_Point($conn, $car_id, $result, $nth);
	}
	else{	
		$nth = 4;
		plot_Nth_Point($conn, $car_id, $result, $nth);
	}

	getPlanningData($conn, $car_id, $result);

	echo json_encode($result);
}
else{
	$result["msg"] = "error";
	echo json_encode($result);	
}

?>
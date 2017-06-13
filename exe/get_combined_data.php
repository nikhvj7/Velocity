<?php

include '../query/conn.php';

$result = array();

// get first date
$sql_f = "SELECT MIN(`date`) as start FROM `operations` WHERE 1";
$exe_f = mysqli_query($conn,$sql_f);
while($row = mysqli_fetch_assoc($exe_f)){
	$jRow = array();

	$jRow["date"] = $row["start"];
	$jRow["stop"] = "0";

	$jRow["target_km"] = "0";
	$jRow["route_type"] = "C";

	array_push($result, $jRow);
}

// get subseqent dates and kms
$sql = "SELECT `date`,`stop` FROM `operations` WHERE day(date) in (1,15)";
$exe = mysqli_query($conn,$sql);


while($row = mysqli_fetch_assoc($exe)){
	$jRow = array();

	$jRow["date"] = $row["date"];
	$jRow["stop"] = $row["stop"];	

	$jRow["target_km"] = null;	
	$jRow["route_type"] = null;
	array_push($result, $jRow);
}


// planning


$sql = "SELECT * FROM `planning` WHERE `car_id` = 2;";
$exe = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($exe)){
	$jRow = array();

	$jRow["date"] = $row["date"];

	$jRow["stop"] = null;	

	$jRow["target_km"] = $row["target_km"];	
	$jRow["route_type"] = $row["route_type"];
	array_push($result, $jRow);
}

echo json_encode($result);




?>
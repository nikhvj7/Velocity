<?php

include '../query/conn.php';



$comp_id = $_GET['comp_id'];
$date    = $_GET['date'];


$result = array();
// get first date
$sql_f = "SELECT * FROM `cars` WHERE `comp_id` = '".$comp_id."' AND `status` = 'active' ;";
$exe_f = mysqli_query($conn,$sql_f);
while($row = mysqli_fetch_assoc($exe_f)){
	$car    = array();

	$car_id = $car["car_id"] = $row["car_id"];
	$car["gqg_no"] = $row["gqg_no"];
	$car["current_km"] = $row["current_km"];
	$car["remaining_km"] = $row["remaining_km"];
	$car["total_km"] = $row["total_km"];
	$car["handover_date"] = $row["handover_date"];
	$car["handover_km"] = $row["handover_km"];
	$car ["percentage"] = ($row["current_km"]/$row["total_km"])*100;


	$sql1 = "SELECT `trip`,`route` FROM `operations` WHERE `car_id` = '".$car_id."' AND `date` = '".$date."' ORDER BY `op_id` DESC LIMIT 1 ;";
	$exe1 = mysqli_query($conn,$sql1);
	$count1 = mysqli_num_rows($exe1);
	if($count1 > 0){
		$row1 = mysqli_fetch_assoc($exe1);
		$car['trip']  = $row1['trip'];
		$car['route_current'] = $row1['route'];

	}else{
		$car['trip']  = 0;
		$car['route_current'] = 'NA';
	}


	$sql2 = "SELECT `route_type` FROM `planning` WHERE `car_id` = '".$car_id."' AND `date` < '".$date."' ORDER BY `plan_id` ASC LIMIT 1 ;";
	$exe2 = mysqli_query($conn,$sql2);
	$count2 = mysqli_num_rows($exe2);
	if($count2 > 0){
		$row2 = mysqli_fetch_assoc($exe2);
		$car['route_type'] = $row2['route_type'];

	}else{
		$car['route_type'] = 'NA';
	}


	array_push($result, $car);
}

//echo'<pre>';
print_r($result);
//echo'</pre>';

?>
<?php

date_default_timezone_set("Asia/Kolkata");

if(isset($_GET['date'])){
	$date = $_GET['date'];
	$car_id = $_GET['car_id'];
	$shift = $_GET['shift'];

	if ($date == 'today') {
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
	}

	include '../../query/conn.php';

	// $sql="SELECT a.route_id 
	// 	  FROM `routes` a
	// 	  JOIN `operations` b ON a.name = b.a_route
	// 	  WHERE b.car_id = '".$car_id."'  AND b.date = '".$date."' ;";

	// $query=mysqli_query($conn,$sql);
	// $row=mysqli_fetch_assoc($query);
	// $route_id = $row['route_id'];

	$json = array();

	$temp_file = '../../gps/'.$date.'/'.$car_id.'/'.$shift.'.txt';

	if (file_exists($temp_file)) {
		$f = fopen($temp_file, "r");
			while(!feof($f)) { 
				$location =array();
				$data = explode(";", rtrim(fgets($f),"\r\n"));

				$location['type']   	= $data[0];
				$location['lat']    	= $data[1];
				$location['lon']		= $data[2];
				$location['speed']  	= $data[3];
				$location['time']   	= $data[4];
				$location['e_id']		= $data[6];
				$location['route_id']	= 5;

				if (($data[0]== '')||($data[1]== '')||($data[2]== '')||($data[3]== '')||($data[4]== '')) {
						# code...
				}else{
					array_push($json,$location);
				}		
			}
		fclose($f);
	}

		echo json_encode($json);
}	
?>
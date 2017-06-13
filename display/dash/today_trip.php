<?php 
 require 'query/conn.php';


date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = time("Y-m-d H:i:s");

// $prob_report = "SELECT COUNT(`prob_id`) as 'problems' FROM `problems` where `open_date` = '".$date."'";
	$trip = "SELECT SUM(`trip`) as 'trip' FROM `operations` WHERE `date`= '2016-11-04'";

	$trip_result = mysqli_query($conn,$trip);
	$trip_rows = mysqli_num_rows($trip_result);

	if($trip_rows > 0){
		
		$trip_exe = mysqli_fetch_assoc($trip_result);
        $trip =  $trip_exe['trip'] ;
		if($trip == null){
			echo $trip = 0;
		}
		else{
			echo $trip =  $trip_exe['trip'] ;
		}	 

	}
	else{
		echo $trip = 0;
	}
?>
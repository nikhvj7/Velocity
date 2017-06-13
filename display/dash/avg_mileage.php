

<?php 
 require 'query/conn.php';


date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = time("Y-m-d H:i:s");

// $prob_report = "SELECT COUNT(`prob_id`) as 'problems' FROM `problems` where `open_date` = '".$date."'";
	$mileage = "SELECT AVG(`mileage`) as 'mileage' FROM `operations` WHERE `date` = '2016-11-27'";
	$mileage_result = mysqli_query($conn,$mileage);
	$mileage_rows = mysqli_num_rows($mileage_result);

	if($mileage_rows > 0){

		$mileage_exe = mysqli_fetch_assoc($mileage_result);
		$mileage =  $mileage_exe['mileage'] ;
		if($mileage == null){
			echo $mileage = 0;
		}else{
			echo $mileage = round($mileage);
		}
		//echo $mileage = round($mileage);
	}
	else{
		echo $mileage = 0;
	}
?>
<?php 
 require 'query/conn.php';


date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = time("Y-m-d H:i:s");

// $prob_report = "SELECT COUNT(`prob_id`) as 'problems' FROM `problems` where `open_date` = '".$date."'";
	$prob_report = "SELECT COUNT(`prob_id`) as 'problems' FROM `problems` where `open_date` ='2016-11-16'";
	$prob_result = mysqli_query($conn,$prob_report);
	$prob_rows = mysqli_num_rows($prob_result);

	if($prob_rows > 0){
		$prob_exe = mysqli_fetch_assoc($prob_result);
		echo $prob_exe['problems'] ;
	}
	else{
		echo $problems = 0;
	}
?>
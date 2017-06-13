<?php
require 'query/conn.php';
	
	date_default_timezone_set("Asia/Kolkata");
	 $date = date("Y-m-d");


	$sql = " SELECT COUNT(`prob_id`) FROM `problems` WHERE  `open_date` = '".$date."' ;";
	$exe = mysqli_query($conn,$sql);
	while ( $row = mysqli_fetch_assoc($exe) ) {
		$problems = $row['COUNT(`prob_id`)'];
	}

	$sql = " SELECT COUNT(`att_id`) FROM `attendance` WHERE  `date` = '".$date."' ;";
	$exe = mysqli_query($conn,$sql);
	while ( $row = mysqli_fetch_assoc($exe) ) {
		$attendance = $row['COUNT(`att_id`)'];
	}

	$sql = " SELECT MAX(`mileage`) FROM `operations` WHERE  `date` = '".$date."' ;";
	$exe = mysqli_query($conn,$sql);
	while ( $row = mysqli_fetch_assoc($exe) ) {
		$mileage = $row['MAX(`mileage`)'];
	}

	$sql = " SELECT SUM(`trip`) FROM `operations` WHERE  `date` = '".$date."' ;";
	$exe = mysqli_query($conn,$sql);
	while ( $row = mysqli_fetch_assoc($exe) ) {
		 $trip = $row['SUM(`trip`)'];
	}

?>
<?php
require '../../query/conn.php';
	
if (isset($_GET['date'])) {

	$date  = $_GET['date'];

	if ($date == 'today') {
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
	}

	$sql = " SELECT `count`,`description`,`shift`
			FROM `notifications` WHERE date(`time_stamp`) = '".$date."'
			ORDER BY `notif_id` DESC;";
	$exe = mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($exe) < 1) {
		echo '<div class="notification_single">No data found for '.$date.'</div>';
	}else{
		while ( $row = mysqli_fetch_assoc($exe) ) {
			echo '<div class="notification_single">'.$row['count'].' '.$row['description'].' For SHIFT '.strtoupper($row['shift']).'</div>';			
		}
	}
}

?>
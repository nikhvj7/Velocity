<?php
require '../../query/conn.php';
	
if (isset($_GET['shift'])) {

	$shift = $_GET['shift'];
	$date  = $_GET['date'];

	if ($date == 'today') {
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
	}



	$sql = " SELECT a.route,a.tracking,a.su_id,b.gqg_no,c.f_name,c.l_name
			FROM `operations` a 
			JOIN `cars` b ON a.car_id = b.car_id
			JOIN `employees` c on a.su_id = c.e_id
			WHERE a.shift = '".$shift."' 
			AND a.date = '".$date."'
			ORDER BY a.route;
			;";
	$exe = mysqli_query($conn,$sql);
	
	$route = NULL;

	$su_id = null;

	while ( $row = mysqli_fetch_assoc($exe) ) {
		
		if ( ($route != $row['route']) && ($su_id != $row['su_id']) ){
			echo '<div class="route_name">'.ucwords($row['route']).'<span class="su_name">'.$row['f_name'].' '.$row['l_name'].'<span></div>';
			$route = $row['route'];
			$su_id = $row['su_id'];
		}
		
		echo '<div class="gqg_no"><a href="cars_single.php">'.$row['gqg_no'].'</a></div>';
	}
}

?>
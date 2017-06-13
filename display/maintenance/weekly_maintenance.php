<?php
require '../../query/conn.php';

if (isset($_GET['date1'])) {

	$date1 		= $_GET['date1'];
	$date2 		= $_GET['date2'];
	$comp_id 	= $_GET['comp_id'];
	$comp_name 	= $_GET['comp_name'];


	$sql = "SELECT a.*, b.gqg_no, b.tcf
			FROM `maintenance` a 
			JOIN `cars` b
			ON a.car_id = b.car_id
			WHERE b.comp_id = '" . $comp_id . "' 
			AND a.date BETWEEN '" . $date1 . "' AND '" . $date2 . "'
			ORDER BY `date` DESC,a.car_id;";
	$exe = mysqli_query($conn, $sql);

	if (mysqli_num_rows($exe) > 0) {

		echo '<div class="show_display">';
		echo '<div class="inline maintenance_gqg header">'.strtoupper($comp_name).' CARS</div>';
		echo '</div>';


		echo '<div class="show_display">';
		echo '<div class="inline maintenance_gqg header">GQG NO</div>';
		echo '<div class="inline maintenance_date header">DATE</div>';
		echo '<div class="inline header"></div>';
		echo '</div>';



		$date   = null;
		$car_id = null;

		while ($row = mysqli_fetch_assoc($exe)) {


			if ((($date == null) && ($car_id == null)) || (($date != $row['date']) || ($car_id != $row['car_id']))) {

				$gqg_no = $row['gqg_no'];
				$car_id = $row['car_id'];
				$date   = $row['date'];
				$date_f = date('jS M y', strtotime($date));


				echo '<div class="show_row" r_id="' . $car_id . '" gqg_no = "' . $gqg_no . '" date ="' . $date . '" >';
				echo '<div class="inline maintenance_gqg">' . $gqg_no . '</div>';
				echo '<div class="inline maintenance_date">' . $date_f . '</div>';
				echo '</div>';
			}
		}
	}

	// no data found
	else {
		echo '<h4>No Maintenance Jobs Found</h4>';
	}

} else {
	echo '<p>Param Error</p>';
}


?>

<?php

require '../../query/conn.php';

if(isset($_GET['comp_id'])){

	$comp_id 	= $_GET['comp_id'];
	$comp_name 	= $_GET['comp_name'];
	

	$sql = "SELECT `car_id`,`gqg_no`, `tcf` FROM `cars` WHERE `status` = 'active' AND `comp_id` = '".$comp_id."';";
	$exe = mysqli_query($conn,$sql);

	if(mysqli_num_rows($exe) > 0){


		echo '<div class="car_list_header">';
		echo 'NEW '.strtoupper($comp_name).' SERVICE';
		echo '</div>';


		echo '<div class="car_list_header">';
			echo '<div style="float:left">';
				echo '<div class="inline car_list_gqg header">GQG</div>';
				echo '<div class="inline car_list_tcf header">TCF</div>';
			echo '</div>';
			echo '<div style="float:right" class="display_cancel"></div>';

		echo '</div>';

		while($row = mysqli_fetch_assoc($exe)) {
			$car_id 	= $row['car_id'];
			$gqg_no 	= $row['gqg_no'];
			$tcf 		= $row['tcf'];

			echo '<div class="car_list_show_row" car_list_car_id="'.$car_id.'">';
				echo '<div class="inline car_list_gqg">'.$gqg_no.'</div>';
				echo '<div class="inline car_list_tcf">'.$tcf.'</div>';
			echo '</div>';

		}
	}

	// no data found
	else{
		echo '<h4>No Cars Found</h4>';
	}

}
else{
	echo '<p>Param Error</p>';
}

?>
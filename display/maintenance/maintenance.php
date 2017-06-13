<?php

	require '../../query/conn.php';

	$sql = "SELECT a.*,b.car_id, b.gqg_no, b.tcf
			FROM `maintenance` a 
			LEFT JOIN `cars` b
			ON a.car_id = b.car_id
			WHERE 1 
			ORDER BY `date` DESC,a.car_id;";
	$exe = mysqli_query($conn,$sql);

	if(mysqli_num_rows($exe) > 0){


		echo '<div class="show_row">';
			echo '<div class="inline maintenance_gqg header">GQG NO</div>';
			echo '<div class="inline maintenance_date header">DATE</div>';			
			echo '<div class="inline header"></div>';
		echo '</div>';

		$date = null;
		$car_id = null;

		while($row = mysqli_fetch_assoc($exe)) {
			

			if(
				(($date == null)&&($car_id == null)) ||
				(($date != $row['date'])||($car_id != $row['car_id']))
			){

				$gqg_no 	= $row['gqg_no'];
				$car_id 	= $row['car_id'];
				$date 		= $row['date'];
				$date_f		= date('jS M y',strtotime($date));
				$date       = $date = date("Y-m-d");


				echo '<div class="show_row" r_id="'.$car_id.'" gqg_no = "'.$gqg_no.'" date ="'.$date.'" >';
					echo '<div class="inline maintenance_gqg">'.$gqg_no.'</div>';
					echo '<div class="inline maintenance_date">'.$date_f.'</div>';				
				echo '</div>';
			}
				

		}
	}
 
	// no data found
	else{
		echo '<h4>No Maintenance Jobs Found</h4>';
	}



			if(
				(($date == null)&&($car_id == null)) || 
				(($date != $row['date'])&&($car_id != $row['car_id']))
			) {
				
				$gqg_no 	= $row['gqg_no'];
				$car_id 	= $row['car_id'];
				$date 		= $row['date'];
				$date_f		= date('jS M y',strtotime($date));

				echo '<div class="show_row" r_id="'.$car_id.'">';
					echo '<div class="inline maintenance_gqg">'.$gqg_no.'</div>';
					echo '<div class="inline maintenance_date">'.$date_f.'</div>';				
				echo '</div>';
			}
?>
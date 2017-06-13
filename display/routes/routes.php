<?php

require '../../query/conn.php';

	$sql = "SELECT * FROM `routes`;";
	$exe = mysqli_query($conn,$sql);

	if(mysqli_num_rows($exe) > 0){


		echo '<div class="show_row">';
			echo '<div class="inline route_name header">ROUTE</div>';
			echo '<div class="inline route_type header">TYPE</div>';
			echo '<div class="inline route_max_km header">MAX SPEED</div>';
			echo '<div class="inline header"></div>';
		echo '</div>';

		while($row = mysqli_fetch_assoc($exe)) {
			$route_name 	= $row['name'];
			$route_category = $row['category'];
			$max_km 		= $row['max_km'];
			$route_id 		= $row['route_id'];

			echo '<div class="show_row" r_id="'.$route_id.'">';
				echo '<div class="inline route_name">'.$route_name.'</div>';
				echo '<div class="inline route_type">'.$route_category.'</div>';
				echo '<div class="inline route_max_km">'.$max_km.'</div>';
				echo '<div class="inline more_icon edit" id='.$route_id.'></div>';
			echo '</div>';

		}
	}
 
	// no data found
	else{
		echo '<h4>No Routes Added</h4>';
	}




?>
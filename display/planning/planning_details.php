<?php
require '../../query/conn.php';
if (isset($_GET['car_id']) && (isset($_GET['gqg']))) {
	$car_id = $_GET['car_id'];

	$gqg = $_GET['gqg'];
	$route = 0;

	// check if planning data exists
	$sql = "SELECT * FROM `planning` WHERE `car_id` = '".$car_id."';";
	$exe = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($exe);

	if($num_rows > 0){

		echo '<div id="approval_center_div">';
			echo '<div id="holder">';
				echo '<div class="inline_tall input">';
					echo '<div class="gqg">'.$gqg.'</div>';
				echo '</div>';

				while($row = mysqli_fetch_assoc($exe)){
					$route_type = $row['route_type'];
					$date 		= $row['date'];
					$target_km	= $row['target_km'];
					$daily_km	= $row['daily_target'];

					$exp = explode("-", $date);					
					$display_date = ltrim($exp[1], '0')."/".ltrim($exp[2], '0');

					echo '<div class="inline_tall">';
						echo '<div class="route_details">';
							echo '<div class="r_name">'.$route_type.'</div>';
							echo '<div>'.$display_date.'</div>';
							echo '<input type="hidden" class="r_date" value="'.$date.'">';
							echo '<input type="hidden" class="r_total" value="'.$target_km.'">';
							echo '<input type="hidden" class="r_daily" value="'.$daily_km.'">';
						echo '</div>';
					echo '</div>';
				}


			echo '</div>';

			echo '<div id="chart_div"></div>';
		echo '</div>';
	}
	else{
		echo'<div id="approval_center_div">';
			// echo'<div id="approval_center_header">NO DATA</div>';
			echo '<div id="holder">';
				echo '<div class="inline_tall input">';
					echo '<div class="gqg">'.$gqg.'</div>';
				echo '</div>';

				echo '<div style="clear: both;"></div>';
				echo '<div class="inline input">';

					echo '<select>';
						echo '<option>Select Route</option>';
	                        $sql1 = "SELECT DISTINCT(`category`) FROM `routes` WHERE 1;";
	                        $exe1 = mysqli_query($conn, $sql1);
	                            
	                        while($result=mysqli_fetch_assoc($exe1)){
	                        	echo '<option value="1">'.ucwords($result['category']).'</option>';
	                        }
	                    
	                    echo '<option>EMISSION</option>';    
						echo '<option>END</option>';
					echo '</select>';
				echo '</div>';

				echo '<div class="inline input"><input type="date" class="date"></div>';
				echo '<div style="clear: both;"></div>';

				echo '<div id="km_details_html">';
					echo '<div class="inline input"><input type="number" name="" class="input_total" placeholder="Total km"></div>';
					echo '<div class="inline input"><input type="number" name="" class="input_daily" placeholder="Daily km"></div>';
				echo '</div>';

				echo '<div id="emissions_html">';
					echo '<div style="clear: both;"></div>';
					echo '<div class="inline input"><input type="number" name="" class="emission_days" placeholder="Number of Days"></div>';
				echo '</div>';

				echo '<div style="clear: both;"></div>';
				echo '<div class="inline btn s_btn"><button class="save_btn">Save</button></div>';
				echo '<div class="inline btn up_btn"><button class="">Update</button></div>';
				echo '<div class="inline btn up_btn"><button class="cancel_btn">Cancel</button></div>';
				echo '<div class="inline btn up_btn"><button class="remove_btn">Remove</button></div>';
			echo '</div>';

			echo '<div id="chart_div"></div>';
		echo'</div>';
	}


}
else{
	// isset error
	echo'<div id="approval_center_div">';
	echo '<p>Error</p>';
	echo'</div>';
}





?>
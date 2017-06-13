<?php 


require '../../query/conn.php';

if(isset($_GET['car_id'])){
	
	$car_id = $_GET['car_id'];
	$gqg 	= $_GET['gqg_no'];	
	$date 	= $_GET['date'];	

	$header = 0;

	$sql = "SELECT * FROM `maintenance` WHERE `car_id` = '".$car_id."' AND `date` = '".$date."' ;";	
 	$result = mysqli_query($conn,$sql);
 	$num = mysqli_num_rows($result);
 	
 	echo'<div class="car_list_header" style="color:rgba(0,0,0,0.6);">MAINTENANCE DETAILS
 		<button id="week_report" car_id = '.$car_id.' gqg_no='.$gqg.' date = '.$date.' >Report</button>
 	</div>';

	echo'<div class="car_list_header" new_job_car_id="'.$car_id.'">'.$gqg.' 			
 		 	<div style="float:right" class="display_cancel"></div> 		
 		</div>';		

 	if($num > 0){
 		echo '<div id="job_card">';

 		
			while($row = mysqli_fetch_assoc($result)) {
				$type = $row['type'];
				$date = $row['date'];
				$job_id = $row['job_id'];
				$sr_name = $row['sr_name'];
				// $quantity = $row['quantity'];
				$mechanic = $row['mechanic'];
				$odo = $row['odo_reading'];
				$observations = $row['observations'];


				//find job name/number based on type
				// $job_name = '';
				// $job_number = 'WRT54gG';

				if($type=='service'){
					// $job_name = 'service';
					

					$service = "SELECT * FROM `service_menu` WHERE `s_id` = '".$job_id."'";
					$service_result = mysqli_query($conn,$service);
					$service_exe = mysqli_fetch_assoc($service_result);
					$job_name = $service_exe['name'];
					$job_number =$service_exe['sr_num'];
					$quantity = $row['quantity'];

				}else{

					$part = "SELECT * FROM `parts_menu` WHERE `prt_id` = '".$job_id."'";
					$part_result = mysqli_query($conn,$part);
					$part_exe = mysqli_fetch_assoc($part_result);
					$job_name = $part_exe['part_description'];
					$job_number =$part_exe['part_no'];
					$quantity = $row['quantity'];
				}

				
				if ($header == 0) {

	 				//echo'<div>'.$observations.'</div>';
	 				echo '<div class="show_display">';
						echo '<div class="inline maintenance_date header">SERVICE NAME</div>';
						echo '<div class="inline maintenance_date header">ODO READING</div>';
						echo '<div class="inline maintenance_date header">MECHANIC</div>';
						echo '<div class="inline maintenance_date header">DATE</div>';
					echo '</div>';

	 				echo '<div class="show_display">';
						echo '<div class="inline maintenance_date">'.$sr_name.'</div>';
						echo '<div class="inline maintenance_date">'.$odo.'</div>';
						echo '<div class="inline maintenance_date">'.$mechanic.'</div>';
						echo '<div class="inline maintenance_date">'.$date.'</div>';
					echo '</div>';

	 				echo '<div class="show_display">';
						echo '<div class="inline maintenance_date header m_disp_sr_no">Sr.No</div>';
						echo '<div class="inline maintenance_date header m_disp_job_name">Item NAME</div>';
						echo '<div class="inline maintenance_date header m_disp_job_number">NUMBER</div>';
						echo '<div class="inline maintenance_date header m_disp_quantity">QUANTITY</div>';
						echo '<div class="inline maintenance_date header m_disp_type">TYPE</div>';
					echo '</div>';
	 			}
	 			$header++;

	 			

				echo '<div class="show_row">';
					echo '<div class="inline maintenance_date m_disp_sr_no">'.$header.'</div>';
					echo '<div class="inline maintenance_date m_disp_job_name">'.$job_name.'</div>';
					echo '<div class="inline maintenance_date m_disp_job_number">'.$job_number.'</div>';
					echo '<div class="inline maintenance_date m_disp_quantity">'.$quantity.'</div>';
					echo '<div class="inline maintenance_date m_disp_type">'.$type.'</div>';				
				echo '</div>';
			}

 		echo'</div>';

 	}
 	// <div class="mat_btn display_cancel" style="margin-left: 24px;">CANCEL</div>
}

	





// single row for reference
//
// <div class="new_job_show_row">
// 	<div class="new_job_field">Some data</div>
// 	<div class="new_job_part_no">YUUUHH</div>
// 	<div class="new_job_field">Some Category</div>
// 	<div class="new_job_field"><input type="text" value="100" class="new_job_input"></div>
// </div>
//


// if isset error
else{
	echo '<div style="padding:15px;color:red;">Looks like something went wrong!</div>';
}



?>
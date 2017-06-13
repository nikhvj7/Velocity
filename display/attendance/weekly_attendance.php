<?php 
require '../../query/conn.php';
if (isset($_GET['date1'])) {

	
	$date1 = $_GET['date1'];
	$date2 = $_GET['date2'];

	$comp_name = $_GET['comp_name'];
	
	$comp_id = $_GET['comp_id'];
	$week_num = $_GET['week_num'];

	// if ($date == 'today') {
	// 	date_default_timezone_set("Asia/Kolkata");
	// 	$date = date("Y-m-d");
	// }

	$sql = "SELECT a.*,b.f_name,b.l_name 
			FROM `attendance` a 
			JOIN `employees` b 
			ON a.e_id = b.e_id 
			WHERE `comp_id` = '".$comp_id."'
			AND `date` BETWEEN '".$date1."' AND '".$date2."' 
			ORDER by `date`,`shift`,`designation`";

	$exe = mysqli_query($conn,$sql);

	if(mysqli_num_rows($exe) > 0){


				
		echo '<div>';
		echo '<a style="color:green;" href="PHPExcel/weekly_attendance_summary.php?date1='.$date1.'&date2='.$date2.'&comp_id='.$comp_id.'&comp_name='.$comp_name.'&week_num='.$week_num.'">Download Report</a>';
		echo '<table>';

		echo '<tr>';
		echo '<td>'.$comp_name.'</td>';
		echo '<td>'.$date1.' to '.$date2.'</td>';
		echo '</tr>';

		$shift = null;
		$date = null;
		
		while($row = mysqli_fetch_assoc($exe)) {
			
			// echo '<pre>';
			// print_r($row);
			// echo '</pre>';

			$name = $row['f_name']." ".$row['l_name'];			
			$designation = $row['designation'];
			$status = $row['status'];
			

			// date header
			if(($date == null) || ($date != $row['date'])){
				$date = $row['date'];
				echo '<tr>';
				echo '<td style="color:blue;">'.$date.'</td>';				
				echo '</tr>';
			}

			// shift header
			if(($shift == null) || ($shift != $row['shift'])){
				$shift = $row['shift'];
				echo '<tr>';
				echo '<td style="color:red;">Shift '.strtoupper($shift).'</td>';				
				echo '</tr>';
			}

			echo '<tr>';
			echo '<td>'.$name.'</td>';			
			echo '<td>'.$designation.'</td>';
			echo '<td>'.$status.'</td>';
			echo '</tr>';
		}

		// echo '</table>';
		// echo '</div>';
	}else{
		echo'No Data Found';
	}			

}//if isset function


?>
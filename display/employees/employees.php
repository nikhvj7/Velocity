<?php

	require '../../query/conn.php';
	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");

	function getEmployees(&$conn, $type){

		$result = null;

		$sql = 	"SELECT * FROM `employees` 
				WHERE `status` = '".$type."' 
				ORDER BY `status` ASC, `access`, `emp_id`;";

		$exe = mysqli_query($conn,$sql);
		if(mysqli_num_rows($exe) > 0){
			$result = array();
			while($row = mysqli_fetch_assoc($exe)){
				$result[] = $row;
			}
		}

		return $result;
	}

	function renderHTML($result, $type){


		//header
		echo '<div class="show_row">';
			echo '<div class="inline emp_id header">EMP ID</div>';
			echo '<div class="inline emp_name header">NAME</div>';
			echo '<div class="inline emp_type header">ROLE</div>';
			echo '<div class="inline emp_ph_no header">PHONE</div>';
			echo '<div class="inline header"></div>';
		echo '</div>';

		for($i=0;$i<sizeof($result);$i++){
			// show row
			$full_name 	= $result[$i]['f_name'].' '.$result[$i]['l_name'];
			$e_id 		= $result[$i]['e_id'];
			$emp_id 	= $result[$i]['emp_id'];
			$phone_no	= $result[$i]['phone_no'];

			// toggle row
			$access 		= strtoupper($result[$i]['access']);
			$designation 	= strtoupper($result[$i]['designation']);	
			$b_date 		= $result[$i]['b_date'];
			$address 		= strtoupper($result[$i]['address']);
			
			// 2nd
			$e_mail  		= $result[$i]['e_mail'];
			$license  		= $result[$i]['license'];
			$barcode 		= $result[$i]['barcode'];
			$attendance_count 	= $result[$i]['attendance_count'];			

			echo '<div class="parent_row">';
				echo '<div class="show_row">';
					echo '<div class="inline emp_id">'.$emp_id.'</div>';
					echo '<div class="inline emp_name">'.$full_name.'</div>';
					echo '<div class="inline emp_type">'.$access.'</div>';
					echo '<div class="inline emp_ph_no">'.$phone_no.'</div>';
					echo '<div class="inline more_icon"></div>';
				echo '</div>';

				echo '<div class="toggle_row">';
					echo '<div class="inline_3">';
						echo '<div class="inline name">ADDRESS</div>';
						echo '<div class="inline val">'.$address.'</div>';

						echo '<div class="inline name">E MAIL</div>';
						echo '<div class="inline val">'.$e_mail.'</div>';
					echo '</div>';

					echo '<div class="inline_3">';
						echo '<div class="inline name">BARCODE</div>';
						echo '<div class="inline val">'.$barcode.'</div>';

						echo '<div class="inline name">DESIGNATION</div>';
						echo '<div class="inline val">'.$designation.'</div>';
						
					echo '</div>';

					echo '<div class="inline_3">';
						echo '<div class="inline name">BIRTHDAY</div>';
						echo '<div class="inline val">'.$b_date.'</div>';

						echo '<div class="inline name">LICENSE</div>';
						echo '<div class="inline val">'.$license.'</div>';
					echo '</div>';

					echo '<div class="spacer edit" id='.$e_id.'><span>Edit</span></div>';
				echo '</div>';
			echo '</div>';
		}
	}
	

if(isset($_GET['type'])){

	$type = $_GET['type'];

	$result = getEmployees($conn, $type);
	if($result != null){

		// Debug
		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';

		renderHTML($result, $type);			
	}
	// No results
	else{
		echo '<div class="no_emps_found">No Employees Found</div>';
	}
}
// if isset error
else{
	echo '<div class="no_emps_found">Unexpected Error</div>';	
}


?>

<?php 
require '../../query/conn.php';

if (isset($_GET['e_id'])) {
	
	$e_id = $_GET['e_id'];

	$sql = "SELECT a.*,b.f_name,b.l_name,b.access
			FROM `attendance` a 
			JOIN `employees` b ON a.e_id = b.e_id 
			WHERE a.e_id = 63 
			ORDER BY a.date DESC,a.shift";

	$exe = mysqli_query($conn,$sql);

	if(mysqli_num_rows($exe) > 0){


				
		echo '<div>';
		echo '<table>';

		// echo '<tr>';
		// echo '<td>'.$company_name.'</td>';
		// echo '<td>'.$date.'</td>';
		// echo '</tr>';
		
		$t_counter = 0;
		$p_counter = 0;
		$a_counter = 0;

		while($row = mysqli_fetch_assoc($exe)) {
			
			// echo '<pre>';
			// print_r($row);
			// echo '</pre>';

			$name = $row['f_name']." ".$row['l_name'];
			
			$designation = $row['access'];
			$status = $row['status'];
			$shift = $row['shift'];
			$date = $row['date'];

			if($t_counter == 0){
				echo '<tr>';
				echo '<td>'.$name.'</td>';
				echo '</tr>';

				echo '<tr>';
				echo '<td>'.$designation.'</td>';
				echo '</tr>';
			}

			if($status == "present"){
				++$p_counter;
			} else {
				++$a_counter;
			}
			++$t_counter;



			echo '<tr>';
			echo '<td>'.$date.'</td>';
			echo '<td>'.$status.'</td>';
			echo '<td>'.$shift.'</td>';
			echo '</tr>';
		}

		echo '<tr>';
		echo '<td>Total</td>';
		echo '<td>'.$t_counter.'</td>';		
		echo '</tr>';

		echo '<tr>';
		echo '<td>Present</td>';
		echo '<td>'.$p_counter.'</td>';		
		echo '</tr>';

		echo '<tr>';
		echo '<td>Absent</td>';
		echo '<td>'.$a_counter.'</td>';		
		echo '</tr>';

		echo '</table>';
		echo '</div>';
	}else{
		echo'No Data Found';
	}			

}//if isset function


?>
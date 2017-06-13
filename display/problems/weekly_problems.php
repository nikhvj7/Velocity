<?php
require '../../query/conn.php';

if( (isset($_GET['date1'])) && (isset($_GET['date2'])) && (isset($_GET['comp_id'])) ){

    
	$date1 		= $_GET['date1'];	
	$date2 		= $_GET['date2'];	
	$comp_id 	= $_GET['comp_id'];
	$comp_name 	= $_GET['comp_name'];

	

	$sql_cars = "SELECT DISTINCT(a.car_id),b.gqg_no
				FROM `problems` a 
				JOIN `cars` b 
				ON a.car_id = b.car_id
				WHERE a.comp_id = '".$comp_id."'
				AND `open_date` 
				BETWEEN '".$date1."' AND '".$date2."';";

	$exe_cars = mysqli_query($conn,$sql_cars);

	// do a row count here
	if(mysqli_num_rows($exe_cars) > 0){

		// container div for styling
		echo '<div id="problem_table_holder">';

		
		echo '<a href="PHPExcel/problem_report.php?date1='.$date1.'&date2='.$date2.'&comp_id='.$comp_id.'&comp_name='.$comp_name.'">Download weekly Report</a>';

		echo '<table id="prob_table">';

		echo '</tr>';
		echo '<td>GQG NO</td>';		
		echo '<td>Date</td>';		
		echo '<td>Category</td>';
		echo '<td>Description</td>';
		echo '<td>Count</td>';		
		echo '</tr>';


		// get distinct cars and gqg_nos
		while($row_cars = mysqli_fetch_assoc($exe_cars)){
			// echo '<pre>';
			// print_r($row_cars);
			// echo '</pre>';

			$car_id = $row_cars['car_id'];			
			$gqg_no = $row_cars['gqg_no'];
			$comp_id= $_GET['comp_id'];

			// debug
			// echo $car_id;
			// echo $gqg_no;
			// echo '<br/>';

			// get distinct count of problems to render table
			// we need to find rowspan for gqg
			$sql_row_span = "SELECT count(distinct(prob_menu_id))
							FROM  problems
							WHERE `car_id` = ".$car_id." 
							AND `open_date` 
							BETWEEN '".$date1."' AND '".$date2."';";
			$exe_row_span = mysqli_query($conn,$sql_row_span);
			$r_rspan = mysqli_fetch_assoc($exe_row_span);
			$rowspan = $r_rspan['count(distinct(prob_menu_id))'];	



			// sorting problems car-wise
			$sql_probs = "SELECT a.prob_menu_id, a.open_date,a.comp_id ,b.category, b.description		   
						FROM  problems a
						JOIN `problem_menu` b
						ON a.prob_menu_id = b.prob_menu_id
						WHERE `car_id` = ".$car_id."
						AND `open_date` 
						BETWEEN '".$date1."' AND '".$date2."'
						ORDER by b.category,a.prob_menu_id,a.open_date";

			$exe_probs = mysqli_query($conn,$sql_probs);

			

			// get distinct cars and gqg_nos

			$prob_menu_id = null;
			$open_date = null;			
			$counter = 0;
			$tr_check = null;

			
			// foreach problems per car
			while($row_probs = mysqli_fetch_assoc($exe_probs)){

				// debug
				// echo '<pre>';
				// print_r($row_probs);
				// echo '</pre>';

				// this ends the table row
				if( ($prob_menu_id != null) && ($prob_menu_id != $row_probs['prob_menu_id']) ){

					echo '<td class="ptab_right">'.$counter.'</td>';
					echo '</tr>';
				}


				// this starts the table row
				if( ($prob_menu_id == null) || ($prob_menu_id != $row_probs['prob_menu_id']) ){

					$counter = 1;

					$prob_menu_id = $row_probs['prob_menu_id'];
					
					$open_date 	= $row_probs['open_date'];					
					$category 	= $row_probs['category'];
					$description = $row_probs['description'];

					
					if($tr_check == null){
						echo '<tr class="find_tr">';
						echo '<td rowspan="'.$rowspan.'">'.$gqg_no.'</td>';	
						$tr_check = 1;
					}else{
						echo '<tr>';	
					}
					// echo '<td>'.$prob_menu_id.'</td>';
					
					echo '<td>'.$open_date.'</td>';					
					echo '<td>'.$category.'</td>';
					echo '<td>'.$description.'</td>';
					
				}else{
					++$counter;			
				}		
			}// foreach problems per car

			//last row doesnt get fired in loop
			echo '<td class="ptab_right">'.$counter.'</td>';
			echo '</tr>';
			
		}// foreach car

		echo '</table>';
		echo '</div>';
	}// num rows
	else{
		echo 'No data found.';
	}

}// if isset of date1 & date2



?>
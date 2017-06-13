<?php 

	include '../../query/conn.php';

	$sql = "SELECT * FROM `problem_menu`;";
	$info = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($info);

	if($row == 0) { 
		echo'<h4>No Problem Added</h4>';
	}
	else {

		echo '<div class="show_row">';
			echo '<div class="inline category header">CATEGORY</div>';
			echo '<div class="inline description header">DESCRIPTION</div>';
			echo '<div class="inline side_count header">SIDE NO</div>';
			echo '<div class="inline header"></div>';
		echo '</div>';

		while($row = mysqli_fetch_assoc($info)) {

			$category 		= $row['category'];
			$description 	= $row['description'];
			$side_type 		= $row['side_type'];
			$prob_menu_id 	= $row['prob_menu_id'];

			echo '<div class="show_row" r_id="'.$prob_menu_id.'">';
				echo '<div class="inline category">'.$category.'</div>';
				echo '<div class="inline description">'.$description.'</div>';
				echo '<div class="inline side_count">'.$side_type.'</div>';
				echo '<div class="inline more_icon edit" id='.$prob_menu_id.'></div>';
			echo '</div>';
		}		
	}

?>
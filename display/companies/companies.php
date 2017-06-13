<?php 
require '../../query/conn.php';

$sql = "SELECT * FROM `companies`;";
$exe = mysqli_query($conn,$sql);

	//header		
	echo '<div class="show_row">';
		echo '<div class="inline gqg_no header">NAME</div>';
		echo '<div class="inline num_val_small header">CIN</div>';
		echo '<div class="inline num_val_small header">ACT</div>';
		echo '<div class="inline num_val_small header">INACT</div>';
		echo '<div class="inline num_val_small header">COMP</div>';
		echo '<div class="inline num_val header">COMP KM</div>';
		echo '<div class="inline num_val header">REM KM</div>';
		echo '<div class="inline num_val header">TOT KM</div>';
		// echo '<div class="inline num_val header">EDIT</div>';
		 
		// echo '<div class="inline more_icon edit" id='.$route_id.'></div>';
	echo '</div>';

while($row = mysqli_fetch_assoc($exe)){	

	// static row
	$comp_id    = $row['comp_id'];	
	$comp_name 	= $row['name'];
	$comp_name = str_replace("_", " ",$comp_name);
	$comp_name 	= ucwords($comp_name);
	
	$comp_cin 	= $row['cin'];
	$act_cars 	= $row['active_cars'];
	$inact_cars = $row['inactive_cars'];
	$comp_cars  = $row['completed_cars'];
	$comp_km 	= $row['completed_km'];
	$rem_km 	= $row['remaining_km'];
	$tot_km 	= $row['total_km'];

	// values are HARD CODED
		echo '<div class="show_row">';
			echo '<div class="inline gqg_no">'.$comp_name.'</div>';
			echo '<div class="inline num_val_small">'.$comp_cin.'</div>';
			echo '<div class="inline num_val_small">'.$act_cars.'</div>';
			echo '<div class="inline num_val_small">'.$inact_cars.'</div>';
			echo '<div class="inline num_val_small">'.$comp_cars.'</div>';
			echo '<div class="inline num_val">'.$comp_km.'</div>';
			echo '<div class="inline num_val">'.$rem_km.'</div>';
			echo '<div class="inline num_val">'.$tot_km.'</div>';
			echo '<div class="inline more_icon num_val_small edit" id='.$comp_id.' ></div>';
		echo '</div>';

}

?>
<?php

require '../../query/conn.php';

// get distinct cars ids
// where active

$sql = "SELECT `car_id`, `gqg_no` FROM `cars` WHERE `status` = 'active';";
$exe = mysqli_query($conn,$sql);


if(mysqli_num_rows($exe) > 0){

	echo '<table>';
	echo '<tr><td></td><td style="font-size:20px;font-weight:500;height:40px;">Select Cars</td></tr>';
	echo '<tr>';
		echo '<td><div class="check all"></div></td>';
		echo '<td><input type="checkbox" class="hide">All</td>';
	echo '</tr>';	

	while($row = mysqli_fetch_assoc($exe)){

		$gqg_no = $row['gqg_no'];		
		$car_id = $row['car_id'];

		// echo '<div class="car_div"><input class="select_cars" type="checkbox" value="'.$car_id.'">'.$gqg_no.'</div>';

		echo '<tr>';	
			echo '<td><div class="check"></div></td>';
			echo '<td><input type="checkbox" value="'.$car_id.'" class="hide select_cars">'.$gqg_no.'</td>';
		echo '</tr>';
	}

	echo '</table>';
	echo '<div class="mat_btn" id="submit_cars">NEXT</div>';

}else{
	echo 'No data Found';
}


?>
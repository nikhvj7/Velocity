<?php

if(isset($_GET['car_id'])){

	$car_id = $_GET['car_id'];
	$gqg_no	= $_GET['gqg_no'];

	$dir    = '../../uploads/cars/'.$car_id;
	$files = scandir($dir,1);	

	echo '<div class="car_photo_holder">';
		echo $gqg_no;
	echo '</div>';

		foreach ($files as $file) {

			if(($file != '.')&&($file != '..')){
				// echo $file;
				// echo '<br/>';


				echo '<div class="img">';
					echo'<a target="_blank" href="uploads/cars/'.$car_id.'/'.$file.'">';
						echo '<img src="uploads/cars/'.$car_id.'/'.$file.'" alt="'.$file.'" width="500" height="350">';
					echo'</a>';
					echo '<div>'.strtoupper($file).'</div>';

				echo'</div>';	
				
			}
			
		}
	
}else{
	echo '<div>NO data Found</div>';
}



?>
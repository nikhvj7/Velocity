<?php
require '../../query/conn.php';


if (isset($_GET['date'])) {
	$date 		= $_GET['date'];	
	$comp_id 	= $_GET['comp_id'];
	$shift	 	= $_GET['shift'];

	if ($date == 'today') {
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
	}
}


	$sql_car = "SELECT a.car_id,b.gqg_no
                FROM `operations` a 
                JOIN `cars` b 
                ON a.car_id = b.car_id
                WHERE a.comp_id = '".$comp_id."' 
                AND `date`  = '".$date."'
                AND `shift` = '".$shift."' 
                AND `tracking` = 'Y';";
    $exe_car = mysqli_query($conn,$sql_car);
    $count  = mysqli_num_rows($exe_car);

    if($count > 0){

        $i = 0;
        
        // loop each car_id
        while($row_car = mysqli_fetch_assoc($exe_car)){

            $gqg_no = $row_car['gqg_no'];            
            $car_id = $row_car['car_id'];

            echo '<div><a class="car_selector" carid="'.$car_id.'">'.$gqg_no.'</a></div>';

            $i++;

        }// each car

    }// num rows
    
    // handle no data here
    else{
        echo 'No data found';
    }





?>
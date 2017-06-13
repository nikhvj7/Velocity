<?php 
include '../../query/conn.php';
date_default_timezone_set("Asia/Kolkata");

if( (isset($_GET['date1'])) && (isset($_GET['date2'])) ){

    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];    
    $comp_id = $_GET['comp_id'];

    
    // get distinct car_ids
    $sql_car = "SELECT DISTINCT(a.car_id),b.gqg_no
                FROM `problems` a 
                JOIN `cars` b 
                ON a.car_id = b.car_id
                WHERE a.comp_id = '".$comp_id."' 
                AND `open_date` 
                BETWEEN '".$date1."' AND '".$date2."';";
    $exe_car = mysqli_query($conn,$sql_car);

    if(mysqli_num_rows($exe_car) > 0){

        $i = 0;
        
        // loop each car_id
        while($row_car = mysqli_fetch_assoc($exe_car)){

            $gqg_no = $row_car['gqg_no'];            
            $car_id = $row_car['car_id'];

            echo '<div><a href="" pos="'.$i.'">'.$gqg_no.'</a></div>';

            $i++;

        }// each car

    }// num rows
    
    // handle no data here
    else{
        echo 'No data found';
    }

}
	                   
?>
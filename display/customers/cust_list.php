<?php
include '../../query/conn.php';
date_default_timezone_set("Asia/Kolkata");

	$sql =	"SELECT * FROM `customers` WHERE 1 ;";
	echo '<div id="car_list">';
	$info=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($info);
	if($count==0){
      echo '<div class="car_list_single" >ADD A CUSTOMER</div>';
    }else{

		while($row = mysqli_fetch_assoc($info)){
			echo '<div class="car_list_single" id="'.$row['id'].'">'.strtoupper($row['firstname']).'</div>';
		}
	}
	echo'</div>';


?>

<!-- float left -->

      

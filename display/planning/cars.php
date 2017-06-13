<?php
include '../../query/conn.php';
date_default_timezone_set("Asia/Kolkata");

if (isset($_GET['comp_id'])) {
    $comp_id = $_GET['comp_id'];


    $sql =  "SELECT `car_id`, `gqg_no`, `tcf` FROM `cars` WHERE `comp_id` = '".$comp_id."';";

    $info=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($info);
    if($count==0){
      echo '<div class="car_list_single" >NO DATA</div>';
    }else{

        while($row = mysqli_fetch_assoc($info)){
            echo '<div class="car_list_single" id="'.$row['car_id'].'">'.strtoupper($row['gqg_no']).'</div>';
        }
    }
}

?>

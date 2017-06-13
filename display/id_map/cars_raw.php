<?php 

  require '../../query/conn.php';

  $global_array  = array();

  $sql = "SELECT * FROM `cars` WHERE `car_id` NOT IN(5) ORDER BY `status` ASC ;";
  $exe = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($exe)){

    $local_array = array();
    $gqg_no 	= $row['gqg_no'];
    $cur_km 	= $row['current_km'];
    $tot_km 	= $row['total_km'];    

    $per_comp 	= round( ( ($cur_km / $tot_km) * 100 ), 2);

    // 100 - 70
    if($per_comp >= 70){
      $color = "color:#00A2E8";
    }
    // 70 - 25
    else if( ($per_comp > 25) && ($per_comp < 70) ){
      $color = "color:#6234D8";
    }
    // 25 - 0
    else{
      $color = "color:#EC1E7A";
    }    


    $local_array['gqg_no'] = $gqg_no;
    $local_array['per_comp'] = $per_comp;
    $local_array['color'] = $color;

    array_push($global_array,$local_array);        


  }

  echo json_encode($global_array);




?>
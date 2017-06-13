<?php 

include '../../query/conn.php';
date_default_timezone_set("Asia/Kolkata");

if(isset($_GET['date1'])){

    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];
    $comp_id = $_GET['comp_id'];

    $shift_array = ["a","b","c"];

    // construct week array for data checks
    // first value
    $week_array = array();
    $date1_copy = date ("Y-m-d", strtotime($date1));
    array_push($week_array,$date1);

    // loop through remaining dates
    while (strtotime($date1_copy) < strtotime($date2)) {

        $date1_copy = date ("Y-m-d", strtotime("+1 day", strtotime($date1_copy)));
        array_push($week_array,$date1_copy);
    }

 

    // get distinct car_ids
    $sql_car = "SELECT DISTINCT b.gqg_no,a.car_id 
                FROM `operations` a
                JOIN `cars` b
                ON a.car_id = b.car_id
                WHERE b.status = 'active' AND a.comp_id = '".$comp_id."' AND a.date BETWEEN '".$date1."' AND '".$date2."' ;";
    $exe_car = mysqli_query($conn,$sql_car);

    if(mysqli_num_rows($exe_car) > 0){

        // test toggle
        // echo '<button id="toggle">Click</button>';

        echo '<div id="week_table_holder">';
        // data exists make table
        echo '<table id="table_id">';

        // table header
        echo '<tr>';
        echo '<td>GQG</td>';
        echo '<td>SHIFT</td>';
        echo '<td>VALS</td>';
        foreach ($week_array as $day) {
            echo '<td>'.$day.'</td>';
        }
        echo '</tr>';


        // loop each car_id
        while($row_car = mysqli_fetch_assoc($exe_car)){


            $gqg_no = $row_car['gqg_no'];
            $car_id = $row_car['car_id'];

            echo '<tr class="find_tr">';
            echo '<td rowspan="3" style="padding: 5px;" >'.$gqg_no.'</td>';

            // loop through each shift per car
            foreach ($shift_array as $shift) {
                
                $sql_shift =    "SELECT * FROM `operations` 
                                WHERE `date` BETWEEN '".$date1."' 
                                AND '$date2' 
                                AND `shift` = '".$shift."' 
                                AND `car_id` = '".$car_id."' ;";
                $exe_shift = mysqli_query($conn,$sql_shift);

                $result = array();
                $count = 0;
                while($row_shift = mysqli_fetch_assoc($exe_shift)){

                    $result[$count]['date'] = $row_shift['date'];
                    $result[$count]['row_data'] = $row_shift;
                    $count++;
                }   

                // echo '<pre>';
                // print_r($result);
                // echo '</pre>';

                // html stuff
                if($shift != "a"){ echo '<tr>'; }               
                echo '<td class="center">'.strtoupper($shift).'</td>';

                echo '<td>';
                    echo '<div class="field_text">Start</div>';
                    echo '<div class="field_text">Stop</div>';
                    echo '<div class="field_text">Trip</div>';
                    echo '<div class="field_text">Fuel</div>';
                    echo '<div class="field_text underline">Mileage</div>';
                    echo '<div class="toggle">';
                        echo '<div class="field_text">S</div>';
                        echo '<div class="field_text">D1</div>';
                        echo '<div class="field_text">D2</div>';
                    echo '</div>';
                echo '</td>';
            
                $counter = 0;
                for ($i=0;$i<sizeof($week_array);$i++) {


                    $found = false;
                    foreach ($result as $key => $data) {                    
                        if ($data['date'] == $week_array[$i]) {
                            $found = true;                            
                            break;
                        }
                    }

                    if ($found === false) {
                        // echo $week_array[$i];
                        // echo '<td class="center" style="width: 80px;background-color: rgb(248,248,248);"></td>';
                        echo '<td class="center" style="width: 80px;"></td>';
                    }else{
                        // echo 'FOUND '.$week_array[$i];                        
                        echo '<td>';
                            echo '<div class="val_text">'.$result[$counter]['row_data']['start'].'</div>';
                            echo '<div class="val_text">'.$result[$counter]['row_data']['stop'].'</div>';
                            echo '<div class="val_text">'.$result[$counter]['row_data']['trip'].'</div>';
                            echo '<div class="val_text">'.$result[$counter]['row_data']['fuel'].'</div>';
                            echo '<div class="val_text underline">'.$result[$counter]['row_data']['mileage'].'</div>';
                            echo '<div class="toggle">';
                                echo '<div class="val_text">N Modi</div>';
                                echo '<div class="val_text">R Gandhi</div>';
                                echo '<div class="val_text">S Gandhi</div>';
                            echo '</div>';
                        echo '</td>';
                        $counter++;
                    }
                }
                echo '</tr>';
            }//each shift
            
        }// each car

        echo '</table>';
        echo '</div>';
    }// num rows
    // handle no data here
    else{
        echo 'No data found';
    }
}                   
?>
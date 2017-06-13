<?php
include '../../query/conn.php';

if (isset($_GET['jsonstring'])) {
    
    
    
    $jsonstring = $_GET['jsonstring'];
    $results    = json_decode($jsonstring);    
    echo'<button id="ex_report">repoert</button>';
    
    
    GLOBAL $all_cars, $all_fields, $fields_val;
    
     $car_val_all    = "all";
     $fields_val_all = "all";
    
    
    $global_date1  = $results->global_date1;   
    $global_date2  = $results->global_date2;   
    $car_array     = $results->car_array;
    $shift_array   = $results->shift_array;
    $select_fields = $results->select_fields;
    

   
    
    
    foreach ($car_array as $cars) {
        $all_cars = $cars;
    }
    foreach ($select_fields as $fields) {
        $all_fields = $fields;
    }
    
    function allResult($conn, $global_date1, $global_date2)
    {
        
        
        $all_sql         = "SELECT b.gqg_no as 'gqg_no',a.* 
                            FROM `operations` a 
                            JOIN `cars` b ON b.car_id = a.car_id 
                            WHERE (date BETWEEN '" . $global_date1 . "' and '" . $global_date1 . "') 
                            LIMIT 2";
        $all_result      = mysqli_query($conn, $all_sql);
        $all_result_rows = mysqli_num_rows($all_result);
        echo $all_result_rows;
        echo '<table style="border:solid 1px black">';
        if ($all_result_rows > 0) {
            echo '<tr style="border:solid 1px black">';
            echo '<th style="border:solid 1px black">GQG NO</th>';
            
            echo '<th style="border:solid 1px black">Date</th>';
            echo '<th style="border:solid 1px black">Shift</th>';
            echo '<th style="border:solid 1px black">Route</th>';
            echo '<th style="border:solid 1px black">Car ID</th>';
            echo '<th style="border:solid 1px black">Su ID</th>';
            echo '<th style="border:solid 1px black">Driver-1</th>';
            echo '<th style="border:solid 1px black">Driver-2</th>';
            echo '<th style="border:solid 1px black">Start</th>';
            echo '<th style="border:solid 1px black">Fuel</th>';
            echo '<th style="border:solid 1px black">Fuel ODO</th>';
            echo '<th style="border:solid 1px black">Stop</th>';
            echo '<th style="border:solid 1px black">Trip</th>';
            echo '<th style="border:solid 1px black">Toll</th>';
            echo '<th style="border:solid 1px black">Clean</th>';
            echo '<th style="border:solid 1px black">Mileage</th>';
            echo '<th style="border:solid 1px black">Tracking</th>';
            echo '<th style="border:solid 1px black">Time In</th>';
            echo '<th style="border:solid 1px black">Time Out</th>';
            
            echo '</tr>';
            $i = 0;
            while ($all_result_exe = mysqli_fetch_assoc($all_result)) {
                $i++;
                echo '<tr style="border:solid 1px black">';
                echo '<td style="border:solid 1px black">' . $all_result_exe['gqg_no'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['date'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['shift'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['route'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['car_id'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['su_id'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['d1'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['d2'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['start'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['fuel'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['fuelodo'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['stop'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['trip'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['toll'] . '</td>';
                
                echo '<td style="border:solid 1px black">' . $all_result_exe['clean'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['mileage'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['tracking'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['time_in'] . '</td>';
                echo '<td style="border:solid 1px black">' . $all_result_exe['time_out'] . '</td>';
                echo '</tr>';
                
            }
        }
        echo '</table>';
    }
    
    
    function allCarsResult($conn, $global_date1, $global_date2, $select_fields)
    {
        
        
        $all_car_sql         = "SELECT b.gqg_no, a.* FROM `operations` a JOIN `cars` b ON b.car_id = a.car_id WHERE (date BETWEEN '" . $global_date1 . "' and '" . $global_date2 . "')LIMIT 2";
        $all_car_result      = mysqli_query($conn, $all_car_sql);
        $all_car_result_rows = mysqli_num_rows($all_car_result);
        // echo $all_car_result_rows;   
        
        if ($all_car_result_rows > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>GQG NO</th>';
            echo '<th>Date</th>';
            foreach ($select_fields as $fields1) {
                echo '<th>' . $fields1 . '</th>';
            }
            echo '</tr>';
            while ($all_car_exe = mysqli_fetch_assoc($all_car_result)) {
                echo '<tr>';
                echo '<td>' . $all_car_exe['gqg_no'] . '</td>';
                echo '<td>' . $all_car_exe['date'] . '</td>';
                foreach ($select_fields as $fields1) {
                    echo '<td>' . $all_car_exe[$fields1] . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            
        }
        
    }
    
    function allFieldsResult($conn, $global_date1, $global_date2, $car_array)
    {
        echo 'We are Looking for  Results...ALL FIELDS...selected CARS ';
        echo '<br />';
        foreach ($car_array as $carr) {
            echo 'alll...selected.....' . $carr;
            echo '<br />';
        }
        
        
        echo '<br />';
        echo '<table>';
        echo '<tr style="border:solid 1px black">';
        echo '<th style="border:solid 1px black">GQG NO</th>';
        echo '<th style="border:solid 1px black">Date</th>';
        echo '<th style="border:solid 1px black">Shift</th>';
        echo '<th style="border:solid 1px black">Route</th>';
        echo '<th style="border:solid 1px black">Car ID</th>';
        echo '<th style="border:solid 1px black">Su ID</th>';
        echo '<th style="border:solid 1px black">Driver-1</th>';
        echo '<th style="border:solid 1px black">Driver-2</th>';
        echo '<th style="border:solid 1px black">Start</th>';
        echo '<th style="border:solid 1px black">Fuel</th>';
        echo '<th style="border:solid 1px black">Fuel ODO</th>';
        echo '<th style="border:solid 1px black">Stop</th>';
        echo '<th style="border:solid 1px black">Trip</th>';
        echo '<th style="border:solid 1px black">Toll</th>';
        echo '<th style="border:solid 1px black">Clean</th>';
        echo '<th style="border:solid 1px black">Mileage</th>';
        echo '<th style="border:solid 1px black">Tracking</th>';
        echo '<th style="border:solid 1px black">Time In</th>';
        echo '<th style="border:solid 1px black">Time Out</th>';
        echo '</tr>';
        
        foreach ($car_array as $cars_val) {
            
            $all_fields_sql = "SELECT b.gqg_no, a.* FROM `operations` a JOIN `cars` b ON b.car_id = a.car_id WHERE (date BETWEEN '" . $global_date1 . "' and '" . $global_date2 . "') and a.car_id IN ('" . $cars_val . "') LIMIT 15";
            
            $all_fields_result      = mysqli_query($conn, $all_fields_sql);
            $all_fields_result_rows = mysqli_num_rows($all_fields_result);
            // echo'roes..'.$all_fields_result_rows;
            
            if ($all_fields_result_rows > 0) {
                
                while ($all_fields_exe = mysqli_fetch_assoc($all_fields_result)) {
                    echo '<tr style="border:solid 1px black">';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['gqg_no'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['date'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['shift'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['route'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['car_id'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['su_id'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['d1'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['d2'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['start'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['fuel'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['fuelodo'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['stop'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['trip'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['toll'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['clean'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['mileage'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['tracking'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['time_in'] . '</td>';
                    echo '<td style="border:solid 1px black">' . $all_fields_exe['time_out'] . '</td>';
                    echo '</tr>';
                    
                }
            }
        }
        echo '</table>';
        
    }
    
    function specific($conn, $global_date1, $global_date2, $car_array, $select_fields)
    {
                       
        echo '<table id="anal_table">';
            echo '<tr>';
                echo '<th>GQG NO</th>';
                echo '<th>Date</th>';
                foreach ($select_fields as $fields2) {
                    echo '<th>' . $fields2 . '</th>';
                }
            echo '</tr>';
            
            foreach ($car_array as $cars_val) {
                            
                $specific_sql = "SELECT b.gqg_no, a.* 
                            FROM `operations` a 
                            JOIN `cars` b ON b.car_id = a.car_id 
                            WHERE (date BETWEEN '" . $global_date1 . "' and '" . $global_date2 . "') 
                            and a.car_id IN ('" . $cars_val . "') LIMIT 15";
                            
                
                $specific_result      = mysqli_query($conn, $specific_sql);
                $specific_result_rows = mysqli_num_rows($specific_result);
                
                $counter = 0;
                $fuel_val = 0;
                $fuelodo  = 0;
                while ($specific_exe = mysqli_fetch_assoc($specific_result)) {
                    $flag = true;
                    echo '<tr>';
                        echo '<td>' . $specific_exe['gqg_no'] . '</td>';
                        echo '<td>' . $specific_exe['date'] . '</td>';
                        foreach ($select_fields as $fields2) {
                            if($fields2 == "driver1"){
                                $fields2 = "d1";
                            }
                            if(($fields2 == "d1")||($fields2 == "fuel")||(($fields2 == "fuelodo"))){

                                if($fields2 == "d1"){
                                    $drive = "";
                                    $drivers = $specific_exe["d1"];                                
                                    $drivers_array = explode("|", $drivers);
                                    foreach ($drivers_array  as  $e_id) {               
                                          $drive = $drive.",".$e_id;
                                          $drive = ltrim($drive, ',');
                                    }
                                    echo '<td>' . $drive . '</td>';
                                }

                                if($fields2 == "fuel"){
                                    $fuel = $specific_exe["fuel"];
                                    $fuel_array = explode("|", $fuel);
                                    foreach ($fuel_array as  $value) {
                                         $fuel_a_a = explode("_", $value);
                                         $fuel_val = $fuel_val+$fuel_a_a[0];
                                         $fuelodo  = $fuelodo + $fuel_a_a[1];
                                    }
                                  echo '<td>' . $fuel_val . '</td>'; 
                                }

                                if($fields2 == "fuelodo"){
                                    
                                  echo '<td>' . $fuelodo . '</td>'; 
                                }

                            }
                            else{
                                echo '<td>' . $specific_exe[$fields2] . '</td>';
                            }

                            
                            
                        }
                        // $counter++;
                        // echo $driv;
                    echo '</tr>';
                }
            }
        echo '</table>';
        
    }
    
    
    if (($all_cars == $car_val_all) && ($all_fields == $fields_val_all)) {
        allResult($conn, $global_date1, $global_date2);
        // echo 'selecting all result;';
    } else if (($all_cars == $car_val_all) && ($all_fields != $fields_val_all)) {
        allCarsResult($conn, $global_date1, $global_date2, $select_fields);
         // echo 'selecting all cars;';
    } elseif (($all_cars != $car_val_all) && ($all_fields == $fields_val_all)) {
         // echo 'selecting all fields;';
        allFieldsResult($conn, $global_date1, $global_date2, $car_array);
    } else {
     // echo 'selecting specific result;';
        specific($conn, $global_date1, $global_date2, $car_array, $select_fields);
    }
    
} //End of Isset Statement


?>
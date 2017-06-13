<?php
require '../../query/conn.php';

date_default_timezone_set("Asia/Kolkata");

if (isset($_GET['comp_id'])) {

    $comp_id = $_GET['comp_id'];
    $date = $_GET['date'];

    if ($date == 0) {
        $date = date('Y-m-d'); 
    }   
    
 
    echo '<div class="show_row">';
        echo '<div class="inline header week_num_header">Project Corrective Action Status On '.$date.'</div>';        
    echo '</div>';

    //form to add new
    echo '<div class="parent_row" style="text-align:center;">';
        
            echo '<div class="inline_3">';
                echo '<div class="inline name">Customer Concern</div>';
            echo '</div>';

            echo '<div class="inline_3">';
                echo '<div class="inline name">Action Taken</div>';
            echo '</div>';

            echo '<div class="inline_3">';
                echo '<div class="inline name">Implementation   Strength</div>';
            echo '</div>';

            //second row
            echo '<div class="inline_3">';
                echo '<div class="inline "><textarea value="" class="concern note"></textarea></div>';
                echo '<div class="inline " style="margin-top:10px;">Next Update <input type="date" class="update" value='.$date.' ></input></div>';
            echo '</div>';

            echo '<div class="inline_3">';
                echo '<div class="inline "><textarea value="" class="action note"></textarea></div>';
                echo '<div class=" " style="margin-left:24px;"><select class="route">';
                        echo '<option value="0" disabled selected>Select Route</option>';
                            $sql1 = "SELECT * FROM `routes` WHERE 1;"; 
                            $exe1 = mysqli_query($conn, $sql1);
                                
                            while($result=mysqli_fetch_assoc($exe1)){
                               // if ($route == $result['route_id'] ) {
                               //     echo '<option value="'.$result['route_id'].'" selected>'.ucwords($result['category']).'</option>'; 
                               // }else{
                                     echo '<option value="'.$result['route_id'].'">'.ucwords($result['category']).'</option>'; 
                               // }
                              
                            } 
                     echo '</select>';
                echo '</div>';
            echo '</div>';

            echo '<div class="inline_3">';

                echo '<div class=" "><textarea value="" placeholder="Implementation Back-up" class="backup note" style="margin-left:24px;height:3a0px;"></textarea></div>';

                echo '<div class=" " style="margin-left:24px;"><select class="strength">';
                        echo '<option value="0" disabled selected>Select Strength</option>';
                            $sel = array(1,2,3,4,5,6);
                            foreach ($sel as $val) {
                                // if ($val == $row['route']) {
                                //      echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                // }else{
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                // }
                            }
                     echo '</select>';
                echo '</div>';  
            echo '</div>';

            echo '<div class="inline_3">';
            echo '</div>';

            echo '<div class="inline_3" style="margin-top:10px;">';
                echo '<div class="show_row" >';
                    echo '<div class="save" style="width:50px;height:auto; margin-left:100px;color:black;">Add</div>';        
                echo '</div>';
            echo '</div>';

            echo '<div class="inline_3">';
            echo '</div>';

            //last row save button      
    echo '</div>';

    //Display old data for the date for each concern

    $sql = "SELECT a.*,b.category,b.name 
            FROM `project_corrections` a
            JOIN `routes` b ON a.route = b.route_id
            WHERE a.date = '".$date."' AND a.comp_id = '".$comp_id."';";
    $exe_car = mysqli_query($conn,$sql);
    $count  = mysqli_num_rows($exe_car);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($exe_car)) {
            echo '<div class="parent_row">';
                echo '<div class="show_row">';
                    echo '<div class="inline more_icon"></div>';
                    echo '<div class="inline name">'.$row['name'].'</div>';          
                echo '</div>'; 

                echo '<div class="toggle_row" style="text-align:center;">';
                    echo '<div class="inline_3">';
                        echo '<div class="inline name">Customer Concern</div>';
                    echo '</div>';

                    echo '<div class="inline_3">';
                        echo '<div class="inline name">Action Taken</div>';
                    echo '</div>';

                    echo '<div class="inline_3">';
                        echo '<div class="inline name">Implementation Strength</div>';
                    echo '</div>';

                    //second row
                    echo '<div class="inline_3">';
                        echo '<div class="inline "><textarea value="" class="concern note">'.$row['concern'].'</textarea></div>';
                        echo '<div class="inline " style="margin-top:10px;">Next Update <input type="date" class="update" value='.$row['next_update'].' ></input></div>';
                    echo '</div>';

                     echo '<div class="inline_3">';
                        echo '<div class="inline "><textarea value="" class="action note">'.$row['action'].'</textarea></div>';
                        echo '<div class=" " style="margin-left:24px;"><select class="route">';
                                echo '<option value="0" disabled selected>Select Route</option>';
                                    $sql1 = "SELECT * FROM `routes` WHERE 1;"; 
                                    $exe1 = mysqli_query($conn, $sql1);
                                        
                                    while($result=mysqli_fetch_assoc($exe1)){
                                       if ($row['route'] == $result['route_id'] ) {
                                           echo '<option value="'.$result['route_id'].'" selected>'.ucwords($result['category']).'</option>'; 
                                       }else{
                                            echo '<option value="'.$result['route_id'].'">'.ucwords($result['category']).'</option>'; 
                                       }
                                      
                                    } 
                             echo '</select>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="inline_3">';

                        echo '<div class=" "><textarea value="" placeholder="Implementation Back-up" class="backup note" style="margin-left:24px;height:3a0px;">'.$row['back_up'].'</textarea></div>';

                        

                        echo '<div class=" " style="margin-left:24px;"><select class="strength">';
                                echo '<option value="0" disabled selected>Select Strength</option>';
                                $sel = array(1,2,3,4,5,6);
                                foreach ($sel as $val) {
                                    if ($val == $row['strength']) {
                                         echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                    }else{
                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                    }
                                }
                             echo '</select>';
                        echo '</div>';  
                    echo '</div>';

                    //last row save button
                    echo '<div class="inline_3">';
                    echo '</div>';

                    echo '<div class="inline_3" style="margin-top:10px;">';
                        echo '<div class="show_row" >';
                            echo '<div class="save" style="width:50px;height:auto; margin-left:100px;color:black;">Update</div>';        
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="inline_3">';
                    echo '</div>';


                echo '</div>';//toggle            
            echo '</div>';//parent
        }
    }
    
    
} else {
    echo '<p>Param Error</p>';
}

?>
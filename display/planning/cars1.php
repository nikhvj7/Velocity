<?php
require '../../query/conn.php';

date_default_timezone_set("Asia/Kolkata");

$date = date('Y-m-d'); 
$duedt = explode("-", $date);
$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
$week_num  = (int)date('W', $date);



if (isset($_GET['comp_id'])) {

    $comp_id = $_GET['comp_id'];

    $week_num = $_GET['week_num'];

    // $sql = "SELECT * FROM `cars` WHERE 1 ORDER BY `status` ASC ;";

    $sql = "SELECT a.car_id as car,a.*,b.*,c.name FROM `cars` a LEFT JOIN `planning` b ON a.car_id = b.car_id AND b.week = '".$week_num."' LEFT JOIN `routes` c on b.route = c.route_id WHERE a.comp_id = '".$comp_id."'  ORDER BY a.car_id ASC";

    $exe = mysqli_query($conn, $sql);


    echo '<div class="show_row">';
        echo '<div class="inline gqg_no header week_num_header">WEEK NO: '.$week_num.'</div>';        
        echo '<div class="inline gqg_no header week_change" sign="prev">Prev</div>';
        echo '<div class="inline gqg_no header week_change" sign="next">Next</div>';
    echo '</div>';

    //header
    echo '<div class="show_row">';
        echo '<div class="inline gqg_no header">GQG NO</div>';
        echo '<div class="inline per_comp header">PER</div>';
        echo '<div class="inline num_val header">TOT</div>';
        echo '<div class="inline num_val header">CUR</div>';
        echo '<div class="inline num_val header">REM</div>';
        echo '<div class="inline start_date header">STARTED</div>';
        echo '<div class="inline tcf_no header">TCF NO</div>';
    echo '</div>';


    while ($row = mysqli_fetch_assoc($exe)) {
        
        // static row\
        $car_id     = $row['car'];
        $gqg_no     = $row['gqg_no'];
        $start_date = date('j-M', strtotime($row['start_date']));
        $tot_km     = $row['total_km'];
        $cur_km     = $row['current_km'];
        $rem_km     = $row['remaining_km'];
        $tcf        = $row['tcf'];
        $per_comp   = round((($cur_km / $tot_km) * 100), 2)."%";
        
        
        // toggle row
        // 1st
        $route = strtoupper($row['route']);
        $note   = strtoupper($row['note']);
        $target     = $row['target_km'];
        
        if ($route != null) {
            echo '<div class="parent_row highlight">';
        }else{
             echo '<div class="parent_row">';
        }

            echo '<div class="show_row">';
                echo '<div class="inline gqg_no">'.$gqg_no.'</div>';
                echo '<div class="inline per_comp">'.$per_comp.'</div>';
                echo '<div class="inline num_val">'.$tot_km.'</div>';
                echo '<div class="inline num_val">'.$cur_km.'</div>';
                echo '<div class="inline num_val">'.$rem_km.'</div>';
                echo '<div class="inline start_date">'.$start_date.'</div>';
                echo '<div class="inline tcf_no">'.$tcf.'</div>';
                echo '<div class="inline more_icon"></div>';
            echo '</div>';
            
            echo '<div class="toggle_row">';


                echo '<div class="inline_3">';
                    echo '<div class="inline name">WEEK NO</div>';
                    echo '<div class="inline val week_num">'.$week_num.' </div>';

                    echo '<div class="inline name">ROUTE</div>';
                    echo '<select class="route">';

                        echo '<option value="" selected disabled >Select Route</option>';

                        $sql1 = "SELECT * FROM `routes` WHERE 1;"; 
                        $exe1 = mysqli_query($conn, $sql1);
                            
                        while($result=mysqli_fetch_assoc($exe1)){
                            if ($route == $result['route_id'] ) {
                                echo '<option value="'.$result['route_id'].'" selected>'.ucwords($result['name']).'</option>'; 
                            }else{
                                 echo '<option value="'.$result['route_id'].'">'.ucwords($result['name']).'</option>'; 
                            }
                          
                        }                    
                    echo '</select>';

                    echo '<div class="inline name">TARGET KM</div>';
                    echo '<div class="inline input_placeholder"><input type= "number" value="'.$target.'" class="target_km"></input></div>';
                echo '</div>';

                    
                echo '<div class="inline_3">';
                    echo '<div class="inline name">NOTE</div>';
                    echo '<div class="inline "><textarea value="'.$note.'" class="note"></textarea></div>';
                echo '</div>';

                echo '<div class="inline_3">';                    
                    echo '<div class="inline save_btn_holder"><span class="save" carid="'.$car_id.'">SAVE</span></div>';
                echo '</div>';

                //echo '<div class="spacer"></div>';
            echo '</div>';//toggle
        
        echo '</div>';//parent
        
    }
} else {
    echo '<p>Param Error</p>';
}




?>
<?php
require '../../query/conn.php';


if (isset($_GET['comp_id'])) {

    $comp_id = $_GET['comp_id'];

    // $sql = "SELECT * FROM `cars` WHERE 1 ORDER BY `status` ASC ;";

    $sql = "SELECT * FROM `id_map` WHERE 1";
    $exe = mysqli_query($conn, $sql);

    //header
    echo '<div class="show_row">';
        echo '<div class="inline gqg_no header">CODE ID</div>';
        echo '<div class="inline gqg_no header">KART NO</div>';
    echo '</div>';


    while ($row = mysqli_fetch_assoc($exe)) {
        
        $kart_id    = $row['kart_id'];
        $kart_no     = $row['kart_no'];
        
        echo '<div class="parent_row">';
            echo '<div class="show_row">';
                echo '<div class="inline gqg_no">ID '.$kart_id.'</div>';
                echo '<div class="inline per_comp">
                    <select class="kart_no_updated"  kartid="'.$kart_id.'">';
                    for ($i= 1; $i < 51; $i++) { 
                        if ($i == $kart_no) {
                            echo '<option selected value="'.$i.'">'.$i.'</option>';
                        }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                       
                echo'</select>
                </div>';
            echo '</div>';
        echo '</div>';
        
    }
} else {
    echo '<p>Param Error</p>';
}




?>
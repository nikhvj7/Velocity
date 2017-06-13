<?php
require '../../query/conn.php';
	

 	$sql = "SELECT * FROM `operations` WHERE 1;";
	$exe = mysqli_query($conn,$sql);
	if (mysqli_num_rows($exe) > 0) {
		while ( $row = mysqli_fetch_assoc($exe) ) {

			$timing = $row['timing'];
			$times = explode('|', $timing);
			$best  = 0;
			$total = 0;

			for ($i=1; $i <sizeof($times) ; $i++) { 
				if($i == 1){
					$best  = $times[$i];
					$total = $times[$i];
				}else{
					if ($best >  $times[$i]  ) {
						$best  = $times[$i];
					}
					$total = $total+$times[$i];
				}
				
			}
			    
			echo'<div class="daily_ops_card_holder">
				<div class="daily_op_card">
					<div class="daily_gqg">Kart No '.$row['kart_no'].'</div>
					<div class="op_actions">'.ucfirst($row['name']).'</div>
						<div class="op_float">
							<div class="op_fields ops_data">Current lap</div><div class="op_vals ops_data">'.$row['lap'].'</div>
							<div class="op_fields ops_data">Best Time</div><div class="op_vals ops_data">'.$best.'</div>
							<div class="op_fields ops_data">Total Time</div><div class="op_vals ops_data">'.$total.'</div>	
						</div>	

						<div class="op_actions"><div class="finish" opid="'.$row['op_id'].'">Finish</div></div>
				</div>
			</div>';
			
		}
	}



?>
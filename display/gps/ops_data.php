<?php

date_default_timezone_set("Asia/Kolkata");

if(isset($_GET['date'])){
	$date = $_GET['date'];
	$car_id = $_GET['car_id'];
	$shift = $_GET['shift'];

	if ($date == 'today') {
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
	}

	include '../../query/conn.php';

	$temp_file = '../../gps/'.$date.'/'.$car_id.'/'.$shift.'.txt';

	$e_id = 0;
	$avg  = 0;
	$max  = 0;
	$count = 0;
	$stop  = 0;
	$avg_count = 0;
	$json = array();
	// $values =array();
	$j = 0;
	$i = 0;

	if (file_exists($temp_file)){
		$fp = fopen( $temp_file, "r");

		while( !feof( $fp)) {
		    fgets( $fp);
		    $i++;
		}
		fclose( $fp);
	}
		

	if (file_exists($temp_file)) {
		$f = fopen($temp_file, "r");
			while(!feof($f)) { 
				$data = explode(";", rtrim(fgets($f),"\r\n"));
				$j++;

				

				if ($e_id != $data[6]) {
					$count++;
					if (($count > 1)) {

						$values['time_stop']  = $stop;
						if ($avg_count > 0) {
							$avg_val = round($avg/$avg_count);
						}else{
							$avg_val = $avg;
						}
						$values['avg']  = $avg_val;
						$values['max']	= $max;	
						$values['odo2']= $data[7];
						array_push($json,$values);
					}	

					$values =array();
					$e_id = $data[6];
					$values['e_id'] 		= $e_id;
					$values['time_start']  	= $data[4];
					$values['odo1']			= $data[7];
					$avg  = 0;
					$avg += $data[3];
					$max  = 0;
					if ($max < $data[3]) {
						$max = $data[3];
					}
					$avg_count = 1;			
				}else{
					$avg_count++;
					$avg += $data[3];
					if ($max < $data[3]) {
						$max = $data[3];
					}
					$stop = $data[4];
				}


				if ($j == $i) {
					$values['time_stop']  = $stop;
					if ($avg_count > 0) {
						$avg_val = round($avg/$avg_count);
					}else{
						$avg_val = $avg;
					}
					
					$values['avg']  = $avg_val;
					$values['max']	= $max;	
					$values['odo2']	= 'stop';
					array_push($json,$values);
				}
			}
		fclose($f);
	}

	$sql=" SELECT a.*,b.f_name,b.l_name,c.gqg_no
			FROM `operations` a 
			JOIN `employees` b on a.su_id = b.e_id
			JOIN `cars` c on a.car_id = c.car_id
			WHERE a.date = '".$date."' AND a.shift = '".$shift."' AND a.car_id = '".$car_id."'
			ORDER BY a.route ASC ;";

	$query=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($query);

	$stop = $row['stop'];
	$toll  = $row['toll'];
    $toll_a  = explode("|",$toll);
    $toll_val = 0;
    foreach ($toll_a  as  $value) {
     	$toll_val = $toll_val+$value; 
    } 

    $fuel_val = 0;
    $fuel = $row['fuel'];
    $fuel_a = explode("|", $fuel);
    foreach ($fuel_a as  $value) {
     	$fuel_a_a = explode("_", $value);
     	$fuel_val = $fuel_val+$fuel_a_a[0];
    }
	echo'<div class="daily_ops_card_holder">
				<div class="daily_op_card">
					<div class="daily_gqg">'.$row['gqg_no'].'</div>
					
						<!-- left -->
						<div class="op_float">
							<div class="op_fields ops_data">Start</div><div class="op_vals ops_data">'.$row['start'].'</div>
							<div class="op_fields ops_data">Stop</div><div class="op_vals ops_data">'.$row['stop'].'</div>
							<div class="op_fields ops_data">Trip</div><div class="op_vals ops_data">'.$row['trip'].'</div>	
						</div>

						<!-- right -->
						<div class="op_float">
							<div class="op_fields ops_data">Fuel</div><div class="op_vals ops_data">'.$fuel_val.'</div>	
							<div class="op_fields ops_data">Mileage</div><div class="op_vals ops_data">'.$row['mileage'].'</div>
							<div class="op_fields ops_data">Toll</div><div class="op_vals ops_data">'.$toll_val.'</div>
						</div>
						<div class="op_route">'.$row['route'].'</div>
						<div class="op_actions">'.ucfirst($row['f_name'].' '.$row['l_name']).'</div>
				</div>
			</div>';


	foreach ($json as $data ) {
		$sql=" SELECT `f_name`,`l_name`
			FROM `employees` WHERE `e_id` = '".$data['e_id']."';";

		$query=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($query);

		if ($data['odo2'] == 'stop') {
			
			$data['odo2'] = $stop;
			$d_trip = $data['odo2'] - $data['odo1'];
			$d_trip = $d_trip.' KM';
			if (($stop == "")||($stop == NULL)) {
				$d_trip = 'Running';
			}

		}else{
			$d_trip = $data['odo2'] - $data['odo1'];
			$d_trip = $d_trip.' KM';
		}

		$from_time = strtotime($data['time_start']);
		$to_time = strtotime($data['time_stop']);
		
		$time_diff = $to_time - $from_time;
		$time = gmdate('H:i:s', $time_diff);

		
		

			echo'<div class="daily_ops_card_holder style="clear:both;">
				<div class="daily_op_card">
					<div class="daily_gqg">'.ucfirst($row['f_name'].' '.$row['l_name']).'</div>
					
						<!-- left -->
						<div class="op_float">
							<div class="op_fields ops_data">Start</div><div class="op_vals ops_data">'.$data['time_start'].'</div>
							<div class="op_fields ops_data">Stop</div><div class="op_vals ops_data">'.$data['time_stop'].'</div>
							<div class="op_fields ops_data">Time</div><div class="op_vals ops_data">'.$time.'</div>	
						</div>

						<!-- right -->
						<div class="op_float">
							<div class="op_fields ops_data">Max</div><div class="op_vals ops_data">'.ltrim($data['max'], '0').'Km/h</div>	
							<div class="op_fields ops_data">Avg</div><div class="op_vals ops_data">'.$data['avg'].'Km/h</div>
							<div class="op_fields ops_data">Trip</div><div class="op_vals ops_data">'.$d_trip.'</div>
						</div>
					
				</div>
			</div>';
	}
}	

?>
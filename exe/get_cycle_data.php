<?php


if(isset($_GET['task_id'])){

	$task_id = $_GET['task_id'];

	$temp_file = '../gps_cycle/2017-04-19/1/2.txt';

	$result = array();

	$j = 0;
	$i = 0;
	$counter = 0;


	// get file lines
	if (file_exists($temp_file)){
		$fp = fopen( $temp_file, "r");
		while( !feof( $fp)) {
		    fgets( $fp);
		    $i++;
		}
		fclose( $fp);
	}

	// process
	if (file_exists($temp_file)) {
		$f = fopen($temp_file, "r");
			while(!feof($f)) { 
				$data = explode(";", rtrim(fgets($f),"\r\n"));
				$j++;

				if(ltrim($data[8], '0') == $task_id){
					$speed = ltrim($data[3], '0');
					if($speed == ""){$speed = 0;}
					// echo $speed.'<br/>';

					// $timestamp = $data[4];
					// $chart_time = date('Y,m,d,H,i,s',$timestamp);
					$timestamp = $data[4];
					$year = date('Y',$timestamp);
					$month = date('m',$timestamp);
					$day = date('d',$timestamp);
					$hour = date('H',$timestamp);
					$min = date('i',$timestamp);
					$sec = date('s',$timestamp);				

					


					$jRow = array();
					$jRow["year"] = $year;
					$jRow["month"] = $month;
					$jRow["day"] = $day;
					$jRow["hour"] = $hour;
					$jRow["min"] = $min;
					$jRow["sec"] = $sec;

					$jRow["speed"] = $speed;	
					array_push($result, $jRow);
				}

				
				
			}
		fclose($f);
	}

	echo json_encode($result,JSON_NUMERIC_CHECK);
}
	
?>
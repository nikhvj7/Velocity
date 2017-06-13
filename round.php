<?php
date_default_timezone_set("Asia/Kolkata");

require 'query/conn.php';

$date = date("2017-05-02");
$time = date("Y-m-d H:i:s");

// for ($i=1; $i < 51 ; $i++) { 

// 	$sql = "INSERT INTO `id_map` (`kart_id`,`kart_no`) VALUES('$i',$i);";
			
// 	$exe = mysqli_query($conn,$sql);
// }

	$target_url = "http://192.168.0.100/timer/api/operations/1";
	echo $result = file_get_contents($target_url);
?>
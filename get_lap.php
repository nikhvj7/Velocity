<?php

require 'query/conn.php';

if(isset($_GET['id'])){
	
	$kart_id = $_GET['id'];

	$sql = "SELECT `lap` 
		FROM `operations` WHERE `kart_no` IN (SELECT `kart_no` FROM `id_map` WHERE `kart_id` = '$kart_id');";
	$exe = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($exe);
	$lap = $row['lap'];
	if (($lap == "")||($lap == NULL)) {
		$lap = 0;
	}
	echo $lap;

}



?>
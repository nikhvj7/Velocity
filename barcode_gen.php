<?php

	require 'query/conn.php';


	function generateRand(){

		require 'query/conn.php';
		
		$i = rand(1000, 9999);		
		$sql = "SELECT `ticket_code` FROM `tickets` WHERE `ticket_code` = '".$i."' ;";
		$exe = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($exe);
		if($count > 0){
			echo 'old data'.$i;
			generateRand();
		}
		else{
			echo 'new val'.$i;
			return $i;

		}
		
	}

	generateRand();
	
	/*for ($i=1000; $i < 5000 ; $i++) { 
		$sql = "INSERT INTO `tickets`(`ticket_code`, `cust_id`, `status`) VALUES ('$i','$i', 'pending');";
		$exe = mysqli_query($conn, $sql);	
	}*/
	
	
?>
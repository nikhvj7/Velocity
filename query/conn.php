<?php
	$host_name = 'localhost';
	$user_name = 'root';
	$password = 'toor';
	$db_name = 'timer';

	$conn = mysqli_connect($host_name, $user_name, $password, $db_name);

	if($conn == FALSE)
	{

		echo 'ERROR: '.mysqli_connect_error($conn);

	}
?>
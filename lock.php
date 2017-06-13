<?php
if(!isset($_SESSION))
{
	session_start();
}
require 'query/conn.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = date("Y-m-d H:i:s");
if (isset($_SESSION['user_id'])) {

	$user_id = $_SESSION['user_id'];
	$token = $_SESSION['token'];

	$sql = "SELECT `role` FROM `users` WHERE `user_id` = '".$user_id."';";
    $exe = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($exe)){
    	$_SESSION['access'] = $row['role'];
    }
} 

if (!isset($_SESSION['access'])) 
{

	header("location: login.php");
}

?> 
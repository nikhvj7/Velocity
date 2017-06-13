<?php

include '../query/conn.php';

$result = array();

$sql_f = "SELECT MIN(`date`) as start FROM `operations` WHERE 1";
$exe_f = mysqli_query($conn,$sql_f);
while($row = mysqli_fetch_assoc($exe_f)){
	$jRow = array();

	$jRow["date"] = $row["start"];
	$jRow["stop"] = "0";	
	array_push($result, $jRow);
}


$sql = "SELECT `date`,`stop` FROM `operations` WHERE day(date) in (1,15)";
$exe = mysqli_query($conn,$sql);


while($row = mysqli_fetch_assoc($exe)){
	$jRow = array();

	$jRow["date"] = $row["date"];
	$jRow["stop"] = $row["stop"];	
	array_push($result, $jRow);
}

echo json_encode($result);



?>
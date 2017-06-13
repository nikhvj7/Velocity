<?php  

include '../query/conn.php';

$array = array();


$sql = "SELECT distinct(`car_id`) FROM `operations` WHERE 1";
$exe = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($exe)){
	array_push($array, $row['car_id']);
}

echo json_encode($array, JSON_NUMERIC_CHECK);

?>
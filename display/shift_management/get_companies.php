<?php

require '../../query/conn.php';

$sql = "SELECT `comp_id`,`name` FROM `companies` WHERE 1";
$exe = mysqli_query($conn,$sql);

$result = array();
while($row = mysqli_fetch_assoc($exe)){
	$result[$row['comp_id']] = $row['name'];	
}

echo json_encode($result,JSON_NUMERIC_CHECK);

?>
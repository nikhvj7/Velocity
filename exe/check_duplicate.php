<?php

$result = array();
$result["success"] = false;

// if(isset($_POST['table_name'])){

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); // decoding received JSON to array

	require '../query/conn.php';



	$table_name 	= $response['table_name'];

	// EMPLOYEES are an exception
	if($table_name == "employees"){

		$f_name = trim(strtolower($response['f_name']));
		$m_name = trim(strtolower($response['m_name']));
		$l_name = trim(strtolower($response['l_name']));

		$sql = "SELECT `f_name`, `m_name`, `l_name` 
				FROM `employees` 
				WHERE `f_name` = '".$f_name."' AND `m_name` = '".$m_name."' AND `l_name` = '".$l_name."'";
		$exe = mysqli_query($conn, $sql);

		$num_rows = mysqli_num_rows($exe);

		if($num_rows > 0){
			$result["success"] = true;
		}

		$result['query'] = $sql;
	}
	else{

		$column_name 	= $response['column_name'];
		$column_value 	= $response['column_value'];

		$sql = "SELECT 1 FROM `".$table_name."` WHERE `".$column_name."` = '".$column_value."';";
		$exe = mysqli_query($conn, $sql);

		$num_rows = mysqli_num_rows($exe);

		if($num_rows > 0){
			$result["success"] = true;
		}

		$result['query'] = $sql;
	}

echo json_encode($result);

?>
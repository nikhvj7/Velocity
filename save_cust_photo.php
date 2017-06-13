<?php

$datatype 	= $_POST['type'];
$data 	= $_POST['data'];
$cu_id 	= $_POST['cu_id'];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

if($datatype == "photo"){
	$file_name = 'photos/photo_'.$cu_id.'.png';
}else{
	$file_name = 'photos/sign_'.$cu_id.'.png';
}



file_put_contents($file_name, $data);

?>
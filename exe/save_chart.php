<?php


$data = $_POST['data'];
$car_id = $_POST['car_id'];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

// if(file_put_contents('image.png', $data)){
// 	echo 's';
// }else{
// 	echo'n';
// }

file_put_contents('../chart_dump/car_id_'.$car_id.'.png', $data);

?>
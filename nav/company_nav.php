<?php
if(!isset($_SESSION))
{
	session_start();
}

require 'query/conn.php';



echo '<div id="company_bar">';

if ($_SESSION['access'] == 'client') {
	$sql = "SELECT `comp_id`, `name` FROM `companies` WHERE `comp_id` = (SELECT `barcode` FROM `employees` WHERE `e_id` = '".$_SESSION['e_id']."' );";
	$exe = mysqli_query($conn,$sql);

	while($row = mysqli_fetch_assoc($exe)){
		$pre_company = $row['name'];
		$company = ucfirst($row['name']);
		$comp_id = $row['comp_id'];
		if($pre_company){
			echo '<div class="company_bar_company company_bar_company_active" company_bar_comp_id="'.$comp_id.'">';
			echo $company.'</div>';
		}
	}
}else{

	$sql = "SELECT `comp_id`, `name` FROM `companies` WHERE 1;";
	$exe = mysqli_query($conn,$sql);

	$active_company = "fiat";

	while($row = mysqli_fetch_assoc($exe)){
		$pre_company = $row['name'];
		$company = ucfirst($row['name']);
		$comp_id = $row['comp_id'];
		if($pre_company == $active_company){
			echo '<div class="company_bar_company company_bar_company_active" company_bar_comp_id="'.$comp_id.'">';
			echo $company.'</div>';
		}
		else{
			echo '<div class="company_bar_company" company_bar_comp_id="'.$comp_id.'">'.$company.'</div>';
		}
	}
}



echo '</div>';

?>

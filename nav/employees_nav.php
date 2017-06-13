<?php

require 'query/conn.php';

$sql = "SELECT `comp_id`, `name` FROM `companies` WHERE 1;";
$exe = mysqli_query($conn,$sql);

echo '<div id="company_bar">';
// echo '<div class="company_bar_company company_bar_company_active" company_bar_comp_id="all">All</div>';
$active_company = "maruti";

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

// search exception
echo '<div class="company_bar_search" >';
	echo '<input type="text" placeholder="Search Employees" id="search_employees">';
	echo '<div id="search_result"></div>';
echo '</div>';

echo '</div>';

?>

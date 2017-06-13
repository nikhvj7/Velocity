<?php
	require '../../query/conn.php';
	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");

	function getDistinctCompanies(&$conn){
		$sql_comp = "SELECT `name`,`comp_id` FROM `companies` WHERE 1;";
		$exe_comp = mysqli_query($conn,$sql_comp);
		$companies = array();
		$companies[-1] = "select";
		while($row_comp = mysqli_fetch_assoc($exe_comp)){
			$companies[$row_comp['comp_id']] = $row_comp['name'];
		}
		return $companies;
	}

	function getUnassignedEmployees(&$conn, $emp_type, $date,$comp_id){
		$result = null;

		// echo $un_sql = 	"SELECT 	a.e_id, a.emp_id, a.designation, a.f_name, a.l_name,
		// 						b.acc_id, b.comp_id, b.shift, b.date,
		// 						c.name
		// 			FROM `employees` a 
		// 			JOIN `access` b ON a.e_id = b.e_id AND b.date < '$date'
		// 			LEFT JOIN `companies` c ON b.comp_id = c.comp_id
		// 			WHERE a.access = '".$emp_type."'
		// 			AND a.status='active'
		// 			ORDER BY a.f_name;";

			$un_sql = 	"SELECT a.e_id, a.emp_id, a.designation, a.f_name, a.l_name, b.acc_id,b.route, b.comp_id, b.shift, b.date,c.name
						FROM `employees` a JOIN `access` b 
						ON a.e_id = b.e_id AND b.date < '".$date."' 
						LEFT JOIN `routes` c ON b.route = c.route_id WHERE a.access = '".$emp_type."'
						AND a.status='active' AND b.comp_id = '".$comp_id."' ORDER BY a.f_name;";



		$exe_un = mysqli_query($conn,$un_sql);
		if(mysqli_num_rows($exe_un) > 0){
			$result = array();
			while($row_un = mysqli_fetch_assoc($exe_un)){
				$result[] = $row_un;
			}
		}

		return $result;
	}


	function getAssignedEmployeesByShift(&$conn, $emp_type, $date, $shift,$comp_id){
		$result = null;
		
		

	// echo 	$un_sql = 	"SELECT 	a.e_id, a.emp_id, a.designation, a.f_name, a.l_name,
	// 							b.acc_id, b.comp_id, b.shift, b.date,
	// 							c.name
	// 				FROM `employees` a 
	// 				LEFT JOIN `access` b ON a.e_id = b.e_id
	// 				LEFT JOIN `companies` c ON b.comp_id = c.comp_id
	// 				WHERE a.access = '".$emp_type."'
	// 				AND b.date >= '$date' AND b.shift = '$shift'
	// 				AND a.status='active'
	// 				ORDER BY a.f_name;";
				$un_sql = "SELECT a.e_id, a.emp_id, a.designation, a.f_name, a.l_name, b.acc_id, b.comp_id, b.shift,b.route, b.date,c.name FROM `employees` a LEFT JOIN `access` b ON a.e_id = b.e_id
					LEFT JOIN `routes` c ON b.route = c.route_id
					WHERE a.access = '".$emp_type."'
					AND b.comp_id = '".$comp_id."'
					AND b.date >= '".$date."' 
					AND b.shift = '".$shift."' 
					AND a.status='active' ORDER BY a.f_name;";

		$exe_un = mysqli_query($conn,$un_sql);
		if(mysqli_num_rows($exe_un) > 0){
			$result = array();
			while($row_un = mysqli_fetch_assoc($exe_un)){
				$result[] = $row_un;
			}
		}

		return $result;
	}


	function renderHTML($result, $emp_type, $shift){

		if($shift == 'no'){
			$display = "UNASSIGNED ";
		}else{
			$display = strtoupper($shift)." SHIFT ";
		}

		echo '<table>';
		echo '<tr><td class="blue"></td><td class="header blue" colspan="4">'.$display.strtoupper($emp_type).'S</td></tr>';

		for($i=0;$i<sizeof($result);$i++){
			$full_name 	= $result[$i]['f_name'].' '.$result[$i]['l_name'];
			$e_id 		= $result[$i]['e_id'];
			$route		= $result[$i]['name'];
			$emp_id 	= $result[$i]['emp_id'];
			$date  		= $result[$i]['date'];


			echo '<tr>';	
				echo '<td class="img_td"><div class="check"></div></td>';
				echo '<td class="name_td"><input type="checkbox" value="'.$e_id.'" class="hide select_cars">'.$full_name.'</td>';
				echo '<td class="rout_td">'.$route.'</td>';
				echo '<td class="date_td">'.$date.'</td>';
				echo '<td class="emp_id_td">'.$emp_id.'</td>';
			echo '</tr>';

		}

		echo '</table>';
	}



if( (isset($_GET['emp_type'])) && (isset($_GET['shift'])) && (isset($_GET['comp_id'])) ){

	
	$shift = $_GET['shift'];
	// echo'<br />';
	$emp_type = $_GET['emp_type'];
	// echo'<br />';
	$comp_id  = $_GET['comp_id'];
	

	$comp_array = getDistinctCompanies($conn);	

	if($shift == 'no'){

		$result = getUnassignedEmployees($conn, $emp_type, $date, $comp_id);
		if($result != null){

			// Debug
			// echo '<pre>';
			// print_r($result);
			// echo '</pre>';

			renderHTML($result, $emp_type, $shift,$comp_id);			
		}
		// No results
		else{
			echo '<div class="no_emps_found">No Employees Found</div>';
		}

	}
	// specific shift
	else{
		
		$result = getAssignedEmployeesByShift($conn, $emp_type, $date, $shift,$comp_id);
		if($result != null){
			// Debug
			// echo '<pre>';
			// print_r($result);
			// echo '</pre>';

			renderHTML($result, $emp_type, $shift,$comp_id);
		}
		// No results
		else{
			echo '<div class="no_emps_found">No Employees Found</div>';
		}
	}

}
// if isset problem
else{
	echo '<div class="no_emps_found">Unexpected Error</div>';
}

?>
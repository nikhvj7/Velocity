<?php 
	// require '../query/conn.php';
 	require '../../query/conn.php';
 	// date_default_timezone_set("Asia/Kolkata");
    // $date = date("Y-m-d");
    
    function getAssessment(&$conn, $type, $date){

		$result = null;

		$sql = 	"SELECT a.*,e.f_name,e.m_name,e.l_name 
				FROM `assessment` a
				LEFT JOIN `employees`e 
				ON a.e_id = e.e_id 
				WHERE a.designation = '".$type."' 
				AND a.date = '".$date."'";

		$exe = mysqli_query($conn,$sql);
		if(mysqli_num_rows($exe) > 0){
			$result = array();
			while($row = mysqli_fetch_assoc($exe)){
				$result[] = $row;
			}
		}

		return $result;
	}

	function renderHTML($result, $type){


		//header
		echo '<div class="show_row">';
			
			echo '<div class="inline emp_name header">NAME</div>';
			echo '<div class="inline emp_type header">Grade</div>';			
			echo '<div class="inline header"></div>';
		echo '</div>';

		for($i=0;$i<sizeof($result);$i++){
			// show row
			$full_name 	= $result[$i]['f_name'].' '.$result[$i]['l_name'];
			$grade 		= $result[$i]['grade'];
			

			echo '<div class="parent_row">';
				echo '<div class="show_row">';					
					echo '<div class="inline emp_name">'.$full_name.'</div>';
					echo '<div class="inline emp_type">'.$grade.'</div>';					
				echo '</div>';				
			echo '</div>';
		}
	}



	if(isset($_GET['type'])){

	$type = $_GET['type'];
	$date = $_GET['date'];

	$result = getAssessment($conn, $type, $date);
	if($result != null){

		// Debug
		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';

		renderHTML($result, $type, $date);			
	}
	// No results
	else{
		echo '<div class="no_emps_found">No Assessment Found</div>';
	}
}
// if isset error
else{
	echo '<div class="no_emps_found">Unexpected Error</div>';	
}





?>
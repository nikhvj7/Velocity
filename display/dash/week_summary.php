<?php
	require '../../query/conn.php';
	

	if (isset($_GET['date1'])) {
		$date1  = $_GET['date1'];
		$date2  = $_GET['date2'];
		$week_num  = $_GET['week_num'];
	}
	else{
			$date1 = '2016-11-07';
			$date2 = '2016-11-12';
	}







    // construct week array for data checks
    // first value
    $week_array = array();
    $date1_copy = date ("Y-m-d", strtotime($date1));
    array_push($week_array,$date1);

    // loop through remaining dates
    while (strtotime($date1_copy) < strtotime($date2)) {

        $date1_copy = date ("Y-m-d", strtotime("+1 day", strtotime($date1_copy)));
        array_push($week_array,$date1_copy);
    }

	echo'<table>';

		echo'<tr style="height: 32px;color: #767776;font-weight: 500;">
			<td></td>
			<td class="center">#'.$week_num.'</td>
			<td class="right">M</td>
			<td class="right">T</td>
			<td class="right">W</td>
			<td class="right">T</td>
			<td class="right">F</td>
			<td class="right end">S</td>
		</tr>';


		$shift_array = ['a','b','c'];

		foreach ($shift_array as $shift) {
			echo'<tr>
				<td class="shift center" rowspan="4" style="border-bottom: 1px solid #E8E8DA;color: #767776;">'.ucwords($shift).'</td>
				<td class="summary_field">Completed</td>';

				$sql = "SELECT COUNT(`date`),`date` FROM `operations` WHERE  `shift` = '".$shift."' AND `stop` IS NOT NULL  AND `date` BETWEEN '$date1' AND '$date2'  GROUP BY `date`;";
				$exe = mysqli_query($conn,$sql);

				$result = array();
				$count =0;
				while ($row = mysqli_fetch_assoc($exe)){

					$result[$count]['date'] 	= $row['date'];
					$result[$count]['count'] 	= $row['COUNT(`date`)'];
					$count++;
				}

				$counter = 0;
				for ($i=0; $i<sizeof($week_array);$i++) { 
					$found = false;
			        foreach ($result as $key => $data) {                    
			            if ($data['date'] == $week_array[$i]) {
			                $found = true;                            
			                break;
			            }
			        }
			        if ($i == sizeof($week_array)-1) {
			        	echo'<td class="right end">';
			        }else{
			        	echo'<td class="right">';
			        }
			        
			        if ($found) {
			        	echo $result[$counter]['count'];
			        	$counter++;
			        }else{
			        	echo'-';
			        }
			        echo'</td>';
				}

			echo'</tr>';
			echo'<tr>
				<td class="summary_field">Running</td>';

				$sql = "SELECT COUNT(`date`),`date` FROM `approval` WHERE  `shift` = '".$shift."' AND `date` BETWEEN '$date1' AND '$date2'  GROUP BY `date`;";
				$exe = mysqli_query($conn,$sql);

				$result = array();
				$count =0;
				while ($row = mysqli_fetch_assoc($exe)){

					$result[$count]['date'] 	= $row['date'];
					$result[$count]['count'] 	= $row['COUNT(`date`)'];
					$count++;
				}

				$counter = 0;
				for ($i=0; $i<sizeof($week_array);$i++) { 
					$found = false;
			        foreach ($result as $key => $data) {                    
			            if ($data['date'] == $week_array[$i]) {
			                $found = true;                            
			                break;
			            }
			        }
			        if ($i == sizeof($week_array)-1) {
			        	echo'<td class="right end">';
			        }else{
			        	echo'<td class="right">';
			        }
			        
			        if ($found) {
			        	echo $result[$counter]['count'];
			        	$counter++;
			        }else{
			        	echo'-';
			        }
			        echo'</td>';
				}

			echo'</tr>';
			echo'<tr>
				<td class="summary_field">Problems</td>';

				$sql = "SELECT COUNT(`prob_id`),`open_date` FROM `problems` WHERE `shift` = '".$shift."' AND `open_date` BETWEEN '$date1' AND '$date2'  GROUP BY `open_date`;";
				$exe = mysqli_query($conn,$sql);

				$result = array();
				$count =0;
				while ($row = mysqli_fetch_assoc($exe)){

					$result[$count]['date'] 	= $row['open_date'];
					$result[$count]['count'] 	= $row['COUNT(`prob_id`)'];
					$count++;
				}

				$counter = 0;
				for ($i=0; $i<sizeof($week_array);$i++) { 
					$found = false;
			        foreach ($result as $key => $data) {                    
			            if ($data['date'] == $week_array[$i]) {
			                $found = true;                            
			                break;
			            }
			        }
			        if ($i == sizeof($week_array)-1) {
			        	echo'<td class="right end">';
			        }else{
			        	echo'<td class="right">';
			        }
			        
			        if ($found) {
			        	echo $result[$counter]['count'];
			        	$counter++;
			        }else{
			        	echo'-';
			        }
			        echo'</td>';
				}

			echo'</tr>';

			echo'<tr>
				<td class="summary_field">Presentees</td>';

				$sql = "SELECT  COUNT(`e_id`),`date` FROM `attendance` WHERE  `shift` = '".$shift."' AND `date` BETWEEN '$date1' AND '$date2'  GROUP BY `date`;";
				$exe = mysqli_query($conn,$sql);

				$result = array();
				$count =0;
				while ($row = mysqli_fetch_assoc($exe)){

					$result[$count]['date'] 	= $row['date'];
					$result[$count]['count'] 	= $row['COUNT(`e_id`)'];
					$count++;
				}

				$counter = 0;
				for ($i=0; $i<sizeof($week_array);$i++) { 
					$found = false;
			        foreach ($result as $key => $data) {                    
			            if ($data['date'] == $week_array[$i]) {
			                $found = true;                            
			                break;
			            }
			        }
			        if ($i == sizeof($week_array)-1) {
			        	echo'<td class="right end">';
			        }else{
			        	echo'<td class="right">';
			        }
			        
			        if ($found) {
			        	echo $result[$counter]['count'];
			        	$counter++;
			        }else{
			        	echo'-';
			        }
			        echo'</td>';
				}
			echo'</tr>';

			if($shift == "c"){
				echo'<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
					<td colspan="3" style="height: 40px;font-size: 13px;font-weight: 700;text-align: right;padding-right: 8px;"><a href="operations.php">DETAILS</a></td>
				</tr>';	
			}
			
		}
	echo'</table>';
?>

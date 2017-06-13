<?php 

$shift_array = array('a','b','c');
$id=$row['E'];	

	echo'<thead  style="border-bottom:0px;">';

		//foreach ($shift_array as $key => $value) {
			echo '<tr class="blue" style="color:white;">';
	    		if(($c == null)||($c != $row['shift'])){
	    			if (($row['shift'] == NULL)&&($d == null)) {
	    				echo '<td  colspan=8><h6>Unassigned '.ucfirst($designation).'s</h6></td>';
	    				
	    			}elseif($row['shift'] != NULL){
		    			echo '<td colspan=8><h6>'.strtoupper($row['shift']).' Shift - '.ucfirst($designation).'s</h6></td>';
	    			}	    					
	    		}
	    	echo '</tr>';
    	//}//foreach
if (($c == null)&&($d == null)) 
{

 		echo'<tr>';
 			echo'<th></th>';
	 		echo'<th>Employee ID</th>';
	 		echo'<th>Name</th>';
	 		echo'<th>Designation</th>';
	 		echo'<th>Company</th>';
	 		echo'<th>Shift</th>';
	 		echo'<th>Acess Up To</th>';
	 		echo'<th></th>';
	 	echo'</tr>';

	echo'</thead>';
}

			echo'<tr>';
			echo '<td><input type="checkbox" class="filled-in" name="'.$designation.'_bulk" id="'.$row['E'].'"/><label for="'.$row['E'].'"></label></td>';

			echo '<td>'.$row['emp_id'].'</td>';

			echo '<td>'.ucwords($row['f_name'].' '.$row['l_name']).'</td>';

			echo '<td>'.$row['designation'].'</td>';

			echo'<td><select class="select " id="'.$row['E'].'_com" >';

					$dist_car = "SELECT DISTINCT(`name`),`comp_id` FROM `companies` WHERE 1;";
					$dist_exe = mysqli_query($conn,$dist_car);
			        while ($row_car = mysqli_fetch_assoc($dist_exe))
			        {	
			        	if($row_car['comp_id'] == $comp_id){
			        		echo'<option value="'.$row_car['comp_id'].'" selected="selected">'.ucfirst($row_car['name']).'</option>';
			        	}else{
			        		echo'<option value="'.$row_car['comp_id'].'" >'.ucfirst($row_car['name']).'</option>';

			        	}	
				  	}
			echo '</td>';

			
	        echo '<td><select class="select" id="'.$row['E'].'_shift">';
	        	foreach ($shift_array as $key => $value) {
	        		if(($value == $row['shift'])&&($row['shift'] != '')){
	        			echo '<option value="'.$value.'" selected="selected">'.strtoupper($value).'</option>';	
	        		}else{
	        			echo '<option value="'.$value.'">'.strtoupper($value).'</option>';	
	        		}
	        	}//foreach	    
	        echo '</td>';

			echo '<td><input type="date" class="datepicker col s7" id="'.$row['E'].'_date"  value="'.$row['date'].'"></td>';
			echo '<td><input type="button" class="waves-effect waves-light btn col s12 left update" value="Update" id="'.$row['E'].'"></td>';
		echo '</tr>';

$d = 1;
$c = $row['shift'] ;
?>
<?php include '../../query/conn.php';

$sql="SELECT a.*,b.gqg_no,c.name,d.start,d.date
		FROM `approval` a
		JOIN `cars` b ON a.car_id = b.car_id
		JOIN `companies` c ON b.comp_id = c.comp_id
        JOIN `operations` d ON a.op_id = d.op_id
		WHERE a.approved_by IS NULL;";

$info=mysqli_query($conn,$sql);
$count=mysqli_num_rows($info);
 
date_default_timezone_set("Asia/Kolkata");

if($count==0)
 {
 	echo'<h5>No Vehicle data present</h5>';
 }
 else
 {
 	$r = array('start','fuel','fuelodo','stop');

 	$stop_val = false;

 	echo'<ul class="collapsible" data-collapsible="accordion">';

	 while($row = mysqli_fetch_assoc($info)){

	 	$date = $row['date'];
	 	$car_id = $row['car_id'];
	 	echo'<li>';
			echo'<div class="collapsible-header"  style="background-color:white;color:black;">'.$row['gqg_no'].' - Shift '.strtoupper($row['shift']).'</div>';
			    echo'<div class="collapsible-body" style="background-color:white;color:black;">';
				    echo'<div  class="row"style=" width:94%; height:auto;margin: 2em;padding-left:1.5em; ">'; 
				        

				 		foreach ($r as $key) 
				 		{
				 			$stop_val = true;
				 			if ($key != null)
				 			{	
				 				$disabled = null;
				 				$val = $key;
				 				if ($key == 'start') 
				 				{
					 				$key = 'start';
					 				$display = 'Start KM';
					 			}
					 			elseif($key == 'stop')
					 			{
					 				$display = 'Stop KM';
					 				if ($row[$key] == '') {
					 					$stop_val = false;
					 				}
					 			}
					 			elseif($key == 'fuel')
					 			{
					 				$display = 'Fuel Ltr';
					 			}
					 			elseif($key == 'fuelodo')
					 			{
					 				$display = 'Reading at Fueling';
					 			}

					 			$src = 'uploads/'.$date.'/'.$date.'_'.$car_id.'_'.$row['shift'].'_'.$val.'.jpg';					 			
					 			$dir = $_SERVER['DOCUMENT_ROOT'].'/spartan/'.$src;



					 			 /////////////////////////////////////////////////
					 			 /////////////////////////////////////////////////
					 			 /////////////////////////////////////////////////
					 			 //////// Add Spartan to dir for local ///////////
					 			 /////////////////////////////////////////////////
					 			 /////////////////////////////////////////////////
					 			 /////////////////////////////////////////////////


				 			
								if(!file_exists($dir)){
								
									$src = 'uploads/no_image.png';
								}
													 	
					 			echo'<div class="row" style="width:22%; height:auto; margin-right:1em;display:inline-block;">';
		      			
					      			echo'<div style=" height:auto; width:100%;">';
									echo'<img height="30%" width="100%" src="'.$src.'" class="materialboxed" data-caption="'.$row['gqg_no'].' Shift '.strtoupper($row['shift']).' '. $display.'">';

					      		echo'</div>';
					      		echo'<div style=" height:auto; width:90%; margin-left: 0.4em; vertical-align: top;">';

					      			echo'<div class="input-field col s12">';
									    echo'<input id="'.$row['appr_id'].'_'.$key.'" type="number" autocomplete="off" class="validate" value="'.$row[$key].'" '.$disabled.'>';
									    echo'<label for="'.$row['appr_id'].'_'.$key.'">'.$display.'</label>';
							       	echo'</div>';
				      
					      		echo'</div>';

						      	echo'</div>';
				 			}

				 		}//foreach

				 		if ($stop_val) {
				 			echo'<button class="waves-effect waves-light btn col s2 right save" style=" margin-right: 2em;"  id="'.$row['appr_id'].'" opid="'.$row['op_id'].'" shift="'.$row['shift'].'">Save</button>';
				 		}

	 				echo'</div>';//row
	 			echo'</div>';//body
	 		echo'</div>';//header
	 	echo'</li>';
	 }
 	echo'</ul>';
}		
	    			
?>

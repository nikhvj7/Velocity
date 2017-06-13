<?php 
require '../../query/conn.php';
$sql="SELECT * FROM `checklist`;";
$info=mysqli_query($conn,$sql);
$row=mysqli_num_rows($info);

if($row==0)
 {
 	echo'<h4>No CheckList Added</h4>';
 }
 else
 {
 // 	echo'<table class="highlight bordered">';
 // 	echo'<thead>
 // 			<tr>
	//  			<th>Activity Name</th>
	//  			<th>Shift</th>
	//  		</tr>
	// 	</thead>';
	// echo'<tbody>';
//header		
	echo '<div class="show_row">';
		echo '<div class="inline gqg_no header">Activity Name</div>';
		echo '<div class="inline num_val header">Shift</div>';
				
	echo '</div>';	

		while($data = mysqli_fetch_assoc($info))
		{
		
			// echo'<tr>';
   //              echo '<td>'.$data['activity_name'].'</td>';
   //              echo '<td>'.$data['shift'].'</td>';
   //              ;
                
               
			// echo '</tr>';
// values are HARD CODED
		echo '<div class="show_row">';
			echo '<div class="inline gqg_no">'.$data['activity_name'].'</div>';
			echo '<div class="inline num_val">'.$data['shift'].'</div>';
			
		echo '</div>';			
		}		

	
 	

 }

	    			
?>
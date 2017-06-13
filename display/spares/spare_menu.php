<?php 
// require '../../query/conn.php';

// $sql="SELECT * FROM `parts_menu`;";
// $info=mysqli_query($conn,$sql);
// $row=mysqli_num_rows($info);

// if($row==0)
//  {
//  	echo'<h4>No Parts Added</h4>';
//  }
//  else
//  {
//  	echo'<table class="highlight bordered">';
//  	echo'<thead>
//  			<tr>
// 	 			<th>Sr NO</th>
// 	 			<th>Part Description</th>
// 	 			<th>Part Number</th>
// 	 			<th>Trasnmission</th>
// 	 			<th>Commodity</th>
// 	 			<th>Status</th>
// 	 			<th>change</th>
// 	 			<th>delete</th>
	 			
	 			
// 	 		</tr>
// 		</thead>';
// 	echo'<tbody>';
//         $i=1;
// 		while($data = mysqli_fetch_assoc($info))
// 		{
		
// 			echo'<tr>';
//                 echo '<td>'.$i.'</td>';
//                 echo '<td>'.$data['part_description'].'</td>';
//                 echo '<td>'.$data['part_no'].'</td>';
//                 echo '<td>'.$data['transmission'].'</td>';
//                 echo '<td>'.$data['category'].'</td>';
//                 echo '<td>'.$data['status'].'</td>';
//                 echo '<td></td>';
//                 echo '<td></td>';

                
               
// 			echo '</tr>';
// 			$i++;
// 		}		

// 	echo'</tbody>';
//  	echo'</table>';
 	

//  }

	    			
?>

<?php 
require '../../query/conn.php';
	$sql="SELECT * FROM `parts_menu`;";
	$info=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($info);

	if($row==0)
	 {
	 	echo'<h4>No Parts Added</h4>';
	 }
	 else
	 {
			 	//header		
			echo '<div class="show_row">';
				echo '<div class="inline sr_no header">Sr No</div>';
				echo '<div class="inline gqg_no header">Part Description</div>';
				echo '<div class="inline num_val header">Part Number</div>';
				echo '<div class="inline num_val header">Transmission</div>';		
				echo '<div class="inline num_val header">Commodity</div>';
				echo '<div class="inline num_val_small header">Status</div>';
				echo '<div class="inline num_val_small header">Change</div>';
				echo '<div class="inline num_val_small header" >Delete</div>';
			echo '</div>';

	$i=1;
		while($data = mysqli_fetch_assoc($info))
		{
						 	//header		
			echo '<div class="show_row">';
				
			echo '</div>';
			$i++;					
		}
	 }

?>
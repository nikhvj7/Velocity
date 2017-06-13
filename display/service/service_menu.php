<?php 
require '../../query/conn.php';

$sql="SELECT * FROM `service_menu`;";
$info=mysqli_query($conn,$sql);
$row=mysqli_num_rows($info);

if($row==0)
 {
 	echo'<h4>No Service jobs Added</h4>';
 }
 else
 {
 // 	echo'<table class="highlight bordered">';
 // 	echo'<thead>
 // 			<tr>
	//  			<th>Name</th>
	//  			<th class="hide"></th>
	//  		</tr>
	// 	</thead>';
	// echo'<tbody>';

	// 	while($data = mysqli_fetch_assoc($info))
	// 	{
		
	// 		echo'<tr>';
 //                echo '<td>'.$data['description'].'</td>';
 //                echo '<td class="edit" id='.$data['s_id'].'><i class="material-icons" >edit</i></td>';
 //            echo '</tr>';
	// 	}		

	// echo'</tbody>';
 // 	echo'</table>';

 	
	//header		
	echo '<div class="show_row">';
		echo '<div class="inline gqg_no header">SERVICE NAME</div>';
		echo '<div class="inline num_val header">SERVICE NUMBER</div>';
		
	echo '</div>';

	while($data = mysqli_fetch_assoc($info)){	
	

	// values are HARD CODED
		echo '<div class="show_row">';
			echo '<div class="inline gqg_no">'.$data['name'].'</div>';
			echo '<div class="inline gqg_no">'.$data['sr_num'].'</div>';
			
		echo '</div>';

}

 }

	    			
?>
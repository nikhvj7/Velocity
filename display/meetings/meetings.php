<?php

require '../../query/conn.php';

	$sql = "SELECT * FROM `meeting_new`;";
	$exe = mysqli_query($conn,$sql);

	if(mysqli_num_rows($exe) > 0){

		while($row = mysqli_fetch_assoc($exe)) {

			$id 		= $row['id'];
			$title 	 	= ucwords($row['title']);
			$m_date  	= date("jS M",strtotime($row['date']));
			$content 	= $row['content'];
			$status 	= ucfirst($row['status']);
			$close_date = $row['close_date'];

			if($close_date == "0000-00-00"){ $close_date = ""; }

			echo '<div class="m_show_row" m_id="'.$id.'">';
				echo '<div class="inline m_date">'.$m_date.'</div>';
				echo '<div class="inline m_title">'.$title.'</div>';
				echo '<div class="inline m_content">'.$content.'</div>';
				echo '<div class="inline m_status">'.$status.'</div>';
				echo '<div class="inline m_close_date">'.$close_date.'</div>';
			echo '</div>';
		}
	}

	// no data found
	else{
		echo '<div style="padding:40px;"><h3>No Routes Added</h3></div>';
	}




?>
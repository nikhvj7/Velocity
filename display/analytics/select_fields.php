<?php

	echo '<table>';
	echo '<tr><td></td><td style="font-size:20px;font-weight:500;height:40px;">Select Fields</td></tr>';
	echo '<tr>';
		echo '<td><div class="check all"></div></td>';
		echo '<td><input type="checkbox" class="hide">All</td>';
	echo '</tr>';

	

	// echo '<div><input class="all_fields" type="checkbox" value="all">all</div>';

	$fileds_array = ["shift","route","driver1","start","fuel","fuelodo","stop","trip","toll","clean","mileage"];

	foreach ($fileds_array as $fields ) {
		// echo '<div class="fields_div"><input class="fields" type="checkbox" value='.$fields.'>'.$fields.'</div>';
		// if(($fields == "driver1") || ($fields == "driver1")){



		// } 


		echo '<tr>';	
			echo '<td><div class="check"></div></td>';
			echo '<td><input type="checkbox" value="'.$fields.'" class="hide fields">'.$fields.'</td>';
		echo '</tr>';
		
	}
	echo '</table>';

	echo '<div class="mat_btn" id="submit_fields">NEXT</div>';	
	// echo '<div class="mat_btn" id="ex_report">REPORT</DIV>';
 
?>
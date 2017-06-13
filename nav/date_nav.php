<?php
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d'); 
?>

<!-- select week controls -->
<div id="cntrl_bar">
	<div id="day_cntrls">
		<div id="date_selector"><input type="date" id="date_input" value="<?php echo $date ;?>"></div>
		<div id="day_of_week_selector">
			<div class="dow_single border_right sub_active">M</div>
			<div class="dow_single border_right">T</div>
			<div class="dow_single border_right">W</div>
			<div class="dow_single border_right">T</div>
			<div class="dow_single border_right">F</div>
			<div class="dow_single border_right">S</div>
			<div class="dow_single">S</div>					
		</div>		
	</div>

</div>
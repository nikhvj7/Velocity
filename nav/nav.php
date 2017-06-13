<?php
if(!isset($_SESSION))
{
	session_start();
}

	$nav_array = [
	"home",
	"id_map",
	"operations",
	"customers",
	"logout"
	];





for($i=0;$i<sizeof($nav_array);$i++) {

	// make active div
	if( $nav_array[$i] == $active_page ) {

		$nav_display = str_replace("_"," ",$nav_array[$i]);
		$nav_display = ucwords($nav_display);
		echo '<div class="side_nav_single"><a class="a_active">'.$nav_display.'</a></div>';
	}
	else {

		$nav_display = str_replace("_"," ",$nav_array[$i]);
		$nav_display = ucwords($nav_display);
		echo '<div class="side_nav_single"><a href="'.$nav_array[$i].'.php">'.$nav_display.'</a></div>';
	}

	// add spacer div
	if( in_array($nav_array[$i], ["id_map","customers"]) ) {

		echo '<div class="space_nav"></div>';
	}
}



?>
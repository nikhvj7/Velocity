<?php
	
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];

	$location = $lat.",".$lon;

	$target_url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$location."&key=AIzaSyDcV1fxrzRaed1564kT00yB1jxh1fvhNMM";
	$result = file_get_contents($target_url);
	$json = json_decode($result, True);
	$address = $json['results'][0]['address_components'];

	for ($i=0; $i < sizeof($address); $i++) { 

		// echo $address[$i]['short_name'];

		// echo '<pre>';
		// 	 print_r($address[$i]['types']);
		// echo '</pre>';

		$address_type = $address[$i]['types'];

		for ($j=0; $j < sizeof($address_type) ; $j++) { 
			if ($address_type[$j] == 'administrative_area_level_2') {
				echo $address[$i]['short_name'];
			}
		}
		
	}

?>	
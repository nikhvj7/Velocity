<?php
	$firstName = $lastName = $phoneNumber = "";
	if(isset($_GET['firstName'])){
		$firstName = $_GET['firstName'];
		$lastName = $_GET['lastName'];
		$phoneNumber = $_GET['phoneNumber'];
	}
?>
<body>

	<div id="form_main">

		<div class="show_row">Add New Customer</div>

		<div id = "form_content">

				<div class="form_spacer"></div>
				<div class="form_spacer"></div>
				<div class="form_row">
					<div class="form_inline text_placeholder">First Name</div>
					<div class="form_inline input_placeholder"><input type="text" class = "cust_name" id="first_name" value = <?php echo $firstName?>><span class="bar"></span></div>
				</div>

				<div class="form_row">
					<div class="form_inline text_placeholder">Last Name</div>
					<div class="form_inline input_placeholder"><input type="text" class = "cust_name" id="last_name" value = <?php echo $lastName?>><span class="bar"></span></div>
				</div>

				<div class="form_row">
					<div class="form_inline text_placeholder">Phone Number</div>
					<div class="form_inline input_placeholder"><input type="text" id="phone_number" value = <?php echo $phoneNumber?>><span class="bar"></span></div>
				</div>

				
				
				
				
		</div>

		<div id="webcam">

				<script src="webcam.js"></script>
				<script language="JavaScript">
				    Webcam.attach( '#webcam' );
				    
				    function take_snapshot() {
				        Webcam.snap( function(data_uri) {
				            document.getElementById('webcam').innerHTML = '<img src="'+data_uri+'"/>';
				        });
				    }
				</script>
				
					<div class="mat_btn">CAPTURE</div>

		</div>

		<div class="form_spacer"></div>
		

		<div class="form_button_holder">
			<div class="mat_btn" id="cancel">CANCEL</div>
			<div class="mat_btn" style="margin-left: 25px;background-color: #0087C1;" id="addcustnext" >NEXT</div>
		</div>
	</div> 

</body>

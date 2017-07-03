<?php
	$firstName = $lastName = $phoneNumber = $age=$email="";
	if(isset($_GET['firstName'])){
		$firstName = $_GET['firstName'];
		$lastName = $_GET['lastName'];
		$phoneNumber = $_GET['phoneNumber'];
		$age=$_GET['age'];
		//$email=$_GET['email'];
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
					<div class="form_inline text_placeholder">LastadfdffName</div>
					<div class="form_inline input_placeholder"><input type="text" class = "cust_name" id="last_name" value = <?php echo $lastName?>><span class="bar"></span></div>
				</div>
<div class="form_row">
					<div class="form_inline text_placeholder">LastadfdffssName</div>
					<div class="form_inline input_placeholder"><input type="text" class = "cust_name" id="last_name" value = <?php echo $lastName?>><span class="bar"></span></div>
				</div>

				<div class="form_row">
					<div class="form_inline text_placeholder">Age</div>
					<div class="form_inline input_placeholder"><input type="text" class = "cust_name" id="age" value = <?php 
					echo $age?>><span class="bar"></span></div>
				</div>


				<div class="form_row">
					<div class="form_inline text_placeholder">Phone Number</div>
					<div class="form_inline input_placeholder"><input type="text" id="phone_number" value = <?php echo $phoneNumber?>><span class="bar"></span></div>
				</div>

				<div class="form_row">
					<div class="form_inline text_placeholder">Email-ID</div>
					<div class="form_inline input_placeholder"><input type="text" id="email" value = <?php echo $email?>><span class="bar"></span></div>
				</div>

			</div>

		<div class="c_space" id="child_add">
			<div class="mat_btn" id="C1">ADD CHILDREN</div>

		</div>

		

		<div class="form_spacer"></div>
		

		<div class="form_button_holder">
			<div class="mat_btn" id="cancel">CANCEL</div>
			<div class="mat_btn" style="margin-left: 25px;background-color: #0087C1;" id="addcustnext" >NEXT</div>
		</div>
	</div> 

</body>

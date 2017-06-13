<?php
require 'lock.php';

if(!isset($_SESSION))
{
  session_start();
}

date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Operations</title>
	<link rel="apple-touch-icon" sizes="57x57" href="css/favi5/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="css/favi5/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="css/favi5/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="css/favi5/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="css/favi5/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="css/favi5/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="css/favi5/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="css/favi5/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="css/favi5/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="css/favi5/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="css/favi5/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="css/favi5/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="css/favi5/favicon-16x16.png">
	<link rel="manifest" href="css/favi5/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="css/favi5/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">	
	<script type="text/javascript" src="js/date.js"></script>
	
	<link href="css/main.css" rel="stylesheet">
	<link href="css/company_nav.css" rel="stylesheet">
	<link href="css/date_nav.css" rel="stylesheet">	
	
	<style type="text/css">
		#wrapper_big_screen{width: 100%;background-color: white;}

		.add_remark:hover{cursor: pointer;cursor: hand; color: black;}
		/*controls*/

			

		#snackbar{
			/*display: none;*/
			position: fixed;bottom: -50px;
			width: 400px;
			height: 50px;
			background-color: rgb(20,20,20);
			color: white;
			right: 0;
			margin-right: 40px;
			line-height: 50px;
			padding-left: 24px;
		}

		.viewpager_header{
			height: 45px;line-height: 45px;
			position: absolute;background-color: #F5F5F5;
			margin-left: 500px;
			margin-top: 10px;
		}
		.viewpager_tabs{
			width: 110px;text-align: center;color: #8E8E8E;font-weight: 500;display: inline-block;
			font-size: 14px;
			margin-right: -4px;
		}
		.viewpager_tabs:not(.tab_active):hover{cursor: pointer;}
		.tab_active{border-bottom: 2.5px solid #34CCB2;color: #3A3A3A;}   
		.tab_active:hover{cursor: default;}
			
		#result{margin-top: 120px;background-color: #DBDBDB;}


		.radial_anim{
			width: 40px;
			height: 40px;
			position: absolute;
			border:1px solid transparent;
			border-radius: 50%;
			background-color: rgb(220,220,220);
			/*background-color: blue;*/
			animation-name: radial;
			animation-duration: 1s;
		}

		@keyframes radial {
			from {
				transform: scale(1);
				opacity: 1;
			}
			to {
				transform: scale(1.5);
				opacity: 0;
			}
		}

		/*table styling here*/
		#week_table_holder{ 
			float: left;
			padding: 50px;
			margin-top: 20px;
			/*margin-left: 50px;*/
			background-color: white;overflow: hidden;border-radius: 5px;}


		table{border-collapse: collapse; margin-left: 30px;}
		td{border: 1px solid rgb(200,200,200);font-size: 14px;color: rgb(20,20,20);}
		.field_text{width: 80px;padding: 5px;padding-left: 10px;}
		.field_text:nth-child(odd){background-color: rgb(248,248,248);}		

		.val_text{width: 80px;text-align: right;padding: 5px;}
		.val_text:nth-child(odd){background-color: rgb(248,248,248);}		
	
		.underline_toggle{border-bottom: 1px solid rgb(230,230,230);/*margin-bottom: 3px;padding-bottom: 3px;*/}
		.center{text-align: center;}

		.toggle{display: none;}



		/*shift selector*/
		.shift_selector{
			padding-left: 0px;
			width: 330px;
			height: 48px;
			z-index: 0;
			background-color: #F5F5F5;
			margin-left: 3.5%;
			margin-bottom: 10px;
			margin-top: 140px;
			border-radius: 2px;
			border-bottom:1px solid #BABAAE;
			border-top: 1px solid white;
			-webkit-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			-moz-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
		}
		.viewpager_header{
			height: 45px;line-height: 45px;
			position: absolute;background-color: #F5F5F5;}
		.viewpager_tabs{
			width: 110px;text-align: center;color: #8E8E8E;font-weight: 500;display: inline-block;
			font-size: 14px;
			margin-right: -4px;
			}
		.viewpager_tabs:not(.tab_active):hover{cursor: pointer;}
		.tab_active{border-bottom: 2.5px solid #34CCB2;color: #3A3A3A;}		
		.tab_active:hover{cursor: default;}

		#daily_ops_container{
			/*background-color: green;*/
			width: 95%;margin:0 auto;height: auto;}
		.daily_ops_card_holder{
			/*background-color: yellow;*/
			width: 33%;display: inline-block;margin-right: -4px;
		}
		.daily_op_card{
			/*width: 95%;*/
			width: 330px;
			margin: 10px auto;
			background-color: #F5F5F5;			
			border-radius: 3px;
			border-bottom:1px solid #BABAAE;border-top: 1px solid white;
			-webkit-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			-moz-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
		}
		.daily_gqg{margin-top: 16px;padding-left: 16px;border-bottom: 1px solid rgb(220,220,200);padding-bottom: 16px;font-weight: 700;color: rgba(0,0,0,0.6);}
		.data_margin{padding-left: 24px;padding-right: 24px;margin-top: 16px;border-bottom: 1px solid rgb(220,220,200);padding-bottom: 16px;}
		.op_float{			
			display: inline-block;
			padding-top: 4px;
			margin-right: -4px;
			vertical-align: top;
			padding-left: 18px;
			padding-right: 18px;
			/*padding-bottom: 8px;*/
			height: auto;
			/*background-color: green;*/
			width: calc(50% - 20px);
		}

		.finish:hover{cursor: pointer;background-color: #CCC;width: 40px;}


		.ops_data{display: inline-block;width: 50%;
			/*background-color: yellow;*/
			height: 25px;line-height: 25px;
			color: rgba(0,0,0,0.67);
		}
		.op_vals{text-align: right;color: rgba(0,0,0,0.7);}
		.op_route{
			/*background-color: green;*/
			height: 30px;line-height: 30px;padding-left: 18px;color: rgba(0,0,0,0.45);padding-bottom: 4px;}
		.op_actions{height: 36px;border-top: 1px solid rgb(220,220,200);line-height: 36px;padding-left: 16px;font-size: 13px;font-weight: 500;font-style: italic;color: rgba(0,0,0,0.6);

		}

		#toggle_drawer:active{background-color: #138e5d;}



		@media only screen and (min-width: 1200px)and (max-width: 1366px) {
			#cntrl_bar{width: calc(100% - 224px);}
		}


		@media only screen and (min-width: 1400px) {
			#cntrl_bar{width: calc(100% - 224px);}
		}

		@media only screen and (min-width: 1600px) {
			.daily_ops_card_holder{width: 25%;}
			.daily_op_card{width: 370px;}
			.viewpager_tabs{width: 122px;}
			.shift_selector{width: 370px;}
		}

		/*REFACTOR - this should be within media queries above */
		/*scroll helper media queries*/
		@media only screen and (max-width: 1700px) {
			#weekly_scroll_helper{
				-webkit-box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.45);
				-moz-box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.45);
				box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.45);
			}
		}

		@media only screen and (min-width: 1701px) {
			#weekly_scroll_helper{
				display: block;
				bottom: 0;
			}
			#toggle_drawer{display: none;}
		}
	</style>

	<!-- g charts -->
	<script type="text/javascript" src="js/jquery.js"></script>	
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			// snackbar functions
			function showSnackBar(message) {
				$('#snackbar').text(message);
				$('#snackbar').animate({'bottom':'0'},function() {
					setTimeout(function(){
						$('#snackbar').animate({'bottom':'-50px'});           
					},2000);
				});
			}

	

			function getDaily(){
						
				$('#result').load('display/operations/daily_operations.php');
			}
			

			getDaily();
			

			
			// toggle more details
			$('body').delegate('#toggle','click',function(){

				if($('.toggle').is(':visible')){
					$('.toggle').hide();
					$('.underline').removeClass('underline_toggle');
				}else{
					$('.toggle').show();
					$('.underline').addClass('underline_toggle');
				}
			});	

			// toggle more details
			$('body').delegate('.finish','click',function(){

				var id = $(this).attr('opid');
				var action = 'finish';

				var url = 'api/operations';
			
			
					var myObject = {};
					myObject.id = id;
					myObject.action = action;

					
					json_string = JSON.stringify(myObject);
					console.log(json_string);

					$.ajax({
						url: url,
						type: 'POST',
						contentType: "application/json",
						data:json_string,
						success: function(response){
							showSnackBar(response);
							$('#result').load('display/operations/daily_operations.php');
							
						}
					});
				
			});	


		});
	</script>
</head>
<body>

<!-- app nav -->
<div id="app_bar">	
	<div id="menu"><img src="css/icons/ic_menu.png"></div>
	<div id="app_name">Timer</div>
</div>

<!-- side nav -->
<div id="side_nav">
	<div id="side_nav_padding">
		<?php $active_page = 'operations'; ?>
		<?php include_once 'nav/nav.php'; ?>
	</div>
</div>

<div id="wrapper">

		<!-- load week table here -->
		<div id="result"></div>

</div><!-- wrapper -->



<!-- snackbar -->
<div id="snackbar"></div>

</body>
</html>




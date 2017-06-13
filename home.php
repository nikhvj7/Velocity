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
<!-- <?php 
// require 'query/conn.php';



?> -->
<!DOCTYPE html>
<html>
<head>
	<title>Timer-Velocity</title>
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

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/date.js"></script>

	<script type="text/javascript" src="js/main.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#3541CA">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/date_nav.css" rel="stylesheet">
	<style type="text/css">
		/*over ride default*/
		#wrapper_big_screen{background-color: #DBDBDB; margin: 0 auto;}

		.card_holder{
			width: 33%;
			min-height: 250px;
			height: auto;
			display: inline-block;
			margin-right: -4px;
			vertical-align:top;
			/*background-color: yellow;*/
			/*padding-bottom: 50px;*/
		}
		.card_holder:nth-child(2){/*background-color: black;*/width: 34%;}

		.chart_holder{
			width: 67%;
			min-height: 250px;
			height: auto;			
			display: inline-block;
			margin-right: -4px;
			vertical-align:top;
			/*background-color: yellow;*/
			padding-bottom: 50px;
		}
		#chart_content{			
			width: 710px;background-color: green;margin: 0 auto;height: 470px;
			border-radius: 3px;
			background-color: #F5F5F5;
			-webkit-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			-moz-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
		}

		.card2{width: 350px;background-color: #F5F5F5;min-height: 470px;/*margin: 30px auto;*/border-radius: 3px;
			border-bottom:1px solid #BABAAE;border-top: 1px solid white;height: auto;
			float: right;
			margin-top: 30px;
			-webkit-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			-moz-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
		}
		.card3{width: 350px;background-color: #F5F5F5;min-height: 470px;height: auto;margin: 30px auto;border-radius: 3px;border-bottom:1px solid #BABAAE;border-top: 1px solid white;
			position: relative;
			-webkit-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			-moz-box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
			box-shadow: 0px 0px 10px 3px rgba(200,200,200,1);
		}

		.card_small{
			float: left;
			width: 350px;height: 225px;background-color: #F5F5F5;border-radius: 3px;margin: 0px auto;}

		/*card specific styling*/
		.viewpager_header{height: 40px;line-height: 40px;position: absolute;background-color: #F5F5F5;}
		.viewpager_tabs{width: 100px;text-align: center;color: #8E8E8E;font-weight: 500;display: inline-block;
			font-size: 14px;
			}
		.viewpager_tabs:not(.tab_active):hover{cursor: pointer;}
		.tab_active{border-bottom: 2.5px solid #34CCB2;color: #3A3A3A;}		
		.tab_active:hover{cursor: default;}
		.viewpager_content{margin-top: 40px;overflow: auto;
			overflow-x: hidden;
			/*max-height: calc(100vh - 220px);*/
			max-height: 390px;
		}

		.convoy:last-child{margin-bottom: 25px;}
		.route_name{height: 40px;line-height: 40px;padding-left: 24px;color: #34CCB2;font-weight: 500;font-size: 0.9em;/*background-color: green;*/}		
		.gqg_no{padding-left: 24px;height: 24px;line-height: 24px;color: #686868;}
		.gqg_no:hover{opacity: 0.6;cursor: pointer;}
		.su_name{float:right; margin-right:18px;font-size: 13px;font-weight: 500;font-style: italic;color: rgba(0,0,0,0.6);}


		table{width: 100%;border-collapse: collapse;color: #7F7F7F;}
		table td{/*border:1px solid black;*/}
		.center{text-align: center;}
		.right{text-align: right;width: 26px;padding-right: 4px;height: 32px;}
		.summary_field{padding-left: 8px;}
		.shift{width: 36px;font-size: 1.6em;}	
		.end{padding-right:10px;}	
		tr{border-bottom: 1px solid #E8E8DA;}		
		tr:last-child{border-bottom: 1px solid transparent;}		
		

		/*notification card*/
		#notification_header{
			color: rgba(0,0,0,0.5);font-weight: 700;font-size: 14px;height: 40px;line-height: 40px;
			/*background-color: green;*/
			padding-left: 24px;
			border-bottom: 1px solid #D3D3C5;
		}
		#notification_content{
			/*background-color: green;*/
			padding: 18px;			
			overflow: auto;
			height: 350px;
			max-height: 350px;
			/*border-bottom: 1px solid #D3D3C5;*/
		}
		#notification_details{
			/*background-color: green;*/
			float: right;height: 40px;line-height: 40px;padding-right: 8px;font-size: 13px;font-weight: 700;color: #7F7F7F;}
		.notification_single{
			/*background-color: green;*/
			color: #7F7F7F;
			padding-left: 6px;
			margin-right: 12px;
			height: 40px;
			line-height: 40px;
			border-bottom: 1px solid rgb(235,235,235);
		}

		#chart_header{margin-left: 70px;font-size: 20px;padding-top: 50px;color: rgba(0,0,0,0.76);}
		#chart_div{
			margin-top: 20px;
			height: 300px;		
			background-color: #DBDBDB;
		}

	</style>
	
	<script type="text/javascript">
		$(document).ready(function(){

			function showDayControls(){	
				view = 'daily';	
				$('#week_cntrls').hide();
				$('#weekly_scroll_helper').html("");
				$('#weekly_scroll_helper').hide();
				$('#toggle_drawer').hide();
				$('#day_cntrls').show();

				day_of_week = today.clone();
	
				$('#date_input').val(today.getDateString());
				var i = (today.getDay() - 1);
				$('.dow_single').removeClass('dow_active');
				$('.dow_single:eq('+i+')').addClass('dow_active');
				$('.shift_selector').show();
				
				getDaily(date,comp_id);	
			}

			// add anim around button
			function radial_fade(fade_div){
				var offset = fade_div.position();
				var $div = $('<div class="radial_anim"></div>');
				$div.css({
					top: offset.top,
					left: offset.left
				});
				fade_div.append($div);
				window.setTimeout(function(){
					$div.remove();
				}, 600);
			}

			// date functions
			function getNextMonday(date){ return date.next().monday(); }

			function getNextSaturday(date){	return date.next().saturday(); }

			function getPrevMonday(date){ return date.last().monday(); }

			function getPrevSaturday(date){ return date.last().saturday(); }

			function getWeekNum(date){ return date.getWeek(); }

			function addZero(n){ return n<10? '0'+n:''+n; }

			function getDaily(date,comp_id){

				//$('#result').load('display/dash/data.php?date='+date+'&comp_id='+comp_id);

			}

			// get string from date object
			Date.prototype.getDateString = function() {
				var month = addZero((this.getMonth()+1));
				var day = addZero(this.getDate());
				return this.getFullYear()+'-'+month+'-'+day;
			}

			// main function
			function init(){

				day_of_week = today.clone();

				if(today.getDay() == 1){					// if monday, use today
					monday = today.clone();	
				}
				else if(today.getDay() == 0){				// if sunday use next monday
					monday = getNextMonday(today.clone());
					week_num++;
				}
				else{
					monday = getPrevMonday(today.clone());	// else day is past monday, use prev monday
				}

				if(today.getDay() == 6){
					saturday = today.clone();	
				}else{
					saturday = getNextSaturday(today.clone());
				}

				
				console.log('Mon:' + monday.getDateString());
				console.log('Sat:' + saturday.getDateString());
				console.log('Wno:' + week_num);
				date1 = monday.getDateString();
				date2 = saturday.getDateString();

				showDayControls();
				// getWeekly(date1, date2, week_num, comp_id, comp_name);
				//to be replace by daily display
				
			}

			// globals
			var today = Date.today();
			var date = Date.today().getDateString();
			var shift = 'a';
			var comp_id = 1;
			var comp_name = $('.company_bar_company.company_bar_company_active').text();
			var monday, saturday, week_num, day_of_week,date1,date2;			
			init();

			// $('#result').load('display/problems/weekly_problems.php?date1=d&date2=h');

			// click functions
			// company Selector
			$('.company_bar_company').on('click',function(){
				if(!$(this).hasClass('company_bar_company_active')){
					$('.company_bar_company').removeClass('company_bar_company_active');
					$(this).addClass('company_bar_company_active');

					comp_id = $(this).attr('company_bar_comp_id');
					comp_name = $(this).text();
					console.log(comp_id);

					if (view == 'weekly') {
						getWeekly(date1, date2, week_num, comp_id, comp_name);
					}else if (view == 'daily'){
						getDaily(date,comp_id);
					}
				}
			});

			// choose day of week
			$('.dow_single').on('click',function(){

				if(!$(this).hasClass('dow_active')){

					var act_d = $('.dow_active').index();
					var new_d = $(this).index();
					// console.log(act_d);
					// console.log(new_d);

					$('.dow_single').removeClass('dow_active');
					$(this).addClass('dow_active');

					var get_d = new_d - act_d;

					var display_date = day_of_week.add(get_d).days().getDateString();
					$('#date_input').val(display_date);
					date = display_date;
					getDaily(date,comp_id);
				}
			});

			// handle date change
			$('#date_input').on('change',function(){
				 
				if($(this).val() != ""){
					var temp = Date.parse($(this).val());
					var i = (temp.getDay() -1);
					// if(i == -1){
					// 	alert('Sunday! No data');
					// 	$(this).val(day_of_week.getDateString());
					// }else{
						date = $(this).val();
						day_of_week = temp;
						$('.dow_single').removeClass('dow_active');
						$('.dow_single:eq('+i+')').addClass('dow_active');
						getDaily(date,comp_id);
					// }
				}
			});


			// toggle click
			$('body').delegate('#toggle_drawer','click',function(){
				if(!$('#weekly_scroll_helper').is(':visible')){
					$('#weekly_scroll_helper').fadeIn();
					$('#weekly_scroll_helper').animate({bottom: '0px'},function(){
						$('#toggle_drawer').css('background-image','url(css/icons/ic_down.png)');	
					});
					
				}else{

					$('#weekly_scroll_helper').animate({bottom: '-600px'},function(){
						$('#toggle_drawer').css('background-image','url(css/icons/ic_up.png)');	
					});
					$('#weekly_scroll_helper').fadeOut();
				}				
			});

			
		});
	</script>
	
</head>

<!-- app nav -->
<div id="app_bar">	
	<div id="menu"><img src="css/icons/ic_menu.png"></div>
	<div id="app_name">Spartan</div>
</div>

<!-- side nav -->
<div id="side_nav">
	<div id="side_nav_padding">
		<?php $active_page = 'index'; ?>
		<?php include_once 'nav/nav.php'; ?>

	</div>
</div>

<?php include_once 'nav/date_nav.php'; ?>
<div id="wrapper">

	<div id="wrapper_big_screen">
		
	</div>
</div><!-- wrapper -->

<body>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Anim</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){


		var interval = null;
		var count = 0;

		function blinkFunction(){
			
			var elem = $('#driver_time');				
			if (elem.css('visibility') == 'hidden') {
				elem.css('visibility', 'visible');
			}
			else{
				elem.css('visibility', 'hidden');
			}
			++count;
			console.log(count);
			if(count == 6){
				clearInterval(interval);
			}
		}

		$('#o').on('click',function(){
			count = 0;
			interval = setInterval(blinkFunction, 750);
			$("#two").animate({			
				right: "0"
			},1000);
		});

		$('#t').on('click',function(){
			$("#two").animate({			
				right: "-100%"			
			},1000);
		});





			
		
		
	});
	</script>
	<style type="text/css">
		*{padding: 0;margin: 0;}

		@font-face {
			font-family: r_bold;
			src: url(css/fonts/RobotoMono-Bold.ttf);
		}
		@font-face {
			font-family: r_bold_italic;
			src: url(css/fonts/RobotoMono-BoldItalic.ttf);
		}		

		body{font-family: r_bold;background-color: rgb(22,22,22);}

		#wrapper{overflow: hidden;position: relative;width: 100%;height: 100vh;}

		#one{
			position: absolute;
			width: 100%;height: 100vh;z-index: 0;
		}
		#two{
			background-color: rgb(22,22,22);
			position: absolute;
			height: 100vh;
			width: 100%;
			right: -100%;			
		}


		/*flex*/
		#flex_parent{display: -webkit-flex;margin-top: 30px;}
		.flex_2{display: inline-block;width: 50%;}
		#flex_parent table{width: 95%;border-collapse: collapse;margin-left: auto;margin-right: auto;font-size: 28px;color: rgb(200,200,200);}
		#flex_parent td{border:1px solid transparent;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;}
		#flex_parent td.flex_name{color: orange;font-family: r_bold_italic;}
		#flex_parent td.flex_score{text-align: right;color: rgb(150,150,150);}
		#flex_parent tr:nth-child(odd){background-color: rgb(40,40,40);}	


		/*driver*/
		#driver_main{margin-left: 90px;}		
		#driver_lap{font-size: 150px;color: yellow;font-family: r_bold_italic;margin-top: 25px;}
		#driver_time{font-size: 250px;color: yellow;}
		#driver_name{font-size: 100px;text-align: right;margin-right: 100px;margin-top: 20px;font-family: r_bold_italic;color: rgb(220,200,200);}

	</style>
</head>
<body>

<div id="wrapper">
	<div id="one">
		<button id="o">Click</button>
		<div id="flex_parent">


			<div class="flex_2">
				<table>
				<?php  
				for($i=0;$i<12;$i++){
				echo '<tr>
					<td class="flex_name">Narendra M</td>			
					<td class="flex_score">1:34:565</td>
					<td class="flex_score">10:04:895</td>
				</tr>';	
				}
				?>		
				</table>
			</div>

			<div class="flex_2">
				<table>
				<?php  
				for($i=0;$i<12;$i++){
				echo '<tr>
					<td class="flex_name">Narendra M</td>			
					<td class="flex_score">1:34:565</td>
					<td class="flex_score">10:04:895</td>
				</tr>';	
				}
				?>		
				</table>			
			</div>
		</div><!-- flex_parent -->
	</div>

	<div id="two">
		<button id="t">Click</button>
		<div id="driver_main">	
			<div id="driver_lap">LAP 3</div>
			<div id="driver_time" class="blink">1:34:345</div>	
			<div id="driver_name">NARENDRA M</div>	
		</div>
	</div>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Sign</title>
	<style type="text/css">
		*{padding: 0;margin: 0;}
		#sign_canvas{
			border:1px solid black;
		}
	</style>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var canvas, ctx, flag = false,
				prevX = 0,
				currX = 0,
				prevY = 0,
				currY = 0,
				dot_flag = false;

			var x = "black",
				y = 2;

			function init() {
				canvas = document.getElementById('sign_canvas');
				ctx = canvas.getContext("2d");
				w = canvas.width;
				h = canvas.height;

				canvas.addEventListener("mousemove", function (e) {
				findxy('move', e)
				}, false);
				canvas.addEventListener("mousedown", function (e) {
				findxy('down', e)
				}, false);
				canvas.addEventListener("mouseup", function (e) {
				findxy('up', e)
				}, false);
				canvas.addEventListener("mouseout", function (e) {
				findxy('out', e)
				}, false);
			}

			function findxy(res, e) {
				if (res == 'down') {
					prevX = currX;
					prevY = currY;
					currX = e.clientX - canvas.offsetLeft;
					currY = e.clientY - canvas.offsetTop;

					flag = true;
					dot_flag = true;
					if (dot_flag) {
						ctx.beginPath();
						ctx.fillStyle = x;
						ctx.fillRect(currX, currY, 2, 2);
						ctx.closePath();
						dot_flag = false;
					}
				}
				if (res == 'up' || res == "out") {
					flag = false;
				}
				if (res == 'move') {
					if (flag) {
						prevX = currX;
						prevY = currY;
						currX = e.clientX - canvas.offsetLeft;
						currY = e.clientY - canvas.offsetTop;
						draw();
					}
				}
			}

			function draw() {
				ctx.beginPath();
				ctx.moveTo(prevX, prevY);
				ctx.lineTo(currX, currY);
				ctx.strokeStyle = x;
				ctx.lineWidth = y;
				ctx.stroke();
				ctx.closePath();
			}

			init();


			$('#save_btn').on('click',function(){				
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				var image = canvas.toDataURL("image/png");
				//window.location.href=image; // it will save locally

				$.ajax({
					url : 'exe/save_cust_photo.php',
					type : 'POST',					
					data:{
						data 	: image,
						cu_id	: 2,
					},
					success : function(response){
						console.log(response);
					}
				});
			});

		});


	</script>
</head>
<body>

<canvas id="sign_canvas" width="640" height="320"></canvas>

<button id="save_btn">Save</button>

</body>
</html>
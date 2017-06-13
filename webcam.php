<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#retake_photo').hide();
			$('#canvas').hide();
			$('videoElement').show();
			// video init
			var video = document.getElementById('videoElement');			
			// canvas inits
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');

			

				// get a video handle
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

			// Get access to the camera!
			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
				// Not adding `{ audio: true }` since we only want video now
				navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
					video.src = window.URL.createObjectURL(stream);
					video.play();
				});
			}

			

			$('#click_photo').on('click',function(){
				context.drawImage(video, 0, 0, 640, 480);
				$('#canvas').show();
				$('#videoElement').hide();
				$('#retake_photo').show();
				$('#click_photo').hide();
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				var image = canvas.toDataURL("image/png");
				var type = "photo";
				//window.location.href=image; // it will save locally

				$.ajax({
					url : 'save_cust_photo.php',
					type : 'POST',					
					data:{
						data 	: image,
						cu_id	: 1,
						type 	: type

					},
					success : function(response){
						console.log(response);
					}
				});
			});

			$('#retake_photo').on('click',function(){
				$('#canvas').hide();
				$('#videoElement').show();
				$('#retake_photo').hide();
				$('#click_photo').show();

			});

		});
	</script>

	<style type="text/css">
		#videoElement{
			position: absolute;
		}
		#click_photo{
			float: right;
		}
		#retake_photo{
			float: right;
		}

	</style>
</head>
<body>

<div class = "bhari">
	<video autoplay="true" id="videoElement" width="640" height="480"></video>
	<button id="click_photo">Click Photo</button>
	<button id="retake_photo">Retake Photo</button>
	<canvas id="canvas" width="640" height="480"></canvas>
</div>




</body>
</html>
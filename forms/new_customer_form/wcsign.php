<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			//$('#canvas').hide();
			//$('#retake_photo').hide();
			// video init
			var video = document.getElementById('videoElement');			
			// canvas inits
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');


			// get a video handle
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

			// Get access to the camera!
			function initCamera(){
				if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
				// Not adding `{ audio: true }` since we only want video now
					navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
						video.src = window.URL.createObjectURL(stream);
						video.play();
					});
				}	
			}
			
			initCamera();
			
			$('#click_photo').on('click',function(){
				context.drawImage(video, 0, 0, 640, 480);
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				var image = canvas.toDataURL("image/png");
				/*$('#videoElement').hide();
				$('#canvas').show();
				$('#retake_photo').show();
				$('#click_photo').hide();*/

				//window.location.href=image; // it will save locally

				$.ajax({
					url : 'save_cust_photo.php',
					type : 'POST',					
					data:{
						data 	: image,
						cu_id	: 1,
					},
					success : function(response){
						console.log(response);
					}
				});
			});

			$('#retake_photo').on('click', function(){

			/*	$('videoElement').show();
				$('#canvas').hide();
				$('#retake_photo').hide();
				$('#click_photo').show();
				*/
				initCamera();

			});


		});
	</script>

	<style type="text/css">
		
		#videoElement{display: inline-block;}
		#canvas{display: inline-block;}
		#click_photo{float:right;}
		#retake_photo{float:right;}
		/*#videoElement {
			width: 500px;
			height: 375px;
			background-color: #666;
		}*/
	</style>
</head>
<body>


<video autoplay="true" id="videoElement" width="640" height="480"></video>
<canvas id="canvas" width="640" height="480"></canvas>
<button id="click_photo">Click Photo</button>
<button id="retake_photo">Retake Photo</button>

</body>
</html>
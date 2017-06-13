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

			var type = "";
			var sign;
			var image;

			var can, ctx, flag = false,
		        prevX = 0,
		        currX = 0,
		        prevY = 0,
		        currY = 0,
		        dot_flag = false;


		    var x = "black",
		        y = 2;
		    
		    function getTimeStamp(){
		    	var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth()+1; //January is 0!
				var hr = today.getHours();
				var min = today.getMinutes();
				var sec = today.getSeconds();

				var yyyy = today.getFullYear();
				if(dd<10){
				    dd='0'+dd;
				} 
				if(mm<10){
				    mm='0'+mm;
				}
				if(hr<10){
					hr='0'+hr;
				}
				if(min<10){
					min='0'+min;
				}
				if(sec<10){
					sec='0'+sec;
				} 
				var today = dd+'/'+mm+'/'+yyyy+'-'+hr+':'+min+':'+sec;	
				return today;
		    }
	    	
		    


		    function init() {
		        can = document.getElementById('can');
		        ctx = can.getContext("2d");
		        w = can.width;
		        h = can.height;
		    
		        can.addEventListener("mousemove", function (e) {
		            findxy('move', e)
		        }, false);
		        can.addEventListener("mousedown", function (e) {
		            findxy('down', e)
		        }, false);
		        can.addEventListener("mouseup", function (e) {
		            findxy('up', e)
		        }, false);
		        can.addEventListener("mouseout", function (e) {
		            findxy('out', e)
		        }, false);
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
		    
		    function erase() {
		        
		        ctx.clearRect(0, 0, w, h);
		        
		        
		    }
		    
		    function save() {
		        ctx.font = '15px Arial';
		        ctx.fillStyle = '#C0C0C0';
		        ctx.globalAlpha = 0.4;
		        ctx.fillText(getTimeStamp(), 5, 12);
		        sign = can.toDataURL('sign/png');
		        type = "sign";
		        $.ajax({
		            url : 'save_cust_photo.php',
		            type : 'POST',                  
		            data:{
		                data    : sign,
		                cu_id   : 1,
		                type    : type
		            },
		            success : function(response){
		                console.log(response);
		            }
		        });
		        
		    }
		    
		    function findxy(res, e) {
		        if (res == 'down') {
		            prevX = currX;
		            prevY = currY;
		            currX = e.clientX - can.offsetLeft;
		            currY = e.clientY - can.offsetTop;
		    
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
		                currX = e.clientX - can.offsetLeft;
		                currY = e.clientY - can.offsetTop;
		                draw();
		            }
		        }
		    }

		    init();

			


			$('#click_photo').on('click',function(){
				context.drawImage(video, 0, 0, 640, 480);
				$('#canvas').show();
				$('#videoElement').hide();
				$('#retake_photo').show();
				$('#click_photo').hide();
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				image = canvas.toDataURL("image/png");
				type = "photo";
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

			$('#btn').on('click',function(){
				save();
			});
			$('#clr').on('click',function(){
				erase();
			});

		});
	</script>

	<style type="text/css">

		
		.bhari{
			
			margin: 50px;
		}
		

		#click_photo, #retake_photo, #btn, #clr{
			display: inline-block;
		      position: relative;
		      padding: 10px 20px;
		      border:none;
		      margin: 10px;
		      background-color: #0087C1;
		      /*background-color: #4285f4;*/
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
		      color: #fff;
		      border-radius: 2px;
		      font-size: 0.9em;
		      text-align: center;
		     font-weight: 500;

		      

		}

		#click_photo:hover{
			cursor: pointer;

		}

		#videoElement, #canvas{
			border-radius: 10px;
		}

		#sign_canvas{
			border: 1px solid #d3d3d3;
			border-radius: 10px;
			padding: 20px;
			width: 30%;
		}

		#can{
			border-bottom: 1px solid #D3D3D3;
			margin: 10px 5px;
		}


	</style>
</head>
<body>

<div id = "main_div">

	<div>Please take your picture </div>

	<div class = "bhari">
		<div id = "webcam">
			<video autoplay="true" id="videoElement" width="640" height="480"></video>
			<canvas id="canvas" width="640" height="480"></canvas>
		</div>

		<div class = "buttons">
			<button id="click_photo">Click Photo</button>
			<button id="retake_photo">Retake Photo</button>
		</div>
		
		
	</div>


	<div id = "sign_canvas" class = "bhari">

		<div>
			<canvas id="can" width="400" height="100"></canvas>
		</div>

		<div class = "buttons">
			<input type="button" value="Save" id="btn" size="30" >
	    	<input type="button" value="Clear" id="clr" size="23">
		</div>

	</div>
</div>

</body>
</html>
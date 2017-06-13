	<!DOCTYPE html>
	<html>
	<head>
	<style type="text/css">
		.mat_btn{
      display: inline-block;
      position: relative;
      /*background-color: #4285f4;*/
      background-color: rgb(100,100,100);
      color: #fff;
      width: 120px;
      height: 32px;
      line-height: 32px;
      border-radius: 2px;
      font-size: 0.9em;
      text-align: center;
      transition: box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      transition-delay: 0.2s;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    }
        .mat_btn:hover{cursor: pointer;}
    .mat_btn:active {
      background-color: rgb(90,90,90);
      box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
      transition-delay: 0s;
    }
    .form_inline{display: inline-block;/*background-color: green;*/}
    .text_placeholder{width: 200px;}
    .input_placeholder input{
      font-size:17px;
      padding:5px 10px 5px 5px;
      display:block;
      width:250px;
      border:none;
      border-bottom:1px solid #757575;
    }
       .form_row{height: 48px;line-height: 48px;padding-left: 64px;color: #6b6b6b;}
	</style>
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

  <link href="css/main.css" rel="stylesheet">
  <link href="css/company_nav.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript">
	$(document).ready(function(){
		var child_count=0;
	  $('#C1').on('click',function(){
	/* $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">Child '+child_count+'</div></div>');
	 child_count++;
      $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">First Name</div><div class="form_inline input_placeholder"><input type="text" class = "child_first_name"</div></div>');
      $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">Last Name</div><div class="form_inline input_placeholder"><input type="text" class = "child_last_name"</div></div>');
      $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">Age</div><div class="form_inline input_placeholder"><input type="text" class = "child_age"</div></div>');*/
 	  $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">Child '+child_count+'</div></div>');
	 child_count++;
      $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">First Name</div><div class="form_inline input_placeholder"><input type="text" class = "child_first_name"</div></div>');
      $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">Last Name</div><div class="form_inline input_placeholder"><input type="text" class = "child_last_name"</div></div>');
      $('#child_add').append('<div class="form_row"><div class="form_inline text_placeholder">Age</div><div class="form_inline input_placeholder"><input type="text" class = "child_age"</div></div>');

    });

	});
		</script>
	</head>
	<body>
	<div class="c_space" id="child_add">
			<div class="mat_btn" id="C1">ADD CHILDREN</div>

		</div>
	</body>
	</html>	

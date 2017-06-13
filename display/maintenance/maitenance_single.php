<?php 
require '../../query/conn.php';
if(isset($_GET['car_id'])){
	echo 'single problems';
	echo'<br />';
	$values = $_GET['car_id'];
	echo $values;

}?>
<!DOCTYPE html>
<html>
<head>
  <title>COMPANIES PROTO</title>
<link href="css/main.css" rel="stylesheet">
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
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){

      // snackbar functions
      function showSnackBar(message){
        $('#snackbar').text(message);
        $('#snackbar').animate({'bottom':'0'},function(){
          setTimeout(function(){
            $('#snackbar').animate({'bottom':'-50px'});           
          },2000);
        });
      }

      // main
      function init(){
        // $('#result').load('display/view_companies.php');
        $('#result').load('display/companies/companies.php');
      }

      // globals
      init();

      // click functions
      // fab
      $('body').delegate('#fab', 'click', function() {

        $.ajax({
          url  : 'form/companies/new_company.php',
          type : 'get',
          success: function(response){
            $('#result').html(response);                   
          }
        });

        $(this).hide();
      }); 

            // cancel edit
      $('body').delegate('#cancel', 'click', function() {

        $('#result').empty();
        $('#result').load('display/companies/companies.php');
        $('#fab').show();
      });


      $('body').delegate('#save_company', 'click', function() {
        var url = 'api/companies';
        var cin = $("#cin").val();
        var company_name=$("#company_name").val();
        if((cin=='')||(company_name==''))
        {
          // alert("please enter appropriate value");
          showSnackBar("Please enter appropriate values!");
        }
        else{
          var myObject = {};
          
          myObject.companyname = company_name;
          myObject.cin = cin;
        
          json_string = JSON.stringify(myObject);
                      
          $.ajax({
            url: url,
            type: 'post',
            contentType: "application/json",
            data:json_string,
            success: function(response){
             console.log(json_string);
             showSnackBar("New Company Added!");
             $('#result').load('display/companies/companies.php');
             $("#fab").show();
            }
          });
        }
      });    


      $('body').delegate('.input_placeholder input', 'focus', function() {
          $(this).parent().parent().find('.text_placeholder').addClass('text_selected');
      });

      $('body').delegate('.input_placeholder input', 'focusout', function() {
          $(this).parent().parent().find('.text_placeholder').removeClass('text_selected');
      });
      
    });
  </script>
  <style type="text/css">
    /*@override*/
    #wrapper{overflow: hidden;}
    
    #result{width: 964px;background-color: white;margin: 30px auto;}

    .text_selected{color: #5264AE;font-weight: 500;} 

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

    .show_row{
      height: 48px;line-height: 48px;padding-left: 24px;border-bottom: 1px solid rgb(240,240,240);
    }
    .inline{display: inline-block;vertical-align: top;}
    .gqg_no{width: 180px;}
    .num_val_small{width: 65px;text-align: right;padding-right: 10px;}
    .num_val{width: 115px;text-align: right;padding-right: 10px;}     

    /*this has to be below- overides color above*/
    .header{color: rgba(0,0,0,0.3);font-weight: 500;}

        
    /*fab*/
    #fab{
      background: url('css/icons/ic_add.png') no-repeat center center;
      height: 50px;width: 50px;
      border-radius: 50%;
      position: fixed;
      background-color: #1aba7a;
      z-index: 2;bottom: 0;right: 0;margin-bottom: 25px;margin-right: 25px;
      -webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.6);
      -moz-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.6);
      box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.6);
    }
    #fab:active{background-color: #138e5d;}


    /*forms*/
    #form_main{background-color: white;}
    .form_row{height: 52px;line-height: 52px;padding-left: 64px;color: #6b6b6b;}
    .form_spacer{height: 20px;}
    .form_inline{display: inline-block;/*background-color: green;*/}
    .text_placeholder{width: 250px;}
    .input_placeholder input{
      font-size:17px;
      padding:5px 10px 5px 5px;
      display:block;
      width:250px;
      border:none;
      border-bottom:1px solid #757575;
    }
    .input_placeholder input:focus{ outline:none; }
    .form_divider{height: 20px;border-top: 1px solid rgb(230,230,230);margin-top: 5px;}

    /* BOTTOM BARS*/
    .bar { position:relative; display:block; width:265px; }
    .bar:before, .bar:after {
      content:'';
      height:1.5px; 
      width:0;
      bottom:1px; 
      position:absolute;
      background:#5264AE; 
      transition:0.2s ease all; 
      -moz-transition:0.2s ease all; 
      -webkit-transition:0.2s ease all;
    }
    .bar:before {
      left:50%;
    }
    .bar:after {
      right:50%; 
    }
    .input_placeholder input:focus ~ .bar:before, .input_placeholder input:focus ~ .bar:after {
      width:50%;
    }

    .form_button_holder{padding-left: 64px;padding-top: 0px;padding-bottom: 40px;}

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
    </style>
</head>
<body>





<!-- wrapper -->
<div id="wrapper">
    		
	
  <div id="result">
  		<div class="show_row">
		<div class="inline gqg_no header">NAME</div>
		<div class="inline num_val header">CIN</div>
		<div class="inline num_val_small header">ACT</div>
		<div class="inline num_val_small header">INACT</div>
		<div class="inline num_val_small header">COMP</div>
		<div class="inline num_val header">COMP KM</div>
		<div class="inline num_val header">REM KM</div>
		<div class="inline num_val header">TOT KM</div>
	</div>
	
		<div class="show_row">
			<div class="inline gqg_no">123</div>
			<div class="inline num_val">123</div>
			<div class="inline num_val_small">34</div>
			<div class="inline num_val_small">12</div>
			<div class="inline num_val_small">20</div>
			<div class="inline num_val">3330000</div>
			<div class="inline num_val">222000</div>
			<div class="inline num_val">8222000</div>
	</div>';
  </div>
</div>
</body>
</html>
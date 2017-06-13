<?php 
require '../../query/conn.php';
if ((isset($_GET['car_id'])) && (isset($_GET['gqg_no'])) && (isset($_GET['company']))) {

  
   $car_id = $_GET['car_id'];
   $gqg_no = $_GET['gqg_no'];
   $comp_id = $_GET['company'];
   
   // echo $comp_id;

   //Add this code for Dynamic

  // $sql_cars = "SELECT DISTINCT(a.car_id),b.gqg_no
  //       FROM `problems` a 
  //       JOIN `cars` b 
  //       ON a.car_id = b.car_id
  //       WHERE a.car_id = '".$car_id."'";

  $sql_cars = "SELECT DISTINCT(a.car_id),b.gqg_no
        FROM `problems` a 
        JOIN `cars` b 
        ON a.car_id = b.car_id
        WHERE a.car_id = '".$car_id."'";      

  $exe_cars = mysqli_query($conn,$sql_cars);

  if(mysqli_num_rows($exe_cars) > 0){
    
    // container div for styling
    echo '<div id="problem_table_holder">';
    echo '<table id="prob_table">';

    echo '</tr>';
    echo '<td>GQG NO</td>';   
    echo '<td>Date</td>';   
    echo '<td>Category</td>';
    echo '<td>Description</td>';
    echo '<td>Count</td>';
    echo '</tr>';

    // get distinct cars and gqg_nos
    while($row_cars = mysqli_fetch_assoc($exe_cars)){
      

      $car_id = $row_cars['car_id'];      
      $gqg_no = $row_cars['gqg_no'];
      // $comp_id= $_GET['comp_id'];

      

      // get distinct count of problems to render table
      // we need to find rowspan for gqg
      $sql_row_span = "SELECT count(distinct(prob_menu_id))
              FROM  problems
              WHERE `car_id` = ".$car_id." ";

      $exe_row_span = mysqli_query($conn,$sql_row_span);
      $r_rspan = mysqli_fetch_assoc($exe_row_span);
      $rowspan = $r_rspan['count(distinct(prob_menu_id))']; 



      // sorting problems car-wise
      $sql_probs = "SELECT a.prob_menu_id, a.open_date,a.comp_id ,b.category, b.description      
            FROM  problems a
            JOIN `problem_menu` b
            ON a.prob_menu_id = b.prob_menu_id
            WHERE `car_id` = ".$car_id."           
            ORDER by b.category,a.prob_menu_id,a.open_date";

      $exe_probs = mysqli_query($conn,$sql_probs);

      

      // get distinct cars and gqg_nos

      $prob_menu_id = null;
      $open_date = null;      
      $counter = 0;
      $tr_check = null;

      
      // foreach problems per car
      while($row_probs = mysqli_fetch_assoc($exe_probs)){

        

        // this ends the table row
        if( ($prob_menu_id != null) && ($prob_menu_id != $row_probs['prob_menu_id']) ){

          echo '<td class="ptab_right">'.$counter.'</td>';
          echo '</tr>';
        }


        // this starts the table row
        if( ($prob_menu_id == null) || ($prob_menu_id != $row_probs['prob_menu_id']) ){

          $counter = 1;

          $prob_menu_id = $row_probs['prob_menu_id'];
          
          $open_date  = $row_probs['open_date'];          
          $category   = $row_probs['category'];
          $description = $row_probs['description'];

          
          if($tr_check == null){
            echo '<tr class="find_tr">';
            echo '<td rowspan="'.$rowspan.'">'.$gqg_no.'</td>'; 
            $tr_check = 1;
          }else{
            echo '<tr>';  
          }
          // echo '<td>'.$prob_menu_id.'</td>';
          
          echo '<td>'.$open_date.'</td>';         
          echo '<td>'.$category.'</td>';
          echo '<td>'.$description.'</td>';
          
        }else{
          ++$counter;     
        }   
      }// foreach problems per car

      //last row doesnt get fired in loop
      echo '<td class="ptab_right">'.$counter.'</td>';
      echo '</tr>';
      
    }// foreach car

    echo '</table>';
    echo '</div>';
  }else{
    echo'No Data Found';
  }     

}//if of isset function


?>

<!DOCTYPE html>
<html>
<head>
  <title>CARS PROTO</title>
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
    #problem_table_holder{width: 65%;background: white;margin-left: 30px; border-radius: 5px;padding: 20px;}
    table{border-collapse: collapse; margin-left: 30px;}
    td{border: 1px solid rgb(200,200,200);font-size: 14px;color: rgb(20,20,20);padding: 5px;}
    .ptab_right{text-align: right;}

    .toggle{display: none;}   
    </style>
</head>
<body>
 





</body>
</html>
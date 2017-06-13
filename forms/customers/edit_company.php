<?php
    include '../../query/conn.php';

    if(isset($_GET['comp_id'])){
      $req=$_GET['comp_id'];
      $sql="SELECT * FROM `companies` WHERE comp_id='".$req."'";
      $info=mysqli_query($conn,$sql);
      $data=mysqli_fetch_array($info);

      $comp_id=$data['comp_id'];
      $name=$data['name'];
      $name = str_replace("_", " ", $name);
      $cin=$data['cin'];
            

  }
?>
<div id="form_main">

	<div class="show_row">Update Company</div>

	<div class="form_spacer"></div>
	<div class="form_spacer"></div>	

		<div class="form_row">
			<div class="form_inline text_placeholder">Comany Name</div>
			<div class="form_inline input_placeholder"><input type="text" value="<?php echo $name;  ?>"  id="company_name"><span class="bar"></span></div>
		</div>

		<div class="form_row">
			<div class="form_inline text_placeholder">Company Identification Number</div>
			<div class="form_inline input_placeholder"><input type="text" value="<?php echo $cin;?>" id="cin"><span class="bar"></span></div>
		</div>


	<div class="form_spacer"></div>
	<div class="form_spacer"></div>
	<div class="form_spacer"></div>

	<div class="form_button_holder">
		<div class="mat_btn" id="cancel">CANCEL</div>
		<div class="mat_btn" style="margin-left: 25px;background-color: #0087C1;" name="update" id="save_company" compid = "<?php echo $comp_id; ?>" >UPDATE</div>
	</div>

</div> 
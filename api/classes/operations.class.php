<?php
	/**
	* 
	*/
class Operations 
{
	private $_db;
	private $_method;	
	private $_getParams = null;
	private $_postParams = null;

	function __construct($db,$method,$getParams,$postParams) {
		$this->_db 			= $db->getInstance();
		$this->_method		= $method;
		$this->_getParams	= $getParams;
		$this->_postParams	= $postParams;

		$size = sizeof($this->_getParams);
	

		if($this->_method=='GET'){

			$this->_kartID = $this->_getParams[0];
			$this->getLap($this->_kartID);

		}
		else if($this->_method=='POST'){

			$action = $this->_postParams['action'];

			if($action=='insert')
			{				
				$this->insertOperations($this->_postParams);
			}
			else if($action=='update')
			{
				$this->updateOperations($this->_postParams);
			}
			else if($action=='finish')
			{
				$this->finishOperations($this->_postParams);
			}
		
		}
	}

	private function getLap($kart_id){

		$this->_db->query("SELECT `lap` FROM `operations` WHERE `kart_no` IN (SELECT `kart_no` FROM `id_map` WHERE `kart_id` = '$kart_id') ;");
		$this->_db->execute();
		$r = $this->_db->single();		
		$lap = $r['lap'];
		if (($lap == "")||($lap == NULL)) {
			$lap = 0;
		}
		echo $lap;
	}

	private function insertOperations($postParams) {

		$output    = array();

		$kart_id = trim($postParams['id']);

		$this->_db->query("SELECT `kart_no` FROM `id_map` WHERE `kart_id` = '$kart_id'");
		
		$this->_db->execute();
		$r = $this->_db->single();		

		$kart_no = $r['kart_no'];
		$cust_no = trim($postParams['no']);


		$this->_db->query("SELECT * FROM `operations` WHERE `kart_no` = '$kart_no'");
		//$this->_db->bind(':no', $kart_no); // use bindParam to bind the variable		
		$this->_db->execute();
		if($this->_db->rowCount() == 0){

			$this->_db->query("SELECT * FROM `customers` WHERE `no` = '$cust_no'");
			$this->_db->execute();
			$r = $this->_db->single();

			if($this->_db->rowCount() == 1){

				$cust_id = $r['id'];
				$cust_name = $r['name'];
				$lap = 0;

				$this->_db->query("SELECT * FROM `operations` WHERE `cust_id` = '$cust_id'");
				$this->_db->execute();
				$count = $this->_db->rowCount()+1;
				if($count > 1){
					
					$cust_name = $cust_name.' - '.$count;

				}
				

				$sql = "INSERT INTO `operations`(`kart_no`, `cust_id`, `name`, `lap`)  
					VALUES('$kart_no','$cust_id','$cust_name','$lap');";

				$this->_db->query($sql);
				$this->_db->execute();

				$output["success"]  = true;
				$output["msg"]      = "Kart Started Successfully";
			}else{
				$output["success"]  = false;
				$output["msg"]      = "Wrong cust Number";
			}
		}else{
			 $output["success"]  = false;
			 $output["msg"]      = "kart already started";
		}

		echo json_encode($output, JSON_NUMERIC_CHECK);
	}

	private function updateOperations($postParams) {
        
        $kart_id = trim($postParams['id']);
        $time    = trim($postParams['lap']);



		$this->_db->query("SELECT `kart_no` FROM `id_map` WHERE `kart_id` = '$kart_id'");	
		$this->_db->execute();
		$r = $this->_db->single();		
		$kart_no = $r['kart_no'];
		

		$this->_db->query("SELECT * FROM `operations` WHERE `kart_no` = '$kart_no'");
	//	$this->_db->bind(':no', $kart_no); // use bindParam to bind the variable		
		$this->_db->execute();
		if($this->_db->rowCount() == 1){

			$this->_db->query("SELECT `timing` FROM `operations` WHERE `kart_no` = '$kart_no';");		
			$this->_db->execute();
			$r = $this->_db->single();		

			$timing = $r['timing'];

			if ($timing == NULL) {
				$timing = $time;
			}else{
				$timing = $timing.'|'.$time;
			}

			$sql="UPDATE `operations` SET `timing`= '$timing', `lap` = `lap` + 1 WHERE `kart_no`= '$kart_no';";
			$this->_db->query($sql);
			$this->_db->execute();

			echo 'Succes';
			
		}else{
			echo 'Error';
		}

		
	}

	private function finishOperations($postParams){

		$op_id = trim($postParams['id']);

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$this->_db->query("SELECT * FROM `operations` WHERE `op_id` = '$op_id'");
		$this->_db->execute();

		$r = $this->_db->single();

		$kart_no 	= $r['kart_no'];
		$cust_id	= $r['cust_id'];
		$name	= $r['name'];
		$lap		= $r['lap'];
		$timing 	= $r['timing'];
		
		$sql = "INSERT INTO `master`(`kart_no`, `cust_id`, `name`, `lap` , `timing` , `date`)  
					VALUES('$kart_no','$cust_id','$name','$lap' , '$timing' , '$date');";

		$this->_db->query($sql);
		$this->_db->execute();

		$this->_db->query("DELETE FROM `operations` WHERE `op_id` = '$op_id'");
		$this->_db->execute();
		echo 'Success';
	}

}		

	
?>
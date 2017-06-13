<?php
	/**
	* 
	*/
class Id_Map 
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

			

		}
		else if($this->_method=='POST'){
							
			$this->insertIdMap($this->_postParams);
		
		}
	}

	private function insertIdMap($postParams) {

		$kart_id = trim($postParams['id']);
		$kart_no = trim($postParams['no']);

		$this->_db->query("SELECT `kart_id` FROM `id_map` WHERE `kart_no` = :kart_no");
		$this->_db->bind(':kart_no', $kart_no); // use bindParam to bind the variable		
		$this->_db->execute();
		$r = $this->_db->single();		

		$kart_id_old = $r['kart_id'];

		$this->_db->query("SELECT `kart_no` FROM `id_map` WHERE `kart_id` = :kart_id");
		$this->_db->bind(':kart_id', $kart_id); // use bindParam to bind the variable		
		$this->_db->execute();
		$r = $this->_db->single();		

		$kart_no_old = $r['kart_no'];

		$sql="UPDATE `id_map` SET `kart_no`= '$kart_no' WHERE `kart_id`= '$kart_id';";
		$this->_db->query($sql);
		$this->_db->execute();

		$sql="UPDATE `id_map` SET `kart_no`= '$kart_no_old' WHERE `kart_id`= '$kart_id_old';";
		$this->_db->query($sql);
		$this->_db->execute();

		echo 'success';

		
	}

	// private function updateOperations($postParams) {
        
 //        $kart_id = trim($postParams['id']);

	// 	$this->_db->query("SELECT `kart_no` FROM `id_map` WHERE `kart_id` = :kart_id");
	// 	$this->_db->bind(':no', $kart_id); // use bindParam to bind the variable		
	// 	$this->_db->execute();
	// 	$r = $this->_db->single();		

	// 	$kart_no = $r['kart_no'];
	// 	$time    = trim($postParams['time']);

	// 	$this->_db->query("SELECT * FROM `operations` WHERE `kart_no` = :no");
	// 	$this->_db->bind(':no', $kart_no); // use bindParam to bind the variable		
	// 	$this->_db->execute();
	// 	if($this->_db->rowCount() == 1){

	// 		$this->_db->query("SELECT `timing` FROM `operations` WHERE `kart_no` = '$kart_no';");		
	// 		$this->_db->execute();
	// 		$r = $this->_db->single();		

	// 		$timing = $r['timing'];

	// 		if ($timing == NULL) {
	// 			$timing = $time;
	// 		}else{
	// 			$timing = $timing.'|'.$time;
	// 		}

	// 		$sql="UPDATE `operations` SET `time`= '$timing', `lap` = `lap` + 1 WHERE `kart_no`= '$kart_no';";
	// 		$this->_db->query($sql);
	// 		$this->_db->execute();

	// 		echo 'Succes';
			
	// 	}else{
	// 		echo 'Error';
	// 	}

		
	// }

}		

	
?>
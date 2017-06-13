<?php
	/**
	* 
	*/
class Customers 
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

			$action = $this->_postParams['action'];
			
			if($action=='insert')
			{				
				$this->insertNewCustomer($this->_postParams);
			}
			else if($action=='update')
			{
				$this->updateCustomer($this->_postParams);
			}

		}
	}


	private function insertNewCustomer($postParams) {

		$firstName		= trim($postParams['firstName']);

		$lastName		= trim($postParams['lastName']);

		$phoneNumber		= trim($postParams['phoneNumber']);

		$email   = trim($postParams['email']);

		$age     =trim($postParams['age']);
		


		$this->_db->query("SELECT 1 FROM `customers` WHERE `no` = :no");
		$this->_db->bind(':no', $phoneNumber); // use bindParam to bind the variable		
		$this->_db->execute();

		if($this->_db->rowCount() == 0){

			$sql = "INSERT INTO `customers`(`firstname`,`lastname`,`no`,`email`,`age`)  
					VALUES(:field1,:field2,:field3,:field4,:field5);";


			$this->_db->query($sql);

			$this->_db->bind(':field1',$firstName);
			$this->_db->bind(':field2',$lastName);
			$this->_db->bind(':field3',$phoneNumber);
			$this->_db->bind(':field4',$email);
			$this->_db->bind(':field5',$age);

			$this->_db->execute();

		

			echo 'New Customer Added';
		}
		else{
			echo 'Duplicate Customer!';
		}
	}

	private function updateCustomer($postParams) {
        // $comp_id		= 1;
        $firstName	= trim($postParams['firstName']);
        $lastname   = trim($postParams['lastName']);
		$phoneNumber= trim($postParams['phoneNumber']);
		$id			= trim($postParams['id']);
		$email      = trim($postParams['email']);
		$age        = trim($postParams['age']);   


		$sql="UPDATE `customers` SET `firstname`=:field1,`lastname`=:field2,`no`=:field3,`email`=:field5,`age`=:field6 WHERE `id`=:field4";

		$this->_db->query($sql);


		$this->_db->bind(':field1',$firstName);	
		$this->_db->bind(':field2',$lastName);
		$this->_db->bind(':field3',$phoneNumber);
		$this->_db->bind(':field4',$id);
		$this->_db->bind(':field4',$id);
		$this->_db->bind(':field5',$email);
		$this->_db->bind(':field4',$age);		
		$this->_db->execute();

		echo 'Customer Updated Succesfully';
	}

}		

	
?>
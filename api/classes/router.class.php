<?php

/**
 * date-created  4/4/16
 * created-by    Sourabh
 */
class Router
{
    
    private $_method;
    private $_handler;
    private $_getParams = null;
    private $_postParams = null;
    
    public function __construct($url)
    {
        
        //check method
        $this->_method = $_SERVER['REQUEST_METHOD'];
        
        //pre routing and db connection
        $explode = explode('/', $url);
        $size    = sizeof($explode);
        
        $db = Database::getInstance();
        
        //if POST, postParams
        if ($this->_method == 'POST') {
            $this->_postParams = json_decode(file_get_contents("php://input"), true); //convert postparameters in array...which is understand by php                
            //check for token here
        }
        if ($size > 1) {
            $this->_getParams = array();
            for ($c = 1; $c < $size; $c++) {
                array_push($this->_getParams, $explode[$c]);
            }
        }
        
        switch ($explode[0]) {
            
            case 'customers':
                $customers = new Customers($db, $this->_method, $this->_getParams, $this->_postParams);
                break;
                
            case 'operations':
                $operations = new Operations($db, $this->_method, $this->_getParams, $this->_postParams);
                break;

            case 'id_map':
                $id_map = new Id_Map($db, $this->_method, $this->_getParams, $this->_postParams);
                break;
                
            default:
                echo "Please don't do stupid stuff";
                break;
        }
        
    }  
}
?>

<?php

/*
ini_set('display_errors', '0');    

error_reporting(E_ALL | E_STRICT);  
*/

class voConn
{
	
		static private $instancia;
		public  $server;
		public  $user;
		public  $pass;
		public  $db;

		private function __construct(){ 
			   $this->server = "localhost:3306";
			   $this->user = "imsg_usrIMSG";
			   $this->pass = "_nyrCmSF~TIQ";
			   $this->db = "imsg_dbIMSG";
		}


	     public static function getInstance(){
			     	 self::$instancia = new self;
				    if (  !self::$instancia instanceof self){
					    self::$instancia = new self;

				     }
					return self::$instancia;
	     }

   
}

?>

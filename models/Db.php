<?php

class Db {
 
   public static $instance;
   public $conn;
   private $dbhost = "localhost"; 
   private $dbuser = "mlp_dicks"; 
   private $dbpass = "mlp_dicks"; 
   private $dbname = "contact_manager";
   
   public function __contruct () {}
   
   public static function getInstance () {
     if (is_null(Db::$instance)) {
       Db::$instance = new self();
     }
     return Db::$instance;
   }
   
   public function connect () {
      try
        {
            $this->conn = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;     
        }
      catch(PDOException $e)
        {
          return "Connection failed: " . $e->getMessage();
        }      
   }
}

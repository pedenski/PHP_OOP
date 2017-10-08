<?php

class database {
	//creds
	private $dbn = 'mysql:dbname=oop;host=localhost;';
	private $user = 'root';
	private $password = '';

	public $conn;

 
    // get the database connection
    public function getConn(){
        $this->conn = null;
        try{
 		  $this->conn = new PDO($this->dbn, $this->user, $this->password);
        } catch(PDOException $exception) {
          echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}





?>
<?php
class category {
	//db connection
	private $conn;
	private $table_name = "categories";

	//object param
	public $name;
	public $id;


		public function __construct($db) {
			$this->conn = $db;
		}

		//for dropdown get id, name
		public function read() {
			$query = "SELECT id, name 
					  FROM ".$this->table_name."
					  ORDER BY name";
			$sql = $this->conn->prepare($query);
			$sql->execute();
			return $sql;
		}

		//get category name from ID
		public function translateCatID() {
			$query = "SELECT name FROM ".$this->table_name." WHERE id = ? limit 0,1";
			$sql = $this->conn->prepare($query);
			$sql->bindParam(1, $this->id);
			$sql->execute();
			return $sql;
			exit();
			$row = $sql->fetch(PDO::FETCH_ASSOC);

		}



}




?>
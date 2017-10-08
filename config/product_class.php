<?php
class product {
	//db connection
	private $conn;
	private $table_name = "products";

	//object param
	public $id;
	public $name;
	public $price;
	public $description;
	public $category_id;
	public $created;
	

	public function __construct($db) {
			$this->conn = $db;
		}

	public function create($var) {
		
		$query = "INSERT INTO ".$this->table_name."
		SET
		name=:name, 
		price=:price, 
		description=:description, 
		category_id=:category_id, 
		created=:created";

		$sql = $this->conn->prepare($query);
		$this->timestamp = date('Y-m-d H:i:s');

		foreach($var as $Name => &$Value) {
				$sql->bindParam(':'.$Name, $Value);
		}

		$sql->bindParam(":created", $this->timestamp);

		//return true if executed else false
		$bool = true;
		return ($bool) ? $sql->execute() : false;

	
	}

	public function readALL($record_num, $records_per_page) {
		$query = "SELECT * FROM ".$this->table_name."
			      ORDER BY name ASC LIMIT ".$record_num.",".$records_per_page;
		$sql = $this->conn->prepare($query);
		$sql->execute();
		return $sql;

	}

	


}


?>
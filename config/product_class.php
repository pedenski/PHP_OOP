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

	//insert data to DB
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

	//Get data to DB returns 5 items
	public function readALL($record_num, $records_per_page) {
		$query = "SELECT * FROM ".$this->table_name."
			      ORDER BY name ASC LIMIT ".$record_num.",".$records_per_page;
		$sql = $this->conn->prepare($query);
		$sql->execute();
		return $sql;
	}

	//Count number of rows for pagination
	public function countRows(){
		$query = "SELECT id FROM ".$this->table_name;
		$sql = $this->conn->prepare($query);
		$sql->execute();

		return $sql;

	}
	//for pagination
	public function getPage($navstart,$max){
		$query = "SELECT * FROM ".$this->table_name." LIMIT ".$navstart.",".$max;
		$sql = $this->conn->prepare($query);
		$sql->execute();
		return $sql;
	}

	public function readProduct(){
		
		$query = "SELECT name, price, description, category_id FROM ".$this->table_name." WHERE id = ? LIMIT 0,1";
		$sql = $this->conn->prepare($query);
		$sql->bindParam(1, $this->id);
		$sql->execute();

		$row = $sql->fetch(PDO::FETCH_ASSOC);

		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->description = $row['description'];
		$this->category_id = $row['category_id'];




	}



}


?>
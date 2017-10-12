<?php

if($_POST) {

// include database and object files
include_once 'config/database.php';
include_once 'config/product_class.php';


// get database connection
$db = new database();
$product = new product($db->getConn());


echo $_POST['object_id'];

$product->id = $_POST['object_id'];

	if($product->deleteProduct()) {
		echo "Product Deleted";
	} else {
		echo "Unable to Delete Object";
	}

}



?>
<?php
// include database and object files
include_once 'config/database.php';
include_once 'config/product_class.php';
include_once 'config/category_class.php';
 
// get database connection
$db = new database();

$category = new category($db->getConn());



//set headers
$page_title = "Create Product";

//<html>
include_once('header.php');
?>


<div class='right-button-margin'>
	<a href='index.php' class='btn btn-default pull-right'>Read Products</a>
</div>

<select class='form-control' name='category_id'>
	<option>Select category...</option>
	<?php
	foreach($categories as $row) {
		$id = $row['id'];
		$name = $row['name'];
		
	?>
	
	<option value="<?php echo $id;?>"><?php echo $name;?></option>
	<?php } //endforeach?>
</select>

<?php include_once('footer.php');?>
<?php
//get ID
$id = isset($_GET['id']) ? $_GET['id'] : die ('Error: Missing ID');

// include database and object files
include_once 'config/database.php';
include_once 'config/product_class.php';
include_once 'config/category_class.php';
include_once 'config/pagination_class.php'; 

// get database connection
$db = new database();
// class instatiation
$product = new product($db->getConn());
$category = new category($db->getConn());

//product methods
$product->id = $id;

//page title
$page_title = "Read this product";
include_once('header.php');
?>



<div class='right-button-margin'>
<a href='index.php' class='btn btn-primary pull-right'>


<span class='glyphicon glyphicon-list'></span> Read Products
</a></div>

<?php $product->readProduct();?>
<table class='table table-hover table-responsive table-bordered'>

<tr>
	<td>Name</td>
	<td><?php echo $product->name; ?></td>
</tr>

<tr>
	<td>Price</td>
	<td><?php echo $product->price; ?></td>
</tr>
<tr>
	<td>Description</td>
	<td><?php echo $product->description; ?></td>
</tr>
<tr>
	<td>Category</td>
	<td>
	<?php 
	$category->id = $product->category_id;
	$category->translateCatID();
	echo $category->name;
	?>
	</td>
</tr>

</table>


<?php include_once('footer.php'); ?>


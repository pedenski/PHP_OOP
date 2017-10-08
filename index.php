<?php 
// include database and object files
include_once 'config/database.php';
include_once 'config/product_class.php';
include_once 'config/category_class.php';

// get database connection
$db = new database();
// class instatiation
$product = new product($db->getConn());
$category = new category($db->getConn());

//page title
$page_title = "Read Products";

//pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 3;
//3 * 1 = 3 - 3  = 0
//3 * 2 = 6 - 3  = 3
//3 * 3 = 9 - 3  = 6
$record_num = ($records_per_page * $page) - $records_per_page;
?>

<?php include_once('header.php'); ?>
<div class='right-button-margin'>
		<a href='create_product.php' class='btn btn-default pull-right'>Create Product</a>
</div>


<?php
$sql = $product->readAll($record_num, $records_per_page);
$num = $sql->rowCount();
if($num > 0) { ?>
<table class='table table-hover table-responsive table-bordered'>
	<tr>
		<th>Product</th>
 		<th>Price</th>           
 		<th>Description</th>            
 		<th>Category</th>            
 		<th>Actions</th>        
 	</tr>
 	
<?php
$row = $sql->fetchALL(PDO::FETCH_ASSOC);
foreach($row as $row){
	$id 	 = $row['id'];
	$name 	 = $row['name'];
	$desc 	 = $row['description'];
	$price 	 = $row['price'];
	$catid 	 = $row['category_id'];
	$created = $row['created'];
	$edited  = $row['modified'];
?>
	<tr>
		<td><?php echo $name; ?></td>
		<td><?php echo $price; ?> </td>
		<td><?php echo $desc; ?> </td>
		<td>
		<?php 
		//insert id inside category class as public $id
		$category->id = $catid;
		//execute class and get sql
		$catid = $category->translateCatID();
		//fetch the data as array from translateCatID()
		$catid = $catid->fetch(PDO::FETCH_ASSOC);
		//echo as Assoc Array
		echo $catid['name'];
		?>
		</td>
		<td>Buttons</td>
	</tr>

	
<?php } //endforeach?>
</table>



<?php } else { ?>
	<div class='alert alert-info'>No products found.</div>
<?php } ?>











<?php include_once('footer.php'); ?>


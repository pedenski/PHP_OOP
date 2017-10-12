<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 1;

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




//set pagination
$max = 5;
$maxNum = 5;
//get total result 
$countRow = $product->countRows();
$total = $countRow->rowCount();
//if isset then set to page else its page 1

//get pagination
$pagination = new Pagination($max, $total, $page, $maxNum);


//page title and headers
$page_title = "Read Products";
include_once('header.php');
?>


<div class='right-button-margin'>
		<a href='create_product.php' class='btn btn-default pull-right'>Create Product</a>
</div>


<?php
//how many to display
$records_per_page = 4;
$record_num = ($records_per_page * $page) - $records_per_page;
//get product records limit = records_per_page
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
 	$is_hidden = $row['is_hidden'];

 	if(empty($is_hidden)) {
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
		$category->translateCatID();
		//fetch the data as array from translateCatID()
		echo $category->name;
		?>
		</td>
		<td>
			<a href='read_product.php?id=<?php echo $id;?>' class='btn btn-primary left-margin'>
	     	<span class='glyphicon glyphicon-list'></span> Read
	 		</a> 
	 		<a href='update_product.php?id=<?php echo $id;?>' class='btn btn-info left-margin'>
	   		<span class='glyphicon glyphicon-edit'></span> Edit
			</a>
			<a delete-id='<?php echo $id;?>' class='btn btn-danger delete-object'>
			<span class='glyphicon glyphicon-remove'></span> Delete
			</a>
		</td>
	</tr>

	
<?php 	}/*endif hidden*/ } //endforeach?>
</table>



<?php } else { ?>
	<div class='alert alert-info'>No products found.</div>
<?php } ?>

<!-- PAGINATION -->


<style>
.pagination {
	padding:10px;
	
}

.pagination a, b{
	background:#c0c0c0;
	padding:5px;
	border: 1px solid #000;
	margin-right:3px;
}
</style>

<div class="pagination">
<?php 


echo $pagination->previous(' <a href="index.php?page={nr}">Previous</a>  ');
echo $pagination->numbers(' <a href="index.php?page={nr}">{nr}</a>  ', ' <b>{nr}</b>  ');
echo $pagination->next(' <a href="index.php?page={nr}">Next</a>  ');





?>
</div>




<?php include_once('footer.php'); ?>


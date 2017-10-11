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

//get id
$id = isset($_GET['id']) ? $_GET['id'] : die('Error: Missing ID');
//set to product class
$product->id = $id;
$category->id = $id;
//activate class
$product->readProduct();

//$category->translateCatID();



$page_title = "Update Product";
include_once('header.php');
?>




<div class='right-button-margin'>
		<a href='index.php' class='btn btn-default pull-right'>Read Products</a>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo $product->description; ?></textarea></td>
        </tr>
 
        <tr>
            <td>Category</td>
            <td>
	        <select class='form-control' name='category_id'>
	           	<?php 
	     		$sql = $category->read()->fetchALL(PDO::FETCH_ASSOC);
	            foreach($sql as $row) {
	           	$catid = $row['id'];
	           	$catname = $row['name'];

	           	//select the option same as cat id as default
	           	if($product->category_id == $catid) { ?>
	           	<option value="<?php echo $product->category_id?>" selected='selected'>hahahaha</option>
	           	<?php } else { ?>
	   		  	<option value="<?php echo $catid ?>"><?php echo $catname; ?></option>
				<?php }	//endif?>
	            <?php } //endforeach?>
            </select>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>




<?php 
include_once('footer.php');
?>
<?php
// include database and object files
include_once 'config/database.php';
include_once 'config/product_class.php';
include_once 'config/category_class.php';
include_once 'config/validator_class.php';


// get database connection
$db = new database();

$category = new category($db->getConn());
$product  = new product($db->getConn());


//set headers
$page_title = "Create Product";

//<html>
include_once('header.php'); 
?>

<?php if($_POST) { 
   if($product->create($_POST)){ ?>
    <div class='alert alert-success'>Product was created.</div>
<?php   } else { ?>
   <div class='alert alert-danger'>Unable to create product.</div>
   <?php } //if product 
         } //if post ?>

<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
 
        <tr>
            <td>Category</td>
            <td>

            <!-- categories from database will be here -->
            <select class='form-control' name='category_id'>
            <option>Select category...</option>
            <?php

        
            foreach($category->read() as $row) {
                $category_id = $row['id'];
                $category_name = $row['name'];
            ?>
           <option value="<?php echo $category_id;?>"><?php echo $category_name; ?></option>
            <?php } //foreach read() ?>
           </select>   



            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>

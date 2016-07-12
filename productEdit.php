<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";


$product_id = $_GET['product_id'];
$sql = "SELECT * FROM products WHERE prod_id=$product_id";
$result = $db->query($sql);
list($prod_id, $prod_name, $prod_price, $prod_description, $prod_thumb, $prod_img, $prod_detail, $attribute, $published, $featured) = $result->fetch_row();
$submit = $_POST['submit'];
if ($submit) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $thumb = mysqli_real_escape_string($db, $_POST['thumb']);
    $image = mysqli_real_escape_string($db, $_POST['image']);
    $detail_img = mysqli_real_escape_string($db, $_POST['detail_img']);
    $error = "";
    $featured = 0;
    if ($_POST['featured'] == "yes") {
        $featured = 1;
    } else {
        $featured = 0;
    }

    if ($name == "" || $thumb == "" || $description == "" || $image == "" || $detail_img == "") {
        $error = "All fields are required!";
    } elseif (strlen($description) < 500) {
        $error = "Description must be at least 500 characters long!";
    } else {
        $error = "";
        $sql = "UPDATE products SET prod_name='$name', prod_price='$price', prod_description='$description', prod_thumb='$thumb', prod_img='$image', prod_detail='$detail_img', featured='$featured' WHERE prod_id=$prod_id";
        $result = $db->query($sql);
        mysqli_close($db);
        ob_clean();
        header("Location: productShow.php?product_id=$prod_id");
    }
}


$editForm = <<< EOF
<p class='error_msg'>$error</p>
<form action='productEdit.php?product_id=$prod_id' method='POST' class='edit-form'>
<label for='name'>Name: </label><br/><input type='text' size='50' name='name' id='name' value='$prod_name'><br/><br/>
<label for='price'>Price: </label><br/><input type='text' size='50' name='price' id='price' value='$prod_price'><br/><br/>
<label for='description'>Description: </label><br/><textarea rows='30' cols='80' id='description' name='description'>$prod_description</textarea><br/><br/>
<label for='thumb'>Thumbnail link: </label><br/><input type='text' size='50' name='thumb' id='thumb' value='$prod_thumb'><br/><br/>
<label for='image'>Catalog image link: </label><br/><input type='text' size='50' name='image' id='image' value='$prod_img'><br/><br/>
<label for='detail_img'>Detail image link: </label><br/><input type='text' size='50' name='detail_img' id='detail_img' value='$prod_detail'><br/><br/>
<input type="checkbox" name="featured" value="yes"> Featured Product?<br/><br/>
<input type='submit' value='Edit Product' name='submit'><br/><br/>
</form>
EOF;

echo $editForm;

require "includes/footer.php";

ob_end_flush();
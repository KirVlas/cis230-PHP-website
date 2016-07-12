<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";


$submit = $_POST['submit'];
$name = "";
$price = "";
$description = "";
$thumb = "";
$image = "";
$detail_img = "";
if ($submit) {
    $name=mysqli_real_escape_string($db, $_POST['name']);
    $price=mysqli_real_escape_string($db, $_POST['price']);
    $description=mysqli_real_escape_string($db,$_POST['description']);
    $thumb=mysqli_real_escape_string($db,$_POST['thumb']);
    $image=mysqli_real_escape_string($db,$_POST['image']);
    $detail_img=mysqli_real_escape_string($db,$_POST['detail_img']);
    $error = "";
    $featured = 0;
    if ($_POST['featured'] == "yes") {
        $featured = 1;
    } else {
        $featured = 0;
    }

    if ($name == "" || $thumb == "" || $description == "" || $image == "" || $detail_img == ""){
        $error = "All fields are required!";
    } elseif (strlen($description) < 500) {
        $error = "Description must be at least 500 characters long!";
    }else {
        $error = "";
        $sql = "INSERT INTO products (prod_name, prod_price, prod_description, prod_thumb, prod_img, prod_detail, featured) VALUES ('$name', '$price',  '$description', '$thumb', '$image', '$detail_img', '$featured')";
        $result = $db->query($sql);
        mysqli_close($db);
        ob_clean();
        header("Location: prod_admin.php?confirm=added");
    }
}




$newForm = <<< EOF
<p class='error_msg'>$error</p>
<form action='productNew.php' method='POST' class='edit-form'>
<label for='name'>Name: </label><br/><input type='text' size='50' name='name' id='name' value='$name'><br/><br/>
<label for='price'>Price: </label><br/><input type='text' size='50' name='price' id='price' value='$price'><br/><br/>
<label for='description'>Description: </label><br/><textarea rows='30' cols='80' id='description' name='description'>$description</textarea><br/><br/>
<label for='thumb'>Thumbnail link: </label><br/><input type='text' size='50' name='thumb' id='thumb' value='$thumb'><br/><br/>
<label for='image'>Catalog image link: </label><br/><input type='text' size='50' name='image' id='image' value='$image'><br/><br/>
<label for='detail_img'>Detail image link: </label><br/><input type='text' size='50' name='detail_img' id='detail_img' value='$detail_img'><br/><br/>
<input type="checkbox" name="featured" value="yes"> Featured Product?<br/><br/>
<input type='submit' value='Add Product' name='submit'><br/><br/>
</form>
EOF;

echo $newForm;

require "includes/footer.php";

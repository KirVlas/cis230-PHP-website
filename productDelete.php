<?php
require "includes/dbConnect.php";

$product_id = $_GET['product_id'];
$sql = "DELETE FROM products WHERE prod_id=$product_id";
$result = $db->query($sql);

mysqli_close($db);

header("Location: prod_admin.php?confirm=deleted");
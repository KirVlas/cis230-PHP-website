<?php
require "includes/dbConnect.php";

$product_id=$_GET['product_id'];
$comment_id = $_GET['comment_id'];
$sql = "DELETE FROM comments WHERE comment_id=$comment_id";
$result = $db->query($sql);

mysqli_close($db);

header("Location: productShow.php?product_id=$product_id");
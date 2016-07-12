<?php
    require "includes/dbConnect.php";

$story_id = $_GET['story_id'];
$sql = "DELETE FROM stories WHERE story_id=$story_id";
$result = $db->query($sql);

mysqli_close($db);

header("Location: stories_admin.php?confirm=deleted");
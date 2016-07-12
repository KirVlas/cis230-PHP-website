<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";

$story_id = $_GET['story_id'];
$sql = "SELECT * FROM stories WHERE story_id=$story_id";
$result = $db->query($sql);
list($story_id, $author, $headline, $content, $published) = $result->fetch_row();
$submit = $_POST['submit'];
if ($submit) {
    $headline = mysqli_real_escape_string($db, $_POST['headline']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $content = mysqli_real_escape_string($db, $_POST['content']);
    $error = "";

    if ($headline == "" || $author == "" || $content == "") {
        $error = "All fields are required!";

    } elseif (strlen($content) < 1000) {
        $error = "Content must be at least 1000 characters long!";
    } else {
        $error = "";
        $sql = "UPDATE stories SET author='$author', headline='$headline', content='$content' WHERE story_id=$story_id";
        $result = $db->query($sql);
        mysqli_close($db);
        ob_clean();
        header("Location: storyShow.php?story_id=$story_id");
    }
}

$editForm = <<< EOF
<p class='error_msg'>$error</p>
<form action='storyEdit.php?story_id=$story_id' method='POST' class='edit-form'>
<label for='headline'>Headline: </label><br/><input type='text' size='50' name='headline' id='headline' value='$headline'><br/><br/>
<label for='author'>Author: </label><br/><input type='text' size='50' name='author' id='author' value='$author'><br/><br/>
<label for='content'>Content: </label><br/><textarea rows='30' cols='80' name='content' id='content'>$content</textarea><br/><br/>
<input type='submit' value='Edit Story' name='submit'><br/><br/>
</form>
EOF;

echo $editForm;

require "includes/footer.php";
ob_end_flush();



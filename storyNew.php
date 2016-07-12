<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";


$submit = $_POST['submit'];
$headline = "";
$author = "";
$content = "";
if ($submit) {
    $headline=mysqli_real_escape_string($db, $_POST['headline']);
    $author=mysqli_real_escape_string($db,$_POST['author']);
    $content=mysqli_real_escape_string($db,$_POST['content']);
    $error = "";

    if ($headline == "" || $author == "" || $content == ""){
        $error = "All fields are required!";
    } elseif (strlen($content) < 1000) {
        $error = "Content must be at least 1000 characters long!";
    }else {
        $error = "";
        $sql = "INSERT INTO stories (author, headline, content) VALUES ('$author', '$headline', '$content')";
        $result = $db->query($sql);
        mysqli_close($db);
        ob_clean();
        header("Location: stories_admin.php?confirm=added");
    }
}




$newForm = <<< EOF
<p class='error_msg'>$error</p>
<form action='storyNew.php?story_id=$story_id' method='POST' class='edit-form'>
<label for='headline'>Headline: </label><br/><input type='text' size='50' name='headline' id='headline' value='$headline'><br/><br/>
<label for='author'>Author: </label><br/><input type='text' size='50' name='author' id='author' value='$author'><br/><br/>
<label for='content'>Content: </label><br/><textarea rows='30' cols='80' id='content' name='content'>$content</textarea><br/><br/>
<input type='submit' value='Add Story' name='submit'><br/><br/>
</form>
EOF;

echo $newForm;

require "includes/footer.php";

<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";

$comment_id = $_GET['comment_id'];
$product_id = $_GET['product_id'];
$sql = "SELECT * FROM comments WHERE comment_id=$comment_id";
$result = $db->query($sql);
list($comment_id, $c_author, $comment, $date_posted, $rating, $prod_id) = $result->fetch_row();
$submit = $_POST['submit'];

if ($submit) {
    $author = mysqli_real_escape_string($db, $_POST['name']);
    $rating = mysqli_real_escape_string($db, $_POST['rating']);
    $comments = mysqli_real_escape_string($db, $_POST['comments']);
    $sql = "UPDATE comments SET c_author='$author', rating='$rating', comment='$comments' WHERE comment_id=$comment_id";
    $result = $db->query($sql);
    mysqli_close($db);
    ob_clean();
    header("Location: productShow.php?product_id=$product_id");
}

$commentForm = <<< EOC

    <form action='commentsEdit.php?product_id=$product_id&amp;comment_id=$comment_id' method='POST' class='comment_form'>
        <label for="name">Name: </label><input type="text" name="name" id="name" value="$c_author"><br/><br/>
        <label for="rating">Rating: </label><select name="rating" id="rating">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select><br/><br/>
        <textarea rows="5" cols="40" placeholder="Comments" name="comments" id="comments">$comment</textarea><br/><br/>
        <input type='submit' value='Edit Comment' name='submit'>
    </form>
EOC;

echo $commentForm;



require "includes/footer.php";
?>
<?php
require "includes/head.php";
require "includes/dbConnect.php";

$story_id = $_GET['story_id'];
$sql = "SELECT * FROM stories WHERE story_id=$story_id";
$result = $db->query($sql);

if ($db->connect_error) {
    $data_error = $db->connect_error;
}



list($story_id, $author, $headline, $content, $published)=$result->fetch_row();

$story = <<< EOS

<h2>$headline</h2>
<h5 class='story_author'>By: $author<br/>$published</h5>
<p class='story_content'>$content</p>

EOS;

echo $story;
mysqli_close($db);

?>
<p class="bottom_nav">
    <?php
    $user = $_SESSION['username'];
    if ($user) {
        echo "<a href='stories_admin.php'>Back To Stories</a><br/><br/>";
        echo "<a href='storyEdit.php?story_id=$story_id'>Edit</a>";
    }else {
        echo "<a href='news.php'>Back to News</a>";
    }
?>
</p><br/><br/>
<?php
    require "includes/footer.php";
?>
<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";

function time_ago($date)
{
    if (empty($date)) {
        return "No date provided";
    }

    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();

    $unix_date = strtotime($date);

    // check validity of date

    if (empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date

    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = "ago";
    } else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j] .= "s";
    }

    return "$difference $periods[$j] {$tense}";

}

$product_id = $_GET['product_id'];
$sql = "SELECT * FROM products WHERE prod_id=$product_id";
$result = $db->query($sql);

if ($db->connect_error) {
    $data_error = $db->connect_error;
}


list($prod_id, $prod_name, $prod_price, $prod_description, $prod_thumb, $prod_img, $prod_detail, $attribute, $published, $featured) = $result->fetch_row();

$date_published = "";
if ($_SESSION['username']) {
    $date_published = $published;
} else {
    $date_published = "";
}

$product = <<< EOP

<h2>$prod_name</h2>
<h5 class='story_author'>Price: $$prod_price<br/>$date_published</h5>
<p class='prod_image'><img src='$prod_detail' alt='product'></p>
<p class='story_content'>$prod_description</p>

EOP;

echo $product;

$sql = "SELECT * FROM comments WHERE prod_id=$product_id ORDER BY date_posted desc";
$result = $db->query($sql);


?>
    <p class="bottom_nav">
        <?php
        $user = $_SESSION['username'];
        if ($user) {
            echo "<a href='prod_admin.php'' > Back To Products </a ><br /><br />";
            echo "<a href='productEdit.php?product_id=$prod_id'> Edit</a >";
        } else {
            echo "<a href='store.php'>Back to Store</a>";
        }
        ?>
    </p><br/><br/>


    <h3 class="reviews">Reviews</h3>
<?php
while (list($comment_id, $c_author, $comment, $date_posted, $rating, $prod_id) = $result->fetch_row()) {
    echo "<div class='prod_comment'>";
    echo "<p><b>Date: </b>" . time_ago($date_posted) . "<br/><br/><b>Author: </b> $c_author</p><br/><br/>";
    $count = 1;
    while ($count < $rating + 1) {
        echo "<img src='img/star.png' alt='rating'>";
        $count += 1;
    }
    echo "<p>$comment</p><br/>";
    if ($user) {
        echo "<a href='commentsDelete.php?comment_id=$comment_id&amp;product_id=$product_id'>Delete</a>&nbsp;|&nbsp;";
        echo "<a href='commentsEdit.php?comment_id=$comment_id&amp;product_id=$product_id'>Edit</a>";
    }
    echo "</div>";
}

$submit = $_POST['submit'];

if ($submit) {
    $author = mysqli_real_escape_string($db, $_POST['name']);
    $rating = mysqli_real_escape_string($db, $_POST['rating']);
    $comments = mysqli_real_escape_string($db, $_POST['comments']);
    $sql = "INSERT INTO comments (c_author, comment, rating, prod_id) VALUES ('$author', '$comments', '$rating', '$product_id')";
    $result = $db->query($sql);
    mysqli_close($db);
    ob_clean();
    header("Location: productShow.php?product_id=$product_id");
}
$commentForm = <<< EOC

    <form action='productShow.php?product_id=$product_id' method='POST' class='comment_form'>
        <label for="name">Name: </label><input type="text" name="name" id="name"><br/><br/>
        <label for="rating">Rating: </label>
        <select name="rating" id="rating">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select><br/><br/>
        <textarea rows="5" cols="40" placeholder="Comments" name="comments" id="comments"></textarea><br/><br/>
        <input type='submit' value='Add Comment' name='submit'>
    </form>
EOC;

echo $commentForm;


require "includes/footer.php";
?>
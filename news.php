<?php
$page_title = "News";
require "includes/head.php";
require "includes/dbConnect.php";
?>
<section id="main_content">
    <div class="news_left">
        <?php
        $sql = "SELECT * FROM stories ORDER BY published DESC LIMIT 3";
        $result = $db->query($sql);
        if ($db->connect_error) {
            $data_error = $db->connect_error;
        }

        while (list($story_id, $author, $headline, $content, $published) = $result->fetch_row()) {

            echo '<h3><a href="storyShow.php?story_id=' . $story_id . '">' . $headline . '</a></h3>';
            echo "<p>" . date('F j, Y',strtotime($published)) . "</p>";
            echo "<p>By: $author</p>";
            echo "<p>" . (substr($content, 0, 550)) . "...</p>";
        }


        ?>
    </div>
    <div class="news_right">
        <h3>Archive</h3>
        <?php

        $sql = "SELECT * FROM stories ORDER BY published DESC LIMIT 3,18446744073709551615";
        $result = $db->query($sql);
        if ($db->connect_error) {
            $data_error = $db->connect_error;
        }
        echo "<ul class='news'>";
        while (list($story_id, $author, $headline, $content, $published) = $result->fetch_row()) {

            echo "<li>" . date('F j, Y',strtotime($published)) . '<br/> <a href="storyShow.php?story_id=' . $story_id . '">' . $headline . '</a></li>';

        }
        echo "</ul>";
        mysqli_close($db);
        ?>

    </div>
</section>
<?php
require "includes/footer.php";
?>
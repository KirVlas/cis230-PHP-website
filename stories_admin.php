<?php
ob_start();
$page_title = "Admin";
require "includes/head.php";
if($_SESSION['username']) {
    require "includes/dbConnect.php";

    $confirm = $_GET['confirm'];

    if ($confirm == 'deleted') {
        $confirm = "Story successfully deleted.";
    } elseif ($confirm == 'added') {
        $confirm = "Story successfully added.";
    } else {
        $confirm = "";
    }
    if ($message) {
        echo "<h4 class='message'>$message</h4>";
    }
    ?>
    <section id="main_content">
        <h2>News Stories</h2>

        <?php
        if (!empty($confirm)) {
            echo "<h3 class='confirm_msg'>$confirm</h3>";
        }
        ?>

        <table class="stories">
            <tr>
                <td><b>Published</b></td>
                <td><b>Title</b></td>
                <td><b>Author</b></td>
                <td class="content_td"><b>Content</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $sql = "SELECT * FROM stories ORDER BY published DESC";
            $result = $db->query($sql);
            if ($db->connect_error) {
                $data_error = $db->connect_error;
            }
            while (list($story_id, $author, $headline, $content, $published) = $result->fetch_row()) {
                echo "<tr>";
                echo "<td>$published</td>";
                echo "<td>$headline</td>";
                echo "<td>$author</td>";
                echo "<td class='content_td'>" . (substr($content, 0, 150)) . "...</td>";
                echo '<td><a href="storyShow.php?story_id=' . $story_id . '">View</a></td>';
                echo '<td><a href="storyEdit.php?story_id=' . $story_id . '">Edit</a></td>';
                echo '<td><a href="storyDelete.php?story_id=' . $story_id . '">Delete</a></td>';
                echo "</tr>";
            }

            mysqli_close($db);
            ?>


        </table>
        <p class="new_story"><a href="storyNew.php">New Story</a></p>
    </section>
    <?php
    require "includes/footer.php";
    }else{
    ob_clean();
    header('Location: login.php');
}
?>
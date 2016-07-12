<?php
$page_title = "Fast Lane Performance Parts Home";
require "includes/head.php";
require "includes/dbConnect.php";
?>
    <section id="main_content">
        <h2>Welcome</h2>
        <?php
        require "includes/hero.php";
        ?>
        <div class="home">
            <div class="home1">
                <h3>News</h3>

                <?php
                $sql = "SELECT * FROM stories ORDER BY published DESC LIMIT 3";
                $result = $db->query($sql);
                if ($db->connect_error) {
                    $data_error = $db->connect_error;
                }
                echo "<ul class='news'>";
                while (list($story_id, $author, $headline, $content, $published) = $result->fetch_row()) {

                    echo "<li>" . date('F j, Y', strtotime($published)) . "</li>";
                    echo "<li><a href='storyShow.php?story_id=" . $story_id . "'>$headline</a></li>";

                }
                echo "</ul>";


                ?>
            </div>
            <div class="home2">
                <h3>Weekly Special</h3>

                <?php

                $sql = "SELECT * FROM products WHERE featured=1 LIMIT 1";
                $result = $db->query($sql);
                if ($db->connect_error) {
                    $data_error = $db->connect_error;
                }

                list($prod_id, $prod_name, $prod_price, $prod_description, $prod_thumb, $prod_img, $prod_detail, $attribute, $published, $featured) = $result->fetch_row();

                echo "<p>$prod_name</p>";
                echo "<a href='productShow.php?product_id=$prod_id'><img src='$prod_thumb' alt='Featured Item'></a>";
                mysqli_close($db);
                ?>

                <p>This week only 20% off!</p>
            </div>
            <div class="home3">
                <h3>Get In Touch</h3>
                <ul>
                    <li>Spokane, WA</li>
                    <li>509-768-8224</li>
                    <li>8:30AM - 4:30pm M-F</li>
                    <li>kirilv1984@gmail.com</li>
                </ul>
            </div>
        </div>
    </section>
<?php
require "includes/footer.php"
?>
<?php
$page_title = "Store";
require "includes/head.php";
require "includes/dbConnect.php";
?>
<section id="main_content">
    <div class="prod_container">
        <?php
        $sql = "SELECT * FROM products";
        $result = $db->query($sql);
        if ($db->connect_error) {
        $data_error = $db->connect_error;
        }
        while (list($prod_id, $prod_name, $prod_price, $prod_description, $prod_thumb, $prod_img, $prod_detail, $attribute, $published) = $result->fetch_row()) {
            echo "<div class='prod_item'>";
            echo "<a href='productShow.php?product_id=$prod_id'><img src='$prod_thumb' alt='Product'></a>";
            echo "<span>$prod_name</span>";
            echo "</div>";
        }
        mysqli_close($db);
        ?>
    </div>
</section>
<?php
require "includes/footer.php";
?>
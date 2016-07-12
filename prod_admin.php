<?php
ob_start();
$page_title = "Admin";
require "includes/head.php";
if($_SESSION['username']) {
    require "includes/dbConnect.php";

    $confirm = $_GET['confirm'];

    if ($confirm == 'deleted') {
        $confirm = "Product successfully deleted.";
    } elseif ($confirm == 'added') {
        $confirm = "Product successfully added.";
    } else {
        $confirm = "";
    }
    if ($message) {
        echo "<h4 class='message'>$message</h4>";
    }
    ?>
    <section id="main_content">
        <h2>Products Admin Area</h2>

        <?php
        if (!empty($confirm)) {
            echo "<h3 class='confirm_msg'>$confirm</h3>";
        }
        ?>

        <table class="stories">
            <tr>
                <td><b>Published</b></td>
                <td>Thumbnail</td>
                <td><b>Name</b></td>
                <td><b>Price</b></td>
                <td class="content_td"><b>Description</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $sql = "SELECT * FROM products";
            $result = $db->query($sql);
            if ($db->connect_error) {
                $data_error = $db->connect_error;
            }
            while (list($prod_id, $prod_name, $prod_price, $prod_description, $prod_thumb, $prod_img, $prod_detail, $attribute, $published) = $result->fetch_row()) {
                echo "<tr>";
                echo "<td>$published</td>";
                echo "<td><img src='$prod_thumb' alt='thumb'></td>";
                echo "<td>$prod_name</td>";
                echo "<td> $" . $prod_price . "</td>";
                echo "<td class='content_td'>" . (substr($prod_description, 0, 150)) . "...</td>";
                echo '<td><a href="productShow.php?product_id=' . $prod_id . '">View</a></td>';
                echo '<td><a href="productEdit.php?product_id=' . $prod_id . '">Edit</a></td>';
                echo '<td><a href="productDelete.php?product_id=' . $prod_id . '">Delete</a></td>';
                echo "</tr>";
            }

            mysqli_close($db);
            ?>


        </table>
        <p class="new_story"><a href="productNew.php">New Product</a></p>
    </section>
    <?php
    require "includes/footer.php";
}else {
    ob_clean();
    header('Location: login.php');
}
?>
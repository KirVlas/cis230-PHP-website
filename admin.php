<?php
ob_start();
$page_title = "Admin";
require "includes/head.php";
if($_SESSION['username']) {
    require "includes/dbConnect.php";

    $admin_page = <<< EOP
    <section id="main_content">
        <h2>Admin Area</h2>

        <div class="admin_nav">
            <a href="stories_admin.php">Stories </a>&nbsp;|&nbsp;
            <a href="prod_admin.php">Products</a>
        </div>
        </section>
EOP;

    echo $admin_page;

    require "includes/footer.php";
    }else{
    ob_clean();
    header('Location: login.php');
}
?>
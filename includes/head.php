<?php
session_start();
if ($page_title == "" || !$page_title)
    $page_title = "Fast Lane Performance Parts";
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>
        <?php
        echo $page_title
        ?>
    </title>
    <link rel="stylesheet" href="css/styles.css"/>
    <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
</head>
<body>
<header>
    <h1 class="header_text">&nbsp;&nbsp;&nbsp;Fast Lane<br/> Performance Parts</h1>

    <div class="header_nav">
        <?php
        $user = $_SESSION['username'];
        if ($user) {
            echo "<span>Logged in as: $user</span><br/>";
            echo "<a href='logout.php'>Logout</a><br/><br/>";
            echo "<a href='admin.php'>Admin</a>";
        } else {
            echo "<a href='login.php'>Login</a>";
        }
        ?>
    </div>
</header>
<nav>
    <ul class='nav'>
        <li class="first"><a href="index.php">Home</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="store.php">Shop</a></li>
        <li class="last"><a href="contact.php">Contact</a></li>
    </ul>
</nav>
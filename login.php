<?php
ob_start();
$page_title = "Login";
require "includes/head.php";
require "includes/dbConnect.php";

$username =$_POST['username'];
$password = $_POST['password'];
$submit = $_POST['submit'];

if ($submit){
    $password = hash("sha256", $password);
    $sql = "SELECT * FROM users WHERE user_name = '$username' AND pass = '$password'";
    $result = $db->query($sql);
    list($user_id,$user_name,$pass)=$result->fetch_row();
    mysqli_close($db);

    if($user_id){
        $_SESSION['username'] = $user_name;
        ob_clean();
        header("Location: admin.php");
    }else{
        echo "Login failed";
    }
}

$login = <<< EOL
<section id="main_content">
    <h2>Administrator Login</h2>
    <form method="POST" action="login.php" class="login">
        <label for="username">Username: </label><input type="email" name="username" id="username"><br>
        <label for="password">Password: </label><input type="password" name="password" id="password"><br>
        <input type="submit" name="submit" class="button">
    </form>
</section>
EOL;

echo $login;

require "includes/footer.php";
?>
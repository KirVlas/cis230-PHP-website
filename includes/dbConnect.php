<?php

    $message = "";

$db = new mysqli('mysql.php-example.kirillv.com', 'kirillv', 'turbolude03', 'kirillv_phptest');
    if ($db->connect_error) {
        $message = $db->connect_error;
    }else {
        $message = 'Database connected';
    }


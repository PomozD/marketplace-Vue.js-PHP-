<?php
    $connect = mysqli_connect('localhost', 'root', '', 'project-php-db');

    if (!$connect) {
        die('Error connect to DataBase');
    }
?>
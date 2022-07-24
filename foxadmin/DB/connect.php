<?php 
$user="root";
$password="root";
$dbname="attraction";
$link = mysqli_connect("127.0.0.1", $user, $password, $dbname);
mysqli_query($link, "SET NAMES utf8");
?>
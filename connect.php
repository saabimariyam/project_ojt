<?php 

$host = "localhost";
$root = "root";
$pass = "";
$db = "userpage";

if (!$conn = mysqli_connect($host, $root, $pass, $db)){
    die("Failed to connect!");
}

?>
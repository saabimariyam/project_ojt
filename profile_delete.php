<?php
session_start();
include "connect.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

/* delete profile */
mysqli_query($conn,
    "DELETE FROM user WHERE username='$username'"
);

/* destroy session */
session_destroy();

/* redirect to register / login */
header("Location: register.php");
exit();

<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="profile_home.css">
</head>
<body>

<div class="profile-box">

    <div class="avatar">
        <?php echo strtoupper(substr($_SESSION['username'],0,1)); ?>
    </div>

    <h2><?php echo $_SESSION['username']; ?></h2>
    <p class="role">Welcome to your profile</p>

    <p class="about">
        This is your personal profile page.  
        You can manage your information and explore the application from here.
    </p>

    <div class="actions">
        <a href="profile_edit.php">Edit Profile</a>
        <a href="logout.php" class="outline">Logout</a>
    </div>

</div>

</body>
</html>

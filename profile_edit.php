<?php
session_start();
include "connect.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

/* fetch profile (example: using username) */
$username = $_SESSION['username'];

$data = mysqli_query($conn,
    "SELECT * FROM user WHERE username='$username'"
);
$row = mysqli_fetch_assoc($data);

/* update profile */
if(isset($_POST['update'])){

    $email = $_POST['email'];

    mysqli_query($conn,
        "UPDATE user 
         SET email='$email' 
         WHERE username='$username'"
    );

    header("Location: profile_home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="profile_home.css">
<style>
/* small additions only */
form{
    margin-top:20px;
}
input {
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
}
.delete{
    margin-top:15px;
    display:inline-block;
    color:#dc2626;
    text-decoration:none;
    font-weight:600;
}
</style>
</head>
<body>

<div class="profile-box">

    <div class="avatar">
        <?php echo strtoupper(substr($_SESSION['username'],0,1)); ?>
    </div>

    <h2>Edit Profile</h2>

    <form method="POST">
        <input type="email" name="email"
               value="<?php echo $row['email']; ?>"
               placeholder="Email" required>

        <div class="actions">
            <button type="submit" name="update">Save Changes</button>
            <a href="profile_home.php" class="outline">Cancel</a>
        </div>
    </form>

    <!-- DELETE PROFILE -->
    <a href="profile_delete.php"
       class="delete"
       onclick="return confirm('Are you sure you want to delete your profile?')">
       Delete Profile
    </a>

</div>

</body>
</html>

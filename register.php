<?php
include("connect.php");

$alertMessage = "";
$redirect = "";

if(isset($_POST['register'])){

    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($username=="" || $email=="" || $password=="" || $confirm_password==""){
        $alertMessage = "All fields are required";
    }
    elseif(strlen($password) < 6){
        $alertMessage = "Password must be at least 6 characters";
    }
    elseif($password !== $confirm_password){
        $alertMessage = "Passwords do not match";
    }
    else{

        $check = mysqli_query($conn,"SELECT id FROM user WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){
            $alertMessage = "This email is already registered";
        }
        else{

            $insert = mysqli_query($conn,
                "INSERT INTO user(username,email,password)
                VALUES('$username','$email','$password')"
            );

            if($insert){
                $alertMessage = "Registration successful";
                $redirect = "index.php";
            }else{
                $alertMessage = "Something went wrong";
            }
        }
    }

    echo "<script>
            alert('$alertMessage');
            ".($redirect ? "window.location.href='$redirect';" : "")."
            </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registerpage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="register.css">
</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-card">

            <form class="auth-left" method="POST">

                <h2>Sign Up</h2>

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" placeholder="Username" name="username">
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="Email address" name="email">
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="pass1" placeholder="Password" name="password">
                    <span onclick="toggle('pass1','eye1')">
                        <i class="fa-regular fa-eye" id="eye1"></i>
                    </span>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="pass2" placeholder="Confirm Password" name="confirm_password">
                    <span onclick="toggle('pass2','eye2')">
                        <i class="fa-regular fa-eye" id="eye2"></i>
                    </span>
                </div>

                <button type="submit" name="register" class="btn-main">REGISTER</button>

                <div class="or">
                    <span></span> OR <span></span>
                </div>

                <button class="btn-google">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg">
                    Login with Google
                </button>

                <p class="bottom-text">
                    Already have an account?
                    <a href="index.php">Sign In</a>
                </p>
            </form>

            <div class="auth-right">
                <img src="asset\register.jpg" alt="register">
            </div>

        </div>

    </div>

    <script>
        function toggle(id, eye) {
            const input = document.getElementById(id);
            const icon = document.getElementById(eye);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

</body>

</html>
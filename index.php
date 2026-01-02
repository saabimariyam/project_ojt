<?php
session_start();
include("connect.php");

if(isset($_SESSION['user_id'])) {
    header("location: profile_home.php");
    exit();
}

$loginMessage = "";
$redirect = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if($email=="" || $password==""){
        $loginMessage = "All fields are required";
    }
    else{

        $query = mysqli_query($conn,
            "SELECT * FROM user WHERE email='$email' LIMIT 1"
        );

        if(mysqli_num_rows($query) == 0){
            $loginMessage = "User not found";
        }
        else{
            $row = mysqli_fetch_assoc($query);

            if($row['password'] !== $password){
                $loginMessage = "Incorrect password";
            }
            else{
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];

                $loginMessage = "Login successful";
                $redirect = "profile_home.php";
            }
        }
    }

    echo "<script>
            alert('$loginMessage');
            ".($redirect ? "window.location.href='$redirect';" : "")."
            </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Loginpage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <form method="POST" class="login-left">
                <h2>Sign In</h2>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="Email address" name="email"/>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" placeholder="Password" name="password"/>
                    <span class="toggle" onclick="togglePassword()">
                        <i class="fa-regular fa-eye" id="eye"></i>
                    </span>
                </div>

                <a href="#" class="forgot">Forgot your password?</a>

                <button type="submit" name="login" class="btn-login">LOG IN</button>

                <div class="or"><span></span> OR <span></span></div>

                <button class="btn-google">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" />
                    Log in with Google
                </button>
                

                <p class="bottom-text">
                    Don’t have an account?
                    <a href="register.php">Sign Up</a>
                </p>
            </form>

            <div class="login-right">
                <img src="asset\login.jpg" alt="login" />
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            const eye = document.getElementById("eye");

            if (pass.type === "password") {
                pass.type = "text";
                eye.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                pass.type = "password";
                eye.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>

</html>
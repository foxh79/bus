<?php
    require 'assets/partials/_functions.php';
    $conn = db_connect();    

    if(!$conn) 
        die("Connection Failed");

        $url = "http://localhost/bus/";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduka | Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="signup__container adminLogin">
        <div class="signup__form-container"> 
            <div class="form">
                <h1>ONLY FOR ADMIN</h1>
                <small>Please login here</small>
                <form action="assets/partials/_handleLogin.php" method="POST">
                    <label for="username">Username *</label>
                    <input type="text" name="username" required>
                    <label for="password">Password *</label>
                    <input type="password" name="password" required>
                    <button type="submit" class="btn form__btn" name="submit">Login</button>
                </form>
                <span>
                    <a href="./signup.php">Create Account?</a>
                    <a href="./forgot_password.php">Forgot Password?</a>
                </span>

            </div>
        </div>
    </div>
</body>

</html>
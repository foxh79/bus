<?php
        session_start();

    require './assets/partials/_functions.php';
    $conn = db_connect();

    if(!$conn)
        die("Oh Shoot!! Connection Failed");

if (isset($_POST['submit'])) {
    //get the form submission data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$email) {
        $_SESSION['login'] = "Please enter email address";
    } elseif (!$password) {
        $_SESSION['login'] = "Please enter password";
    } else {
        //fetch user dat from database
        $fetch_user_query = "SELECT * FROM customers WHERE email = '$email'";
        $fetch_user_result = mysqli_query($conn, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into an assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            //compare the passwords

            if ($password == $db_password) {
                //set session for access control

                $_SESSION['user-id'] = $user_record['id'];

                header('Location: index.php');

            } else {
                $_SESSION['login'] = "Password is incorrect";
            }
        } else {
            $_SESSION['login'] = "User not found";
        }
    }
    //if an error occured, redirect back to login with login details

    if (isset($_SESSION['login'])) {
        $_SESSION['login-data'] = $_POST;
        header('location: login.php');
        die();
    }
} else {
    header('location: login.php');
    die();
}
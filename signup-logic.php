<?php
        session_start();

    require './assets/partials/_functions.php';
    $conn = db_connect();

    if(!$conn)
        die("Oh Shoot!! Connection Failed");


//get data from database

if (isset($_POST['submit'])) {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //validate inputs

    if (!$name) {
        $_SESSION['signup'] = "Please enter your  name";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter your email";
    } elseif (!$phone) {
        $_SESSION['signup'] = "Please enter your phone";
    } elseif (strlen($password) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
    } else {
        //check password equality

        if ($password != $confirmpassword) {
            $_SESSION['signup'] = 'password do not match';
        } else {

            //check if the username arealdy exists

            $user_check_query = "SELECT * FROM customers WHERE email = '$email'";
            $user_check_result = mysqli_query($conn, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exist";
        
            } else { 
                    // Route is unique, proceed
                    $sql = "INSERT INTO customers (customer_name,email, customer_phone,password,customer_created) VALUES ('$name','$email','$phone','$password',current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    // Gives back the Auto Increment id
                    $autoInc_id = mysqli_insert_id($conn);
                    // If the id exists then, 
                    if ($autoInc_id) {
                        $code = rand(1, 99999);
                        // Generates the unique userid
                        $customer_id = "CUST-" . $code . $autoInc_id;

                        $query = "UPDATE customers SET customer_id = '$customer_id' WHERE customers.id = $autoInc_id;";
                        $queryResult = mysqli_query($conn, $query);

                        if (!$queryResult)
                            echo "Not Working";
                    }

                    if ($result)
                        $customer_added = true;
                    header('Location: login.php');

                }
            }
        }
    } else {

    //if button was not clicked then back to signup

    header('Location: signup.php');
    die();

}
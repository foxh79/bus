<?php
require './assets/partials/_functions.php'; // Include your database connection function

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $customer_name = clean_input($_POST["customer_name"]);
    $seat_number = clean_input($_POST["seat_number"]);
    $destination = clean_input($_POST["destination"]);
    $date = clean_input($_POST["date"]);

    // Validate inputs
    $errors = [];
    if (empty($customer_name) || empty($seat_number) || empty($destination) || empty($date)) {
        $errors[] = "Please fill all required fields.";
    }

    // If there are no validation errors, proceed with booking
    if (empty($errors)) {
        $conn = db_connect(); // Establish database connection

        // Check if the connection is successful
        if ($conn) {
            // Prepare SQL statement using prepared statement to prevent SQL injection
            $sql = "INSERT INTO ticket (customer_name, seat_number, destination, date) VALUES (?, ?, ?, ?)";

            // Prepare and bind SQL statement
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $customer_name, $seat_number, $destination, $date);

            // Execute SQL statement
            if (mysqli_stmt_execute($stmt)) {
                // Check if the user is signed up (you need to implement this check)
                $is_signed_up = true;

                // Redirect user based on signup status
                if ($is_signed_up) {
                    redirect("account.php"); // Redirect to account page if signed up
                } else {
                    redirect("signup.php"); // Redirect to signup page if not signed up
                }
            } else {
                echo "Error: " . mysqli_error($conn); // Handle SQL execution error
            }

            // Close statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "Connection failed: " . mysqli_connect_error(); // Handle database connection error
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}

// Function to sanitize input data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to redirect to a specific page
function redirect($url) {
    header("Location: $url");
    exit();
}

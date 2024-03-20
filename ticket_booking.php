<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Booking</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Provided CSS styles */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Poppins:wght@400;500;600;700;800;900&family=Rubik+Mono+One&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            appearance: unset;
        }
        a {
            text-decoration: none;
        }
        li {
            list-style: none;
        }
        html {
            scroll-behavior: smooth;
        }
        input {
            outline: none;
        }
        button {
            border: none;
        }
        :root {
            --background-white: #fff;
            --background-dark: #000;
            --background-secondary: #6a5acd;
            --background-primary: #ebedf1;
            --border-radius: 5px;
            --transition: all 400ms ease-in-out;
            --color-slate: #cec9f0;
            --btn-border: 6px;
            --background: #414040;
            --color: #fff;
            --transition: 300ms ease-in-out;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-primary);
        }
        /* Navigation styling */
        nav {
            width: 90vw;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
        }
        nav .logo h1 {
            color: var(--background-secondary);
            font-size: 2rem;
        }
        nav ul {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        nav ul li a {
            font-size: 1.2rem;
            color: var(--background-dark);
        }
        nav ul li a:hover {
            letter-spacing: 2px;
            transition: var(--transition);
        }
        nav .button a {
            color: var(--background-white);
            padding: 8px 16px;
            background: var(--background-secondary);
            border-radius: var(--border-radius);
        }
        nav .button a:hover {
            color: var(--background-secondary);
            border: 1px solid var(--background-dark);
            background: transparent;
            transition: var(--transition);
        }
        .menu {
            width: fit-content;
            display: none;
            align-items: center;
            width: 2rem;
            position: absolute;
            right: 6rem;
            transform: rotate(90deg);
        }
        /* Ticket booking section styling */
        .ticket-booking {
            padding: 4rem 0;
            text-align: center;
        }
        .ticket-booking h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #262626;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .booking-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .booking-form label {
            font-size: 1.2rem;
            color: #262626;
        }
        .booking-form input[type="text"],
        .booking-form input[type="date"] {
            padding: 1rem;
            border: 1px solid var(--background-secondary);
            border-radius: var(--border-radius);
            font-size: 1rem;
            width: 100%;
        }
        .booking-form button {
            padding: 1rem;
            background-color: var(--background-secondary);
            color: var(--background-white);
            border-radius: var(--border-radius);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .booking-form button:hover {
            background-color: #5748e3;
        }
        /* Footer styling */
        footer {
            padding: 2rem;
            background: var(--background-secondary);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .footer__left .logo {
            color: var(--background-dark);
            margin-bottom: 1rem;
        }
        .footer__left .logo h1 {
            color: var(--background-dark);
            filter: invert();
        }
        .footer__left .logo small {
            filter: invert();
        }
        .social__links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        footer p {
            filter: invert();
            width: 50%;
        }
        .social__links a img {
            margin-top: 2rem;
            width: 2rem;
            filter: invert();
        }
        footer h1,
        footer a {
            filter: invert();
        }
        .useful__links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .useful__links a {
            font-size: 1.2rem;
            color: var(--background-dark);
        }
        .useful__links a:hover {
            letter-spacing: 2px;
            color: var(--background-white);
            transition: var(--transition);
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <h1>FOXH</h1>
            <small>Tours and Travels</small>
        </div>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact</a></li>
            <!-- Add more navigation links as needed -->
        </ul>
        <div class="button">
            <a href="#">Sign In</a>
        </div>
        <div class="menu bars">
            <img src="menu.svg" alt="menu">
        </div>
    </nav>

    <!-- Ticket Booking Section -->
    <section class="ticket-booking">
        <div class="container">
            <h2>Book Your Ticket</h2>
            <form action="process_booking.php" method="POST" class="booking-form">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" required>
                
                <label for="seat_number">Seat Number:</label>
                <input type="text" id="seat_number" name="seat_number" required>

                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <button type="submit" name="submit_booking" class="btn">Book Ticket</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer__left">
            <div class="logo">
                <h1>FOXH</h1>
                <small>Tours and Travels</small>
            </div>
            <p>Explore the world with Foxh Tours and Travels: Where every journey becomes an unforgettable adventure!</p>
            <div class="social__links">
                <a href="#"><img src="./assets/brand-facebook-filled.png" alt=""></a>
                <a href="#"><img src="./assets/brand-twitter-filled.png" alt=""></a>
                <a href="#"><img src="./assets/brand-instagram.png" alt=""></a>
            </div>
        </div>
        <div class="useful__links">
            <h1>Useful Links</h1>
            <a href="#">About</a>
            <a href="#">FAQs</a>
            <a href="#">Blog</a>
            <a href="#">Contact</a>
        </div>
        <div class="useful__links">
            <h1>Policies</h1>
            <a href="#">Private Policy</a>
            <a href="#">Terms and Condition</a>
            <a href="#">Ticket Policies</a>
        </div>
        <div class="useful__links">
            <h1>Contact Info</h1>
            <a href="#">Nairobi, Kenya</a>
            <a href="#">+254742317111</a>
            <a href="#">foxhtro@gmail.com</a>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="./app.js"></script>

    <?php
// Database connection settings
require './assets/partials/_functions.php';
$conn = db_connect();

if(!$conn)
    die("Oh Shoot!! Connection Failed");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST["customer_name"]) && isset($_POST["seat_number"]) && isset($_POST["destination"]) && isset($_POST["date"])) {
        // Retrieve form data
        $customer_name = $_POST["customer_name"];
        $seat_number = $_POST["seat_number"];
        $destination = $_POST["destination"];
        $date = $_POST["date"];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement to insert data into the ticket table
        $stmt = $conn->prepare("INSERT INTO ticket (customer_name, seat_number, destination, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $customer_name, $seat_number, $destination, $date);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo "<h2>Booking Details</h2>";
            echo "<p>Customer Name: $customer_name</p>";
            echo "<p>Seat Number: $seat_number</p>";
            echo "<p>Destination: $destination</p>";
            echo "<p>Date: $date</p>";
            echo "<p>Booking successful!</p>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        // If required fields are not filled, display an error message
        echo "<p>Please fill all required fields.</p>";
    }
}
?>

</body>
</html>

<?php
session_start();
require 'assets/partials/_functions.php';
$conn = db_connect();

if (!$conn) {
    die("Connection Failed");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket | Book...</title>
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
            <li><a href="#pnr-enquiry" class="pnr nav-item">PNR Enquiry</a></li>
        </ul>
        <div class="account">
            <?php if (isset($_SESSION['user-id'])) : ?>
                <li><a href="./account.php"><img style="width: 2rem;" src="./assets/user-profile-min.png" alt=""></a></li>
            <?php else : ?>
                <li><a href="./adminLogin.php">Admin Login</a></li>
                <button class="button"><a href="./login.php">Sign In</a></button>
            <?php endif; ?>
        </div>

        <img src="./assets/bars.png" alt="" class="menu bars">
        <img src="./assets/x.png" alt="" class="menu x">
    </nav>

    <!-- Hero section -->

    <div class="hero">
        <img src="./assets/bus.png" alt="Bus" class="bus">

        <div class="hero__left">
            <h1>Get Your Ticket Online, <br>
                Easy and Safely</h1>
            <button><a href="ticket_booking.php" class="btn">GET TICKET NOW</a></button>
        </div>
        <div class="hero__right">
            <h1>Choose Your Ticket</h1>
            <form action="ticket_booking.php" method="POST" class="search_form">
                <input type="text" id="pickup" name="pickup" list="kenyan-towns" placeholder="Pickup Point">
                <datalist id="kenyan-towns">
                    <option value="Nairobi">
                    <option value="Mombasa">
                    <!-- Other options -->
                </datalist>
                <input type="text" id="dropoff" name="dropoff" list="kenyan-towns" placeholder="Dropping Point">
                <label for="date">Choose The travelling date:</label>
                <input type="date" name="departure_date" placeholder="Departure Date">
                <button type="submit"> <span>Search bus</span><img src="./assets/search.png" alt=""></button>
            </form>
        </div>
    </div>

    <!-- PROCESS SECTION -->

    <section class="steps">
        <div class="title">
            <h1>Get Your Ticket With Just 3 Steps</h1>
            <small>Have a look at our popular reason. Why
                you should choose your bus. Just a Bus and <br>
                get a ticket for your great journey!
            </small>
        </div>
        <div class="steps__container">
            <div class="step">
                <span>01</span>
                <img src="./assets/search.png" alt="">
                <h2>Search Your Bus</h2>
                <p>Choose your origin, destination. Just choose a <br>
                    bus journey dates and search for buses.</p>
            </div>
            <div class="step">
                <span>02</span>
                <img src="./assets/ticket.png" alt="">
                <h2>Choose The Ticket</h2>
                <p>Choose your origin, destination. Just choose a <br>
                    bus journey dates and search for buses.</p>
            </div>
            <div class="step">
                <span>03</span>
                <img src="./assets/cash.png" alt="">
                <h2>Search Your Bus</h2>
                <p>Choose your origin, destination. Just choose a <br>
                    bus journey dates and search for buses.</p>
            </div>
        </div>
    </section>

    <section class="amenities">
        <div class="title">
            <h1>Our Amenities</h1>
            <small>Have a look at our popular reasons. Why
                you should choose your bus. Just a Bus and <br>
                get a ticket for your great journey!
            </small>
        </div>

        <div class="amenities__container">
            <div class="amenity">
                <img src="./assets/wifi.png" alt="">
                <span>Wifi</span>
            </div>
            <div class="amenity">
                <img src="./assets/sofa.png" alt="">
                <span>Pillow</span>
            </div>
            <div class="amenity">
                <img src="./assets/bottle.png" alt="">
                <span>Water Bottle</span>
            </div>
            <div class="amenity">
                <img src="./assets/glass-full.png" alt="">
                <span>Soft Drink</span>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->

    <section class="testimonials">
        <div class="title">
            <h1>Our Testimonials</h1>
            <small>Have a look at our popular reasons. Why
                you should choose your bus. Just a Bus and <br>
                get a ticket for your great journey!
            </small>
        </div>
        <div class="testimonials__container">
            <div class="testimonial">
                <p>Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Velit rerum inventore
                    commodi quasi, omnis deserunt
                    recusandae numquam non vel magni.</p>
                <img src="./assets/avatar2.jpg" alt="">
                <span>Boniface Mwau</span>
            </div>
            <div class="testimonial">
                <p>Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Velit rerum inventore
                    commodi quasi, omnis deserunt
                    recusandae numquam non vel magni.</p>
                <img src="./assets/avatar10.jpg" alt="">
                <span>Faith Atieno</span>
            </div>
            <div class="testimonial">
                <p>Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Velit rerum inventore
                    commodi quasi, omnis deserunt                     recusandae numquam non vel magni.</p>
                <img src="./assets/avatar5.jpg" alt="">
                <span>Nicole Atieno</span>
            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->

    <footer>
        <div class="footer__left">
            <div class="logo">
                <h1>FOXH</h1>
                <small>Tours and Travels</small>
            </div>
            <p>Explore the world with Foxh Tours and Travels:
                Where every journey becomes an unforgettable adventure!</p>
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

    <script src="./app.js"></script>
</body>

</html>


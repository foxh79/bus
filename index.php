<?php
session_start();
require 'assets/partials/_functions.php';
$conn = db_connect();

if (!$conn)
    die("Connection Failed");
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
    <?php

    if (isset($_GET["booking_added"]) && !isset($_POST['pnr-search'])) {
        if ($_GET["booking_added"]) {
            echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful!</strong> Booking Added, your PNR is <span style="font-weight:bold; color: #272640;">' . $_GET["pnr"] . '</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            // Show error alert
            echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Booking already exists
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pnr-search"])) {
        $pnr = $_POST["pnr"];

        $sql = "SELECT * FROM bookings WHERE booking_id='$pnr'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if ($num) {
            $row = mysqli_fetch_assoc($result);
            $route_id = $row["route_id"];
            $customer_id = $row["customer_id"];

            $customer_name = get_from_table($conn, "customers", "customer_id", $customer_id, "customer_name");

            $customer_phone = get_from_table($conn, "customers", "customer_id", $customer_id, "customer_phone");

            $customer_route = $row["customer_route"];
            $booked_amount = $row["booked_amount"];

            $booked_seat = $row["booked_seat"];
            $booked_timing = $row["booking_created"];

            $dep_date = get_from_table($conn, "routes", "route_id", $route_id, "route_dep_date");

            $dep_time = get_from_table($conn, "routes", "route_id", $route_id, "route_dep_time");

            $bus_no = get_from_table($conn, "routes", "route_id", $route_id, "bus_no");
    ?>

            <div class="alert alert-dark alert-dismissible fade show" role="alert">

                <h4 class="alert-heading">Booking Information!</h4>
                <p>
                    <button class="btn btn-sm btn-success"><a href="assets/partials/_download.php?pnr=<?php echo $pnr; ?>" class="link-light">Download</a></button>
                    <button class="btn btn-danger btn-sm" id="deleteBooking" data-bs-toggle="modal" data-bs-target="#deleteModal" data-pnr="<?php echo $pnr; ?>" data-seat="<?php echo $booked_seat; ?>" data-bus="<?php echo $bus_no; ?>">
                        Delete
                    </button>
                </p>
                <hr>
                <p class="mb-0">
                <ul class="pnr-details">
                    <li>
                        <strong>PNR : </strong>
                        <?php echo $pnr; ?>
                    </li>
                    <li>
                        <strong>Customer Name : </strong>
                        <?php echo $customer_name; ?>
                    </li>
                    <li>
                        <strong>Customer Phone : </strong>
                        <?php echo $customer_phone; ?>
                    </li>
                    <li>
                        <strong>Route : </strong>
                        <?php echo $customer_route; ?>
                    </li>
                    <li>
                        <strong>Bus Number : </strong>
                        <?php echo $bus_no; ?>
                    </li>
                    <li>
                        <strong>Booked Seat Number : </strong>
                        <?php echo $booked_seat; ?>
                    </li>
                    <li>
                        <strong>Departure Date : </strong>
                        <?php echo $dep_date; ?>
                    </li>
                    <li>
                        <strong>Departure Time : </strong>
                        <?php echo $dep_time; ?>
                    </li>
                    <li>
                        <strong>Booked Timing : </strong>
                        <?php echo $booked_timing; ?>
                    </li>

                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else {
            echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Record Doesnt Exist
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }

        ?>

    <?php }


    // Delete Booking
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteBtn"])) {
        $pnr = $_POST["id"];
        $bus_no = $_POST["bus"];
        $booked_seat = $_POST["booked_seat"];

        $deleteSql = "DELETE FROM `bookings` WHERE `bookings`.`booking_id` = '$pnr'";

        $deleteResult = mysqli_query($conn, $deleteSql);
        $rowsAffected = mysqli_affected_rows($conn);
        $messageStatus = "danger";
        $messageInfo = "";
        $messageHeading = "Error!";

        if (!$rowsAffected) {
            $messageInfo = "Record Doesn't Exist";
        } elseif ($deleteResult) {
            $messageStatus = "success";
            $messageInfo = "Booking Details deleted";
            $messageHeading = "Successfull!";

            // Update the Seats table
            $seats = get_from_table($conn, "seats", "bus_no", $bus_no, "seat_booked");

            // Extract the seat no. that needs to be deleted
            $booked_seat = $_POST["booked_seat"];

            $seats = explode(",", $seats);
            $idx = array_search($booked_seat, $seats);
            array_splice($seats, $idx, 1);
            $seats = implode(",", $seats);

            $updateSeatSql = "UPDATE `seats` SET `seat_booked` = '$seats' WHERE `seats`.`bus_no` = '$bus_no';";
            mysqli_query($conn, $updateSeatSql);
        } else {

            $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
        }

        // Message
        echo '<div class="my-0 alert alert-' . $messageStatus . ' alert-dismissible fade show" role="alert">
                <strong>' . $messageHeading . '</strong> ' . $messageInfo . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    ?>
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
            <form action="ticket_booking.php" method="POSTT" class="search_form">
                <input type="text" id="location" name="location" list="kenyan-towns" placeholder="Pickup Point">
                <datalist id="kenyan-towns">
                    <option value="Nairobi">
                    <option value="Mombasa">
                    <option value="Kisumu">
                    <option value="Nakuru">
                    <option value="Eldoret">
                    <option value="Thika">
                    <option value="Malindi">
                    <option value="Kitale">
                    <option value="Garissa">
                    <option value="Kakamega">
                    <option value="Nyeri">
                    <option value="Meru">
                    <option value="Kisii">
                    <option value="Embu">
                    <option value="Machakos">
                    <option value="Voi">
                    <option value="Bungoma">
                    <option value="Kericho">
                    <option value="Nanyuki">
                    <option value="Lamu">
                </datalist>
                <input type="text" id="location" name="location" list="kenyan-towns" placeholder="Dropping Point">
                <datalist id="kenyan-towns">
                    <option value="Nairobi">
                    <option value="Mombasa">
                    <option value="Kisumu">
                    <option value="Nakuru">
                    <option value="Eldoret">
                    <option value="Thika">
                    <option value="Malindi">
                    <option value="Kitale">
                    <option value="Garissa">
                    <option value="Kakamega">
                    <option value="Nyeri">
                    <option value="Meru">
                    <option value="Kisii">
                    <option value="Embu">
                    <option value="Machakos">
                    <option value="Voi">
                    <option value="Bungoma">
                    <option value="Kericho">
                    <option value="Nanyuki">
                    <option value="Lamu">
                </datalist>
                <label for="date">Choose The travelling date:</label>
                <input type="date" placeholder="Departure Date">
                <button> <span>Search bus</span><img src="./assets/search.png" alt=""></button>
            </form>
        </div>
    </div>


    <!-- PROCESS SECTION -->

    <section class="steps">
        <div class="title">
            <h1>Get You Ticket With Just 3 Steps</h1>
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
            <small>Have a look at ouyr popular reason. Why
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
            <small>Have a look at ouyr popular reason. Why
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
                    commodi quasi, omnis deserunt
                    recusandae numquam non vel magni.</p>
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
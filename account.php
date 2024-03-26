<?php
        session_start();
    require './assets/partials/_functions.php';
    $conn = db_connect();

    if(!$conn)
        die("Oh no!! Connection Failed");

if (!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    $_SESSION['login'] = 'You have to login to access this page';
    exit();
}

$email = $_SESSION['update-data']['email'] ?? null;
$name = $_SESSION['update-data']['customer_name'] ?? null;
$password = $_SESSION['update-data']['password'] ?? null;
unset($_SESSION['update-data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus</title>
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        
/* 

ACCOUNT SECTION 

*/

.account__hero {
    background: var(--color);
    margin-top: 4rem;
    display: flex;
    padding: 3rem;
}

.account__hero aside {
    position: sticky;
    display: flex;
    flex-direction: column;
    gap: 3rem;
    background: var(--color);
    padding: 1rem;
    border-radius: 12px;
}

.aside__span {
    display: flex;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
}

.aside__child {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.aside__span:hover > p{
    color: #6a5acd;
}

.aside__span:hover > i {
    color: #6a5acd;
}
.aside__span i {
    font-size: 1.2rem;
    color: var(--background);
}

.account__user  {
    display: flex;
    align-items: center;
    gap: 1rem;
}


.account__user i {
    font-size: 3rem;
}

.account__user h3 {
    font-family: 'Rubik Mono One', sans-serif;
}

.account__user span p{
    font-size: 12px;
    color: #000;
}
.aside__span p {
    font-size: 14px;
    color: var(--background);

}

.account__hero main {
    width: 100%;
    margin-left: 10%;
    padding: 1rem;
    overflow: hidden;
}

.account__hero main form input {
    width: 100%;
}

.account__hero main form p {
    font-size: 14px;
}

.Personal__information .signup__form-container {
    width: 50%;
}

.Personal__information .signup__form-container .form {
    width: 100%;
}


.Purchased__item {
    margin-top: 1rem;
    width: 100%;
    display: flex;
    gap: 3rem;
    background: #ebedf1;
    padding: 1rem;
}

.Purchased__item img {
    width: 8rem;
}

.Purchased__item small {
    font-size: 1rem;
    width: 10rem;
}

.purchased__item-details {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: .4rem;

}

.purchased__item-details small{
    width: 100%;
    font-weight: bold;
}

.purchased__item-details span {
    font-size: 12px;
}

.my__orders {
    width: 100%;
    display: flex;
    background: #ebedf1;
    padding: 1rem;
}

.itemDetails {
    background: #ebedf1;
    padding: 2rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.itemDetails .Purchased__item {
    width: 100%;
}

.main {
    left: 40%;
    width: 100%;
    height: 50%;
    background: var(--color);
}


.active-aside__span {
    background: #cec9f0;
    border-radius: 6px;
    padding: .5rem;
    font-weight: bold;
}

.active-aside__span i {
    color: #000;
}
    </style>
</head>

<body style="background: #ebedf1;
">
    <nav class="navbar container">
        <a href="index.php">
            <div class="logo">
                <h1>Foxh</h1>
                <small>Tours</small>
            </div>
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#blog">Blog</a></li>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
        <li><a href="./account.php"><img style="width: 2rem;" src="./assets/user-profile-min.png" alt=""></a></li>
        <img src="./assets/bars.png" alt="" class="menu bars">
        <img src="./assets/x.png" alt="" class="menu x">
    </nav>

    <div class="account__hero container">
        <aside>
            <h1>My Profile</h1>
            <div class="account__user">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                <span>
                    <?php
                    if (isset($_SESSION['user-id'])):
                        $id = $_SESSION['user-id'];
                        $fetch_user_query = "SELECT * FROM customers WHERE id = $id";
                        $run_query = mysqli_query($conn, $fetch_user_query);
                        $user_record = mysqli_fetch_assoc($run_query);
                        echo '<h4>' . $user_record['customer_name'] . '</h4>';
                        echo '<p>' . $user_record['email'] . '</p>';
                        ?>
                    <?php else:
                        header('Location : login.php');
                    endif ?>
                </span>
            </div>
            <span class="aside__span">
                <i class="fa fa-user-o" aria-hidden="true"></i>
                <p>Personal Information</p>
            </span>
            <span class="aside__span">
                <i class="fa fa-bus" aria-hidden="true"></i>
                <p>My Booking</p>
            </span>
            <span class="aside__span">
                <i class="fa fa-sign-out" aria-hidden="true" style="color: red;"></i>
                <p><a href="./logout.php" style="color: #c27272;">Logout</a></p>
            </span>
        </aside>

        <main>
            <div id="main" class="main Personal__information">
                <div class="signup__form-container">
                    <div class="form">
                        <h3>Personal Information</h3>
                        <?php if (isset($_SESSION['update-success'])): ?>

                            <div class="alert__message success">
                                <p>
                                    <?= $_SESSION['update-success'];
                                    unset($_SESSION['update-success']);
                                    ?>
                                </p>
                            </div>
                        <?php elseif (isset($_SESSION['update'])): ?>
                            <div class="alert__message error">
                                <p>
                                    <?= $_SESSION['update'];
                                    unset($_SESSION['update']);
                                    ?>
                                </p>
                            </div>
                        <?php endif ?>
                        <form action="" method="POST">
                            <label for="name">Email Address *</label>
                            <input type="email" value="" placeholder="<?= $user_record['email'] ?>">
                            <label for="name">Name *</label>
                            <input type="text" value="" placeholder="<?= $user_record['customer_name'] ?>">
                            <p>Change your details below, or <a href="#" id="passcode-toggler">click here</a> to change
                                your password.</p>
                            <label id="passcode" class="passcode" for="name">Password *</label>
                            <input id="passcode" class="passcode" type="password" value=""
                                placeholder="<?= $user_record['password'] ?>">
                            <button type="submit" class="btn" name="">Update Account</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="main" class="main purchase__info">
                <h3>My Booking</h3>
                <div class="Purchased__item my__orders">
                    <div class="purchased__item-details">
                        <div>Ticket: <b>QWERT2345ER</b></div>
                        <p>Total: Ksh. 1,000</p>
                        <span>Booked On: 11/02/2024</span>
                    </div>
                    <small><a href="#">View Ticket</a></small>
                </div>
            </div>

            <div id="main" class="main">
                <div class="itemDetails">
                    <h3>Ticket: QWERT2345ER</h3>
                    <span>ID: QWERT2345ER</span>
                    <span>Payment ref: SB19S8ZD0Z</span>
                    <span>Seat No: 16</span>
                    <span>Booked On: 11/02/2024</span>
                    <span><b>Total: Ksh. 1,000</b></span>
                    <div class="Purchased__item">
                        <div class="purchased__item-details">
                            <small>Bus</small>
                            <div>KCB123Q <b></b></div>
                            <p>Ksh. 1,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- SERVICES SECTION -->



    <!-- FOOTER SECTION -->
    <script>
        
// account section js
document.addEventListener("DOMContentLoaded", function () {
  const asideSpans = document.querySelectorAll('.aside__span');
  const mainSections = document.querySelectorAll('.main');
  const viewOrderLinks = document.querySelectorAll('.my__orders a');

  // Function to remove 'active-aside__span' class from all spans
  const removeActiveClass = () => {
      asideSpans.forEach(s => s.classList.remove('active-aside__span'));
  };

  asideSpans.forEach((span, index) => {
      span.addEventListener('click', () => {
          removeActiveClass();
          span.classList.add('active-aside__span');
          mainSections.forEach(section => section.style.display = 'none');
          mainSections[index].style.display = 'block';
      });
  });

  viewOrderLinks.forEach(link => {
      link.addEventListener('click', (event) => {
          event.preventDefault();
          removeActiveClass();
          mainSections.forEach(section => section.style.display = 'none');
          const orderDetailsIndex = mainSections.length - 1; // Assuming order details is the last section
          mainSections[orderDetailsIndex].style.display = 'block';
      });
  });

  // Set default open section (Personal Information)
  const defaultSectionIndex = 0;
  asideSpans[defaultSectionIndex].classList.add('active-aside__span');
  mainSections.forEach((section, index) => {
      section.style.display = index === defaultSectionIndex ? 'block' : 'none';
  });
});





const openMenu = document.querySelector('.fa-bars');
const closeMenu = document.querySelector('.fa-times');
const menu = document.querySelector('ul');

openMenu.addEventListener('click', () => {
  menu.style.display = 'flex';
  openMenu.style.display = 'none';
  closeMenu.style.display = 'flex';
  
});

closeMenu.addEventListener('click', () => {
  menu.style.display = 'none';
  openMenu.style.display = 'flex';
  closeMenu.style.display = 'none';
  
});

//Shop aside javascript

const asideToggler = document.querySelector('.aside__toggler');
const aside = document.querySelector('.shop__aside');

asideToggler.addEventListener('click', () => {
  aside.classList.toggle('shop__aside-active');
});
;
/* 

const passcode_toggler = document.querySelectorAll('#passcode-toggler');
const passcode= document.querySelectorAll('.passcode');

passcode_toggler.addEventListener('click', () => {
  passcode.classList.toggle('passcode_active');
}); */
    </script>

    <script src="app.js"></script>
</body>

</html>

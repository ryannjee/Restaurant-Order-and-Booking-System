<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");  
error_reporting(0);  
session_start(); 

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <link rel="icon" href="../images/icon.png">
    <title>Home</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<style>
        html {
            scroll-behavior: smooth;
        }

    /* Background Image */
    .background-image {
        background-image: url('../images/log.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100vh;
        opacity: 0.7;
        transition: background-position 0.5s ease; 
    }

    /* Add a class for the parallax effect when scrolling */
    .background-image.parallax {
        background-position: center 50%; 
    }

    /* Centered buttons */
    .centered-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Use 100vh for full viewport height */
        flex-direction: column; /* Display buttons vertically */
    }

    /* Style for buttons */
    .custom-button {
        width: 135px;
        height: 55px;
        margin: 10px;
        padding: 10px 20px;
        background: hsl(190deg, 30%, 15%);
        color: hsl(190deg, 10%, 95%);
        border: none;
        border-radius: 45%;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s; /* Add color transition */
        box-shadow: 0 0px 0px hsla(190deg, 15%, 5%, .2);
        transform: translateY(0);
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        --dur: .15s;
        --delay: .15s;
        --radius: 16px;
        transition: border-top-left-radius var(--dur) var(--delay) ease-out, border-top-right-radius var(--dur) calc(var(--delay) * 2) ease-out, border-bottom-right-radius var(--dur) calc(var(--delay) * 3) ease-out, border-bottom-left-radius var(--dur) calc(var(--delay) * 4) ease-out, box-shadow calc(var(--dur) * 4) ease-out, transform calc(var(--dur) * 4) ease-out, background calc(var(--dur) * 4) steps(4, jump-end);
    }

    .custom-button:hover {
        box-shadow: 0 4px 8px hsla(190deg, 15%, 5%, .2);
        transform: translateY(-4px);
        background: hsl(230deg, 50%, 45%);
        color: hsl(190deg, 10%, 95%); /* Set the color back to the original value */
        border-top-left-radius: var(--radius);
        border-top-right-radius: var(--radius);
        border-bottom-left-radius: var(--radius);
        border-bottom-right-radius: var(--radius);
    }

    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }
    .navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {
        color: white;
    }
    .navbar-dark .navbar-nav .dropdown-menu .dropdown-item:hover, .navbar-dark .navbar-nav .dropdown-menu .dropdown-item:focus {
        color: white;
        background-color: rgb(48, 25, 52); 
    }

</style>

</head>

<body class="home">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="home.php"> <img class="img-rounded" src="../images/icon.png" alt="" width="30px"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="../user/home.php">Home <span class="sr-only"></span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="../user/branchesdinein.php">Menu (Dine-In) <span class="sr-only"></span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="../user/branches.php">Menu (Take-Out) <span class="sr-only"></span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="../user/branchesreservation.php">Reservation <span class="sr-only"></span></a> </li>

                        <?php
                        if (empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="../user/login.php" class="nav-link active">Login</a></li>';
                            echo '<li class="nav-item"><a href="../user/registration.php" class="nav-link active">Register</a></li>';
                        } else {
                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Orders</a>';
                            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                            echo '<a class="dropdown-item" href="../user/ordersdinein.php">Orders (Dine-In)</a>';
                            echo '<a class="dropdown-item" href="../user/orders.php">Orders (Take-Out)</a>';
                            echo '<a class="dropdown-item" href="../user/viewreservation.php">Your Reservation</a>';       
                            echo '</div>';
                            echo '</li>';
                            echo '<li class="nav-item"><a href="../user/userprofile.php" class="nav-link active">User Profile</a></li>';
                            echo '<li class="nav-item"><a href="../user/logout.php" class="nav-link active">Logout</a></li>';
                        }
                        ?>
                    </ul>						 
                    </div>
                </div>
            </nav>
        </header>

        <!-- Background Image Section -->
        <div class="background-image">           
            <div class="container centered-buttons">
                <!-- Title -->
                <div class="title">
                    <h1 style="color: black; font-family: 'Give You Glory', cursive; font-size: 120px; font-weight: 800;">MALAPOT KITCHEN</h1>
                </div>
     
                <!-- Buttons -->   
                <div class="buttons">             
                    <a class="custom-button" href="../user/branchesdinein.php">Menu (Dine-In)</a>
                    <a class="custom-button" href="../user/branches.php">Menu (Take-Out)</a>
                    <a class="custom-button" href="../user/branchesreservation.php">Reservation</a>
                </div>
            </div>
        </div>

        <footer class="footer" style="padding-bottom: 20px;">
            <div class="container">
                <div class="bottom-footer">
                    <div class="row"  style="text-align: justify;">
                        <div class="col-xs-12 col-sm-3 color-gray">
                            <h5 style="font-weight: bold; font-size: 30px;">Email</h5>
                            <p>Kepong: malapotkepong@gmail.com</p>
                            <p>Sunway: malapotsunway@gmail.com</p>
                            <p>Cheras: malapotcheras@gmail.com</p>
                            <p>Genting: malapotgenting@gmail.com</p>
                            <p>Johor: malapotjohor@gmail.com</p>
                        </div>
                        <div class="col-xs-12 col-sm-4 color-gray">
                            <h5 style="font-weight: bold; font-size: 30px;">Address</h5>
                            <p>Kepong: Jalan Metro Perdana, 52100 Kepong</p>
                            <p>Sunway: Jalan PJS 11/28b, 47500 Petaling Jaya</p>
                            <p>Cheras: Jalan Cengkeh, 56100 Kuala Lumpur</p>
                            <p>Genting: Genting Highlands, 69000 Pahang</p>
                            <p>Johor: Jalan Dato Abdullah Tahir, 80300 Johor Bahru</p>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5 style="font-weight: bold; font-size: 30px;">About Us</h5>
                            <p>At Malapot Kitchen, we believe in more than just serving meals; we're dedicated to creating memorable experiences and conveniency around the communal dining table. Established in 2023 by fellow culinary enthusiasts Ng Zheqian & Ryan Jee Meng Zhe, our restaurant was born out of a shared passion for bringing people together through the art of hotpot. Embark on a culinary journey with us as we blend traditional hotpot techniques with innovative flavors.</p>
                        </div>
                    </div>
                </div>
          
            </div>
        </footer>
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/tether.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/animsition.min.js"></script>
    <script src="../js/bootstrap-slider.min.js"></script>
    <script src="../js/jquery.isotope.min.js"></script>
    <script src="../js/headroom.js"></script>
    <script src="../js/foodpicky.min.js"></script>
    <script>
    $(document).ready(function() {
        // Function to add or remove the 'parallax' class based on scroll position
        function toggleParallax() {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > 0) {
                $('.background-image').addClass('parallax');
            } else {
                $('.background-image').removeClass('parallax');
            }
        }

        // Initial call to set the initial state
        toggleParallax();

        // Call the function on scroll
        $(window).scroll(function() {
            toggleParallax();
        });
    });
</script>

</body>
</html>
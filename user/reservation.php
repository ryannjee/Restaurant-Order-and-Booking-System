<!DOCTYPE html> 
<html lang="en">
<?php
include("../connection/connect.php");
require "../user/res_lib.php";
error_reporting(E_ALL);
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

// Assuming you have a database connection
$conn = mysqli_connect("localhost", "root", "", "onlinefoodsystem");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch restaurant data including operating hours
$ssql = "SELECT * FROM restaurant";
$res = mysqli_query($conn, $ssql);

// Retrieve the selected restaurant's ID from the URL
$selectedResId = (isset($_GET['res_id']) && is_numeric($_GET['res_id'])) ? $_GET['res_id'] : 0;

// Fetch the selected restaurant's details
$selectedResQuery = "SELECT * FROM restaurant WHERE rs_id = $selectedResId";
$selectedResResult = mysqli_query($conn, $selectedResQuery);

$selectedResName = "N/A";  // Initialize with a default value

if ($selectedResResult && mysqli_num_rows($selectedResResult) > 0) {
    $selectedRes = mysqli_fetch_assoc($selectedResResult);
    $selectedResName = $selectedRes['res_name'];
}

// Fetch the current user's details based on the session user_id
if (!empty($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
    $currentUserQuery = "SELECT f_name, l_name, phone FROM users WHERE u_id = $userId";
    $currentUserResult = mysqli_query($conn, $currentUserQuery);

    if ($currentUserResult && mysqli_num_rows($currentUserResult) > 0) {
        $currentUserDetails = mysqli_fetch_assoc($currentUserResult);
        $currentFullName = $currentUserDetails['l_name'] . ' ' . $currentUserDetails['f_name'];
        $currentPhoneNumber = $currentUserDetails['phone'];
    } else {
        $currentFullName = "N/A";
        $currentPhoneNumber = "N/A";
    }
} else {
    $currentFullName = "N/A";
    $currentPhoneNumber = "N/A";
}
    // PROCESS FORM WHEN SUBMITTED
    $receiver = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
    if (isset($_POST['submit1'])) {
        $userId = $_SESSION["user_id"];
        $actualResId = $_POST['actual_rs_id'];
    
        // Save the reservation and retrieve the reservation ID
        $reservationID = $_RSV->save($userId, $_POST['date'], $_POST['time'], $actualResId, $_POST['name'], $_POST['number'], $_POST['people'], 'Reservation Made');

        if ($reservationID) {
            // Fetch the user's email from the database
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT * FROM users WHERE u_id = '$user_id'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);

            // Retrieve the reservation details from the database
            $sqlReservationDetails = "SELECT * FROM restaurant ";
            $queryReservationDetails = mysqli_query($db, $sqlReservationDetails);
            $reservationDetails = mysqli_fetch_assoc($queryReservationDetails);

            // Reservation details for the email
            $address = $reservationDetails['address'];

            // Reservation details for the email
            $reservationDetails = "
                Reservation Number: {$reservationID}
                Date: {$_POST['date']}
                Time: {$_POST['time']}              
                Restaurant Name: {$_POST['rs_id']}
                Restaurant Address: {$address}
                Your Name: {$_POST['name']}
                Your Phone Number: {$_POST['number']}
                Number of People: {$_POST['people']}
                ";

            // Send email to the user
            $to = $row['email'];
            $subject = "Reservation Confirmation";
            $message = "Dear " . $row['l_name'] . ' ' . $row['f_name'] .",\r\n\r\nThank you for making a reservation with us.\r\n\r\n{$reservationDetails}\r\n\r\nPlease provide the reservation number upon arrival.\r\nIf you have any questions or need further assistance, please feel free to contact us at your convenience.\r\n\r\n\r\n\r\nBest regards,\r\nMalapot Kitchen\r\n\r\nThis is an auto-generated email. Please do not reply to this email.";
            $headers = "From: hotpot202204@gmail.com\r\n";

            // Check if the email is sent successfully
            if (mail($to, $subject, $message, $headers)) {
                $success = "Thank you. Your order has been placed and a confirmation email has been sent.";
                
            } else {
                $error = "Failed to send confirmation email.";
            }

            echo "<script>
                alert('Your Reservation has been made.');
                window.location.href = '../user/viewreservation.php';
            </script>";
        } else {
            // Error saving reservation
            echo "<script>
                alert('Error making the reservation. Please try again.');
            </script>";
        }
    }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <link rel="icon" href="../images/icon.png">
    <title>Reservation</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

    *{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    }

    body{
        font-family: 'Poppins', sans-serif;
    }

    .banner{
        min-height: 100vh;
        background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url("../images/resbg.jpg")center/cover no-repeat;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #fff;
        padding-bottom: 20px;
    }

    .card-container{
        display: grid;
        grid-template-columns: 500px 500px;
    }

    .card-img{
        background:url("../images/rescard.jpg")center/cover no-repeat;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .banner h2{
        padding-bottom: 40px;
        margin-bottom: 20px;
        color: #fff;
        font-family: "Give You Glory", cursive;
    }

    .card-content{
        background: #fff;
        height: 400px;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .card-content h3{
        text-align: center;
        color: #000;
        padding: 45px 0 10px 0;
        font-size: 26px;
        font-weight: 500;
    }

    .form-row{
        display: flex;
        width: 100%;
        margin: 0 auto;
    }

    form select, form input{
        display: block;
        width: 100%;
        margin: 15px 12px;
        padding: 5px;
        font-size: 15px;
        font-family: 'Poppins' sans-serif;
        outline: none;
        border: none;
        border-bottom: 1px solid #eee;
        font-weight: 300;
    }

    form input[type=text], form input[type=number], form input::placeholder select{
        color: #9a9a9a;
    }

    form input[tyoe=submit]{
        color: #fff;
        background: #f2745f;
        padding: 12px 0;
        border-radius: 4px;
        cursor: pointer;
    }

    form input[type=submit]:hover{
        opacity: 0.9;
    }
    @media(max-width: 992px){
        .card-container{
            grid-template-columns: 100%;
        }
        .card-img{
            height: 330px;
        }
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

    .oval-button {
            border-radius: 45%;
            width: 335px;
            height: 55px;
            background: hsl(190deg, 30%, 15%);
            color: hsl(190deg, 10%, 95%);
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

        .oval-button:hover,
        .oval-button:focus {
            color: hsl(190deg, 10%, 95%);
            box-shadow: 0 4px 8px hsla(190deg, 15%, 5%, .2);
            transform: translateY(-4px);
            background: hsl(230deg, 50%, 45%);
            border-top-left-radius: var(--radius);
            border-top-right-radius: var(--radius);
            border-bottom-left-radius: var(--radius);
            border-bottom-right-radius: var(--radius);
        }
    </style>
</head>

<body>
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
    
    <section class="banner">
        <h2 style="font-weight: 900; padding-bottom: 10px;">BOOK YOUR TABLE NOW</h2>
        <div class="card-container">
            <div class="card-img">
            </div>

            <div class="card-content">
                <h3 style="letter-spacing: 0.05em; font-weight: 600;">RESERVATION</h3>        
                <form method="post" id="reservationForm" action="reservation.php" onsubmit="return validateForm()">
                    <div class="form-row">
                        <input type="date" name="date" id="reservationDate" placeholder="Date" min="<?php echo date('Y-m-d', strtotime('+2 day')); ?>" required>
                        <select name="time" placeholder="Time" required>
                            <option>Select Time</option>
                            <?php
                            // Fetch the selected restaurant's operating hours
                            $selectedResQuery = "SELECT * FROM restaurant WHERE rs_id = $selectedResId";
                            $selectedResResult = mysqli_query($conn, $selectedResQuery);

                            if ($selectedResResult && mysqli_num_rows($selectedResResult) > 0) {
                                $selectedResDetails = mysqli_fetch_assoc($selectedResResult);
                                $openingTime = strtotime($selectedResDetails['o_hr']);
                                $closingTime = strtotime($selectedResDetails['c_hr']);
                                $currentTime = $openingTime;

                                // Calculate 1 hour before closing time
                                $oneHourBeforeClosing = $closingTime - 3599;

                                // Generate time slots based on operating hours
                                while ($currentTime < $closingTime) {
                                    // Exclude time slots within the last hour before closing time
                                    if ($currentTime < $oneHourBeforeClosing) {
                                        $formattedTime = date('H:i', $currentTime);
                                        echo '<option value="' . $formattedTime . '">' . $formattedTime . '</option>';
                                    }

                                    $currentTime = strtotime('+30 minutes', $currentTime);
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <input type="text" name="name" placeholder="Full Name" value="<?php echo $currentFullName; ?>" required>
                        <input type="text" name="number" placeholder="Phone Number" value="<?php echo $currentPhoneNumber; ?>" required>
                    </div>

                    <?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
                    $rows=mysqli_fetch_array($ress);										  
                    ?>

                    <div class="form-row">
                        <input type="number" name="people" max="20" min="1" placeholder="Number Of People" required>
                       <!-- Hidden input field to store the actual rs_id value -->
                        <input type="hidden" name="actual_rs_id" value="<?php echo $selectedResId; ?>">

                        <!-- Display the restaurant name to the user -->
                        <input type="text" name="rs_id" class="form-control" id="restaurantInput" value="<?php echo $selectedResName; ?>" readonly>
                    </div>

                    <div class="form-row" style="display: flex; align-items: center; justify-content: center;">
                        <div class="col-md-9 text-center"> 
                            <input type="submit" class="oval-button" name="submit1" value="BOOK TABLE">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
   
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
        
    <script>
    function validateForm() {
        // Add any additional validation logic here
        return true; // Return false to prevent the form submission
    }
    </script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/tether.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/animsition.min.js"></script>
    <script src="../js/bootstrap-slider.min.js"></script>
    <script src="../js/jquery.isotope.min.js"></script>
    <script src="../js/headroom.js"></script>
    <script src="../js/foodpicky.min.js"></script>
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
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
    <script>
    function validateForm() {
        // Add any additional validation logic here

        // Get the selected date
        var selectedDate = new Date(document.getElementById("reservationForm").elements["date"].value);

        // Get the current date
        var currentDate = new Date();

        // Calculate the minimum allowed date (1 day from the current date)
        var minDate = new Date();
        minDate.setDate(currentDate.getDate() + 1);

        // Check if the selected date is valid
        if (selectedDate < minDate) {
            alert("Please select a date at least 1 day in advance.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
    </script>
</body>
</html>

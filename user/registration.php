<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
include("../connection/connect.php");

$firstname = $lastname = $username = $email = $password = $cpassword = $phone = $gender = $birthday = $address = "";
$firstnameError = $lastnameError = $usernameError = $emailError = $passwordError = $cpasswordError = $phoneError = "";

$message = ''; // Initialize the message variable

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['phone'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

    // Validation checks
    if (empty($firstname) ||
        empty($lastname) ||
        empty($username) ||
        empty($email) ||
        empty($phone) ||
        empty($gender) ||
        empty($birthday) ||
        empty($address)
    ) {
        $message = "All fields are required to fill up!";
    } elseif (preg_match('/[^a-zA-Z]/', $firstname) || preg_match('/[^a-zA-Z]/', $lastname)) {
        $message = "First name and last name cannot contain symbols.";
    } elseif (strlen($password) < 8) {
        $message = "Password must contain 8 characters and above.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/", $password)) {
        $message = "Password must contain at least one lowercase letter, one uppercase letter, one number, and one symbol (excluding spaces).";
    } elseif ($password != $cpassword) {
        $message = "Password does not match.";
    } elseif (!preg_match("/^\+601[1-9]-[0-9]{7,8}$/", $phone)) {
        $message = "Invalid phone number format. Please use the format: +601X-XXXXXXXX";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address format. Please enter a valid email address.";
    } else {
    // Check if the username already exists
    $username = mysqli_real_escape_string($db, $username); // Use $username directly
    $check_username_query = "SELECT COUNT(*) as count FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $check_username_query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    $email = mysqli_real_escape_string($db, $email); // Use $email directly
    $check_email_query = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
    $email_result = mysqli_query($db, $check_email_query);
    $email_row = mysqli_fetch_assoc($email_result);
    $email_count = $email_row['count'];

    if ($count > 0) {
        $message = "Username already exists. Please choose a different one.";
    } elseif ($email_count > 0) {
        $message = "Email already exists. Please use a different one.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Use $password directly
        $sql = "INSERT INTO users (username, f_name, l_name, email, phone, gender, birthday, password, address) VALUES (
            '$username',
            '$firstname',
            '$lastname',
            '$email',
            '$phone',
            '$gender',
            '$birthday',
            '$hashed_password',
            '$address'
        )";
        if (mysqli_query($db, $sql)) {
            $_SESSION['username'] = $username;
            // Success message and redirection 
            echo '<script>alert("Registration successful. You can now log in.");</script>';
            echo '<script>window.location.href = "../user/login.php";</script>';
            exit; // Stop the script to prevent further execution
        } else {
            $message = "Registration failed. Please try again.";
        }
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/icon.png">
    <title>Registration</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        label span {
            font-style: italic;
            font-size: 10.7px;
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

        .oval-button {
            border-radius: 45%;
            width: 135px;
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
    <div style="background-image: url('../images/log.jpg');">
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
    
        <div class="page-wrapper">
            <div class="container">
               <ul>
               </ul>
            </div>

            <section class="contact-page inner-page" style="background-color: transparent;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-body">
                                <?php
                                 if (!empty($message)) {
                                    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                                 }
                                 ?>
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input class="form-control" type="text" name="firstname" id="example-text-input" value="<?php echo (empty($firstnameError) ? $firstname : ''); ?>">
                                                <span class="error"><?php echo $firstnameError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-6">
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input class="form-control" type="text" name="lastname" id="example-text-input-2" value="<?php echo (empty($lastnameError) ? $lastname : ''); ?>">
                                                <span class="error"><?php echo $lastnameError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-6">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input class="form-control" type="text" name="username" id="example-text-input" value="<?php echo (empty($usernameError) ? $username : ''); ?>">
                                                <span class="error"><?php echo $usernameError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-6">
                                             <label for="exampleInputEmail1">Email Address <span>(e.g. example@hotmail.com)</span></label>
                                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo (empty($emailError) ? $email : ''); ?>">
                                                <span class="error"><?php echo $emailError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-6">
                                                <label for="exampleInputPassword1">Password <span>(must contain at least one lowercase letter, one uppercase letter, one number, and one symbol excluding spaces)</span></label>
                                                <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="<?php echo (empty($passwordError) ? $password : ''); ?>">
                                                <span class="error"><?php echo $passwordError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-6">
                                                <label for="exampleInputPassword1">Confirm Password</label>
                                                <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" value="<?php echo (empty($cpasswordError) ? $cpassword : ''); ?>">
                                                <span class="error"><?php echo $cpasswordError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-6">
                                             <label for="exampleInputEmail1">Phone Number <span>(e.g. +6012-3456789)</span></label>
                                                <input class="form-control" type="text" name="phone" id="example-tel-input-3" value="<?php echo (empty($phoneError) ? $phone : ''); ?>">
                                                <span class="error"><?php echo $phoneError; ?></span>
                                             </div>
                                             <div class="form-group col-sm-3">
                                                <label for="exampleInputEmail1">Gender</label><br>
                                                <input type="radio" name="gender" value="male" id="male" <?php if ($gender === 'male') echo 'checked'; ?>>
                                                <label for="male"> Male &nbsp&nbsp&nbsp</label>
                                                <input type="radio" name="gender" value="female" id="female" <?php if ($gender === 'female') echo 'checked'; ?>>
                                                <label for="female"> Female </label>
                                             </div>
                                             <div class="form-group col-sm-3">
                                                <label for="birthday">Birthday</label><br>
                                                <input type="date" name="birthday" id="birthday" value="<?php echo (empty($birthdayError) ? $birthday : ''); ?>" max="<?php echo date('Y-m-d'); ?>">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <label for="exampleTextarea">Home Address</label>
                                                <textarea class="form-control" id="exampleTextarea" name="address" rows="3"><?php echo (empty($addressError) ? $address : ''); ?></textarea>
                                             </div>                                                                                   
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-12 text-center" style="text-align: center;">
                                             <input type="submit" value="Register" name="submit" class="btn btn-purple oval-button">
                                          </div>
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        </div>

        <script src="../js/jquery.min.js"></script>
    <script src="../js/tether.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/animsition.min.js"></script>
    <script src="../js/bootstrap-slider.min.js"></script>
    <script src="../js/jquery.isotope.min.js"></script>
    <script src="../js/headroom.js"></script>
    <script src="../js/foodpicky.min.js"></script>
    <script>
    </div>

</body>
</html>

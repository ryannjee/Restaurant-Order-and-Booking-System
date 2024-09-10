<!DOCTYPE html>
<html lang="en">
<?php
session_start();
error_reporting(E_ALL);
include("../connection/connect.php");
include("../object/sendPic.php");

$firstname = $lastname = $username = $email = $phone = $gender = $birthday = $address = "";
$firstnameError = $lastnameError = $usernameError = $emailError = $phoneError = "";

$message = ''; // Initialize the message variable

if (isset($_POST['submit'])) {
    // Retrieve user ID
    $userid = $_SESSION["user_id"];

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

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
        $message = "First name and last name cannot contain number and symbols.";
    } elseif (!preg_match("/^\+601[1-9]-[0-9]{7,8}$/", $phone)) {
        $message = "Invalid phone number format. Please use the format: +601X-XXXXXXXX";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address format. Please enter a valid email address.";
    } else {
        // Check if the username already exists (but not the current user's username)
        $username = mysqli_real_escape_string($db, $username);
        $check_username_query = "SELECT COUNT(*) as count FROM users WHERE username = '$username' AND u_id != $userid";
        $result = mysqli_query($db, $check_username_query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            $message = "Username already exists. Please choose a different one.";
        } else {
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {                
                $FileUploader = new FileUploader($_FILES);
                $image = $uploadMessage = $FileUploader->uploadProfilePic();
                // Update the user data in the database
                $sql = "UPDATE users SET 
                username = '$username',
                f_name = '$firstname',
                l_name = '$lastname',
                email = '$email',
                phone = '$phone',               
                gender = '$gender',
                birthday = '$birthday',
                image= '$image',
                address = '$address'
                WHERE u_id = '$userid'";
            } 
            else 
            {               
                $sql = "UPDATE users SET 
                username = '$username',
                f_name = '$firstname',
                l_name = '$lastname',
                email = '$email',                
                phone = '$phone',
                gender = '$gender',
                birthday = '$birthday',                
                address = '$address'
                WHERE u_id = '$userid'"; 
            }

            if (mysqli_query($db, $sql)) {
                $_SESSION['username'] = $username;
                // Success message and redirection 
                echo '<script>alert("User profile updated successfully.");</script>';
                echo '<script>window.location.href = "../user/userprofile.php";</script>';
                exit; // Stop the script to prevent further execution
            } else {
                $message = "User profile updated unsuccessfully. Please try again.";
            }
        }
    }
}

// Add a query to retrieve user information
$user = []; // Initialize an empty array to store user information
if (isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];
    $getUserQuery = "SELECT * FROM users WHERE username = '$loggedInUsername'";
    $userResult = mysqli_query($db, $getUserQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $user = mysqli_fetch_assoc($userResult);
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE.edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/icon.png">
    <title>Edit User Profile</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .user-information {
            text-align: center;
            margin-top: 0;
            padding: 40px;
        }

        .user-profile {
            text-align: center;
            margin-top: 0;
            padding: 40px;
        }

        .footer {
            margin-top: 20px;
        }

        label span {
            font-style: italic;
            font-size: 13px;
        }

        .oval-image-container {
            width: 200px;
            height: 200px;
            overflow: hidden;
            border-radius: 50%;
            background-color: transparent;
        }

        .oval-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .oval-button {
            border-radius: 45%;
            width: 145px;
            height: 55px;
            border: 0;
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

    <div class="page-wrapper">
        <section class="hero bg-image" data-image-src="../images/home.jpeg">
            <div class="hero-inner">
                <div class="container text center hero-text font-white">
                    <h1>Edit User Profile</h1>
                    <div class="banner-form">
                        <form class="form-inline">
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                    <div class="col-md-12">
                        <form action="../user/userprofileedit.php" method="post" enctype="multipart/form-data">
                            <div class="widget">
                                <div class="widget-body">
                                <?php
                                 if (!empty($message)) {
                                    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                                 }
                                 ?>
                                <div class="row justify-content-center">
                                    <div class="col-md-4 text-center user-profile" style="margin-top: 200px; position: relative; right: -120px;">
                                        <div class="oval-image-container" >
                                        <?php
                                        if (isset($user['image']) && !empty($user['image'])) {
                                            $userImage = $user['image'];
                                        } else {
                                            $userImage = 'unknownuser.jpg';
                                        }
                                        ?>                                      
                                            <img src="../images/userpp/<?php echo $userImage; ?>" alt="Profile Picture" class="oval-image" width="200" height="200">
                                        </div>
                                        <br><br><input type="file" name="file" accept="image/*" >
                                    </div>

                <div class="col-md-8 user-information">
                        <div class="contact_inner">
                        <?php
                        $userid = $_SESSION["user_id"];
                        $sql = "SELECT * FROM users WHERE u_id = '$userid'";
                        $result = mysqli_query($db, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $userInfo = mysqli_fetch_assoc($result);
                            $gender = $userInfo['gender'];                         
                        } else {
                            // Handle the case where user data is not found
                            header("Location: ../user/login.php");
                            exit;
                        }
                        ?>

                            <label for="example-text-input">First Name</label>
                            <input class="form-control" type="text" name="firstname" id="example-text-input" style="text-align: center;" value="<?php echo $userInfo["f_name"]; ?>"><br>
                            <span class="error"><?php echo $firstnameError; ?></span>

                            <label for="example-text-input-2">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="example-text-input-2" style="text-align: center;" value="<?php echo $userInfo["l_name"]; ?>"><br>
                            <span class="error"><?php echo $lastnameError; ?></span>

                            <label for="exampleInputEmail1">Username</label>
                            <input class="form-control" type="text" name="username" id="example-text-input" style="text-align: center;" value="<?php echo $userInfo["username"]; ?>"><br>
                            <span class="error"><?php echo $usernameError; ?></span>

                            <label for="exampleInputEmail1">Email Address <span>(e.g. example@hotmail.com)</span></label>
                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" style="text-align: center;" value="<?php echo $userInfo["email"]; ?>"><br>
                            <span class="error"><?php echo $emailError; ?></span>
                            
                            <label for="exampleInputEmail1">Phone Number <span>(e.g. +6012-3456789)</span></label>
                            <input class="form-control" type="text" name="phone" id="example-tel-input-3" style="text-align: center;" value="<?php echo $userInfo["phone"]; ?>"><br>
                            <span class="error"><?php echo $phoneError; ?></span>
                                 
                            <label for="exampleInputEmail1">Gender</label><br>
                            <input type="radio" name="gender" value="male" id="male" <?php if ($gender === 'male') echo 'checked'; ?>>
                            <label for="male"> Male &nbsp;&nbsp;&nbsp;</label>
                            <input type="radio" name="gender" value="female" id="female" <?php if ($gender === 'female') echo 'checked'; ?>>
                            <label for="female"> Female </label><br><br>
                                        
                            <label for="birthday">Birthday</label><br>
                            <input type="date" name="birthday" id="birthday" value="<?php echo $userInfo["birthday"]; ?>" max="<?php echo date('Y-m-d'); ?>"><br><br>
                                            
                            <label for="exampleTextarea">Home Address</label>
                            <textarea class="form-control" id="exampleTextarea" name="address" rows="3"><?php echo $userInfo["address"]; ?></textarea><br><br>                                                                                             

                            <div class="col-sm-12 text-center" style="text-align: center;">
                                <div style="display: flex; justify-content: center;">
                                    <input type="button" value="Cancel" onclick="redirectToUserProfile()" class="oval-button" style="margin-right: 40px;">
                                    <input type="submit" value="Save Changes" name="submit" class="oval-button">                  
                                </div>
                            </div>
                            <script>
                                function redirectToUserProfile() {
                                    window.location.href = '../user/userprofile.php';
                                }
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    </body>
</html>
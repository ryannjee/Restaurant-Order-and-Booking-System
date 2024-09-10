<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
include_once '../user/menuaction.php';
error_reporting(0);
session_start();

$res_id = isset($_SESSION["res_id"]) ? $_SESSION["res_id"] : "";
$categoryId = isset($_SESSION["categoryId"]) ? $_SESSION["categoryId"] : "";
$d_id_array = [];
$categoriesArray = [];

// Access the session array
if(isset($_SESSION['categories'])) {
    $categoriesArray = $_SESSION['categories'];
}

$item_total = 0;

if (isset($_SESSION['cart_item'])) {
    foreach ($_SESSION['cart_item'] as $item) {
        // Assuming that the 'd_id' is a key in the $item array
        $d_id = $item['d_id'];

        // Store the current dish's d_id in the array
        $d_id_array[] = $d_id;
    }
}

// Store the updated array in the session
$_SESSION['d_id'] = $d_id_array;

// Convert the array to a string for display purposes
$d_id_string = implode(", ", $d_id_array); // Change the separator according to your preference

function function_alert()
{
    echo "<script>alert('Thank you for ordering. Your Order has been placed!');</script>";
    echo "<script>window.location.replace('../user/orders.php');</script>";
}

if (empty($_SESSION["user_id"])) {
    header('location:../user/login.php');
} else {
    if (isset($_POST['submit'])) {
        // Generate a unique order number for the current session
        $o_num = generateUniqueNumber();
        
        // Fetch the user's email from the database
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT * FROM users WHERE u_id = '$user_id'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $to = $row['email'];

        // Send email to the user
        $subject = "Order Confirmation (Take Out)";
        $message = "Dear " . $row['l_name'] . ' ' . $row['f_name'] .",\r\n\r\nThank You For Placing Your Order With Us!\r\nYour Order Number Is " . $o_num . "\r\n\r\nPlease Provide The Order Number in Your Orders Or Via Email Upon Completing The Payment At The Counter When You Arrive.\r\nIf You Have Any Questions Or Need Further Assistance, Feel Free To Contact Us At Your Convenience.\r\n\r\n\r\n\r\nBest Regards,\r\nMALAPOT KITCHEN\r\n\r\nThis is an auto-generated email. Please do not reply to this email.";
        $headers = "From: hotpot202204@gmail.com\r\n";

        // Check if the email is sent successfully
        if (mail($to, $subject, $message, $headers)) {
            $success = "Thank you. Your order has been placed and a confirmation email has been sent.";
            function_alert();
        } else {
            $error = "Failed to send confirmation email.";
        }
        $number=0;
        foreach ($_SESSION["cart_item"] as $item) {
            $item_total += ($item["price"] * $item["quantity"]);

            $SQL = "INSERT INTO users_orders(u_id, d_id, c_id, rs_id, title, quantity, price, o_num) 
            VALUES('" . $_SESSION["user_id"] . "', '" . $d_id_string . "', '" . $categoryId[$number] . "', '" . $res_id . "', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "', '" . $o_num . "')";
            $number+=1;
            mysqli_query($db, $SQL);

            unset($_SESSION["categoryId"]);
            unset($_SESSION["d_id"]);
            unset($_SESSION["cart_item"]);
            unset($_SESSION["categories"]);
            unset($item["title"]);
            unset($item["quantity"]);
            unset($item["price"]);
            $success = "Thank you. Your order has been placed!";
            function_alert();
        }
    }
}

    function generateUniqueNumber()
    {
        // Generate a unique alphanumeric order number for the current session
        $characters = '0123456789';
        $randomString = 'TO-';
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }    
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="#">
    <title>Order and Payment (Take Out)</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
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

        .top-links a {
            font-size: 16px;
        }
    </style> 
</head>
<body>
    
    <div class="site-wrapper">
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
            <div class="top-links">
                <div class="container">
                    <ul class="row links">                     
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="../user/branches.php">Select a branch</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span>Pick your favorite ingredients</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="../user/payment.php">Order and Payment</a></li>
                    </ul>
                </div>
            </div>
            <section class="hero bg-image" data-image-src="../images/payment.jpeg">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Order and Payment (Take-Out)</h1>                   
                    <div class="banner-form">
                        <form class="form-inline">                         
                        </form>
                    </div>
                </div>
            </div>      
            </section>	

            <div class="container">                
				<span style="color:green;">
					<?php echo $success; ?>
				</span>					
            </div>

            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">                   
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">                               
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>My Cart Summary</h4> </div>
                                            <div class="cart-totals-fields">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                    <?php
                                                    foreach ($_SESSION["cart_item"] as $item) {
                                                        // Start a new row for each product
                                                        echo '<tr>';
                                                        echo '<td>' . $item["title"] . '</td>';
                                                        echo '<td>' . $item["quantity"] . '</td>';
                                                        echo '<td>' . "RM " . $item["price"] . '</td>';
                                                        echo '</tr>';

                                                        $totalQuantity += $item["quantity"];
                                                        $item_total += ($item["price"] * $item["quantity"]);
                                                    }
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Grand Total</strong></td>
                                                        <td class="text-color"><strong><?php echo $totalQuantity; ?></strong></td>
                                                        <td class="text-color"><strong> <?php echo "RM " . number_format($item_total, 2); ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="payment-option">
                                        <h6>** Please note that we accept cash and card payment at all our branches **</h6>
                                        <br>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit"  class="btn btn-success btn-block" value="Order Now"> </p>
                                    </div>
								</form>
                            </div>
                        </div>  
                    </div>
                </div>
			</form>
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
        </div>
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
</body>

</html>



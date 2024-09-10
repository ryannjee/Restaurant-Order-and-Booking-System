<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php"); 
error_reporting(0);
session_start();
$_SESSION['res_id'] = $_GET['res_id'];

if (!isset($_SESSION['d_id'])) {
    $_SESSION['d_id'] = array();
}

if (isset($_POST['submit'])) {
    $d_id = isset($_POST['d_id']) ? $_POST['d_id'] : "";
    $_SESSION['categoryId'][] = $_POST['categoryId'];
    $_SESSION['d_id'][] = $d_id;
}

include_once '../user/menuaction.php'; 
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/icon.png">
    <title>Menu</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet"> 

    <style>
        html {
            scroll-behavior: smooth;
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
                    <li class="col-xs-12 col-sm-4 link-item active"><span>2</span>Pick your favorite ingredients</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span>Order and Payment</a></li>
                </ul>
            </div>
        </div>
        <?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
        $rows=mysqli_fetch_array($ress);										  
        ?>
        <section class="inner-page-hero bg-image" data-image-src="../images/menubg.jpg">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure><?php echo '<img src="../admin/restaurant_images/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                            </div>
                        </div>							
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#" style="font-size: 40px; font-weight: bold;"><?php echo $rows['res_name']; ?></a></h6>
                                <p><?php echo $rows['address']; ?></p>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="breadcrumb">
            <div class="container">                   
            </div>
        </div>

        <div class="container m-t-30">
            <div class="row">
                <div class="col-md-8">
                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark" style="font-family: Calibri; font-weight: bold;"> MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                <i class="fa fa-angle-right pull-right"></i>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>

                        <div class="collapse in" id="popular2">
                            <?php  
                            $categories = mysqli_query($db, "SELECT * FROM dishes_category ");
                            // Initialize an empty array to store category information in the session
                            $_SESSION['c_id']=array();  
                            while ($category = mysqli_fetch_assoc($categories)) {
                                $categoryId = $category['c_id'];
                                $categoryName = $category['c_name'];
                                $dishes = mysqli_query($db, "SELECT * FROM dishes WHERE rs_id='".$_GET['res_id']."' AND c_id='$categoryId'");

                                // Display the category only if it has dishes
                                if (mysqli_num_rows($dishes) > 0) {     
                                    $_SESSION['res_id'] = $_GET['res_id'];
                                    echo "<div class='row' style='margin-bottom: 10px; margin-left: 5px'><div class='col-md-12 text-right'><p style='font-family: Arial; font-weight: bold; font-size:14px'>$categoryName</p></div></div>";
                                    foreach ($dishes as $dish) {
                                        ?>
                                        <div class="food-item">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-lg-8">
                                                    <form method="post" action='../user/menu.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $dish['d_id']; ?>'>
                                                        <div class="rest-logo pull-left">
                                                            <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="../admin/restaurant_images/dishes/'.$dish['img'].'" alt="Food logo">'; ?></a>
                                                        </div>

                                                        <div class="rest-descr">
                                                            <h6><a href="#"><?php echo $dish['title']; ?></a></h6>
                                                            <p> <?php echo $dish['slogan']; ?></p>
                                                        </div>                           
                                                </div>            
                                                <input type="hidden" name="categoryId" value="<?php echo $categoryId;?>">                                  
                                                <input type="hidden" name="d_id" value="<?php echo $dish['d_id']; ?>">
                                                <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info"> 
                                                    <span class="price pull-left">RM <?php echo $dish['price']; ?></span>
                                                    <input type="text" name="quantity" style="margin-left:30px; margin-bottom: 10px;" value="1" size="2" />
                                                    <input type="submit" name="submit" class="oval-button" value="Add To Cart" />
                                                </div>
                                                </form>
                                            </div>             
                                        </div>   
                                        <?php
                                    }
                                }
                            }
                            ?>														                             
                        </div>
                    </div>                                  
                </div> 

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3"> 
                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark"> My Cart </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">
                                <?php
                                $item_total = 0;

                                foreach ($_SESSION["cart_item"] as $item)  
                                {
                                ?>									

                                <div class="title-row">
                                    <?php echo $item["title"]; ?><a href="../user/menu.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0" value=<?php echo "RM".$item["price"]; ?> readonly id="exampleSelect1">                                                   
                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> 
                                    </div>
                                </div>								  
                                <?php
                                $item_total += ($item["price"]*$item["quantity"]); 
                                }
                                ?>								   
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL AMOUNT</p>
                                <h3 class="value"><strong><?php echo "RM " . number_format($item_total, 2); ?></strong></h3>                           
                                <?php
                                if($item_total==0){
                                ?>
                                <a href="../user/payment.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-danger btn-lg disabled">Checkout</a>
                                <?php
                                }
                                else{   
                                ?>
                                <a href="../user/payment.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-success btn-lg active">Checkout</a>
                                <?php   
                                }
                                ?>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>   
        </div>  
        <div style="height: 50px;"></div>  
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
</body>
</html>

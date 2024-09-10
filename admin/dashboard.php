<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

// Calculate the total earnings across all orders
$sqlTotalEarnings = "SELECT
    (SELECT SUM(price*quantity) FROM users_orders WHERE status = 'Order Collected') +
    (SELECT SUM(price*quantity) FROM users_ordersin WHERE status IN ('Order Received', 'Preparing Your Order', 'Order Served')) AS total_earnings";

$resultTotalEarnings = mysqli_query($db, $sqlTotalEarnings);

// Fetch the total earnings
$rowTotalEarnings = mysqli_fetch_assoc($resultTotalEarnings);
$totalEarnings = $rowTotalEarnings['total_earnings'];

// Fetch the total combined price
$sql = "SELECT
    (SELECT SUM(price*quantity) FROM users_orders WHERE status = 'Order Collected') +
    (SELECT SUM(price*quantity) FROM users_ordersin WHERE status IN ('Preparing Your Order', 'Order Received','Order Served')) AS total_combined_price";
$result = mysqli_query($db, $sql);

// Fetch the date and total earnings for each day
$sqlEarnings = "SELECT order_date, SUM(total_combined_price) as total_combined_price
FROM (
    SELECT DATE(date) AS order_date, SUM(price*quantity) AS total_combined_price
    FROM users_orders
    WHERE status = 'Order Collected'
    GROUP BY order_date

    UNION ALL

    SELECT DATE(date) AS order_date, SUM(price*quantity) AS total_combined_price
    FROM users_ordersin
    WHERE status IN ('Order Received', 'Preparing Your Order', 'Order Served')  
    GROUP BY order_date
) AS combined_data
GROUP BY order_date";

$resultEarnings = mysqli_query($db, $sqlEarnings);

// Initialize arrays to store dates and total earnings
$dates = [];
$earnings = [];

// Store the data into the arrays
while ($row = mysqli_fetch_assoc($resultEarnings)) {
    $dates[] = $row['order_date'];
    $earnings[] = $row['total_combined_price'];
}

// Sort the dates array in ascending order
array_multisort($dates, SORT_ASC);

// Encode arrays into JSON format
$encodedDates = json_encode($dates);
$encodedEarnings = json_encode($earnings);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Statistics</title>
    <link rel="icon" href="../images/icon.png">
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    
    <div id="main-wrapper">     
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">                        
                        <span><img src="../images/icon.png" style="height:40px; width:40px" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav ml-auto mt-md-0">
                        <li class="nav-item"><a class="nav-link text-muted" href="all_users.php"><i class="fa fa-users"></i> Users</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownRestaurant" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cutlery"></i> Restaurant
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownRestaurant">
                                <a class="dropdown-item" href="all_restaurant.php">All Restaurant</a>                            
                                <a class="dropdown-item" href="add_restaurant.php">Add Restaurant</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-book"></i> Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                                <a class="dropdown-item" href="all_menu.php">All Menu</a>                            
                                <a class="dropdown-item" href="add_menu.php">Add Menu</a> 
                                <a class="dropdown-item" href="add_category.php">Add Category</a>                          
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-book"></i> Orders
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                                <a class="dropdown-item" href="dinein_orders.php">Dine-In Orders</a> 
                                <a class="dropdown-item" href="pickup_orders.php">Take-Out Orders</a>                                                          
                                <a class="dropdown-item" href="all_reservation.php">All Reservation</a>                                                       
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link text-muted" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar">  
            <div class="scroll-sidebar">      
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Statistics</span></a>
                        </li>
                        <li class="nav-label">Activities</li>
                        <li> <a href="all_users.php">  <span><i class="fa fa-users"></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery"></i><span class="hide-menu">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_restaurant.php">All Restaurant</a></li>                           
                                <li><a href="add_restaurant.php">Add Restaurant</a></li>                                
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menus</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>   
                                <li><a href="add_category.php">Add Category</a></li>                                                          
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book" aria-hidden="true"></i><span class="hide-menu">Orders</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="dinein_orders.php">Dine-In Orders</a></li>
                                <li><a href="pickup_orders.php">Take-Out Orders</a></li>
                                <li><a href="all_reservation.php">All Reservation</a></li>                                                                            
                            </ul>
                        </li>                         
                        <li> <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></li>                         
                    </ul>
                </nav>           
            </div>       
        </div>
    
        <!-- Statistics -->
        <div class="page-wrapper">                     
            <div class="container-fluid">
                <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Company Statistics</h4>
                            </div>
                            <br>
                            <!-- graph -->
                                <div class="row column2 graph margin_bottom_30">
                                    <div class="col-md-l2 col-lg-12">
                                        <div class="white_shd full">
                                            <div class="full graph_head">
                                                <div class="heading1 margin_0">
                                                    <h2>Earnings Chart</h2>
                                                </div>
                                            </div>
                                            <div class="full graph_revenue">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="content">
                                                            <div class="area_chart">
                                                                <canvas height="120" id="canvas"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- end graph -->

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <?php
                                                $today = date('Y-m-d');
                                                $sqlToday = "SELECT 
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_orders WHERE status = 'Order Collected' AND DATE(date) = '$today'), 0) +
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_ordersin WHERE status IN ('Order Received', 'Preparing Your Order', 'Order Served') AND DATE(date) = '$today'), 0) AS value_sum";

                                                $resultToday = mysqli_query($db, $sqlToday);
                                                $rowToday = mysqli_fetch_assoc($resultToday);
                                                $todayEarnings = $rowToday['value_sum'];
                                                ?>
                                                <h2><?php echo $todayEarnings; ?></h2>
                                                <p class="m-b-0">Today's Earnings</p>                  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <?php
                                                $startDate = date('Y-m-d', strtotime('monday this week'));
                                                $endDate = date('Y-m-d', strtotime('sunday this week'));
                                                
                                                $sqlWeek = "SELECT 
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_orders WHERE status = 'Order Collected' AND DATE(date) BETWEEN '$startDate' AND '$endDate'), 0) +
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_ordersin WHERE status IN ('Order Received', 'Preparing Your Order', 'Order Served') AND DATE(date) BETWEEN '$startDate' AND '$endDate'), 0) AS value_sum";                                             
                                                $resultWeek = mysqli_query($db, $sqlWeek);
                                                $rowWeek = mysqli_fetch_assoc($resultWeek);
                                                $weekEarnings = $rowWeek['value_sum'];                                                
                                                ?>
                                                <h2><?php echo $weekEarnings; ?></h2>
                                                <p class="m-b-0">This Week Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <?php
                                                $firstDayOfMonth = date('Y-m-01');
                                                $lastDayOfMonth = date('Y-m-t');
                                                
                                                $sqlMonth = "SELECT 
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_orders WHERE status = 'Order Collected' AND DATE(date) BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'), 0) +
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_ordersin WHERE status IN ('Order Received', 'Preparing Your Order', 'Order Served') AND DATE(date) BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'), 0) AS value_sum";
                                                
                                                $resultMonth = mysqli_query($db, $sqlMonth);
                                                $rowMonth = mysqli_fetch_assoc($resultMonth);
                                                $monthEarnings = $rowMonth['value_sum'];                                                
                                                ?>
                                                <h2><?php echo $monthEarnings; ?></h2>
                                                <p class="m-b-0">This Month Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <?php
                                                $currentYear = date('Y');
                                                $sqlYear = "SELECT 
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_orders WHERE status = 'Order Collected' AND YEAR(date) = '$currentYear'), 0) +
                                                    COALESCE((SELECT SUM(price*quantity) FROM users_ordersin WHERE status IN ('Order Received', 'Preparing Your Order', 'Order Served') AND YEAR(date) = '$currentYear'), 0) AS value_sum";
                                                
                                                $resultYear = mysqli_query($db, $sqlYear);
                                                $rowYear = mysqli_fetch_assoc($resultYear);
                                                $yearEarnings = $rowYear['value_sum'];                                                
                                                ?>
                                                <h2><?php echo $yearEarnings; ?></h2>
                                                <p class="m-b-0">This Year Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="card p-30 d-flex align-items-center justify-content-center">
                                    <div class="media">
                                        <span class="mr-4"><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                        <div class="media-body">
                                            <h2><?php echo $totalEarnings; ?></h2>
                                            <p class="m-b-0">Total Earnings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="card card-outline-primary">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Users,Branches & Dishes Information</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-users f-s-40"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);											
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Total Registered Users</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-home f-s-40 "></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from restaurant";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Total Branches</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from dishes_category";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Total Dishes Categories</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2>
                                                <?php
                                                $sql = "SELECT COUNT(DISTINCT title) AS total_dishes FROM dishes";
                                                $result = mysqli_query($db, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $total_dishes = $row['total_dishes'];
                                                echo "<h2>$total_dishes</h2>";
                                                ?>
                                                </h2>
                                                <p class="m-b-0">Total Dishes</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                
                            </div>
                        </div>

                        <!-- Dine-In Orders -->
                        <div class="card card-outline-primary">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>User's Orders (Dine-In) Information</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="card p-30 d-flex align-items-center justify-content-center">
                                        <div class="media">
                                            <span class="mr-4"><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                            <div class="media-body">
                                                <h2><?php $sql="select * from users_ordersin";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);						
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Total Orders (Dine-In)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-2">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-credit-card f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_ordersin WHERE status = 'Pay At Counter' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Pay At Counter</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-envelope f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_ordersin WHERE status = 'Order Received' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Order Received</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_ordersin WHERE status = 'Preparing Your Order' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Preparing Your Order</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_ordersin WHERE status = 'Order Served' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Order Served</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_ordersin WHERE status = 'Order Cancelled' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Order Cancelled</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Take-Out Orders -->
                        <div class="card card-outline-primary">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>User's Orders (Take-Out) Information</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="card p-30 d-flex align-items-center justify-content-center">
                                        <div class="media">
                                            <span class="mr-4"><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                            <div class="media-body">
                                                <h2><?php $sql="select * from users_orders";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);						
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Total Orders (Take-Out)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-envelope f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_orders WHERE status = 'Order Received' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Order Received</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_orders WHERE status = 'Preparing Your Order' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Preparing Your Order</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_orders WHERE status = 'Order Collected' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Order Collected</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from users_orders WHERE status = 'Order Cancelled' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Order Cancelled</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>

                        <!-- Reservation -->
                        <div class="card card-outline-primary">
                            <div class="full graph_head">
                                <div class="heading1 margin_0">
                                    <h2>Reservation Information</h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="card p-30 d-flex align-items-center justify-content-center">
                                        <div class="media">
                                            <span class="mr-4"><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                            <div class="media-body">
                                                <h2><?php $sql="select * from reservation";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);						
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Total Reservation</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-envelope f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from reservation WHERE status = 'Reservation Made' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Reservation Made</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from reservation WHERE status = 'Table Ready' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Table Ready</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from reservation WHERE status = 'Reservation Completed' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Reservation Completed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle"> 
                                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql="select * from reservation WHERE status = 'Reservation Cancelled' ";
                                                    $result=mysqli_query($db,$sql); 
                                                    $rws=mysqli_num_rows($result);													
                                                    echo $rws;?></h2>
                                                <p class="m-b-0">Reservation Cancelled</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>

                    </div>                                       
                </div>
            </div>
        </div>     
    </div>
    
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/Chart.bundle.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/analyser.js"></script>
    <script>
        var ctx = document.getElementById('canvas').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Total Earnings',
                    data: <?php echo json_encode($earnings); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'RM'
                        },
                        beginAtZero: true                       
                    }]
                }
            }
        });
    </script>
</body>
</html>

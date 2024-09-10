<!DOCTYPE html>
<html lang="en">
<?php
// Include the necessary connection file
include("../connection/connect.php");
session_start();
// Ensure error reporting is on during development
error_reporting(E_ALL);
$show="show";
$title1=isset($_SESSION["title1"])?$_SESSION["title1"]:"";

$conn=mysqli_connect("localhost", "root", "", "onlinefoodsystem"); 	

if (isset($_POST["search"])) {
    $title = $_POST["title"];
    $_SESSION['title1']=$title;
    if (empty($title) || !isset($title)) {
        $show = "show";
    } else {
        $show = "";
    }
    // Update the query here to get the results based on the search input
    $sql = "SELECT users.*, users_ordersin.*, dishes_category.c_name, restaurant.res_name, restaurant.address
            FROM users 
            INNER JOIN users_ordersin ON users.u_id = users_ordersin.u_id 
            INNER JOIN dishes ON users_ordersin.d_id = dishes.d_id 
            INNER JOIN dishes_category ON dishes.c_id = dishes_category.c_id 
            INNER JOIN restaurant ON dishes.rs_id = restaurant.rs_id
            WHERE users_ordersin.o_num LIKE '%" . $title . "%' 
            AND (users_ordersin.status = 'Pay at Counter' OR users_ordersin.status = '' OR users_ordersin.status IS NULL)";

    $query = mysqli_query($conn, $sql); // Update the connection variable accordingly
}

if (isset($_POST["pay"])) {
    // Update the status to 'Order Received' in the database
    $update_query = "UPDATE users_ordersin SET status = 'Order Received' WHERE o_num = '" . $_SESSION['title1'] . "'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/icon.png">
    <title>All Orders</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        html {
            scroll-behavior: smooth;
        }

    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    #myTable {
        min-width: 1500px; 
    }

    /* Style for the search input field */
    #searchInput {
        width: 300px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .search-container {
        position: relative;
        display: inline-block;
    }

    .search-container input[type="text"] {
        padding-left: 30px; /* Adjust as needed */
    }

    .search-container i {
        position: absolute;
        left: 10px; /* Adjust as needed */
        top: 50%;
        transform: translateY(-50%);
        color: #aaa; /* Adjust as needed */
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

<body class="fix-header fix-sidebar">  
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
    
        <div class="page-wrapper">     
            <div class="container-fluid">           
                <div class="row">
                    <div class="col-12">                                              
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                        <form action="payment.php" method="POST">
                            <div class="search-container">
                                <input type="text" id="searchInput" name="title" placeholder="Search for Order Number... ">
                                <button name="search" class="btn btn-purple oval-button" style="margin-left: 20px;">Search</button>
                            </div>
                            <?php if ($show != 'show' && mysqli_num_rows($query) > 0) : ?>
                                <div class="text-right" style="margin-top: -60px;">
                                <button name="pay" onclick="showPaymentAlert()" class="btn btn-primary oval-button">Pay</button>
                                </div>
                            <?php endif; ?>
                        </form>                           
                            <br>                         
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Payment Details</h4>
                            </div>    
                            <div class="table-container">
                                    <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                                    <?php
                                    
                                    $total_price = 0;

                                    if($show=="show") {
                                        ?>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Order Number</th>
                                                <th>User ID</th>
                                                <th>Username</th>	
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Dish Category</th>
                                                <th>Dish Name</th>                    
                                                <th>Quantity</th>
                                                <th>Price (RM)</th>
                                                <th>Branch Name</th>
												<th>Branch Address</th>
                                                <th>Order Data & Time</th>
												<th>Status</th>																				
												<th>Action</th>												 
                                            </tr>
                                        </thead> 
                                        <?php
                                        echo '<td colspan="14"><center>Search for Order Number ...</center></td>';
                                    } else  {
                                    ?>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Order Number</th>
                                                <th>User ID</th>
                                                <th>Username</th>	
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Dish Category</th>
                                                <th>Dish Name</th>                    
                                                <th>Quantity</th>
                                                <th>Price (RM)</th>
                                                <th>Branch Name</th>
												<th>Branch Address</th>
                                                <th>Order Data & Time</th>
												<th>Status</th>																				
												<th>Action</th>												 
                                            </tr>
                                        </thead>                                       
                                        <tbody id="tableBody">                                           											
                                        <?php

                                            $sql = "SELECT users.*, users_ordersin.*, dishes_category.c_name, restaurant.res_name, restaurant.address
                                            FROM users 
                                            INNER JOIN users_ordersin ON users.u_id = users_ordersin.u_id 
                                            INNER JOIN dishes ON users_ordersin.d_id = dishes.d_id 
                                            INNER JOIN dishes_category ON dishes.c_id = dishes_category.c_id 
                                            INNER JOIN restaurant ON dishes.rs_id = restaurant.rs_id
                                            WHERE users_ordersin.o_num LIKE '%" . $title . "%' 
                                            AND (users_ordersin.status = 'Pay at Counter' OR users_ordersin.status = '' OR users_ordersin.status IS NULL)";
                            
                                                    $query=mysqli_query($db,$sql);												
                                                    if (!mysqli_num_rows($query) > 0) {
                                                        echo '<td colspan="14"><center>No Orders Found.</center></td>';
                                                    } else {
                                                        while ($rows = mysqli_fetch_array($query)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $rows['o_num']; ?></td>
                                                                <td><?php echo $rows['u_id']; ?></td>
                                                                <td><?php echo $rows['username']; ?></td>
                                                                <td><?php echo $rows['f_name']; ?></td>
                                                                <td><?php echo $rows['l_name']; ?></td>
                                                                <td><?php echo $rows['c_name']; ?></td>
                                                                <td><?php echo $rows['title']; ?></td>
                                                                <td><?php echo $rows['quantity']; ?></td>
                                                                <td><?php echo number_format($rows['quantity'] * $rows['price'], 2); ?></td>
                                                                <td><?php echo $rows['res_name']; ?></td>
                                                                <td><?php echo $rows['address']; ?></td>
                                                                <td><?php echo $rows['date']; ?></td>
                                                                <?php
                                                                $status = $rows['status'];
                                                                if ($status == 'Pay at Counter' || $status == '' || $status == 'NULL') {
                                                                    ?>
                                                                    <td> <button type="button" class="btn btn-primary"><span class="fa fa-bars" aria-hidden="true"></span> Pay at Counter</button></td>
                                                                <?php } ?>
                                                                <?php if ($status == "Order Received") { ?>
                                                                    <td> <button type="button" class="btn btn-info"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> Order Received</button></td>
                                                                <?php } ?>
                                                                <?php if ($status == "Preparing Your Order") { ?>
                                                                    <td> <button type="button" class="btn btn-warning"><span class="fa fa-check-circle" aria-hidden="true"></span> Preparing Your Order</button></td>
                                                                <?php } ?>
                                                                <?php if ($status == "Order Served") { ?>
                                                                    <td> <button type="button" class="btn btn-success"> <i class="fa fa-close"></i> Order Served</button></td>
                                                                <?php } ?> 
                                                                <?php if ($status == "Order Cancelled") { ?>
                                                                    <td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Order Cancelled</button></td>
                                                                <?php } ?>                   
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <a href="delete_ordersin.php?order_del=<?php echo $rows['o_id']; ?>" onclick="return confirm('Are you sure you want to delete the order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" style="margin-left: 7px;"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                    $row_price = $rows['quantity'] * $rows['price'];
                                                    $total_price += $row_price;
                                                        }
                                                        // Display the total price once at the bottom of the table
                                                        echo '<tr>';
                                                        echo '<tr><td colspan="7"></td><td colspan="2" align="center"><strong>Total Price: ' . number_format($total_price, 2) . '</strong></td><td colspan="7"></td></tr>';
                                                        echo '</tr>';
                                                    }                                                 
                                                }
                                                ?>												       					                                                                 
                                    </table> 
                                </div>                                        
                            </div>
                        </div>
                    </div>
                </div>        
            </div>		              
        </div>   
        
    </div>
    <footer class="footer">Malapot Kitchen © 2023</footer>
    
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script>
    function showPaymentAlert() {
        alert("Payment successful! The status of the order has been updated to 'Order Received.'");       
    }
    </script>
</body>
</html>
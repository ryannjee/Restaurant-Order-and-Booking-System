<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $status = $_POST['status']; // Get the status from the form
    // Retrieve the order ID from the URL parameter
    $user_upd = $_GET['user_upd'];

    // Retrieve the o_num value
    $sql_get_o_num = "SELECT o_num FROM users_orders WHERE o_id = $user_upd";
    $result_get_o_num = mysqli_query($db, $sql_get_o_num);
    $row_get_o_num = mysqli_fetch_array($result_get_o_num);
    $o_num = $row_get_o_num['o_num'];

    // Update the status in the database for all rows with the same o_num
    $updateQuery = "UPDATE users_orders SET status = '$status' WHERE o_num = '$o_num'";
    if (mysqli_query($db, $updateQuery)) {
        // Fetch data from the database
        $sql = "SELECT users.*, users_orders.*, dishes_category.c_name, restaurant.res_name, restaurant.address, users_orders.status 
        FROM users 
        INNER JOIN users_orders ON users.u_id = users_orders.u_id 
        INNER JOIN dishes ON users_orders.d_id = dishes.d_id 
        INNER JOIN dishes_category ON dishes.c_id = dishes_category.c_id 
        INNER JOIN restaurant ON dishes.rs_id = restaurant.rs_id
        WHERE users_orders.o_id = $user_upd"; 
        $query = mysqli_query($db, $sql);
        $rows = mysqli_fetch_array($query);

        if ($rows) {
            $to = $rows['email']; // Assuming 'email' is the column name for the user's email address
            $subject = "Order Status Update";
            $message = "Dear " . $rows['l_name'] . ' ' . $rows['f_name'] .",\r\n\r\nOrder Number: \r\n" . $rows['o_num'] . "\r\nYour order status has been updated to: \r\n" . $status . "\r\n\r\nIf you have any questions or need further assistance, please feel free to contact us at your convenience.\r\n\r\n\r\n\r\nBest regards,\r\nMalapot Kitchen\r\n\r\nThis is an auto-generated email. Please do not reply to this email.";
            $headers = "From: hotpot202204@gmail.com\r\n";
        
            // Sending email
            if (mail($to, $subject, $message, $headers)) {
                echo "Email sent successfully";
            } else {
                echo "Email sending failed";
            }
        }
        
        // If the update is successful, redirect to the pickup_orders.php page
        header("Location: ../admin/pickup_orders.php");
        exit();
    } else {
        // If the update fails, display an error message
        echo "Error updating record: " . mysqli_error($db);
    }
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/icon.png">
    <title>View Order</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">View Order</h4>
                            </div>                           
                                <div class="table-responsive m-t-20">
                                <form action="" method="post">
                                    <table id="myTable" class="table table-bordered table-striped">                                      
                                        <tbody>
                                            <?php
                                            // Retrieve the order ID from the URL parameter
                                            $user_upd = $_GET['user_upd'];

											$sql="SELECT users.*, users_orders.*, dishes_category.c_name, restaurant.res_name, restaurant.address
                                            FROM users 
                                            INNER JOIN users_orders ON users.u_id = users_orders.u_id                                               
                                            INNER JOIN dishes_category ON users_orders.c_id = dishes_category.c_id 
                                            INNER JOIN restaurant ON users_orders.rs_id = restaurant.rs_id
                                            WHERE users_orders.o_id = $user_upd"; 

											$query=mysqli_query($db,$sql);
											$rows=mysqli_fetch_array($query);																	
											?>
											
                                            <tr>
												<td><center><strong>Order Number</strong></center></td>
												<td><center><?php echo $rows['o_num']; ?></center></td>															  																																					
											</tr>

											<tr>
												<td><center><strong>User ID</strong></center></td>
												<td><center><?php echo $rows['u_id']; ?></center></td>															  																																					
											</tr>

                                            <tr>
												<td><center><strong>Username</strong></center></td>
												<td><center><?php echo $rows['username']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>First Name</strong></center></td>
												<td><center><?php echo $rows['f_name']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>Last Name</strong></center></td>
												<td><center><?php echo $rows['l_name']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>Dish Category</strong></center></td>
												<td><center><?php echo $rows['c_name']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>Dish Name</strong></center></td>
												<td><center><?php echo $rows['title']; ?></center></td>																									   																							
											</tr>

											<tr>
												<td><center><strong>Quantity</strong></center></td>
												<td><center><?php echo $rows['quantity']; ?></center></td>																									   																							
											</tr>

											<tr>
												<td><center><strong>Price</strong></center></td>
												<td><center>RM<?php echo number_format($rows['price'] * $rows['quantity'], 2); ?></center></td>													   												   																							
											</tr>

                                            <tr>
												<td><center><strong>Branch Name</strong></center></td>
												<td><center><?php echo $rows['res_name']; ?></center></td>																									   																							
											</tr>

											<tr>
												<td><center><strong>Branch Address</strong></center></td>
												<td><center><?php echo $rows['address']; ?></center></td>													  												   																							
											</tr>

											<tr>
												<td><center><strong>Order Date & Time</strong></center></td>
												<td><center><?php echo $rows['date']; ?></center></td>													  												   																							
											</tr>

											<tr>
                                                <td><center><strong>Status</strong></center></td>
                                                <td style="text-align: center;">
                                                    <?php 
                                                        $status = $rows['status'];
                                                    ?>

                                                    <select id="status-select" name="status" required="required" onchange="changeStatus(this.value)">                               
                                                        <option value="Order Received" <?php if ($status == "Order Received") echo 'selected="selected"'; ?>>Order Received</option>
                                                        <option value="Preparing Your Order" <?php if ($status == "Preparing Your Order") echo 'selected="selected"'; ?>>Preparing Your Order</option>
                                                        <option value="Order Collected" <?php if ($status == "Order Collected") echo 'selected="selected"'; ?>>Order Collected</option>
                                                        <option value="Order Cancelled" <?php if ($status == "Order Cancelled") echo 'selected="selected"'; ?>>Order Cancelled</option>
                                                    </select>

                                                    <button id="btn-order-received" class="btn btn-info" style="<?php echo ($status == 'Order Received' || $status == '' || $status == 'NULL') ? 'display:inline-block' : 'display:none'; ?>">
                                                        <span class="fa fa-bars" aria-hidden="true"></span> Order Received
                                                    </button>

                                                    <button id="btn-out-for-delivery" class="btn btn-warning" style="<?php echo ($status == 'Preparing Your Order') ? 'display:inline-block' : 'display:none'; ?>">
                                                        <span class="fa fa-cog fa-spin" aria-hidden="true"></span> Preparing Your Order
                                                    </button>

                                                    <button id="btn-delivered" class="btn btn-success" style="<?php echo ($status == 'Order Collected') ? 'display:inline-block' : 'display:none'; ?>">
                                                        <span class="fa fa-check-circle" aria-hidden="true"></span> Order Collected
                                                    </button>

                                                    <button id="btn-cancelled" class="btn btn-danger" style="<?php echo ($status == 'Order Cancelled') ? 'display:inline-block' : 'display:none'; ?>">
                                                        <i class="fa fa-close"></i> Order Cancelled
                                                    </button>
                                                </td>
                                            </tr>  
                                        </tbody>
                                    </table>                    
                                    <br> <div class="form-actions text-center">
                                        <button type="submit" class="btn btn-primary">Save Order Status</button>
                                        <a href="../admin/pickup_orders.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
						</div>                     
                        </div>
                        </div>
                    </div>
                </div>              
            </div>         
            <footer class="footer">Malapot Kitchen © 2023</footer>      
        </div>       
    </div>
    
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
    <script>
    function changeStatus(value) {
        var btnOrderReceived = document.getElementById('btn-order-received');
        var btnOutForDelivery = document.getElementById('btn-out-for-delivery');
        var btnDelivered = document.getElementById('btn-delivered');
        var btnCancel = document.getElementById('btn-cancelled');

        btnOrderReceived.style.display = 'none';
        btnOutForDelivery.style.display = 'none';
        btnDelivered.style.display = 'none';
        btnCancel.style.display = 'none';

        switch (value) {
            case 'Order Received':
                btnOrderReceived.style.display = 'inline-block';
                break;
            case 'Preparing Your Order':
                btnOutForDelivery.style.display = 'inline-block';
                break;
            case 'Order Collected':
                btnDelivered.style.display = 'inline-block';
                break;
            case 'Order Cancelled':
                btnCancel.style.display = 'inline-block';
                break;
            default:
                break;
        }
    }

    document.getElementById('status-select').addEventListener('change', function () {
        var selectedValue = this.value;
        changeStatus(selectedValue);
    });
    </script>

</body>
</html>


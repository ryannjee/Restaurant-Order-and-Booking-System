<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/icon.png">
    <title>View Reservation</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
        var popUpWin=0;
        function popUpWindow(URLStr, left, top, width, height)
        {
        if(popUpWin)
        {
        if(!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+1000+',height='+1000+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
        }
    </script>

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
                                <h4 class="m-b-0 text-white">View Reservation</h4>
                            </div>                           
                                <div class="table-responsive m-t-20">
                                    <table id="myTable" class="table table-bordered table-striped">                                      
                                        <tbody>
                                            <?php
                                                // Retrieve the order ID from the URL parameter
                                                $user_upd = $_GET['user_upd'];

                                                // Modify your SQL query to use the retrieved order ID as a filter
                                                $sql = "SELECT r.res_name AS res_name, r.address AS res_address, r.phone AS res_contact,
                                                res.reservationID, res.book_date, res.book_time, res.book_name, res.book_number,
                                                res.book_people, res.status, res.date AS datetime_received, u.u_id, res.book_id
                                                FROM reservation AS res
                                                INNER JOIN restaurant AS r ON res.rs_id = r.rs_id
                                                INNER JOIN users AS u ON res.u_id = u.u_id
                                                WHERE res.book_id = $user_upd"; 
												$query=mysqli_query($db,$sql);
												$rows=mysqli_fetch_array($query);																	
												?>
											
                                            <tr>
												<td><center><strong>Reservation ID</strong></center></td>
												<td><center><?php echo $rows['reservationID']; ?></center></td>															  																																					
											</tr>

											<tr>
												<td><center><strong>Restaurant Name</strong></center></td>
												<td><center><?php echo $rows['res_name']; ?></center></td>															  																																					
											</tr>

                                            <tr>
												<td><center><strong>Restaurant Address</strong></center></td>
												<td><center><?php echo $rows['res_address']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>Restaurant Contact</strong></center></td>
												<td><center><?php echo $rows['res_contact']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>Reservation Date</strong></center></td>
												<td><center><?php echo $rows['book_date']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>Reservation Time</strong></center></td>
												<td><center><?php echo $rows['book_time']; ?></center></td>																									   																							
											</tr>

                                            <tr>
												<td><center><strong>User ID</strong></center></td>
												<td><center><?php echo $rows['u_id']; ?></center></td>																									   																							
											</tr>

											<tr>
												<td><center><strong>Reservation Name</strong></center></td>
												<td><center><?php echo $rows['book_name']; ?></center></td>																									   																							
											</tr>

											<tr>
												<td><center><strong>Reservation Contact</strong></center></td>
                                                <td><center><?php echo $rows['book_number']; ?></center></td>												
                                            </tr>

                                            <tr>
												<td><center><strong>Number of People</strong></center></td>
												<td><center><?php echo $rows['book_people']; ?></center></td>																									   																							
											</tr>

											<tr>
												<td><center><strong>Date/Time Received</strong></center></td>
												<td><center><?php echo $rows['datetime_received']; ?></center></td>													  												   																							
											</tr>

											<tr>
												<td><center><strong>Status</strong></center></td>
												<?php 
													$status=$rows['status'];
													if($status == 'Reservation Made' || $status == '' || $status == 'NULL')
													{
													?>
													    <td><center><button type="button" class="btn btn-info"><span class="fa fa-bars"  aria-hidden="true" ></span> Reservation Made</button></center></td>
													<?php 
													}
													if($status == "Table Ready")
													{ 
                                                    ?>
														<td><center><button type="button" class="btn btn-warning"><span class="fa fa-cutlery"  aria-hidden="true" ></span> Table Ready</button></center></td> 
													<?php
													}
													if($status == "Reservation Completed")
													{
													?>
														<td><center><button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true"></span> Reservation Completed</button></center></td> 
													<?php 
													} 
													?>
													<?php
													if($status == "Reservation Cancelled")
													{
													?>
														<td><center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Reservation Cancelled</button> </center></td> 
													<?php 
													} 
												?>													  												   																							
											</tr>                                     
                                        </tbody>
                                    </table>
                                    <br><div class="form-actions text-center">
                                        <a href="../admin/update_reservationstatus.php?user_upd=<?php echo $rows['book_id']; ?>" title="Update order">
										<button type="button" class="btn btn-primary">Update Reservation Status</button></a>
                                        <a href="all_reservation.php" class="btn btn-inverse">Back</a>					
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
</body>

</html>
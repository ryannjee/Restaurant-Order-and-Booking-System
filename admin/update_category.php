<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(isset($_POST['submit'] ))
{
    if(empty($_POST['c_name']))
		{
			$error = '<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>field Required!</strong>
			</div>';
		}
	else
	{
	$mql = "update dishes_category set c_name ='$_POST[c_name]' where c_id='$_GET[cat_upd]'";
	mysqli_query($db, $mql);
	    $success = 	'<div class="alert alert-success alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Updated!</strong> Successfully.</br></div>'; 
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
    <title>Update Category</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
   
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                </div>         
            <div class="container-fluid">	
				 <div class="row">
					<div class="container-fluid">		
						<?php  
							echo $message;
						?>
						
					    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Update Restaurant Category</h4>
                            </div>
                            <div class="card-body">
                                <form action='' method='post' >
                                    <div class="form-body">
                                        <?php $ssql ="select * from dishes_category where c_id='$_GET[cat_upd]'";
													$res=mysqli_query($db, $ssql); 
													$row=mysqli_fetch_array($res);?>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Category</label>
                                                    <input type="text" name="c_name" value="<?php echo $row['c_name'];  ?>" class="form-control" placeholder="Category Name">
                                                   </div>
                                            </div>
                                                                                
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                        <a href="add_category.php" class="btn btn-inverse">Cancel</a>
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
    <footer class="footer">Malapot Kitchen © 2023</footer>
 
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>
</html>
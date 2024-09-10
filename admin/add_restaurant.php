<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

$message = ''; // Initialize the message variable

if(isset($_POST['submit']))          
{
	if(empty($_POST['res_name'])||$_POST['email']==''||$_POST['phone']==''||$_POST['url']==''||$_POST['o_hr']==''||$_POST['c_hr']==''||$_POST['o_days']==''||$_POST['address']=='')
	{	
		$message = '<div class="alert alert-danger alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>All field is required to fill up.</strong>
		</div>';						
	}
	else
	{		
		$fname = $_FILES['file']['name'];
		$temp = $_FILES['file']['tmp_name'];
		$fsize = $_FILES['file']['size'];
		$extension = explode('.',$fname);
		$extension = strtolower(end($extension));  
		$fnew = uniqid().'.'.$extension;  
		$store = "restaurant_images/".basename($fnew);                      
	
		if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' )
		{        
			if($fsize>=1000000)
			{
                $message = '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Maximum Image Size is 1024kb</strong> Try different Image.
				</div>';
			}
			else
			{																								
				$res_name=$_POST['res_name'];				                                 
				$sql = "INSERT INTO restaurant(res_name,email,phone,url,o_hr,c_hr,o_days,address,image) VALUE('".$res_name."','".$_POST['email']."','".$_POST['phone']."','".$_POST['url']."','".$_POST['o_hr']."','".$_POST['c_hr']."','".$_POST['o_days']."','".$_POST['address']."','".$fnew."')";  // store the submited data ino the database :images
				mysqli_query($db, $sql); 
				move_uploaded_file($temp, $store);			  
				$message = 	'<div class="alert alert-primary alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				New Branch Added Successfully.
				</div>';                	
			}
		}
		elseif($extension == '')
		{
			$message = '<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Please choose an image.</strong>
			</div>';
		}
		else
        {					
			$message = '<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Invalid extension.</strong>png, jpg, Gif are accepted.
			</div>';
        }               	   
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
    <title>Add Branches</title>
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
            <div class="container-fluid">                          									
				<?php  
				    echo $message; 
                ?>																																
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Add New Branch</h4>
                            </div>
                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">                                      
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Branch Name</label>
                                                    <input type="text" name="res_name" class="form-control">
                                                </div>
                                            </div>                                 
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Bussiness Email Address</label>
                                                    <input type="text" name="email" class="form-control form-control-danger" >
                                                </div>
                                            </div>                                     
                                        </div>
                                   
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Branch Phone Number</label>
                                                    <input type="text" name="phone" class="form-control" >
                                                </div>
                                            </div>
                                      
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Branch Website URL</label>
                                                    <input type="text" name="url" class="form-control form-control-danger" >
                                                </div>
                                            </div>
                                       
                                        </div>
                                 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Branch Opening Hour</label>
                                                    <select name="o_hr" class="form-control custom-select" data-placeholder="Choose a Category" >
                                                    <option>--Select your Hour--</option>
                                                        <option value="6am">6am</option>
                                                        <option value="7am">7am</option> 
														<option value="8am">8am</option>
														<option value="9am">9am</option>
														<option value="10am">10am</option>
														<option value="11am">11am</option>
                                                        <option value="12pm">12pm</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Branch Closing Hour</label>
                                                    <select name="c_hr" class="form-control custom-select" data-placeholder="Choose a Category" >
                                                    <option>--Select your Hour--</option>
                                                        <option value="9pm">9pm</option>
                                                        <option value="10pm">10pm</option>
                                                        <option value="11pm">11pm</option> 
														<option value="12pm">12pm</option>
														<option value="1am">1am</option>
														<option value="2am">2am</option>
														<option value="3am">3am</option>
                                                    </select>
                                                </div>
                                            </div>
											
											 <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Branch Operating Days</label>
                                                    <select name="o_days" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                        <option>--Select your Operating Days--</option>
														<option value="Monday-Friday">Monday-Friday</option>
														<option value="Monday-Saturday">Monday-Saturday</option>
                                                        <option value="Tuesday-Sunday">Tuesday-Sunday</option>
                                                        <option value="Wednesday-Sunday">Wednesday-Sunday</option>
                                                        <option value="Thursday-Sunday">Thursday-Sunday</option>
                                                        <option value="Friday-Sunday">Friday-Sunday</option>
                                                        <option value="Saturday-Sunday">Saturday-Sunday</option>
														<option value="Everyday">Everyday</option>
                                                    </select>
                                                </div>
                                            </div>
																						
											<div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Branch Image</label>
                                                    <input type="file" name="file"  id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                </div>
                                            </div>                                																					
											
																																												
                                        </div>
                        
                                        <h3 class="box-title m-t-40">Branch Address</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">                                                    
                                                    <textarea name="address" type="text" style="height:100px;" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                                                                
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                        <a href="all_restaurant.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<footer class="footer">Malapot Kitchen © 2023</footer>
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

</body>
</html>
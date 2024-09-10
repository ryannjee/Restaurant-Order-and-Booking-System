<!DOCTYPE html>
<html lang="en">
<?php

session_start();
error_reporting(E_ALL);
ob_start();
include("../connection/connect.php");
include("../object/sendPic.php");

$firstname = $lastname = $username = $email = $password = $cpassword = $phone = $gender = $birthday = $address = "";
$firstnameError = $lastnameError = $usernameError = $emailError = $passwordError = $cpasswordError = $phoneError = "";

$message = ''; // Initialize the message variable

if (isset($_POST['submit'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];

    if(empty($firstname) ||
        empty($lastname)|| 
        empty($username) ||  
        empty($email)||
        empty($phone)||
        empty($gender)||
        empty($address)||
        empty($birthday)
        ) {
            $message = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>All fields Required!</strong>
            </div>';
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $firstname) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
            $message = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>First name and last name can only contain letters.</strong>
            </div>';           
        } elseif (!preg_match("/^\+601[1-9]-[0-9]{7,8}$/", $phone)) {
            $message = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Invalid phone number format. Please use the format: +601X-XXXXXXXX</strong>
            </div>';           
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Invalid email address format. Please enter a valid email address.</strong>
            </div>';
        } else {
            $mql = "UPDATE users SET username='$username', f_name='$firstname', l_name='$lastname', email='$email', phone='$phone', gender='$gender', address='$address', birthday='$birthday' WHERE u_id='$_GET[user_upd]' ";
            if (mysqli_query($db, $mql)) {
                ob_clean();
                // Add a success message
                $message = '<div class="alert alert-primary alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>User profile updated successfully!</strong>
                </div>';
            } else {
                $message = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Failed to update user profile. Please try again later.</strong>
                </div>';
            }
        }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/icon.png">
    <title>Update Users</title>
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
   
        <div class="page-wrapper" style="height:1200px;">      
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">                                
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
                                <h4 class="m-b-0 text-white">Update User Profile</h4>
                            </div>
                            <div class="card-body">
                            <?php if (isset($_GET['user_upd']) && !empty($_GET['user_upd'])) {
                    $user_upd = $_GET['user_upd'];
                    $ssql ="select * from users where u_id='$user_upd'";
                    $res=mysqli_query($db, $ssql); 
                    $newrow=mysqli_fetch_array($res);

                    if ($newrow) {
                        ?>
                        <form action='../admin/update_users.php?user_upd=<?php echo $user_upd; ?>' method='post' enctype="multipart/form-data">
                                    <div class="form-body">                                                                      
                                        <hr>
                                        
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="oval-image-container">                      
                                                    <?php
                                                    if (isset($newrow['image']) && !empty($newrow['image'])) {
                                                        $userImage = $newrow['image'];
                                                    } else {
                                                        $userImage = 'unknownuser.jpg';
                                                    }
                                                    ?>                                      
                                                        <img src="../images/userpp/<?php echo $userImage; ?>" alt="Profile Picture" class="oval-image" width="200" height="200">                                                </div>
                                                <br><br>
                                            </div>
                                     
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" name="fname" class="form-control form-control-danger"  value="<?php  echo $newrow["f_name"];  ?>" placeholder="first name"><br>
                                                    </div>

                                                    <div class="form-group">
                                                    <label class="control-label">Last Name </label>
                                                    <input type="text" name="lname" class="form-control" placeholder="last name"  value="<?php  echo $newrow['l_name']; ?>">
                                                    </div>
                                            </div>                                     
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="uname" class="form-control" value="<?php  echo $newrow['username']; ?>" placeholder="username">
                                                    </div>
                                            </div>
                                     
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" name="email" class="form-control form-control-danger"  value="<?php  echo $newrow['email'];  ?>" placeholder="example@gmail.com">
                                                    </div>
                                            </div>                                     
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Gender</label><br>
                                                    <input type="radio" name="gender" id="male" value="male" <?php if ($newrow['gender'] === 'male') echo 'checked'; ?>>
                                                    <label for="male"> Male &nbsp;&nbsp;&nbsp;</label>
                                                    <input type="radio" name="gender" id="female" value="female" <?php if ($newrow['gender'] === 'female') echo 'checked'; ?>>
                                                    <label for="female"> Female </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Birthday</label><br>
                                                    <input type="date" name="birthday" id="birthday" value="<?php echo $newrow['birthday']; ?>" max="<?php echo date('Y-m-d'); ?>"><br><br>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="text" name="phone" class="form-control form-control-danger" value="<?php  echo $newrow['phone']; ?>" placeholder="phone">
                                                    </div>
                                            </div>
                                     
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Home Address</label><br>
                                                    <textarea class="form-control" id="exampleTextarea" name="address" rows="3"><?php echo $newrow["address"]; ?></textarea><br><br>                                                                                             
                                                </div>
                                            </div>                                  
                                        </div>                                                                                                       
                                    </div>
                                    <div class="form-actions text-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                        <a href="all_users.php" class="btn btn-inverse">Back</a>
                                    </div>
                                    </form>
                        <?php
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>User not found!</strong>
                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>No user ID provided!</strong>
                    </div>';
                }
                ?>
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

</body>
</html>                                               


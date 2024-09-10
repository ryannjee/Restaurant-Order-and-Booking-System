<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="icon" href="../images/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="../css/login.css">

	<style type="text/css">
	#buttn{
		color:#fff;
		background-color: #5c4ac7;
	}

    .pen-title{
        padding: 70px 0;
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
    
    .form-module {
    position: relative;
    background: #ffffff;
    max-width: 500px;
    width: 100%;
    border-top: 5px solid #5c4ac7;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    }

    .form-module .form {
    padding: 100px 40px 90px 40px;
    }
	</style>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/animsition.min.css" rel="stylesheet">
  <link href="../css/animate.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body>
<div style="background-image: url('../images/logreg.jpg');">
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

<?php
include("../connection/connect.php"); 
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))  
{
	$username = $_POST['username'];  
	$password = $_POST['password'];
	
	if(!empty($_POST["submit"]))   
  {
    $loginquery ="SELECT * FROM users WHERE username='$username'";
    $result=mysqli_query($db, $loginquery);
    $row=mysqli_fetch_array($result);
	
  if(is_array($row)) {
    // Verify the password using password_verify
    if(password_verify($password, $row['password'])) {
        // Set session and redirect to the home page
        $_SESSION["user_id"] = $row['u_id']; 
        header("refresh:1;url=../user/home.php"); 
    } else {
        $message = "Invalid Username or Password!"; 
    }
  } else {
    $message = "Invalid Username or Password!"; 
  }
}
}
?>
  
<div class="pen-title">
</div>

<div class="module form-module">
    <div class="toggle"></div>
    <div class="form">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px">
            <h2 style="margin: 0;">Login Here!</h2>
            <a href="../admin/adminlogin.php" style="color: red; font-size: 12px; text-decoration: underline;">Admin Login</a>
        </div>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
            <input type="text" placeholder="Username"  name="username"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="submit" id="buttn" name="submit" value="Login" />
        </form>
        <div class="login-remember">
            <span><a href="../forgot/forgot.php" style="color: blue;">Forget Password?</a></span>
        </div>
    </div>
    <div class="cta">Join us as a member today!  <a href="../user/registration.php" style="color:#5c4ac7;">  Register now</a></div>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <div class="container-fluid pt-3">
  </div>
  
  <footer class="footer">
      <div class="container">
          <div class="bottom-footer">
              <div class="row">
                  <div class="col-xs-12 col-sm-3 payment-options color-gray">
                      <h5>Email Address</h5>
                      <p>Find us at malapot@gmail.com</p>
                  </div>
                  <div class="col-xs-12 col-sm-4 address color-gray">
                      <h5>Address</h5>
                      <p>Sunway Street, Jalan PJS 11/7, Bandar Sunway,<br>Petaling Jaya, 47500 Selangor.</p>
                  </div>
                  <div class="col-xs-12 col-sm-5 additional-info color-gray">
                      <h5>About Us</h5>
                      <p>Bring the wonders of Chinese delicay to society without a single fuss. Having problems in queing? No problem!</p>
                  </div>
              </div>
          </div>
    
      </div>
  </footer>
</body>
</html>
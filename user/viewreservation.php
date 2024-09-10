<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:../user/login.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/icon.png">
    <title>Your Reservations</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animsition.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<style type="text/css" rel="stylesheet">
.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
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

@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

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
        <section class="hero bg-image" data-image-src="../images/home.jpeg">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Your Reservation</h1>                   
                    <div class="banner-form">
                        <form class="form-inline">                         
                        </form>
                    </div>
                </div>
            </div>      
            </section>
            <div class="result-show">
                <div class="container">
                    <div class="row">                                             
                    </div>
                </div>
            </div>               
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                          </div>
                        <div class="col-xs-12">
                            <div class="bg-gray">
                            <div class="row justify-content-center">
                                <div class="row">								
							        <table class="table table-bordered table-hover">
						                <thead style = "background: #404040; color:white;">
							                <tr>	
                                                <th>Reservation ID</th>
                                                <th>Restaurant Name</th>
                                                <th>Restaurant Address</th>	
                                                <th>Restaurant Contact</th>	
                                                <th>Reservation Date</th>					
							                    <th>Reservation Time</th> 
                                                <th>Your Name</th>                                           
							                    <th>Your Contact</th>
							                    <th>Number of People</th>
							                    <th>Status</th>
                                                <th>Date/Time Received</th>
                                                <th>Action</th>							  
							                </tr>
						                </thead>
                                        <tbody>
                                            <?php
                                            $query_res = mysqli_query($db, "SELECT r.res_name AS res_name, r.address AS res_address, r.phone AS res_contact,
                                            res.reservationID, res.book_date, res.book_time, res.book_name, res.book_number,
                                            res.book_people, res.status, res.date AS datetime_received
                                            FROM reservation AS res
                                            INNER JOIN restaurant AS r ON res.rs_id = r.rs_id
                                            WHERE res.u_id='" . $_SESSION['user_id'] . "'
                                            ORDER BY res.date DESC");                              
                                            if (!mysqli_num_rows($query_res) > 0) {
                                                echo '<td colspan="12"><center>No reservation had been placed yet. </center></td>';
                                            } else {
                                                while ($row = mysqli_fetch_array($query_res)) {
                                                    ?>
                                                    <tr>
                                                    <td data-column="reservationID"> <?php echo $row['reservationID']; ?></td>
                                                    <td data-column="res_name"> <?php echo $row['res_name']; ?></td>
                                                    <td data-column="res_address"> <?php echo $row['res_address']; ?></td>
                                                    <td data-column="res_contact"> <?php echo $row['res_contact']; ?></td>
                                                    <td data-column="book_date"> <?php echo $row['book_date']; ?></td>
                                                    <td data-column="book_time"> <?php echo $row['book_time']; ?></td>
                                                    <td data-column="book_name"> <?php echo $row['book_name']; ?></td>
                                                    <td data-column="book_number"> <?php echo $row['book_number']; ?></td>
                                                    <td data-column="book_people"> <?php echo $row['book_people']; ?></td>
                                                        <td data-column="status">
                                                            <?php
                                                                                                 
                                                            $status = $row['status'];
                                                            if ($status == 'Reservation Made' || $status == '' || $status == 'NULL') {
                                                                ?>
                                                                <button type="button" class="btn btn-primary">
                                                                    <span class="fa fa-bars" aria-hidden="true"></span> Reservation Made
                                                                </button>
                                                            <?php 
                                                            } elseif ($status == "Table Ready") {
                                                                ?>
                                                                <button type="button" class="btn btn-info">
                                                                    <span class="fa fa-cutlery" aria-hidden="true"></span> Table Ready
                                                                </button>                        
                                                            <?php  
                                                            } elseif ($status == "Reservation Completed") {
                                                                ?>
                                                                <button type="button" class="btn btn-success">
                                                                    <span class="fa fa-check-circle" aria-hidden="true"></span> Reservation Completed
                                                                </button>
                                                            <?php                                            
                                                            } elseif ($status == "Reservation Cancelled") {
                                                                ?>
                                                                <button type="button" class="btn btn-danger">
                                                                    <i class="fa fa-close"></i> Reservation Cancelled
                                                                </button>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-column="datetime_received"> <?php echo $row['datetime_received']; ?></td>                                                       
                                                         <td data-column="Action">
                                                            <?php
                                                            if ($status == 'Reservation Made' || $status == '' || $status == 'NULL') {
                                                                echo '<a href="../user/delete_reservation.php?order_del=' . $row['reservationID'] . '" onclick="return confirm(\'Are you sure you want to cancel your order?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"> Cancel Reservation</i></a>';
                                                            } else {
                                                                echo '<button class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" disabled><i class="fa fa-trash-o" style="font-size:16px"> Cancel Reservation</i></button>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>                                                   
                                                    </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
					                    </table>                               
                                    </div>                          
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>

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

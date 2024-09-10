<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

// Set the number of records to be displayed per page
$records_per_page = 10;
$conn=mysqli_connect("localhost", "root", "", "onlinefoodsystem"); 	
// Get the current page number
if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $_SESSION['current_page1'] = $_GET['page'];
    $page = $_GET['page'];
} else if(isset($_SESSION['current_page1']) && is_numeric($_SESSION['current_page1'])) {
    $page = $_SESSION['current_page1'];
} else {
    $page = 1;
}
// Get the offset value for the SQL query
$offset = ($page - 1) * $records_per_page;

// Query to get the total number of records
$total_query = "SELECT COUNT(*) as total FROM reservation";
$result_total = mysqli_query($conn, $total_query);
$row_total = mysqli_fetch_assoc($result_total);
$total_records = $row_total['total'];

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/icon.png">
    <title>All Reservations</title>
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

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination {
        list-style-type: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a {
        display: block;
        padding: 5px 10px;
        background-color: #f1f1f1;
        color: #333;
        text-decoration: none;
        border-radius: 3px;
    }

    .pagination li a.active {
        background-color: #333;
        color: #fff;
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
                            <div class="search-container">
                                <input type="text" id="searchInput" placeholder="&#xf002;  Search for reservation information ..." style="font-family:Arial, FontAwesome; margin-bottom: 10px;">                                                       
                            </div>
                            <br>
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">All Reservations</h4>
                            </div>                            
                            <div class="table-container">
                                    <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Reservation ID</th>
                                                <th>Restaurant Name</th>
                                                <th>Restaurant Address</th>	
                                                <th>Restaurant Contact</th>	
                                                <th>Reservation Date</th>					
							                    <th>Reservation Time</th> 
                                                <th>User ID</th>
                                                <th>Reservation Name</th>                                           
							                    <th>Reservation Contact</th>
							                    <th>Number of People</th>         
                                                <th>Date/Time Received</th>
                                                <th>Status</th>
                                                <th>Action</th>												 
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">                                           											
											<?php
												$sql = "SELECT r.res_name AS res_name, r.address AS res_address, r.phone AS res_contact,
                                                res.reservationID, res.book_date, res.book_time, res.book_name, res.book_number,
                                                res.book_people, res.status, res.date AS datetime_received, u.u_id, res.book_id
                                                FROM reservation AS res
                                                INNER JOIN restaurant AS r ON res.rs_id = r.rs_id
                                                INNER JOIN users AS u ON res.u_id = u.u_id
                                                ORDER BY res.date DESC LIMIT $offset, $records_per_page";                                                                                
												$query=mysqli_query($db,$sql);												
												if (!mysqli_num_rows($query) > 0) {
                                                    echo '<td colspan="13"><center>No Reservation Found</center></td>';
                                                } else {
                                                    while ($rows = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rows['reservationID']; ?></td>
                                                            <td><?php echo $rows['res_name']; ?></td>
                                                            <td><?php echo $rows['res_address']; ?></td>
                                                            <td><?php echo $rows['res_contact']; ?></td>
                                                            <td><?php echo $rows['book_date']; ?></td>
                                                            <td><?php echo $rows['book_time']; ?></td>
                                                            <td><?php echo $rows['u_id']; ?></td>
                                                            <td><?php echo $rows['book_name']; ?></td>
                                                            <td><?php echo $rows['book_number']; ?></td>
                                                            <td><?php echo $rows['book_people']; ?></td>                                                           
                                                            <td><?php echo $rows['datetime_received']; ?></td>
                                                            <?php
                                                            $status = $rows['status'];
                                                            if ($status == 'Reservation Made' || $status == '' || $status == 'NULL') {
                                                                ?>
                                                                <td> <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Reservation Made</button></td>
                                                            <?php } ?>
                                                            <?php if ($status == "Table Ready") { ?>
                                                                <td> <button type="button" class="btn btn-warning"><span class="fa fa-cutlery" aria-hidden="true"></span> Table Ready</button></td>
                                                            <?php } ?>
                                                            <?php if ($status == "Reservation Completed") { ?>
                                                                <td> <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Reservation Completed</button></td>
                                                            <?php } ?>
                                                            <?php if ($status == "Reservation Cancelled") { ?>
                                                                <td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Reservation Cancelled</button></td>
                                                            <?php } ?>                   
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="view_reservation.php?user_upd=<?php echo $rows['book_id']; ?>" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                                                    <a href="delete_reservation.php?order_del=<?php echo $rows['book_id']; ?>" onclick="return confirm('Are you sure you want to delete the order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" style="margin-left: 7px;"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>					                         
                                        </tbody>
                                    </table>
                                    <div class="pagination-container">
                                        <?php
                                        // Generate pagination links
                                        $pagination = '';
                                        if ($total_records > $records_per_page) {
                                            $total_pages = ceil($total_records / $records_per_page);
                                            $current_page = $page;

                                            $pagination .= '<ul class="pagination">';
                                            if ($current_page > 1) {
                                                $pagination .= '<li><a href="?page='.($current_page - 1).'">&laquo;</a></li>';
                                            }
                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                if ($i == $current_page) {
                                                    $pagination .= '<li><a href="?page='.$i.'" class="active">'.$i.'</a></li>';
                                                } else {
                                                    $pagination .= '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                                                }
                                                    }
                                                    if ($current_page < $total_pages) {
                                                        $pagination .= '<li><a href="?page='.($current_page + 1).'">&raquo;</a></li>';
                                                    }
                                                    $pagination .= '</ul>';

                                                    echo $pagination;
                                                }
                                            ?>
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
    <script>
    // Add an event listener to the input field
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.getElementById("searchInput");
        var table = document.getElementById("myTable");
        var tableBody = document.getElementById("tableBody");

        input.addEventListener("keyup", function () {
            var filter = input.value.toUpperCase();
            var rows = table.getElementsByTagName("tr");

            var found = false;
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var rowDisplay = "none";

                for (var j = 0; j < cells.length; j++) {
                    var cellData = cells[j].textContent.toUpperCase();

                    // Using regular expressions for more flexible search
                    var regex = new RegExp(filter, 'i');
                    if (regex.test(cellData)) {
                        found = true;
                        rowDisplay = "";
                        break;
                    }
                }
                rows[i].style.display = rowDisplay;
            }

            var noUsersRow = tableBody.querySelector("#noUsersRow");
            if (found || filter === "") {
                if (noUsersRow) {
                    noUsersRow.style.display = "none";
                }
            } else {
                if (!noUsersRow) {
                    var noUsersRow = document.createElement("tr");
                    noUsersRow.setAttribute("id", "noUsersRow");
                    var noUsersCell = document.createElement("td");
                    noUsersCell.setAttribute("colspan", "13");
                    noUsersCell.innerHTML = "<center>Order cannot be found.</center>";
                    noUsersRow.appendChild(noUsersCell);
                    tableBody.appendChild(noUsersRow);
                } else {
                    noUsersRow.style.display = "";
                }
            }
        });
    });
    </script>
    <script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#myTable')) {
            $('#myTable').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [10, 25, 50, 75, 100],
                "pageLength": 10
            });
        }
    });
    </script>

</body>
</html>
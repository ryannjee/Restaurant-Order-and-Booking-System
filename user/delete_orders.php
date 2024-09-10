<?php
include("../connection/connect.php"); //connection to db
error_reporting(E_ALL);
session_start();


// sending query
mysqli_query($db,"DELETE FROM users_orders WHERE o_id = '".$_GET['order_del']."'"); 
header("location:../user/orders.php"); 

?>

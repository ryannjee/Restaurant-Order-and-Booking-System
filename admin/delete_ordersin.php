<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM users_ordersin WHERE o_id = '".$_GET['order_del']."'");
header("location:dinein_orders.php");  

?>

<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

// Use the correct variable name
$reservationID = $_GET['order_del'];

mysqli_query($db, "DELETE FROM reservation WHERE book_id = '$reservationID'");
header("location:all_reservation.php");

?>

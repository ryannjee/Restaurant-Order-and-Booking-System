<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

mysqli_query($db, "DELETE FROM users WHERE u_id = '" . $_GET['user_del'] . "'");
// Perform the deletion operation first

// Redirect to all_users.php after deletion
header("location:all_users.php");  

?>

<?php
session_start();
session_destroy();
$url = '../user/home.php';
header('Location: ' . $url);

?>
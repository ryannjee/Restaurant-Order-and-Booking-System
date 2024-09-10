<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($_POST["submit"])) {
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='$password'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);

        if (is_array($row)) {
            $_SESSION["adm_id"] = $row['adm_id'];
            header("refresh:1;url=dashboard.php");
        } else {
            echo "<script>alert('Invalid Username or Password!');</script>";
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="icon" href="../images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/login.css">
</head>

<body style="background-image: url('../images/logreg.jpg');">
    <div class="container">
        <div class="info">
            <h1 style="font-weight: 700;">ADMIN LOGIN</h1>
        </div>
    </div>
    <div class="form" style="margin: 0 auto;">
        <div class="thumbnail"><img src="images/manager.png"></div>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>

        <form class="login-form" action="../admin/adminlogin.php" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" name="submit" value="Login" />
            <input type="button" style="outline: 0; background: #5c4ac7; width: 100%; border: 0; padding: 15px; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;
            color: #ffffff; font-size: 14px; transition: all 0.3 ease; cursor: pointer;" onclick="redirectToLogin()" value="Back" />
        </form>
    </div>

    <script>
        function redirectToLogin() {
            window.location.href = '../user/login.php';
        }
    </script>

    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='js/index.js'></script>
</body>

</html>

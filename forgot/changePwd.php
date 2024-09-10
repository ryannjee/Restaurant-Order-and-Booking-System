<?php 
include "forgotObject.php";
$vali = new Validation ("",isset($_POST["password"]) ? $_POST["password"] : "","");//connect to the object oriented of validation for showing the validation to users
$forgot= new forgot("localhost", "email", "password", "onlinefoodsystem");
$passwordErr=$errorP="";

function test_input($data){ // format the string
    $data = trim($data); //delete the space if the input
    $data = stripslashes($data); // removes backslashes
    $data = htmlspecialchars($data); //converts special characters to their HTML entities
    return $data;
}

session_start();
$verifyCode=isset($_SESSION["code"])?$_SESSION["code"]:"Wronggg";
$email=isset($_SESSION["email"])?$_SESSION["email"]:"";
$code=null;
if(isset($_POST["submit"])){
    $code=isset($_POST["forgot"])?$_POST["forgot"]:"";
    $code=test_input($code);//format the string
    if($code!=$verifyCode){
        echo "<script>
        alert('Invalid Verification Code');
        </script>";
        $code=null;
    }
}

if (isset($_POST["change"])) {
    $errorP = $passwordErr = $vali->ErrPassword();
    if ($vali->register == 1) {
        $pwd = isset($_POST["password"]) ? $_POST["password"] : "";
        $forgot->changePwd($email, $pwd);
    } else {
        echo "<script>
        alert('$errorP');
        </script>";
    }
    $code = isset($_POST["forgot"]) ? $_POST["forgot"] : null; // retrieve the code
}
?>

<!DOCTYPE html>
<html>
    <head>
    <style>
        html {
            scroll-behavior: smooth;
        }

      *{
        box-sizing: border-box;
      }

      body{
        background-color: #000435;
        color: #fff;
        font-family: 'Courier New', Courier, monospace, serif;
      }

      form {
        width: 900px;
        padding: 150px 15px;
        margin: 0 auto;
        text-align: center;
      }

      form.control{
        margin: 0 0 24px;
      }

      form.control input{
        width: 100%;
        padding: 14px 16px;
        border: 0;
        border-radius: 0;
        background: transparent;
        font-family: 'Courier New', Courier, monospace, serif;
        letter-spacing: 0.05em;
        font-size: 16px;
      }

      form.control input:hover, form.control input:focus{
        outline: none;
        border: 0;
      }

      button{
        width:50%;
        padding: 14px 16px;
        background: #605a6a;
        border-radius: 20px;
        margin-top: 20px;
        border: 0;
        color: #fff;
        letter-spacing: 0.1em;
        font-weight: bold;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: 16px;
      }

      button:hover{
        background-color: #7056a0;
        transition: 0.2s;
      }

      input{
        border-radius: 0px;
        padding: 10px 40px;
      }
    </style>
    </head>

    <body>
        <form action="changePwd.php" method="POST">
            <?php if (!isset($code)) { ?>
                <h3>We Are Almost There!</h3>
                <h2>An 8-Digit Verification Code Has Been Sent To Your Email</h2>
                <input type="text" name="forgot" placeholder=" 8-Digit Code"><br><br>
                <button type="submit" value="Enter" name="submit">SUBMIT</button>
            <?php } else { ?>
                <h2>8-Digit Code Verification Successful!</h2>
                <h2>Enter Your New Password: </h2>
                <input type="password" name="password" placeholder=" New Password"><br><br>
                <button type="submit" value="Enter" name="change">Change</button>
                <h4>Psst, Make Sure You Remember It! ;)</h4>
            <?php } ?>
        </form>
    </body>
</html>
<?php 
  include "forgotObject.php";
  $forgot= new forgot("localhost", "email", "password", "onlinefoodsystem");
  $vali = new Validation ("","",isset($_POST["email"]) ? $_POST["email"] : "");//connect to the object oriented of validation for showing the validation to users
  $emailErr="";
  if(isset($_POST["submit"]))
  {
    $emailErr=$vali->ErrEmail(); 
    if($vali->register==1)
    {
      $email=isset($_POST["email"])?$_POST["email"]:"";
      $forgot->getVerify($email);
    }
    else
    {
      echo "<script>
      alert('$emailErr');
      </script>";
    }
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
        width: 800px;
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
        margin-top: 40px;
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

  <form action="forgot.php" method="post">
    <h1>Request To Change Password</h1>
    <div class="form-group">
      <label for="email">Enter Your Email:</label>
      <input type="email" id="email" name="email" >
    </div>
    <button type="submit"  name="submit">Submit</button>
  </form>
</html>
<?php 

class forgot
{
    public $conn;
    public function __construct($server, $username, $password, $database) // Constructor method
	{
        $this->conn = mysqli_connect($server, $username, $password, $database); //connect to the database
        if (!$this->conn) { // if connect fail 
            die("Connect failed: " .$this->conn.mysqli_connect_error()); 
        }
    }

//generate a random verify
    function generate_random_password() 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; //random the number from these char
        $password = "";
        for ($i = 0; $i < 8; $i++) 
        {
          $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
      }

    //send the Verify to the user's email
    function send_password_email($email, $new_verify) 
    {
        $to = "$email";
        $subject = "Reset Password Request";
        $message = "We Have Received A Request To Reset The Password For Your Malapot Kitchen Account. 
The 8-Digit verification Code Is Shown Below To Proceed:

        $new_verify

If This Wasn't You, We Recommend That You Change Your Password Immediately OR Contact Our Support Team For Further Assistance.

Best Regards,
MALAPOT KITCHEN";
        $headers = "From: hotpot202204@gmail.com";

        mail($to, $subject, $message, $headers);
    }

    public function getVerify($email)
    {
        $check_query="SELECT * FROM users WHERE email = '$email'";
        $result=mysqli_query($this->conn,$check_query);
        $row=mysqli_num_rows($result);
        if($row==1)
        {
            $verify = $this->generate_random_password();//use  the function for generating the random password

            // Send the new password to the user's email
            $this->send_password_email($email, $verify);
            echo "8-Digit Verification Code Sent Successfully.";
            session_start();//save the code value;
            $_SESSION["code"]=$verify;  
            $_SESSION["email"]=$email;
            header("location:changePwd.php");//go revise the password
        }
        else
        {
            echo "<script>
            alert('Email Not Found, Please Check Your Email Address Again.');
            </script>";
        }
        mysqli_close($this->conn);
    }
    public function changePwd($email,$pwd)
    {
        $email=strtolower($email); //lowercacse for the email
        $check_query="SELECT * From users Where email='$email'";
        $row=mysqli_num_rows(mysqli_query($this->conn,$check_query));

        if($row==1)
        {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT); // secure the password for preventing hacker
            $sql="UPDATE users set 
            password='$pwd' where email='$email'";
            mysqli_query($this->conn,$sql);
            echo "<script>
            alert('Your Password Is Now Updated.');
            window.location.href = '../user/login.php'; 
            </script>";
        }
        else
        {
            echo "We Are Currently Facing Technical Issue,
            Please Try Again Later.";
        }
        mysqli_close($this->conn);
    }
}

class Validation
{
    function test_input($data) // format the string
    {
    $data = trim($data); //delete the space if the input
    $data = stripslashes($data); // removes backslashes
    $data = htmlspecialchars($data); //converts special characters to their HTML entities
    return $data;
    }
    private $userErro,$passwordErr,$emailErr;
    public $register; // for restricting the login and register
    public function __construct($userErro,$passwordErr,$emailErr)// construct the class
    {
        $this->userErro=$userErro;
        $this->passwordErr=$passwordErr;
        $this->emailErr=$emailErr;        
        $this->register=0;
    }
    public function ErrID() //restrict the input for username
    {
        $error=$this->userErro; // showing the error message 
        if(empty($error)) // showing the message if the value is empty 
        {
            $error="*Name Is Required.";
        }
        else //the value is not empty 
        {
            $tem= $this->test_input($error); //use the function 
            if(strlen($error)<4) // count the string length 
            {
                $error="*At Least 4 Digits.";
            }
            else if(strlen($error)<=200)
            {
                if (!preg_match("/^[a-zA-Z0-9 ]*$/",$tem))  // the users is only able to enter A-Z/a-z/0-9
                {
                    $error="Only Letters, Numbers & White Spaces Allowed.";
                    $this->register=0; //return the value
                }
                else 
                {
                    $error=""; //clear the value
                    $this->register+=1;
                }
            }
            else
            {
                $error="Your Name Is Too Long.";
            }
        }
        return $error;
    }

    public function ErrPassword()
    {
        $error=$this->passwordErr ;
        if(empty($error))// showing the message if the value is empty 
        {
            $error="Password is Required To Fill Up!";
        }
        else
        {
            $tem= $this->test_input($error); //use the function 
            if(strlen($error)<8)// count the string length 
            {
                $error="Password Must Contain 8 Characters & Above.";
            }
            else if(strlen($error))
            {
                if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/",$tem)) // the users is only able to enter A-Z/a-z/0-9
                {
                    $error="Password Must Contain At Least 1 Lowercase Letter, 1 Uppercase Letter, 1 Number, & 1 Symbol (Excluding Spaces).";
                    $this->register=0;//return the value

                }
                else
                {
                    $error="";//clear the value
                    $this->register+=1;                
                }
            }
        }
        return $error;
    }

    public function ErrEmail()
    {
        $error=$this->emailErr;
        if(empty($error))// showing the message if the value is empty 
        {
            $error="Email Is Required To Fill Up!";
        }
        else
        {
            $tem= $this->test_input($error);//use the function 
                if (!filter_var($tem, FILTER_VALIDATE_EMAIL)) // the users is only able to enter email form
                {
                    $error = "Invalid Email Address Format, Please Enter A Valid Email Address.";
                    $this->register=0;//return the value
                }
                else
                {
                    $error="";//clear the value
                    $this->register+=1;                
                }
        }
        return $error;
    }
}
?>
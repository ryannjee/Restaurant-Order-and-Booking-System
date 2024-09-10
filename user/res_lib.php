<?php
class reservation{
    //CONSTRUCTIR - CONNECT TO DATABASE
    private $pdo;
    private $stmt;
    function __construct(){
        try{
            $this->pdo = new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHAR,DB_USER,DB_PASS,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }catch(Exception $ex){ exit($ex->getMessage());}
    }

    //DESTRUCTOR - CLOSE DATABASE CONNECTION
    function _destruct(){
        $this->pdo = null;
        $this->stmt = null;
    }

    function generateUniqueNumber()
    {
        // Generate a unique alphanumeric order number for the current session
        $characters = '0123456789';
        $randomString = 'R-';
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }  

    function save($userId, $date, $time, $rs_id, $name, $number, $people, $status)
    {
        try {
            $this->stmt = $this->pdo->prepare(
                "INSERT INTO `reservation` (`reservationID`, `u_id`, `book_date`, `book_time`, `rs_id`, `book_name`, `book_number`, `book_people`, `status`, `date`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            // Call generateUniqueNumber using $this
            $uniqueNumber = $this->generateUniqueNumber();

            $success = $this->stmt->execute([$uniqueNumber, $userId, $date, $time, $rs_id, $name, $number, $people, $status, null]);

            // Return the reservationID if the insertion was successful, false otherwise
            return ($success) ? $uniqueNumber : false;  // Return the unique number directly

        } catch (Exception $ex) {
            // Log or handle the exception as needed
            error_log('Error saving reservation: ' . $ex->getMessage());
            return false;
        }
    }   
}

//Database settings
define("DB_HOST", "localhost");
define("DB_NAME", "onlinefoodsystem");
define("DB_CHAR", "utf8");
define("DB_USER", "root");
define("DB_PASS", "");

// NEW RESERVATIN OBJECT
$_RSV = new reservation();

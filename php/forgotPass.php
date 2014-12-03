<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');

// include db connect class
class DB_CONNECT { // constructor  

    function __construct() { // connecting to database     
        $this->connect();
    }

    // destructor
    function __destruct() { // closing db connection 
        $this->close();
    }

    /**  Function to connect with database */
    function connect() { // import database connection variables       
        define('DB_USER', "u1029802_sensus"); // db user
        define('DB_PASSWORD', ">P<o,P2.qr"); // db password (mention your db password here)
        define('DB_DATABASE', "db1029802_sensus"); // database name
        define('DB_SERVER', "mysql2275int.cp.blacknight.com"); // db server      
        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error()); // Connecting to mysql database        
        $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error()); // Selecing database     
        return $con; // returing connection cursor
    }

    /** Function to close db connection */
    function close() { // closing db connection        
        mysql_close();
    }

}

$db = new DB_CONNECT(); // connecting to db
// Forgot Password Clicked
$email = ($_POST['userEmail']);
$newPass = ($_POST['newPass']);
$newPassHash = ($_POST['newPassHash']);
//$email = 'hiace.mcginley@gmail.com';
//$newPass = 'x0x0x0x0';
//$newPassHash = 'fffsdsfsdfsfssfs';
//$data["status"] = "nok";

$result = mysql_query("UPDATE `userTable` SET `password`='" . $newPassHash . "' WHERE userEmail = '" . $email . "'") or die(mysql_error());
$data["status"] = "ok";
// Email Sending
//$to = ($_POST['userEmail']); // this is your Email address
$from = 'info@emoapp.info'; // this is the sender's Email address
$subject = 'Forgot Password'; //($_POST['subject']);
//$message = ($_POST['msg']);
$message = "Hey,\nSeems you forgot your password.\nHere is your temporary password.\n" . $newPass . "\n\n Enter this into Vibes app to reset your password. \n Vibes Team \n\n www.emoapp.info \r @Vibes_iOS ";
$headers = "From:" . $from;
mail($email, $subject, $message, $headers);


echo json_encode($data);
?>


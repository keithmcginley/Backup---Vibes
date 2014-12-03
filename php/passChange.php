<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
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

// Change Password
$email = ($_POST['userEmail']);
$newPass = ($_POST['newPass']); // Need to be Hashed
$curPass = ($_POST['curPass']); // Need to be Hashed
$data["status"] = "nok";

    // SELECT password FROM `userTable` WHERE `userEmail` = 'hiace.mcginley@gmail.com'
    $checkMatch = mysql_query("SELECT password FROM userTable WHERE userEmail = '" .$email ."'") or die(mysql_error());
    $row = mysql_fetch_row($checkMatch);
    if ($row[0] === $curPass) { // Update Passwords      
        $result = mysql_query("UPDATE `userTable` SET `password`='" . $newPass . "' WHERE userEmail = '" . $email . "'") or die(mysql_error());
        $data["status"] = "ok";
    } else {
        $data["status"] = "Current Password entered was not correct. ".$row[0];
    }
echo json_encode($data);
?>


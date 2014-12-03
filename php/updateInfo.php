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
// Update User Info
$email = ($_POST['userEmail']);
$firstName = ($_POST['userFirstName']);
$lastName = ($_POST['userLastName']);
$gender = ($_POST['userGender']);
$action = ($_POST['action']);

//UPDATE table_name
$result = mysql_query("UPDATE `userTable` SET `firstName`='" . $firstName . "', `lastName` = '" . $lastName . "', `userGender` = '" . $gender . "' WHERE userEmail = '" . $email . "'") or die(mysql_error());
$data["status"] = "ok";
echo json_encode($data);
?>


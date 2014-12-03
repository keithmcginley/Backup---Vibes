<?
/*
 * Following code will list all the posts on a course
 */

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);




header('Access-Control-Allow-Origin: *');
// array for JSON response
$response = array();

// include db connect class
class DB_CONNECT {

    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }

    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }

    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        define('DB_USER', "u1029802_sensus"); // db user
        define('DB_PASSWORD', ">P<o,P2.qr"); // db password (mention your db password here)
        define('DB_DATABASE', "db1029802_sensus"); // database name
        define('DB_SERVER', "mysql2275int.cp.blacknight.com"); // db server

        // Connecting to mysql database
        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());

        // Selecing database
        $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());

        // returing connection cursor
        return $con;
    }

    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysql_close();
    }
}

// connecting to db
$db = new DB_CONNECT();

    // login form submitted
    // The data["status"] == 'ok' is the echo in json that you send in your PHP to say if the login is correctly or not

    $email = ($_POST['userEmail']);  
    $action = ($_POST['action']);   
    
        $result = mysql_query("SELECT `firstName`, `lastName`, `userGender` FROM `userTable` WHERE userEmail = '".$email."'") or die(mysql_error());     
        while($row = mysql_fetch_array($result)) 
        {
            $data["status"] = "ok";
            $data["firstName"] = $row['firstName'];
            $data["lastName"] = $row['lastName'];
            $data["userGender"] = $row['userGender'];
            echo json_encode($data); 
        }
?>


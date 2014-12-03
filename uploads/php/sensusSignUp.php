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
    $pass = ($_POST['userPass']);  


    $query = mysql_num_rows(mysql_query("SELECT * from userTable WHERE userEmail = '".$email."'"));
    if($query == 0)
    {
        // Place the input statement here   = mysql_query("SELECT * FROM emotionPosts") or die(mysql_error());  
        
        // INSERT INTO `db1029802_sensus`.`userTable` (`userID`, `firstName`, `lastName`, `userEmail`, `password`, `userGender`) VALUES ('1', NULL, NULL, 'test1@gmail.com', 'pass', NULL);
        // VALUES (NULL, NULL, NULL, '1test', 'asss', NULL);
        
        
        //$sqlSignUp = mysql_query("INSERT INTO `userTable`(`userID`, `firstName`, `lastName`, `userEmail`, `password`, `userGender`) VALUES (NULL, NULL, NULL, ".$email.", ".$pass.", NULL)") or die(mysql_error()); 
        $sqlSignUp = mysql_query("INSERT INTO `userTable`(`userID`, `firstName`, `lastName`, `userEmail`, `password`, `userGender`) VALUES (NULL, NULL, NULL, '".$email."', '".$pass."', '0')") or die(mysql_error()); 
        
        $data["status"] = "ok";
        echo json_encode($data);             
    }
    else
    {
        $data["status"] = "nok";
        $data["msg"] = "There is already an account registered to this email. Please log in";
        echo json_encode($data);  
    }
?>


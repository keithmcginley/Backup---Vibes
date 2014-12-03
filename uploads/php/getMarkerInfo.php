<?

/*
 * Following code will list all the posts on a course
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
$postID = ($_POST['postID']);
$action = ($_POST['action']);

//UPDATE table_name
//SET column1=value, column2=value2,...
//WHERE some_column=some_value
$result = mysql_query("SELECT imageName, timeLocal FROM `emotionPosts` WHERE postID = '" . $postID . "'") or die(mysql_error());

    $response["marker"] = array();

$row = mysql_fetch_row($result);
if ($row) {
    $marker = array();
    $marker['imageName'] = $row[0];
    $marker['timeThen'] = $row[1];
    //$date = date("Y/m/d H:i:s");
    //date_default_timezone_set('America/Chicago');
    //$marker['timeNow'] = date('d/m/Y == H:i:s');
    $marker['timeNow'] = gmdate('Y-m-d h:i:s');
    //echo $row[0];
    array_push($response["marker"], $marker);
} else {
    echo 'error';
}
print (json_encode($response));
//        while($row = mysql_fetch_array($result)) 
//        {
//            $data["status"] = "ok";
//            $data["imageSrc"] = $row['imageName'];
//            echo json_encode($data); 
//        } 
?>


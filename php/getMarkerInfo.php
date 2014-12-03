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
// Get Hexgon post info, check weather multi or single call
$postID = ($_POST['postID']);
$action = ($_POST['action']);
$response["marker"] = array();

if ($action == 1) { // 0 Mulit Search
                    // GROUP BY col1, col2, col3
    $result = mysql_query("SELECT imageName, timeLocal FROM `emotionPosts` WHERE postID IN (" . $postID . ") ORDER BY timeServer DESC") or die(mysql_error());
    $row = mysql_fetch_row($result);
    while ($row = mysql_fetch_array($result)) {
        $marker = array();
        $marker['imageName'] = $row[0];
        $marker['timeThen'] = $row[1];
        $marker['timeNow'] = gmdate('Y-m-d H:i:s');
        array_push($response["marker"], $marker);
    }
    print (json_encode($response));
} else { 
    $result = mysql_query("SELECT imageName, timeLocal FROM `emotionPosts` WHERE postID = '" . $postID . "'") or die(mysql_error());
    $row = mysql_fetch_row($result);
    if ($row) {
        $marker = array();
        $marker['imageName'] = $row[0];
        $marker['timeThen'] = $row[1];
        $marker['timeNow'] = gmdate('Y-m-d H:i:s');
        array_push($response["marker"], $marker);
    } else {
        echo 'error';
    }
    print (json_encode($response));
}

?>


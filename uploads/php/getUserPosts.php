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
$userID = ($_POST['userID']);
// get all posts from postTable
$result = mysql_query("SELECT * FROM emotionPosts WHERE userID ='".$userID ."' ORDER BY timeServer DESC") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0)
 {
    // looping through all results
    // posts node
    $response["posts"] = array();

     while ($row = mysql_fetch_array($result)) 
     {
        	// temp post array
            $post = array();
            $post['postID'] = $row['postID'];
            //$post['userID'] = $row['userID'];
            $post['emoType'] = $row['emoType'];
            $post['imageName'] = $row['imageName'];
            $post['songID'] = $row['songID'];
            //$post['public'] = $row['public'];
            $post['lat'] = $row['postLat'];
            $post['long'] = $row['postLong'];
            $post['timeServer'] = $row['timeServer'];
            $post['timeLocal'] = $row['timeLocal'];


       // push single product into final response array
        array_push($response["posts"], $post);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    print (json_encode($response));
    // echo (json_encode($response));

}else {

    // no posts found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no posts JSON
    print (json_encode($response));
    //echo (json_encode($response));
}


?>



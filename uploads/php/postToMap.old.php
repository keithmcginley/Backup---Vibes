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
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());

        // Selecing database
        $db = mysqli_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());

        // returing connection cursor
        return $con;
    }

    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysqli_close();
    }
}

// connecting to db
$db = new DB_CONNECT();

    // Post to Map was clicked
    // The data["status"] == 'ok' is the echo in json that you send in your PHP to say if post was okay
    // The postID is retuned by the mysqli_insert_id

    //$email = ($_POST['userEmail']);
    $email = 'hiace.mcginley@gmail.com';
    $parentEmoji = ($_POST['parentEmoji']);   
    $emojiSentence = ($_POST['emojiSentence']);   
    $imageLocation = ($_POST['imageLocation']);   
    $musicId = ($_POST['musicId']);   
    $postPublic = ($_POST['postPublic']);   
    $postLat = ($_POST['postLat']);   
    $postLong = ($_POST['postLong']);   
    $timeDevice = ($_POST['timeDevice']);
    $action = ($_POST['action']);   
    
        //    INSERT INTO def (catid, title, page, publish) 
        //    SELECT catid, title, 'page','yes' from `abc`;  

        //$result = mysql_query("INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, lat, long, timeLocal ) SELECT userID, '".$parentEmoji ."', '".$emojiSentence."', '".$imageLocation."', '".$musicId."', '".$postPublic."', '".$postLat."', '".$postLong."', '".$timeDevice."' FROM userTable WHERE userEmail = '".$email."'") or die(mysql_error());
        echo "INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, lat, long, timeLocal ) SELECT userID, '3', 'emojiSentence', 'imageLocation', '1234', '1', '52.32', '-6,32', '15:10:12' FROM userTable WHERE userEmail = '".$email."'";
        $result = mysqli_query("INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, lat, long, timeLocal ) SELECT userID, '3', 'emojiSentence', 'imageLocation', '1234', '1', '52.32', '-6,32', '15:10:12' FROM userTable WHERE userEmail = '".$email."'") or die(mysqli_error());
        $data["status"] = "ok";
        $data["postID"] = mysqli_insert_id($link);
        echo json_encode($data); 
?>


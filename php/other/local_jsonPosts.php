<?
/*
 * Following code will list all the posts on a course
 */
header('Access-Control-Allow-Origin: *');
// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/local_db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all posts from postTable
$result = mysql_query("SELECT * FROM emotionPosts") or die(mysql_error());

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
            $post['userID'] = $row['userID'];
            $post['emoType'] = $row['emoType'];
            $post['imageName'] = $row['imageName'];
            $post["moduleNo2"] = $row["moduleNo2"];
            $post["email"] =$row["email"];
            $post['songID'] = $row['songID'];
            $post['public'] = $row['public'];
            $post['lat'] = $row['lat'];
            $post['long'] = $row['long'];
            $post['timerServer'] = $row['timeServer'];
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


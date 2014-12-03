<?
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    header('Access-Control-Allow-Origin: *');

    // connection 
    $con = mysqli_connect("mysql2275int.cp.blacknight.com","u1029802_sensus",">P<o,P2.qr","db1029802_sensus");
    
// Check connection
    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }


    // Post to Map was clicked
    // The data["status"] == 'ok' is the echo in json that you send in your PHP to say if post was okay
    // The postID is retuned by the mysqli_insert_id

    //$email = ($_POST['userEmail']);
    $email = 'hiace.mcginley@gmail.com';
    $parentEmoji = ($_POST['parentEmoji']);   
    //$emojiSentence = ($_POST['emojiSentence']);   
    $imageLocation = ($_POST['imageLocation']);   
    $musicId = ($_POST['musicId']);   
    $postPublic = ($_POST['postPublic']);   
    $postLat = ($_POST['postLat']);   
    $postLong = ($_POST['postLong']);   
    $timeDevice = ($_POST['timeDevice']);
//    $action = ($_POST['action']);   
    

        //$result = mysql_query("INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, lat, long, timeLocal ) SELECT userID, '".$parentEmoji ."', '".$emojiSentence."', '".$imageLocation."', '".$musicId."', '".$postPublic."', '".$postLat."', '".$postLong."', '".$timeDevice."' FROM userTable WHERE userEmail = '".$email."'") or die(mysql_error());
        //echo "INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, lat, long, timeLocal ) SELECT userID, '3', 'emojiSentence', 'imageLocation', '1234', '1', '52.32', '-6,32', '15:10:12' FROM userTable WHERE userEmail = '".$email."'";
        //if (!mysqli_query($con,"INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, lat, `long`, timeLocal ) SELECT userID, '".$parentEmoji ."', '".$emojiSentence."', '".$imageLocation."', '".$musicId."', '".$postPublic."', '".$postLat."', '".$postLong."', '".$timeDevice."' FROM userTable WHERE userEmail = '".$email."'"))
        if (!mysqli_query($con,"INSERT INTO emotionPosts ( userID, emoType, emoji, imageName, songID, public, postLat, postLong, timeLocal ) SELECT userID, '".$parentEmoji ."', 'emojiSentence', '".$imageLocation."', '".$musicId."', '".$postPublic."', '".$postLat."', '".$postLong."', '".$timeDevice."' FROM userTable WHERE userEmail = '".$email."'"))
        {
            echo("Error description: " . mysqli_error($con));
            mysqli_close($con);
        }
 else 
     {
        echo mysqli_insert_id($con);              
        mysqli_close($con);
    }        
?>
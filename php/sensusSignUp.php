<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

header('Access-Control-Allow-Origin: *');

// connection 
$con = mysqli_connect("mysql2275int.cp.blacknight.com", "u1029802_sensus", ">P<o,P2.qr", "db1029802_sensus");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// login form submitted
// The data["status"] == 'ok' is the echo in json that you send in your PHP to say if the login is correctly or not

$email = ($_POST['userEmail']);
$pass = ($_POST['userPass']);


$query = mysqli_num_rows(mysqli_query($con, "SELECT * from userTable WHERE userEmail = '" . $email . "'"));
if ($query == 0) {
    $sqlSignUp = mysqli_query($con, "INSERT INTO `userTable`(`userID`, `firstName`, `lastName`, `userEmail`, `password`, `userGender`) VALUES (NULL, NULL, NULL, '" . $email . "', '" . $pass . "', '0')") or die(mysqli_error());
    if ($sqlSignUp > 0) {
        $id = mysqli_insert_id($con);
        $data["status"] = 'ok';
        $data["ID"] = mysqli_insert_id($con);
    } else {
        $data["status"] = "nok";
        $data["msg"] = "There was an error, please try again.";
    }
    echo json_encode($data);
} else {
    $data["status"] = "nok";
    $data["msg"] = "There is already an account registered to this email. Please log in";
    echo json_encode($data);
}
?>


<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
date_default_timezone_set("Asia/Kuala_Lumpur");

error_reporting(E_ALL^E_NOTICE);

require('connect.php');

if(!$_GET['file']) error('Missing parameter!');
if($_GET['file']{0}=='.') error('Wrong file!');
$clean_filename=mysqli_real_escape_string($conn, $_GET['file']);
if($_GET['folder']=="cache"){
	include 'symlink.php';
	$cache=1;
}
if ($cache){
	$current = $share_folder."/".$today."/".$timenow."_".$rand_64."/".$_GET['file']; 
}
else
{
	$current = $_GET['folder']."/".$_GET['file'];
}
if(file_exists($current))
{
	/* If the visitor is not a search engine, count the downoad: */
	if(!is_bot())
{ 
	$sql = "INSERT INTO download_manager SET filename='"
		.$clean_filename
		."' ON DUPLICATE KEY UPDATE downloads=downloads+1";

if ($conn->query($sql) === TRUE) {

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

	$sql = "SELECT id FROM download_manager WHERE filename = ?";
if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_filename);
            $param_filename = $clean_filename;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id);
                    if(mysqli_stmt_fetch($stmt)){
                            $managerid = $id;
                    }
                } else{
                    $manager_err = "There are no such file with that filename.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

}

$userid = $_SESSION["id"];
$userip = $_SERVER['REMOTE_ADDR'];
$sql = "INSERT INTO download_history (manager_id, user_id, remote_addr)
                VALUE (".$managerid.",".$userid.",'".$userip."')";

if(mysqli_query($conn, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

//$conn->close();
} 

	header("Location: ".$current);
	exit;
}
else{
	error("This file does not exist!");
}


function error($str)
{
	die($str);
}


function is_bot()
{
	/* This function will check whether the visitor is a search engine robot */
	
	$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
	"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
	"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
	"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
	"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
	"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
	"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
	"Butterfly","Twitturls","Me.dium","Twiceler");

	foreach($botlist as $bot)
	{
		if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
		return true;	// Is a bot
	}

	return false;	// Not a bot
}

close_connection();
?>

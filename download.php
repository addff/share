<?php

error_reporting(E_ALL^E_NOTICE);

require('connect.php');

if(!$_GET['file']) error('Missing parameter!');
if($_GET['file']{0}=='.') error('Wrong file!');
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
	$sql = "INSERT INTO download_manager SET filename='".$_GET['file']."' ON DUPLICATE KEY UPDATE downloads=downloads+1";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

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
?>

<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

error_reporting(E_ALL^E_NOTICE);

require 'lib/connect.php';
require 'lib/enc.php';

$id=encrypt_decrypt('decrypt', $_GET['dua']);
$sql2="SELECT path FROM pages WHERE id =".$id.";";

if ($result2=mysqli_query($conn,$sql2))
  {
  // Fetch one and one row
  while ($row2=mysqli_fetch_row($result2))
    {
    $directory = $row2[0];
    }
  // Free result set
  mysqli_free_result($result2);
}


$directory="/home/shah/demo-files-replace-this-as-movie";
//$directory="/home/shah/z/share/files";
$extension='';
$files_array = array();
$dir_handle = @opendir($directory) or die("There is an error with your file directory!");



while ($file = readdir($dir_handle))
{
        if($file{0}=='.') continue;

        $parts = explode('.',$file);
        $extension = strtolower(end($parts));

        if($extension == 'php') continue;

        $files_array[]=$file;
}

sort($files_array,SORT_STRING);

$file_downloads=array();

$sql = "SELECT * FROM download_manager"; 
$result = $conn->query($sql); 

if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
        $file_downloads[$row['filename']]=$row['downloads']; 
    } 
} else { 
    echo "0 results"; 
} 
close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP &amp; MySQL File Download Counter | Tutorialzine demo</title>

<link rel="stylesheet" type="text/css" href="lib/styles/styles.css" />
<link rel="stylesheet" type="text/css" href="lib/styles/fancybox/jquery.fancybox-1.2.6.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="lib/scripts/script.js"></script>

</head>

<body>
<?php
if ($debug){
?>
id=<?=$_GET['dua']?>(encrypt)
<br>
id=<?=encrypt_decrypt('decrypt', $_GET['dua']);?>
<br>
dir=<?=$directory?>	
<?php
}
?>

<div id="file-manager">

    <ul class="manager">
<?php
include 'lib/enc.php';
$plain_txt = $directory;
$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);

function all_downloads() { 
	global $files_array;
	global $file_downloads;
	global $encrypted_txt;
	
	foreach ($files_array as $val) { 
		echo '<li><a href="lib/download.php?key='.$encrypted_txt.'&folder=cache&file='.urlencode($val).'">'.$val
			.'<span class="download-count" title="Times Downloaded">'
     			.(int)$file_downloads[$val]
			.'</span> <span class="download-label">right click to download</span></a></li>'; 
	} 
} 

all_downloads() ;
?>
  </ul>

</div>
</body>
</html>




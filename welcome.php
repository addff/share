<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Adik Kakak</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ background-color:#D3D3D3; font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body><p>&nbsp;</p>

<div align="right">
Welcome <?=$_SESSION["username"];?> &nbsp; &nbsp;<br><!-- <?=$_SERVER['REMOTE_ADDR'];?> &nbsp; &nbsp;<br> -->
<a href="reset.php">reset password</a> | <a href="logout.php">logout</a> &nbsp; &nbsp;
</div>
<?php
include "dua.php";
if(isset($_POST['thepage'])){
	if($debug){
?>
id=<?=$_POST['thepage']?>
<?php
	}
?>
<iframe src="tiga.php?dua=<?=$_POST['thepage']?>" height="500px" width="100%" style="border:none;">></iframe>
<?
}
?>
</body></html>

<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div align="center">
<form action = "welcome.php" method="post">
<input type="submit" name="thepage" value="Demo">
<input type="submit" name="thepage" value="Movie">
</form>
</div>

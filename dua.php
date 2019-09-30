<?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div align="center">
<form action = "welcome.php" method="post">

<?php
	require('lib/connect.php');
	$userid = $_SESSION["id"];
        $sql = "SELECT pagename FROM pages WHERE userid = ".$userid;
	if ($result = mysqli_query($conn, $sql))
		while($row = mysqli_fetch_row($result)){
			if($row[0]=="Demo"){
?>
<input type="submit" name="thepage" value="<?=$row[0]?>">
<?php
			}
			else{
?>
<button name="thepage" type="submit" value="tiga"><?=$row[0]?></button>
<?php
}
		}
	mysqli_free_result($result);
	close_connection();

?>

</form>
</div>

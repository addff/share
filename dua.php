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
        $sql = "SELECT pagename, id FROM pages WHERE userid = ".$userid;
	$result = $conn->query($sql);
	while($row = $result->fetch_array()){
		$rows[] = $row;
	}
		
	foreach($rows as $row){
?>
<button name="thepage" type="submit" value="<?=$row['id']?>"><?=$row['pagename']?></button>
<?php
	}
	$result->close();
	close_connection();

?>
</form>
</div>

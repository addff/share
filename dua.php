<?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$userid = $_SESSION["id"];
require('connect.php');
?>

<div align="center">
<form action = "tiga.php" method="post">
<?php
$sql = "SELECT pagename FROM pages WHERE userid=".$userid.";";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
<input type="submit" name="thepage" value="<?=$row['pagename'];?>">
<?php
}
}
close_connection();
?>

</form>
</div>

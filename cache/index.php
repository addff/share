<?php
require('../connect.php');

$sql = "UPDATE download_manager SET downloads=downloads+1 WHERE id=10";
if ($conn->query($sql) === TRUE) {
//    echo "New record updated successfully";
} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
}

close_connection();

$sql = "SELECT * FROM download_manager WHERE id=10";
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



<div align="center">
<h1>Intruder Detected (<?=$file_downloads['cache'];?>) </h1>
</div>

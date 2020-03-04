<?php
require('lib/connect.php');
$userid = 0;


$sir = 1;
// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif' , 'zip', 'mp4', 'srt', 'pptx', 'txt');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	if($sir){
		
		$newname = md5_file($_FILES['upl']['tmp_name']);

		$sql = "SELECT COUNT(*) AS total_count FROM files WHERE md5_checksum = ".$newname;
		$result=mysqli_query($con,$sql);
		$data=mysqli_fetch_assoc($result);
		//echo $data['total']; 
		if($data['total']){

		$directoryName = 'F:\sharedata/alldata/'.substr($newname, 0, 1).'/'.substr($newname, 0, 2).'/'.substr($newname, 0, 3);
 
		//Check if the directory already exists.
		if(!is_dir($directoryName)){
    		//Directory does not exist, so lets create it.
    		mkdir($directoryName, 0755, true);
		}

		if(move_uploaded_file($_FILES['upl']['tmp_name'], $directoryName.'/'.$newname)){
			
			echo '{"status":"success"}';
			exit;
		}
		}
		else{
			echo $data['total'];
		}	

	}
	else{
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
		echo '{"status":"success"}';
		exit;
	}
	}
}

echo '{"status":"error"}';
exit;
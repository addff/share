<?php

include 'enc.php';

$share_folder = "cache";
//$directory="/home/shah/demo-files-replace-this-as-movie";
//$directory="/home/shah/201908-August";
//$directory="/home/shah/201909-September";
$directory=encrypt_decrypt('decrypt', $_GET['key']);
date_default_timezone_set("Asia/Kuala_Lumpur");


function create_folder($newdir){
 if (file_exists($newdir)) {
            echo "The file $file_pointer exists";
        }else {
                mkdir($newdir, 0755);
                touch($newdir."/index.html");
 }
}


$today = date("Y-m-d");
$timenow = date("his");
$folder_date = __DIR__."/".$share_folder."/".$today;
create_folder($folder_date);


$permitted_chars = '_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$rand_64 = substr(str_shuffle($permitted_chars), 0, 64);
$folder_64 = $folder_date."/".$timenow."_".$rand_64;
create_folder($folder_64);

$target = $directory."/".$clean_filename;
$link = $folder_64."/".$clean_filename;


symlink($target, $link);

?>


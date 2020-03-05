<?php
require( 'lib/connect.php' );
$userid = 0;
$testingg = 0;

function logsir( $current_log, $current_status ) {
    global $userid;
    global $conn;

    $sql0 = "INSERT INTO logs (all_user_id, all_logs, all_status) VALUES ($userid, '$current_log', '$current_status')";

    if ( $conn->query( $sql0 ) === TRUE ) {
        echo 'New record created successfully';
    } else {
        echo 'Error: ' . $sql0 . '<br>' . $conn->error;
    }

}

$sir = 1;
logsir( 'baca sir = 1', 'starting' );
// A list of permitted file extensions
$allowed = array( 'png', 'jpg', 'gif', 'zip', 'mp4', 'srt', 'pptx', 'txt' );

if ( isset( $_FILES['upl'] ) && $_FILES['upl']['error'] == 0 ) {
    logsir( 'baca isset', 'loading' );
    if ( $sir ) {
        $realName = $_FILES['upl']['name'];
        //$realType = $_FILES['upl']['type'];
        $realPath1 = $_FILES['upl']['name'];
        $realExt = pathinfo($realPath1, PATHINFO_EXTENSION);
        //$realPath2 = fopen($_FILES["UploadFileName"]["name"], 'r');
        logsir( 'baca sir == 1 | filename = '.$realName.' | ext = '.$realExt.' | path = '.$realPath1, 'loading' );

        $newname = md5_file( $_FILES['upl']['tmp_name'] );

        $sql1 = "SELECT COUNT(*) AS total_count FROM logs WHERE all_status = 'success'";

        //$sql1 = 'SELECT COUNT(*) AS total_count FROM files WHERE md5_checksum = '.$newname;
        $result = mysqli_query( $conn, $sql1 );
        $data = mysqli_fetch_assoc( $result );
        //echo $data['total_count'];

        logsir( 'md5 = '.$newname, 'success' );
        logsir( 'count existing md5 = '.$data['total_count'], 'success' );

        if ( true ) {
            //if ( $data['total_count'] == 0 ) {
            //    echo $data['total_count'];
            //} else if ( $data['total_count'] == 0 ) {
            $driveName = 'H:';
            $sharePath = $driveName;
            $directoryShare = 'sharedata/alldata/'.substr( $newname, 0, 1 ).'/'.substr( $newname, 0, 2 ).'/'.substr( $newname, 0, 3 );
            $directoryName = $sharePath.'/'.$directoryShare;
              
            //Check if the directory already exists.
            if ( !is_dir( $directoryName ) ) {
                //Directory does not exist, so lets create it.
                mkdir( $directoryName, 0755, true );
            }

            $fff = 'hhhh';

            if ( $testingg ) {
                $sql2 = "INSERT INTO testingg (apa_apa_jer) VALUES ('Malu Apa Bossku')";
            } else {
                $sql2 = "INSERT INTO files (filenamefullpath, real_path, real_type, md5_checksum) VALUES ('$directoryName','$realPath','$realType','$newname')";
            }

            if ( $conn->query( $sql2 ) === TRUE ) {
                echo 'New record created successfully';
            } else {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }

            if ( move_uploaded_file( $_FILES['upl']['tmp_name'], $directoryName.'/'.$newname ) ) {

                echo '{"status":"success"}';
                exit;
            }

        } else {
            echo 'error bossku';
            exit;
        }

    } else {
        logsir( 'baca sir != 1', 'loading' );
        $extension = pathinfo( $_FILES['upl']['name'], PATHINFO_EXTENSION );

        if ( !in_array( strtolower( $extension ), $allowed ) ) {
            echo '{"status":"error"}';
            exit;
        }

        if ( move_uploaded_file( $_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'] ) ) {
            echo '{"status":"success"}';
            exit;
        }
        $conn->close();
    }
}

logsir( 'no loading', 'error' );
echo '{"status":"error"}';
exit;
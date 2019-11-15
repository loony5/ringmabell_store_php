<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $no = $_POST['no'];
    $photo = $_POST['photo'];

    $path = "profile_image/$no.jpeg";
    $finalPath = "http://".$path;

    require_once 'connect.php';

    $sql = "update stores_table set photo = '$finalPath' where no='$no'";

    if (mysqli_query($conn, $sql)) {

        // file_put contentes : 이미지 저장
        if (file_put_contents($path, base64_decode($photo))) {

            $result['success'] = "1";
            $result['message'] = "success";

            echo json_encode($result);
            mysqli_close($conn);

        } else {

            $result['success'] = "0";
            $result['message'] = "error";

            echo json_encode($result);
            mysqli_close($conn);

        }

    }

}

?>
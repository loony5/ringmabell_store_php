<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $no = $_POST['no'];

    // 쌍따옴표 제거
    $string = str_replace("\"", "", $no);

    $path = "profile_image/";
    $pathplus = "profile_image/$string.jpeg";
    $finalPath = "http://".$pathplus;

    $file_path = $path.basename($_FILES['photo']['name']);
    

    require_once 'connect.php';

    $sql = "update stores_table set photo = '$finalPath' where no='$string'";

    if (mysqli_query($conn, $sql)) {
        
        // file_put contentes : 이미지 저장
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $file_path)) {

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
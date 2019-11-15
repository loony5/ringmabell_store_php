<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $storeNo = $_POST['storeNo'];
        $storeName = $_POST['storeName'];
        $startTime = $_POST['startTime'];
        $finishTime = $_POST['finishTime'];
        $personalDay = $_POST['personalDay'];
        $address = $_POST['address'];
        $introduce = $_POST['introduce'];

        // $string = str_replace("\"", "", $storeNo);
        // $str_storeName = str_replace("\"", "", $storeName);
        // $str_startTime = str_replace("\"", "", $startTime);
        // $str_finishTime = str_replace("\"", "", $finishTime);
        // $str_personalDay = str_replace("\"", "", $personalDay);
        // $str_address = str_replace("\"", "", $address);
        // $str_introduce = str_replace("\"", "", $introduce);

        require_once 'connect.php';

        $query = "select * from stores_info where storeNo = '$storeNo'";

        $res = mysqli_query($conn, $query);

        if(mysqli_num_rows($res) == 1) {

            $result['success'] = "2";
            $result['message'] = "exist";

            echo json_encode($result);
            mysqli_close($conn);

        } else {

            $sql = "insert into stores_info(storeNo, storeName, startTime,
            finishTime, personalDay, address, introduce) values 
            ('$storeNo', '$storeName', '$startTime', '$finishTime',
            '$personalDay', '$address', '$introduce')";

            if(mysqli_query($conn, $sql)) {

                $result['success'] = "1";
                $result['message'] = "success";

                echo json_encode($result);
                mysqli_close($conn);

            } else {

                $result['success'] = $string;
                $result['message'] = "error";

                echo json_encode($result);
                mysqli_close($conn);
            }
        }
    }

?>
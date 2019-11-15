<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $storeNo = $_POST['storeNo'];

    require_once 'connect.php';

    $sql = "select *from stores_info where storeNo = '$storeNo'";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['read'] = array();

    if(mysqli_num_rows($response) == 1) {

        if($row = mysqli_fetch_assoc($response)) {

            $h['storeNo'] = $row['storeNo'];
            $h['storeName'] = $row['storeName'];
            $h['startTime'] = $row['startTime'];
            $h['finishTime'] = $row ['finishTime'];
            $h['personalDay'] = $row ['personalDay'];
            $h['address'] = $row['address'];
            $h['introduce'] = $row['introduce'];

            array_push($result['read'], $h);

            $result['success'] ="1";
            echo json_encode($result);

        }
    } 

} else {

    $result['success'] = "0";
    $result['message'] = "error";

    echo json_encode($result);

    mysqli_close($conn);


}

?>
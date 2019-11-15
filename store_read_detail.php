<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $no = $_POST['no'];

    require_once 'connect.php';

    $sql = "select *from stores_table where no = '$no'";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['read'] = array();

    if(mysqli_num_rows($response) == 1) {

        if($row = mysqli_fetch_assoc($response)) {

            $h['no'] = $row['no'];
            $h['id'] = $row['id'];
            $h['name'] = $row['name'];
            $h['email'] = $row ['email'];
            $h['phone'] = $row ['phone'];
            $h['photo'] = $row['photo'];

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
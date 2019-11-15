<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // 안드로이드에서 받아온 POST 값을 변수에 담는다.
        $id = $_POST['id'];
        $password = $_POST['password'];

        // mysql 연결
        require_once 'connect.php';

        $sql = "select * from stores_table where id = '$id'";

        $response = mysqli_query($conn, $sql);

        $result = array();
        $result['detail'] = array();

        if(mysqli_num_rows($response) == 1) {

            $row = mysqli_fetch_assoc($response);

            if(password_verify($password, $row['password'])){

                $index['no'] = $row['no'];
                $index['id'] = $row['id'];
                $index['email'] = $row['email'];
                $index['name'] = $row['name'];
                $index['phone'] = $row['phone'];
                $index['photo'] = $row['photo'];
                

                array_push($result['detail'], $index);

                $result['success'] = true;
                $result['message'] = "success";
                echo json_encode($result);

                mysqli_close($conn);

            } else {

                $result['success'] = false;
                $result['message'] = "error";
                echo json_encode($result);

                mysqli_close($conn);
            }
        } else {

            $result['success'] = false;
            $result['message'] = "empty";
            echo json_encode($result);
            
            mysqli_close($conn);
        }
    }

?>

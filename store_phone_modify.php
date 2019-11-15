<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $no = $_POST['no'];
        $phone = $_POST['phone'];

        require_once 'connect.php';

        $sql = "select * from stores_table where phone = '$phone'";

        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) == 0) {

            $query = "update stores_table set phone = '$phone' where no = '$no'";
            $res_02 = mysqli_query($conn, $query);

            if($res_02) {

                $result["success"] = true;
                $result["message"] = "success";

                echo json_encode($result);
                mysqli_close($conn);

            } else {

                $result["success"] = false;
                $result["message"] = "error";

                echo json_encode($result);
                mysqli_close($conn);


            }

        } else {

            $result["success"] = false;
            $result["message"] = "exist";

            echo json_encode($result);
            mysqli_close($conn);

        
            
        }
    }
?>
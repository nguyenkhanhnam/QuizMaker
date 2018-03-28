<?php
    //require('dbconnect.php');

    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];
    $data= array();
   
    switch($method){
        case 'GET': {
            $connection= mysqli_connect("localhost", "root", "", "assignment");

        //     $sql =  "SELECT * FROM `courses`";
        // //    $response = array();
        //     $result = mysqli_query($connection, $sql);
        //     // header('Content-Type: application/json');
        //     while($row = mysqli_fetch_array($result)){
                
        //         $response["id"]= $row['id'];
        //         $response["code"]= $row['code'];
        //         echo "meos";
        //     }

            // $data= array(
            //     array('name1' => "phat", 'name2' => "nam"),
            //     array('name1' => "phat1",  'name2' => "nam")
            // );

            array_push($data, array('name1' => "phat", 'name2' => "nam"));
            array_push($data, array('name1' => "pha1t", 'name2' => "nam1"));
           
            echo json_encode($data);
            // echo "meo2";
            break;
        }
        case 'POST': {
            $code = trim($_POST["code"], " \t\n\r\0\x0B");
            $name = $_POST["name"];
            $sql = "INSERT INTO courses (name, code) VALUES ('$name','$code')";
           
            if ($connection->query($sql) === TRUE) {
                return var_dump(http_response_code(200));
            } else {
                return var_dump(http_response_code(409));
            }
        }
    }
?>
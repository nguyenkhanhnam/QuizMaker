<?php
    require_once('./dbconnect.php');
    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];

    switch($method){
        case 'POST':{
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
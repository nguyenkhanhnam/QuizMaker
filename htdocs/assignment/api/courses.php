﻿<?php
    //require('dbconnect.php');
    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];
    $data= array();
    $connection= mysqli_connect("localhost", "root", "", "assignment");

    switch($method){
        case 'GET': {
            $sql =  "SELECT * FROM `courses`";
            //    $response = array();
            $result = mysqli_query($connection, $sql);
            header('Content-Type: text/html; charset=utf-8');
            while($row = mysqli_fetch_array($result)){
                array_push($data, array('code' => $row["code"], 'name' => $row["name"]));
            }

            echo json_encode($data);
            break;
        }
        case 'POST': {
            $code = trim($_POST["code"], " \t\n\r\0\x0B");
            $name = $_POST["name"];
            $sql = "INSERT INTO `courses` (name, code) VALUES ('$name','$code')";
           
            if ($connection->query($sql) === TRUE) {
                return var_dump(http_response_code(200));
            } else {
                return var_dump(http_response_code(409));
            }
        }
    }
?>
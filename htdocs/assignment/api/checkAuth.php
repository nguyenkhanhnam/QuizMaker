<?php
    session_start();
    require_once('jwt.php');
    function isLoggedIn($token){
        if(JWT::verifyJWT($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            $username = $json_payload['username'];
            $connection = mysqli_connect("localhost", "root", "", "assignment");
            $sql =  "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) == 1){
                return true;
            }
            return false;
        }
        return false;
    }

    function isAdminLoggedIn($token){
        if(isLoggedIn($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            // if($json_payload['role'] == 0){
            //     return true;
            // }
            $username = $json_payload['username'];
            $connection = mysqli_connect("localhost", "root", "", "assignment");
            $sql =  "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_array($result)){
                    if($row['role'] == 0){
                        return true;
                    }
                }
            }
            return false;
        }
        return false;
    }

    function isUserLoggedIn($token){
        if(isLoggedIn($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            // if($json_payload['role'] == 1){
            //     return true;
            // }
            $username = $json_payload['username'];
            $connection = mysqli_connect("localhost", "root", "", "assignment");
            $sql =  "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_array($result)){
                    if($row['role'] == 1){
                        return true;
                    }
                }
            }
            return false;
        }
        return false;
    }

    function isStaffLoggedIn($token){
        if(isLoggedIn($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            // if($json_payload['role'] == 1){
            //     return true;
            // }
            $username = $json_payload['username'];
            $connection = mysqli_connect("localhost", "root", "", "assignment");
            $sql =  "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_array($result)){
                    if($row['role'] == 2){
                        return true;
                    }
                }
            }
            return false;
        }
        return false;
    }
?>
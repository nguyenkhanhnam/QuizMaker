<?php
    session_start();
    function isLoggedIn($token){
        if(JWT::verifyJWT($token)){
            return true;
        }
        return false;
    }

    function isAdminLoggedIn($token){
        if(isLoggedIn($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            if($json_payload['role'] == 0){
                return true;
            }
        }
        return false;
    }

    function isUserLoggedIn($token){
        if(isLoggedIn($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            if($json_payload['role'] == 1){
                return true;
            }
        }
        return false;
    }

    function isStaffLoggedIn($token){
        if(isLoggedIn($token)){
            $payload = JWT::getPayload($token);
            $decoded_payload = base64_decode($payload);
            $json_payload = json_decode($decoded_payload, true);
            if($json_payload['role'] == 1){
                return true;
            }
        }
        return false;
    }
?>
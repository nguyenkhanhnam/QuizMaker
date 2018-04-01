<?php
    session_start();
    require_once('./jwt.php');
?>
<?php
    function isLogined(){
        if(isset($_SESSION['token'])){
            $token = $_SESSION['token'];
            if(JWT::verifyJWT($token)){
                return true;
            }
        }
        return false;
    }

    function isAdminLogined(){
        if(isset($_SESSION['token'])){
            $token = $_SESSION['token'];
            if(JWT::verifyJWT($token)){
                $payload = JWT::getPayload($token);
                $decoded_payload = base64_decode($payload);
                $json_payload = json_decode($decoded_payload, true);
                if($json_payload['role'] == 0){
                   return true;
                }
            }
        }
        return false;
    }

    function isUserLogined(){
        if(isset($_SESSION['token'])){
            $token = $_SESSION['token'];
            if(JWT::verifyJWT($token)){
                $payload = JWT::getPayload($token);
                $decoded_payload = base64_decode($payload);
                $json_payload = json_decode($decoded_payload, true);
                if($json_payload['role'] == 1){
                   return true;
                }
            }
        }
        return false;
    }

    function isStaffLogined(){
        if(isset($_SESSION['token'])){
            $token = $_SESSION['token'];
            if(JWT::verifyJWT($token)){
                $payload = JWT::getPayload($token);
                $decoded_payload = base64_decode($payload);
                $json_payload = json_decode($decoded_payload, true);
                if($json_payload['role'] == 2){
                   return true;
                }
            }
        }
        return false;
    }
?>
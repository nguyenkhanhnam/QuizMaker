<?php
    require_once('./checkAuth.php');
    require_once('./dbconnect.php');
    // require_once('./jwt.php');
?>

<?php
    $method = $_SERVER['REQUEST_METHOD'];
    $connection= mysqli_connect("localhost", "root", "", "assignment");

    switch($method){
        case 'CHANGE': {
            if(isset($_SESSION['token'])){
                $token = $_SESSION['token'];
                if(!isLoggedIn($token)){
                    http_response_code(401);
                    return var_dump(http_response_code());
                }
            }
            else {
                http_response_code(401);
                return var_dump(http_response_code());
            }
            parse_str(file_get_contents('php://input'), $_CHANGE);
            
            if(empty($_CHANGE['password']) || empty($_CHANGE['currentPassword'])){
                return var_dump(http_response_code(400));
            }

            $username= $_SESSION["username"];
            $password = mysqli_real_escape_string($connection,$_CHANGE['password']);
            $current_password = mysqli_real_escape_string($connection,$_CHANGE['currentPassword']);

            $sql = "SELECT * FROM `users` WHERE username='$username' AND `password`='$current_password';";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);

            if($count == 1){
                $sql= "UPDATE `users` SET `password`= '$password' WHERE username= '$username';";

                if ($connection->query($sql) === TRUE) {
                    $data = array('status' => http_response_code(200), 'message' => 'Password changed successfully');
                    echo json_encode($data);
                    return;
                } else {
                    $data = array('status' => http_response_code(500), 'message' => 'Password changed failed. Please try again later.');
                    echo json_encode($data);
                    return;
                }
            }
            else {
                $data = array('status' => http_response_code(402), 'message' => 'Wrong password');
                echo json_encode($data);
                return;
            }
        }
    }
?>
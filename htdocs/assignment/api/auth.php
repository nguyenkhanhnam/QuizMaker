<?php
    require_once('./checkAuth.php');
    require_once('./dbconnect.php');
    require_once('./jwt.php');
?>
<?php
    $method = $_SERVER['REQUEST_METHOD'];
    $connection= mysqli_connect("localhost", "root", "", "assignment");

    switch($method){
        case 'POST': {
            if(empty($_POST['username']) || empty($_POST['password'])){
                return var_dump(http_response_code(400));
            }

            //Getting Input value
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);

            //Checking Login Detail
            $sql = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $count = mysqli_num_rows($result);
            if($count == 1){
                $payload = array('username' => $row['username'], 'role' => $row['role']);
                $token = JWT::generateJWT($payload);
                $_SESSION['token'] = $token;
                $_SESSION['role'] = $row['role'];
                $data = array('status' => http_response_code(200), 'message' => 'Logged in successfully');
                echo json_encode($data);
                return;
            }
            else {
                $data = array('status' => http_response_code(401), 'message' => 'Wrong username or password');
                echo json_encode($data);
                return;
            }
        }
    }
?>
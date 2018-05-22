<?php
    require_once('./checkAuth.php');
    require_once('./dbconnect.php');
    require_once('./jwt.php');
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 

    require_once('./PHPMailer/src/Exception.php'); 
    require_once('./PHPMailer/src/PHPMailer.php'); 
    require_once('./PHPMailer/src/SMTP.php'); 
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
                $_SESSION['username'] = $row['username'];

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
        break;

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
        break;

        case 'FORGET': {
            parse_str(file_get_contents('php://input'), $_FORGET);

            $username= $_FORGET['username'];
            $sql= "SELECT email FROM `users` WHERE username= '$username';";
            $result= mysqli_query($connection, $sql);
            $count= mysqli_num_rows($result);
            $row= mysqli_fetch_assoc($result);

            if($count !== 1){
                $data= array('status' => http_response_code(404), 'message' => 'Account not found.');
                echo json_encode($data);
                return;
            }

            $date= new DateTime();
            $now= $date->getTimestamp();
            // Generate verify code by hash username and timestamp in md5 algo
            $verify_code= md5($username . $now);

            $sql= "INSERT INTO `verify_code_forget_password` VALUES ('$username', '$verify_code', $now, $now+ 300);";

            if($connection->query($sql) !== TRUE){
                $data= array('status' => http_response_code(500), 'message' => 'Something wrong! I have no idea.');
                echo json_encode($data);
                return;
            }

            $content= $verify_code . ':' . $now;
            $mail = new PHPMailer(); // create a new object 
            $mail->isSMTP(); // enable SMTP 
            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only 
            $mail->SMTPAuth = true; // authentication enabled 
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail 
            $mail->Host = "smtp.gmail.com"; 
            $mail->Port = 465; // or 587 
            $mail->isHTML(true); 
            $mail->Username = "quizmaker.no.reply@gmail.com"; 
            $mail->Password = "Xk52mBYgEpLprekT"; 
            $mail->setFrom('quizmaker.no.reply@gmail.com', 'QuizMaker'); 
            $mail->Subject = "Verify Code"; 
            $mail->Body = $content; 
            $mail->addAddress($row["email"]); 
 
            if(!$mail->send()) { 
                $data= array('status' => http_response_code(403), 'message' => 'Cannot send verify code, please try again.');
                echo json_encode($data);
                return;
            }
            $data= array('status' => http_response_code(200), 'message' => 'Verification Code sent.');
            echo json_encode($data);
            return;
        }
        break;

        case 'VERIFY': {
            parse_str(file_get_contents('php://input'), $_VERIFY);
            $time= new DateTime();
            $current_time= $time -> getTimestamp();

            $username= $_VERIFY["username"];
            $vcode= $_VERIFY["vcode"];

            $code_parse= explode(':', $vcode);
            $code= $code_parse[0];
            $send_time= (int)$code_parse[1];
            $sql= "SELECT * FROM `verify_code_forget_password` WHERE username= '$username' AND send_time= $send_time;";

            $result= mysqli_query($connection, $sql);
            // $count= mysqli_num_rows($result);

            if(mysqli_num_rows($result) < 1){
                $data= array('status' => http_response_code(400), 'message' => "Invalid verification code");
                echo json_encode($data);
                return;
            }
            
            while($row= mysqli_fetch_assoc($result)){
                if(($row["verify_code"] == $code) && ($row["expiration_time"] >= $current_time)){
                // if(strcmp($row["verify_code"], $code) && (int)$row["expiration_time"] >= (int)$current_time){
                    $new_password= rand(1000,9999);

                    //Set new email
                    $sql= "UPDATE `users` SET `password`= '$new_password' WHERE username= '$username';";
                    if($connection->query($sql) !== TRUE){
                        $data= array('status' => http_response_code(500), 'message' => 'Something wrong! I have no idea.');
                        echo json_encode($data);
                        return;
                    }

                    //Get email
                    $sql= "SELECT email FROM `users` WHERE username= '$username';";
                    $result= mysqli_query($connection, $sql);
                    $count= mysqli_num_rows($result);
                    $row1= mysqli_fetch_assoc($result);
        
                    if($count !== 1){
                        $data= array('status' => http_response_code(404), 'message' => 'Email not found.');
                        echo json_encode($data);
                        return;
                    }
                    $email= $row1["email"];

                    $mail = new PHPMailer(); // create a new object 
                    $mail->isSMTP(); // enable SMTP 
                    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only 
                    $mail->SMTPAuth = true; // authentication enabled 
                    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail 
                    $mail->Host = "smtp.gmail.com"; 
                    $mail->Port = 465; // or 587 
                    $mail->isHTML(true); 
                    $mail->Username = "quizmaker.no.reply@gmail.com"; 
                    $mail->Password = "Xk52mBYgEpLprekT"; 
                    $mail->setFrom('from@example.com', 'Mailer'); 
                    $mail->Subject = "Reset Password"; 
                    $mail->Body = "Your password was reset to: <b>" . $new_password . "</b>";
                    $mail->addAddress($email); 
        
                    if(!$mail->send()) { 
                        $data= array('status' => http_response_code(403), 'message' => 'Cannot send verify code, please try again.');
                        echo json_encode($data);
                        return;
                    }

                    $data= array('status' => http_response_code(200), 'message' => 'Reset password successfully.');
                    echo json_encode($data);
                    return;
                }
            }

            $data= array('status' => http_response_code(400), 'message' => 'Invalid verification code or code expired.');
            echo json_encode($data);
            return;
        }
        break;
    }

?>
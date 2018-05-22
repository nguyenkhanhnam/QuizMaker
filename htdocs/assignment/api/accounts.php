<?php
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 

    require_once('./PHPMailer/src/Exception.php'); 
    require_once('./PHPMailer/src/PHPMailer.php'); 
    require_once('./PHPMailer/src/SMTP.php'); 
    require_once('./checkAuth.php');
?>
<?php
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
    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];
    $data = array();
    $connection = mysqli_connect("localhost", "root", "", "assignment");
	
	function isValidEmail($email){
		if(preg_match('/^[A-Za-z0-9]+[A-Za-z0-9\_]*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)+$/', $email))
        	return true;
        // if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return true;
        //   }
		return false;
	}
	
	function isValidPhone($phone){
		if(preg_match('/^[0-9]{10,11}?$/', $phone))
			return true;
		return false;
	}

    switch($method){
        case 'GET': {
            if(empty($_GET["username"])){
                $sql =  "SELECT * FROM `users`";
                $result = mysqli_query($connection, $sql);
                header('Content-Type: text/html; charset=utf-8');
                while($row = mysqli_fetch_array($result)){
                    array_push($data, array('id' => $row["id"]
											, 'username' => $row["username"]
											, 'role' => $row["role"]
											, 'firstname' => $row["firstname"]
											, 'lastname' => $row["lastname"]
											, 'middlename' => $row["middlename"]
											, 'dateofbirth' => $row["dateofbirth"]
											, 'address' => $row["address"]
											, 'phone' => $row["phone"]
											, 'email' => $row["email"]));
                }
                echo json_encode($data);
                break;
            }
            else {
                $username = $_GET['username'];
                $sql =  "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
                $result = mysqli_query($connection, $sql);
                if(mysqli_num_rows($result) == 1){
                    while($row = mysqli_fetch_array($result)){
                        $data = array('id' => $row["id"]
											, 'username' => $row["username"]
											, 'role' => $row["role"]
											, 'firstname' => $row["firstname"]
											, 'lastname' => $row["lastname"]
											, 'middlename' => $row["middlename"]
											, 'dateofbirth' => $row["dateofbirth"]
											, 'address' => $row["address"]
											, 'phone' => $row["phone"]
											, 'email' => $row["email"]);
                    }
                    echo json_encode($data);
                }
                else {
                    var_dump(http_response_code(404));
                }
                break;
            }
        }
        case 'POST': {
            if(!isAdminLoggedIn($token)){
                $data = array('status' => http_response_code(403), 'message' => 'Invalid request');
                echo json_encode($data);
                return;
            }

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $middlename = $_POST["middlename"];
            $role= $_POST["role"];
            $dateofbirth= $_POST["dateofbirth"];
            $address= $_POST["address"];
            $email= $_POST["email"];
            $phone= $_POST["phone"];
            $username= '';
            $password= '';

            if(!isValidPhone($phone) || !isValidEmail($email)){
                return var_dump(http_response_code(400));
            }

            $sql= "CALL sp_set_account_info('$role', '$firstname', '$lastname', '$middlename', '$dateofbirth', '$address', '$phone', '$email', @username, @password);";
           
            if ($connection->query($sql) === TRUE) {
                $sql= "SELECT @username, @password;";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) == 1){
                    while($row = mysqli_fetch_assoc($result)){
                        $username= $row["@username"];
                        $password= $row["@password"];
                    }
                }

                $mail = new PHPMailer(); // create a new object 
                $mail->isSMTP(); // enable SMTP 
                $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only 
                $mail->SMTPAuth = true; // authentication enabled 
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail 
                $mail->Host = "smtp.gmail.com"; 
                $mail->Port = 465; // or 587 
                $mail->isHTML(true); 
                $mail->Username = "quizmaker.no.reply@gmail.com"; 
                $mail->Password = "Xk52mBYgEpLprekT"; 
                $mail->setFrom('quizmaker.no.reply@gmail.com', 'QuizMaker'); 
                $mail->Subject = "Account information"; 
                $mail->Body = "Your username is: " . $username . '<br>Your password is: ' . $password; 
                $mail->addAddress($email); 
 
                if(!$mail->send()) { 
                    return var_dump(http_response_code(405)); 
                } 


                return var_dump(http_response_code(200));
            } else {
                return var_dump(http_response_code(409));
            }
            break;
        }
        case 'PUT': {
            if(!isAdminLoggedIn($token)){
                $data = array('status' => http_response_code(403), 'message' => 'Invalid request');
                echo json_encode($data);
                return;
            }
            parse_str(file_get_contents('php://input'), $_PUT);
            
            $username = $_PUT["username"];
            $role = $_PUT["role"];
            $address = $_PUT["address"];
            $email = $_PUT["email"];
            $phone = $_PUT["phone"];

            if(!isValidPhone($phone)){
                $data = array('status' => http_response_code(400), 'message' => 'Invalid phone number');
                echo json_encode($data);
                return;
            }

            if(!isValidEmail($email)){
                $data = array('status' => http_response_code(400), 'message' => 'Invalid email address');
                echo json_encode($data);
                return;
            }

            $sql = "UPDATE `users` SET role='$role', address='$address', email='$email', phone='$phone' WHERE username='$username'";

            if ($connection->query($sql) === TRUE) {
                $data = array('status' => http_response_code(200), 'message' => 'Account edited successfully');
                echo json_encode($data);
                return;
            } else {
                $data = array('status' => http_response_code(500), 'message' => 'Account edited failed. Please try again later.');
                echo json_encode($data);
                return;
            }
            break;
        }
        case 'DELETE': {
            if(!isAdminLoggedIn($token)){
                $data = array('status' => http_response_code(403), 'message' => 'Invalid request');
                echo json_encode($data);
                return;
            }
            parse_str(file_get_contents('php://input'), $_DELETE);
            
            $username= $_DELETE["username"];

            $sql =  "DELETE FROM `users` WHERE username = '$username'";
            $result = mysqli_query($connection, $sql);
            if ($connection->query($sql) === TRUE) {
                $data = array('status' => http_response_code(200), 'message' => 'Account deleted successfully');
                echo json_encode($data);
                return;
            } else {
                $data = array('status' => http_response_code(500), 'message' => $connection->error);
                echo json_encode($data);
                return;
            }
            $connection->close();
            break;
        }
    }
?>
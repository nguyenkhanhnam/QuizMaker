<?php
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
		// if(preg_match('/^([A-Za-z0-9]+[A-Za-z0-9_]*@[A-Za-z0-9]+((.){1}[A-Za-z0-9]+)+)?$/', $email))
        // 	return true;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
          }
		return false;
	}
	
	function isValidPhone($phone){
		if(preg_match('/^([0-9]{10,11})?$/', $phone))
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
                http_response_code(403);
                return var_dump(http_response_code());
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

                //TODO: Send username and password to email here
                // the message
                $msg = "Your username is: " . $username . '/nYour password is: ' . $password;

                // use wordwrap() if lines are longer than 70 characters
                $msg = wordwrap($msg, 70);
                $headers = "From: zueskei4@gmail.com";
                // send email
                
                if(mail('zueskei4@gmail.com', 'Account information', $msg, $headers))
                    return var_dump(http_response_code(123));
                //
                
                return var_dump(http_response_code(200));
            } else {
                return var_dump(http_response_code(409));
            }
            break;
        }
        case 'PUT': {
            if(!isAdminLoggedIn($token)){
                http_response_code(403);
                return var_dump(http_response_code());
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

            $sql = "UPDATE `users` SET role='$role', address= '$address', email= '$email', phone= '$phone' WHERE username='$username'";

            if ($connection->query($sql) === TRUE) {
                $data = array('status' => http_response_code(200), 'message' => 'Account edited successfully');
                echo json_encode($data);
                return;
            } else {
                return var_dump(http_response_code(409));
            }
            break;
        }
        case 'DELETE': {
            if(!isAdminLoggedIn($token)){
                http_response_code(403);
                return var_dump(http_response_code());
            }
            parse_str(file_get_contents('php://input'), $_DELETE);
            
            $username= $_DELETE["username"];

            $sql =  "DELETE FROM `users` WHERE username = '$username'";
            $result = mysqli_query($connection, $sql);
            if ($connection->query($sql) === TRUE) {
                $data = array('status' => http_response_code(200), 'message' => 'Course deleted successfully');
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
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
		if(preg_match('/^([A-Za-z0-9]+[A-Za-z0-9_]*(@){1}[A-Za-z0-9]+(.[A-Za-z0-9]+)+)?$/', $email))
			return true;
		return false;
	}
	
	function isValidPhone($phone){
		if(preg_match('/^([0-9]{8, 12})?$/', $phone))
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
            $code = trim($_POST["code"], " \t\n\r\0\x0B");
            $name = $_POST["name"];
            $sql = "INSERT INTO `courses` (name, code) VALUES ('$name','$code')";
           
            if ($connection->query($sql) === TRUE) {
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
            
            $username= $_PUT["username"];
            $role= $_PUT["role"];
            $address= $_PUT["address"];
            $email= $_PUT["email"];
            $phone= $_PUT["phone"];

            // if(!isValidPhone($phone)){
            //     return var_dump(http_response_code(400));
            // }

            $sql = "UPDATE `users` SET role='$role', address= '$address', email= '$email', phone= '$phone' WHERE username='$username'";

            if ($connection->query($sql) === TRUE) {
                return var_dump(http_response_code(200));
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
            if(!isset($_DELETE["code"])){
                return var_dump(http_response_code(400));
            }
            
            $code = trim($_DELETE["code"], " \t\n\r\0\x0B");

            if(!isValidCourseCode($code)){
                return var_dump(http_response_code(400));
            }
            $code = $_DELETE["code"];
            $sql =  "DELETE FROM courses WHERE code = '$code'";
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
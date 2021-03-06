<?php
    require_once('./checkAuth.php');
?>
<?php
    $username= $_SESSION["username"];

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

    $method = $_SERVER['REQUEST_METHOD'];
    $data = array();
    $connection = mysqli_connect("localhost", "root", "", "assignment");
	
	function isValidEmail($email){
		if(preg_match('/^([A-Za-z0-9]+[A-Za-z0-9\_\.\-]*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)+)?$/', $email))
        	return true;
        // if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return true;
        //   }
		return false;
	}
	
	function isValidPhone($phone){
		if(preg_match('/^([0-9]{10,11})?$/', $phone))
			return true;
		return false;
    }
    

    switch($method){
        case 'GET': {
            $sql =  "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_array($result)){
                    $data = array('id' => $row["id"]
                                        , 'username' => $row["username"]
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

        case 'POST': {
            parse_str(file_get_contents('php://input'), $_POST);

            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $middlename = $_POST["middlename"];
            $dateofbirth= $_POST["dateofbirth"];
            $address= $_POST["address"];
            $email= $_POST["email"];
            $phone= $_POST["phone"];
    
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
    
            // $sql= "CALL sp_set_account_info('$role', '$firstname', '$lastname', '$middlename', '$dateofbirth', '$address', '$phone', '$email');";
            $sql= "UPDATE `users` SET firstname= '$firstname'"
                                . ", lastname= '$lastname'"
                                . ", middlename= '$middlename'"
                                . ", dateofbirth= STR_TO_DATE('$dateofbirth', '%d/%m/%Y')"
                                . ", address= '$address'"
                                . ", email= '$email'"
                                . ", phone= '$phone'"
                                . " WHERE username= '$username';";
    
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
    }

    
?>
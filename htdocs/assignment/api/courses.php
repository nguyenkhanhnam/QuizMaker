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

    function isValidCourseCode($courseCode){
        if (preg_match('/^[A-Z]{2}[0-9]{4}$/', $courseCode))
            return true;
        return false;
    }

    function isValidCourseName($courseName){
        if (preg_match('/[A-Za-z0-9]{1,50}$/', $courseName))
            return true;
        return false;
    }

    switch($method){
        case 'GET': {
            if(empty($_GET["code"])){
                $sql =  "SELECT * FROM `courses`";
                $result = mysqli_query($connection, $sql);
                header('Content-Type: text/html; charset=utf-8');
                while($row = mysqli_fetch_array($result)){
                    array_push($data, array('code' => $row["code"], 'name' => $row["name"]));
                }
                echo json_encode($data);
                break;
            }
            else {
                $courseCode = $_GET['code'];
                $sql =  "SELECT * FROM `courses` WHERE code='$courseCode' LIMIT 1";
                $result = mysqli_query($connection, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $data = array('code' => $row["code"], 'name' => $row["name"]);
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

            if(!isset($_PUT["code"]) || !isset($_PUT["name"])){
                return var_dump(http_response_code(400));
            }
            
            $code = trim($_PUT["code"], " \t\n\r\0\x0B");
            $name = $_PUT["name"];

            if(!isValidCourseCode($code) || !isValidCourseName($name)){
                return var_dump(http_response_code(400));
            }

            $sql =  "SELECT * FROM `courses` WHERE code='$code' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) <= 0) {
                return var_dump(http_response_code(404));
            }

            $sql = "UPDATE courses SET name='$name', code='$code'  WHERE code='$code'";

            if ($connection->query($sql) === TRUE) {
                return var_dump(http_response_code(200));
            } else {
                return var_dump(http_response_code(409));
            }
            break;
        }
    }
?>
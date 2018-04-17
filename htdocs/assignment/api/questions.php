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
    $method = $_SERVER['REQUEST_METHOD'];
    $data = array();
    $connection = mysqli_connect("localhost", "root", "", "assignment");

    function isValidCourseCode($courseCode){
        if (preg_match('/^[A-Z]{2}[0-9]{4}$/', $courseCode))
            return true;
        return false;
    }

    switch($method){
        case 'POST': {
            if(!isUserLoggedIn($token)){
                http_response_code(403);
                return var_dump(http_response_code());
            }
            $code = trim($_POST["code"], " \t\n\r\0\x0B");
            if(!isValidCourseCode($code)){
                return var_dump(http_response_code(400));
            }
            $question = $_POST["question"];
            $option1 = $_POST["option1"];
            $option2 = $_POST["option2"];
            $option3 = $_POST["option3"];
            $option4 = $_POST["option4"];
            $answer = $_POST["answer"];
            $difficult = $_POST["difficult"];
            $sql = "INSERT INTO `questions` (code, question, option1, option2, option3, option4, answer, difficult) VALUES ('$code','$question','$option1','$option2','$option3','$option4','$answer','$difficult')";
           
            if ($connection->query($sql) === TRUE) {
                return var_dump(http_response_code(200));
            } else {
                return var_dump(http_response_code(409));
            }
            break;
        }
    }
?>
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
        case 'GET': {
            if(empty($_GET["id"]) && empty($_GET["code"])){
                $sql = "SELECT questions.*, courses.name FROM `questions`,`courses` WHERE questions.code=courses.code ORDER BY questions.code";
                $result = mysqli_query($connection, $sql);
                if ($result && $result->num_rows > 0){
                    while($row = mysqli_fetch_array($result)){
                        array_push($data, array('id' => $row['id'], 'question' => $row['question']
                        , 'code' => $row['code'], 'name' => $row['name'], 'difficult' => $row['difficult']));
                    }
                    echo json_encode($data);
                } else {
                    echo json_encode([]);
                }
                break;
            }
            if(empty($_GET["id"]) && !empty($_GET["code"])){
                $code = $_GET["code"];
                if(!isValidCourseCode($code)){
                    http_response_code(400);
                    return var_dump(http_response_code());
                }
                $sql = "SELECT questions.*, courses.name FROM `questions`,`courses` WHERE questions.code='$code' AND '$code'=courses.code ORDER BY questions.id";
                $result = mysqli_query($connection, $sql);
                if ($result && $result->num_rows > 0){
                    while($row = mysqli_fetch_array($result)){
                        array_push($data, array('id' => $row['id'], 'question' => $row['question']
                        , 'code' => $row['code'], 'name' => $row['name'], 'difficult' => $row['difficult']));
                    }
                    echo json_encode($data);
                } else {
                    echo json_encode([]);
                }
                break;
            }
            if(!empty($_GET["id"])){
                $id = $_GET["id"];
                $sql = "SELECT questions.*, courses.name FROM `questions`,`courses` WHERE questions.code=courses.code AND questions.id='$id' LIMIT 1";
                $result = mysqli_query($connection, $sql);
                if(mysqli_num_rows($result) == 1){
                    while($row = mysqli_fetch_array($result)){
                        $data = array('id' => $row['id'], 'question' => $row['question'],
                        'option1' => $row['option1'], 'option2' => $row['option2'],
                        'option3' => $row['option3'], 'option4' => $row['option4'],
                        'answer' => $row['answer'],
                        'code' => $row['code'], 'name' => $row['name'], 'difficult' => $row['difficult']);
                    }
                    echo json_encode($data);
                } else {
                    echo json_encode(new stdClass);
                }
                break;
            }
        }
        case 'POST': {
            if(!isUserLoggedIn($token)){
                http_response_code(403);
                return var_dump(http_response_code());
            }
            if(!isset($_POST["code"]) || !isset($_POST["question"]) 
            || !isset($_POST["option1"]) || !isset($_POST["option2"]) 
            || !isset($_POST["option3"]) || !isset($_POST["option4"])
            || !isset($_POST["answer"]) || !isset($_POST["difficult"])){
                return var_dump(http_response_code(400));
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
        // case 'PUT': {
        //     if(!isAdminLoggedIn($token)){
        //         http_response_code(403);
        //         return var_dump(http_response_code());
        //     }
        //     parse_str(file_get_contents('php://input'), $_PUT);

        //     if(!isset($_PUT["code"]) || !isset($_PUT["name"])){
        //         return var_dump(http_response_code(400));
        //     }
            
        //     $code = trim($_PUT["code"], " \t\n\r\0\x0B");
        //     $name = $_PUT["name"];

        //     if(!isValidCourseCode($code) || !isValidCourseName($name)){
        //         return var_dump(http_response_code(400));
        //     }

        //     $sql =  "SELECT * FROM `courses` WHERE code='$code' LIMIT 1";
        //     $result = mysqli_query($connection, $sql);
        //     if(mysqli_num_rows($result) <= 0) {
        //         return var_dump(http_response_code(404));
        //     }

        //     $sql = "UPDATE courses SET name='$name', code='$code'  WHERE code='$code'";

        //     if ($connection->query($sql) === TRUE) {
        //         return var_dump(http_response_code(200));
        //     } else {
        //         return var_dump(http_response_code(409));
        //     }
        //     break;
        // }
        case 'DELETE': {
            if(!isUserLoggedIn($token)){
                http_response_code(403);
                return var_dump(http_response_code());
            }
            parse_str(file_get_contents('php://input'), $_DELETE);
            if(!isset($_DELETE["id"])){
                return var_dump(http_response_code(400));
            }
            
            $id = trim($_DELETE["id"], " \t\n\r\0\x0B");
            $sql =  "DELETE FROM questions WHERE id = '$id'";
            $result = mysqli_query($connection, $sql);
            if ($connection->query($sql) === TRUE) {
                $data = array('status' => http_response_code(200), 'message' => 'Question deleted successfully');
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
<?php
    require_once('./checkAuth.php');
    require_once('./dbconnect.php');
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
            $image_name = '';
            if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] > 0){
                $image_name = $_POST["question"] . $_FILES["fileToUpload"]["name"];
                $target_dir = "../images/";
                $target_file = $target_dir . basename($image_name);
                $uploadOk = 1;
                $message = '';
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $message = "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $message = "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    $message = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo $message;
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $message = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        echo $message;
                    } else {
                        $message = "Sorry, there was an error uploading your file.";
                        echo $message;
                    }
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
                $sql = "INSERT INTO `questions` (code, question, option1, option2, option3, option4, answer, difficult, image) VALUES ('$code','$question','$option1','$option2','$option3','$option4','$answer','$difficult','$image_name')";
               
                if ($connection->query($sql) === TRUE) {
                    return var_dump(http_response_code(200));
                } else {
                    return var_dump(http_response_code(409));
                }
            }
            else {
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
                $sql = "INSERT INTO `questions` (code, question, option1, option2, option3, option4, answer, difficult, image) VALUES ('$code','$question','$option1','$option2','$option3','$option4','$answer','$difficult','$image_name')";
               
                if ($connection->query($sql) === TRUE) {
                    return var_dump(http_response_code(200));
                } else {
                    return var_dump(http_response_code(409));
                }
            }
            break;
           
        }
        case 'PUT': {
            if(!isUserLoggedIn($token)){
                http_response_code(403);
                return var_dump(http_response_code());
            }
            parse_str(file_get_contents('php://input'), $_PUT);

            if(!isset($_PUT["id"])
            || !isset($_PUT["code"]) || !isset($_PUT["question"]) 
            || !isset($_PUT["option1"]) || !isset($_PUT["option2"]) 
            || !isset($_PUT["option3"]) || !isset($_PUT["option4"])
            || !isset($_PUT["answer"]) || !isset($_PUT["difficult"])){
                return var_dump(http_response_code(400));
            }
            
            $id = trim($_PUT["id"], " \t\n\r\0\x0B");
            $code = trim($_PUT["code"], " \t\n\r\0\x0B");
            $question = trim($_PUT["question"], " \t\n\r\0\x0B");
            $option1 = trim($_PUT["option1"], " \t\n\r\0\x0B");
            $option2 = trim($_PUT["option2"], " \t\n\r\0\x0B");
            $option3 = trim($_PUT["option3"], " \t\n\r\0\x0B");
            $option4 = trim($_PUT["option4"], " \t\n\r\0\x0B");
            $answer = trim($_PUT["answer"], " \t\n\r\0\x0B");
            $difficult = (int) trim($_PUT["difficult"], " \t\n\r\0\x0B");

            if(!isValidCourseCode($code)){
                return var_dump(http_response_code(400));
            }

            $sql =  "SELECT * FROM `questions` WHERE id='$id' LIMIT 1";
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) <= 0) {
                return var_dump(http_response_code(404));
            }

            $sql = "UPDATE questions SET code='$code', question='$question', option1='$option1',
                    option2='$option2', option3='$option3', option4='$option4', answer='$answer',
                    difficult='$difficult' WHERE id='$id'";

            if ($connection->query($sql) === TRUE) {
                $data = array('status' => http_response_code(200), 'message' => 'Question edited successfully');
                echo json_encode($data);
                return;
            } else {
                $data = array('status' => http_response_code(500), 'message' => $connection->error);
                echo json_encode($data);
                return;
            }
            break;
        }
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
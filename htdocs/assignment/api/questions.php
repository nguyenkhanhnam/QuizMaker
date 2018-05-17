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
            if(empty($_GET["id"])){
               // $sql =  "SELECT * FROM `questions`";
                $sql = "SELECT questions.*, courses.name FROM `questions`,`courses` WHERE questions.code=courses.code ORDER BY questions.code";
                $result = mysqli_query($connection, $sql);
                // header('Content-Type: text/html; charset=utf-8');
                if ($result && $result->num_rows > 0){
                    while($row = mysqli_fetch_array($result)){
                        array_push($data, array('id' => $row['id'], 'question' => $row['question']
                        , 'code' => $row['code'], 'name' => $row['name'], 'difficult' => $row['difficult']));
                    }
                    echo json_encode($data);
                } else {
                    echo "0 results";
                }
                break;
                // if ($result && $result->num_rows > 0){
                //     // echo '<table class="table">';
                //     // echo '<thead><tr> <th>ID</th> <th>Name</th><th>Number</th>  <th>Country</th>  <th>Club Name</th></tr> </thead>';
                //     //   // output data of each row
                //     //   echo "<tbody>";
                //     //   while($row = $result->fetch_assoc()) {
                //     //       echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Number"]. "</td><td>" . $row["Country"]. "</td><td>" . $row["ClubName"]. "</td></tr>";
                //     //   } 
                //     //   echo "</tbody> </table>";
                // } else {
                //     echo "0 results";
                // }
            }
            // else {
            //     $courseCode = $_GET['code'];
            //     $sql =  "SELECT * FROM `courses` WHERE code='$courseCode' LIMIT 1";
            //     $result = mysqli_query($connection, $sql);
            //     if(mysqli_num_rows($result) > 0){
            //         while($row = mysqli_fetch_array($result)){
            //             $data = array('id' => $row["id"], 'code' => $row["code"], 'name' => $row["name"]);
            //         }
            //         echo json_encode($data);
            //     }
            //     else {
            //         var_dump(http_response_code(404));
            //     }
            //     break;
            // }
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
        // case 'DELETE': {
        //     if(!isAdminLoggedIn($token)){
        //         http_response_code(403);
        //         return var_dump(http_response_code());
        //     }
        //     parse_str(file_get_contents('php://input'), $_DELETE);
        //     if(!isset($_DELETE["code"])){
        //         return var_dump(http_response_code(400));
        //     }
            
        //     $code = trim($_DELETE["code"], " \t\n\r\0\x0B");

        //     if(!isValidCourseCode($code)){
        //         return var_dump(http_response_code(400));
        //     }
        //     $code = $_DELETE["code"];
        //     $sql =  "DELETE FROM courses WHERE code = '$code'";
        //     $result = mysqli_query($connection, $sql);
        //     if ($connection->query($sql) === TRUE) {
        //         $data = array('status' => http_response_code(200), 'message' => 'Course deleted successfully');
        //         echo json_encode($data);
        //         return;
        //     } else {
        //         $data = array('status' => http_response_code(500), 'message' => $connection->error);
        //         echo json_encode($data);
        //         return;
        //     }
        //     $connection->close();
        //     break;
        // }
    }
?>
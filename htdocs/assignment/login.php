<?php 
    require_once('./dbconnect.php');
   
    $username = trim($_POST["username"], " \t\n\r\0\x0B");
    $password = trim($_POST["password"], " \t\n\r\0\x0B");

    $sql = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
    $result = $connection->query($sql);

    if (!is_null($result) && $result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            session_start(); 
            $_SESSION['user'] = $row["id"];

            /*$user = new stdClass();
            $user->username = $row['username'];
            $user->role = $row['role'];;

            $userJSON = json_encode($user);
            return echo $userJSON;*/
            return var_dump(http_response_code(200));
        } 
      } else {
        return var_dump(http_response_code(401));
    }
?>

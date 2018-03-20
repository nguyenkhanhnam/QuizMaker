<?php 
    require_once('./dbconnect.php');
    $username = trim($_POST["username"], " \t\n\r\0\x0B");
    $password = trim($_POST["password"], " \t\n\r\0\x0B");
    
    $sql = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";

    $result = $connection->query($sql);
    if (!is_null($result) && $result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            echo "Sign in successfully <br>";
        } 
      } else {
        echo "Wrong username or password";
    }
?>

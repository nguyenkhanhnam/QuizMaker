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
            switch ($row["role"]){
                case 0: {
                    header("Location: http://localhost/dashboard/admin.php");
                    break;
                }
            }

            // header("Location: http://localhost/dashboard/admin.php");
            // // die();
            // return var_dump(http_response_code(200));
        } 
      } else {
        return var_dump(http_response_code(401));
    }
?>

<?php
    require_once('./dbconnect.php');
    session_start();
    //Getting Input value
    if(isset($_POST['login'])){
        $username=mysqli_real_escape_string($connection,$_POST['username']);
        $password=mysqli_real_escape_string($connection,$_POST['password']);

        if(empty($username)&&empty($password)){
            $error= 'Fileds are Mandatory';
        }
        else {
            //Checking Login Detail
            $sql= "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
            $result= mysqli_query($connection, $sql);
            $row= mysqli_fetch_assoc($result);
            $count= mysqli_num_rows($result);
            if($count == 1){
                $_SESSION['user']= array(
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'role' => $row['role']
                );
                $role= $_SESSION['user']['role'];
                //Redirecting User Based on Role
                switch($role){
                    case 0:
                        header('location:dashboard/admin.php');
                        break;
                    case 1:
                        header('location:dashboard/user.php');
                        break;
                    case 2:
                        header('location:dashboard/staff.php');
                        break;
                }
            }
            else {
            $error= 'Your PassWord or UserName is not Found';
            }
        }
    }
?>

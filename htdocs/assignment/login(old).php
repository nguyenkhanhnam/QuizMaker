<?php
    require_once('./dbconnect.php');
    session_start();
    //Getting Input value
  
    if(isset($_POST['login'])){
        $username=mysqli_real_escape_string($connection,$_POST['username']);
        $password=mysqli_real_escape_string($connection,$_POST['password']);

        if(empty($username) && empty($password)){
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
                        header('location:./dashboard/admin.php');
                        break;
                    case 1:
                        header('location:./dashboard/user.php');
                        break;
                    case 2:
                        header('location:./dashboard/staff.php');
                        break;
                }
            }
            else {
              $error='Your PassWord or UserName is not Found';
            }
        }
    }
?>
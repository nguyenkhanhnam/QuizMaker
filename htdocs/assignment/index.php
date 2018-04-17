<?php include_once "./views/share/head.php" ?>
<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isLoggedIn($token)){
        $role= $_SESSION['user']['role'];
        switch($role){
            case 0:
                header('location:/dashboard/admin');
                break;
            case 1:
                header('location:/dashboard/user');
                break;
            case 2:
                header('location:/dashboard/staff');
                break;
            }
      }
      else {
        return header('location:/login');
      }
    }
    else {
      echo "no token";
      return header('location:/login');
    }
?>
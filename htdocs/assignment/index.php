<?php
    include_once "./views/share/head.php";
?>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isLoggedIn($token)){
        $role = $_SESSION['role'];
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
        echo "<script>$('#login-modal').modal('show')</script>";
      }
    }
    else {
        echo "<script>$('#login-modal').modal('show')</script>";
    }
?>

<title>QuizMaker</title>

<header>
    <?php include_once "./views/share/header.php" ?>
</header>

<?php include_once "./views/about.html" ?>

<footer>
    <?php include_once "./views/share/footer.php" ?>
</footer>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isLoggedIn($token)){}
      else {
        echo "<script>$('#login-modal').modal('show')</script>";
      }
    }
    else {
        echo "<script>$('#login-modal').modal('show')</script>";
    }
?>
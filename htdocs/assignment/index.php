<?php
    include_once "./views/share/head.php";
?>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isLoggedIn($token)){
        if(isAdminLoggedIn($token)){
            header('location:/dashboard/admin');
        }
        if(isUserLoggedIn($token)){
            header('location:/dashboard/user');
        }
        if(isStaffLoggedIn($token)){
            header('location:/dashboard/staff');
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

<div class="container">
    <header>
        <?php include_once "./views/share/header.php" ?>
    </header>

    <?php include_once "./views/about.html" ?>

    <footer>
        <?php include_once "./views/share/footer.php" ?>
    </footer>
</div>

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
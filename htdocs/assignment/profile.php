<?php
    include_once "./views/share/head.php";
?>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isLoggedIn($token)){
        
      }
      else {
        return header('location:/');
      }
    }
    else {
        return header('location:/');
    }
?>

<title>QuizMaker</title>

<header>
    <?php include_once "./views/share/header.php" ?>
</header>

<?php include_once "./views/profile.html" ?>

<footer>
    <?php include_once "./views/share/footer.php" ?>
</footer>
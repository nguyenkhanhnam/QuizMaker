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

<title>Profile</title>

<body class="container">
<header>
    <?php include_once "./views/share/header.php" ?>
</header>

<h1 style="font-family: Montserrat, sans-serif" class="text-center">Profile</h1>

<?php include_once "./views/profile.html" ?>

<footer>
    <?php include_once "./views/share/footer.php" ?>
</footer>
</body>
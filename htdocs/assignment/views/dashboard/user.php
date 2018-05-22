<?php include_once "../share/head.php" ?>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isStaffLoggedIn($token)){
      
      }
      else {
        return header('location:/');
      }
    }
    else {
      header('location:/');
      return;
    }
?>

<head>
  <title>Quiz Maker</title>
</head>

<style>
  #form-center {
    width: 50%;
    margin: 0 auto;
  }

  #forgot {
    text-decoration: none;
    display: inline;
  }
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "../share/header.php" ?>
    </header>
    
    

    <footer>
      <?php include_once "../share/footer.php" ?>
    </footer>
  </div>
</body>
<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "share/import.php" ?>
  <title>Quiz Maker</title>
  <link rel="icon" type="image/png" href="/img/favicon.png" />
</head>

<!-- <script src="js/login.js"></script> -->

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
      <?php include_once "share/header.php" ?>
    </header>
    <div id="form-center">
      <form id="login-form" method= "POST" action= "login.php">
        <div class="form-group">
          <label for="username">Username</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-key fa-lg" aria-hidden="true"></i>
            </span>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          </div>
        </div>
        <div class="pull-left">
          <a id="forgot" href="#">Forgot password?</a>
        </div>
        <div class="text-right">
          <button type="submit" id="btn-login" class="btn btn-primary">
            <i class="fa fa-sign-in" aria-hidden="true"></i> Log In</button>
        </div>
      </form>
    </div>


    <footer>
      <?php include_once "share/footer.php" ?>
    </footer>
  </div>
</body>
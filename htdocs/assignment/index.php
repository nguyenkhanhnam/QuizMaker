<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "share/import.php" ?>
  <title>Quiz Maker</title>
  <link rel="icon" type="image/png" href="/img/favicon.png" />
</head>

<style>
  #login-form {
    width: 50%;
    margin: 0 auto;
  }
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "share/header.php" ?>
    </header>
    <div id="login-form">
      <form method="POST" action="/login.php">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div>
          <a href="#">Forgot password?</a>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-default">Log In</button>
        </div>
      </form>
    </div>


    <footer>
      <?php include_once "share/footer.php" ?>
    </footer>
  </div>
</body>
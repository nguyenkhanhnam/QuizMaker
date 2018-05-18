<head>
  <?php include_once "share/head.php" ?>
  <title>Quiz Maker</title>
</head>

<style>
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

    <div class="row">
      <div class="col-xs-12">
        <form>
          <div class="form-group">
            <label for="username">Username</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
              </span>
              <input type="text" class="form-control" placeholder="Username" name="username">
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-key fa-lg" aria-hidden="true"></i>
              </span>
              <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
          </div>
          <div class="pull-left">
            <a id="forgot" href="#">Forgot password?</a>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-sign-in" aria-hidden="true"></i> Log In</button>
          </div>
        </form>
      </div>
    </div>

    <footer>
      <?php include_once "share/footer.php" ?>
    </footer>
  </div>
</body>

<script src="js/auth/login.js"></script>
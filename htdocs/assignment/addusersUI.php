<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "share/import.php" ?>
  <title>Add User</title>
  <link rel="icon" type="image/png" href="/img/favicon.png" />
</head>

<script src="js/addusers.js"></script>

<style>
  #login-form {
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

    <div id="login-form">
      <form class="form-horizontal" id="myform">

        <div class="form-group">
          <label for="inputUsername" class="col-sm-2 control-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputUsername" placeholder="Username">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
          </div>
        </div>

        <div class="form-group" id="role">
            <label for="inputPassword" class="col-sm-2 control-label">Role</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="0"> Admin
                </label>
                <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="1" checked="checked"> User
                </label>
                <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="2"> Staff
                </label>
            </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-primary" id="btn-adduser">Add user</button>
          </div>
        </div>

      </form>
    </div>

    <footer>
      <?php include_once "share/footer.php" ?>
    </footer>
  </div>
</body>
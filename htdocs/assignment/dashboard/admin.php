<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "../share/import.php" ?>
  <title>Quiz Maker</title>
  <link rel="icon" type="image/png" href="../img/favicon.png" />
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
      <h1 class= "dashboard-name">Admin Dashboard</h1>
    </header>
    

    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 'add-account')">Add Account</button>
      <button class="tablinks" onclick="openTab(event, 'find-user')">Find User</button>
    </div>

  <div id="add-account form-center" class="tabcontent">
    <form id= "login-form" method= "POST" action= "">
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
          </span>
          <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
        </div>
      </div>
    </form>
  </div>

  <div id="find-user" class="tabcontent">
    <h3>Paris</h3>
    <p>Paris is the capital of France.</p> 
  </div>

    <footer>
      <?php include_once "../share/footer.php" ?>
    </footer>
  </div>
</body>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
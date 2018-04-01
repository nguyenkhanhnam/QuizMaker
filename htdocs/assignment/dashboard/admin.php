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
      <button class="tablinks" onclick="openTab(event, 'account')">Account Management</button>
      <button class="tablinks" onclick="openTab(event, 'course')">Course Management</button>
    </div>
    
    <!-- Account tab content -->
    <div id="account" class="tabcontent">
      <h3>Paris</h3>
      <p>Paris is the capital of France.</p>
    </div>

    <!-- Course tab content -->
    <div id="course" class="tabcontent">
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
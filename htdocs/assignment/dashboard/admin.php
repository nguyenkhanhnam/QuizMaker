<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "../share/head.php" ?>
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

  body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    /* width: 160px; */
    min-height: 100%;
    position: relative;
    /* float: left; */
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    /* padding-top: 20px; */
}

.sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.main {
    /*margin-left: 160px; /* Same as the width of the sidenav */
    font-size: 28px; /* Increased text to enable scrolling */
    /* padding: 0px 10px; */
    height: 100%;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
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
    <div id="account" class="tabcontent row" style= "height: 500px">
      <div class="sidenav col-sm-3">
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="#clients">Clients</a>
        <a href="#contact">Contact</a>
        <div style= "clear: both; background-color: #111"> </div>
      </div>
      
      <div class="main col-sm-9">
        <h2>Sidebar</h2>
        <p>This sidebar is of full height (100%) and always shown.</p>
        <p>Scroll down the page to see the result.</p>
        <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
      </div>
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
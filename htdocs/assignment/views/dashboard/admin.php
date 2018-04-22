<head>
  <?php include_once "../share/head.php" ?>
  <link href="../css/admin.css" rel="stylesheet" type="text/css">
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

  .sidenav {
    height: 100%;
    min-height: 100%;
    position: relative;
    z-index: 1;
    top: 0;
    left: 0;
    overflow-x: hidden;
    border-right: 1px solid #ccc;
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
    font-size: 28px;
    height: 100%;
    overflow: auto;
  }

  .row {
    margin-right: 0px;
    margin-left: 0px;
  }

  .topnav {
    overflow: hidden;
    border-bottom: 1px solid #ccc;
  }

  .topnav .search-container {}

  .topnav input[type=text] {
    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: none;
  }

  .topnav .search-container button {
    float: right;
    padding: 6px 10px;
    margin-top: 8px;
    margin-right: 16px;
    background: #ddd;
    font-size: 17px;
    border: none;
    cursor: pointer;
  }

  .topnav .search-container button:hover {
    background: #ccc;
  }

  @media screen and (max-height: 450px) {
    .sidenav {
      padding-top: 15px;
    }
    .sidenav a {
      font-size: 18px;
    }
  }
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "../share/header.php" ?>
      <h1 class="dashboard-name">Admin Dashboard</h1>
    </header>


    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 'account')">Account Management</button>
      <button class="tablinks" onclick="openTab(event, 'course')">Course Management</button>
    </div>

    <!-- Account tab content -->
    <div id="account" class="tabcontent row" style="height: 500px">
      <div class="sidenav col-sm-3">
        <div class="topnav">
          <div class="form-group">
            <input type="text" class="form-control" id="search" placeholder="Search">
          </div>
            <?php 
              include_once $basedir . '\..\courses\list.php';
            ?>
        </div>
      </div>

      <div class="main col-sm-9">
        <h2>Sidebar</h2>
        <p>This sidebar is of full height (100%) and always shown.</p>
        <p>Scroll down the page to see the result.</p>
        <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et
          eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae
          nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
      </div>
    </div>

    <!-- Course tab content -->
    <div id="course" class="tabcontent">
      <div class="sidenav col-sm-3">
        <div class="topnav">
          <div class="search-container">
            <form action="search_user.php" method="GET">
              <input type="text" placeholder="Search.." name="search">
              <button type="submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="main col-sm-9">
        <h2>Sidebar</h2>
        <p>This sidebar is of full height (100%) and always shown.</p>
        <p>Scroll down the page to see the result.</p>
        <p>Some text to enable scrolling.. Lorem ipsum dolor sit amet, illum definitiones no quo, maluisset concludaturque et
          eum, altera fabulas ut quo. Atqui causae gloriatur ius te, id agam omnis evertitur eum. Affert laboramus repudiandae
          nec et. Inciderint efficiantur his ad. Eum no molestiae voluptatibus.</p>
      </div>
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

  $(document).ready(function () {
    $('#search').on('input', function () {
      if ($(this).val() === '') {
        getCourses()
      } else {
        var searchPattern = new RegExp($('#search').val(), "i");
        for (var i = course_global.length - 1; i >= 0; i--) {
          if (course_global[i].name.search(searchPattern) == -1) {
            course_global.splice(i, 1)
            updateTable()
          }
        }
      }
    })
  })
</script>
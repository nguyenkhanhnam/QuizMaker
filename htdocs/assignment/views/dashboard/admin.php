<?php include_once "../share/head.php" ?>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isAdminLoggedIn($token)){
      
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
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <title>Quiz Maker</title>
  </head>

  <style>
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

    #main-course {
      font-size: 28px;
      height: 100%;
      overflow: auto;
    }

    #main-account {
      font-size: 18px;
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

    .search-form {
      margin: 10px auto auto 0;
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
        <button id="course-tab" class="tablinks" onclick="openTab(event, 'course')">Course Management</button>
        <button id="account-tab" class="tablinks" onclick="openTab(event, 'account')">Account Management</button>
      </div>

      <!-- Course tab content -->
      <div id="course" class="tabcontent row" style="height: 500px">
        <div class="sidenav col-sm-3">
          <div>
            <button class="btn btn-primary my-btn" style="width:100%; margin-top: 5px" onclick="openSection('addCourse')">
              Add Course
            </button>
          </div>
          <div class="form-group search-form">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
              <input type="text" class="form-control" id="search-course" placeholder="Search">
            </div>
          </div>
          <?php 
              include $basedir . '\..\courses\list.html'; 
            ?>
        </div>

        <div class="col-sm-9" id="main-course">
          <div class="hide" id="add-course">
            <?php
              include $basedir . '\..\courses\create.html';
            ?>
          </div>
          <div id="detail-course">
            <?php 
              include $basedir . '\..\courses\detail.html';
            ?>
          </div>
        </div>
      </div>

      <!-- Account tab content -->
      <!-- Course tab content -->
      <div id="account" class="tabcontent row" style="height: 500px">
        <div class="sidenav col-sm-3">
          <div>
            <button class="btn btn-primary my-btn" style="width:100%; margin-top: 5px" onclick="openSection('addAccount')">
              Add Account
            </button>
          </div>
          <div>
            <div class="form-group search-form">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" id="search-account" placeholder="Search">
              </div>
            </div>
            <?php 
              include $basedir . '\..\accounts\list.html'; 
            ?>
          </div>
        </div>

        <div class="col-sm-9" id="main-account">
          <div class="hide" id="add-account">
            <?php
              include $basedir . '\..\accounts\create.html';
            ?>
          </div>
          <div id="detail-account">
            <?php 
              include $basedir . '\..\accounts\detail.html';
            ?>
          </div>
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

    function openSection(sectionName) {
      if (sectionName === 'addCourse') {
        $('#add-course').removeClass('hide')
        $('#detail-course').addClass('hide')
      }
      else if (sectionName === 'editCourse') {
        $('#add-course').addClass('hide')
        $('#detail-course').removeClass('hide')
      }
      else if (sectionName === 'addAccount') {
        $('#add-account').removeClass('hide')
        $('#detail-account').addClass('hide')
      }
      else if (sectionName === 'editAccount') {
        $('#add-account').addClass('hide')
        $('#detail-account').removeClass('hide')
      }
    }

    $(document).ready(function () {
      $('#search-course').on('input', function () {
        if ($(this).val() === '') {
          getCourses()
        } else {
          var searchPattern_course = new RegExp($('#search-course').val(), "i");
          for (var i = course_global.length - 1; i >= 0; i--) {
            if (course_global[i].name.search(searchPattern_course) == -1) {
              course_global.splice(i, 1)
              updateTableCourse()
            }
          }
        }
      })
    })

    $(document).ready(function () {
      $('#search-account').on('input', function () {
        if ($(this).val() === '') {
          getCourses()
        } else {
          var searchPattern_account = new RegExp($('#search-account').val(), "i");
          for (var i = account_global.length - 1; i >= 0; i--) {
            if (account_global[i].username.search(searchPattern_account) == -1) {
              account_global.splice(i, 1)
              updateTableAccount()
            }
          }
        }
      })
    })
  </script>

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
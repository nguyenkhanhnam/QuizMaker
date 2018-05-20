<style>
  .navbar-default {
    background-color: #008000;
    border-color: #62c02b;
  }

  .navbar-default .navbar-brand {
    color: #eef1ec;
  }

  .navbar-default .navbar-brand:hover,
  .navbar-default .navbar-brand:focus {
    color: #cbffbb;
  }

  .navbar-default .navbar-text {
    color: #eef1ec;
  }

  .navbar-default .navbar-nav>li>a {
    color: #eef1ec;
  }

  .navbar-default .navbar-nav>li>a:hover,
  .navbar-default .navbar-nav>li>a:focus {
    color: #cbffbb;
  }

  .navbar-default .navbar-nav>.active>a,
  .navbar-default .navbar-nav>.active>a:hover,
  .navbar-default .navbar-nav>.active>a:focus {
    color: #cbffbb;
    background-color: #62c02b;
  }

  .navbar-default .navbar-nav>.open>a,
  .navbar-default .navbar-nav>.open>a:hover,
  .navbar-default .navbar-nav>.open>a:focus {
    color: #cbffbb;
    background-color: #62c02b;
  }

  .navbar-default .navbar-toggle {
    border-color: #62c02b;
  }

  .navbar-default .navbar-toggle:hover,
  .navbar-default .navbar-toggle:focus {
    background-color: #62c02b;
  }

  .navbar-default .navbar-toggle .icon-bar {
    background-color: #eef1ec;
  }

  .navbar-default .navbar-collapse,
  .navbar-default .navbar-form {
    border-color: #eef1ec;
  }

  .navbar-default .navbar-link {
    color: #eef1ec;
  }

  .navbar-default .navbar-link:hover {
    color: #cbffbb;
  }

  @media (max-width: 767px) {
    .navbar-default .navbar-nav .open .dropdown-menu>li>a {
      color: #eef1ec;
    }
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover,
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus {
      color: #cbffbb;
    }
    .navbar-default .navbar-nav .open .dropdown-menu>.active>a,
    .navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover,
    .navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus {
      color: #cbffbb;
      background-color: #62c02b;
    }
  }

  #application-name {
    text-transform: uppercase;
    color: green;
    font-weight: bolder;
    text-align: right;
  }

  #login,
  #user-dropdown {
    display: none;
  }
</style>

<div id="header">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="/">QUIZ MAKER</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav navbar-right">
        <li id="login">
          <a data-toggle="modal" data-target="#login-modal" href="#">
            <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Log in
          </a>
        </li>
        <li class="hide" id="logout">
          <a href="/logout">
            <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> Log out</a>
        </li>
        <li id="user-dropdown" class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hello, <?php echo $_SESSION['username']; ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="/profile.php"><i class="fa fa-user" aria-hidden="true"></i> My profile</a>
            </li>
            <li>
              <a data-toggle="modal" data-target="#change-password-modal" href="#"><i class="fa fa-key" aria-hidden="true"></i> Change password</a>
            </li>
            <li>
              <a data-toggle="modal" data-target="#logout-modal" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="/about.php">
            <i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
        </li>
        <li>
          <a href="#" onclick="downloadGuide()">
            <i class="fa fa-question-circle" aria-hidden="true"></i> Help</a>
        </li>
      </ul>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</div>

<script>
  function downloadGuide(){
    window.open('QuizMakerGuide.docx', '_blank')
  }
</script>

<?php
  include $basedir . '\..\login.html';
  include $basedir . '\..\logout.html';
  include $basedir . '\..\change-password.html';
  include $basedir . '\..\forgot-password.html';

  if(isset($_SESSION['token']) && $_SESSION['token']!=''){
    $token = $_SESSION['token'];
    if(isLoggedIn($token)){
      echo "<script>
        $('#user-dropdown').show()
        $('#login').hide()  
      </script>";
    }
    else {
      echo "<script>
        $('#user-dropdown').hide()
        $('#login').show() 
      </script>";
    }
  }
  else {
    echo "<script>
      $('#user-dropdown').hide()
      $('#login').show() 
    </script>";
  }
?>
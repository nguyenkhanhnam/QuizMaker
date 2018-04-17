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
</style>

<div id="header">


  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
          aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="#">QUIZ MAKER</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="/"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Log in
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li>
            <a href="/logout"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> Log out</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</div>
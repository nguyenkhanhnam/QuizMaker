<?php include_once "../share/head.php" ?>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isUserLoggedIn($token)){
      
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
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "../share/header.php" ?>
    </header>
    
    <body>
      <div class="container">
        <div class="form-group">
          <label for="question">Course:</label>
          <br>
          <select id="courses" name="code">
            <option value= "0">All course</option>
          </select>
        </div>
        <label for="difficult">Difficult: </label>
        <select class="form-group" id="difficult">
          <option value="0">Easy</option>
          <option value="1">Medium</option>
          <option value="2">Hard</option>
          <option value="3" selected>All</option>
        </select>
        <button class= "btn btn-primary my-btn pull-right" type= "button" id= "add-question" onClick= "createQuestion()">Create question</button>
        <table id="question-table" class="table table-bordered">
          <thead>
            <tr>
              <th>Course code</th>
              <th>Question</th>
              <th>Difficult</th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </body>

    <footer>
      <?php include_once "../share/footer.php" ?>
    </footer>
  </div>
</body>

<script>
  function createQuestion(){
    window.location.href = `/questions/create.php`
  }
</script>
<script src="/js/questions/list.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
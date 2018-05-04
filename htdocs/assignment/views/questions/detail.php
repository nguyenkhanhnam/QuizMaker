<head>
  <?php include_once "../share/head.php" ?>
  <title>Edit Question</title>
</head>

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

<header>
  <?php include_once "../share/header.php" ?>
</header>

<body>
  <div class="container">
    <form class="form-horizontal" id="edit-form">
      <div class="form-group">
        <label for="question">Course:</label>
        <br>
        <select id="courses" name="code">
        </select>
      </div>
      <div class="form-group">
        <label for="question">Question:</label>
        <input type="text" class="form-control" name="question" id="question" required>
      </div>
      <div class="form-group">
        <label for="options">Options:</label>
      </div>
      <div class="form-group">
        <input for="option1" type="text" class="form-control" name="option1" id="option1" required>
      </div>
      <div class="form-group">
        <input for="option2" type="text" class="form-control" name="option2" id="option2" required>
      </div>
      <div class="form-group">
        <input for="option3" type="text" class="form-control" name="option3" id="option3" required>
      </div>
      <div class="form-group">
        <input for="option4" type="text" class="form-control" name="option4" id="option4" required>
      </div>
      <div class="form-group">
        <label for="answer">Answer:</label>
        <input type="text" class="form-control" name="answer" id="answer" required>
      </div>
      <div class="form-group">
        <label for="difficult">Difficult:</label>
        <br>
        <label class="radio-inline">
          <input type="radio" value="0" name="difficult">Easy
        </label>
        <label class="radio-inline">
          <input type="radio" value="1" name="difficult">Normal
        </label>
        <label class="radio-inline">
          <input type="radio" value="2" name="difficult">Hard
        </label>
      </div>
      <div class="input-group pull-right">
        <button type="button" id="btn-save" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</body>
<footer>
  <?php include_once "../share/footer.php" ?>
</footer>

</html>

<script src="/js/questions/detail.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
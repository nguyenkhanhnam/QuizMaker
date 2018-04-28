 
<head>
	<?php include_once "../share/head.php" ?>
	<title>Edit Question</title>
  <link rel="stylestreet" href="jquery-ui.css">
  <script type="jquery-ui.js"></script>
</head>
<style>
  .demo{
    margin-left: 20%;
    margin-right: 20%;
  }
</style>
<?php
  include('db.php');
    //fetch the record to be update
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $edit_state=true;
        $rec= mysqli_query($db,"SELECT * FROM info WHERE id= $id");
        $record = mysqli_fetch_array($rec);
        $id=$record['id'];
        $question=$record['question'];
        $option1=$record['option1'];
        $option2=$record['option2'];
        $option3=$record['option3'];
        $option4=$record['option4'];
        $answer=$record['answer'];
        $difficult=$record['difficult'];
    } 
?>
<header>
	<?php include_once "../share/header.php" ?>
</header>
<body>
  <div class="demo">
      <form id="create-form" class="form-horizontal">
        <div class="form-group">
          <label for="question">Course:</label>
          <br>
          <select id="courses" name="code">
          </select>
        </div>
      <form class="form-horizontal" method="POST" action="db.php">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
          <label for="id">ID :</label>
          <input type="text" class="form-control"  name="id" value="<?php echo $id;?>">
        </div>
        <div class="form-group">
          <label for="question">Question:</label>
          <input type="text" class="form-control" name="question" value="<?php echo $question;?>">
        </div>
        <div class="form-group">
          <label for="options">Options:</label>
        </div>
        <div class="form-group">
          <input for="option1" type="text" class="form-control" name="option1" required value="<?php echo $option1;?>">
        </div>
        <div class="form-group">
          <input for="option2" type="text" class="form-control" name="option2" required value="<?php echo $option2;?>">
        </div>
        <div class="form-group">
          <input for="option3" type="text" class="form-control" name="option3" required value="<?php echo $option3;?>">
        </div>
        <div class="form-group">
          <input for="option4" type="text" class="form-control" name="option4" required value="<?php echo $option4;?>">
        </div>
        <div class="form-group">
          <label for="answer">Answer:</label>
          <input type="text" class="form-control" name="answer" required value="<?php echo $answer;?>">
        </div>
        <div class="form-group">
          <label for="difficult">Difficult:</label>
          <br>
          <label class="radio-inline">
            <input type="radio" value="0" name="difficult" checked>Easy (0)
          </label>
          <label class="radio-inline">
            <input type="radio" value="1" name="difficult">Normal (1)
          </label>
          <label class="radio-inline">
            <input type="radio" value="2" name="difficult">Hard (2)
          </label>
        </div>
        <div class="input-group">
          <?php if ($edit_state ==false): ?>
              <button type="submit" name="Savee" class="btn">Save</button>
          <?php else: ?>
              <button type="submit" name="update" class="btn">Update</button>
          <?php endif ?>
        </div>
      </form>
    </div>
  </form>
</body>
<footer>
		<?php include_once "../share/footer.php" ?>
</footer>
</html>

<head>
	<?php include_once "../share/head.php" ?>
	<title>Create Question</title>
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

<style>
	.select2  {
		width: 100% !important;
	}
</style>

<body>
	<div class="container">
		<header>
			<?php include_once "../share/header.php" ?>
		</header>
		<h1 class="text-center">Create Question</h1>
		<div>
			<form id="create-form" class="form-horizontal">
				<div class="form-group">
					<label for="question">Course:</label>
					<br>
					<select id="courses" name="code">
					</select>
				</div>
				<div class="form-group">
					<label for="question">Question:</label>
					<input type="text" class="form-control" placeholder="Question" name="question" required>
				</div>
				<div class="form-group">
					<label for="options">Options:</label>
				</div>
				<div class="form-group">
					<input for="option1" type="text" class="form-control" placeholder="Option 1" name="option1" required>
				</div>
				<div class="form-group">
					<input for="option2" type="text" class="form-control" placeholder="Option 2" name="option2" required>
				</div>
				<div class="form-group">
					<input for="option3" type="text" class="form-control" placeholder="Option 3" name="option3" required>
				</div>
				<div class="form-group">
					<input for="option4" type="text" class="form-control" placeholder="Option 4" name="option4" required>
				</div>
				<div class="form-group">
					<label for="answer">Answer:</label>
					<input type="text" class="form-control" placeholder="Answer" name="answer" required>
				</div>
				<div class="form-group">
					<label for="difficult">Difficult:</label>
					<br>
					<label class="radio-inline">
						<input type="radio" value="0" name="difficult" checked>Easy
					</label>
					<label class="radio-inline">
						<input type="radio" value="1" name="difficult">Normal
					</label>
					<label class="radio-inline">
						<input type="radio" value="2" name="difficult">Hard
					</label>
				</div>
				<div class="text-right">
					<button type="button" class="btn btn-primary" id="btn-add">Add</button>
				</div>
			</form>
		</div>
	<footer>
		<?php include_once "../share/footer.php" ?>
	</footer>
	</div>
</body>

<script src="/js/questions/create.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
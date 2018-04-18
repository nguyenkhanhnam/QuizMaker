<head>
	<?php include_once "../share/head.php" ?>
	<title>Create Question</title>
</head>
<style>
	#create-form {
		width: 50%;
		margin: 0 auto;
	}

	.collapse {
		margin-right: 20%;
		margin-left: 20%;
		margin-top: 10px;
	}

	.form-control {}
</style>

<body>
	<div class="container">
		<header>
			<?php include_once "../share/header.php" ?>
		</header>
		<div class="button col-sm-10">
			<button type="button" class="btn btn-primary btm-md" data-toggle="collapse" data-target="#demo">Create Question </button>
			<button type="button" class="btn btn-primary btm-md" data-toggle="collapse" data-target="#demo1">View </button>
		</div>
		<div id="demo1" class="collapse">
			<br>
			<br>
			<div class="alert alert-info">
				<strong>Please fill the Code Course and select the Difficulty.</strong>
			</div>
			<label for="codename"> Code Course: </label>
			<input type="text" class="form-control" placeholder="Question" name="codename">
			<br>
			<label for="difficulty">Difficulty </label>
			<select class="form-group" id="difficulty">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option>All</option>
			</select>
			<div>
				<a href="view">
					<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</a>
			</div>
		</div>
		<div id="demo" class="collapse">
			<p style="font-size: 80px">Create Question</p>
			<form class="form-horizontal" method="POST" action="/api/questions.php">
				<div class="form-group">
					<label for="question"> Question: </label>
					<input type="text" class="form-control" placeholder="Question" name="question" required>
				</div>
				<div class="form-group">
					<label for="options"> Options: </label>
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
					<label for="answer"> Answer: </label>
					<input type="text" class="form-control" placeholder="Answer" name="answer" required>
				</div>
				<div class="form-group">
					<label for="difficult"> Difficulty: </label>
					<br>
					<label class="radio-inline">
						<input type="radio" value="0" name="difficult" required>Easy (0)
					</label>
					<label class="radio-inline">
						<input type="radio" value="1" name="difficult" required>Normal (1)
					</label>
					<label class="radio-inline">
						<input type="radio" value="2" name="difficult" required>Hard (2)
					</label>
				</div>
				<div class="upload">
					<button type="submit" class="btn btn-success">Upload</button>
				</div>
			</form>
		</div>
	</div>
	<footer>
		<?php include_once "../share/footer.php" ?>
	</footer>
	</div>
</body>
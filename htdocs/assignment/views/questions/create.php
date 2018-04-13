<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">
<head>
	<?php include_once "../share/import.php" ?>
	<title>Create Question</title>
</head>
<style >
	#create-form {
		width:50%;
		margin: 0 auto;
	}
	.collapse {
		margin-right:20%;
		margin-left: 20%;
		margin-top:10px;
	}
	.form-control{

	}
</style>
<body>
	<div class ="container">
		<header>
			<?php include_once "../share/header.php" ?>
		</header>
		<div class ="button col-sm-10">
			<button type="button" class = "btn btn-primary btm-md" data-toggle="collapse" data-target="#demo">Create Question </button>
			<button type="button" class = "btn btn-primary btm-md" data-toggle="collapse" data-target= "#demo1">View </button>
		</div>
			<div id="demo1" class="collapse">
				<br>
				<br>
				<div class="alert alert-info">
    				<strong>Please fill the code course and select the difficulty.</strong> 
  				</div>
				<label for="codename"> Code Course: </label>
					<input type="text" class ="form-control" placeholder="Question" name="codename">
					<br>
				<label for="sel1">Difficulty </label>
      				<select class="form-group" id="sel1">
        				<option>0</option>
        				<option>1</option>
        				<option>2</option>
     				</select>
     			<div>
     				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
     			</div>
			</div>
			<div id="demo" class="collapse">
				<p style ="font-size: 80px">Create Question</p>
				 <form class ="form-horizontal" method ="POST" action="/question.php">
				<div class="form-group">
					<label for="question"> Question: </label>
					<input type="text" class ="form-control" placeholder="Question" name="question">
				</div>
				<div class ="form-group">
					<label for="options"> Options: </label>	
				</div> 
				<div class ="form-group">
					<input for="option1" type="text" class="form-control" placeholder="Option 1" name="option1">
				</div> 
				<div class ="form-group">
					<input for="option2" type="text" class="form-control" placeholder="Option 2" name="option2">
				</div>
				<div class ="form-group">
					<input for="option3" type="text" class="form-control" placeholder="Option 3" name="option3">
				</div>
				<div class ="form-group">
					<input for="option4" type="text" class="form-control" placeholder="Option 4" name="option4">
				</div> 
				<div class="form-group">
					<label for="answer"> Answer: </label>
					<input type="text" class ="form-control" placeholder="Answer" name="answer">
				</div> 
				<div class="form-group">
					<label for="difficult"> Difficulty: </label>
					<br>
					<label class="radio-inline">
     				 	<input type="radio" value="0" name="optradio">Easy (0)
    				</label>
    				<label class="radio-inline">
      					<input type="radio" value="1" name="optradio">Normal (1)
    				</label>
    				<label class="radio-inline">
      					<input type="radio" value="2" name="optradio">Hard (2)
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

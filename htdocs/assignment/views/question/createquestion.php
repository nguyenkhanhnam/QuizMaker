<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">
<head>
	<?php include_once "../share/import.php" ?>
	<title>Create Question</title>
</head>
<script src="/js/courses/createquestion.js"></script>
<style >
	#create-form {
		width:50%;
		margin: 0 auto;
	}
	.collapse {
		margin-left:20%;
		margin-top:10px;
	}
	.form-group{
		margin-right:20%;
	}
</style>
<body>
	<div class ="container">
		<header>
			<?php include_once "../share/header.php" ?>
		</header>
		<div class ="button col-sm-10">
			<button type="button" class = "btn btn-primary btm-md" data-toggle="collapse" data-target="#demo">Create Question </button>
			<button type="button" class = "btn btn-primary btm-md">View </button>
		</div>
		</div>
			<div id="demo" class="collapse col-sm-10">
				<p style ="font-size: 80px">Create Question</p>
				 <form class ="form-horizontal" method ="POST" action="">
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
		<footer>
			<?php include_once "../share/footer.php" ?>
		</footer>
	</div>
</body>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";
$conn = new mysqli($servername, $username, $password, $dbname);
$question=$_POST['question'];
$option1= $_POST['option1'];
$option2= $_POST['option2'];
$option3=$_POST['option3'];
$option4=$_POST['option4'];
$answer=$_POST['answer'];
$difficulty=$_POST['optradio'];
	echo $answer;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO questions(question,option1,option2,option3,option4,answer,difficulty)
VALUES('$question','$option1','$option2','$option3','$option4','$answer','$difficulty')";
if ($conn->query($sql) === TRUE) {
   echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
<?php
	session_start();
	// initialize variables
	$id = 0;
	$question   = "" ;
	$option1    = "" ;
	$option2    = "" ;
	$option3    = "" ;
	$option4    = "" ;
	$answer     = "" ;
	$difficult = 0 ;
	$edit_state=false;

	//connect to database
	$db = mysqli_connect('localhost','root','','assignment');
	// if save button is clicked
/*
	if(isset($_POST['save'])){
		$id = $_POST['id'];
		$question = $_POST['question'];
		$option1  = $_POST['option1'];
		$option2  = $_POST['option2'];
		$option3  = $_POST['option3'];
		$option4  = $_POST['option4'];
		$answer   = $_POST['answer'];
		$difficult = $_POST['difficult'];

		$query = "INSERT INTO questions(id,question,option1,option2,option3,option4,answer,difficult)";
		mysqli_query($db,$query);
		header('location:edit.php');
	}
*/

	//update records
	if(isset($_POST['update'])){
		$id =mysql_real_escape_string($_POST['id']);
		$question=mysql_real_escape_string($_POST['question']);
		$option1=mysql_real_escape_string($_POST['option1']);
		$option2=mysql_real_escape_string($_POST['option2']);
		$option3=mysql_real_escape_string($_POST['option3']);
		$option4=mysql_real_escape_string($_POST['option4']);
		$answer=mysql_real_escape_string($_POST['answer']);
		$difficult=mysql_real_escape_string($_POST['difficult']);

		mysqli_query($db,"UPDATE info SET id='$id',question='$question',option1='$option1',option2='$option2',option3='$option3',option4='$option4',answer='$answer' WHERE id=$id");
		header('location:edit.php');
	}

	//retrieve records
	$results = mysqli_query($db,"SELECT * FROM questions");
?>
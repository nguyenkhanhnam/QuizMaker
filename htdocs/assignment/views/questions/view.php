<head>
	<?php include_once "../share/head.php" ?>
	<title>View Question</title>
</head> 
<?php 
  include('db.php');
  if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $edit_state=true;
        $rec= mysqli_query($db,"SELECT * FROM info WHERE id= $id");
        $record = mysql_fetch_array($rec);
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
  <div class="container">
    <div class="form-group">
					<label for="question">Course:</label>
					<br>
					<select id="courses" name="code">
					</select>
		</div>
    <label for="difficult">Difficult: </label>
      <select class="form-group" id="difficult">
        <option value="0">Easy</option>
        <option value="1">Medium</option>
        <option value="2">Hard</option>
        <option value="3" selected>All</option>
      </select>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id</th>
            <th>Difficult</th>
            <th>Question</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($results)){ ?>
              <tr>
                  <td><?php echo $row['id'];?></td>
                  <td><?php echo $row['difficult'];?></td>
                  <td><?php echo $row['question'];?></td>
                  <td><a href="edit.php?edit=<?php echo $row['id'] ?>" class="btn btn-warning"> Edit</a>
                  <a onclick="return confirm('Are you sure ?')" href="?edit=<?php echo $row['id'] ?>" class ="btn btn-danger">Delete</a>
                  </td>
         <?php }  
          ?>
        <tbody>  
    	</table>
  </div>		
</body>
<footer>
		<?php include_once "../share/footer.php" ?>
</footer>
</html>

<script src="/js/questions/create.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


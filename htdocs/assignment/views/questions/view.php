 
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
<head>
	<?php include_once "../share/head.php" ?>
	<title>View Question</title>
</head>
<header>
	<?php include_once "../share/header.php" ?>
</header>
<body>
  <div class="container">
    <h3>Course Name :</h3>
    <label for="codename"> Code Course: </label>
    <div>
      <input type="text" class="form-group" placeholder="Input the Code Course" name="codename">
        <a href="view">
          <button class="btn btn-default" type="submit">
          <i class="glyphicon glyphicon-search"></i>
          </button>
        </a>
    </div>
      <br>
    <label for="difficult">Difficult: </label>
      <select class="form-group" id="difficult">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option>All</option>
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

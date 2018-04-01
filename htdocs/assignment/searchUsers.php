<!DOCTYPE html>
<html>
<head>
	<?php include_once "share/import.php" ?>
	<title>Search for users</title>

</head>

<style>
  #login-form {
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
	      <?php include_once "share/header.php" ?>
	    </header>

	    <h1>Search For Users</h1>



<?php 
	mysql_connect("localhost","root","") or die("could not connect!!!");
	mysql_select_db("assignment") or die("could not find db!!!"); 
	$output = "";
	//collect

	if(!isset($_POST['search'])){
		$list = mysql_query(" SELECT * FROM users LIMIT 0, 10") or die("could not search!!!");
		echo "<table class='table table-bordered'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Role</th>
			</tr>
		</thead>";

		while($row = mysql_fetch_array($list)){
			echo "<tbody>";
				echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					echo "<td>" . $row['role'] . "</td>";
				echo "</tr>";
			echo "</tbody>";
		}
		echo "</table>";
	}else{
		$searchQuery = $_POST['search'];
		$searchQuery = preg_replace("#[^0-9a-z]#i", "", $searchQuery);
		$query = mysql_query(" SELECT * FROM users WHERE username LIKE '%$searchQuery%' OR id LIKE '%$searchQuery%' ") or die("could not search!!!");
		$count = mysql_num_rows($query);

		echo "<table class='table table-bordered'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Role</th>
			</tr>
		</thead>";

		if($count == 0){
			$output = "there was no search results!!!";
		}else{
			while($row = mysql_fetch_array($query)){
				echo "<tbody>";
					echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['username'] . "</td>";
						echo "<td>" . $row['role'] . "</td>";
					echo "</tr>";
				echo "</tbody>";
			}
		}
		echo "</table>";
	}
?>




	<div align="middle">
		<form action="searchUsers.php" method="POST" >
			<input type="text" name="search" placeholder="Search for users...">
			<button class="btn btn-default" type="submit" ><i class ="glyphicon glyphicon-search"></i></button> 
		</form>
	</div>	


		<footer>
			<?php include_once "share/footer.php" ?>
		</footer>
	</div>
</body>
</html>

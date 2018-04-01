<?php 
	mysql_connect("localhost","root","") or die("could not connect!!!");
	mysql_select_db("assignment") or die("could not find db!!!"); 
	$output = "";
	//collect

	$list = mysql_query(" SELECT * FROM users LIMIT 0, 10") or die("could not search!!!");
	echo "<table border='1'>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Role</th>
		</tr>";

		while($row = mysql_fetch_array($list)){
			echo "<tr>";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['username'] . "</td>";
				echo "<td>" . $row['role'] . "</td>";
			echo "</tr>";
		}
	echo "</table>";

	/*if(isset($_POST['search'])){
		$searchQuery = $_POST['search'];
		$searchQuery = preg_replace("#[^0-9a-z]#i", "", $searchQuery);
		$query = mysql_query(" SELECT * FROM users WHERE username LIKE '%$searchQuery%' OR id LIKE '%$searchQuery%' ") or die("could not search!!!");
		$count = mysql_num_rows($query);
		if($count == 0){
			$output = "there was no search results!!!";
		}else{
			while($row = mysql_fetch_array($query)){
				$username = $row['username'];
				$id = $row['id'];
				$role = $row['role'];
				$output .= '<div>'.$username.' '.$id.' '.$role.'</div';
			}
		}
	}*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search for users</title>
</head>
<body>
	<form action="searchUsers.php" method="POST">
		<input type="text" name="search" placeholder="Search for users...">
		<input type="submit" value=">>">
	</form>	
</body>
</html>

<?php
	if(isset($_POST['search'])){
		$searchQuery = $_POST['search'];
		$searchQuery = preg_replace("#[^0-9a-z]#i", "", $searchQuery);
		$query = mysql_query(" SELECT * FROM users WHERE username LIKE '%$searchQuery%' OR id LIKE '%$searchQuery%' ") or die("could not search!!!");
		$count = mysql_num_rows($query);

		echo "<table border='1'>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Role</th>
		</tr>";

		if($count == 0){
			$output = "there was no search results!!!";
		}else{
			while($row = mysql_fetch_array($query)){
				echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					echo "<td>" . $row['role'] . "</td>";
				echo "</tr>";
			}
		}

		echo "</table>";
	}
?>
 
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
   
    		<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT difficulty,question FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class=\"table table-striped table-bordered table-hover table-condensed\">          
      <table class=\"table\">";
    echo "<tr><th>Difficulty</th><th>Question</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["difficulty"]. "</td><td>" . $row["question"]. " ". "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?> 
      	</table>
    </div>		
</body>
<footer>
		<?php include_once "../share/footer.php" ?>
</footer>
</html>
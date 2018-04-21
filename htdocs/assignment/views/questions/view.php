 
<head>
	<?php include_once "../share/head.php" ?>
	<title>View Question</title>
  <link rel="stylestreet" href="jquery-ui.css">
  <script type="jquery-ui.js"></script>
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
    <label for="difficulty">Difficulty: </label>
      <select class="form-group" id="difficulty">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option>All</option>
      </select>
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

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class=\"table table-striped table-bordered table-hover table-condensed\">          
      <table class=\"table\">";
    echo "<tr>
              <th width=\"10%\">Id</th>
              <th width=\"10%\">Difficulty</th>
              <th align=\"center\" width=\"90%\">Question</th>
          </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "  <tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["difficulty"]."</td>
                    <td>".$row["question"]."</td>
                    <td>
                      <button type =\"button\" name = \"edit\" class=\"btn btn-primary btn xs edit\" id=\"".$row["id"]."\">Edit
                      </button>
                    </td>
                    <td>
                      <button type =\"button\" name = \"delete\" class=\"btn btn-danger btn xs delete\" id=\"".$row["id"]."\">Delete
                      </button>
                    </td>
                </tr>";
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

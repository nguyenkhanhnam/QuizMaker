<?php
    require_once('./checkAuth.php');
?>

<?php
    if(isset($_SESSION['token'])){
        $token = $_SESSION['token'];
        if(!isLoggedIn($token)){
            http_response_code(401);
            return var_dump(http_response_code());
        }
    }
    else {
        http_response_code(401);
        return var_dump(http_response_code());
    }
	
	$code= $_POST["code"];
	echo $code;
	$easy_num= $_POST["easy_num"];
	$medium_num= $_POST["medium_num"];
	$hard_num= $_POST["hard_num"];
	$date= $_POST["date"];
	$patch_num= $_POST["patch_num"];
	
	$connection = mysqli_connect("localhost", "root", "", "assignment");
	$sql= "CALL get_paper_question('$code', $easy_num, $medium_num, $hard_num);";
	
	
	$result = mysqli_query($connection, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "id" . $row["id"] . " \tquestion: " . $row["question"] . "<br>";
		}
	} else {
		echo "0 results";
	}

	mysqli_close($connection);
	
	// if (!$connection->multi_query("$sql")) {
		// echo "CALL failed: (" . $connection->errno . ") " . $connection->error;
	// }
	
	// do {
		// if ($res = $connection->store_result()) {
			// printf("---\n");
			// var_dump($res->fetch_all());
			// echo "<br>";
			
			// // $row= $res -> fetch_array();
			// // echo "<br><br>" . $row[0];
			
			// $res->free();
		// } else {
			// if ($connection->errno) {
				// echo "Store failed: (" . $connection->errno . ") " . $connection->error;
			// }
		// }
	// } while ($connection->more_results() && $connection->next_result());
?>
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
	
	
	
	if (!$connection->multi_query("$sql")) {
		echo "CALL failed: (" . $connection->errno . ") " . $connection->error;
	}

	do {
		if ($res = $connection->store_result()) {
			printf("---\n");
			var_dump($res->fetch_all());
			$res->free();
		} else {
			if ($connection->errno) {
				echo "Store failed: (" . $connection->errno . ") " . $connection->error;
			}
		}
	} while ($connection->more_results() && $connection->next_result());
?>
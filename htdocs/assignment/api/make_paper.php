<?php
    require_once('./checkAuth.php');
	require_once('./paper_header.php'); 

	function rrmdir($dir) { 
	   if (is_dir($dir)) { 
		 $objects = scandir($dir); 
		 foreach ($objects as $object) { 
		   if ($object != "." && $object != "..") { 
			 if (is_dir($dir."/".$object))
			   rrmdir($dir."/".$object);
			 else
			   unlink($dir."/".$object); 
		   } 
		 }
		 rmdir($dir); 
	   } 
	}
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
	
	$connection = mysqli_connect("localhost", "root", "", "assignment");
	$sql= "SELECT name FROM courses WHERE code= '$code';";
	$result = mysqli_query($connection, $sql);
	$name= '';
	while($row = mysqli_fetch_assoc($result))
		$name= $row['name'];
	
	mysqli_close($connection);
	
	$easy_num= $_POST["easy_num"];
	$medium_num= $_POST["medium_num"];
	$hard_num= $_POST["hard_num"];
	$date= $_POST["date"];
	$patch_num= $_POST["patch_num"];
	$note= $_POST['note'];
	$duration= $_POST['duration'];
	
	$date_arr= explode('/', $date);
	$date_string= implode($date_arr);
	$outputpath = '../paper_output/' . $code . '/' . $date_string;
	rrmdir($outputpath);
	if (!file_exists($outputpath)) {
		mkdir($outputpath, 0777,true);
}
?>

<?php
	for($i= 0; $i < $patch_num; $i++){
		$paper_code= rand(1001, 9999);
		$code_header= $code;
		$name_header= $name;
		$paper_code_header= $paper_code;
		
		$pdf= new PDF();
		
		$pdf -> SetMargins(10, 15, 10);
		
		$pdf -> AddPage();
		
		$left_side_width= 70;
		$right_side_width= 120;
		$pdf -> SetAutoPageBreak('true', 15);
		
		$pdf -> SetFont('Times', '', 16);
		
		$pdf -> Cell($left_side_width, 8, ' Name: ', 'LTR', 0, 'L');
		$pdf -> Cell($right_side_width, 8, 'HO CHI MINH CITY', 'TR', 1, 'C');
		
		$pdf -> Cell($left_side_width, 8, '', 'LR', 0, 'L');
		$pdf -> Cell($right_side_width, 8, 'UNIVERSITY OF TECHNOLOGY', 'R', 1, 'C');
		
		
		$pdf -> Cell($left_side_width, 8, ' Student ID: ', 'LR', 0, 'L');
		$pdf -> Cell($right_side_width, 8, 'Subject: ' . $name, 'R', 1, 'C');
		
		$pdf -> SetFont('', '', 13);
		
		$pdf -> Cell($left_side_width, 8, '', 'LR', 0, 'L');
		$pdf -> Cell($right_side_width/ 2, 8, '     Date: ' . $date, 0, 0, 'L');
		$pdf -> Cell($right_side_width/ 2, 8, '     Paper code: ' . $paper_code, 'R', 1, 'L');
		
		$pdf -> Cell($left_side_width, 8, '', 'BLR', 0, 'L');
		$pdf -> Cell($right_side_width/ 3, 8, '     Duration: ' . $duration . ' min', 'B', 0, 'L');
		$pdf -> Cell($right_side_width* 2/ 3, 8, '' . $note, 'BR', 1, 'C');
		$pdf -> Ln(10);
		
		$connection = mysqli_connect("localhost", "root", "", "assignment");
		$sql= "CALL sp_get_paper_question('$code', $easy_num, $medium_num, $hard_num);";
		$result = mysqli_query($connection, $sql);
		$question_no= 0;

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				// echo "id" . $row["id"] . " \tquestion: " . $row["question"] . "<br>";
				$pdf->SetFont('Times','',12);
					$pdf-> InsertQuestion($row['question'], $question_no+ 1, $row['image']);
					$pdf -> InsertAnswers(array($row[1], $row[2], $row[3], $row[4]));
					//echo "<br><br>" . $pdf -> get_lasth();
					$pdf -> ln();
					$question_no++;
			}
		} else {
			// echo "0 results";
		}
		$date_arr= explode('/', $date);
		$date_string= implode($date_arr);
		$savepath = $outputpath . '/' . $paper_code . '.pdf';
        $pdf->Output($savepath,'F');
		echo "<object data=" . $savepath ." type=\"application/pdf\" width=\"24.5%\" height=\"80%\">"
			  . "<p>Alternative text - include a link <a href=" . $savepath . ">to the PDF!</a></p>"
			. "</object>";
		mysqli_close($connection);
	}
	
	
?>
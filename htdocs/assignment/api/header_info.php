<?php
	//for header information
	$pdf= new PDF();
	$pdf -> AddPage();
	
	$left_side_width= 70;
	$right_side_width= 120;
	
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
?>
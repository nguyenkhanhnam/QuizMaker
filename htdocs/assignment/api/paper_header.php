<?php
	ob_start();
	require_once('./fpdf/fpdf.php');
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,8,'NATIONAL UNIVERSITY UNIVERSITY OF TECHNOLOGY',0,1,'C');
	//$pdf -> Cell(0, 2);
	//$pdf -> ln();
	$pdf -> Cell(0, 8, "Some text", 1, 1, 'C');
	
?>
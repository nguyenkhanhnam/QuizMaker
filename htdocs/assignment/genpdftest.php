<?php
	require_once("./api/fpdf/fpdf.php");
	
	$pdf= new FPDF();
	$pdf -> AddPage();
	
	$pdf -> SetFont('Times', '', 18);
	$pdf -> Cell(0, 7 , 'Some text here!');
?>
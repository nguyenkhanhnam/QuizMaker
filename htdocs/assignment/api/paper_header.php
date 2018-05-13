<?php 
	ob_start();
	require_once('./fpdf/fpdf.php');
	
// Create PDF extend from FPDF with code name in Header
	class PDF extends FPDF {
		// public $content_height;
		// Page header
		const MM_IN_INCH = 25.4;
		const DPI = 96;

		function Header()
		{
			global $code_header, $name_header, $paper_code_header;
			if($this -> PageNo() !== 1){
				$this -> SetFont('Times', 'I', 12);
				
				//Set paper code in right side of the header
				$paper_code_width= $this -> GetStringWidth($paper_code_header)+ 4;
				$this -> SetFont('Times', '', 12);
				$this -> SetX(-40);
				$this -> Cell($paper_code_width, 5, $paper_code_header, 0, 0, 'R');
				
				//Set code and code name in left side in header
				$header_string= $code_header . " - " . $name_header;
				$this -> SetX(20);
				$this -> MultiCell(105, 5, $header_string, 0, 'L');
				
				
				//Set line break
				$this -> Cell(0, 0, '', 1);
				$this -> Ln(5);
			}
		}

		// Page footer
		function Footer()
		{	
			// Position at 1.5 cm from bottom
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Times','',8);
			// Page number
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		
		// function Cell(){
			// parent::Cell();
			
		// }
		function pixelsToMM($val) {
			return $val * self::MM_IN_INCH / self::DPI;
		}

		function InsertQuestion($question, $no, $image){
			$this -> SetFont('Times', 'BI', 12);
			$question_word= "Question " . $no . ": ";
			$question_word_width= $this -> GetStringWidth($question_word)+ 4;
			$this -> Cell($question_word_width, 5, $question_word, 0, 0, 'C');
			$this -> SetFont('', '', 12);
			$this -> MultiCell(0, 5, $question);
			if($image !== ''){
				// $this -> SetAutoPageBreak('false', 15);
				list($img_width_px, $img_height_px) = getimagesize('../images/' . $image);

				$img_ratio= $img_width_px/ $img_height_px;
				$img_width= $this -> pixelsToMM($img_width_px);
				$img_height= $this -> pixelsToMM($img_height_px);

				if($img_ratio < 1.2){
					if($img_width < 210* 0.4){
						$this -> Image('../images/' . $image, (210- $img_width)/ 2, null, $img_width, $img_height);
						$this -> setY($this -> getY()+  5);
					}
					else {
						$this -> Image('../images/' . $image, 210* 0.6/ 2, null, 210* 0.4, (1/ $img_ratio)* 210* 0.4);
						$this -> setY($this -> getY()+ 5);
					}
				}
				else {
					if($img_width < 210* 0.6){
						$this -> Image('../images/' . $image, (210- $img_width)/ 2, null, $img_width, $img_height);
						$this -> setY($this -> getY()+ 5);
					}
					else {
						$this -> Image('../images/' . $image, 210* 0.4/ 2, null, 210* 0.6, (1/ $img_ratio)* 210* 0.6);
						$this -> setY($this -> getY()+ 5);
					}
				}
				// $this -> SetAutoPageBreak('true', 15);
			}
			
			// $this -> SetX(20);
			// $this -> Cell(0, 5, $this -> GetX());
		}
		
		function InsertAnswers(array $answers){
			$half_page_width= (210- 40)/ 2;
			$op1_width= $this -> GetStringWidth(' . ' . $answers[0]);
			$op2_width= $this -> GetStringWidth(' . ' . $answers[1]);
			$op3_width= $this -> GetStringWidth(' . ' . $answers[2]);
			$op4_width= $this -> GetStringWidth(' . ' . $answers[3]);
			
			$this -> random_array($answers); 	//change answers order
			
			$i= 0;
			$ans_list= array('A', 'B', 'C', 'D');
			
			if($op1_width < $half_page_width 
				&& $op2_width < $half_page_width
				&& $op3_width < $half_page_width
				&& $op4_width < $half_page_width
			){
				$left= true;
				foreach($answers as $ans){
					if($left === true){
						$this -> SetX(15);
						$this -> Cell($this -> GetStringWidth($ans_list[$i] . '. '), 5, ($ans_list[$i] . '. '));
						$this -> Cell($half_page_width, 5, $ans, 0, 0);
						$left= false;
						$i++;
					}
					else{
						$this -> SetX($half_page_width+ 10+ 15);
						$this -> Cell($this -> GetStringWidth($ans_list[$i] . '. '), 5, ($ans_list[$i] . '. '));
						$this -> Cell($half_page_width, 5, $ans, 0, 1);
						$left= true;
						$i++;
					}
				}
			}
			
			else{
				foreach($answers as $ans){
					$this -> SetX(15);
					$this -> Cell($this -> GetStringWidth($ans_list[$i] . '. '), 5, ($ans_list[$i] . '. '));
					$this -> MultiCell(0, 5, $ans, 0);
					$i++;
				}
			}
		}
		
		function swap(array &$arr, $index1, $index2){
			$tmp= $arr[$index1];
			$arr[$index1]= $arr[$index2];
			$arr[$index2]= $tmp;
		}
		
		function random_array(array &$arr){
			// $this -> Cell(0, 5, 'here', 0, 1);
			$length= count($arr);
			// $this -> Cell(0, 5, $length, 0, 1);
			for ($i= 0; $i < $length- 1; $i++){
				$rand= rand($i, $length- 1);
				$this -> swap($arr, $i, $rand);
			}
		}
		
		function get_lasth(){
			return $this -> lasth;
		}
	}	
	
?>
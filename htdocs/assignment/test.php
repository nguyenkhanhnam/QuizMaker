<?php
	require_once("./genpdftest.php");
	$i= 0;
	while($i < 4){
		$savepath = './test/test' . $i . '.pdf';
        $pdf->Output($savepath,'F');
		//$pdf -> Output();
		$i++;
	}
	
	
?>

<a target="_blank" href="./test/test1.pdf">See PDF1</a>
	<a target="_blank" href="./test/test2.pdf">See PDF2</a>
	<a target="_blank" href="./test/test3.pdf">See PDF3</a>
	<a target="_blank" href="./test/test4.pdf">See PDF4</a>
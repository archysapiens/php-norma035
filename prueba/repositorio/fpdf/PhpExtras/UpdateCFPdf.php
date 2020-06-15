<?php
//actualizacion del pdf ya creado 
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';

	@$rutaPdfCertifi=$_REQUEST["rutaPdfCertifi"];
	@$horInicio=$_REQUEST["horInicio"];
	@$horFinal=$_REQUEST["horFinal"];
	@$txtfecha=$_REQUEST["txtfecha"];
	@$Obser=utf8_decode($_REQUEST["Obser"]);
	@$TypeUser=$_REQUEST["TypeUser"];
	
$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("$rutaPdfCertifi");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx);

$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->setTextColor(10, 2, 1);

	if($TypeUser=='TECNICO'){ //ACTUALIZA INFORMACION	
		
		//Fecha Servicio
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(105, 70.8, 24, 3, 'F');
		$pdf->SetFontSize(7);
		$pdf->SetXY(107, 73);
		$pdf->Write(0, "$txtfecha");//fecha
		
		//HORA INICIO
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(60, 103.3, 27, 3, 'F');
		$pdf->SetFontSize(9);
		$pdf->SetXY(65, 105.5);
		$pdf->Write(0, "$horInicio");//hora de inicio

		//HORA FINAL

		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(155,103.3, 27, 3, 'F');
		$pdf->SetXY(159,105.5);
		$pdf->Write(0, "$horFinal");//hora final

		//OBSERVACIONES
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFontSize(6);
		// $pdf->Rect(40,202.5, 145, 6, 'F');
		// $pdf->SetXY(40, 205);
		// $pdf->Write(0, "$Obser");// OBSERVACIONES
				
		$countObser = strlen($Obser);
		if($countObser >= 112) {
			$obser2 = substr($Obser, 0, 112); 
			$restoObser=substr($Obser, 112);
			$pdf->SetXY(40, 202.5);
			$pdf->Cell(120,3,"$obser2",0,1,'L', true); // OBSERVACIONES
			$pdf->SetXY(40, 205.5);
			$pdf->Cell(120,3,"$restoObser",0,1,'L', true); // OBSERVACIONES
		}else{
			$pdf->SetXY(40, 202.5);
			$pdf->Cell(120,3,"$Obser",0,1,'L', true);// OBSERVACIONES
		} 

	}

	$pdf->Output('F',"$rutaPdfCertifi",'UTF-8 (true)');
?>
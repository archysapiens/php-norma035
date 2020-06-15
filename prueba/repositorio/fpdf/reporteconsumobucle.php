<?php

date_default_timezone_set('America/Mexico_City');
require_once 'fpdf.php';
require_once 'fpdi.php';
	@$noFolio="CEN17072812345";
	@$fecha_service="2017-07-27";
	@$direction="AVENIDA JOSE MARIA MORELOS, MAZATEPEC, ESTADO DE MEXICO";
	@$nomClient="INSTITUTO DE ALERGIAS Y AUTOINMUNIDAD";
	
	@$noCliente="12345";
	@$horInicio="11:00 PM";
	@$horFinal="12:30 PM";
	@$areaFumi="al lado del saguan";
	@$areaFumi1="0";
	@$areaFumi2="25";
	@$areaFumi3="50";
	@$areaFumi4="75";
	@$areaFumi5="100";
	@$plagas="MOSQUITO, PULGAS, HORMIGA, CHINCHES";
	@$method1="MOCHILA ASPERSORA MANUAL";
	@$nomComercial="BIOTHRINE CE 15";
	@$nomQuimico="(S)-ALFA-CIANO-3-FENOXIBENCIL, (1R-3R)-3-(2,2-DIBROMOVINIL)-2-2-DIMETILCICLOPROPANOCARBOXILATO";
	@$method2="TERMONEBILIZADORA";
	@$composition="DELTAMETRINA";
	@$dosis="10 ml por litro de agua";
	@$cofepris="RSCO-URB-INAC-119-313-008-2.5";
	@$nextService="Marzo-2017";
	@$Obser="NO FUMIGAR LAS PLANTAS POR QUE SE SECAN";


$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("lamparas.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);
//set position in pdf document
// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(55, 66);
$pdf->Write(0, "$noFolio");//No. Folio
$pdf->SetXY(105, 66);
$pdf->Write(0, "$fecha_service");//fecha

$pdf->SetXY(154, 66);
$pdf->Write(0, "$noCliente");//No cliente


$pdf->SetFontSize(9);
$pdf->SetXY(77, 77.5);
$pdf->Write(0, "$nomClient");//Nombre del Cliente

$pdf->SetXY(59, 85);
$pdf->Write(0, "$direction");//direccion



$pdf->SetXY(61, 92);
$pdf->Write(0, "$horInicio");//hora de inicio
$pdf->SetXY(159,92);
$pdf->Write(0, "$horFinal");//hora final
$pdf->SetFontSize(8);

$count = 20;
// $inicio = 120;
  $y = 119.9;



for($i = 0; $i < $count; $i++)
{
	

	
 $pdf->SetXY(49, $y);
 $pdf->Write(0, "$areaFumi");//UBICACION 1

$pdf->SetXY(87,  $y);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92,  $y);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99,  $y);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106,  $y);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112,  $y);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124,  $y);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136,  $y);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148,  $y);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, $y);
$pdf->Write(0, "observaciones");//observaciones

$y = $y + 3.9;
 }







$pdf->SetXY(40, 205);
$pdf->Write(0, "$Obser");// OBSERVACIONES

$pdf->SetFontSize(8);
$pdf->SetXY(40, 224.5);
$pdf->Write(0, "MILDRED HASEL NAVARRETE RODRIGUEZ");// RESPONSABLE AREA


$pdf->SetXY(120, 224.5);
$pdf->Write(0, "JESUS MARTIN SHMULKOVSSKY SANCHEZ");// TECNICO APLICADOR


// $pdf->setTextColor(240, 16, 16);
// $pdf->SetXY(79, 249);




$pdf->SetFillColor(255, 255, 255);
$pdf->Rect(80, 247.5, 105, 3, 'F');
$pdf->SetFontSize(7);

 $pdf->SetXY(78.5, 249);
$pdf->Write(0, " 01 (722) 179 78 92 y 507 42 51 ");// TECNICO APLICADOR



 $pdf->SetXY(122, 249);
 $pdf->Write(0, "San Cristóbal Huichochitlán Toluca, Edo. De México");// TECNICO APLICADOR




$pdf->Output();

?>
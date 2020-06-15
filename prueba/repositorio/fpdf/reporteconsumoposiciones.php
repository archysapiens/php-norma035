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
$pdf->SetXY(49, 120);
$pdf->Write(0, "$areaFumi");//UBICACION 1

$pdf->SetXY(87, 120);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 120);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 120);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 120);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 120);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 120);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 120);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 120);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 120);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 124);
$pdf->Write(0, "$areaFumi");//UBICACION 2

$pdf->SetXY(87, 124);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 124);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 124);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 124);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 124);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 124);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 124);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 124);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 124);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 128);
$pdf->Write(0, "$areaFumi");//UBICACION 3
$pdf->SetXY(87, 128);
$pdf->Write(0, "$areaFumi1");//%consumo
$pdf->SetXY(92, 128);
$pdf->Write(0, "$areaFumi2");//%consumo
$pdf->SetXY(99, 128);
$pdf->Write(0, "$areaFumi3");//%consumo
$pdf->SetXY(106, 128);
$pdf->Write(0, "$areaFumi4");//%consumo
$pdf->SetXY(112, 128);
$pdf->Write(0, "$areaFumi5");//%consumo
$pdf->SetXY(124, 128);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 128);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 128);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 128);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 132);
$pdf->Write(0, "$areaFumi");//UBICACION 4
$pdf->SetXY(87, 132);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 132);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 132);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 132);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 132);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 132);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 132);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 132);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 132);
$pdf->Write(0, "observaciones");//observaciones

$pdf->SetXY(49, 136);
$pdf->Write(0, "$areaFumi");//UBICACION 5
$pdf->SetXY(87, 136);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 136);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 136);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 136);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 136);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 136);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 136);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 136);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 136);
$pdf->Write(0, "observaciones");//observaciones

$pdf->SetXY(49, 140);
$pdf->Write(0, "$areaFumi");//UBICACION 6
$pdf->SetXY(87, 140);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 140);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 140);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 140);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 140);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 140);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 140);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 140);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 140);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 144);
$pdf->Write(0, "$areaFumi");//UBICACION 7
$pdf->SetXY(87, 144);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 144);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 144);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 144);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 144);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 144);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 144);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 144);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 144);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 148);
$pdf->Write(0, "$areaFumi");//UBICACION 8
$pdf->SetXY(87, 148);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 148);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 148);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 148);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 148);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 148);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 148);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 148);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 148);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 152);
$pdf->Write(0, "$areaFumi");//UBICACION 9
$pdf->SetXY(87, 152);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 152);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 152);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 152);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 152);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 152);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 152);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 152);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 152);
$pdf->Write(0, "observaciones");//observaciones



$pdf->SetXY(49, 155.5);
$pdf->Write(0, "$areaFumi");//UBICACION 10
$pdf->SetXY(87, 155.5);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 155.5);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 155.5);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 155.5);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 155.5);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 155.5);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 155.5);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 155.5);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 155.5);
$pdf->Write(0, "observaciones");//observaciones



$pdf->SetXY(49, 159.5);
$pdf->Write(0, "$areaFumi");//UBICACION 11
$pdf->SetXY(87, 159.5);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 159.5);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 159.5);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 159.5);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 159.5);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 159.5);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 159.5);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 159.5);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 159.5);
$pdf->Write(0, "observaciones");//observaciones



$pdf->SetXY(49, 163.5);
$pdf->Write(0, "$areaFumi");//UBICACION 12
$pdf->SetXY(87, 163.5);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 163.5);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 163.5);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 163.5);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 163.5);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124,163.5);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 163.5);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 163.5);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 163.5);
$pdf->Write(0, "observaciones");//observaciones




$pdf->SetXY(49, 167.5);
$pdf->Write(0, "$areaFumi");//UBICACION 13
$pdf->SetXY(87, 167.5);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 167.5);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 167.5);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 167.5);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112,167.5);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 167.5);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 167.5);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 167.5);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 167.5);
$pdf->Write(0, "observaciones");//observaciones




$pdf->SetXY(49, 171.5);
$pdf->Write(0, "$areaFumi");//UBICACION 14
$pdf->SetXY(87, 171.5);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 171.5);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 171.5);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 171.5);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 171.5);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 171.5);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 171.5);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 171.5);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 171.5);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 175);
$pdf->Write(0, "$areaFumi");//UBICACION 15
$pdf->SetXY(87, 175);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 175);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 175);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 175);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 175);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 175);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 175);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 175);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 175);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 179);
$pdf->Write(0, "$areaFumi");//UBICACION 16
$pdf->SetXY(87, 179);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 179);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 179);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 179);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 179);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 179);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 179);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 179);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 179);
$pdf->Write(0, "observaciones");//observaciones



$pdf->SetXY(49, 183);
$pdf->Write(0, "$areaFumi");//UBICACION 17
$pdf->SetXY(87, 183);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 183);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 183);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 183);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 183);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 183);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 183);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 183);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 183);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 187);
$pdf->Write(0, "$areaFumi");//UBICACION 18
$pdf->SetXY(87, 187);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 187);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 187);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 187);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 187);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 187);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 187);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 187);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 187);
$pdf->Write(0, "observaciones");//observaciones


$pdf->SetXY(49, 190.5);
$pdf->Write(0, "$areaFumi");//UBICACION 19
$pdf->SetXY(87, 190.5);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 190.5);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 190.5);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 190.5);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 190.5);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124,190.5);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 190.5);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 190.5);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 190.5);
$pdf->Write(0, "observaciones");//observaciones




$pdf->SetXY(49, 194);
$pdf->Write(0, "$areaFumi");//UBICACION 20
$pdf->SetXY(87, 194);
$pdf->Write(0, "$areaFumi1");//%consumo1
$pdf->SetXY(92, 194);
$pdf->Write(0, "$areaFumi2");//%consumo2
$pdf->SetXY(99, 194);
$pdf->Write(0, "$areaFumi3");//%consumo3
$pdf->SetXY(106, 194);
$pdf->Write(0, "$areaFumi4");//%consumo4
$pdf->SetXY(112, 194);
$pdf->Write(0, "$areaFumi5");//%consumo5
$pdf->SetXY(124, 194);
$pdf->Write(0, "si");//%limpieza
$pdf->SetXY(136, 194);
$pdf->Write(0, "X");//bueno
$pdf->SetXY(148, 194);
$pdf->Write(0, "X");//malo
$pdf->SetXY(158, 194);
$pdf->Write(0, "observaciones");//observaciones











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
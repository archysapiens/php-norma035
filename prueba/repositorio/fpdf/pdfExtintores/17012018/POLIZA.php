
<?php

date_default_timezone_set('America/Mexico_City');
require_once 'Librerias/fpdf.php';
require_once 'Librerias/fpdi.php';
	@$noFolio="CEN17072812345";
	@$fecha="2017-07-27";
	@$noCliente="12345";
	@$direction="AVENIDA JOSE MARIA MORELOS, MAZATEPEC, ESTADO DE MEXICO";
	@$nomClient="INSTITUTO DE ALERGIAS Y AUTOINMUNIDAD";
	@$cantidad="cantidad";
	@$mantenimiento="X";
	@$recarga="X";
	@$nuevo="X";
	@$pqs="X";
	@$co2="X";
	@$agua="X";
	@$afff="X";
	@$otros="otros";
	@$capacidad="capacidad";
	@$firma_autorizacion="Francisca Jimenez ";
	@$firma_tecnico="Alberto Padua Peña";
	@$firma_cliente="Maria de Jesus Martinez Castañeda";
	@$telefono=" Tel: 01 (722) 179 78 92 y 507 42 51 ";
	@$direccion="San Cristóbal Huichochitlán Toluca, Edo. De México";
	

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("Poliza_final.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);
$pdf->setFillColor(255,255,255);
//set position in pdf document
// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->SetFontSize(8);

$pdf->setTextColor(255, 0, 0);
$pdf->SetXY(57, 53);
$pdf->Cell(33,3,"$noFolio",0,1,'C'); //No. Folio

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(106, 53);
$pdf->Cell(27,3,"$fecha",0,1,'C');//No. Folio

$pdf->SetXY(154, 53);
$pdf->Cell(30,3,"$noCliente",0,1,'C');//No cliente


$pdf->SetFontSize(9);
$pdf->SetXY(74, 61);
$pdf->Cell(113,3,"$nomClient",0,1,'L', true);//Nombre del Cliente

$pdf->SetXY(57, 68);
$pdf->Cell(130,3,"$direction",0,1,'L');//direccion
/***************************tabla****************************/
$cont=4;
$y=128.8;
for($i=0; $i<=$cont; $i++){

$pdf->SetXY(36.7,$y );
$pdf->Cell(19.4,3,"$cantidad",1,1,'C');//cantidad
$pdf->SetXY(56.1,$y);
$pdf->Cell(11.9,3,"$nuevo",1,1,'C');//NUEVO
$pdf->SetXY(68, $y);
$pdf->Cell(27.8,3,"$mantenimiento",1,1,'C');//MTTO
$pdf->SetXY(95.8, $y);
$pdf->Cell(20.9,3,"$recarga",1,1,'C');//RECARGA
$pdf->SetXY(116.7, $y);
$pdf->Cell(9.3,3,"$pqs",1,1,'C');//PQS
$pdf->SetXY(126, $y);
$pdf->Cell(9.2,3,"$co2",1,1,'L');//C02
$pdf->SetXY(135.2, $y);
$pdf->Cell(11.5,3,"$agua",1,1,'L');//AGUA
$pdf->SetXY(146.7, $y);
$pdf->Cell(9.4,3,"$afff",1,1,'L');//afff
$pdf->SetXY(156.1, $y);
$pdf->Cell(13.9,3,"$otros",1,1,'L');//otros
$pdf->SetXY(170, $y);
$pdf->Cell(16.2,3,"$capacidad",1,1,'L');//CAPACIDAD
$y=$y+3;
}

/************************************************************/


$pdf->SetFontSize(7);
$pdf->SetXY(36, 229);
$pdf->Cell(45,3,"$firma_autorizacion",0,1,'C');// RESPONSABLE AREA
$pdf->SetXY(136, 229);
$pdf->Cell(46,3,"$firma_tecnico",0,1,'C');// TECNICO APLICADOR
$pdf->SetXY(86, 229);
$pdf->Cell(45,3,"$firma_cliente",0,1,'C');// TECNICO cliente

$pdf->SetXY(36, 219);
$pdf->Cell(45,10,"firma",1,1,'C'
);// RESPONSABLE AREA
$pdf->SetXY(86, 219);
$pdf->Cell(45,10,"firma",1,1,'C');//TECNICO cliente
$pdf->SetXY(136, 219);
$pdf->Cell(46,10,"firma",1,1,'C');//GERENTE OPERATIVO

$pdf->SetFontSize(7);
$pdf->SetXY(75, 247.6);
$pdf->cell(65,4,"$telefono",0,1,'C', true);// Telefono
$pdf->SetXY(122, 247.6);
$pdf->cell(65,4,"Aqui va el texto",0,1,'C', true);// direccion


$pdf->Output();

?>
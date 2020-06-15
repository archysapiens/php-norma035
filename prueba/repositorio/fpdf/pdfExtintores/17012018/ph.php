
<?php

date_default_timezone_set('America/Mexico_City');
require_once 'Librerias/fpdf.php';
require_once 'Librerias/fpdi.php';
	@$noFolio="CEN17072812345";
	@$fecha_entrega="2017-07-27";
	@$direction="AVENIDA JOSE MARIA MORELOS, MAZATEPEC, ESTADO DE MEXICO";
	@$nomClient="INSTITUTO DE ALERGIAS Y AUTOINMUNIDAD";
	@$noCliente="12345";
	
	@$cantidad="X";
	@$nuevo="X";
	@$mantenimiento="X";
	@$recarga="X";
	@$pqs="X";
	@$co2="X";
	@$agua="X";
	@$otros="X";
	@$afff="X";
    @$capacidad="X";

	@$examen_visual="X";
	@$medio_prueba="monometro";
	@$presion_operacion="10";
	@$presion_prueba="X";
	@$tiempo_duracion="X";
    @$observaciones="X";
	
	@$responsable_area="Francisca Jimenez Jimenez";
	@$firma_cliente="Maria de Jesus Martinez Castañeda";
	@$gerente="Jesus Gonzales Serna";
	@$telefono=" Tel: 01 (722) 179 78 92 y 507 42 51 ";
	@$direccion="San Cristóbal Huichochitlán Toluca, Edo. De México";
	

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("PH_final.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);
//set position in pdf document
// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->setTextColor(252, 0, 0);
$pdf->SetXY(55, 45);
$pdf->Cell(31,3,"$noFolio",0,1,'C'); //No. Folio

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(102, 45);
$pdf->Cell(30,3,"$fecha_entrega",0,1,'C'); //fecha entrega

$pdf->SetXY(154, 45);
$pdf->Cell(30,3,"$noCliente",0,1,'C');



$pdf->SetFontSize(8);
$pdf->SetXY(70, 52);
$pdf->Cell(115,3,"$nomClient",0,1,'L');


$pdf->SetXY(54, 58.3);
$pdf->Cell(131,3,"$direction",0,1,'L');



/***************************tabla****************************/
$cont=5;
$y=114;
for($i=0; $i<=$cont; $i++){
	$pdf->SetFillColor(255,255,255); 
	$pdf->SetLineWidth(0);
	

$pdf->SetXY(35.1,$y );
$pdf->Cell(19.4,6.8,"$cantidad",1,1,'C'); // cantidad
$pdf->SetXY(54.5, $y);
$pdf->Cell(11.9,6.8,"$nuevo",1,1,'C'); //nuevo
$pdf->SetXY(66.4, $y);
$pdf->Cell(27.8,6.8,"$mantenimiento",1,1,'C'); //mantenimiento

$pdf->SetXY(94.2, $y);
$pdf->Cell(20.9,6.8,"$recarga",1,1,'C'); //recarga

$pdf->SetXY(115.1, $y);
$pdf->Cell(9.3,6.8,"$pqs",1,1,'C'); //pqs

$pdf->SetXY(124.4,$y);
$pdf->Cell(9.2,6.8,"$co2",1,1,'C'); //co2

$pdf->SetXY(133.6,$y);
$pdf->Cell(11.5,6.8,"$agua",1,1,'C'); //agua


$pdf->SetXY(145.1, $y);
$pdf->Cell(9.4,6.8,"$afff",1,1,'C'); //afff

$pdf->SetXY(154.5,$y);
$pdf->Cell(13.9,6.8,"$otros",1,1,'C'); //otros

$pdf->SetXY(168.4, $y);
$pdf->Cell(16.2,6.8,"$capacidad",1,1,'C'); //capacidad


$y=$y+6.7;
}
/************************************************************/

$pdf->SetXY(61, 166.5);
$pdf->Cell(121,3,"examen_visual",0,1,'L'); //examen visual
$pdf->SetXY(64, 173);
$pdf->Cell(119,3,"$medio_prueba",0,1,'L',false);//medio de prueba

$pdf->SetXY(73, 180);
$pdf->Cell(28,3,"presion_operacion ",0,1,'L');//presion_operacion

$pdf->SetXY(154,  180);
$pdf->Cell(27,3,"presion_prueba ",0,1,'L'); //presion prueba
$pdf->SetXY(93,  186.5);
$pdf->Cell(27,3,"tiempo_duracion",0,1,'L');//tiempo_duracion

$pdf->SetXY(62.4, 193);
$pdf->Cell(119,3,"observaciones",0,1,'L');//observaciones
$pdf->SetXY(36, 197);
$pdf->Cell(145,3,"observaciones",0,1,'L');//observaciones

$pdf->SetXY(180.5, 193.4);
$pdf->Cell(120,3,"|",0,1,'L');//salto de linea observaciones

$pdf->SetXY(34, 197);
$pdf->Cell(120,3,"|",0,1,'L');//salto de linea observaciones





$pdf->SetFontSize(7);
$pdf->SetXY(35.5, 212.3);
$pdf->Cell(43,3,"$responsable_area",0,1,'C',true);// RESPONSABLE AREA
$pdf->SetXY(84.5, 212.3);
$pdf->Cell(46,3,"$firma_cliente",0,1,'C');//TECNICO cliente
$pdf->SetXY(135, 212.3);
$pdf->Cell(45,3,"$gerente",0,1,'C',true);//GERENTE OPERATIVO

$pdf->SetXY(35.5, 202);
$pdf->Cell(43,10,"firma",1,1,'C',true);// RESPONSABLE AREA
$pdf->SetXY(84.5, 202);
$pdf->Cell(46,10,"firma",1,1,'C');//TECNICO cliente
$pdf->SetXY(135, 202);
$pdf->Cell(45,10,"firma",1,1,'C',true);//GERENTE OPERATIVO

$pdf->SetFontSize(7);
$pdf->SetXY(65, 237);
$pdf->cell(65,4,"$telefono",0,1,'C', true);// Telefono
$pdf->SetXY(122, 237);
$pdf->cell(65,4,"Aqui va el texto",0,1,'C', true);// direccion





$pdf->Output();

?>
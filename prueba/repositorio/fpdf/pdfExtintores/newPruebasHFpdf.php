<?php
error_reporting(E_ALL);
	ini_set('display_errors', '1');
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';
	@$noFolio=$_REQUEST["noFolio"];
	@$fecha_service=$_REQUEST["fecha_service"];
	@$direction=utf8_decode($_REQUEST["direction"]);
	@$nomClient=utf8_decode($_REQUEST["nomClient"]);
	@$sucursal=utf8_decode($_REQUEST["sucursal"]);
	@$noCliente=$_REQUEST["noCliente"];	
	@$examVisu=$_REQUEST["examVisu"];
	@$medioPrue=$_REQUEST["medioPrue"];
	@$presOpe=$_REQUEST["presOpe"];
	@$presPrue=$_REQUEST["presPrue"];
	@$duraPrue=$_REQUEST["duraPrue"];
	@$Obser=strtoupper(utf8_decode($_REQUEST["Obser"]));
	@$areaOperativa=$_REQUEST["areaOperativa"];
	
	@$agenteExtAE=utf8_encode(""); @$cantidadAE=utf8_decode(""); @$capacidadAE=utf8_decode(""); @$agenteExtOtroAE=utf8_decode(""); @$typeService_object=utf8_decode("");
	$agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
	$mantenimiento=utf8_decode(""); $recarga=utf8_decode(""); $nuevo=utf8_decode("");
	@$responsable=utf8_decode($_REQUEST["responsable"]);
		if($responsable==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM altas_responsable_area where id=$responsable limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$responsable=utf8_decode($fila["NOMBRE"]); }
		}
	@$tecnico=utf8_decode($_REQUEST["tecnico"]);
		if($tecnico==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_tecnico_aplicador where id=$tecnico limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$tecnico=utf8_decode($fila["NOMBRE"]); }
		}
		if($sucursal=='TOLUCA'){
			$X_Direc=193;
			$DireccionSucursal=utf8_decode("San Cristóbal Huichochitlán Toluca, Edo. De México");
			$TelSucursal=utf8_decode("01 (722) 179 78 92 y 507 42 51");
		}elseif($sucursal=='ATLACOMULCO'){
			$X_Direc=102;
			$DireccionSucursal=utf8_decode("Jose María Becerril S/N Parque Industrial Atlacomulco Edo. De México");
			$TelSucursal=utf8_decode("717121248524");
		}else{
			$X_Direc=193;
			$DireccionSucursal=utf8_decode("");
			$TelSucursal=utf8_decode("");
		}

	//Lectura del archivo Json para traer el campo ubicacion	
	$fileJson = '../../../repositorio/DataJson/DataExtintores/PolizaGarantia/'.$sucursal.'/dataReport'.$noCliente.'.json';
	$str_datos = json_decode(file_get_contents("$fileJson"),true);

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("PHActual.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);

$pdf->SetFont('Arial');
$pdf->SetFontSize(7);
$pdf->setTextColor(255, 0, 0);

$pdf->SetXY(55, 44.5);
$pdf->Cell(31,3,"$noFolio",0,1,'C'); //No. Folio
$pdf->SetFontSize(7);
$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(102, 44.5);
$pdf->Cell(30,3,"$fecha_service",0,1,'C'); //fecha
$pdf->SetFontSize(8);
$pdf->SetXY(154, 44.5);
$pdf->Cell(30,3, "$noCliente",0,1,'C');//No cliente

$pdf->SetFontSize(7);
$pdf->SetXY(70, 51.5);
$pdf->Cell(115,3, "$nomClient",0,1,'L');//Nombre del Cliente

if(strlen($direction)>87){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
if(strlen($direction)>120){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(6); }

$pdf->SetXY(54, 58.3);
$pdf->Cell(131,3, "$direction",0,1,'L');//direccion
$pdf->SetFontSize(7);

// ContactSucursal();

$count = count($str_datos['rows']);
if($count<=6 or $count>6){ $count=6; }
$y = 114;
for($i = 0; $i < $count; $i++){
	@$typepdfAE=utf8_decode($str_datos['rows'][$i]['TypePdf']);
	if($typepdfAE=='PH'){
		@$cantidadAE=utf8_decode($str_datos['rows'][$i]['Cantidad']);
		@$typeService_object=utf8_decode($str_datos['rows'][$i]['TypeService']);
		if($typeService_object=='Mantenimiento'){ $mantenimiento=utf8_decode('x'); }
		if($typeService_object=='Recarga'){ $recarga=utf8_decode('x'); }
		if($typeService_object=='Nuevo'){ $nuevo=utf8_decode('x'); }
		@$agenteExtAE=utf8_decode($str_datos['rows'][$i]['AgenteExt']);
		if($agenteExtAE=='PQS'){ $agenteExtAE1=utf8_decode('x'); }
		if($agenteExtAE=='Agua'){ $agenteExtAE2=utf8_decode('x'); }
		if($agenteExtAE=='AFFF'){ $agenteExtAE3=utf8_decode('x'); }
		if($agenteExtAE=='CO2'){ $agenteExtAE4=utf8_decode('x'); }
		@$agenteExtOtroAE=utf8_decode($str_datos['rows'][$i]['AgenteExtOtros']);
		@$capacidadAE=utf8_decode($str_datos['rows'][$i]['Capacidad']);
		
		$numero=$i+1;
		$pdf->SetFillColor(255,255,255); 
		$pdf->SetLineWidth(0);
		$pdf->SetXY(35.1,$y);
		$pdf->Cell(19.4,6.8,"$cantidadAE",1,1,'C', true); // cantidad
		$pdf->SetXY(54.5, $y);
		$pdf->Cell(11.9,6.8,"$nuevo",1,1,'C', true); //nuevo
		$pdf->SetXY(66.4, $y);
		$pdf->Cell(27.8,6.8,"$mantenimiento",1,1,'C', true); //mantenimiento
		$pdf->SetXY(94.2, $y);
		$pdf->Cell(20.9,6.8,"$recarga",1,1,'C', true); //recarga
		$pdf->SetXY(115.1, $y);
		$pdf->Cell(9.3,6.8,"$agenteExtAE1",1,1,'C', true); //pqs
		$pdf->SetXY(124.4,$y);
		$pdf->Cell(9.2,6.8,"$agenteExtAE4",1,1,'C', true); //co2
		$pdf->SetXY(133.6,$y);
		$pdf->Cell(11.5,6.8,"$agenteExtAE2",1,1,'C', true); //agua
		$pdf->SetXY(145.1, $y);
		$pdf->Cell(9.4,6.8,"$agenteExtAE3",1,1,'C', true); //afff
		$pdf->SetXY(154.5,$y);
		$pdf->Cell(13.9,6.8,"$agenteExtOtroAE",1,1,'L', true); //otros
		$pdf->SetXY(168.4, $y);
		$pdf->Cell(16.2,6.8,"$capacidadAE",1,1,'C', true); //capacidad

		$y = $y + 6.7;
		
		//limpiar variables
			$mantenimiento=utf8_decode(""); $recarga=utf8_decode(""); $nuevo=utf8_decode("");
			$agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
	}
	
}

$pdf->SetXY(61, 166);
$pdf->Cell(121,3,"$examVisu",0,1,'L'); //examen visual
$pdf->SetXY(64, 172.5);
$pdf->Cell(119,3,"$medioPrue",0,1,'L');//medio de prueba

$pdf->SetXY(73, 179.5);
$pdf->Cell(28,3,"$presOpe ",0,1,'L');//presion_operacion

$pdf->SetXY(154,  179.5);
$pdf->Cell(27,3,"$presPrue ",0,1,'L'); //presion prueba
$pdf->SetXY(93,  186.4);
if(strlen($duraPrue)>17){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->Cell(27,3,"$duraPrue",0,1,'L');//tiempo_duracion
$pdf->SetFontSize(6);

$countObser = strlen($Obser);
if($countObser >= 92){
	$obser2 = substr($Obser, 0, 92); 
	$restoObser=substr($Obser, 92, 115);
	$pdf->SetXY(62.4, 193.3);
	$pdf->Cell(119,3,"$obser2",0,1,'L');// OBSERVACIONES
	$pdf->SetXY(36, 197);
	$pdf->Cell(145,3,"$restoObser",0,1,'L');// OBSERVACIONES
	if($countObser >= 207){
		$Obser3=substr($Obser, 207);
		$pdf->SetXY(36, 201);
		$pdf->Cell(145,3,"$Obser3",0,1,'L');// OBSERVACIONES		
	}
}else{
	$pdf->SetXY(62.4, 193);
	$pdf->Cell(119,3,"$Obser",0,1,'L');// OBSERVACIONES
} 
	
if(strlen($areaOperativa)>34){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(35.5, 212.3);
$pdf->Cell(43,3,"$areaOperativa",0,1,'C'); // RESPONSABLE AREA

/* Agregamos Firma por si es la segunda vez que guarda este PDF */
	$hrefRutaFirma="../../../web/images/FileUpload/FirmasOrdenT/PolizaGarantia/$sucursal/".$areaOperativa."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirma)){ $pdf->Image("$hrefRutaFirma",48,199,20,20); }
	
	$hrefRutaFirmaC="../../../web/images/FileUpload/FirmasOrdenT/PolizaGarantia/$sucursal/".$nomClient."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaC)){ $pdf->Image("$hrefRutaFirmaC",100,199,20,20); }

	$hrefRutaFirmaR="../../../web/images/FileUpload/FirmasOrdenT/PolizaGarantia/$sucursal/".$responsable."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaR)){ $pdf->Image("$hrefRutaFirmaR",150,199,20,20); }
 
	$hrefRutaCodeBar="../../../web/images/FileUpload/BarCode/".$noFolio.".png";
	if(file_exists($hrefRutaCodeBar)){ $pdf->Image($hrefRutaCodeBar.$noFolio.'.png',155,33,30,0,'PNG'); } 
/* Agregamos Firma por si es la segunda vez que guarda este PDF */	

if(strlen($responsable)>34){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(135, 212.3);
$pdf->Cell(45,3,"$responsable",0,1,'C');  // GERENTE OPERATIVO

if(strlen($nomClient)>34){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(84.5, 212.3);
$pdf->Cell(46,3,"$nomClient",0,1,'C');  // CLIENTE

function ContactSucursal(){
	
	global $TelSucursal, $DireccionSucursal, $pdf, $X_Direc;
	
	$pdf->SetFillColor(255,255,255);
	$pdf->Rect(80, 247.5, 105, 3, 'F');
	$pdf->SetFontSize(7);

	$pdf->SetXY(75, 249);
	$pdf->Cell(50,2,"Tel: $TelSucursal",0,1,'C',true);
	$pdf->SetXY(122, 249);
	$pdf->Cell(73,2, "$DireccionSucursal",0,1,'C',true);
}

$nombre_fichero = '../../../web/UploadPdf/PdfExtintores/PruebasH/'.$sucursal.'';

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/PruebasH/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/PruebasH/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}

$pdf->Output();
?>
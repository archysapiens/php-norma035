<?php
sleep(3);
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
$pageCount = $pdf->setSourceFile("PGActual.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);

$pdf->SetFont('Arial');
$pdf->SetFontSize(7);
$pdf->setTextColor(255, 0, 0);

$pdf->SetXY(57, 52.5);
$pdf->Cell(33,3,"$noFolio",0,1,'C'); //No. Folio
$pdf->SetFontSize(7);
$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(106, 52.5);
$pdf->Cell(27,3,"$fecha_service",0,1,'C'); //fecha
$pdf->SetFontSize(8);
$pdf->SetXY(154, 52.5);
$pdf->Cell(30,3,"$noCliente",0,1,'C');//No cliente

$pdf->SetFontSize(7);
$pdf->SetXY(74, 61);
$pdf->Cell(113,3,"$nomClient",0,1,'L');//Nombre del Cliente

if(strlen($direction)>87){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
if(strlen($direction)>120){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(6); }
$pdf->SetXY(57, 68);
$pdf->Cell(130,3,"$direction",0,1,'L');//direccion
$pdf->SetFontSize(7);

// ContactSucursal();

$count = count($str_datos['rows']);
if($count<=7 or $count>7){ $count=7; }
$y = 128.8;
for($i = 0; $i < $count; $i++){
	@$typepdfAE=utf8_decode($str_datos['rows'][$i]['TypePdf']);
	if($typepdfAE=='PG'){		
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
		$pdf->SetXY(36.7,$y );
		$pdf->Cell(19.4,3.5,"$cantidadAE",1,1,'C', true);//CANTIDAD
		$pdf->SetXY(56.1,$y);
		$pdf->Cell(11.9,3.5,"$nuevo",1,1,'C', true);//NUEVO
		$pdf->SetXY(68, $y);
		$pdf->Cell(27.8,3.5,"$mantenimiento",1,1,'C', true);//MANTENIMIENTO
		$pdf->SetXY(95.8, $y);
		$pdf->Cell(20.9,3.5,"$recarga",1,1,'C', true);//RECARGA
		$pdf->SetXY(116.7, $y);
		$pdf->Cell(9.3,3.5,"$agenteExtAE1",1,1,'C', true);//PQS
		$pdf->SetXY(126, $y);
		$pdf->Cell(9.2,3.5,"$agenteExtAE4",1,1,'C', true);//C02
		$pdf->SetXY(135.2, $y);
		$pdf->Cell(11.5,3.5,"$agenteExtAE2",1,1,'C', true);//AGUA
		$pdf->SetXY(146.7, $y);
		$pdf->Cell(9.4,3.5,"$agenteExtAE3",1,1,'C', true);//AFFF
		$pdf->SetXY(156.1, $y);
		$pdf->Cell(13.9,3.5,"$agenteExtOtroAE",1,1,'L', true);//OTROS
		$pdf->SetXY(170, $y);
		$pdf->Cell(16.2,3.5,"$capacidadAE",1,1,'C', true);//CAPACIDAD

		$y = $y + 3.5;
		
		//limpiar variables
			$mantenimiento=utf8_decode(""); $recarga=utf8_decode(""); $nuevo=utf8_decode("");
			$agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
	}
}
	
if(strlen($areaOperativa)>30){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(36, 229);
$pdf->Cell(45,3,"$areaOperativa",0,1,'C'); // RESPONSABLE AREA

/* Agregamos Firma por si es la segunda vez que guarda este PDF */
	$hrefRutaFirma="../../../web/images/FileUpload/FirmasOrdenT/PolizaGarantia/$sucursal/".$areaOperativa."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirma)){ $pdf->Image("$hrefRutaFirma",48,213,20,20); }
	
	$hrefRutaFirmaC="../../../web/images/FileUpload/FirmasOrdenT/PolizaGarantia/$sucursal/".$nomClient."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaC)){ $pdf->Image("$hrefRutaFirmaC",100,213,20,20); }

	$hrefRutaFirmaR="../../../web/images/FileUpload/FirmasOrdenT/PolizaGarantia/$sucursal/".$responsable."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaR)){ $pdf->Image("$hrefRutaFirmaR",150,213,20,20); }
	
	$hrefRutaCodeBar="../../../web/images/FileUpload/BarCode/".$noFolio.".png";
	if(file_exists($hrefRutaCodeBar)){ $pdf->Image($hrefRutaCodeBar.$noFolio.'.png',150,43,38,0,'PNG'); } 
/* Agregamos Firma por si es la segunda vez que guarda este PDF */	

if(strlen($responsable)>27){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(136, 229);
$pdf->Cell(46,3,"$responsable",0,1,'C');  // GERENTE OPERATIVO

if(strlen($nomClient)>30){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(86, 229);
$pdf->Cell(45,3,"$nomClient",0,1,'C');  // CLIENTE

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

$nombre_fichero = '../../../web/UploadPdf/PdfExtintores/PolizaGarantia/'.$sucursal.'';

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/PolizaGarantia/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/PolizaGarantia/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}

$pdf->Output();
?>
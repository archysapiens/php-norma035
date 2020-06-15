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
	@$ExtintoresLib=$_REQUEST["ExtintoresLib"];
	@$CordinadorExt=$_REQUEST["CordinadorExt"];
	@$Obser=strtoupper(utf8_decode($_REQUEST["Obser"]));
	
	@$agenteExtAE=utf8_encode(""); @$capacidadAE=utf8_decode(""); @$manometrAE=utf8_decode(""); @$seguroAE=utf8_decode(""); @$boquillAE=utf8_decode(""); @$manguerAE=utf8_decode(""); @$bastagoAE=utf8_decode(""); @$pinturAE=utf8_decode(""); @$etiquetAE=utf8_decode(""); @$mattoAE=utf8_decode(""); @$pesoFinal=utf8_decode(""); @$fugatina=utf8_decode(""); @$Reviso=utf8_decode("");
	$agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
	$mantenimiento=utf8_decode(""); $recarga=utf8_decode(""); $nuevo=utf8_decode("");
	
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
	$fileJson = '../../../repositorio/DataJson/DataExtintores/CheckList/'.$sucursal.'/dataReport'.$noCliente.'.json';
	$str_datos = json_decode(file_get_contents("$fileJson"),true);

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("CLActual.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);

$pdf->SetFont('Arial');
$pdf->SetFontSize(7);
$pdf->setTextColor(10, 2, 1);

$pdf->SetFontSize(7);
$pdf->SetXY(51, 42.3);
$pdf->Cell(88,3, "$nomClient",0,1,'L');//Empresa

$pdf->SetXY(158, 42.3);
$pdf->Cell(25,3,"$noCliente",0,1,'C');// numero de cliente

$pdf->SetXY(81, 49);
$pdf->Cell(33.3,3, "$ExtintoresLib",0,1,'L');//extintores a liberar


$pdf->SetXY(134, 49);
$pdf->Cell(49,3, "$noFolio",0,1,'C');//Numero de folio

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(48, 56.3);
$pdf->Cell(31,3,"$fecha_service",0,1,'C');//fecha

$pdf->SetXY(119, 56.3);
$pdf->Cell(64,3, "$CordinadorExt",0,1,'L');//Ccordinador de extintores


$pdf->SetFontSize(5);

// ContactSucursal();

$count = count($str_datos['rows']);
$y = 73.9;
for($i = 0; $i < $count; $i++){
			
		@$capacidadAE=utf8_decode($str_datos['rows'][$i]['Capacidad']);
		@$Manometro=utf8_decode($str_datos['rows'][$i]['Manometro']);
		if($Manometro=='Si'){ $Manometro=utf8_decode('/'); }
		if($Manometro=='No'){ $Manometro=utf8_decode('X'); }
		@$Seguro=utf8_decode($str_datos['rows'][$i]['Seguro']);
		if($Seguro=='Si'){ $Seguro=utf8_decode('/'); }
		if($Seguro=='No'){ $Seguro=utf8_decode('X'); }
		@$Boquilla=utf8_decode($str_datos['rows'][$i]['Boquilla']);
		if($Boquilla=='Si'){ $Boquilla=utf8_decode('/'); }
		if($Boquilla=='No'){ $Boquilla=utf8_decode('X'); }
		@$Manguera=utf8_decode($str_datos['rows'][$i]['Manguera']);
		if($Manguera=='Si'){ $Manguera=utf8_decode('/'); }
		if($Manguera=='No'){ $Manguera=utf8_decode('X'); }
		@$Bastago=utf8_decode($str_datos['rows'][$i]['Bastago']);
		if($Bastago=='Si'){ $Bastago=utf8_decode('/'); }
		if($Bastago=='No'){ $Bastago=utf8_decode('X'); }
		@$Pintura=utf8_decode($str_datos['rows'][$i]['Pintura']);
		if($Pintura=='Si'){ $Pintura=utf8_decode('/'); }
		if($Pintura=='No'){ $Pintura=utf8_decode('X'); }
		@$Etiqueta=utf8_decode($str_datos['rows'][$i]['Etiqueta']);
		if($Etiqueta=='Si'){ $Etiqueta=utf8_decode('/'); }
		if($Etiqueta=='No'){ $Etiqueta=utf8_decode('X'); }		
		
		@$Recarga=utf8_decode($str_datos['rows'][$i]['Recarga']);
		// if($Recarga=='Mantenimiento'){ $mantenimiento=utf8_decode('x'); }
		// if($Recarga=='Recarga'){ $recarga=utf8_decode('x'); }
		// if($Recarga=='Nuevo'){ $nuevo=utf8_decode('x'); }
		@$agenteExtAE=utf8_decode($str_datos['rows'][$i]['AgenteExt']);
		// if($agenteExtAE=='PQS'){ $agenteExtAE1=utf8_decode('x'); }
		// if($agenteExtAE=='Agua'){ $agenteExtAE2=utf8_decode('x'); }
		// if($agenteExtAE=='AFFF'){ $agenteExtAE3=utf8_decode('x'); }
		// if($agenteExtAE=='CO2'){ $agenteExtAE4=utf8_decode('x'); }
		@$PesoFinal=utf8_decode($str_datos['rows'][$i]['PesoFinal']);
		@$Fugatina=utf8_decode($str_datos['rows'][$i]['Fugatina']);
		@$Reviso=utf8_decode($str_datos['rows'][$i]['Reviso']);
		
		$numero=$i+1;
		$pdf->SetFillColor(255,255,255); 
		$pdf->SetLineWidth(0);
		$pdf->SetXY(37.2, $y);
		$pdf->Cell(8,4,"$numero",1,1,'C',true);  //folio
		$pdf->SetXY(45.2, $y);
		$pdf->Cell(10.7,4,"$capacidadAE",1,1,'C',true);  //capacidad                   
		$pdf->SetXY(55.9, $y);
		$pdf->Cell(10.2,4,"$agenteExtAE",1,2,'C',true); //agente
		$pdf->SetXY(66, $y);
		$pdf->Cell(9.7,4,"$Manometro",1,2,'C',true); //manometro
		$pdf->SetXY(75.8, $y);
		$pdf->Cell(10.5,4,"$Seguro",1,2,'C',true); //seguro
		$pdf->SetXY(86.3, $y);
		$pdf->Cell(11.3,4,"$Boquilla",1,2,'C',true); //Boquilla
		$pdf->SetXY(97.6, $y);
		$pdf->Cell(13.4,4,"$Manguera",1,2,'C',true); // manguera
		$pdf->SetXY(111, $y);
		$pdf->Cell(11.6,4,"$Bastago",1,2,'C',true); //Bastago
		$pdf->SetXY(122.6, $y);
		$pdf->Cell(10.4,4,"$Pintura",1,2,'C',true); // Pintura
		$pdf->SetXY(133, $y);
		$pdf->Cell(11.7 ,4,"$Etiqueta",1,2,'C',true); // etiqueta
		$pdf->SetXY(144.5, $y);
		$pdf->Cell(12.2,4,"$Recarga",1,2,'C',true); //recarga
		$pdf->SetXY(156.4, $y);
		$pdf->Cell(8.45,4,"$Pesofinal",1,2,'C',true); //peso
		$pdf->SetXY(164.85, $y);
		$pdf->Cell(8.55,4,"$Fugatina",1,2,'C',true); //fugatina
		$pdf->SetXY(173.4, $y);
		$pdf->Cell(10,4,"$Reviso",1,2,'C',true);  //reviso

		$y = $y + 3.5;
		
		// //limpiar variables
			// $mantenimiento=utf8_decode(""); $recarga=utf8_decode(""); $nuevo=utf8_decode("");
			// $agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
}

$pdf->SetFontSize(7);

$countObser = strlen($Obser);
if($countObser >= 82) {
	$obser2 = substr($Obser, 0, 82); 
	$restoObser=substr($Obser, 82);
	$pdf->SetXY(59, 212.7);
	$pdf->Cell(121,3,"$obser2",0,1,'L');// OBSERVACIONES
	$pdf->SetXY(37, 216.4);
	$pdf->Cell(143,3,"$restoObser",0,1,'L');// OBSERVACIONES
}else{
	$pdf->SetXY(59, 212.7);
	$pdf->Cell(121,3,"$Obser",0,1,'L');// OBSERVACIONES
} 

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

$nombre_fichero = '../../../web/UploadPdf/PdfExtintores/CheckList/'.$sucursal.'';

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/CheckList/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/CheckList/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}

$pdf->Output();
?>
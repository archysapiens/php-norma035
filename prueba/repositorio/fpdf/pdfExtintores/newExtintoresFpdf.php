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
	@$fechaRecolect=$_REQUEST["fechaRecolect"];
	@$fechaEntrega=$_REQUEST["fechaEntrega"];
	@$cantidad=$_REQUEST["cantidad"];
	@$servicio=$_REQUEST["servicio"];
	@$pruebaH=$_REQUEST["pruebaH"];
	@$typeService=$_REQUEST["typeService"];
	@$extPrestado=$_REQUEST["extPrestado"];
	@$extRecolect=$_REQUEST["extRecolect"];
	@$extFaltantes=$_REQUEST["extFaltantes"];
	@$cantidadAire=$_REQUEST["cantidadAire"];
	@$servicioAire=$_REQUEST["servicioAire"];
	@$pruebaHAire=$_REQUEST["pruebaHAire"];
	@$areaOperativa=$_REQUEST["areaOperativa"];
	@$recibiDe=strtoupper($_REQUEST["recibiDe"]);
	@$recibiDe=str_replace("ñ","Ñ",$recibiDe);
	@$precioNum=$_REQUEST["precioNum"];
	@$precioLetras=ucwords(strtolower($_REQUEST["precioLetras"]));
	@$valid=$_REQUEST["valid"];
	
	@$agenteExtAE=utf8_encode(""); @$cantidadAE=utf8_decode(""); @$capacidadAE=utf8_decode(""); @$agenteExtOtroAE=utf8_decode(""); @$obser_object=utf8_decode("");
	$agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
	$TypeService1=utf8_decode(""); $TypeService2=utf8_decode("");
	
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
	// $fileJson = '../../../repositorio/DataJson/DataExtintores/OrdenDeTrabajo/'.$sucursal.'/dataReport'.$noCliente.'.json';
	// $str_datos = json_decode(file_get_contents("$fileJson"),true);
	//Traer datos de la tabla Orden_ext
	$sqlOrdenT = "SELECT ID_OBJETO,CANTIDAD_AE,CAPACIDAD_AE,AGENTE_EXT,AGENTE_EXT_OTROS,OBSERV_AE,TECNICO_APLICADOR,RESPONSABLE_AREA,NOM_CLIENTE FROM ordent_ext WHERE NO_FOLIO='$noFolio' AND ID_OBJETO <> '' AND TIPO_REGISTRO='AgenteExt' ORDER BY CAST(ID_OBJETO AS UNSIGNED), ID_OBJETO"; $stmtOrdenT = $db->select($sqlOrdenT);
	$countOrdenT_Ext = count($stmtOrdenT);	

$pdf = new FPDI('L','mm','A4');
$pageCount = $pdf->setSourceFile("newExtintoresActual.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 264,197);

$pdf->SetFont('Arial');
$pdf->SetFontSize(9);
$pdf->setTextColor(255, 0, 0);
$pdf->SetXY(224.3, 57);
$pdf->Cell(36,5,"$noFolio",0,1,'C'); //No. Folio
$pdf->SetFontSize(7);
$pdf->setTextColor(10, 2, 1);
if($valid!='false'){
	$pdf->SetFillColor(255,255,255);
	$pdf->SetXY(122, 48.6);
	$pdf->Cell(29,3,"$fechaRecolect",0,1,'C',true); //fecha_recoleccion
	$pdf->SetXY(186, 48.6);
	$pdf->Cell(27,3,"$fechaEntrega",0,1,'C',true); //fecha_entrega	
}
$pdf->SetFontSize(8);
$pdf->SetXY(53, 48.6);
$pdf->Cell(30,3, "$noCliente",0,1,'C');//No cliente

$pdf->SetFontSize(7);
$pdf->SetXY(68, 53.2);
$pdf->Cell(147,3, "$nomClient",0,1,'L');//Nombre del Cliente

if(strlen($direction)>90){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
if(strlen($direction)>123){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(51, 57.6);
$pdf->Cell(164,3, "$direction",0,1,'L');//direccion
$pdf->SetFontSize(7);

ContactSucursal();

$count = count($str_datos['rows']);
if($count<=5 or $count>5){ $count=5; }
$y = 78.5;
for($i = 0; $i < $count; $i++){
	@$cantidadAE=utf8_decode(@$stmtOrdenT[$i]['CANTIDAD_AE']); @$capacidadAE=utf8_decode(@$stmtOrdenT[$i]['CAPACIDAD_AE']); @$agenteExtOtroAE=utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT_OTROS']); @$obser_object=utf8_decode(@$stmtOrdenT[$i]['OBSERV_AE']);				
				
		if(utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT'])=='?'){$agenteExtAE4= $agenteExtAE2= $agenteExtAE3= $agenteExtAE1 = utf8_decode(' ');
		}elseif(utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT'])==''){$agenteExtAE4= $agenteExtAE2= $agenteExtAE3= $agenteExtAE1 = utf8_decode(' ');
		}elseif(utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT'])=='PQS'){$agenteExtAE4= $agenteExtAE2= $agenteExtAE3= ""; $agenteExtAE1 = utf8_decode('x');
		}elseif(utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT'])=='CO2'){$agenteExtAE4= $agenteExtAE1= $agenteExtAE3= ""; $agenteExtAE2 = utf8_decode('x');
		}elseif(utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT'])=='Agua'){$agenteExtAE4= $agenteExtAE2= $agenteExtAE1= ""; $agenteExtAE3 = utf8_decode('x');
		}elseif(utf8_decode(@$stmtOrdenT[$i]['AGENTE_EXT'])=='AFFF'){$agenteExtAE1= $agenteExtAE2= $agenteExtAE3= ""; $agenteExtAE4 = utf8_decode('x');}
			
	$numero=$i+1;
	$pdf->SetFillColor(255,255,255); 
	$pdf->SetLineWidth(0);
	$pdf->SetXY(33.7, $y);
	$pdf->Cell(25,4,"$cantidadAE",1,2,'C',true);  //cantidad
	$pdf->SetXY(57.2, $y);
	$pdf->Cell(25,4,"$capacidadAE",1,2,'C',true);  //capacidad
	$pdf->SetXY(80.8,  $y);
	$pdf->Cell(15,4,"$agenteExtAE1",1,2,'C',true);  //%agenteExt
	$pdf->SetXY(95.2,  $y);
	$pdf->Cell(17,4,"$agenteExtAE2",1,2,'C',true);  //%agenteExt
	$pdf->SetXY(111.5,  $y);	
	$pdf->Cell(17.5,4,"$agenteExtAE3",1,2,'C',true);  //%agenteExt
	$pdf->SetXY(128.3,  $y);
	$pdf->Cell(15,4,"$agenteExtAE4",1,2,'C',true);  //%agenteExt
	$pdf->SetXY(142.3,  $y);
	$pdf->Cell(27,4,"$agenteExtOtroAE",1,2,'C',true);  //%agenteExt
	$pdf->SetXY(168.5, $y);
	$pdf->Cell(45.5,4,"$obser_object",1,2,'L',true);  //observaciones

	$y = $y + 3.9;
}

if($valid!='false'){
//Type Service
	if(utf8_decode($typeService)=='Recarga'){$TypeService1=utf8_decode(""); $TypeService2 = utf8_decode('x');
	}elseif(utf8_decode($typeService)=='Mantenimiento'){$TypeService1=utf8_decode("x"); $TypeService2 = utf8_decode(''); }
	$pdf->SetXY(226, 79);
	$pdf->Cell(8,2,"$TypeService1",0,1,'C',true); //mantenimiento
	$pdf->SetXY(226, 85.7);
	$pdf->Cell(8,2,"$TypeService2",0,1,'C',true); //recarga
	
//Mangueras contra incendios
	$pdf->SetXY(34, 110.5);
	$pdf->Cell(17,2,"$cantidad",0,1,'C',true);//cantidad mangueras
	$pdf->SetXY(34,  117.5);
	$pdf->Cell(17,2,"$servicio",0,1,'C',true);//mangueras servicio
	$pdf->SetXY(34,  123.7);
	$pdf->Cell(17,2,"$pruebaH",0,1,'C',true);//pruebas hidrostaticas mangueras
}
//table Refacciones
	
	//traer datos de la tabla Orden_ext
		$sqlOrdenT_Refaccion = "SELECT ID_REFACCIONES,PIEZAS_REFACCION FROM ordent_ext WHERE NO_FOLIO='$noFolio' AND ID_REFACCIONES <> '' AND TIPO_REGISTRO='RefacExt'"; $stmtOrdenT_Refac = $db->select($sqlOrdenT_Refaccion);			
	
	$count = 5;
	$c = 109.9;						
	for($i = 0; $i < $count; $i++) {					
		@$refaccion=""; @$piezas=""; 											
		@$refaccion=@$stmtOrdenT_Refac[$i]['ID_REFACCIONES']; @$piezas=@$stmtOrdenT_Refac[$i]['PIEZAS_REFACCION'];											
	
		$numero=$i+1;
		$pdf->SetFillColor(255,255,255);
		$pdf->SetLineWidth(0);
		$pdf->SetXY(92.8, $c);
		$pdf->Cell(34.8,4,"$refaccion",1,1,'C',true);  //refaccion
		$pdf->SetXY(127.35, $c);
		$pdf->Cell(15.9,4,"$piezas",1,1,'C',true);  //piezas					

		$c = $c + 3.95;				
	}
	
	if($valid!='false'){
	//Ext. Emergentes
		$pdf->SetXY(153,  110.5);
		$pdf->Cell(18,2,"$extPrestado",0,1,'C',true);//ext emergentes prestados
		$pdf->SetXY(153,  117.3);
		$pdf->Cell(18,2,"$extRecolect",0,1,'C',true);//ext emergentes recolectados
		$pdf->SetXY(153,  123.7);
		$pdf->Cell(18,2,"$extFaltantes",0,1,'C',true);//ext emergentes faltantes
		
	//Aire Autónomo
		$pdf->SetXY(209, 110.7);
		$pdf->Cell(18,2,"$cantidadAire",0,1,'C',true);//cantidad aire autonomo
		$pdf->SetXY(209, 117.1);
		$pdf->Cell(18,2,"$servicioAire",0,1,'C',true);// servicio aire autonomo
		$pdf->SetXY(209, 123.7);
		$pdf->Cell(18,2,"$pruebaHAire",0,1,'C',true);// pruebas hidrostaticas
	}
//legenda
	$pdf->setFillColor(255, 255, 255);
	$pdf->SetXY(153, 133);
	$pdf->Cell(100,14,'','','','C', true);
		
	$pdf->SetFontSize(6.5);	
	$pdf->SetXY(153, 135);
	$pdf->Cell(30,3,utf8_decode("Recibí de $recibiDe Extintores emergentes de P.Q.S. y CO2., en calidad de préstamo"),'C');// recibi en caso de prestamo
	$pdf->SetXY(153, 137.5);
	$pdf->Cell(30,3,utf8_decode("por el tiempo que duren mis equipos en su talles de servicio, así mismo me comprometo a"),'C');// salto de linea
	$pdf->SetXY(153, 140);
	$pdf->Cell(30,3,utf8_decode("entregarlos en el momento de la recepción de mis equipos, el no devolverlos implica el compromiso"),'C');// salto de linea
	$pdf->SetXY(153, 142.5);
	$pdf->Cell(30,3,utf8_decode("de pagarles a razón de $$precioNum ( $precioLetras Pesos 00/100 M.N) más IVA, cada uno."),'C');// a razon de en caso de prestamo

	
if(strlen($areaOperativa)>34){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(20, 157.6);
$pdf->Cell(66,4,"$areaOperativa",0,1,'C'); // AREA OPERATIVA

if(strlen($tecnico)>34){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(187, 157.6);
$pdf->Cell(66,4,"$tecnico",0,1,'C');  // TECNICO APLICADOR

if(strlen($nomClient)>34){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(109, 157.6);
$pdf->Cell(66,4,"$nomClient",0,1,'C');  // CLIENTE

if($valid!='false'){
/* Agregamos Firma por si es la segunda vez que guarda este PDF */
	$hrefRutaFirmaO="../../../web/images/FileUpload/FirmasOrdenT/OrdenDeTrabajo/$sucursal/".$areaOperativa."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaO)){ $pdf->Image("$hrefRutaFirmaO",48,144,20,20); }	

	$hrefRutaFirmaT="../../../web/images/FileUpload/FirmasOrdenT/OrdenDeTrabajo/$sucursal/".$tecnico."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaT)){ $pdf->Image("$hrefRutaFirmaT",205,144,20,20); }

	$hrefRutaFirmaC="../../../web/images/FileUpload/FirmasOrdenT/OrdenDeTrabajo/$sucursal/".$nomClient."-".$noFolio."-".$noCliente.".png";
	if(file_exists($hrefRutaFirmaC)){ $pdf->Image("$hrefRutaFirmaC",132,144,20,20); }
/* Agregamos Firma por si es la segunda vez que guarda este PDF */	
}

function ContactSucursal(){
	
	global $TelSucursal, $DireccionSucursal, $pdf, $X_Direc;
	
	$pdf->SetFillColor(255,255,255);
	$pdf->Rect(80, 247.5, 105, 3, 'F');
	$pdf->SetFontSize(7);

	$pdf->SetXY(110,187.9);
	$pdf->Cell(50,2,"Tel: $TelSucursal",0,1,'C',true);

	$pdf->SetXY($X_Direc,187.9);
	$pdf->Cell(73,2, "$DireccionSucursal",0,1,'C',true);
}

$nombre_fichero = '../../../web/UploadPdf/PdfExtintores/OrdenDeTrabajo/'.$sucursal.'';

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/OrdenDeTrabajo/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',"../../../web/UploadPdf/PdfExtintores/OrdenDeTrabajo/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}

$pdf->Output();
?>
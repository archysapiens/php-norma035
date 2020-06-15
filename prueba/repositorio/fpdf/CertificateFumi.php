<?php
require('../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once 'fpdf.php';
require_once 'fpdi.php';
	@$noFolio=$_REQUEST["noFolio"];
	@$fecha_service=$_REQUEST["fecha_service"];
	@$direction=utf8_decode($_REQUEST["direction"]);
	@$nomClient=utf8_decode($_REQUEST["nomClient"]);
	@$sucursal=utf8_decode($_REQUEST["sucursal"]);
	@$yResponsables = 225.5;
	@$noCliente=$_REQUEST["noCliente"];
	@$horInicio=$_REQUEST["horInicio"];
	@$horFinal=$_REQUEST["horFinal"];
	@$tipoFumi=$_REQUEST["tipoFumi"];
	if($tipoFumi==''){}else{
			@$sqlIdTables = "SELECT NOMBRE FROM alta_tipo_fumigacion where id=$tipoFumi limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$tipoFumi=utf8_decode($fila["NOMBRE"]); }
		}
	@$areaFumi=$_REQUEST["areaFumi"];
		if($areaFumi=='null'){}else{
			@$sqlIdTables = "SELECT NOMBRE FROM alta_areas_fumigar where id=$areaFumi limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$areaFumi=utf8_decode($fila["NOMBRE"]); }
		}
	@$plagas=utf8_decode($_REQUEST["plagas"]);
	@$method1=utf8_decode($_REQUEST["method1"]);
		if($method1==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_metodo_aplicacion where id=$method1 limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$method1=utf8_decode($fila["NOMBRE"]); }
		}
	@$nomComercial=utf8_decode($_REQUEST["nomComercial"]);
		if($nomComercial==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_nombre_comercial where id=$nomComercial limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$nomComercial=utf8_decode($fila["NOMBRE"]); }
		}
	@$nomQuimico=utf8_decode($_REQUEST["nomQuimico"]);
		if($nomQuimico==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_nombre_quimico where id=$nomQuimico limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$nomQuimico=utf8_decode($fila["NOMBRE"]); }
		}
	@$method2=utf8_decode($_REQUEST["method2"]);
		if($method2==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_metodo_aplicacion where id=$method2 limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$method2=utf8_decode($fila["NOMBRE"]); }
		}
	@$composition=utf8_decode($_REQUEST["composition"]);
		if($composition==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_composicion where id=$composition limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$composition=utf8_decode($fila["NOMBRE"]); }
		}
	@$dosis=$_REQUEST["dosis"];
			$sqlIdTables = "SELECT NOMBRE FROM alta_dosis where id=$dosis limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$dosis=utf8_decode($fila["NOMBRE"]); }
	@$cofepris=$_REQUEST["cofepris"];
		if($cofepris==''){}else{
			$sqlIdTables = "SELECT NOMBRE FROM alta_registro_cofe where id=$cofepris limit 1"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) { @$cofepris=utf8_decode($fila["NOMBRE"]); }
		}
	@$nextService=$_REQUEST["nextService"];
	@$Obser=utf8_decode($_REQUEST["Obser"]);
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
			$X_Direc=126;
			$DireccionSucursal=utf8_decode("San Cristóbal Huichochitlán Toluca, Edo. De México");
			$TelSucursal=utf8_decode("01 (722) 179 78 92 y 507 42 51");
		}elseif($sucursal=='ATLACOMULCO'){
			$X_Direc=106;
			$DireccionSucursal=utf8_decode("Jose María Becerril S/N Parque Industrial Atlacomulco Edo. De México");
			$TelSucursal=utf8_decode("717121248524");
		}else{
			$X_Direc=126;
			$DireccionSucursal=utf8_decode("");
			$TelSucursal=utf8_decode("");
		}
	


$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("FumigacionActual.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);
//set position in pdf document
// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetFontSize(7);

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(58, 73);
$pdf->Write(0, "$noFolio");//No. Folio
$pdf->SetXY(107, 73);
$pdf->Write(0, "$fecha_service");//fecha

$pdf->SetXY(158, 73);
$pdf->Write(0, "$noCliente");//No cliente


$pdf->SetFontSize(8);
$pdf->SetXY(77, 90.5);
$pdf->Write(0, "$nomClient");//Nombre del Cliente

if(strlen($direction)>67){ $pdf->SetFontSize(7); }else{ $pdf->SetFontSize(8); }
if(strlen($direction)>90){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(59, 97.5);
$pdf->Write(0, "$direction");//direccion

$pdf->SetFontSize(8);
$pdf->SetXY(65, 105.5);
$pdf->Write(0, "$horInicio");//hora de inicio
$pdf->SetXY(159,105.5);
$pdf->Write(0, "$horFinal");//hora final

$pdf->SetXY(73, 122.5);
$pdf->Write(0, "$areaFumi / $tipoFumi");//areas a fumigar

if(strlen($plagas)>47){ $pdf->SetFontSize(7); }else{ $pdf->SetFontSize(8); }
if(strlen($plagas)>63){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(8); }
$pdf->SetXY(80, 129);
$pdf->Write(0, "$plagas");//plagas a controlar

$pdf->SetXY(82, 137.5);
$pdf->Write(0, "$method1");//Metodo de Aplicacion

$pdf->SetXY(76, 155.3);
$pdf->Write(0, "$nomComercial");//Nombre comercial

$pdf->SetFontSize(6.1);
$pdf->SetXY(70, 163.5 );
$pdf->Write(0, "$nomQuimico");//Nombre quimico


$pdf->SetFontSize(8);
$pdf->SetXY(83, 170.5);
$pdf->Write(0, "$method2");// metodo de aplicacion


$pdf->SetXY(67, 178);
$pdf->Write(0, "$composition");// compocicion

$pdf->SetXY(53, 185.5);
$pdf->Write(0, "$dosis");// dosis

$pdf->SetFontSize(7.5);
$pdf->SetXY(132, 186.3);
$pdf->Write(0, "$cofepris");// registro cofepris

$pdf->SetFontSize(8);
$pdf->SetXY(75, 193.3);
$pdf->Write(0, "$nextService");// proximo servicio

$count = strlen($Obser);
if($count >= 77) {
	$pdf->SetFontSize(6);
	$obser2 = substr($Obser, 0, 77); 
	$restoObser=substr($Obser, 77);
	$pdf->SetXY(40, 204.5);
	$pdf->Write(0, "$obser2");// OBSERVACIONES
	$pdf->SetXY(40, 207);
	$pdf->Write(0, "$restoObser");// OBSERVACIONES
}else{
	$pdf->SetFontSize(6);
	$pdf->SetXY(40, 204.5);
	$pdf->Write(0, "$Obser");// OBSERVACIONES
}  

if(strlen($responsable)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(37.8, $yResponsables);
$pdf->Cell(46.6,5,"$responsable",0,1,'C'); // RESPONSABLE AREA

if(strlen($tecnico)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(139, $yResponsables);
$pdf->Cell(44,5,"$tecnico",0,1,'C');  // TECNICO APLICADOR

if(strlen($nomClient)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
if(strlen($nomClient)>38){
		$pdf->SetXY(87.3, $yResponsables-3);
		$pdf->Cell(44,5,"".substr($nomClient,0,38)."",0,1,'C');  // CLIENTE
		$pdf->SetXY(87.3, $yResponsables);
		$pdf->Cell(44,5,"".substr($nomClient,38)."",0,1,'C'); }else{ 
	$pdf->SetXY(87.3, $yResponsables);
	$pdf->Cell(44,5,"$nomClient",0,1,'C');  } // CLIENTE

$pdf->SetFillColor(255,255,255);
$pdf->Rect(80, 247.5, 105, 3, 'F');
$pdf->SetFontSize(7);

$pdf->SetXY(78.5,249);
$pdf->Write(0, "$TelSucursal");

$pdf->SetXY($X_Direc,249);
$pdf->Write(0, "$DireccionSucursal");

$nombre_fichero = '../../web/UploadPdf/PdfFumigacion/Certificados/'.$sucursal.'';

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',"../../web/UploadPdf/PdfFumigacion/Certificados/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',"../../web/UploadPdf/PdfFumigacion/Certificados/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}
$pdf->Output();
?>
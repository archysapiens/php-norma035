<?php
sleep(3);
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
	@$noCliente=$_REQUEST["noCliente"];
	@$horInicio=$_REQUEST["horInicio"];
	@$horFinal=$_REQUEST["horFinal"];
	@$yResponsables = 224.3;
	@$yObser = 198.5;
	@$yObser2 = 201.4;
	// @$CamposGrid=$_REQUEST["CamposGrid"];
	// @$ExplodeCamposGrid = explode(",", $CamposGrid);	
	// // @$ExplodeCamposGrid = array_chunk($ExplodeCamposGrid, 9);
	// @$ExplodeCamposGrid = array_chunk($ExplodeCamposGrid, 2);
	
	@$ubicacion=utf8_encode(""); @$limpieza=utf8_decode(""); @$observacion=utf8_decode(""); $Mosquito=utf8_decode(""); $Mosca=utf8_decode(""); $Palomilla=utf8_decode(""); $Escarabajo=utf8_decode("");
	$CampoEstado1=utf8_decode(""); $CampoEstado2=utf8_decode("");
	
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
			$X_Direc=122;
			$DireccionSucursal=utf8_decode("San Cristóbal Huichochitlán Toluca, Edo. De México");
			$TelSucursal=utf8_decode("01 (722) 179 78 92 y 507 42 51");
		}elseif($sucursal=='ATLACOMULCO'){
			$X_Direc=102;
			$DireccionSucursal=utf8_decode("Jose María Becerril S/N Parque Industrial Atlacomulco Edo. De México");
			$TelSucursal=utf8_decode("717121248524");
		}else{
			$X_Direc=122;
			$DireccionSucursal=utf8_decode("");
			$TelSucursal=utf8_decode("");
		}
	
	//Lectura del archivo Json para traer el campo ubicacion
	$fileJson = '../../repositorio/DataJson/DataFumigacion/InspeccionLamparas/'.$sucursal.'/dataReport'.$noCliente.'.json';
	$str_datos = json_decode(file_get_contents("$fileJson"),true);
	
$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("ReporteInspecLampActual.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);

$pdf->SetFont('Arial');
$pdf->SetFontSize(7);

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(46, 65);
$pdf->Cell(35.3,3,"$noFolio",0,1,'C'); //No. Folio
$pdf->SetXY(98, 65);
$pdf->Cell(35.5,3,"$fecha_service",0,1,'C'); //fecha

$pdf->SetXY(170, 66.5);
$pdf->Write(0, "$noCliente");//No cliente

$pdf->SetFontSize(7);
$pdf->SetXY(59, 72.5);
$pdf->Write(0, "$nomClient");//Nombre del Cliente

if(strlen($direction)>67){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
if(strlen($direction)>90){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(44, 79);
$pdf->Write(0, "$direction");//direccion

$pdf->SetFontSize(7);
$pdf->SetXY(43, 82.3);
$pdf->Cell(38,3,"$horInicio",0,1,'C'); //hora de inicio
$pdf->SetXY(157,82.3);
$pdf->Cell(38.3,3,"$horFinal",0,1,'C'); //hora final
$pdf->SetFontSize(7);

ContactSucursal();

// $count = count($ExplodeCamposGrid);
$count = count($str_datos['rows']);
// $y = 110.9;
$y = 106.6;
if($count < 15 ){ $count = 15; }
elseif($count > 15 and $count < 23){ $count = 22; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 8
elseif($count > 22 and $count < 31){ $count = 30; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 30 and $count < 41){ $count = 40; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 11
elseif($count > 40 and $count < 49){ $count = 48; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 48 and $count < 57){ $count = 56; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 56 and $count < 65){ $count = 64; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 64 and $count < 75){ $count = 74; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 11
elseif($count > 74 and $count < 83){ $count = 82; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 82 and $count < 91){ $count = 90; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 90 and $count < 99){ $count = 98; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 98 and $count < 109){ $count = 108; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 11
elseif($count > 108 and $count < 117){ $count = 116; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 116 and $count < 125){ $count = 124; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 124 and $count < 133){ $count = 132; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 132 and $count < 143){ $count = 142; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 11
elseif($count > 142 and $count < 151){ $count = 150; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 150 and $count < 159){ $count = 158; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 158 and $count < 167){ $count = 166; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 166 and $count < 177){ $count = 176; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 11
elseif($count > 176 and $count < 185){ $count = 184; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 184 and $count < 193){ $count = 192; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
elseif($count > 192 and $count < 201){ $count = 200; $pdf->SetFillColor(255,255,255); $pdf->Rect(23, 190, 174, 50, 'F'); } // 9
  
for($i = 0; $i < $count; $i++)
{	
	if($i == 22){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
	if($i == 56){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
	if($i == 90){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
	if($i == 124){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
	if($i == 158){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
	if($i == 192){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
	// @$ubicacion=utf8_decode($ExplodeCamposGrid[$i][1]); 
	@$ubicacion=utf8_decode($str_datos['rows'][$i]['Ubicacion']);
	// @$Mosquito=utf8_decode($ExplodeCamposGrid[$i][2]); @$Mosca=utf8_decode($ExplodeCamposGrid[$i][3]);
	// @$Palomilla=utf8_decode($ExplodeCamposGrid[$i][4]); @$Escarabajo=utf8_decode($ExplodeCamposGrid[$i][5]);	
	// @$limpieza=utf8_decode($ExplodeCamposGrid[$i][6]); @$observacion=utf8_decode($ExplodeCamposGrid[$i][8]);
	
	// if(utf8_decode(@$ExplodeCamposGrid[$i][7])=='Bueno'){@$CampoEstado2=utf8_decode(""); @$CampoEstado1 = utf8_decode('x');
	// }elseif(utf8_decode(@$ExplodeCamposGrid[$i][7])=='Malo'){@$CampoEstado1=utf8_decode(""); @$CampoEstado2 = utf8_decode('x'); }
	// else{ @$CampoEstado1 = utf8_decode(' '); @$CampoEstado2 = utf8_decode(' '); }

	$numero=$i+1;
	$pdf->SetLineWidth(0);
	$pdf->SetXY(23.4, $y);
	$pdf->Cell(12,5.5,"$numero",1,1,'C');  //N°
	$pdf->SetXY(35.35, $y);
	if(strlen($ubicacion)>31){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
	$pdf->Cell(32.58,5.5,"$ubicacion",1,1,'L');  //UBICACION 1
	$pdf->SetXY(67.9,  $y);
	$pdf->Cell(15.9,5.5,"$Mosquito",1,0,'C');  // Mosquito
	$pdf->SetXY(83.8,  $y);
	$pdf->Cell(13.5,5.5,"$Mosca",1,0,'C');  // Mosca
	$pdf->SetXY(97.3,  $y);	
	$pdf->Cell(15.7,5.5,"$Palomilla",1,0,'C');  // Palomilla
	$pdf->SetXY(112.96,  $y);
	$pdf->Cell(18.3,5.5,"$Escarabajo",1,0,'C');  // Escarabajo
	$pdf->SetXY(131.2,  $y);
	$pdf->Cell(13.5,5.5,"$limpieza",1,0,'C');  //%limpieza
	$pdf->SetXY(144.7,  $y);
	$pdf->Cell(11.2,5.5,"$CampoEstado1",1,0,'C');  //bueno
	$pdf->SetXY(155.85,  $y);
	$pdf->Cell(15.85,5.5,"$CampoEstado2",1,0,'C');  //malo
	$pdf->SetXY(171.7, $y);
	$pdf->Cell(24.87,5.5,"$observacion",1,0,'L');  //observaciones

	$y = $y + 5.55;
		
 }

 if($count > 15 and $count < 23 ){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
 elseif($count > 22 and $count < 31){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
 elseif($count > 30 and $count < 41){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
 elseif($count > 40 and $count < 49){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,192.5,'','','png',''); }
 elseif($count > 48 and $count < 57){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
 elseif($count > 56 and $count < 65){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
 elseif($count > 64 and $count < 75){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
 elseif($count > 74 and $count < 83){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,192.5,'','','png',''); }
 elseif($count > 82 and $count < 91){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
 elseif($count > 90 and $count < 99){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
 elseif($count > 98 and $count < 109){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
 elseif($count > 108 and $count < 117){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,192.5,'','','png',''); }
 elseif($count > 116 and $count < 125){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
 elseif($count > 124 and $count < 133){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
 elseif($count > 132 and $count < 143){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
 elseif($count > 142 and $count < 151){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,192.5,'','','png',''); }
 elseif($count > 150 and $count < 159){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
 elseif($count > 158 and $count < 167){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
 elseif($count > 166 and $count < 177){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
 elseif($count > 176 and $count < 185){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,192.5,'','','png',''); }
 elseif($count > 184 and $count < 193){ $pdf->addPage(); $pdf->Image('PhpExtras/RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('PhpExtras/RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
 elseif($count > 192 and $count < 201){  $pdf->Image('PhpExtras/RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
 
$count = strlen($Obser);
if($count >= 100) {
	$obser2 = substr($Obser, 0, 100); 
	$restoObser=substr($Obser, 100);
	$pdf->SetXY(25, $yObser);
	$pdf->Write(0, "$obser2");// OBSERVACIONES
	$pdf->SetXY(25, $yObser2);
	$pdf->Write(0, "$restoObser");// OBSERVACIONES
}else{
	$pdf->SetXY(25, $yObser);
	$pdf->Write(0, "$Obser");// OBSERVACIONES
} 

if(strlen($responsable)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(37.8, $yResponsables);
$pdf->Cell(46,5,"$responsable",0,1,'C'); // RESPONSABLE AREA

if(strlen($tecnico)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(137.5, $yResponsables);
$pdf->Cell(46,5,"$tecnico",0,1,'C');  // TECNICO APLICADOR

if(strlen($nomClient)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
$pdf->SetXY(87.3, $yResponsables);
$pdf->Cell(46,5,"$nomClient",0,1,'C');  // CLIENTE


function ContactSucursal(){
	
	global $TelSucursal, $DireccionSucursal, $pdf, $X_Direc;
	
	$pdf->SetFillColor(255,255,255);
	$pdf->Rect(80, 247.5, 105, 3, 'F');
	$pdf->SetFontSize(7);

	$pdf->SetXY(78.5,249);
	$pdf->Write(0, "$TelSucursal");

	$pdf->SetXY($X_Direc,249);
	$pdf->Write(0, "$DireccionSucursal");
}


$nombre_fichero = '../../web/UploadPdf/PdfFumigacion/InspeccionLamparas/'.$sucursal.'';

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',"../../web/UploadPdf/PdfFumigacion/InspeccionLamparas/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',"../../web/UploadPdf/PdfFumigacion/InspeccionLamparas/$sucursal/$noFolio-$noCliente.pdf",'UTF-8 (true)');
}

$pdf->Output();

?>
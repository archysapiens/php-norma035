<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
sleep(1);
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';

	@$pagoNoFolio=$_REQUEST["pagoNoFolio"];
	@$sucursal=$_REQUEST["sucursalEmpresa"];
	@$fecha_emision=date("Y-m-d");
	@$fecha_limite=date("Y-m-d");
	
	// @$totalPago=$_REQUEST["totalPago"];
	// @$curpRespon=strtoupper($_REQUEST["curpRespon"]); 
	// @$nameFull=$_REQUEST["nameFull"];
	// @$pagoNameCurso=utf8_decode($_REQUEST["pagoNameCurso"]);
	// @$pagoNumAlumn=$_REQUEST["pagoNumAlumn"];
	// @$pagoTarifa=$_REQUEST["pagoTarifa"];
	// @$subtotal="";
	// @$observaciones="";
	// @$referencia="11161873";
	// @$concepto="11161873";
	
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

		$sqlSearchDatosPago = "SELECT pay.CURP,pay.FULL_NAME,pay.IVA,pay.SUBTOTAL,pay.TOTAL,pay.BANCO,pay.CUENTA_BANCARIA,pay.CLAVE_BANCARIA,coti.NUM_PERSONAS,coti.CURSO FROM mod_pago AS pay,mod_cotizacion AS coti WHERE pay.ID_PAGO='".$pagoNoFolio."' AND coti.ID_COTIZACION='".$pagoNoFolio."'";
		$stmtTable = $db->select($sqlSearchDatosPago);
		
	
$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("PAGO.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx, 10, 10, 200);

$pdf->SetFont('Arial');
$pdf->SetFontSize(8);
$pdf->SetFillColor(255,255,255);

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(154.5, 69);
$pdf->Cell(26,5,"$fecha_emision",0,1,'C', true); //fecha emision

$pdf->setTextColor(10, 2, 1);
$pdf->SetXY(154.5, 76);
$pdf->Cell(26,5,"".date('Y-m-d', strtotime('+15 day',strtotime(date('Y-m-d'))))."",0,1,'C', true); //fecha limite

$pdf->SetFontSize(10);
$pdf->SetFont('Arial','B');
$pdf->SetXY(163, 88.7);
$pdf->Cell(19,4,"".$stmtTable[0]["TOTAL"]."",0,1,'L', true); //total de pago

$pdf->SetFont('Arial');

/***************************tabla****************************/

$y=103;

$pdf->SetFillColor(255,255,255); 
$pdf->SetLineWidth(0);	

$pdf->SetXY(37,$y );
$pdf->Cell(67,6.8,"".$stmtTable[0]["CURP"]."",0,1,'C', true); // curp

$pdf->SetXY(104, $y);
$pdf->Cell(79,6.8,"".utf8_decode($stmtTable[0]["FULL_NAME"])."",0,1,'C', true); //nameFull

$pdf->SetFontSize(8);
$pdf->SetXY(37, 117);
$pdf->Cell(146,6.8,"Revisa que tus datos sean correctos...",0,1,'C', true); //observaciones


/***************************tabla****************************/
$cont=1;
$y=148		;
for($i=1; $i<=$cont; $i++){
	$pdf->SetFillColor(255,255,255); 
	$pdf->SetLineWidth(0);	
	$pdf->SetFontSize(6);
	$pdf->SetXY(36.5,$y );
	$pdf->Cell(30,6.8,"$pagoNoFolio",1,1,'C', true); // no. folio
	$pdf->SetFontSize(7);
	if(strlen(utf8_decode(@$stmtTable[0]["CURSO"]))>35){ $pdf->SetFontSize(6); }
	if(strlen(utf8_decode(@$stmtTable[0]["CURSO"]))>40){ $pdf->SetFontSize(5); }
	$pdf->SetXY(66.5, $y);
	$pdf->Cell(56.1,6.8,"".utf8_decode(@$stmtTable[0]["CURSO"])."",1,1,'L', true); //nombre del curso
	$pdf->SetFontSize(8);
	$pdf->SetXY(122.5,$y);
	$pdf->Cell(17,6.8,"".@$stmtTable[0]["NUM_PERSONAS"]."",1,1,'C', true); //numPerson

	$pdf->SetXY(139.5, $y);
	$pdf->Cell(17,6.8,"".@$stmtTable[0]["IVA"]."",1,1,'C', true); //IVA

	$pdf->SetXY(156.5, $y);
	$pdf->Cell(26,6.8,"".@$stmtTable[0]["SUBTOTAL"]."",1,1,'C', true); //subtotal


	$y=$y+6.7;
}
$pdf->SetFontSize(10);
$pdf->SetFont('Arial','B');
$pdf->SetXY(163, 178.3);
$pdf->Cell(19,4,"".@$stmtTable[0]["TOTAL"]."",0,1,'L', true); //total de pago final
$pdf->SetFontSize(8);
// $pdf->SetXY(38, 235.5);
// $pdf->Cell(30,6,"    ",0,1,'L', true); //referencia

// $pdf->SetXY(38, 242);
// $pdf->Cell(30,6,"   ",0,1,'L', true); //concepto

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

function addRutaFormatoPdf($rutaFullPdf,$pagoNoFolio){
	global $db,$sucursal;
	$SQL_updateRutaPdf = "UPDATE mod_pago SET URL_FORMATO_PAGO='".substr($rutaFullPdf,9)."' WHERE ID_PAGO='$pagoNoFolio'";
	$rec = $db->query($SQL_updateRutaPdf);	 }

$nombre_fichero = '../../../web/UploadPdf/PdfCapacitacion/Pagos/'.$sucursal.'';
$rutaFullPdf = "../../../web/UploadPdf/PdfCapacitacion/Pagos/$sucursal/$pagoNoFolio.pdf";

if (file_exists($nombre_fichero)) {
	$pdf->Output('F',$rutaFullPdf,'UTF-8 (true)');
	addRutaFormatoPdf($rutaFullPdf,$pagoNoFolio);
}else {
	mkdir($nombre_fichero, 0777, true);
	$pdf->Output('F',$rutaFullPdf,'UTF-8 (true)');
	addRutaFormatoPdf($rutaFullPdf,$pagoNoFolio);
}

$pdf->Output();
?>
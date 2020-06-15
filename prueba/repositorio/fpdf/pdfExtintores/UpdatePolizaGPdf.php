<?php 
//actualizacion del pdf ya creado 
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';
	@$noFolio=$_REQUEST["noFolio"];
	@$rutaPdfPolizaG=$_REQUEST["rutaPdfPolizaG"];
	@$rutaPdfPH=$_REQUEST["rutaPdfPH"];
	@$typeDocument=$_REQUEST["typeDocument"];
	@$fecha_service=$_REQUEST["fecha_service"];
	@$examVisu=$_REQUEST["examVisu"];
	@$medioPrue=$_REQUEST["medioPrue"];
	@$presOpe=$_REQUEST["presOpe"];
	@$presPrue=$_REQUEST["presPrue"];
	@$duraPrue=$_REQUEST["duraPrue"];
	@$Obser=$_REQUEST["Obser"];	
	@$TypeUser=$_REQUEST["TypeUser"];	
	
$pdf = new FPDI();
if($typeDocument=='POLIZA-PH'){ $pdf->setSourceFile("$rutaPdfPH"); }else{ $pdf->setSourceFile("$rutaPdfPolizaG"); }
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx);
$pdf->SetFont('Arial');
$pdf->SetFontSize(8);
$pdf->setTextColor(10, 2, 1);

	if($TypeUser=='TECNICO'){ //ACTUALIZA INFORMACION	
				
		//FECHA DE SERVICIO
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFontSize(7);
		if($typeDocument=='POLIZA-PH'){
			$pdf->SetXY(102, 44.5); //fecha Pruebas H.
			$pdf->Cell(30,3,"$fecha_service",0,1,'C',true); }else{ 			
			$pdf->SetXY(106, 52.5);
			$pdf->Cell(27,3,"$fecha_service",0,1,'C',true); }						
		
		// ContactSucursal();																
	}
	
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
	
	if($typeDocument=='POLIZA-PH'){ $pdf->Output('F',"$rutaPdfPH",'UTF-8 (true)'); }else{ $pdf->Output('F',"$rutaPdfPolizaG",'UTF-8 (true)'); }
	$pdf->Output();
?>
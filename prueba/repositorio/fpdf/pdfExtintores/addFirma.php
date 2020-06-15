<?php
error_reporting(E_ALL);
	ini_set('display_errors', '1');
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';
include '../PhpExtras/barcode.php';

	@$hrefRutaFpdf=$_REQUEST["hrefRutaFpdf"];
	@$TypeUser=$_REQUEST["TypeUser"];
	@$NoFolio=$_REQUEST["NoFolio"];
	@$sendSucursal=$_REQUEST["sendSucursal"];
	@$IdClientValid=$_REQUEST["IdClientValid"];
	@$typePDF=$_REQUEST["typePDF"];
	$Y_firma=213;
	$Y_CodeBar=43; $X_CodeBar=150; $Whidth_CodeBar=38;
	if(@$typePDF=='pruebasH'){ $Y_firma=199; $Y_CodeBar=33; $X_CodeBar=155; $Whidth_CodeBar=30; }else{ $Y_firma=213; }
	if(isset($_REQUEST['position'])){ @$position=$_REQUEST["position"]; }else{ @$position=''; }	
	@$hrefRutaFirma=utf8_decode($_REQUEST["hrefRutaFirma"]);
	$hoy = date("ymd");
	@$yFirmas = 217;
	if(file_exists($hrefRutaFirma)){		
		addContent();
	}else{
		sleep(3);
		if(file_exists($hrefRutaFirma)){		
			addContent();
		}else{
			sleep(3);
			if(file_exists($hrefRutaFirma)){		
				addContent();
			}else{
				sleep(3);
				addContent();
			}
		}
	}
	
	
	function addContent(){
		
		global $hrefRutaFpdf, $hrefRutaFirma, $pdf, $yFirmas, $TypeUser, $position, $Y_firma, $db, $hoy, $sendSucursal, $NoFolio, $IdClientValid, $Y_CodeBar, $X_CodeBar, $Whidth_CodeBar;
		
		if($position=='V'){ $pdf = new FPDI(); }else{ $pdf = new FPDI('L'); }
		
		$pageCount = $pdf->setSourceFile("$hrefRutaFpdf");
		$tplIdx = $pdf->importPage(1);
		$pdf->addPage();
		$pdf->useTemplate($tplIdx);

		$pdf->SetFont('Arial');
		$pdf->SetFontSize(8);

		$pdf->setTextColor(10, 2, 1);	

		if($TypeUser=='RESPONSABLE'){ //Add Firmas Electronicas RESPONSABLE AREA
			if($position='V'){ $pdf->Image("$hrefRutaFirma",150,$Y_firma,20,20); }else{ $pdf->Image("$hrefRutaFirma",100,210,20,20); }			
		}

		if($TypeUser=='ADMINISTRACION'){ //Add Codigo de barras al PDF	

					$code = '';
					@$sqlIdTables = "SELECT CODE FROM valid_modulo WHERE ID_VALID='$NoFolio'"; $stmtCode = $db->combo($sqlIdTables);
					while ($fila = $stmtCode->fetch_assoc()) { @$code=$code.$fila["CODE"]; }	

					@$sqlIdSucursal = "SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sendSucursal'"; $stmtSucursal = $db->combo($sqlIdSucursal);
					while ($fila = $stmtSucursal->fetch_assoc()) { @$ID_ALTA_SUCURSAL=$fila["ID_ALTA_SUCURSAL"]; }			
					$code=$ID_ALTA_SUCURSAL.$hoy.$IdClientValid.$code;
					
					barcode('../../../web/images/FileUpload/BarCode/'.$NoFolio.'.png', $code, 20, 'horizontal', 'code128', true);
					$pdf->Image('../../../web/images/FileUpload/BarCode/'.$NoFolio.'.png',$X_CodeBar,$Y_CodeBar,$Whidth_CodeBar,0,'PNG'); //50
					$SQL_update_BarcodeFumi = sprintf("UPDATE poliza_ext SET RUTA_JSON_PH='web/images/FileUpload/BarCode/$NoFolio.png' WHERE NO_FOLIO='$NoFolio'");						
					$rec = $db->query($SQL_update_BarcodeFumi);	
					//Fin de codigo de barras
					
		}

		if($TypeUser=='TECNICO'){ //Add Firmas Electronicas TECNICO APLICADOR
			
			$pdf->Image("$hrefRutaFirma",205,144,20,20);					
		}

		if($TypeUser=='ADMINISTRADOR'){ //Add Firmas Electronicas OPERATIVA
			
			$pdf->Image("$hrefRutaFirma",48,144,20,20);					
		}

		if($TypeUser=='CLIENTE'){ //Add Firmas Electronicas CLIENTE	
			if($position=='V'){ $pdf->Image("$hrefRutaFirma",100,$Y_firma,20,20); }else{ $pdf->Image("$hrefRutaFirma",132,144,20,20); }
		}

			$pdf->Output('F',"$hrefRutaFpdf",'UTF-8 (true)');
			$pdf->Output();
	}
	
?>
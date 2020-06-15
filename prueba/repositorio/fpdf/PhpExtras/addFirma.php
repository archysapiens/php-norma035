<?php
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';
include 'barcode.php';

	@$hrefRutaFpdf=$_REQUEST["hrefRutaFpdf"];
	@$TypeUser=$_REQUEST["TypeUser"];
	@$NoFolio=$_REQUEST["NoFolio"];
	@$sendSucursal=$_REQUEST["sendSucursal"];
	@$IdClientValid=$_REQUEST["IdClientValid"];
	@$hrefRutaFirma=utf8_decode($_REQUEST["hrefRutaFirma"]);
	$hoy = date("ymd");
	@$yFirmas = 217;
	$Nopage=0;
	$count=1;	
		
		//traer datos de la tabla Reportes Fumi
		@$sqlReportesFumi = "SELECT HORA_INICIO,HORA_FINALIZADO,ID_OBJETO,UBICACION,CONSUMO,LIMPIEZA,ESTATUS_OBJECT,OBSERV_OBJECT,OBSERV_REPORT,TECNICO_APLICADOR,RESPONSABLE_AREA,NOM_CLIENTE FROM reportes_fumi WHERE NO_FOLIO='$NoFolio' AND ID_OBJETO <> '' ORDER BY CAST(ID_OBJETO AS UNSIGNED), ID_OBJETO"; @$stmtReportesFumi = @$db->select($sqlReportesFumi);
		@$count = count(@$stmtReportesFumi);	
		
		if($count > 15 and $count < 49){ $Nopage=2; }
		elseif($count > 48 and $count < 83){ $Nopage=3; }
		elseif($count > 82 and $count < 125){ $Nopage=4; }
		elseif($count > 124 and $count < 159){ $Nopage=5; }
		elseif($count > 158 and $count < 193){ $Nopage=6; }
		
		if($count > 15 and $count < 23 ){ $yFirmas = 69; }
		 elseif($count > 22 and $count < 31){ $yFirmas = 105; }
		 elseif($count > 30 and $count < 41){ $yFirmas = 160; }
		 elseif($count > 40 and $count < 49){ $yFirmas = 211.5; }
		 elseif($count > 48 and $count < 57){ $yFirmas = 69; }
		 elseif($count > 56 and $count < 65){ $yFirmas = 104; }
		 elseif($count > 64 and $count < 75){ $yFirmas = 160; }
		 elseif($count > 74 and $count < 83){ $yFirmas = 211.5; }
		 elseif($count > 82 and $count < 91){ $yFirmas = 69; }
		 elseif($count > 90 and $count < 99){ $yFirmas = 104; }
		 elseif($count > 98 and $count < 109){ $yFirmas = 160; }
		 elseif($count > 108 and $count < 117){ $yFirmas = 211.5; }
		 elseif($count > 116 and $count < 125){ $yFirmas = 69; }
		 elseif($count > 124 and $count < 133){ $yFirmas = 104; }
		 elseif($count > 132 and $count < 143){ $yFirmas = 160; }
		 elseif($count > 142 and $count < 151){ $yFirmas = 211.5; }
		 elseif($count > 150 and $count < 159){ $yFirmas = 69; }
		 elseif($count > 158 and $count < 167){ $yFirmas = 104; }
		 elseif($count > 166 and $count < 177){ $yFirmas = 160; }
		 elseif($count > 176 and $count < 185){ $yFirmas = 212; }
		 elseif($count > 184 and $count < 193){ $yFirmas = 69; }
		 elseif($count > 192 and $count < 201){ $yFirmas = 104; }

$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("$hrefRutaFpdf");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx);

$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->setTextColor(10, 2, 1);	

if($TypeUser=='RESPONSABLE'){ //Add Firmas Electronicas RESPONSABLE AREA
	for($i = 2; $i <= $Nopage; $i++){
		$i = $pdf->importPage($i);
		$pdf->addPage();
		$pdf->useTemplate($i, null, null, null, null, true);		
	}
	$pdf->Image("$hrefRutaFirma",45,$yFirmas,20,20);
	
}

if($TypeUser=='ADMINISTRACION'){ //Add Codigo de barras al PDF	

			$code = '';
			@$sqlIdTables = "SELECT CODE FROM valid_modulo WHERE ID_VALID='$NoFolio'"; $stmtCode = $db->combo($sqlIdTables);
			while ($fila = $stmtCode->fetch_assoc()) { @$code=$code.$fila["CODE"]; }	

			@$sqlIdSucursal = "SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sendSucursal'"; $stmtSucursal = $db->combo($sqlIdSucursal);
			while ($fila = $stmtSucursal->fetch_assoc()) { @$ID_ALTA_SUCURSAL=$fila["ID_ALTA_SUCURSAL"]; }			
			$code=$ID_ALTA_SUCURSAL.$hoy.$IdClientValid.$code;
			
			barcode('../../../web/images/FileUpload/BarCode/'.$NoFolio.'.png', $code, 20, 'horizontal', 'code128', true);
			$pdf->Image('../../../web/images/FileUpload/BarCode/'.$NoFolio.'.png',148,44,36,0,'PNG'); //50
			$SQL_update_BarcodeFumi = sprintf("UPDATE fumigacion SET RUTA_BARCODE='web/images/FileUpload/BarCode/$NoFolio.png' WHERE NO_FOLIO='$NoFolio'");						
			$rec = $db->query($SQL_update_BarcodeFumi);	
			//Fin de codigo de barras
			
			for($i = 2; $i <= $Nopage; $i++){
				$i = $pdf->importPage($i);
				$pdf->addPage();
				$pdf->useTemplate($i, null, null, null, null, true);		
			}
			
}

if($TypeUser=='TECNICO'){ //Add Firmas Electronicas TECNICO APLICADOR
	for($i = 2; $i <= $Nopage; $i++){
		$i = $pdf->importPage($i);
		$pdf->addPage();
		$pdf->useTemplate($i, null, null, null, null, true);		
	}
	
	$pdf->Image("$hrefRutaFirma",152,$yFirmas,20,20);					
}

if($TypeUser=='CLIENTE'){ //Add Firmas Electronicas CLIENTE	
	for($i = 2; $i <= $Nopage; $i++){
		$i = $pdf->importPage($i);
		$pdf->addPage();
		$pdf->useTemplate($i, null, null, null, null, true);		
	}
	$pdf->Image("$hrefRutaFirma",100, $yFirmas ,20,20);					
}

	$pdf->Output('F',"$hrefRutaFpdf",'UTF-8 (true)');
	$pdf->Output();
?>
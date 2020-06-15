<?php
//actualizacion del pdf ya creado 
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';
	@$noFolio=$_REQUEST["noFolio"];
	@$rutaPdfCertifi=$_REQUEST["rutaPdfCertifi"];
	@$horInicio=$_REQUEST["horInicio"];
	@$horFinal=$_REQUEST["horFinal"];
	@$txtfecha=$_REQUEST["txtfecha"];
	@$yResponsables = 224.3;
	@$yObser = 198.5;
	@$yObser2 = 201.4;
	@$Obser=utf8_decode($_REQUEST["Obser"]);
	@$TypeUser=$_REQUEST["TypeUser"];
	// @$CamposGrid=utf8_decode($_REQUEST["CamposGrid"]);
	// @$ExplodeCamposGrid = explode(",", $CamposGrid);	
	// @$ExplodeCamposGrid = array_chunk($ExplodeCamposGrid, 9);
	
	@$ubicacion=utf8_encode(""); @$limpieza=utf8_decode(""); @$observacion=utf8_decode(""); $Mosquito=utf8_decode(""); $Mosca=utf8_decode(""); $Palomilla=utf8_decode(""); $Escarabajo=utf8_decode("");
	$CampoEstado1=utf8_decode(""); $CampoEstado2=utf8_decode("");
	
	if(strrpos($noFolio, 'TOL') == true){ 
		$X_Direc=122;
		$DireccionSucursal=utf8_decode("San Cristóbal Huichochitlán Toluca, Edo. De México");
		$TelSucursal=utf8_decode("01 (722) 179 78 92 y 507 42 51"); }
	elseif(strrpos($noFolio, 'ATL') == true){ 
		$X_Direc=102;
		$DireccionSucursal=utf8_decode("Jose María Becerril S/N Parque Industrial Atlacomulco Edo. De México");
		$TelSucursal=utf8_decode("717121248524"); }
	else{ 	$X_Direc=122;
			$DireccionSucursal=utf8_decode("");
			$TelSucursal=utf8_decode(""); }
		
	//traer datos de la tabla Reportes Fumi
	$sqlReportesFumi = "SELECT ID_OBJETO,UBICACION,MOSQUITO,MOSCA,PALOMILLA,ESCARABAJO,LIMPIEZA,ESTATUS_OBJECT,OBSERV_OBJECT,TECNICO_APLICADOR,RESPONSABLE_AREA,NOM_CLIENTE FROM reportes_fumi WHERE NO_FOLIO='$noFolio' AND ID_OBJETO <> '' ORDER BY CAST(ID_OBJETO AS UNSIGNED), ID_OBJETO"; $stmtReportesFumi = $db->select($sqlReportesFumi);
	$countReportesFumi = count($stmtReportesFumi);	

		@$responsable = utf8_decode(@$stmtReportesFumi[0]['RESPONSABLE_AREA']);
		@$tecnico = utf8_decode(@$stmtReportesFumi[0]['TECNICO_APLICADOR']);
		@$nomClient = utf8_decode(@$stmtReportesFumi[0]['NOM_CLIENTE']);
	
$pdf = new FPDI();
$pageCount = $pdf->setSourceFile("$rutaPdfCertifi");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx);

$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->setTextColor(10, 2, 1);

	if($TypeUser=='TECNICO'){ //ACTUALIZA INFORMACION	
		
		//FECHA_SERVICIO
		$pdf->SetFillColor(255,255,255);
		$pdf->SetXY(98, 65);
		$pdf->Cell(35.5,3,"$txtfecha",0,1,'C',true); //fecha
		
		//HORA INICIO
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(43, 82.3, 27, 2.5, 'F');
		$pdf->SetFontSize(8);
		$pdf->SetXY(43, 82.3);
		$pdf->Cell(38,3,"$horInicio",0,1,'C'); //hora de inicio

		//HORA FINAL
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(157,82.3, 27, 2.5, 'F');
		$pdf->SetXY(157,82.3);
		$pdf->Cell(38.3,3,"$horFinal",0,1,'C'); //hora final
		$pdf->SetFontSize(7);
		
		ContactSucursal();
		// Tablita
			$count = $countReportesFumi;
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
				if($i == 22){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
				if($i == 56){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
				if($i == 90){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
				if($i == 124){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
				if($i == 158){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }	
				if($i == 192){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); $y = 38; ContactSucursal(); }
				@$ubicacion=utf8_decode(@$stmtReportesFumi[$i]['UBICACION']); 
				@$Mosquito=utf8_decode(@$stmtReportesFumi[$i]['MOSQUITO']); @$Mosca=utf8_decode(@$stmtReportesFumi[$i]['MOSCA']);
				@$Palomilla=utf8_decode(@$stmtReportesFumi[$i]['PALOMILLA']); @$Escarabajo=utf8_decode(@$stmtReportesFumi[$i]['ESCARABAJO']);	
				@$limpieza=utf8_decode(@$stmtReportesFumi[$i]['LIMPIEZA']); @$observacion=utf8_decode(@$stmtReportesFumi[$i]['OBSERV_OBJECT']);
				
				if(@$limpieza == '?'){@$limpieza=utf8_decode('');}
				if(@$observacion == '?'){@$observacion=utf8_decode('');}else{ @$observacion=utf8_decode(@$stmtReportesFumi[$i]['OBSERV_OBJECT']); }
				if(@$Mosquito == '?'){@$Mosquito=utf8_decode('');}
				if(@$Mosca == '?'){@$Mosca=utf8_decode('');}
				if(@$Palomilla == '?'){@$Palomilla=utf8_decode('');}
				if(@$Escarabajo == '?'){@$Escarabajo=utf8_decode('');}
				
				if(utf8_decode(@$stmtReportesFumi[$i]['ESTATUS_OBJECT'])=='Bueno'){$CampoEstado2=utf8_decode(""); $CampoEstado1 = utf8_decode('x');
				}elseif(utf8_decode(@$stmtReportesFumi[$i]['ESTATUS_OBJECT'])=='Malo'){$CampoEstado1=utf8_decode(""); $CampoEstado2 = utf8_decode('x'); }
				else{ @$CampoEstado1 = utf8_decode(' '); @$CampoEstado2 = utf8_decode(' '); }

				$numero=$i+1;
				$pdf->SetLineWidth(0);
				$pdf->SetXY(23.4, $y);
				$pdf->Cell(12,5.5,"$numero",1,1,'C',true);  //N°
				$pdf->SetXY(35.35, $y);
				if(strlen($ubicacion)>20){ $pdf->SetFontSize(5); }else{ $pdf->SetFontSize(7); }
				$pdf->Cell(32.58,5.5,"$ubicacion",1,1,'L',true);  //UBICACION 1
				$pdf->SetXY(67.9,  $y);
				$pdf->Cell(15.9,5.5,"$Mosquito",1,0,'C',true);  // Mosquito
				$pdf->SetXY(83.8,  $y);
				$pdf->Cell(13.5,5.5,"$Mosca",1,0,'C',true);  // Mosca
				$pdf->SetXY(97.3,  $y);	
				$pdf->Cell(15.7,5.5,"$Palomilla",1,0,'C',true);  // Palomilla
				$pdf->SetXY(112.96,  $y);
				$pdf->Cell(18.3,5.5,"$Escarabajo",1,0,'C',true);  // Escarabajo
				$pdf->SetXY(131.2,  $y);
				$pdf->Cell(13.5,5.5,"$limpieza",1,0,'C',true);  //%limpieza
				$pdf->SetXY(144.7,  $y);
				$pdf->Cell(11.2,5.5,"$CampoEstado1",1,0,'C',true);  //bueno
				$pdf->SetXY(155.85,  $y);
				$pdf->Cell(15.85,5.5,"$CampoEstado2",1,0,'C',true);  //malo
				$pdf->SetXY(171.7, $y);
				$pdf->Cell(24.87,5.5,"$observacion",1,0,'L',true);  //observaciones

				$y = $y + 5.55;
				
			}	
				
			if($count > 15 and $count < 23 ){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
			 elseif($count > 22 and $count < 31){  $pdf->Image('RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
			 elseif($count > 30 and $count < 41){  $pdf->Image('RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
			 elseif($count > 40 and $count < 49){  $pdf->Image('RLPdfFooter.png', 23.5,192.5,'','','png',''); }
			 elseif($count > 48 and $count < 57){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
			 elseif($count > 56 and $count < 65){  $pdf->Image('RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
			 elseif($count > 64 and $count < 75){  $pdf->Image('RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
			 elseif($count > 74 and $count < 83){  $pdf->Image('RLPdfFooter.png', 23.5,192.5,'','','png',''); }
			 elseif($count > 82 and $count < 91){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
			 elseif($count > 90 and $count < 99){  $pdf->Image('RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
			 elseif($count > 98 and $count < 109){  $pdf->Image('RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
			 elseif($count > 108 and $count < 117){  $pdf->Image('RLPdfFooter.png', 23.5,192.5,'','','png',''); }
			 elseif($count > 116 and $count < 125){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
			 elseif($count > 124 and $count < 133){  $pdf->Image('RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
			 elseif($count > 132 and $count < 143){  $pdf->Image('RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
			 elseif($count > 142 and $count < 151){  $pdf->Image('RLPdfFooter.png', 23.5,192.5,'','','png',''); }
			 elseif($count > 150 and $count < 159){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
			 elseif($count > 158 and $count < 167){  $pdf->Image('RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
			 elseif($count > 166 and $count < 177){  $pdf->Image('RLPdfFooter.png', 23.5,141,'','','png',''); @$yResponsables = 173; $yObser = 147.5; $yObser2 = 150.4; }
			 elseif($count > 176 and $count < 185){  $pdf->Image('RLPdfFooter.png', 23.5,192.5,'','','png',''); }
			 elseif($count > 184 and $count < 193){ $pdf->addPage(); $pdf->Image('RLPdfHeader.png', 0,0,'','','png',''); $pdf->Image('RLPdfFooter.png', 23.5,50,'','','png',''); $pdf->Image('RLPdfFooterPrincipal.png', 0.5,239.5,'','','png',''); @$yResponsables = 82; $yObser = 56.5; $yObser2 = 59.4; ContactSucursal(); }
			 elseif($count > 192 and $count < 201){  $pdf->Image('RLPdfFooter.png', 23.5,85,'','','png',''); @$yResponsables = 117; $yObser = 91.5; $yObser2 = 94.4; }
		
		//OBSERVACIONES
		$yObserRect = $yObser-1.7;
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(25,$yObserRect, 167, 11.5, 'F');		
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
		$pdf->Cell(46,3.5,"$responsable",0,1,'C',true); // RESPONSABLE AREA

		if(strlen($tecnico)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
		$pdf->SetXY(137.5, $yResponsables);
		$pdf->Cell(46,3.5,"$tecnico",0,1,'C',true);  // TECNICO APLICADOR

		if(strlen($nomClient)>24){ $pdf->SetFontSize(6); }else{ $pdf->SetFontSize(7); }
		$pdf->SetXY(87.3, $yResponsables);
		$pdf->Cell(46,3.5,"$nomClient",0,1,'C',true);  // CLIENTE
		
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
	
	$pdf->Output('F',"$rutaPdfCertifi",'UTF-8 (true)');
	$pdf->Output();
?>
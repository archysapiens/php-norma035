<?php
//actualizacion del pdf ya creado 
require('../../../bd/bd.php');
$db = new DbCnnx();
date_default_timezone_set('America/Mexico_City');
require_once '../fpdf.php';
require_once '../fpdi.php';
	@$noFolio=$_REQUEST["noFolio"];
	@$rutaPdfOrdenT=$_REQUEST["rutaPdfOrdenT"];
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
	@$TypeUser=$_REQUEST["TypeUser"];
	@$recibiDe=strtoupper($_REQUEST["recibiDe"]);
	@$recibiDe=str_replace("ñ","Ñ",$recibiDe);
	@$precioNum=$_REQUEST["precioNum"];
	@$precioLetras=ucwords(strtolower($_REQUEST["precioLetras"]));
	
	@$agenteExtAE=utf8_encode(""); @$cantidadAE=utf8_decode(""); @$capacidadAE=utf8_decode(""); @$agenteExtOtroAE=utf8_decode(""); @$obser_object=utf8_decode("");
	$agenteExtAE1=utf8_decode(""); $agenteExtAE2=utf8_decode(""); $agenteExtAE3=utf8_decode(""); $agenteExtAE4=utf8_decode("");
	$TypeService1=utf8_decode(""); $TypeService2=utf8_decode("");
		
	if(strrpos($noFolio, 'TOL') == true){ 
		$X_Direc=193;
		$DireccionSucursal=utf8_decode("San Cristóbal Huichochitlán Toluca, Edo. De México");
		$TelSucursal=utf8_decode("01 (722) 179 78 92 y 507 42 51"); }
	elseif(strrpos($noFolio, 'ATL') == true){ 
		$X_Direc=102;
		$DireccionSucursal=utf8_decode("Jose María Becerril S/N Parque Industrial Atlacomulco Edo. De México");
		$TelSucursal=utf8_decode("717121248524"); }
	else{ 	$X_Direc=193;
			$DireccionSucursal=utf8_decode("");
			$TelSucursal=utf8_decode(""); }
	
	//traer datos de la tabla Orden_ext
	$sqlOrdenT = "SELECT ID_OBJETO,CANTIDAD_AE,CAPACIDAD_AE,AGENTE_EXT,AGENTE_EXT_OTROS,OBSERV_AE,TECNICO_APLICADOR,RESPONSABLE_AREA,NOM_CLIENTE FROM ordent_ext WHERE NO_FOLIO='$noFolio' AND ID_OBJETO <> '' AND TIPO_REGISTRO='AgenteExt' ORDER BY CAST(ID_OBJETO AS UNSIGNED), ID_OBJETO"; $stmtOrdenT = $db->select($sqlOrdenT);
	$countOrdenT_Ext = count($stmtOrdenT);	

		@$responsable = utf8_decode(@$stmtOrdenT[0]['RESPONSABLE_AREA']);
		@$tecnico = utf8_decode(@$stmtOrdenT[0]['TECNICO_APLICADOR']);
		@$nomClient = utf8_decode(@$stmtOrdenT[0]['NOM_CLIENTE']);
	
$pdf = new FPDI('L');
$pageCount = $pdf->setSourceFile("$rutaPdfOrdenT");
$tplIdx = $pdf->importPage(1);
$pdf->addPage();
$pdf->useTemplate($tplIdx);

$pdf->SetFont('Arial');
$pdf->SetFontSize(8);

$pdf->setTextColor(10, 2, 1);

	if($TypeUser=='TECNICO'){ //ACTUALIZA INFORMACION	
				
		//FECHA DE SERVICIO
		$pdf->SetFillColor(255,255,255);
		$pdf->SetXY(122, 48.6);
		$pdf->Cell(29,3,"$fechaRecolect",0,1,'C',true); //fecha_recoleccion
		$pdf->SetXY(186, 48.6);
		$pdf->Cell(27,3,"$fechaEntrega",0,1,'C',true); //fecha_entrega	
		
		$pdf->SetFontSize(7);
		
		// ContactSucursal();
		// Tablita
			// $count = $countOrdenT_Ext;
			$count = 5;
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
		
		//Table Refacciones
		
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
	
	$pdf->Output('F',"$rutaPdfOrdenT",'UTF-8 (true)');
	$pdf->Output();
?>
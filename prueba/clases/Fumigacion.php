<?php

 class Fumigacion{
	
	
	public function saveCertificate($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];
        @$horInicio=$POST["horInicio"];
        @$horFinal=$POST["horFinal"];
        @$tipoFumi=$POST["tipoFumi"];
		@$valid=$POST["valid"];
		@$sucursal=$POST["sucursal"];
		$rutaPdf = "web/UploadPdf/PdfFumigacion/Certificados/".$sucursal."/".$noFolio."-".$noCliente.".pdf";
		$sqlIdTables = "SELECT NOMBRE FROM alta_tipo_fumigacion where id=$tipoFumi limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $tipoFumi=$fila["NOMBRE"]; }
        @$areaFumi=$POST["areaFumi"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_areas_fumigar where id=$areaFumi limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $areaFumi=$fila["NOMBRE"]; }
        @$plagas=$POST["plagas"];
        @$method1=$POST["method1"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_metodo_aplicacion where id=$method1 limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $method1=$fila["NOMBRE"]; }
        @$nomComercial=$POST["nomComercial"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_nombre_comercial where id=$nomComercial limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $nomComercial=$fila["NOMBRE"]; }
        @$nomQuimico=$POST["nomQuimico"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_nombre_quimico where id=$nomQuimico limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $nomQuimico=$fila["NOMBRE"]; }
        @$method2=$POST["method2"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_metodo_aplicacion where id=$method2 limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $method2=$fila["NOMBRE"]; }
        @$composition=$POST["composition"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_composicion where id=$composition limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $composition=$fila["NOMBRE"]; }
        @$dosis=$POST["dosis"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_dosis where id=$dosis limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $dosis=$fila["NOMBRE"]; }
        @$cofepris=$POST["cofepris"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_registro_cofe where id=$cofepris limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $cofepris=$fila["NOMBRE"]; }
        @$periodiService=$POST["periodiService"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_periodicidad where id=$periodiService limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $periodiService=$fila["NOMBRE"]; }
        @$nextService=$POST["nextService"];
        @$Obser=$POST["Obser"];
        @$tecnico=$POST["tecnico"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_tecnico_aplicador where id=$tecnico limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $tecnico=$fila["NOMBRE"]; }
        @$responsable=$POST["responsable"];
		$sqlIdTables = "SELECT NOMBRE FROM altas_responsable_area where id=$responsable limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $responsable=$fila["NOMBRE"]; }
		@$administracion=$POST["administracion"];
		$sqlIdTables = "SELECT NOMBRE FROM alta_area_administracion where id=$administracion limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $administracion=$fila["NOMBRE"]; }
		$sessionNomUser=@$_SESSION['sesionNomUser'];
		
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
			
			if($valid == "false"){
				$QueryInsertValidUse = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$sessionNomUser','OPERATIVA','','','Validar Certificado $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidUse);				
				$QueryInsertValidTec = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$tecnico','TECNICO','','','Validar Certificado $noFolio','','next','')";
				$recReturnId = $db->query($QueryInsertValidTec);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$responsable','RESPONSABLE','','','Validar Certificado $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$administracion','ADMINISTRACION','','','Validar Certificado $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidCli = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$nomClient','CLIENTE','','','Nuevo Certificado $noFolio','','listo','')";
				$recReturnId = $db->query($QueryInsertValidCli);
			}
						
			@$plagas = implode(",", $plagas);
			$SQL_insert_certificate = sprintf("INSERT INTO fumigacion(NO_CLIENTE,NO_FOLIO,FECHA_SERVICIO,HOR_INICIO,HOR_FINALIZADO,AREAS_FUMIGAR,TIPO_FUMIGACION,PLAGAS_CONTROL,METODO_APLICACION,NOM_COMERCIAL,NOM_QUIMICO,METOD_APLICACION_INSEC,COMPOSICION,DOSIS,REGISTRO_COFE,PERIODICIDAD_SERVICE,PROX_SERVICIO,OBSERVACIONES,RESPONSABLE_AREA,TEC_APLICADOR,AREA_ADMINISTRACION,ESTATUS,ID_VALID,RUTA_PDF,RUTA_BARCODE,ID_REPORTE)
            VALUES ($noCliente,'$noFolio',NOW(),'$horInicio','$horFinal','$areaFumi','$tipoFumi','$plagas','$method1','$nomComercial','$nomQuimico','$method2','$composition','$dosis','$cofepris','$periodiService','$nextService','$Obser','$responsable','$tecnico','$administracion','A','$noFolio','$rutaPdf','',null) ON DUPLICATE KEY UPDATE
			FECHA_SERVICIO=(NOW()),HOR_INICIO=('$horInicio'),HOR_FINALIZADO=('$horFinal'),AREAS_FUMIGAR=('$areaFumi'),TIPO_FUMIGACION=('$tipoFumi'),PLAGAS_CONTROL=('$plagas'),METODO_APLICACION=('$method1'),NOM_COMERCIAL=('$nomComercial'),NOM_QUIMICO=('$nomQuimico'),METOD_APLICACION_INSEC=('$method2'),
			COMPOSICION=('$composition'),DOSIS=('$dosis'),REGISTRO_COFE=('$cofepris'),PERIODICIDAD_SERVICE=('$periodiService'),PROX_SERVICIO=('$nextService'),OBSERVACIONES=('$Obser'),RESPONSABLE_AREA=('$responsable'),TEC_APLICADOR=('$tecnico'),AREA_ADMINISTRACION=('$administracion')");
			
			$rec = $db->query($SQL_insert_certificate);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				// echo "
				// <script language='javascript'>
					// setTimeout(function() {
						// toastr.options = {
							// closeButton: true,
							// progressBar: true,
							// positionClass: 'toast-bottom-right',
							// showMethod: 'slideDown',
							// timeOut: 4000
						// };
						// toastr.success('','DATOS GUARDADOS CORRECTAMENTE');
					// },1200);
				// </script>";
			}
		}

    }
	
	public function updateCertiFumiTec($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];        
        @$horInicio=$POST["horInicio"];
        @$horFinal=$POST["horFinal"];        
        @$Obser=$POST["Obser"];
        @$txtfecha=$POST["txtfecha"];
			
		$SqlUpdateCeriFumi = sprintf("UPDATE fumigacion SET HOR_INICIO='$horInicio', HOR_FINALIZADO='$horFinal',OBSERVACIONES='$Obser', FECHA_SERVICIO=NOW() WHERE NO_FOLIO='$noFolio'");						
		$rec = $db->query($SqlUpdateCeriFumi);
    }
	
	public function deleteTableNewCertificado($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$getNoFolio=$POST["GetNoFolio"];        
        @$getnoCliente=$POST["GetnoCliente"];
			
		$Query1 ="DELETE FROM fumigacion WHERE NO_FOLIO='$getNoFolio'"; $db->query($Query1);
		$Query2 ="DELETE FROM valid_modulo WHERE ID_VALID='$getNoFolio'"; $db->query($Query2);
    }
	
	public function deleteTableNewReport($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$getNoFolio=$POST["GetNoFolio"];        
        @$getnoCliente=$POST["GetnoCliente"];
			
		$Query1 ="DELETE FROM reportes_fumi WHERE NO_FOLIO='$getNoFolio'"; $db->query($Query1);
		$Query2 ="DELETE FROM valid_modulo WHERE ID_VALID='$getNoFolio'"; $db->query($Query2);
    }
	
	public function opciones($textInput) {
		$db = new DbCnnx();
		
		  //Variable que contendrá el resultado de la búsqueda
		  $texto = 'NO HAY RESULTADOS';
		  
		  //Contulta para recoger la información de todas las provincias
		  $SQL_Complite = "SELECT NO_CLIENTE FROM empresas WHERE NO_CLIENTE LIKE '%$textInput%' ORDER BY NO_CLIENTE";
		  
		  $rec = $db->combo($SQL_Complite);
		  $count = 0;

			while ($row = $rec->fetch_assoc()) {
				$count++;
				$datos[] = $row['NO_CLIENTE'];
			}
		
		if($count >= 1){ return json_encode($datos); }
            else{ return $texto; }
	}
	
	public function loadSelectArea(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_areas_fumigar";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	
	public function loadSelectPlagas(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_plagas ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	
	public function loadSelectMetodo(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_metodo_aplicacion ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectMetodo2(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_metodo_aplicacion ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectNomComercial(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_nombre_comercial ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectTypeFumi(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_tipo_fumigacion ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectNomQuimico(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_nombre_quimico";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectComposicion(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_composicion ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectDosis(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_dosis ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectCofepris(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_registro_cofe";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectPeriodicidad(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_periodicidad";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectResponsable(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM altas_responsable_area ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectTecnico(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_tecnico_aplicador ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	public function loadSelectAdministrativa(){
		$db = new DbCnnx();
		$sqlListTables = "SELECT * FROM alta_area_administracion ORDER BY nombre ASC";
		$stmtTable = $db->combo($sqlListTables);
		
		return $stmtTable;
	}
	
	public function saveReporMoscas($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_report=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];
        @$horInicio=$POST["horInicio"];
        @$horFinal=$POST["horFinal"];        
        @$Obser=$POST["Obser"];
        @$tecnico=$POST["tecnico"];
        @$id_object=$POST["id_object"];
        @$ubicacion=$POST["ubicacion"];
        @$consumo=$POST["consumo"];
		@$valid=$POST["valid"];
        @$limpieza=$POST["limpieza"];
        @$estatus_object=$POST["estatus_object"];
        @$obser_object=$POST["obser_object"];
		$rutaPdf = "web/UploadPdf/PdfFumigacion/ReportesMoscas/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
		@$areaOperativa = @$_SESSION['sesionNomUser'];
		if($tecnico==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM alta_tecnico_aplicador where id=$tecnico limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $tecnico=$fila["NOMBRE"]; }
		}
        @$responsable=$POST["responsable"];
		if($responsable==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM altas_responsable_area where id=$responsable limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $responsable=$fila["NOMBRE"]; }
		}
		@$administracion=$POST["administracion"];
		if($administracion==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM alta_area_administracion where id=$administracion limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $administracion=$fila["NOMBRE"]; }
		}
		$createId = $noCliente.'MOS'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
			
			if($valid == "false"){						
				$QueryInsertValidTec = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$tecnico','TECNICO','','','Validar Reporte $noFolio','','false','')";
				$recReturnId = $db->query($QueryInsertValidTec);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$responsable','RESPONSABLE','','','Validar Reporte $noFolio','','next','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$administracion','ADMINISTRACION','','','Validar Reporte $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidCli = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$nomClient','CLIENTE','','','Nuevo Reporte $noFolio','','listo','')";
				$recReturnId = $db->query($QueryInsertValidCli);				
			}
			
			$SQL_insert_report = sprintf("INSERT INTO reportes_fumi(ID_REPORTE,NO_FOLIO,NO_CLIENTE,FECHA_REGISTRO,FECHA_REPORTE,HORA_INICIO,HORA_FINALIZADO,ID_OBJETO,UBICACION,CONSUMO,MOSQUITO,MOSCA,PALOMILLA,ESCARABAJO,LIMPIEZA,ESTATUS_OBJECT,OBSERV_OBJECT,OBSERV_REPORT,AREA_OPERATIVA,TECNICO_APLICADOR,RESPONSABLE_AREA,AREA_ADMINISTRACION,NOM_CLIENTE,RUTA_JSON,RUTA_PDF,CLIENTE_VALID)
			VALUES ('$createId','$noFolio',$noCliente,now(),'$fecha_report','$horInicio','$horFinal','$id_object','$ubicacion','$consumo','N/A','N/A','N/A','N/A','$limpieza','$estatus_object','$obser_object','$Obser','$areaOperativa','$tecnico','$responsable','$administracion','$nomClient','','$rutaPdf','false') ON DUPLICATE KEY UPDATE
			ID_REPORTE=('$createId'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_REPORTE=('$fecha_report'),HORA_INICIO=('$horInicio'),HORA_FINALIZADO=('$horFinal'),ID_OBJETO=('$id_object'),UBICACION=('$ubicacion'),CONSUMO=('$consumo'),
			LIMPIEZA=('$limpieza'),ESTATUS_OBJECT=('$estatus_object'),OBSERV_OBJECT=('$obser_object'),OBSERV_REPORT=('$Obser'),TECNICO_APLICADOR=('$tecnico'),RESPONSABLE_AREA=('$responsable'),AREA_ADMINISTRACION=('$administracion'),NOM_CLIENTE=('$nomClient')");
			
			$rec = $db->query($SQL_insert_report);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	// Update Moscas por el Tecnico 
	public function updateReporMoscasTecnico($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];        
        @$noCliente=$POST["noCliente"];               
        @$Obser=$POST["Obser"];       
        @$horInicio=$POST["horInicio"];       
        @$horFinal=$POST["horFinal"];       
        @$id_object=$POST["id_object"];
        @$ubicacion=$POST["ubicacion"];
        @$consumo=$POST["consumo"];
		@$valid=$POST["valid"];
        @$limpieza=$POST["limpieza"];
        @$estatus_object=$POST["estatus_object"];
        @$obser_object=$POST["obser_object"];
		
		$createId = $noCliente.'MOS'.$id_object;
		$createIdPrincipal = $noCliente.'MOS';
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
					
			$SQL_insert_report = sprintf("UPDATE reportes_fumi SET CONSUMO='$consumo',LIMPIEZA='$limpieza',ESTATUS_OBJECT='$estatus_object',OBSERV_OBJECT='$obser_object',OBSERV_REPORT='$Obser',HORA_INICIO='$horInicio',HORA_FINALIZADO='$horFinal' WHERE ID_REPORTE='$createId' AND NO_FOLIO='$noFolio'");			
			$rec = $db->query($SQL_insert_report);
			$SQL_update_report = sprintf("UPDATE reportes_fumi SET OBSERV_REPORT='$Obser',HORA_INICIO='$horInicio',HORA_FINALIZADO='$horFinal',FECHA_REPORTE=NOW() WHERE ID_REPORTE='$createIdPrincipal' AND NO_FOLIO='$noFolio'");			
			$rec = $db->query($SQL_update_report);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	public function gerateJsonReport($POST) {
		$db = new DbCnnx();
		
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 6);
		@$count = count($arrayJqGrid);
		$file='';		
		$Id=1;
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Id" => "$Id",
				"Ubicacion" => $arrayJqGrid[$i][1],
				"Consumo" => $arrayJqGrid[$i][2],
				"Limpieza" => $arrayJqGrid[$i][3],
				"Estatus" => $arrayJqGrid[$i][4],
				"Obser" => $arrayJqGrid[$i][5]
			);
			$Id++;
		}
		$arr_clientes = array(
			"rows" => $array			
		);
			$nombre_fichero = '../../repositorio/DataJson/DataFumigacion/ReportesMoscas/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_clientes);
				$file = '../../repositorio/DataJson/DataFumigacion/ReportesMoscas/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_clientes);
				$file = '../../repositorio/DataJson/DataFumigacion/ReportesMoscas/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			}
			
			$SQL_updateNomJson = "UPDATE reportes_fumi SET RUTA_JSON='$file' WHERE NO_CLIENTE='$noCliente' AND ID_REPORTE LIKE '".$noCliente."MOS%'";
			$rec = $db->query($SQL_updateNomJson);
			
			// $datos_clientes = file_get_contents("clientes.json");
			// $json_clientes = json_decode($datos_clientes, true);
			// foreach ($json_clientes as $cliente) {				
				// echo $cliente."<br>";
			// }
	}
	
	public function ValidCertificado($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma) {
		$db = new DbCnnx();
			
			$ExplodeFilename = explode("-", $filteredFilename);			
			$ID_USER = htmlspecialchars($_COOKIE["id"]); 
			// $NOMBRE_USER = $ExplodeFilename[0]; 
			$NOMBRE_USER = trim($ExplodeFilename[0]);
			$FOLIO = $ExplodeFilename[1];
			$ID_CLIENTE = $ExplodeFilename[2]; 
			$CORREO_ENVIO = $filteredCorreoEnvio; 
			$URL_FIRMA = utf8_encode($RutaDirFileFirma);
			$confirmEmail='false';
			
			$GenerateCode=$this->generateRandomString(3);
			
			$SQL_update_valid = sprintf("UPDATE valid_modulo SET ID_CLIENTE='$ID_CLIENTE',ID_USER='$ID_USER',NOMBRE_USER='$NOMBRE_USER',URL_FIRMA='$URL_FIRMA',CORREO_ENVIO='$CORREO_ENVIO',VALID='true',FECHA_VALIDACION=NOW(),CODE='$GenerateCode' WHERE ID_VALID='$FOLIO' and NOMBRE_USER='$NOMBRE_USER'");
			$rec = $db->query($SQL_update_valid);
				$sqlIdTables = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='next' limit 1"; $stmtArea = $db->combo($sqlIdTables);
				while ($fila = $stmtArea->fetch_assoc()) { 
				
					$tipoValidUser=$fila["TYPE_USER"]; 
					$NomUserValid=$fila["NOMBRE_USER"];
							$sqlEmail = "SELECT EMAIL FROM usuarios WHERE CONCAT(NOMBRE_U,' ',APP_PATERNO_U,' ',APP_MATERNO_U)='$NomUserValid' LIMIT 1"; $stmtEmail = $db->combo($sqlEmail);
							while ($filaEmail = $stmtEmail->fetch_assoc()) { $confirmEmail=$filaEmail["EMAIL"]; }
					
					if($tipoValidUser=='CLIENTE'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false',CORREO_ENVIO='$confirmEmail' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);
					}else if($tipoValidUser=='TECNICO'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='RESPONSABLE'");						
						$rec = $db->query($SQL_update_validNext);
					}else if($tipoValidUser=='RESPONSABLE'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);	
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='ADMINISTRACION'");						
						$rec = $db->query($SQL_update_validNext);
					}else if($tipoValidUser=='ADMINISTRACION'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);	
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='CLIENTE'");						
						$rec = $db->query($SQL_update_validNext);
					}					
				}
				
				$sqlIdTablesNEW = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='true' and TYPE_USER='ADMINISTRACION'"; $stmtAreaNew = $db->combo($sqlIdTablesNEW);
				while ($filaNew = $stmtAreaNew->fetch_assoc()) { 									
						$confirmEmail='true';											
				}
				
		return $confirmEmail;
	}
	
	public function ValidFumiReportes($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma) {
		$db = new DbCnnx();
			
			$ExplodeFilename = explode("-", $filteredFilename);			
			$ID_USER = htmlspecialchars($_COOKIE["id"]); 
			// $NOMBRE_USER = $ExplodeFilename[0]; 
			$NOMBRE_USER = trim($ExplodeFilename[0]);
			$FOLIO = $ExplodeFilename[1];
			$ID_CLIENTE = $ExplodeFilename[2]; 
			$CORREO_ENVIO = $filteredCorreoEnvio; 
			$URL_FIRMA = utf8_encode($RutaDirFileFirma);
			$confirmEmail='false';
			
			$GenerateCode=$this->generateRandomString(3);
			
			$SQL_update_valid = sprintf("UPDATE valid_modulo SET ID_CLIENTE='$ID_CLIENTE',ID_USER='$ID_USER',NOMBRE_USER='$NOMBRE_USER',URL_FIRMA='$URL_FIRMA',CORREO_ENVIO='$CORREO_ENVIO',VALID='true',FECHA_VALIDACION=NOW(),CODE='$GenerateCode' WHERE ID_VALID='$FOLIO' and NOMBRE_USER='$NOMBRE_USER'");
			$rec = $db->query($SQL_update_valid);
				$sqlIdTables = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='next' limit 1"; $stmtArea = $db->combo($sqlIdTables);
				while ($fila = $stmtArea->fetch_assoc()) { 
				
					$tipoValidUser=$fila["TYPE_USER"]; 
					$NomUserValid=$fila["NOMBRE_USER"];
							$sqlEmail = "SELECT EMAIL FROM usuarios WHERE CONCAT(NOMBRE_U,' ',APP_PATERNO_U,' ',APP_MATERNO_U)='$NomUserValid' LIMIT 1"; $stmtEmail = $db->combo($sqlEmail);
							while ($filaEmail = $stmtEmail->fetch_assoc()) { $confirmEmail=$filaEmail["EMAIL"]; }
					
					if($tipoValidUser=='TECNICO'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='RESPONSABLE'");						
						$rec = $db->query($SQL_update_validNext);
					}else if($tipoValidUser=='RESPONSABLE'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);	
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='ADMINISTRACION'");						
						$rec = $db->query($SQL_update_validNext);
					}else if($tipoValidUser=='ADMINISTRACION'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);							
					}					
				}
				
				$sqlIdTablesNEW = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='true' and TYPE_USER='ADMINISTRACION'"; $stmtAreaNew = $db->combo($sqlIdTablesNEW);
				while ($filaNew = $stmtAreaNew->fetch_assoc()) { 									
						$confirmEmail='true';											
				}
				
		return $confirmEmail;
	}
	
	public function ConfirmReciCertificado($filteredFilename,$RutaDirFileFirma) { //Function para confirmar de Recibido (Cliente)
		$db = new DbCnnx();
			
			$ExplodeFilename = explode("-", $filteredFilename);			
			$ID_USER = htmlspecialchars($_COOKIE["id"]); 
			// $NOMBRE_USER = $ExplodeFilename[0]; 
			$NOMBRE_USER = utf8_decode(trim($ExplodeFilename[0]));
			$FOLIO = $ExplodeFilename[1];
			$ID_CLIENTE = $ExplodeFilename[2]; 
			$URL_FIRMA = $RutaDirFileFirma;
			$confirmEmail='false';			
			
			$SQL_update_valid = sprintf("UPDATE valid_modulo SET ID_CLIENTE='$ID_CLIENTE',ID_USER='$ID_USER',NOMBRE_USER='$NOMBRE_USER',URL_FIRMA='$URL_FIRMA',VALID='true',FECHA_VALIDACION=NOW() WHERE ID_VALID='$FOLIO' and NOMBRE_USER='$NOMBRE_USER' and TYPE_USER='CLIENTE'");
			$rec = $db->query($SQL_update_valid);											
				
		return $confirmEmail;
	}
	
	public function saveAddEmailCorreoEnvio($POST) {
		$db = new DbCnnx();
			
			@$AddEmailEnvio=$POST["AddEmailEnvio"];
			@$GetNoFolio=$POST["GetNoFolio"];
			@$GetnoCliente=$POST["GetnoCliente"];
			
			foreach ($AddEmailEnvio as &$valor) {
				$sqlListValid = "SELECT * FROM valid_modulo WHERE CORREO_ENVIO='$valor' and ID_VALID='$GetNoFolio'";
				$stmtTable = $db->combo($sqlListValid);
				if($stmtTable->num_rows>=1){
					echo "<div class='text-primary badge badge-default pull-center'>Ya exite un correo Parecido a <i class='text-muted'>$valor</i> </div><br/>";
				}else{
					$QueryInsertValidUse = "INSERT INTO valid_modulo VALUE('$GetNoFolio','$GetnoCliente','','','AddEmailEnvio','','$valor','Envio de Certificado $GetNoFolio',NOW(),'listo','')";			
					$recReturnId = $db->query($QueryInsertValidUse);						
					echo "<div class=' badge pull-center' style='background-color:#149e82;color:white'> Se agrego Correctamente a <i >$valor</i> </div><br/>";
				}									   
			}					
	}
	
	public function nextValidEmailEnvioReport($POST) {
		require('../../clases/Email.php');
		include_once("../../repositorio/Email/class.phpmailer.php");
		include_once("../../repositorio/Email/class.smtp.php");
		$db = new DbCnnx();
		$Email = new Email();
			
			@$RutaPdf=$POST["RutaPdfReport"];
			@$GetNoFolio=$POST["GetNoFolioReport"];
			@$GetnoCliente=$POST["GetnoClienteReport"];
			@$NomOfReport=$POST["NomOfReport"];
			
			$sqlListValid = "SELECT EMAIL FROM usuarios WHERE CONCAT(NOMBRE_U,' ',APP_PATERNO_U,' ',APP_MATERNO_U)=(SELECT NOMBRE_USER FROM valid_modulo WHERE ID_VALID='$GetNoFolio' AND TYPE_USER='TECNICO' LIMIT 1)";
			@$stmtTable = $db->select($sqlListValid);			
			@$EmailOfEnvio = $stmtTable[0]['EMAIL'];
			
			$Email->correoEnvioEcosheys($EmailOfEnvio,'Validar Certificado',"<p style='font-size:18px; color:#11987d'> Usted tiene un nuevo $NomOfReport por validar con el siguiente N&deg; de Folio: $GetNoFolio </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, siga los siguientes pasos que se muestran en la imagen para validar: </sub><br><br> <img src='http://www.archysoft.com.mx/ecosheys2017/web/images/validacion.png' width='500px' height='322px'>",$RutaPdf);							
	}
	
	public function listPendientesValid($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];
		// $sqlListValid = "SELECT * FROM valid_modulo WHERE ID_CLIENTE='$ID_CLIENTE' and NOMBRE_USER='$sessionNomUser'";
		//$sqlListValid = "SELECT * FROM valid_modulo WHERE NOMBRE_USER='$sessionNomUser'";
		$sqlListValid = "SELECT v.*,f.RUTA_PDF,f.FECHA_SERVICIO FROM valid_modulo AS v,fumigacion AS f WHERE v.NOMBRE_USER='$sessionNomUser' AND v.ID_VALID=f.NO_FOLIO AND (v.VALID='true' OR v.VALID='false') ORDER BY FECHA_VALIDACION";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}
	
	public function listPendientesValidReportFumi($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];		
		$sqlListValid = "SELECT v.*,rf.RUTA_PDF,rf.FECHA_REGISTRO,rf.CLIENTE_VALID FROM valid_modulo AS v,reportes_fumi AS rf WHERE v.NOMBRE_USER='$sessionNomUser' AND v.ID_VALID=rf.NO_FOLIO AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_VALIDACION";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}

	public function ValidReportes($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma) {
		$db = new DbCnnx();
			
			$ExplodeFilename = explode("-", $filteredFilename);		
			$NOMBRE_USER = "";
			$FOLIO = $ExplodeFilename[0];
			$ID_CLIENTE = $ExplodeFilename[1]; 
			$ID_USER = $ExplodeFilename[1]; 
			$CORREO_ENVIO = $filteredCorreoEnvio; 
			$URL_FIRMA = $RutaDirFileFirma;
			
			$sqlIdTables = "SELECT * FROM empresas WHERE NO_CLIENTE='$ID_CLIENTE' limit 1"; $stmtArea = $db->combo($sqlIdTables);
				while ($fila = $stmtArea->fetch_assoc()) { 				
					$NOMBRE_USER=utf8_decode($fila["NOMBRE"]." ".$fila["APP_PATERNO"]." ".$fila["APP_MATERNO"]); 
					if($fila["NOMBRE"]==''){
						$NOMBRE_USER=utf8_decode($fila["RAZON_SOCIAL"]);
					}
				}
			echo $NOMBRE_USER;
			$SQL_update_valid = sprintf("INSERT INTO valid_modulo VALUE('$FOLIO','$ID_CLIENTE','$ID_USER','$NOMBRE_USER','CLIENTE','$URL_FIRMA','$CORREO_ENVIO','Nuevo Reporte $FOLIO',NOW(),'true')");
			$rec = $db->query($SQL_update_valid);
											
	}
	
	// cebo rodenticida 
	public function saveReporRodenticida($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_report=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];
        @$horInicio=$POST["horInicio"];
        @$horFinal=$POST["horFinal"];        
        @$Obser=$POST["Obser"];
        @$tecnico=$POST["tecnico"];
        @$id_object=$POST["id_object"];
        @$ubicacion=$POST["ubicacion"];
        @$consumo=$POST["consumo"];
		@$valid=$POST["valid"];
        @$limpieza=$POST["limpieza"];
        @$estatus_object=$POST["estatus_object"];
        @$obser_object=$POST["obser_object"];
		$rutaPdf = "web/UploadPdf/PdfFumigacion/ReportRodenticidas/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
		@$areaOperativa = @$_SESSION['sesionNomUser'];
		if($tecnico==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM alta_tecnico_aplicador where id=$tecnico limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $tecnico=$fila["NOMBRE"]; }
		}
        @$responsable=$POST["responsable"];
		if($responsable==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM altas_responsable_area where id=$responsable limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $responsable=$fila["NOMBRE"]; }
		}		
		@$administracion=$POST["administracion"];
		if($administracion==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM alta_area_administracion where id=$administracion limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $administracion=$fila["NOMBRE"]; }
		}		
		$createId = $noCliente.'ROE'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
		
			if($valid == "false"){						
				$QueryInsertValidTec = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$tecnico','TECNICO','','','Validar Certificado $noFolio','','false','')";
				$recReturnId = $db->query($QueryInsertValidTec);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$responsable','RESPONSABLE','','','Validar Certificado $noFolio','','next','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$administracion','ADMINISTRACION','','','Validar Certificado $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidCli = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$nomClient','CLIENTE','','','Nuevo Certificado $noFolio','','listo','')";
				$recReturnId = $db->query($QueryInsertValidCli);				
			}
			
			$SQL_insert_report = sprintf("INSERT INTO reportes_fumi(ID_REPORTE,NO_FOLIO,NO_CLIENTE,FECHA_REGISTRO,FECHA_REPORTE,HORA_INICIO,HORA_FINALIZADO,ID_OBJETO,UBICACION,CONSUMO,MOSQUITO,MOSCA,PALOMILLA,ESCARABAJO,LIMPIEZA,ESTATUS_OBJECT,OBSERV_OBJECT,OBSERV_REPORT,AREA_OPERATIVA,TECNICO_APLICADOR,RESPONSABLE_AREA,AREA_ADMINISTRACION,NOM_CLIENTE,RUTA_JSON,RUTA_PDF,CLIENTE_VALID)
			VALUES ('$createId','$noFolio',$noCliente,now(),'$fecha_report','$horInicio','$horFinal','$id_object','$ubicacion','$consumo','N/A','N/A','N/A','N/A','$limpieza','$estatus_object','$obser_object','$Obser','$areaOperativa','$tecnico','$responsable','$administracion','$nomClient','','$rutaPdf','false') ON DUPLICATE KEY UPDATE
			ID_REPORTE=('$createId'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_REPORTE=('$fecha_report'),HORA_INICIO=('$horInicio'),HORA_FINALIZADO=('$horFinal'),ID_OBJETO=('$id_object'),UBICACION=('$ubicacion'),CONSUMO=('$consumo'),
			LIMPIEZA=('$limpieza'),ESTATUS_OBJECT=('$estatus_object'),OBSERV_OBJECT=('$obser_object'),OBSERV_REPORT=('$Obser'),TECNICO_APLICADOR=('$tecnico'),RESPONSABLE_AREA=('$responsable'),AREA_ADMINISTRACION=('$administracion'),NOM_CLIENTE=('$nomClient')");
			
			$rec = $db->query($SQL_insert_report);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	// Update rodenticida por el Tecnico 
	public function updateReporRodenticidaTecnico($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];        
        @$noCliente=$POST["noCliente"];               
        @$Obser=$POST["Obser"];       
        @$horInicio=$POST["horInicio"];       
        @$horFinal=$POST["horFinal"];       
        @$id_object=$POST["id_object"];
        @$ubicacion=utf8_decode($POST["ubicacion"]);
        @$consumo=utf8_decode($POST["consumo"]);
		@$valid=$POST["valid"];
        @$limpieza=utf8_decode($POST["limpieza"]);
        @$estatus_object=utf8_decode($POST["estatus_object"]);
        @$obser_object=$POST["obser_object"];
		
		$createId = $noCliente.'ROE'.$id_object;
		$createIdPrincipal = $noCliente.'ROE';
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
					
			$SQL_insert_report = sprintf("UPDATE reportes_fumi SET CONSUMO='$consumo',LIMPIEZA='$limpieza',ESTATUS_OBJECT='$estatus_object',OBSERV_OBJECT='$obser_object',OBSERV_REPORT='$Obser',HORA_INICIO='$horInicio',HORA_FINALIZADO='$horFinal' WHERE ID_REPORTE='$createId' AND NO_FOLIO='$noFolio'");			
			$rec = $db->query($SQL_insert_report);
			$SQL_update_report = sprintf("UPDATE reportes_fumi SET OBSERV_REPORT='$Obser',HORA_INICIO='$horInicio',HORA_FINALIZADO='$horFinal', FECHA_REPORTE=NOW() WHERE ID_REPORTE='$createIdPrincipal' AND NO_FOLIO='$noFolio'");			
			$rec = $db->query($SQL_update_report);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	public function ValidReportTecnico($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma) {
		$db = new DbCnnx();
			
			$ExplodeFilename = explode("-", $filteredFilename);			
			$ID_USER = htmlspecialchars($_COOKIE["id"]); 
			// $NOMBRE_USER = $ExplodeFilename[0]; 
			$NOMBRE_USER = utf8_decode(trim($ExplodeFilename[0]));
			$FOLIO = $ExplodeFilename[1];
			$ID_CLIENTE = $ExplodeFilename[2]; 
			$CORREO_ENVIO = $filteredCorreoEnvio; 
			$URL_FIRMA = $RutaDirFileFirma;
			$confirmEmail='false';
			
			$GenerateCode=$this->generateRandomString(3);
			
			$SQL_update_valid = sprintf("UPDATE valid_modulo SET ID_CLIENTE='$ID_CLIENTE',ID_USER='$ID_USER',NOMBRE_USER='$NOMBRE_USER',URL_FIRMA='$URL_FIRMA',CORREO_ENVIO='$CORREO_ENVIO',VALID='true',FECHA_VALIDACION=NOW(),CODE='$GenerateCode' WHERE ID_VALID='$FOLIO' and NOMBRE_USER='$NOMBRE_USER'");
			$rec = $db->query($SQL_update_valid);
				$sqlIdTables = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='next' limit 1"; $stmtArea = $db->combo($sqlIdTables);
				while ($fila = $stmtArea->fetch_assoc()) { 
				
					$tipoValidUser=$fila["TYPE_USER"]; 
					$NomUserValid=$fila["NOMBRE_USER"];
							$sqlEmail = "SELECT EMAIL FROM usuarios WHERE CONCAT(NOMBRE_U,' ',APP_PATERNO_U,' ',APP_MATERNO_U)='$NomUserValid' LIMIT 1"; $stmtEmail = $db->combo($sqlEmail);
							while ($filaEmail = $stmtEmail->fetch_assoc()) { $confirmEmail=$filaEmail["EMAIL"]; }
					
					if($tipoValidUser=='CLIENTE'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false',CORREO_ENVIO='$confirmEmail' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);
					}else if($tipoValidUser=='TECNICO'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='RESPONSABLE'");						
						$rec = $db->query($SQL_update_validNext);
					}else if($tipoValidUser=='RESPONSABLE'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);	
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='CLIENTE'");						
						$rec = $db->query($SQL_update_validNext);
					}					
				}
				
				$sqlIdTablesNEW = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='true' and TYPE_USER='RESPONSABLE'"; $stmtAreaNew = $db->combo($sqlIdTablesNEW);
				while ($filaNew = $stmtAreaNew->fetch_assoc()) { 									
						$confirmEmail='true';											
				}
				
		return $confirmEmail;
	}
	
	public function gerateJsonReportRC($POST) {
		$db = new DbCnnx();
		
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 6);
		@$count = count($arrayJqGrid);
		$file='';		
		$Id=1;  
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Id" => "$Id",
				"Ubicacion" => $arrayJqGrid[$i][1],
				"Consumo" => $arrayJqGrid[$i][2],
				"Limpieza" => $arrayJqGrid[$i][3],
				"Estatus" => $arrayJqGrid[$i][4],
				"Obser" => $arrayJqGrid[$i][5]
			);
			$Id++;
		}
		$arr_clientes = array(
			"rows" => $array			
		);
			$nombre_fichero = '../../repositorio/DataJson/DataFumigacion/ReportRodenticidas/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_clientes);
				$file = '../../repositorio/DataJson/DataFumigacion/ReportRodenticidas/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_clientes);
				$file = '../../repositorio/DataJson/DataFumigacion/ReportRodenticidas/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			}
			
			$SQL_updateNomJson = "UPDATE reportes_fumi SET RUTA_JSON='$file' WHERE NO_CLIENTE='$noCliente' AND ID_REPORTE LIKE '".$noCliente."ROE%'";
			$rec = $db->query($SQL_updateNomJson);
			
			// $datos_clientes = file_get_contents("clientes.json");
			// $json_clientes = json_decode($datos_clientes, true);
			// foreach ($json_clientes as $cliente) {				
				// echo $cliente."<br>";
			// }
	}
	
	// inspeccion de lamparas 
	public function saveReportInpecLamp($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_report=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];
        @$horInicio=$POST["horInicio"];
        @$horFinal=$POST["horFinal"];        
        @$Obser=$POST["Obser"];
        @$tecnico=$POST["tecnico"];
        @$id_object=$POST["id_object"];
        @$ubicacion=$POST["ubicacion"];
        @$mosquito=$POST["mosquito"];
        @$mosca=$POST["mosca"];
        @$palomilla=$POST["palomilla"];
        @$escarabajo=$POST["escarabajo"];
		@$valid=$POST["valid"];
        @$limpieza=$POST["limpieza"];
        @$estatus_object=$POST["estatus_object"];
        @$obser_object=$POST["obser_object"];
		$rutaPdf = "web/UploadPdf/PdfFumigacion/InspeccionLamparas/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
		@$areaOperativa = @$_SESSION['sesionNomUser'];
		if($tecnico==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM alta_tecnico_aplicador where id=$tecnico limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $tecnico=$fila["NOMBRE"]; }
		}
        @$responsable=$POST["responsable"];
		if($responsable==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM altas_responsable_area where id=$responsable limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $responsable=$fila["NOMBRE"]; }
		}
		@$administracion=$POST["administracion"];
		if($administracion==''){}else{
		$sqlIdTables = "SELECT NOMBRE FROM alta_area_administracion where id=$administracion limit 1"; $stmtArea = $db->combo($sqlIdTables);
		while ($fila = $stmtArea->fetch_assoc()) { $administracion=$fila["NOMBRE"]; }
		}
		$createId = $noCliente.'LAM'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
			
			if($valid == "false"){						
				$QueryInsertValidTec = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$tecnico','TECNICO','','','Validar Reporte $noFolio','','false','')";
				$recReturnId = $db->query($QueryInsertValidTec);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$responsable','RESPONSABLE','','','Validar Reporte $noFolio','','next','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$administracion','ADMINISTRACION','','','Validar Reporte $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidCli = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$nomClient','CLIENTE','','','Nuevo Reporte $noFolio','','listo','')";
				$recReturnId = $db->query($QueryInsertValidCli);				
			}
			
			$SQL_insert_report = sprintf("INSERT INTO reportes_fumi(ID_REPORTE,NO_FOLIO,NO_CLIENTE,FECHA_REGISTRO,FECHA_REPORTE,HORA_INICIO,HORA_FINALIZADO,ID_OBJETO,UBICACION,CONSUMO,MOSQUITO,MOSCA,PALOMILLA,ESCARABAJO,LIMPIEZA,ESTATUS_OBJECT,OBSERV_OBJECT,OBSERV_REPORT,AREA_OPERATIVA,TECNICO_APLICADOR,RESPONSABLE_AREA,AREA_ADMINISTRACION,NOM_CLIENTE,RUTA_JSON,RUTA_PDF,CLIENTE_VALID)
			VALUES ('$createId','$noFolio',$noCliente,now(),'$fecha_report','$horInicio','$horFinal','$id_object','$ubicacion','N/A','$mosquito','$mosca','$palomilla','$escarabajo','$limpieza','$estatus_object','$obser_object','$Obser','$areaOperativa','$tecnico','$responsable','$administracion','$nomClient','','$rutaPdf','false') ON DUPLICATE KEY UPDATE
			ID_REPORTE=('$createId'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_REPORTE=('$fecha_report'),HORA_INICIO=('$horInicio'),HORA_FINALIZADO=('$horFinal'),ID_OBJETO=('$id_object'),UBICACION=('$ubicacion'),MOSQUITO=('$mosquito'),MOSCA=('$mosca'),PALOMILLA=('$palomilla'),ESCARABAJO=('$escarabajo'),
			LIMPIEZA=('$limpieza'),ESTATUS_OBJECT=('$estatus_object'),OBSERV_OBJECT=('$obser_object'),OBSERV_REPORT=('$Obser'),TECNICO_APLICADOR=('$tecnico'),RESPONSABLE_AREA=('$responsable'),AREA_ADMINISTRACION=('$administracion'),NOM_CLIENTE=('$nomClient')");
			
			$rec = $db->query($SQL_insert_report);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	// Update Inspeccion de lamparas por el Tecnico 
	public function updateReporInpecLampTecnico($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$noFolio=$POST["noFolio"];        
        @$noCliente=$POST["noCliente"];               
        @$Obser=$POST["Obser"];       
        @$horInicio=$POST["horInicio"];       
        @$horFinal=$POST["horFinal"];       
        @$id_object=$POST["id_object"];
        @$ubicacion=$POST["ubicacion"];
        @$mosquito=$POST["mosquito"];
        @$mosca=$POST["mosca"];
        @$palomilla=$POST["palomilla"];
        @$escarabajo=$POST["escarabajo"];
		@$valid=$POST["valid"];
        @$limpieza=$POST["limpieza"];
        @$estatus_object=$POST["estatus_object"];
        @$obser_object=$POST["obser_object"];
		
		$createId = $noCliente.'LAM'.$id_object;
		$createIdPrincipal = $noCliente.'LAM';
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
					
			$SQL_insert_report = sprintf("UPDATE reportes_fumi SET MOSQUITO='$mosquito',MOSCA='$mosca',PALOMILLA='$palomilla',ESCARABAJO='$escarabajo',LIMPIEZA='$limpieza',ESTATUS_OBJECT='$estatus_object',OBSERV_OBJECT='$obser_object',OBSERV_REPORT='$Obser',HORA_INICIO='$horInicio',HORA_FINALIZADO='$horFinal' WHERE ID_REPORTE='$createId' AND NO_FOLIO='$noFolio'");			
			$rec = $db->query($SQL_insert_report);
			$SQL_update_report = sprintf("UPDATE reportes_fumi SET OBSERV_REPORT='$Obser',HORA_INICIO='$horInicio',HORA_FINALIZADO='$horFinal', FECHA_REPORTE=NOW() WHERE ID_REPORTE='$createIdPrincipal' AND NO_FOLIO='$noFolio'");			
			$rec = $db->query($SQL_update_report);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	public function gerateJsonReportRL($POST) {
		$db = new DbCnnx();
		
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 9);
		@$count = count($arrayJqGrid);
		$file='';		
        $Id=1;  
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Id" => "$Id",
				"Ubicacion" => $arrayJqGrid[$i][1],
				"Mosquito" => $arrayJqGrid[$i][2],
				"Mosca" => $arrayJqGrid[$i][3],
				"Palomilla" => $arrayJqGrid[$i][4],
				"Escarabajo" => $arrayJqGrid[$i][5],
				"Limpieza" => $arrayJqGrid[$i][6],
				"Estatus" => $arrayJqGrid[$i][7],
				"Obser" => $arrayJqGrid[$i][8]
			);
			$Id++;
		}
		$arr_clientes = array(
			"rows" => $array			
		);
			$nombre_fichero = '../../repositorio/DataJson/DataFumigacion/InspeccionLamparas/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_clientes);
				$file = '../../repositorio/DataJson/DataFumigacion/InspeccionLamparas/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_clientes);
				$file = '../../repositorio/DataJson/DataFumigacion/InspeccionLamparas/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			}
			
			$SQL_updateNomJson = "UPDATE reportes_fumi SET RUTA_JSON='$file' WHERE NO_CLIENTE='$noCliente' AND ID_REPORTE LIKE '".$noCliente."LAM%'";
			$rec = $db->query($SQL_updateNomJson);
			
			// $datos_clientes = file_get_contents("clientes.json");
			// $json_clientes = json_decode($datos_clientes, true);
			// foreach ($json_clientes as $cliente) {				
				// echo $cliente."<br>";
			// }
	}
	
	//Método con str_shuffle() 
	public function generateRandomString($length = 10) { 
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	} 
	
 }

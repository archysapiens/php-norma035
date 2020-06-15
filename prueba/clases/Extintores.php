<?php

 class Extintores{
	 
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
	
	/* Guardar Orden de Trabajo */
	public function saveOrdenDeTrabajo($POST){
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_orden=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];
        @$fechaRecolect=$POST["fechaRecolect"];
        @$fechaEntrega=$POST["fechaEntrega"];        
        @$areaOperativa=$POST["areaOperativa"];
        @$tecnico=$POST["tecnico"];
        @$id_object=$POST["id_object"];
        @$refac=$POST["refac"];
        @$piezas=$POST["piezas"];
        @$cantidadAE=$POST["cantidadAE"];
        @$capacidadAE=$POST["capacidadAE"];
        @$agenteExtAE=$POST["agenteExtAE"];
        @$agenteExtOtroAE=$POST["agenteExtOtroAE"];
        @$obser_object=$POST["obser_object"];
        @$cantidad=$POST["cantidad"];
        @$servicio=$POST["servicio"];
        @$pruebaH=$POST["pruebaH"];
        @$typeService=$POST["typeService"];
        @$extPrestado=$POST["extPrestado"];
        @$extRecolect=$POST["extRecolect"];
        @$extFaltantes=$POST["extFaltantes"];
        @$cantidadAire=$POST["cantidadAire"];
        @$servicioAire=$POST["servicioAire"];
        @$pruebaHAire=$POST["pruebaHAire"];
		@$typeRegistro=$POST["typeRegistro"];
		@$valid=$POST["valid"];
		@$recibiDe=strtoupper($POST["recibiDe"]);
		@$precioNum=$POST["precioNum"];
		@$precioLetras=ucwords(strtolower($POST["precioLetras"]));
				
		$rutaPdf = "web/UploadPdf/PdfExtintores/OrdenDeTrabajo/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
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
		$createId = $noCliente.'OT'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
		
			if($valid == "false"){						
				$QueryInsertValidOpe = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$areaOperativa','OPERATIVA','','','Validar Orden Trabajo $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidOpe);
				$QueryInsertValidTec = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$tecnico','TECNICO','','','Validar Orden Trabajo $noFolio','','next','')";
				$recReturnId = $db->query($QueryInsertValidTec);
				$QueryInsertValidCli = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$nomClient','CLIENTE','','','Nueva Orden Trabajo $noFolio','','listo','')";
				$recReturnId = $db->query($QueryInsertValidCli);				
			}
						
			$SQL_insert_orden = sprintf("INSERT INTO ordent_ext(ID_ORDENT, TIPO_REGISTRO, NO_FOLIO, NO_CLIENTE, FECHA_REGISTRO, FECHA_ORDENT, FECHA_RECOLECT, FECHA_ENTREGA, ID_OBJETO, CANTIDAD_AE, CAPACIDAD_AE, AGENTE_EXT, AGENTE_EXT_OTROS, OBSERV_AE, TYPE_SERVICE, CANTIDAD_MANGUE, SERVICIO_MANGUE, PH_MANGUE, ID_REFACCIONES, PIEZAS_REFACCION, EXTE_PRESTADOS, EXTE_RECOLECT, EXTE_FALTANTES, CANTIDAD_AA, SERVICIO_AA, PH_AA, RECIBIDE, PRECIONUM, PRECIOLETRAS, AREA_OPERATIVA, TECNICO_APLICADOR, RESPONSABLE_AREA, AREA_ADMINISTRACION, NOM_CLIENTE, RUTA_JSON, RUTA_PDF, CLIENTE_VALID, NEXTSTEP_POLIZA, NEXTSTEP_PH, NEXTSTEP_CHECKLIST)
			VALUES ('$createId', '$typeRegistro', '$noFolio', $noCliente,now(),'$fecha_orden', '$fechaRecolect', '$fechaEntrega', '$id_object', '$cantidadAE', '$capacidadAE', '$agenteExtAE', '$agenteExtOtroAE', '$obser_object', '$typeService', '$cantidad', '$servicio', '$pruebaH', '$refac', '$piezas', '$extPrestado', '$extRecolect', '$extFaltantes', '$cantidadAire', '$servicioAire', '$pruebaHAire', '$recibiDe', '$precioNum', '$precioLetras', '$areaOperativa', '$tecnico', '$responsable', '$administracion', '$nomClient', '', '$rutaPdf', 'false', 'false', 'false', 'false') ON DUPLICATE KEY UPDATE
			ID_ORDENT=('$createId'),TIPO_REGISTRO=('$typeRegistro'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_ORDENT=('$fecha_orden'),FECHA_RECOLECT=('$fechaRecolect'),FECHA_ENTREGA=('$fechaEntrega'),ID_OBJETO=('$id_object'),CANTIDAD_AE=('$cantidadAE'),CAPACIDAD_AE=('$capacidadAE'),AGENTE_EXT=('$agenteExtAE'),AGENTE_EXT_OTROS=('$agenteExtOtroAE'),OBSERV_AE=('$obser_object'),TYPE_SERVICE=('$typeService'),CANTIDAD_MANGUE=('$cantidad'),SERVICIO_MANGUE=('$servicio'),PH_MANGUE=('$pruebaH'),ID_REFACCIONES=('$refac'),PIEZAS_REFACCION=('$piezas'),EXTE_PRESTADOS=('$extPrestado'),EXTE_RECOLECT=('$extRecolect'),EXTE_FALTANTES=('$extFaltantes'),
			CANTIDAD_AA=('$cantidadAire'),SERVICIO_AA=('$servicioAire'),PH_AA=('$pruebaHAire'),RECIBIDE=('$recibiDe'),PRECIONUM=('$precioNum'),PRECIOLETRAS=('$precioLetras'),AREA_OPERATIVA=('$areaOperativa'),TECNICO_APLICADOR=('$tecnico'),RESPONSABLE_AREA=('$responsable'),AREA_ADMINISTRACION=('$administracion'),NOM_CLIENTE=('$nomClient')");
			$rec = $db->query($SQL_insert_orden);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}
    }
	
	/* Generar Json Orden de Trabajo */
	public function gerateJsonOT($POST) {
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
				"Cantidad" => $arrayJqGrid[$i][1],
				"Capacidad" => $arrayJqGrid[$i][2],
				"AgenteExt" => $arrayJqGrid[$i][3],
				"AgenteExtOtros" => $arrayJqGrid[$i][4],
				"Obser" => $arrayJqGrid[$i][5]
			);
			$Id++;
		}
		$arr_agentes = array(
			"rows" => $array			
		);
			$nombre_fichero = '../../repositorio/DataJson/DataExtintores/OrdenDeTrabajo/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_agentes);
				$file = '../../repositorio/DataJson/DataExtintores/OrdenDeTrabajo/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_agentes);
				$file = '../../repositorio/DataJson/DataExtintores/OrdenDeTrabajo/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			}
			
			$SQL_updateNomJson = "UPDATE ordent_ext SET RUTA_JSON='$file' WHERE NO_CLIENTE='$noCliente' AND ID_ORDENT LIKE '".$noCliente."OT%'";
			$rec = $db->query($SQL_updateNomJson);
			
			// $datos_clientes = file_get_contents("clientes.json");
			// $json_clientes = json_decode($datos_clientes, true);
			// foreach ($json_clientes as $cliente) {				
				// echo $cliente."<br>";
			// }
			if($rec==1){
				echo 'Exito Json';
				
			}
	}
	
	/*Delete Orden de Trabajo*/
	public function deleteTableNewOrdenT($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();
		
		

        @$getnoCliente=$POST["GetnoCliente"];
		@$getNoFolioOT="OT".substr($POST["GetNoFolio"],2,6)."______".str_pad($getnoCliente, 4, '0', STR_PAD_LEFT);
		@$getNoFolioPG="PG".substr($POST["GetNoFolio"],2,6)."______".str_pad($getnoCliente, 4, '0', STR_PAD_LEFT);
		@$getNoFolioCL="CL".substr($POST["GetNoFolio"],2,6)."______".str_pad($getnoCliente, 4, '0', STR_PAD_LEFT);
			
			
		@$Query1 ="DELETE FROM ordent_ext WHERE NO_FOLIO LIKE '$getNoFolioOT'"; 
		@$Query2 ="DELETE FROM valid_modulo WHERE ID_VALID LIKE '$getNoFolioOT'"; 
		@$Query3 ="DELETE FROM poliza_ext WHERE NO_FOLIO LIKE '$getNoFolioPG'"; 
		@$Query4 ="DELETE FROM valid_modulo WHERE ID_VALID LIKE '$getNoFolioPG'"; 
		@$Query5 ="DELETE FROM checklist_ext WHERE NO_FOLIO LIKE '$getNoFolioCL'"; 
		
		var_dump($Query1); echo "<br>";
			var_dump($Query2); echo "<br>";
			var_dump($Query3); echo "<br>";
			var_dump($Query4);echo "<br>";
			var_dump($Query5);echo "<br>";
		exit;
    }
	
	/* Agregar Correo de Envio */
	public function saveAddEmailCorreoEnvio($POST){
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
					$QueryInsertValidUse = "INSERT INTO valid_modulo VALUE('$GetNoFolio','$GetnoCliente','','','AddEmailEnvio','','$valor','Envio de Orden Trabajo $GetNoFolio',NOW(),'listo','')";			
					$recReturnId = $db->query($QueryInsertValidUse);						
					echo "<div class=' badge pull-center' style='background-color:#149e82;color:white'> Se agrego Correctamente a <i >$valor</i> </div><br/>";
				}									   
			}					
	}
	
	/* Function para confirmar de Recibido (Cliente) */
	public function ConfirmReciOrdenDeT($filteredFilename,$RutaDirFileFirma){ 
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
	
	/* Valida tipo de cliente y actualiza informacion como ruta de imagen firma entre otros datos en la tabla valid_modulo */
	public function ValidFumiOrdenDeT($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma,$nextDocument='') {
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
				
				if($nextDocument=='true'){
					$SQL_update_validNext = "UPDATE ordent_ext SET NEXTSTEP_POLIZA='true' WHERE ID_ORDENT LIKE '".$ID_CLIENTE."OT%' AND NO_FOLIO='$FOLIO'";						
					$rec = $db->query($SQL_update_validNext); 
					$SQL_correOpera = "SELECT CORREO_ENVIO FROM valid_modulo WHERE ID_VALID='$FOLIO' AND TYPE_USER='OPERATIVA'";						
					$recCorreOpera = $db->select($SQL_correOpera);
					$Correo_AreaOperativa = $recCorreOpera[0]["CORREO_ENVIO"];
					$SQL_NEXTSTEP_PH = "SELECT NEXTSTEP_PH FROM ordent_ext WHERE NO_FOLIO='$FOLIO' GROUP BY NEXTSTEP_PH";
					$recNEXTSTEP_PH = $db->select($SQL_NEXTSTEP_PH);
					$confirmEmail='ConfirmPoliza-'.$Correo_AreaOperativa.'-'.$FOLIO.'-'.$ID_CLIENTE.'-'.$recNEXTSTEP_PH[0]["NEXTSTEP_PH"];
				}
				
				$sqlIdTablesNEW = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='true' and TYPE_USER='ADMINISTRACION'"; $stmtAreaNew = $db->combo($sqlIdTablesNEW);
				while ($filaNew = $stmtAreaNew->fetch_assoc()) { 									
						$confirmEmail='true';											
				}
				
		return $confirmEmail;
	}
	
	/* ValidExtintores Listado */
	public function listPendientesValidOrdenT($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];		
		$sqlListValid = "SELECT v.*,ot.RUTA_PDF,ot.FECHA_REGISTRO,ot.CLIENTE_VALID FROM valid_modulo AS v,ordent_ext AS ot WHERE v.NOMBRE_USER='$sessionNomUser' AND v.ID_VALID=ot.NO_FOLIO AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_VALIDACION";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}
	
	/* ValidExtintores Listado */
	public function listPendientesValidPolizaG($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];				
		$sqlListValid = "SELECT v.*,pg.RUTA_PDF,pg.FECHA_REGISTRO,pg.CLIENTE_VALID,pg.TYPE_DOCUMENT,pg.RUTA_PDF_PH FROM valid_modulo AS v,poliza_ext AS pg WHERE v.NOMBRE_USER='$sessionNomUser' AND v.ID_VALID=pg.NO_FOLIO AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_VALIDACION";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}
	
	// Update Orden de Trabajo por el Tecnico 
	public function updateOrdenTraTecnico($POST){
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_orden=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$fechaRecolect=$POST["fechaRecolect"];
        @$fechaEntrega=$POST["fechaEntrega"];        
        @$id_object=$POST["id_object"];
        @$refac=$POST["refac"];
        @$piezas=$POST["piezas"];
        @$cantidadAE=$POST["cantidadAE"];
        @$capacidadAE=$POST["capacidadAE"];
        @$agenteExtAE=$POST["agenteExtAE"];
        @$agenteExtOtroAE=$POST["agenteExtOtroAE"];
        @$obser_object=$POST["obser_object"];
        @$cantidad=$POST["cantidad"];
        @$servicio=$POST["servicio"];
        @$pruebaH=$POST["pruebaH"];
        @$typeService=$POST["typeService"];
        @$extPrestado=$POST["extPrestado"];
        @$extRecolect=$POST["extRecolect"];
        @$extFaltantes=$POST["extFaltantes"];
        @$cantidadAire=$POST["cantidadAire"];
        @$servicioAire=$POST["servicioAire"];
        @$pruebaHAire=$POST["pruebaHAire"];
		@$typeRegistro=$POST["typeRegistro"];
		@$recibiDe=strtoupper($POST["recibiDe"]);
		@$precioNum=$POST["precioNum"];
		@$precioLetras=ucwords(strtolower($POST["precioLetras"]));
		
		$createId = $noCliente.'OT'.$id_object;
		$createIdPrincipal = $noCliente.'OT';
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
			
			if($typeRegistro=='AgenteExt'){ 
				$SQLUpadteOrdenT = sprintf("UPDATE ordent_ext SET CANTIDAD_AE='$cantidadAE',CAPACIDAD_AE='$capacidadAE',AGENTE_EXT='$agenteExtAE',AGENTE_EXT_OTROS='$agenteExtOtroAE',OBSERV_AE='$obser_object',FECHA_RECOLECT='$fechaRecolect',FECHA_ENTREGA='$fechaEntrega' WHERE ID_ORDENT='$createId' AND NO_FOLIO='$noFolio'");			
				$rec = $db->query($SQLUpadteOrdenT); }
				
			if($typeRegistro=='RefacExt'){ 
				$SQLUpadteOrdenT = sprintf("UPDATE ordent_ext SET ID_REFACCIONES='$refac',PIEZAS_REFACCION='$piezas',FECHA_RECOLECT='$fechaRecolect',FECHA_ENTREGA='$fechaEntrega' WHERE ID_ORDENT='$createId' AND NO_FOLIO='$noFolio'");			
				$rec = $db->query($SQLUpadteOrdenT); }
			
			if($typeRegistro=='General'){ 
				$SQLUpadteOrdenT = sprintf("UPDATE ordent_ext SET TYPE_SERVICE='$typeService',CANTIDAD_MANGUE='$cantidad',SERVICIO_MANGUE='$servicio',PH_MANGUE='$pruebaH',EXTE_PRESTADOS='$extPrestado',EXTE_RECOLECT='$extRecolect',EXTE_FALTANTES='$extFaltantes',CANTIDAD_AA='$cantidadAire',SERVICIO_AA='$servicioAire',PH_AA='$pruebaHAire',FECHA_RECOLECT='$fechaRecolect',FECHA_ENTREGA='$fechaEntrega',RECIBIDE='$recibiDe',PRECIONUM='$precioNum',PRECIOLETRAS='$precioLetras' WHERE ID_ORDENT='$createIdPrincipal' AND NO_FOLIO='$noFolio'");			
				$rec = $db->query($SQLUpadteOrdenT);
					//verificar si requiere un pdf para pruebas hidrostaticas
					if(@$pruebaH!=''){
						$SQLUpadteOrdenT = "UPDATE ordent_ext SET NEXTSTEP_PH='true' WHERE ID_ORDENT LIKE '".$noCliente."OT%' AND NO_FOLIO='$noFolio'";			
						$rec = $db->query($SQLUpadteOrdenT);
					}else{
						$SQLUpadteOrdenT = "UPDATE ordent_ext SET NEXTSTEP_PH='false' WHERE ID_ORDENT LIKE '".$noCliente."OT%' AND NO_FOLIO='$noFolio'";			
						$rec = $db->query($SQLUpadteOrdenT);
					}
					
				}
							
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}

    }
	
	
	/************** Comienza codigo para Poliza de Garantia y Pruebas Hidrostaticas ********************/
	/* Guardar Orden de Trabajo */
	public function savePolizaAndPH($POST){
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_orden=$POST["fecha_service"];
		@$fecha_PG_PH=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];      
        @$areaOperativa=$POST["areaOperativa"];
        @$tecnico=$POST["tecnico"];
        @$id_object=$POST["id_object"];
        @$cantidadAE=$POST["cantidadAE"];
        @$capacidadAE=$POST["capacidadAE"];
        @$agenteExtAE=$POST["agenteExtAE"];
        @$agenteExtOtroAE=$POST["agenteExtOtroAE"];
        @$typeService_object=$POST["typeService_object"];
        @$examVisu=$POST["examVisu"];
        @$medioPrue=$POST["medioPrue"];
        @$presOpe=$POST["presOpe"];
        @$presPrue=$POST["presPrue"];
        @$duraPrue=$POST["duraPrue"];
        @$Obser=$POST["Obser"];
		@$typeRegistro=$POST["typeRegistro"];
        @$typeDocument=$POST["typeDocument"];
		@$valid=$POST["valid"];
				
		$rutaPdfPoliza = "web/UploadPdf/PdfExtintores/PolizaGarantia/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
		$rutaPdfPH = "web/UploadPdf/PdfExtintores/PruebasH/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
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
		$createId = $noCliente.'PG'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 
		 
			if($valid == "false"){						
				$QueryInsertValidOpe = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$areaOperativa','OPERATIVA','','','Validar Póliza Garantía $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidOpe);
				$QueryInsertValidRes = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$responsable','RESPONSABLE','','','Validar Póliza Garantía $noFolio','','next','')";
				$recReturnId = $db->query($QueryInsertValidRes);
				$QueryInsertValidAdm = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$administracion','ADMINISTRACION','','','Validar Póliza Garantía $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidAdm);
				$QueryInsertValidTec = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$tecnico','TECNICO','','','Validar Póliza Garantía $noFolio','','','')";
				$recReturnId = $db->query($QueryInsertValidTec);
				$QueryInsertValidCli = "INSERT INTO valid_modulo VALUE('$noFolio','$noCliente','','$nomClient','CLIENTE','','','Nueva Póliza Garantía $noFolio','','listo','')";
				$recReturnId = $db->query($QueryInsertValidCli);				
			}
			
			if(@$typeDocument=='POLIZA'){ $rutaPdfPH=''; }
			
			$SQL_insert_PG_PH = sprintf("INSERT INTO poliza_ext(ID_PG_PH, TIPO_REGISTRO, NO_FOLIO, NO_CLIENTE, FECHA_REGISTRO, FECHA_POLIZA, ID_OBJETO, CANTIDAD_PZA, CAPACIDAD_KG, AGENTE_EXT, AGENTE_EXT_OTROS, TYPE_SERVICE, TYPE_DOCUMENT, EXAMEN_VISUAL, MEDIO_PRUEBA, PRESION_OPERACION, PRESION_PRUEBA, DURACION_PRUEBA, OBSERV_POLIZA, AREA_OPERATIVA, TECNICO_APLICADOR, RESPONSABLE_AREA, AREA_ADMINISTRACION, NOM_CLIENTE, RUTA_JSON, RUTA_PDF, RUTA_JSON_PH, RUTA_PDF_PH, CLIENTE_VALID)
			VALUES ('$createId', '$typeRegistro', '$noFolio', $noCliente,now(),'$fecha_PG_PH', '$id_object', '$cantidadAE', '$capacidadAE', '$agenteExtAE', '$agenteExtOtroAE', '$typeService_object', '$typeDocument', '$examVisu', '$medioPrue', '$presOpe', '$presPrue', '$duraPrue', '$Obser', '$areaOperativa', '$tecnico', '$responsable', '$administracion', '$nomClient', '', '$rutaPdfPoliza','','$rutaPdfPH', 'false') ON DUPLICATE KEY UPDATE
			ID_PG_PH=('$createId'),TIPO_REGISTRO=('$typeRegistro'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_POLIZA=('$fecha_PG_PH'),ID_OBJETO=('$id_object'),CANTIDAD_PZA=('$cantidadAE'),CAPACIDAD_KG=('$capacidadAE'),AGENTE_EXT=('$agenteExtAE'),AGENTE_EXT_OTROS=('$agenteExtOtroAE'),TYPE_SERVICE=('$typeService_object'),TYPE_DOCUMENT=('$typeDocument'),EXAMEN_VISUAL=('$examVisu'),MEDIO_PRUEBA=('$medioPrue'),PRESION_OPERACION=('$presOpe'),PRESION_PRUEBA=('$presPrue'),DURACION_PRUEBA=('$duraPrue'),OBSERV_POLIZA=('$Obser'),
			AREA_OPERATIVA=('$areaOperativa'),TECNICO_APLICADOR=('$tecnico'),RESPONSABLE_AREA=('$responsable'),AREA_ADMINISTRACION=('$administracion'),NOM_CLIENTE=('$nomClient')");
			$rec = $db->query($SQL_insert_PG_PH);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}
    }
	
	/* Generar Json PolizaGarantia */
	public function gererateJsonPG($POST) {
		$db = new DbCnnx();
		
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 7);
		@$count = count($arrayJqGrid);
		$file='';		
		$Id=1;  
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Id" => "$Id",
				"Cantidad" => $arrayJqGrid[$i][1],
				"Capacidad" => $arrayJqGrid[$i][2],
				"AgenteExt" => $arrayJqGrid[$i][3],
				"AgenteExtOtros" => $arrayJqGrid[$i][4],
				"TypeService" => $arrayJqGrid[$i][5],
				"TypePdf" => $arrayJqGrid[$i][6]
			);
			$Id++;
		}
		$arr_agentes = array(
			"rows" => $array			
		);
			$nombre_fichero = '../../repositorio/DataJson/DataExtintores/PolizaGarantia/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_agentes);
				$file = '../../repositorio/DataJson/DataExtintores/PolizaGarantia/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_agentes);
				$file = '../../repositorio/DataJson/DataExtintores/PolizaGarantia/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			}
			
			$SQL_updateNomJson = "UPDATE poliza_ext SET RUTA_JSON='$file' WHERE NO_CLIENTE='$noCliente' AND ID_PG_PH LIKE '".$noCliente."PG%'";
			$rec = $db->query($SQL_updateNomJson);
			
			if($rec==1){
				echo 'Exito Json';
				
			}
	}
	
	/* Valida tipo de cliente y actualiza informacion como ruta de imagen firma entre otros datos en la tabla valid_modulo */
	public function ValidExtPolizaG($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma,$nextDocument='') {
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
					}else if($tipoValidUser=='RESPONSABLE'){
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);	
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='ADMINISTRACION'");						
						$rec = $db->query($SQL_update_validNext);
					}else if($tipoValidUser=='ADMINISTRACION'){   
						$SQL_update_validChangeNext = sprintf("UPDATE valid_modulo SET VALID='false' WHERE ID_VALID='$FOLIO' and VALID='next'");						
						$rec = $db->query($SQL_update_validChangeNext);	
						$SQL_update_validNext = sprintf("UPDATE valid_modulo SET VALID='next' WHERE ID_VALID='$FOLIO' and TYPE_USER='TECNICO'");						
						$rec = $db->query($SQL_update_validNext);						
					}					
				}
				
				if($nextDocument=='true'){ 
					// $SQL_update_validNext = "UPDATE ordent_ext SET NEXTSTEP_CHECKLIST='true' WHERE ID_ORDENT LIKE '".$ID_CLIENTE."OT%' AND NO_FOLIO='$FOLIO'";						
					$SQL_update_validNext = "UPDATE ordent_ext SET NEXTSTEP_CHECKLIST='true' WHERE ID_ORDENT LIKE '".$ID_CLIENTE."OT%'";						
					$rec = $db->query($SQL_update_validNext); 
					$SQL_correOpera = "SELECT CORREO_ENVIO FROM valid_modulo WHERE ID_VALID='$FOLIO' AND TYPE_USER='OPERATIVA'";						
					$recCorreOpera = $db->select($SQL_correOpera);
					$Correo_AreaOperativa = $recCorreOpera[0]["CORREO_ENVIO"];
					$confirmEmail='ConfirmCheckList-'.$Correo_AreaOperativa.'-'.$FOLIO.'-'.$ID_CLIENTE.'-true';					
				}
				
				$sqlIdTablesNEW = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' and VALID='true' and TYPE_USER='ADMINISTRACION'"; $stmtAreaNew = $db->combo($sqlIdTablesNEW);
				while ($filaNew = $stmtAreaNew->fetch_assoc()) { 									
						// $confirmEmail='true';											
				}
				
		return $confirmEmail;
	}
	

	//Método con str_shuffle() 
	public function generateRandomString($length = 10) { 
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	}

	// Update Orden de Trabajo por el Tecnico 
	public function updatePolizaGAndPHTecnico($POST){
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];       
        @$typeDocument=$POST["typeDocument"];       
        @$noCliente=$POST["noCliente"];       
		
		$createId = $noCliente.'PG'.$id_object;
		$createIdPrincipal = $noCliente.'PG';
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 		
						
				$SQLUpadteOrdenT = sprintf("UPDATE poliza_ext SET FECHA_POLIZA='$fecha_service' WHERE NO_FOLIO='$noFolio'");			
				$rec = $db->query($SQLUpadteOrdenT);														
							
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}
    }
	
	/* Agregar Correo de Envio */
	public function saveAddEmailCorreoEnvioPG($POST){
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
					$QueryInsertValidUse = "INSERT INTO valid_modulo VALUE('$GetNoFolio','$GetnoCliente','','','AddEmailEnvio','','$valor','Envio de Poliza de Garantía $GetNoFolio',NOW(),'listo','')";			
					$recReturnId = $db->query($QueryInsertValidUse);						
					echo "<div class=' badge pull-center' style='background-color:#149e82;color:white'> Se agrego Correctamente a <i >$valor</i> </div><br/>";
				}									   
			}					
	}
	
	/************** Comienza código para CheckList ********************/
	/* Guardar CheckList */
	public function saveCheckList($POST){
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
        @$fecha_checkList=$POST["fecha_service"];
        @$noCliente=$POST["noCliente"];
        @$nomClient=$POST["nomClient"];     
        @$direction=$POST["direction"];     
        @$areaOperativa=$POST["areaOperativa"];       
        @$id_object=$POST["id_object"];
        @$capacidadAE=$POST["capacidadAE"];
        @$agenteExtAE=$POST["agenteExtAE"];
        @$manometrAE=$POST["manometrAE"];
        @$seguroAE=$POST["seguroAE"];
        @$boquillAE=$POST["boquillAE"];
        @$manguerAE=$POST["manguerAE"];
        @$bastagoAE=$POST["bastagoAE"];
        @$pinturAE=$POST["pinturAE"];
        @$etiquetAE=$POST["etiquetAE"];
        @$mattoAE=$POST["mattoAE"];
        @$pesoFinal=$POST["pesoFinal"];
        @$fugatina=$POST["fugatina"];
        @$Reviso=$POST["Reviso"];
        @$Obser=$POST["Obser"];
        @$ExtintoresLib=$POST["ExtintoresLib"];
        @$CordinadorExt=$POST["CordinadorExt"];		       
		@$typeRegistro=$POST["typeRegistro"];						
		$rutaPdf = "web/UploadPdf/PdfExtintores/CheckList/".@$_SESSION['sesionSucur']."/".$noFolio."-".$noCliente.".pdf";
				
		$createId = $noCliente.'CL'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 					
						
			$SQL_insert_checklist = sprintf("INSERT INTO checklist_ext(ID_CHECKLIST, TIPO_REGISTRO, NO_FOLIO, NO_CLIENTE, FECHA_REGISTRO, FECHA_CHECKLIST, ID_OBJETO, CAPACIDAD_KG, AGENTE_EXT, MANOMETRO, SEGURO, BOQUILLA, MANGUERA, BASTAGO, PINTURA, ETIQUETA, RECARGAM, PESOF, FUGATINA_KG, REVISO, NUM_EXT_LIBE, OBSERVATION, AREA_OPERATIVA, NOM_CLIENTE, DIRECCION, RUTA_JSON, RUTA_PDF)
			VALUES ('$createId', '$typeRegistro', '$noFolio', $noCliente,now(),'$fecha_checkList', '$id_object', '$capacidadAE', '$agenteExtAE', '$manometrAE', '$seguroAE', '$boquillAE', '$manguerAE', '$bastagoAE', '$pinturAE', '$etiquetAE', '$mattoAE', '$pesoFinal', '$fugatina', '$Reviso', '$ExtintoresLib', '$Obser', '$CordinadorExt', '$nomClient', '$direction', '', '$rutaPdf') ON DUPLICATE KEY UPDATE
			ID_CHECKLIST=('$createId'),TIPO_REGISTRO=('$typeRegistro'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_CHECKLIST=('$fecha_checkList'),ID_OBJETO=('$id_object'),CAPACIDAD_KG=('$capacidadAE'),AGENTE_EXT=('$agenteExtAE'),MANOMETRO=('$manometrAE'),SEGURO=('$seguroAE'),BOQUILLA=('$boquillAE'),MANGUERA=('$manguerAE'),BASTAGO=('$bastagoAE'),PINTURA=('$pinturAE'),ETIQUETA=('$etiquetAE'),RECARGAM=('$mattoAE'),PESOF=('$pesoFinal'),FUGATINA_KG=('$fugatina'),REVISO=('$Reviso'),NUM_EXT_LIBE=('$ExtintoresLib'),
			OBSERVATION=('$Obser'),AREA_OPERATIVA=('$CordinadorExt'),NOM_CLIENTE=('$pruebaHAire'),DIRECCION=('$nomClient')");
			$rec = $db->query($SQL_insert_checklist);
			
			// print_r($rec);
			if($rec==1){
				echo '1#';
				
			}
		}
    }
	
	/* Generar Json CheckList */
	public function gerateJsonCL($POST) {
		$db = new DbCnnx();
		
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 14);
		@$count = count($arrayJqGrid);
		$file='';		
		$Id=1;  
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Folio" => "$Id",
				"Capacidad" => $arrayJqGrid[$i][1],
				"AgenteExt" => $arrayJqGrid[$i][2],
				"Manometro" => $arrayJqGrid[$i][3],
				"Seguro" => $arrayJqGrid[$i][4],
				"Boquilla" => $arrayJqGrid[$i][5],
				"Manguera" => $arrayJqGrid[$i][6],
				"Bastago" => $arrayJqGrid[$i][7],
				"Pintura" => $arrayJqGrid[$i][8],
				"Etiqueta" => $arrayJqGrid[$i][9],
				"Recarga" => $arrayJqGrid[$i][10],
				"PesoFinal" => $arrayJqGrid[$i][11],
				"Fugatina" => $arrayJqGrid[$i][12],
				"Reviso" => $arrayJqGrid[$i][13]
			);
			$Id++;
		}
		$arr_agentes = array(
			"rows" => $array			
		);
			$nombre_fichero = '../../repositorio/DataJson/DataExtintores/CheckList/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_agentes);
				$file = '../../repositorio/DataJson/DataExtintores/CheckList/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_agentes);
				$file = '../../repositorio/DataJson/DataExtintores/CheckList/'.$sucursal.'/dataReport'.$noCliente.'.json';
				file_put_contents($file, $json_string);
			}
			
			$SQL_updateNomJson = "UPDATE checklist_ext SET RUTA_JSON='$file' WHERE NO_CLIENTE='$noCliente' AND ID_CHECKLIST LIKE '".$noCliente."CL%'";
			$rec = $db->query($SQL_updateNomJson);
			
			// $datos_clientes = file_get_contents("clientes.json");
			// $json_clientes = json_decode($datos_clientes, true);
			// foreach ($json_clientes as $cliente) {				
				// echo $cliente."<br>";
			// }
			if($rec==1){
				echo 'Exito Json';
				
			}
	}
	
	
	
 }

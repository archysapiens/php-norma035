<?php
	header("Content-Type: application/xml; charset=utf-8");
	sleep(1);
	require('../../clases/Email.php');
	require('../../clases/Extintores.php');
	require('../../bd/bd.php');
	
	$Email = new Email();
	$Extintores = new Extintores();
	function after ($this, $inthat) {
			if (!is_bool(strpos($inthat, $this)))
			return substr($inthat, strpos($inthat,$this)+strlen($this)); };
	function before ($this, $inthat) {
			return substr($inthat, 0, strpos($inthat, $this)); };
	function between ($this, $that, $inthat){
			return before ($that, after($this, $inthat)); };

		$data = file_get_contents("php://input");
		$filteredData=substr($data, strpos($data, ",")+1);
		$filteredDataEncode = between(',', '&IdUser=', $data);
		$IdUser = substr($filteredData, strpos($filteredData, "&IdUser=")+8);
		$IdUser = between('&IdUser=', '&TypeUser=', $filteredData);
		$TypeUser=substr($filteredData, strpos($filteredData, "&TypeUser=")+10);
		$TypeUser = between('&TypeUser=', '&sucursal=', $filteredData);
		$Sucursal=substr($filteredData, strpos($filteredData, "&sucursal=")+10);
		$Sucursal = between('&sucursal=', '&dirTypeFumi=', $filteredData);
		$TypeFumi=substr($filteredData, strpos($filteredData, "&dirTypeFumi=")+13);
		$TypeFumi = between('&dirTypeFumi=', '&dataFilename=', $filteredData);		
		$filteredCorreoEnvio=substr($filteredData, strpos($filteredData, "&correoEnvio=")+13);		
		$filteredFilename=substr($filteredData, strpos($filteredData, "&dataFilename=")+14);
		$filteredFilename = between('&dataFilename=', '&correoEnvio=', $filteredData);	
		$ExplodeFilename = explode("-", $filteredFilename);	
		$FOLIO = "<span style='color:rgb(4, 117, 94)'>".$ExplodeFilename[1]."</span>";		
		$decodedData=base64_decode($filteredDataEncode);
		$fic_name = $filteredFilename.'.png';
		$fic_namePdf = $filteredFilename.'.pdf';
		$nombre_ficheroFirmas = '../../web/images/FileUpload/FirmasOrdenT/'.$TypeFumi.'/'.$Sucursal.'';
		$nombre_ficheroPDF = '../../web/UploadPdf/PdfExtintores/'.$TypeFumi.'/'.$Sucursal.'';
		
		if (file_exists($nombre_ficheroFirmas)) { }else { mkdir($nombre_ficheroFirmas, 0777, true); }
		if (file_exists($nombre_ficheroPDF)) { }else { mkdir($nombre_ficheroPDF, 0777, true); }
		
		switch ($TypeFumi) {
			case ($TypeFumi == "OrdenDeTrabajo"):
				$RutaDirFileFirma = $nombre_ficheroFirmas."/".$fic_name;
				$RutaDirFileFirma2 = $nombre_ficheroFirmas."/".utf8_decode($fic_name);
				$RutaDirFilePDF = $nombre_ficheroPDF."/".$fic_namePdf;
				
				if($TypeUser=="CLIENTE"){
					$db = new DbCnnx();
					$ExplodeFilenameSwitch = explode("-", $filteredFilename);													
					
					$NOMBRE_USER = trim($ExplodeFilenameSwitch[0]);
					$FOLIO = $ExplodeFilenameSwitch[1];
					$ID_CLIENTE = $ExplodeFilenameSwitch[2]; 
					
					$SQL_update_valid = sprintf("UPDATE valid_modulo SET ID_CLIENTE='$ID_CLIENTE',ID_USER='$IdUser',NOMBRE_USER='$NOMBRE_USER',URL_FIRMA='$RutaDirFileFirma',CORREO_ENVIO='$filteredCorreoEnvio',VALID='true',FECHA_VALIDACION=NOW() WHERE ID_VALID='$FOLIO' and NOMBRE_USER='$NOMBRE_USER' and TYPE_USER='CLIENTE'");
					$rec = $db->query($SQL_update_valid);
					
					// Actualiza Campo CLIENTE_VALID a true
					$SQL_update_validClient = sprintf("UPDATE ordent_ext SET CLIENTE_VALID='true' WHERE NO_FOLIO='$FOLIO'");
					$rec = $db->query($SQL_update_validClient);
					
					// print_r($SQL_update_valid);
				}
				
				break;			
			case "PolizaGarantia":
					$RutaDirFileFirma = $nombre_ficheroFirmas."/".$fic_name;
					$RutaDirFileFirma2 = $nombre_ficheroFirmas."/".utf8_decode($fic_name);
					$RutaDirFilePDF = $nombre_ficheroPDF."/".$fic_namePdf;
					
					if($TypeUser=="CLIENTE"){
						$db = new DbCnnx();
						$ExplodeFilenameSwitch = explode("-", $filteredFilename);													
						
						$NOMBRE_USER = trim($ExplodeFilenameSwitch[0]);
						$FOLIO = $ExplodeFilenameSwitch[1];
						$ID_CLIENTE = $ExplodeFilenameSwitch[2]; 
						
						$SQL_update_valid = sprintf("UPDATE valid_modulo SET ID_CLIENTE='$ID_CLIENTE',ID_USER='$IdUser',NOMBRE_USER='$NOMBRE_USER',URL_FIRMA='$RutaDirFileFirma',CORREO_ENVIO='$filteredCorreoEnvio',VALID='true',FECHA_VALIDACION=NOW() WHERE ID_VALID='$FOLIO' and NOMBRE_USER='$NOMBRE_USER' and TYPE_USER='CLIENTE'");
						$rec = $db->query($SQL_update_valid);
						
						// Actualiza Campo CLIENTE_VALID a true
						$SQL_update_validClient = sprintf("UPDATE poliza_ext SET CLIENTE_VALID='true' WHERE NO_FOLIO='$FOLIO'");
						$rec = $db->query($SQL_update_validClient);
						
						// Actualizo tabla Valid Modulo y elimino el Tecnico
						$SQL_delete_validClient = sprintf("DELETE FROM valid_modulo WHERE ID_VALID='$FOLIO' and TYPE_USER='TECNICO'");
						$rec = $db->query($SQL_delete_validClient);
						
						$SQL_GET_EMAILS = "SELECT (SELECT NEXTSTEP_PH FROM ordent_ext WHERE NO_CLIENTE='$ID_CLIENTE' GROUP BY NO_CLIENTE) AS EXIST_PH,vm.TYPE_USER,vm.CORREO_ENVIO,p.RUTA_PDF AS RUTA_PDF_PG,p.RUTA_PDF_PH,(SELECT RUTA_PDF FROM ordent_ext WHERE NO_CLIENTE='$ID_CLIENTE' GROUP BY NO_CLIENTE) AS RUTA_PDF_OT,(SELECT RUTA_PDF FROM checklist_ext WHERE NO_CLIENTE='$ID_CLIENTE' GROUP BY NO_CLIENTE) AS RUTA_PDF_CL FROM valid_modulo AS vm,poliza_ext AS p WHERE vm.ID_VALID='$FOLIO' AND p.NO_FOLIO='$FOLIO' GROUP BY vm.TYPE_USER";
						$recGetEmails = $db->combo($SQL_GET_EMAILS);
						$asunto='Servicio de Extintores';
						$mensaje="<p style='font-size:18px; color:#11987d'> Usted tiene Nuevos Formatos del Modulo Extintores </p>";
						while ($fila = $recGetEmails->fetch_assoc()) {
							$typeUserTable=$fila["TYPE_USER"];
							$ArrayPdfExtintores = array('RUTA_PDF_PG'=>$fila["RUTA_PDF_PG"],
														'RUTA_PDF_PH'=>$fila["RUTA_PDF_PH"]);
							switch ($typeUserTable) {
								case 'ADMINISTRACION':
									$Email->sendEmailMuchFiles($fila["CORREO_ENVIO"],$asunto,$mensaje,$ArrayPdfExtintores);
									break;
								case 'CLIENTE':
									$ArrayPdfExtintoresC = array('RUTA_PDF_OT'=>$fila["RUTA_PDF_OT"]);
									$ArrayPdfExtintoresC = array_merge($ArrayPdfExtintores,$ArrayPdfExtintoresC);
									$Email->sendEmailMuchFiles($fila["CORREO_ENVIO"],$asunto,$mensaje,$ArrayPdfExtintoresC);
									break;
								case 'OPERATIVA':
									$ArrayPdfExtintoresO = array('RUTA_PDF_OT'=>$fila["RUTA_PDF_OT"],
														         'RUTA_PDF_CL'=>$fila["RUTA_PDF_CL"]);
									$ArrayPdfExtintoresO = array_merge($ArrayPdfExtintores,$ArrayPdfExtintoresO);
									$Email->sendEmailMuchFiles($fila["CORREO_ENVIO"],$asunto,$mensaje,$ArrayPdfExtintoresO);
									break;
								case 'RESPONSABLE':
									$Email->sendEmailMuchFiles($fila["CORREO_ENVIO"],$asunto,$mensaje,$ArrayPdfExtintores);
									break;
								case 'TECNICO':
									$Email->sendEmailMuchFiles($fila["CORREO_ENVIO"],$asunto,$mensaje,$ArrayPdfExtintores);
									break;
							}											
						}

						
						// print_r($SQL_update_valid);
					}												
				break;
		}
		
		$fp = fopen($RutaDirFileFirma2, 'wb');
		$ok = fwrite( $fp, $decodedData);
		fclose( $fp );
		if($ok){
			echo $fic_name;}
		else{
			echo "ERROR";}

?>


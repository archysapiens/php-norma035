<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	sleep(1);
	require('../../clases/Email.php');
	require('../../clases/Extintores.php');
	require('../../bd/bd.php');
	include_once("../../repositorio/Email/class.phpmailer.php");
	include_once("../../repositorio/Email/class.smtp.php");
	
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
		$filteredDataEncode = between(',', '&sucursal=', $data);
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
		$fic_name = utf8_decode($filteredFilename).'.png';
		$fic_namePdf = $filteredFilename.'.pdf';
		$nombre_ficheroFirmas = '../../web/images/FileUpload/FirmasOrdenT/'.$TypeFumi.'/'.$Sucursal.'';
		$nombre_ficheroPDF = '../../web/UploadPdf/PdfExtintores/'.$TypeFumi.'/'.$Sucursal.'';
		
		if (file_exists($nombre_ficheroFirmas)) { }else { mkdir($nombre_ficheroFirmas, 0777, true); }
		if (file_exists($nombre_ficheroPDF)) { }else { mkdir($nombre_ficheroPDF, 0777, true); }
		
		switch ($TypeFumi) {
			case "OrdenDeTrabajosss":
				$RutaDirFileFirma = $nombre_ficheroFirmas."/".$fic_name;
				$RutaDirFilePDF = $nombre_ficheroPDF."/".$fic_namePdf;
				$asunto = "Sistema Administrativo Empresarial Ecosheys";
				$mensaje = "<p style='font-size:18px; color:#11987d'> Usted tiene una nueva Orden de Trabajo con el siguiente N&deg; de Folio: $FOLIO </p><br> <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>";
				$ConfirmEnvioCorreo = false;
				if($TypeUser=="CLIENTE"){
					$Extintores->ConfirmReciOrdenDeT($filteredFilename,$RutaDirFileFirma);
				}else{
					$ReturnValidCertificado = $Extintores->ValidFumiOrdenDeT($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma);				
					if($ReturnValidCertificado !='true' and $ReturnValidCertificado !='false'){ 
						$Email->correoEnvioEcosheys($ReturnValidCertificado,'Validar Orden de Trabajo',"<p style='font-size:18px; color:#11987d'>Usted tiene una nueva Orden de Trabajo por validar con el siguiente N&deg; de Folio: $FOLIO </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, siga los siguientes pasos que se muestran en la imagen para validar: </sub><br><br> <img src='http://www.archysoft.com.mx/ecosheys2017/web/images/validacion.png' width='500px' height='322px'>",$RutaDirFilePDF);
					}
					if($ReturnValidCertificado=='true'){ 
						$Email->correoMultipleEnvioEcosheys($filteredCorreoEnvio,$asunto,$mensaje,$nombre_ficheroPDF,$filteredFilename);
					}
				}
				
				break;
			case "OrdenDeTrabajo":
				$RutaDirFileFirma = $nombre_ficheroFirmas."/".$fic_name;
				$RutaDirFilePDF = $nombre_ficheroPDF."/".$fic_namePdf;
				$asunto = "Sistema Administrativo Empresarial Ecosheys";
				$mensaje = "<p style='font-size:18px; color:#11987d'> Usted tiene una nueva Orden de Trabajo con el siguiente N&deg; de Folio: $FOLIO </p><br> <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>";
				$ConfirmEnvioCorreo = false;
				if($TypeUser=="CLIENTE"){
					$Extintores->ConfirmReciOrdenDeT($filteredFilename,$RutaDirFileFirma);
				}else{
						if($TypeUser=="TECNICO"){ 
							$ReturnValidCertificado = $Extintores->ValidFumiOrdenDeT($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma,'true'); }else{
							$ReturnValidCertificado = $Extintores->ValidFumiOrdenDeT($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma);	}			
							
					if($ReturnValidCertificado !='true' and $ReturnValidCertificado !='false'){ 
						$Email->correoEnvioEcosheys($ReturnValidCertificado,'Validar Orden de Trabajo',"<p style='font-size:18px; color:#11987d'>Usted tiene una nueva Orden de Trabajo por validar con el siguiente N&deg; de Folio: $FOLIO </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, siga los siguientes pasos que se muestran en la imag&eacute;n para validar: </sub><br><br> <img src='http://www.archysoft.com.mx/ecosheys2017/web/images/ValidExt/OT_diagrama.png' width='500px' height='322px'>",$RutaDirFilePDF);
					}
					if($ReturnValidCertificado=='true'){ 
						$Email->correoMultipleEnvioEcosheys($filteredCorreoEnvio,$asunto,$mensaje,$nombre_ficheroPDF,$filteredFilename);
					}
					$resultado = strpos($ReturnValidCertificado, 'ConfirmPoliza');
					if($resultado !== FALSE){
						$ExplodeREturn = explode("-", $ReturnValidCertificado);
						$NumFolio = $ExplodeREturn[2];
						$UrlNewPG = 'http://www.archysoft.com.mx/ecosheys2017/controllers/Extintores/newPolizaG.php?SetIdClient='.$ExplodeREturn[3].'&SetPdfPH='.$ExplodeREturn[4];
						$Email->correoEnvioEcosheys($ExplodeREturn[1],'Aprobacion Poliza Garantia',"<p style='font-size:18px; color:#11987d'>Ya puede generar una nueva P&oacuteliza de Garant&iacutea, dando continuidad al siguiente N&deg de Folio: $NumFolio </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='$UrlNewPG' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, siga los siguientes pasos que se muestran en la imag&eacute;n para validar: </sub><br><br> <img src='http://www.archysoft.com.mx/ecosheys2017/web/images/ValidExt/PG_diagrama.png' width='500px' height='322px'>",$RutaDirFilePDF);						
					}
				}												
				break;
			case "PolizaGarantia":
				$RutaDirFileFirma = $nombre_ficheroFirmas."/".$fic_name;
				$RutaDirFilePDF = $nombre_ficheroPDF."/".$fic_namePdf;
				$asunto = "Sistema Administrativo Empresarial Ecosheys";
				$mensaje = "<p style='font-size:18px; color:#11987d'> Usted tiene una nueva P&oacuteliza de Garant&iacutea con el siguiente N&deg; de Folio: $FOLIO </p><br> <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>";
				$ConfirmEnvioCorreo = false;
				if($TypeUser=="CLIENTE"){
					$Extintores->ConfirmReciOrdenDeT($filteredFilename,$RutaDirFileFirma);
				}else{
						if($TypeUser=="ADMINISTRACION"){ 
							$ReturnValidCertificado = $Extintores->ValidExtPolizaG($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma,'true'); }else{
							$ReturnValidCertificado = $Extintores->ValidExtPolizaG($filteredCorreoEnvio,$filteredFilename,$RutaDirFileFirma);	}			
							
					if($ReturnValidCertificado !='true' and $ReturnValidCertificado !='false'){ 
						$Email->correoEnvioEcosheys($ReturnValidCertificado,'Validar Poliza de Garantia',"<p style='font-size:18px; color:#11987d'>Usted tiene una nueva P&oacuteliza de Garant&iacutea por validar con el siguiente N&deg; de Folio: $FOLIO </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, siga los siguientes pasos que se muestran en la imagen para validar: </sub><br><br> <img src='http://www.archysoft.com.mx/ecosheys2017/web/images/ValidExt/VPG_diagrama.png' width='500px' height='322px'>",$RutaDirFilePDF);
					}
					if($ReturnValidCertificado=='true'){ 
						$Email->correoMultipleEnvioEcosheys($filteredCorreoEnvio,$asunto,$mensaje,$nombre_ficheroPDF,$filteredFilename);
					}
					$resultado = strpos($ReturnValidCertificado, 'ConfirmCheckList');
					if($resultado !== FALSE){
						$ExplodeREturn = explode("-", $ReturnValidCertificado);
						$NumFolio = $ExplodeREturn[2];
						$UrlNewPG = 'http://www.archysoft.com.mx/ecosheys2017/controllers/Extintores/checkList.php?SetIdClient='.$ExplodeREturn[3].'&SetPdfPHChecList='.$ExplodeREturn[4];
						$Email->correoEnvioEcosheys($ExplodeREturn[1],'Aprobacion Check List',"<p style='font-size:18px; color:#11987d'>Ya puede generar un Check List, dando continuidad al siguiente N&deg de Folio: $NumFolio </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='$UrlNewPG' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, siga los siguientes pasos que se muestran en la imag&eacute;n para validar: </sub><br><br> <img src='http://www.archysoft.com.mx/ecosheys2017/web/images/ValidExt/CL_diagrama.png' width='500px' height='322px'>",$RutaDirFilePDF);												
					}
				}												
				break;
			default:
				$RutaDirFileFirma = "../../web/images/FileUpload/FirmasOrdenT/".$fic_name;
				$RutaDirFilePDF = "../../web/UploadPdf/PdfExtintores/".$fic_namePdf;
				$asunto = " ";
				$mensaje = " ";
				$ConfirmEnvioCorreo = true;
		}
		
		$fp = fopen($RutaDirFileFirma, 'wb');
		$ok = fwrite( $fp, $decodedData);
		fclose( $fp );
		if($ok and $ConfirmEnvioCorreo==true){
			$Email->correoEnvioEcosheys($filteredCorreoEnvio,$asunto,$mensaje,$RutaDirFilePDF);
			echo $fic_name;}
		else{
			echo "ERROR";}

?>


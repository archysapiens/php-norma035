<?php

 class Email{

    public function correoEnvioEcosheys($para,$asunto,$mensaje,$RutaDirFilePDF){
		
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth=true; 
		$mail->SMTPSecure = "ssl"; 
		$mail->Host="smtp.gmail.com"; 
		$mail->Port=465; 
		// $mail->Port=25 o 465; //puerto para hotmail		
		$mail->AddAddress($para);
		$mail->Username="sistemaecosheys@gmail.com";
		$mail->Password="almita12";
		$mail->From="sistemaecosheys@gmail.com";
		$mail->FromName = "Sistema Ecosheys";
		$mail->Subject=$asunto;
		$mail->Body=utf8_encode($mensaje);
		$mail->WordWrap=50; 
		$mail->MsgHTML($mensaje);
		$mail->AddAttachment($RutaDirFilePDF);
		// $body = file_get_contents('../../template/Email.html');
			ob_start();
			include '../../template/Email.php';
			$body = ob_get_clean();
		$mail->Body = $body;
		if($mail->Send()){ 
		//$respuesta="el mensaje no se pudo enviar";
		//$respuesta.="Error: ".$mail->ErrorInfo;
		} else {}

    }

	public function correoMultipleEnvioEcosheys($para,$asunto,$mensaje,$RutaDirFilePDF,$filteredFilename){
		$db = new DbCnnx();
		
		$ExplodeFilename = explode("-", $filteredFilename);	
		$FOLIO = $ExplodeFilename[1];
		$ID_CLIENTE = $ExplodeFilename[2]; 
		
		$sqlIdTables = "SELECT * FROM valid_modulo WHERE ID_VALID='$FOLIO' AND VALID='true' OR (VALID='false' AND TYPE_USER='CLIENTE') OR (VALID='listo' AND TYPE_USER='AddEmailEnvio')"; $stmtArea = $db->combo($sqlIdTables);
			while ($fila = $stmtArea->fetch_assoc()) {
				$correoEnvio[]=$fila["CORREO_ENVIO"]; 
			} 		
		// print_r($correoEnvio);
		// echo $RutaDirFilePDF;
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth=true; 
		$mail->SMTPSecure = "ssl"; 
		$mail->Host="smtp.gmail.com"; 
		$mail->Port=465; 
		// $mail->Port=25 o 465; //puerto para hotmail		
		$mail->AddAddress($correoEnvio[0]);
		$mail->AddAddress($correoEnvio[1]);
		$mail->AddAddress($correoEnvio[2]);
		$mail->AddAddress($correoEnvio[3]);
		@$mail->AddAddress(@$correoEnvio[4]);
		@$mail->AddAddress(@$correoEnvio[5]);
		$mail->Username="sistemaecosheys@gmail.com";
		$mail->Password="almita12";
		$mail->From="sistemaecosheys@gmail.com";
		$mail->FromName = "Sistema Ecosheys";
		$mail->Subject=$asunto;
		$mail->Body=utf8_encode($mensaje);
		$mail->WordWrap=50; 
		$mail->MsgHTML($mensaje);
		$mail->AddAttachment($RutaDirFilePDF."/".$FOLIO.'-'.$ID_CLIENTE.'.pdf');
		// $body = file_get_contents('../../template/Email.html');
			ob_start();
			include '../../template/Email.php';
			$body = ob_get_clean();
		$mail->Body = $body;
		if($mail->Send()){ 
		//$respuesta="el mensaje no se pudo enviar";
		//$respuesta.="Error: ".$mail->ErrorInfo;
		} else {}

    }
	
	public function sendEmailMuchFiles($para,$asunto,$mensaje,$RutaDirFilePDF){
		
		$FileOne=$RutaDirFilePDF['RUTA_PDF_OT'];
		$FileTwo=$RutaDirFilePDF['RUTA_PDF_CL'];
		$FileThree=$RutaDirFilePDF['RUTA_PDF_PG'];
		$FileFour=$RutaDirFilePDF['RUTA_PDF_PH'];
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth=true; 
		$mail->SMTPSecure = "ssl"; 
		$mail->Host="smtp.gmail.com"; 
		$mail->Port=465; 
		// $mail->Port=25 o 465; //puerto para hotmail		
		$mail->AddAddress($para);
		$mail->Username="sistemaecosheys@gmail.com";
		$mail->Password="almita12";
		$mail->From="sistemaecosheys@gmail.com";
		$mail->FromName = "Sistema Ecosheys";
		$mail->Subject=$asunto;
		$mail->Body=utf8_encode($mensaje);
		$mail->WordWrap=50; 
		$mail->MsgHTML($mensaje);
		$mail->AddAttachment($FileOne);
		$mail->AddAttachment($FileTwo);
		$mail->AddAttachment($FileThree);
		$mail->AddAttachment($FileFour);
		// $body = file_get_contents('../../template/Email.html');
			ob_start();
			include '../../template/Email.php';
			$body = ob_get_clean();
		$mail->Body = $body;
		if($mail->Send()){ 
		//$respuesta="el mensaje no se pudo enviar";
		//$respuesta.="Error: ".$mail->ErrorInfo;
		} else {}

    }
	
	public function sendEmailSignup($asunto,$mensaje,$arrayData){
		
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth=true; 
		$mail->SMTPSecure = "ssl"; 
		$mail->Host="smtp.gmail.com"; 
		$mail->Port=465; 
		// $mail->Port=25 o 465; //puerto para hotmail		
		$mail->AddAddress($arrayData['to']);
		$mail->Username="sistemaecosheys@gmail.com";
		$mail->Password="almita12";
		$mail->From="sistemaecosheys@gmail.com";
		$mail->FromName = "Sistema Ecosheys";
		$mail->Subject=$asunto;
		$mail->Body=utf8_encode($mensaje);
		$mail->WordWrap=50; 
		$mail->MsgHTML($mensaje);			
			ob_start();
			include 'template/EmailSignupForm.php';
			$body = ob_get_clean();
		$mail->Body = $body;
		if($mail->Send()){ 
		//$respuesta="el mensaje no se pudo enviar";
		//$respuesta.="Error: ".$mail->ErrorInfo;
		} else {}

    }
	 
	public function sendEmailCotizacion($asunto,$mensaje,$arrayData){
		
		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth=true; 
		$mail->SMTPSecure = "ssl"; 
		$mail->Host="smtp.gmail.com"; 
		$mail->Port=465; 
		// $mail->Port=25 o 465; //puerto para hotmail		
		$mail->AddAddress($arrayData['email']);
		$mail->Username="sistemaecosheys@gmail.com";
		$mail->Password="almita12";
		$mail->From="sistemaecosheys@gmail.com";
		$mail->FromName = "Sistema Ecosheys";
		$mail->Subject=$asunto;
		$mail->Body=utf8_encode($mensaje);
		$mail->WordWrap=50; 
		$mail->MsgHTML($mensaje);			
			ob_start();
			include 'template/EmailCotizacion.php';
			$body = ob_get_clean();
		$mail->Body = $body;
		if($mail->Send()){ 
		//$respuesta="el mensaje no se pudo enviar";
		//$respuesta.="Error: ".$mail->ErrorInfo;
		} else {}

    }
 }

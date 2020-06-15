<?php

 class UploadUser{
	
	
	public function uploadExcel($objHoja){
		// require('../bd/bd.php');
		$db = new DbCnnx();
		$count=0;
		foreach ($objHoja as $iIndice=>$objCelda) {
			
			if($count>=1){
				$no_cliente=$objCelda['A']; $status=$objCelda['B'];	$medio_pago=$objCelda['CF'];
				$metodo_pago=$objCelda['BQ']; $RFC=trim($objCelda['F']); $personaM=$objCelda['C']; $personaF=$objCelda['D']; $razon_social=$objCelda['C']; $sucursal=$objCelda['CC'];
				$giro=$objCelda['BS']; $ruta=$objCelda['CE']; $estado=$objCelda['Q']; $municipio=$objCelda['P'];
				$cp=$objCelda['N']; $localidad=$objCelda['O']; $calle=$objCelda['H']; $num_ext=$objCelda['J'];
				$num_int=$objCelda['I']; $entre_calle1=$objCelda['K']; $entre_calle2=$objCelda['L']; $referencia=$objCelda['BL'];
				$nombre=utf8_decode($objCelda['E']); $telefono_ofi=$objCelda['V']; $email=$objCelda['AE']; $nra=$objCelda['BX'];
				
				$nombreExplode = explode(" ", $nombre);
				if(count($nombreExplode)==3){
					$nombre=$nombreExplode[0];
					$apPaterno=$nombreExplode[1];
					$apMaterno=$nombreExplode[2];
				}else if(count($nombreExplode)==4){
					$nombre=$nombreExplode[0].' '.$nombreExplode[1];
					$apPaterno=$nombreExplode[2];
					$apMaterno=$nombreExplode[3];
				}else if(count($nombreExplode)==5){
					if($nombreExplode[3]==''){
						$nombre=$nombreExplode[0].' '.$nombreExplode[1];
						$apPaterno=$nombreExplode[2];
						$apMaterno=$nombreExplode[4];
					}else{
						$nombre=$nombreExplode[0].' '.$nombreExplode[1].' '.$nombreExplode[2];
						$apPaterno=$nombreExplode[3];
						$apMaterno=$nombreExplode[4];
					}										
				}else{
					$apPaterno="";
					$apMaterno="";
				}
				
				
				if($estado=='MEXICO'){
					$estado='ESTADO DE MEXICO';
				}elseif($estado=='CDMX'){
					$estado='DISTRITO FEDERAL';
				}
				
				if($municipio=='ACAMBAY'){
					$municipio='ACAMBAY DE RUIZ CASTA';
				}
				
				if($status=='ACTIVO'){
					$status='A';
				}else{$status='I';}
				
				if($medio_pago=='NOTA'){
					$RFC="CALCULARFCCFI";
				}
				
				if($personaM!='' or $personaM!=' '){
				// if(strlen($RFC)==12){
					
					$QueryInsertPago = "INSERT INTO pago VALUE(DEFAULT,'$metodo_pago','$medio_pago') ON DUPLICATE KEY UPDATE TIPO_DE_PAGO=('$metodo_pago'),MEDIO_DE_PAGO=('$medio_pago')";
					$recReturnId = $db->queryReturnId($QueryInsertPago);
					
					$SQL_insert_empresa = "insert into empresas(NO_CLIENTE,RFC,RAZON_SOCIAL,NRA,NO_CTA_CON,GIRO,ZONA,ESTADO,DEL_MPIO,CP,COLONIA,CALLE,NUM_EXT,NUM_INT,REFERENCIA,ENTRE_CALLE1,ENTRE_CALLE2,ESTATUS,FECHA_INGRESO,LATITUD,LONGITUD,ID_PAGO,ID_ALTA_SUCURSAL)
					values('$no_cliente','$RFC','$razon_social','$nra','','$giro','$ruta','$estado','$municipio','$cp','$localidad','$calle',
					'$num_ext','$num_int','$referencia','$entre_calle1','$entre_calle2','$status',NOW(),'','',$recReturnId,(SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sucursal')) ON DUPLICATE KEY UPDATE 
					RFC=('$RFC'),RAZON_SOCIAL=('$razon_social'),CALLE=('$calle'),
					NUM_INT=('$num_int'),NUM_EXT=('$num_ext'),ZONA=('$ruta'),DEL_MPIO=('$municipio'),ESTADO=('$estado'),COLONIA=('$localidad'),
					CP=('$cp'),REFERENCIA=('$referencia'),ENTRE_CALLE1=('$entre_calle1'),ENTRE_CALLE2=('$entre_calle2'),NRA=('$nra'),ID_PAGO=($recReturnId),ID_ALTA_SUCURSAL=(SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sucursal'),LATITUD=(''), LONGITUD=(''),NO_CTA_CON=(''),GIRO=('$giro')";
					$rec = $db->query($SQL_insert_empresa);
					
					$SQL_insert_contacto = "INSERT INTO contactos (NO_CLIENTE, NOMBRE_C,APP_PATERNO_C,APP_MATERNO_C,EMAIL,HORARIO_ATENCION,HOR1,HOR2,HORARIO_ATENCION2,HOR3,HOR4,TELEFONO_OFI,TELEFONO_CELL,OBSERVACIONES, RFC_EMP)
					VALUES ('$no_cliente', '$nombre','$apPaterno','$apMaterno', '$email','hora1 A hora2','hora1','hora2','hora3 A hora4','hora3','hora4','$telefono_ofi','tel_celular','observaciones', '$RFC') ON DUPLICATE KEY UPDATE 
					RFC_EMP=('$RFC'),NOMBRE_C=('$nombre'), APP_PATERNO_C=('$apPaterno'),APP_MATERNO_C=('$apMaterno'),
					EMAIL=('$email'),TELEFONO_OFI=('$telefono_ofi'),TELEFONO_CELL=('tel_celular'),
					HORARIO_ATENCION=('hora1 A hora2'),HOR1=('hora1'),HOR2=('hora2'),HORARIO_ATENCION2=('hora3 A hora4'),HOR3=('hora3'),HOR4=('hora4'),OBSERVACIONES=('observaciones')";
					
					$rec = $db->query($SQL_insert_contacto);
					
				}elseif($personaF!='' or $personaF!=' '){
				// }elseif(strlen($RFC)==13){
					
					$QueryInsertPago = "INSERT INTO pago VALUE(DEFAULT,'$metodo_pago','$medio_pago') ON DUPLICATE KEY UPDATE TIPO_DE_PAGO=('$metodo_pago'),MEDIO_DE_PAGO=('$medio_pago')";
					$recReturnId = $db->queryReturnId($QueryInsertPago);
					echo $count.",";
					$SQL_insert_empresa = "insert into empresas(NO_CLIENTE,RFC,NOMBRE,APP_PATERNO,APP_MATERNO,NRA,NO_CTA_CON,GIRO,ZONA,ESTADO,DEL_MPIO,CP,COLONIA,CALLE,NUM_EXT,NUM_INT,REFERENCIA,ENTRE_CALLE1,ENTRE_CALLE2,ESTATUS,FECHA_INGRESO,LATITUD,LONGITUD,ID_PAGO,ID_ALTA_SUCURSAL)
					values('$no_cliente','$RFC','$nombre','$apPaterno','$apMaterno','$nra','','$giro','$ruta','$estado','$municipio','$cp','$localidad','$calle',
					'$num_int','$num_ext','$referencia','$entre_calle1','$entre_calle2','$status',NOW(),'','',$recReturnId,(SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sucursal')) ON DUPLICATE KEY UPDATE
					rfc=('$RFC'),nombre=('$nombre'),app_paterno=('$apPaterno'),app_materno=('$apMaterno'),calle=('$calle'),
					num_int=('$num_int'),num_ext=('$num_ext'),zona=('$ruta'),del_mpio=('$municipio'),estado=('$estado'),colonia=('$localidad'),
					cp=('$cp'),referencia=('$referencia'),ENTRE_CALLE1=('$entre_calle1'),ENTRE_CALLE2=('$entre_calle2'),nra=('$nra'),latitud=(''), longitud=(''), no_cta_con=(''), giro=('$giro'),ESTATUS=('$status'),ID_PAGO=($recReturnId),ID_ALTA_SUCURSAL=(SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sucursal')";
					
					$rec = $db->query($SQL_insert_empresa);
					
					$SQL_insert_contacto = "insert into contactos(NO_CLIENTE,NOMBRE_C,APP_PATERNO_C,APP_MATERNO_C,EMAIL,HORARIO_ATENCION,HOR1,HOR2,HORARIO_ATENCION2,HOR3,HOR4,TELEFONO_OFI,TELEFONO_CELL,OBSERVACIONES,RFC_EMP)
					values('$no_cliente','$nombre','$apPaterno','$apMaterno','$email','hora1 A hora2','hora1','hora2','hora3 A hora4','hora3','hora4','$telefono_ofi','tel_celular','observaciones','$RFC') ON DUPLICATE KEY UPDATE
					rfc_emp=('$RFC'),nombre_c=('$nombre'), app_paterno_c=('$apPaterno'),app_materno_c=('$apMaterno'),
					email=('$email'),telefono_ofi=('$telefono_ofi'),telefono_cell=('tel_celular'),
					horario_atencion=('hora1 A hora2'),HOR1=('hora1'),HOR2=('hora2'),horario_atencion2=('hora3 A hora4'),HOR3=('hora3'),HOR4=('hora4'),observaciones=('observaciones')";
					
					$rec = $db->query($SQL_insert_contacto);
					
					// ECHO $SQL_insert_empresa;
					
				}
				
				$SQL_Create_User = "INSERT INTO usuarios(ID_USER,NO_CLIENTE_EMP,NOMBRE_U,APP_PATERNO_U,APP_MATERNO_U,EMAIL,TELEFONO_OFI_U,TELEFONO_CEL_U,TIPO_USUARIO,AREA,RUTA_IMG,OBSERVACIONES,FEC_REGISTRO,USUARIO,PASSWORD,SUCURSAL,ESTATUS)
				VALUES ($no_cliente,'$no_cliente','$nombre','$apPaterno','$apMaterno','$email','$telefono_ofi','','CLIENTE','','','',NOW(),'$email','$no_cliente','$sucursal','A') ON DUPLICATE KEY UPDATE
				NOMBRE_U=('$nombre'),APP_PATERNO_U=('$apPaterno'), APP_MATERNO_U=('$apMaterno'),EMAIL=('$email'),TELEFONO_OFI_U=('$telefono_ofi'),USUARIO=('$email'),PASSWORD=('$no_cliente'),SUCURSAL=('$sucursal')";
				
				$rec = $db->query($SQL_Create_User);
				
			}
			
				$count++;
		
		}

    }
	
 }

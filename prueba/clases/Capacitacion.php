<?php
 class Capacitacion{
	
	public function loadInscription(){
		$db = new DbCnnx();
		// $sqlListInscrp = "SELECT * FROM mod_capacitacion WHERE NO_CLIENTE=".@$_COOKIE['id']." GROUP BY NO_FOLIO ORDER BY ID_CAPACITACION ASC";
		// $sqlListInscrp = "SELECT cp.*,cur.NAME,cur.INSTRUCTOR,cur.DESCRIPTION,cur.RUTA_IMG,pay.URL_EVIDENCIA_PAGO,pay.VALID_PAGO,pay.TYPE_PAGO,pay.VALID_COTIZACION FROM mod_capacitacion AS cp,cursos AS cur, mod_pago AS pay WHERE NO_CLIENTE=".@$_COOKIE['id']." AND cp.NAME_CURSO=cur.NAME AND cp.NO_FOLIO=pay.ID_PAGO GROUP BY NO_FOLIO ORDER BY ID_CAPACITACION ASC";
		$sqlListInscrp = "SELECT cp.*,cur.NAME,cur.INSTRUCTOR,cur.DESCRIPTION,cur.RUTA_IMG,pay.URL_EVIDENCIA_PAGO,pay.VALID_PAGO,pay.TYPE_PAGO,pay.VALID_COTIZACION,pay.SUBTOTAL,pay.IVA,pay.TOTAL,pay.CURP,pay.URL_FORMATO_PAGO,coti.NUM_PERSONAS,coti.PDF_COTIZACION FROM mod_capacitacion AS cp,cursos AS cur, mod_pago AS pay, mod_cotizacion AS coti WHERE NO_CLIENTE=".@$_COOKIE['id']." AND cp.NAME_CURSO=cur.NAME AND cp.NO_FOLIO=pay.ID_PAGO AND coti.NO_FOLIO=cp.NO_FOLIO GROUP BY NO_FOLIO ORDER BY FECHA_REGISTRO DESC";
		$stmtTable = $db->combo($sqlListInscrp);
		
		return $stmtTable;
	}
	
	public function editInscription($attrFolio){
		$db = new DbCnnx();
		// $sqlEditInscrp = "SELECT * FROM mod_capacitacion WHERE NO_FOLIO='$attrFolio' AND TIPO_REGISTRO='General'";
		$sqlEditInscrp = "SELECT *,(SELECT COUNT(*) FROM mod_capacitacion WHERE NO_FOLIO='$attrFolio' AND TIPO_REGISTRO='Registro' AND CURSO_RA <> '') AS COUNT FROM mod_capacitacion WHERE NO_FOLIO='$attrFolio' AND TIPO_REGISTRO='General'";
		$stmtTable = $db->select($sqlEditInscrp);
		
		return $stmtTable;
	}
	
	public function uploadExcel($objHoja,$nameJson){
		
		$db = new DbCnnx();
		$count=0;
		foreach ($objHoja as $iIndice=>$objCelda) {			
			if($count>=1){
				$noAlumno=trim($objCelda['A']); $fullName=ucwords(mb_strtolower($objCelda['B'], 'UTF-8'));	$company=ucwords(mb_strtolower($objCelda['C'], 'UTF-8')); $curp=trim($objCelda['D']);  $puesto=trim(ucwords(mb_strtolower($objCelda['E'], 'UTF-8')));								
				$array[]= array(
					"Id" => "$noAlumno",
					"name" => "$fullName",
					"company" => "$company",
					"curp" => "".strtoupper($curp)."",
					"puesto" => "$puesto"
				);											
			}			
			$count++;		
		}
		if($count<50){
			for ($i = $count; $i < 51; $i++) {
				$array[]= array(
					"Id" => "$i",
					"name" => utf8_encode(""),
					"company" => utf8_encode(""),
					"curp" => utf8_encode(""),
					"puesto" => utf8_encode("")
				);
			}
		}
		$arr_alumnos = array(
			"rows" => $array			
		);		
			$nombre_fichero = '../../repositorio/loadCapacitacion/json';		
			$json_string = json_encode($arr_alumnos);
			$file = $nombre_fichero."/".$nameJson.".json";
			file_put_contents($file, $json_string);
		
		?>
		<script>
			var rutatt="../../repositorio/loadCapacitacion/json/<?php echo $nameJson;?>.json";
			JqGridUrlKeyUp = '../../repositorio/DataJson/DataCapacitacion/listarJsonBlank.php?rutaJson='+rutatt;
			$('#table_list_1').setGridParam({ url: JqGridUrlKeyUp , editurl: 'newInscrip.php', datatype: "json" }).trigger('reloadGrid');
			$('#RegistroDeServicio').children('.ibox-content').toggleClass('sk-loading');
			$('#txtRutaExcel').val('<?php echo $nameJson; ?>'+'.xlsx');
		</script> <?php		
    }

		/* Guarda Nueva Inscripción */
	public function saveNewInscrip($POST){
		
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
        @$fecha_service=$POST["fecha_service"];
		@$typeRegistro=$POST["typeRegistro"];
		@$nameCurso=$POST["nameCurso"];
		@$puesto_TRA=ucwords(mb_strtolower($POST["puesto"], 'UTF-8'));
		@$reprentTrab=ucwords(mb_strtolower($POST["reprentTrab"], 'UTF-8'));
		@$reprentLega=ucwords(mb_strtolower($POST["reprentLega"], 'UTF-8'));
		@$razonSocial_EMP=strtoupper($POST["razonSocial"]);
		@$rfcEmpresa=strtoupper($POST["rfcEmpresa"]);
		@$inscrip=$POST["inscrip"];
		@$nameUploadExcel=$POST["nameUploadExcel"];
		@$noCliente=$POST["noCliente"];
		@$responsable=$POST["responsable"];
		
		@$id_object=$POST["id_object"];
		@$nameRA=ucwords(mb_strtolower($POST["nameRA"], 'UTF-8'));
		@$companyRA=ucwords(mb_strtolower($POST["companyRA"], 'UTF-8'));
		@$curpRA=strtoupper($POST["curpRA"]);	
		@$puestoRA=ucwords(mb_strtolower($POST["puestoRA"], 'UTF-8'));	
		
		@$rutaJson=$POST["rutaJson"];		       
		
				
		$createId = $noFolio.'-CP'.$id_object;
		if($noCliente == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 	
	
			// Buscar Nombre del Instructor
			$SQL_SearchCurso="SELECT INSTRUCTOR,TYPE FROM cursos WHERE NAME='$nameCurso'";
			$stmtTable = $db->select($SQL_SearchCurso);
					
			$SQL_InsertInscrip = sprintf("INSERT INTO mod_capacitacion(ID_CAPACITACION, TIPO_REGISTRO, NO_FOLIO, NO_CLIENTE, FECHA_REGISTRO, FECHA_CAPACITACION, ID_OBJETO, NOMBRE_RA, EMPRESA_RA, CURSO_RA, TYPE_SERVICE, NAME_CURSO,PUESTO_TRA,RAZON_SOCIAL_EMP,SHCP_EMP,AGENT_CAPACITA, REPRESENT_LEGAL, REPRESENT_TRABA, NAME_INSTRUCTOR, AREA_COTIZACION, AREA_ADMINISTRACION, ENTREGA, NOM_CLIENTE, RUTA_JSON, RUTA_UPLOAD_EXCEL, RUTA_PDF, PAGO_VALID, ASISTENCIA, RUTA_EVIDEN_ASISTEN)
															  VALUES ('$createId', '$typeRegistro', '$noFolio', $noCliente,now(),'$fecha_service', '$id_object', '$nameRA', '$companyRA', '$curpRA', '$inscrip', '$nameCurso','$puestoRA','$razonSocial_EMP','$rfcEmpresa','SERVICIOS ECOSHEYS S.A DE C.V','$reprentLega','$reprentTrab', '".$stmtTable[0]['INSTRUCTOR']."', 'KARINA GALINDO TORRES', 'OLGA LIDIA MORENO HERNANDEZ', '".$stmtTable[0]['TYPE']."', '$responsable', '$rutaJson', '$nameUploadExcel', '', '', 'false','') ON DUPLICATE KEY UPDATE
															ID_CAPACITACION=('$createId'),TIPO_REGISTRO=('$typeRegistro'),NO_FOLIO=('$noFolio'),NO_CLIENTE=($noCliente),FECHA_CAPACITACION=('$fecha_service'),ID_OBJETO=('$id_object'),NOMBRE_RA=('$nameRA'),EMPRESA_RA=('$companyRA'),CURSO_RA=('$curpRA'),TYPE_SERVICE=('$inscrip'),NAME_CURSO=('$nameCurso'),PUESTO_TRA=('$puestoRA'),RAZON_SOCIAL_EMP=('$razonSocial_EMP'),SHCP_EMP=('$rfcEmpresa'),
															NOM_CLIENTE=('$responsable')");
			$rec = $db->query($SQL_InsertInscrip);
			
			$sqlSearchInscrip = "SELECT NO_FOLIO FROM mod_capacitacion WHERE NO_FOLIO='$noFolio'";
			$stmtTable = $db->combo($sqlSearchInscrip);
			if($stmtTable->num_rows==1){
				//add table valid_modulo para crear cotizacion
				$QueryInsertValidCotiza = "INSERT INTO valid_modulo VALUE('$noFolio','".@$_COOKIE['id']."','40016','KARINA GALINDO TORRES','RESPONSABLE','','','Nueva Cotización $noFolio','','false','')"; 
				$rec = $db->query($QueryInsertValidCotiza);
				//add mod_pago 
				$SQL_InsertPago = sprintf("INSERT INTO mod_pago(ID_PAGO, FECHA_REGISTRO, FECHA_PAGO, FULL_NAME, EMAIL, CURP, TYPE_PAGO, BANCO, CUENTA_BANCARIA, CLAVE_BANCARIA, URL_FORMATO_PAGO, URL_EVIDENCIA_PAGO, VALID_PAGO, NO_FOLIO, VALID_COTIZACION)
											VALUES ('$noFolio', NOW(), '', '','','','', 'Banamex, S.A.', '70013200481', '002420700132004810', '', '', 'false', '$noFolio', 'false')");
				$rec = $db->query($SQL_InsertPago);
			}
			
			
			

			if($rec==1){ echo '1#'; }
		}
    }
	
	/* Crea Una Petición Para Cotizar Su Inscripción*/
	public function saveNewCotizacion($REQUEST){
		$db = new DbCnnx();
		$SQL_InsertCotizaci = sprintf("INSERT INTO mod_cotizacion(ID_COTIZACION, TYPE_COTIZA, NO_FOLIO, TYPE_SERVICIO, NOMBRE_FULL, EMAIL, TELEFONO, LUGAR, CURSO, NUM_PERSONAS, NIVEL, MANUALES)
									   VALUES('".$REQUEST['txtsendNoFolio']."','COSTEAR','".$REQUEST['txtsendNoFolio']."','Capacitación','".ucwords(mb_strtolower($REQUEST['txtNombreFull'], 'UTF-8'))."','".$REQUEST['txtEmail']."','".$REQUEST['txtPhone']."','".ucwords(mb_strtolower($REQUEST['txtPlace'], 'UTF-8'))."','".$REQUEST['txtCurso']."','".$REQUEST['txtNumPerson']."','".$REQUEST['txtNivel']."','".$REQUEST['txtManuales']."')");
		$rec = $db->query($SQL_InsertCotizaci);
	}
	
	//Searh Datos de la Cotización
	public function SearchDatosCotizacion($POST){
		$db = new DbCnnx();
		@$attrFolio=$POST['attrFolio'];
		$sqlSearhCotizaci = "SELECT coti.*,pay.CURP,pay.TYPE_PAGO FROM mod_cotizacion AS coti, mod_pago AS pay WHERE ID_COTIZACION='$attrFolio' AND ID_PAGO='$attrFolio'";
		$stmtTable = $db->select($sqlSearhCotizaci);
		
		echo json_encode($stmtTable); exit;
	}
	
	//Searh Datos Para Costear el Curso
	public function SearchDatosForCostear($POST){
		$db = new DbCnnx();
		@$attrFolio=$POST['attrFolio'];
		$sqlSearhCostos = "SELECT coti.NOMBRE_FULL,coti.EMAIL,coti.TELEFONO,coti.NEW_FOLIO,cap.RAZON_SOCIAL_EMP,cap.SHCP_EMP FROM mod_cotizacion AS coti, mod_capacitacion AS cap WHERE coti.ID_COTIZACION='$attrFolio' AND (cap.NO_FOLIO='$attrFolio' AND TIPO_REGISTRO='General')";
		$stmtTable = $db->select($sqlSearhCostos);
		
		if($stmtTable[0]['NEW_FOLIO']!=''){	$sqlSearhDatosEdit = "SELECT coti.CP,coti.VIGENCIA_COTIZACION,coti.NOTA,pag.CANTIDAD,pag.CONCEPTO,pag.PRECIO_UNIT,pag.IMPORTE,pag.CANTIDAD_LETRA,pag.SUBTOTAL,pag.IVA,pag.TOTAL FROM mod_cotizacion AS coti, mod_pago AS pag WHERE coti.ID_COTIZACION='$attrFolio' AND pag.NO_FOLIO='$attrFolio'";
											$stmtTableModPago = $db->select($sqlSearhDatosEdit); $stmtTable=array_merge($stmtTable[0],$stmtTableModPago[0]); $stmtTable=array("0" => $stmtTable); }
		
		echo json_encode($stmtTable); exit;
	}
	
	//FUNCION PARA VALIDAR la cotizacion por parte de Karina
	public function ValidCotizacionCurso($POST){
		require('../../clases/Email.php');
		include_once("../../repositorio/Email/class.phpmailer.php");
		include_once("../../repositorio/Email/class.smtp.php");
		$db = new DbCnnx();
		$Email = new Email();

        @$FolioValid=$POST["FolioValid"];        
        @$IdClientValid=$POST["IdClientValid"];
        @$TypeUser=$POST["TypeUser"];        
			
		$SqlUpdateValid_Modulo = "UPDATE valid_modulo SET FECHA_VALIDACION=NOW(), VALID='true' WHERE ID_VALID='$FolioValid' AND TYPE_USER='$TypeUser'";	$rec = $db->query($SqlUpdateValid_Modulo);					
		$SqlUpdateMod_Pago = "UPDATE mod_pago SET VALID_COTIZACION='true' WHERE NO_FOLIO='$FolioValid'"; $rec = $db->query($SqlUpdateMod_Pago);	

		$SqlSearch="SELECT EMAIL,PDF_COTIZACION,CURSO FROM mod_cotizacion WHERE ID_COTIZACION='$FolioValid'";
		$exec = $db->select($SqlSearch);
		
		$Email->correoEnvioEcosheys($exec[0]['EMAIL'],'Cotizacion para el curso: '.$exec[0]['CURSO'].'',"<p style='font-size:18px; color:#11987d'>Usted tiene una nueva cotizacion con el siguiente curso: ".$exec[0]['CURSO'].", su suscripcion esta casi lista! </p><sub style='font-size:12px; color:rgb(99, 92, 92)'>Favor de ingresar al sistema ECOSHEYS <a href='http://www.archysoft.com.mx/ecosheys2017/' target='_blank' style='color:#11987d;text-decoration:none'> http://www.archysoft.com.mx/ecosheys2017/index.php</a>, donde tendra que escribir su Usuario y Contraseña, por ultimo dirijase al apartado Inscribirse. </sub><br><br> ","../../".$exec[0]['PDF_COTIZACION']);
		
		echo true;
    }
	
		/* Guarda Nuevo Pago */
	public function saveNewPago($POST){
		
		$db = new DbCnnx();
		
		@$SendFolio=$POST["SendFolio"];   
        @$SendNombreFull=strtoupper($POST["SendNombreFull"]);
		@$SendCurp=strtoupper($POST["SendCurp"]);
		@$SendEmail=$POST["SendEmail"];
		@$SendTypePago=$POST["SendTypePago"];
	       
		if($SendFolio == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Folio');
			</script>";
		 }
		else{ 	 	
					
			$SQL_InsertPago = sprintf("INSERT INTO mod_pago(ID_PAGO, FECHA_REGISTRO, FECHA_PAGO, FULL_NAME, EMAIL, CURP, TYPE_PAGO, URL_FORMATO_PAGO, URL_EVIDENCIA_PAGO, VALID_PAGO, NO_FOLIO, VALID_COTIZACION)
															  VALUES ('$SendFolio', NOW(), '', '$SendNombreFull $SendApellidos','$SendEmail','$SendCurp','$SendTypePago', '', '', 'false', '$SendFolio', 'false') ON DUPLICATE KEY UPDATE
															FECHA_PAGO=(''),FULL_NAME=('$SendNombreFull $SendApellidos'),EMAIL=('$SendEmail'),CURP=('$SendCurp'),TYPE_PAGO=('$SendTypePago')");
			$rec = $db->query($SQL_InsertPago);

			if($rec==1){ echo '1#'; }
		}
    }
	
	/* Generar Json Lista de Alumnos */
	public function gerateJsonCP($POST) {
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 5);
		@$count = count($arrayJqGrid);
		$file='';		
		$Id=1;  
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Id" => "$Id",
				"name" => ucwords(mb_strtolower($arrayJqGrid[$i][1], 'UTF-8')),
				"company" => ucwords(mb_strtolower($arrayJqGrid[$i][2], 'UTF-8')),
				"curp" => strtoupper($arrayJqGrid[$i][3]),
				"puesto" => strtoupper($arrayJqGrid[$i][4])
			);
			$Id++;
		}
		$arr_alumnos = array(
			"rows" => $array			
		);
		
			$nombre_fichero = '../../repositorio/DataJson/DataCapacitacion/NewInscrip/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_alumnos);
				$file = '../../repositorio/DataJson/DataCapacitacion/NewInscrip/'.$sucursal.'/'.$noFolio.'.json';
				file_put_contents($file, $json_string); $rec=1;
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_alumnos);
				$file = '../../repositorio/DataJson/DataCapacitacion/NewInscrip/'.$sucursal.'/'.$noFolio.'.json';
				file_put_contents($file, $json_string); $rec=1;
			}
			
			
			if($rec==1){ echo 'Exito Json'; }
	}
	
	//searchLogros obtenidos para el responsale del curso
	public function searchFiles($POST){
		$db = new DbCnnx();
		$nameCarpet=trim($POST['nameCarpet']);
		$directorio = "../../web/UploadPdf/PdfCapacitacion/FormatosCursos/".$_SESSION['sesionSucur']."/$nameCarpet";
		$gestor_dir = opendir($directorio); ?>
		<style>
		.producto-overlay {
			display: block;
			height: 158px;
			background: rgba(127, 138, 136, 0.71);
			line-height: 158px;
			position: absolute;
			bottom: -158px;
			width: 100%;
			left: 0px;
			right: 0px;
			transition: .3s; }
		.producto:hover .producto-overlay { bottom: 0px; transition: .3s; }
		.producto-overlay a {
			font-size: 80px;
			margin: 0;
			color: #fff;
			width: 100%;
			float: left;
			text-align: center; }
		.producto-overlay a:hover { color: #ffffff; background: #6f7372c9 !important; }
		.producto-overlay a:first-child { background: rgba(0,0,0,0.2); }		
		.producto-thumbnail { position: relative; overflow: hidden; }
		a { color: #0c79639c; text-decoration: none; }
		</style> <?php
		while (false !== ($nombre_fichero = readdir($gestor_dir))) { 
			if($nombre_fichero!="." && $nombre_fichero!=".."){ ?>
			<?php $sqlSearhFolios = "SELECT * FROM mod_capacitacion WHERE RUTA_PDF='".$directorio."/".$nombre_fichero."'"; $stmtTable = $db->select($sqlSearhFolios); ?>
			<div class="col-sm-3">
				<div class="file-box producto">
					<div class="file producto-thumbnail">
						<a href="#">
							<span class="corner"></span>
							<div class="icon">
								<i class="fa fa-file-pdf-o"></i>
							</div>
							<div class="file-name">
								<?php echo substr($stmtTable[0]['NOMBRE_RA'],0,20); if(strlen($stmtTable[0]['NOMBRE_RA'])>20){echo '...pdf';}else{echo '.pdf';} ?>
								<br/>
								<small><?php echo substr($stmtTable[0]['ENTREGA'],0,4); if(strlen($stmtTable[0]['ENTREGA'])>4){echo '..';} ?> / Fecha: <?php echo date('d-M-Y',strtotime($stmtTable[0]['FECHA_REGISTRO'])); ?></small>
							</div>
						</a>
						<div class="producto-overlay">
							<a class="producto-overlay-link" href="<?php echo $directorio.'/'.$nombre_fichero;?>" download><i class="fa fa-download"></i></a>	
						</div>
					</div>
				</div>                                          
			</div> <?php }
			
		}  
		exit;
	}
	
	// Seacrh Costo del Curso //
	public function searchCostoCourse($POST){
		
		$db = new DbCnnx();
		
		@$valCourseSelect=$POST;		
				
			$sqlSearchCosto = "SELECT COSTO FROM cursos WHERE NAME='$valCourseSelect';";
			$stmtTable = $db->select($sqlSearchCosto);
			
			?>
			<script>
				$('#txtCostoCurso').val(<?=$stmtTable[0]['COSTO'];?>);
			</script> <?php
		// var_dump($stmtTable[0]['COSTO']);
		unset($_SESSION['page']);
		exit;
		
    }
	
	//Update Evidencia de pago
	public function uploadImgEvidence($sendEvidenceFolio,$urlEvidencia,$sendImgUploadEvi){
		$db = new DbCnnx();
			$sqlSearchVerify = "SELECT URL_EVIDENCIA_PAGO FROM mod_pago WHERE NO_FOLIO='$sendEvidenceFolio';";
			$stmtTable = $db->select($sqlSearchVerify);
		$SQL_updateEvidence = "UPDATE mod_pago SET URL_EVIDENCIA_PAGO='$urlEvidencia' WHERE ID_PAGO='$sendEvidenceFolio'";
		$rec = $db->query($SQL_updateEvidence);	
		if($sendImgUploadEvi=='' and $stmtTable[0]['URL_EVIDENCIA_PAGO']==''){
		$QueryInsertValidAdm = "INSERT INTO valid_modulo VALUE('$sendEvidenceFolio','".@$_COOKIE['id']."','40013','OLGA LIDIA MORENO HERNANDEZ','ADMINISTRACION','','','Validar Evidencia Pago $sendEvidenceFolio','','false','')"; 
		$recReturnId = $db->query($QueryInsertValidAdm); }
	}
	
	public function loadSelectCourse(){
		$db = new DbCnnx();
		$sqlListCursos = "SELECT ID_CURSO,NAME FROM cursos";
		$stmtTable = $db->combo($sqlListCursos);
		
		return $stmtTable;
	}
	// Lista de Instructores ///
	public function loadSelectInstruct(){
		$db = new DbCnnx();
		$sqlListInstruc = "SELECT ID_USER,CONCAT(NOMBRE_U,' ',APP_PATERNO_U,' ',APP_MATERNO_U) AS NAME FROM usuarios WHERE TIPO_USUARIO='INSTRUCTOR'";
		$stmtTable = $db->combo($sqlListInstruc);
		
		return $stmtTable;
	}
	
	// Lista de Cursos ///
	
	public function loadCursos(){
		$db = new DbCnnx();
		$sqlListCursos = "SELECT * FROM cursos ORDER BY TYPE DESC";
		$stmtTable = $db->combo($sqlListCursos);
		
		return $stmtTable;
	}
	
	// Guarda Nueva Curso //
	public function saveNewCourse($POST){
		
		$db = new DbCnnx();
		
		@$creadId=$POST["creadId"];
		@$sendNameCurso=$POST["sendNameCurso"];
        @$sendInstruc=$POST["sendInstruc"];
		@$sendfechaCourse=$POST["sendfechaCourse"];
		@$sendDuration=$POST["sendDuration"];
		@$sendDescription=$POST["sendDescription"];
		@$sendTypeCourse=$POST["sendTypeCourse"];
		@$sendCosto=$POST["sendCosto"];
		@$sendAreaTematica=$POST["sendAreaTematica"];
		@$sendMaterialUtility=$POST["sendMaterialUtility"];	
			
		if($POST['sendRutaImg']!=''){ @$rutaImgCurso=$POST["sendRutaImg"]; }else{ $rutaImgCurso="../../web/images/defaultCourse.png"; }
			
				
			$SQL_InsertCurso = "INSERT INTO cursos(ID_CURSO,FECHA_REGISTRO,FECHA_CAP,NAME,DESCRIPTION,TYPE,COSTO,DURACION,AREA_TEMATICA,INSTRUCTOR,RUTA_IMG,RUTA_CARTADESCRIP,MATERIAL_UTILITY,STATUS)
								VALUES ('$creadId',NOW(),'$sendfechaCourse','$sendNameCurso','$sendDescription','$sendTypeCourse','$sendCosto','$sendDuration','$sendAreaTematica','$sendInstruc','$rutaImgCurso','RUTA_CARTADESCRIP','$sendMaterialUtility','Activo') ON DUPLICATE KEY UPDATE
										FECHA_CAP=('$sendfechaCourse'),NAME=('$sendNameCurso'),DESCRIPTION=('$sendDescription'),TYPE=('$sendTypeCourse'),COSTO=('$sendCosto'),DURACION=('$sendDuration'),AREA_TEMATICA=('$sendAreaTematica'),INSTRUCTOR=('$sendInstruc'),
										RUTA_IMG=('$rutaImgCurso'),MATERIAL_UTILITY=('$sendMaterialUtility')";
			$rec = $db->query($SQL_InsertCurso);

			if($rec==1){ echo '1#'; }
		
    }
	
	/* VALID CAPACITACION.PHP */
	
	public function listPendientesValidPagoAlum($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];		
		// $sqlListValid = "SELECT v.*,ot.RUTA_PDF,ot.FECHA_REGISTRO,ot.CLIENTE_VALID FROM valid_modulo AS v,ordent_ext AS ot WHERE v.NOMBRE_USER='$sessionNomUser' AND v.ID_VALID=ot.NO_FOLIO AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_VALIDACION";
		$sqlListValid = "SELECT v.*,pg.URL_EVIDENCIA_PAGO,pg.FECHA_REGISTRO,pg.VALID_PAGO,pg.FULL_NAME,pg.EMAIL,pg.CURP,pg.TYPE_PAGO,pg.TOTAL,coti.NEW_FOLIO,coti.PDF_COTIZACION FROM valid_modulo AS v, mod_pago AS pg, mod_cotizacion AS coti WHERE v.NOMBRE_USER='$sessionNomUser' AND v.ID_VALID = coti.NO_FOLIO AND v.ID_VALID = pg.ID_PAGO COLLATE utf8_unicode_ci AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_REGISTRO DESC";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}
	
	//FUNCION PARA VALIDAR CURSO DE PARTE DEL OLGA
	
	public function updateValidPagoCurso($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$FolioValid=$POST["FolioValid"];        
        @$IdClientValid=$POST["IdClientValid"];
        @$TypeUser=$POST["TypeUser"];  
		@$dirTypeCP=$POST["dirTypeCP"];  		
			
		$SqlUpdateValid_Modulo = "UPDATE valid_modulo SET FECHA_VALIDACION=NOW(), VALID='true' WHERE ID_VALID='$FolioValid' AND TYPE_USER='$TypeUser'";	$rec = $db->query($SqlUpdateValid_Modulo);					
		if($dirTypeCP=='Inscripcion'){$SqlUpdateMod_Pago = "UPDATE mod_pago SET FECHA_PAGO=NOW(), VALID_PAGO='true' WHERE NO_FOLIO='$FolioValid'"; $rec = $db->query($SqlUpdateMod_Pago);}				
		$SqlUpdateMod_Capacitacion = "UPDATE mod_capacitacion SET PAGO_VALID='true' WHERE NO_FOLIO='$FolioValid'";	$rec = $db->query($SqlUpdateMod_Capacitacion);
		echo true;
    }
	
	public function listPendientesConstancias(){
		$db = new DbCnnx();
		$sqlListConstan = "SELECT cp.*,pay.*,coti.LUGAR FROM mod_capacitacion AS cp, mod_pago AS pay, mod_cotizacion AS coti WHERE cp.NO_FOLIO=pay.NO_FOLIO AND pay.VALID_PAGO='true' AND coti.ID_COTIZACION=cp.NO_FOLIO GROUP BY cp.NO_FOLIO ORDER BY cp.FECHA_REGISTRO desc";
		$stmtTable = $db->combo($sqlListConstan);
		
		return $stmtTable;
	}
	
	public function listAsistencia($array){
		$db = new DbCnnx();
		$sqlListAsistencias = "SELECT * FROM mod_capacitacion WHERE NO_FOLIO='".$array['attrFolio']."' AND TIPO_REGISTRO='Registro' AND NOMBRE_RA <> '' ORDER BY CAST(ID_OBJETO AS SIGNED)";
		$stmtTable = $db->combo($sqlListAsistencias);
		$count=1;
		while($row = $stmtTable->fetch_assoc()) { ?>																								
			<tr class="unread">
				<td class="check-mail">
					<input type="checkbox" name="checkAsis[]" value="<?php echo $row['ID_CAPACITACION'];?>" class="i-checks" <?php if(@$row['ASISTENCIA']=='true'){ echo "checked";}?>>
				</td>
				<td class=""><small><?php echo $row['NOMBRE_RA'];?></small></td>
				<td class=""><small><?php echo $row['EMPRESA_RA'];?></small></td>
				<td class=""><small><?php echo $row['CURSO_RA'];?></small></td>
				<td class=""><input id="toggle-<?php echo $count; ?>" value="<?php echo $row['ID_CAPACITACION'];?>" class="toggle-event" <?php if(@$row['ENTREGA']=='DC3'){ echo "checked";}?> type="checkbox">
								<script>
								  $(function() {
									$('#toggle-<?php echo $count; ?>').bootstrapToggle({
									  on: 'DC3',
									  off: 'CONSTANCIA'
									});
								  })
								</script></td> </tr>
		<?php $count ++; }
		?> <script>
				$('.i-checks').on('ifChanged', function(event){
					var getCheckAsis = event.target.value; var sendDatos='';
					if($(this).is(":checked")){ sendDatos =  {action:'CheckAsistencia', getCheckAsis:getCheckAsis, setAsistencia:'true'}; }else{ sendDatos =  {action:'CheckAsistencia', getCheckAsis:getCheckAsis, setAsistencia:'false'}; }
					$.ajax({
						type: "POST",
						url: "showConstancias.php",
						data: sendDatos,
						success: function(exito){}
					});
				});
			</script>
			<script>
			  $(function() {
				$('.toggle-event').change(function() {
					var getCheckDocument = $(this).val(); var sendDatos2='';
					if($(this).is(":checked")){ sendDatos2 =  {action:'CheckDocument', getCheckDocument:getCheckDocument, setTypeDocument:'DC3'}; }else{ sendDatos2 =  {action:'CheckDocument', getCheckDocument:getCheckDocument, setTypeDocument:'CONSTANCIA'}; }
					$.ajax({
						type: "POST",
						url: "showConstancias.php",
						data: sendDatos2,
						success: function(exito){}
					});
				})
			  })
			</script><?php
	}
	
	public function CheckAsistencia($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$getCheckAsis=$POST["getCheckAsis"];               
        @$setAsistencia=$POST["setAsistencia"];               
			
		$SqlUpdateMod_Capacita = "UPDATE mod_capacitacion SET ASISTENCIA='$setAsistencia' WHERE ID_CAPACITACION='$getCheckAsis'";					
		$rec = $db->query($SqlUpdateMod_Capacita);	
		
		echo $SqlUpdateMod_Capacita;
    }
	
	public function CheckDocument($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();

        @$getCheckDocument=$POST["getCheckDocument"];               
        @$setTypeDocument=$POST["setTypeDocument"];               
			
		$SqlUpdateMod_Capacita = "UPDATE mod_capacitacion SET ENTREGA='$setTypeDocument' WHERE ID_CAPACITACION='$getCheckDocument'";					
		$rec = $db->query($SqlUpdateMod_Capacita);	
		
		echo $SqlUpdateMod_Capacita;
    }
	
	//Update Evidencia de Lista de Alumnos
	public function uploadImgEvidenceListAlumn($sendEvidenceFolio,$urlEvidencia,$sendImgUploadEvi){
		$db = new DbCnnx();
			// $sqlSearchVerify = "SELECT URL_EVIDENCIA_PAGO FROM mod_pago WHERE NO_FOLIO='$sendEvidenceFolio';";
			// $stmtTable = $db->select($sqlSearchVerify);
		$SQL_updateEvidence = "UPDATE mod_capacitacion SET RUTA_EVIDEN_ASISTEN='$urlEvidencia' WHERE NO_FOLIO='$sendEvidenceFolio'";
		$rec = $db->query($SQL_updateEvidence);	
	}
	
	//Searh Datos del Curso
	public function SearchDatosCurso($POST){
		$db = new DbCnnx();
		@$attrFolio=$POST['attrFolio'];
		@$attrNameCurso=$POST['attrNameCurso'];
		$sqlSearhCurso = "SELECT * FROM cursos WHERE NAME='$attrNameCurso'";
		$stmtTable = $db->select($sqlSearhCurso);
		
		if($stmtTable[0]['ID_CURSO']!=''){	$sqlSearhDatosEdit = "SELECT PUESTO_TRA,RAZON_SOCIAL_EMP,SHCP_EMP,AGENT_CAPACITA,REPRESENT_LEGAL,REPRESENT_TRABA,NAME_INSTRUCTOR,OCUPACION_ESPECI from mod_capacitacion WHERE NO_FOLIO='$attrFolio' GROUP BY NO_FOLIO";
											$stmtTableModCap = $db->select($sqlSearhDatosEdit); $stmtTable=array_merge($stmtTable[0],$stmtTableModCap[0]); $stmtTable=array("0" => $stmtTable); }
		
		echo json_encode($stmtTable); exit;
	}
	
	//Genera Constancias/DC3
	public function GenerateConstancias($POST){
		include '../../repositorio/fpdf/PhpExtras/barcode.php';
		$db = new DbCnnx();
		$getTypeCurso=$POST['sendTypeCurso']; 
		
		barcode('../../web/images/FileUpload/BarCodeCapacitacion/'.$POST['sendFolio'].'.png', $POST['sendFolio'], 20, 'horizontal', 'code128', false);
		$rutaBarcode="web/images/FileUpload/BarCodeCapacitacion/".$POST['sendFolio'].".png";
		
		/*Actualizamos tabla Mod_capacitacion deacuerdo al Formulario de Constancias/Dc3 */
		$SQL_UpdateModCap = "UPDATE mod_capacitacion SET DATE_START=('".$POST['sendDateInicio']."'), DATE_END=('".$POST['sendDateFin']."'), AREA_TEMATIC=('".$POST['sendAreaTematica']."'), AGENT_CAPACITA=('".$POST['sendNameCapacitador']."'), NAME_INSTRUCTOR=('".$POST['sendNameInstructor']."'),REPRESENT_LEGAL=('".$POST['sendNamePatron']."'), REPRESENT_TRABA=('".$POST['sendRepresentante']."'), OCUPACION_ESPECI=('".$POST['sendOcupaEspeci']."'), RUTA_BARCODE=('$rutaBarcode') WHERE NO_FOLIO='".$POST['sendFolio']."' AND TIPO_REGISTRO='General'";
		$rec = $db->query($SQL_UpdateModCap);
		
		$sqlSearhFolios = "SELECT ID_CAPACITACION,NOMBRE_RA,CURSO_RA,ENTREGA,PUESTO_TRA FROM mod_capacitacion WHERE NO_FOLIO='".$POST['sendFolio']."' AND TIPO_REGISTRO='Registro' AND NOMBRE_RA <> '' AND ASISTENCIA='true'";
		$stmtTable = $db->combo($sqlSearhFolios);
		$numFormatos = $stmtTable->num_rows; if($numFormatos>0){$countDocument=0;}else{$countDocument=0;}
		
		$sqlSearhModCp = "SELECT cp.PUESTO_TRA,cp.RAZON_SOCIAL_EMP,cp.SHCP_EMP,cp.NAME_CURSO,cp.DATE_START,cp.DATE_END,cp.AREA_TEMATIC,cp.AGENT_CAPACITA,cp.NAME_INSTRUCTOR,cp.REPRESENT_LEGAL,cp.REPRESENT_TRABA,mdi.NUM_DC5,mdi.NUM_PC,mdi.RUTA_FIRMA FROM mod_capacitacion AS cp, mod_instructor AS mdi WHERE cp.NO_FOLIO='".$POST['sendFolio']."' AND cp.TIPO_REGISTRO='General' AND cp.NAME_INSTRUCTOR=mdi.NOMBRE";
		$stmtTableModCap = $db->select($sqlSearhModCp);
		
		$arrayConstan=array("getNoFolio"=>$POST['sendFolio'], "sendNameCurso"=>$stmtTableModCap[0]['NAME_CURSO'], "durationCourse"=>$POST['durationCourse'], "sendNameInstructor"=>$stmtTableModCap[0]['NAME_INSTRUCTOR'], "sendNUM_DC5"=>$stmtTableModCap[0]['NUM_DC5'], "sendNUM_PC"=>$stmtTableModCap[0]['NUM_PC'], "sendRUTA_FIRMA"=>$stmtTableModCap[0]['RUTA_FIRMA']);
		$arrayDC3=array("getNoFolio"=>$POST['sendFolio'], "sendNameCurso"=>$stmtTableModCap[0]['NAME_CURSO'], "durationCourse"=>$POST['durationCourse'], "sendNameInstructor"=>$stmtTableModCap[0]['NAME_INSTRUCTOR'], "sendRazonSocial"=>$stmtTableModCap[0]['RAZON_SOCIAL_EMP'], "SHCP"=>$stmtTableModCap[0]['SHCP_EMP'], "sendDateInicio"=>$stmtTableModCap[0]['DATE_START'], "sendDateFin"=>$stmtTableModCap[0]['DATE_END'], "sendOcupaEspeci"=>$POST['sendOcupaEspeci'], "sendAreaTematica"=>$stmtTableModCap[0]['AREA_TEMATIC'], "puesto"=>$stmtTableModCap[0]['PUESTO_TRA'], "sendNameCapacitador"=>$stmtTableModCap[0]['AGENT_CAPACITA'], "sendNamePatron"=>$stmtTableModCap[0]['REPRESENT_LEGAL'], "sendRepresentante"=>$stmtTableModCap[0]['REPRESENT_TRABA'], "sendRUTA_FIRMA"=>$stmtTableModCap[0]['RUTA_FIRMA']);
		
		 while($row = $stmtTable->fetch_assoc()){

			$RutaFpdfFormat = "../../web/UploadPdf/PdfCapacitacion/FormatosCursos/".$_SESSION['sesionSucur']."/".$POST['sendFolio']."/".$row['ID_CAPACITACION'].".pdf";
			if($row['ENTREGA']=='DC3'){ $this->GenerateFormatDC3Pdf($arrayDC3,$row['ID_CAPACITACION'],$row['NOMBRE_RA'],$row['CURSO_RA'],$row['PUESTO_TRA']); }else{ $this->GenerateConstanciaPdf($arrayConstan,$row['ID_CAPACITACION'],$row['NOMBRE_RA'],$row['CURSO_RA']); }

			$SQL_updateRutaFpdfFormat = "UPDATE mod_capacitacion SET RUTA_PDF='$RutaFpdfFormat' WHERE ID_CAPACITACION='".$row['ID_CAPACITACION']."'"; $rec = $db->query($SQL_updateRutaFpdfFormat);
			$countDocument++;
		 }
		
		$SQL_updateRutaFpdfFormatTrue = "UPDATE mod_capacitacion SET RUTA_PDF='true' WHERE NO_FOLIO='".$POST['sendFolio']."' AND TIPO_REGISTRO='General'"; $rec = $db->query($SQL_updateRutaFpdfFormatTrue);
		// echo $SQL_updateRutaFpdfFormatTrue;
		
		if(file_exists($rutaBarcode)){ sleep(3); }else if(file_exists($rutaBarcode)){ sleep(3); }else if(file_exists($rutaBarcode)){ sleep(3); }
		
		echo "<script>$('#RequestMsg').html('<span style=\"color: #a94442;font-size: 25px;\">Número de Constancias/DC3 Generadas: ".$countDocument." de ".$numFormatos."</span>'); $('#btnCloseConstan').removeClass('hidden'); $('#btnSaveConstan').addClass('hidden'); $('.modal-body').toggleClass('sk-loading'); </script>"; 
		// var_dump($stmtTable->num_rows); 
		exit;
	}
	
	//Genera Plantilla DC3 en Pdf
	public function GenerateFormatDC3Pdf($arrayDC3,$getIdCapacita,$nombreAlumn,$curpAlumn,$puestoAlumn){
		$sendNamePatron = mb_strtoupper(@$arrayDC3['sendNamePatron'], 'UTF-8');
		$sendRepresentante = mb_strtoupper(@$arrayDC3['sendRepresentante'], 'UTF-8');
		if(strlen(@$arrayDC3['SHCP'])>12){ $sendNamePatron = strtoupper(utf8_decode($nombreAlumn)); $sendRepresentante=""; }
		
		$db = new DbCnnx();
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		require_once '../../repositorio/fpdf/fpdf.php';
		require_once '../../repositorio/fpdf/fpdi.php';
		
		@$sucursal=$_SESSION['sesionSucur'];
		
		$pdf = new FPDI();
		$pageCount = $pdf->setSourceFile("../../repositorio/fpdf/pdfCapacitacion/DCtres.pdf");
		$tplIdx = $pdf->importPage(1);
		$pdf->addPage();
		$pdf->useTemplate($tplIdx, 10, 10, 200);

		$pdf->SetFont('Arial');
		$pdf->SetFontSize(8);
		$pdf->SetFillColor(255,255,255);

		$pdf->setTextColor(10, 2, 1);
		$pdf->SetXY(17, 67);
		$pdf->Cell(120,3,"".ucwords(strtolower(utf8_decode($nombreAlumn)))."",0,1,'L', true);//NOMBRE Y APELLIDOS

		$pdf->setTextColor(255, 0, 0);
		$pdf->SetXY(160, 66);
		$pdf->Cell(33,3,"".@$arrayDC3['getNoFolio']."",0,1,'L', true); //No. Folio
		
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(17, 76.92, 86, 5.1, 'F');
		$pdf->SetFontSize(9);
			
		$pdf->setTextColor(10, 2, 1);
		$pdf->SetXY(17.9,78);
		$pdf->Cell(4.5,4,substr(chunk_split(@$curpAlumn, 1,  ' | '), 0, -1) ,0,1,'l', true);//	CURP
		
		$pdf->SetXY(109, 78);
		$pdf->Cell(27,3,"".@$arrayDC3['sendOcupaEspeci']."",0,1,'L', true);// OCUPACION ESPECIFICA

		$pdf->SetXY(17, 87);
		$pdf->Cell(180,3,"".utf8_decode(@$puestoAlumn)."",0,1,'L', true);//PUESTO

		$pdf->SetXY(17, 105);
		$pdf->Cell(180,3,"".@$arrayDC3['sendRazonSocial']."",0,1,'L', true);//NOMBRE O RAZON SOCIAL
		
		$pdf->SetFillColor(255,255,255);
		$pdf->Rect(18, 113.7, 84.5, 5.1, 'F');
		$pdf->SetXY(17, 114.5);
		$pdf->Cell(10,4,substr(chunk_split(@$arrayDC3['SHCP'], 1,  ' | '), 0, -2) ,0,1,'l', true);// REGISTRO FEDERAL DE CONTRIBUYENTES
		
		$pdf->SetFontSize(9);
		$pdf->SetXY(17, 132);
		$pdf->Cell(180,3,"".utf8_decode(@$arrayDC3['sendNameCurso'])."",0,1,'L', true);//NOMBRE DEL CURSO

		$pdf->SetXY(18, 140);
		$pdf->Cell(20,3,"".@$arrayDC3['durationCourse']."",0,1,'C', true);//DURACION DE HORAS
		$pdf->SetFontSize(10);
		$pdf->SetXY(93, 139.1);
		$pdf->Cell(18,4.5,"".substr(chunk_split(date("Y", strtotime(@$arrayDC3['sendDateInicio'])), 1,  ' | '), 0, -2)."",0,1,'C', true);//Año Inicio
		$pdf->SetXY(113.7, 139.1);
		$pdf->Cell(10,4.5,"".substr(chunk_split(date("m", strtotime(@$arrayDC3['sendDateInicio'])), 1,  ' | '), 0, -2)."",0,1,'C', true);//Mes Inicio
		$pdf->SetXY(127.8, 139.1);
		$pdf->Cell(10,4.5,"".substr(chunk_split(date("d", strtotime(@$arrayDC3['sendDateInicio'])), 1,  ' | '), 0, -2)."",0,1,'C', true);//dia Inicio
		$pdf->SetXY(150.8, 139.1);
		$pdf->Cell(18,4.5,"".substr(chunk_split(date("Y", strtotime(@$arrayDC3['sendDateFin'])), 1,  ' | '), 0, -2)."",0,1,'C', true);//Año Fin
		$pdf->SetXY(174, 139.1);
		$pdf->Cell(10,4.5,"".substr(chunk_split(date("m", strtotime(@$arrayDC3['sendDateFin'])), 1,  ' | '), 0, -2)."",0,1,'C', true);//Mes Fin
		$pdf->SetXY(188, 139.1);
		$pdf->Cell(10,4.5,"".substr(chunk_split(date("d", strtotime(@$arrayDC3['sendDateFin'])), 1,  ' | '), 0, -2)."",0,1,'C', true);//dia Fin
		$pdf->SetFontSize(9);
		
		$pdf->SetXY(18, 148);
		$pdf->Cell(180,3,"".ucwords(strtolower(utf8_decode(@$arrayDC3['sendAreaTematica'])))."",0,1,'L', true);// AREA TEMATICA DEL CURSO

		$pdf->SetXY(18, 156);
		$pdf->Cell(180,3,"".ucwords(strtolower(utf8_decode(@$arrayDC3['sendNameCapacitador'])))."",0,1,'L', true);//NOMBRE  DEL AGENTE CAPACITADOR
		
		$pdf->SetFontSize(6);
		$pdf->SetXY(29, 184);
		$pdf->Cell(45,2,"".mb_strtoupper(@$arrayDC3['sendNameInstructor'], 'UTF-8')."",0,1,'C', true);// 
		$pdf->Image("../../".@$arrayDC3['sendRUTA_FIRMA']."",25,157,50,50);
		$pdf->SetXY(81.7, 184);
		$pdf->Cell(45,2,"$sendNamePatron",0,1,'C', true);//
		$pdf->SetXY(137, 184);
		$pdf->Cell(45,2,"$sendRepresentante",0,1,'C', true);// 

		$nombre_fichero = "../../web/UploadPdf/PdfCapacitacion/FormatosCursos/$sucursal/".@$arrayDC3['getNoFolio']."/";

		if(file_exists($nombre_fichero)) {
			$pdf->Output('F',"../../web/UploadPdf/PdfCapacitacion/FormatosCursos/$sucursal/".@$arrayDC3['getNoFolio']."/$getIdCapacita.pdf",'UTF-8 (true)');
		}else {
			mkdir($nombre_fichero, 0777, true);
			$pdf->Output('F',"../../web/UploadPdf/PdfCapacitacion/FormatosCursos/$sucursal/".@$arrayDC3['getNoFolio']."/$getIdCapacita.pdf",'UTF-8 (true)');
		}
		
	}

	//Genera Plantilla CONSTANCIA en Pdf
	public function GenerateConstanciaPdf($arrayConstan,$getIdCapacita,$nombreAlumn,$curpAlumn){

		$db = new DbCnnx();
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		require_once '../../repositorio/fpdf/fpdf.php';
		require_once '../../repositorio/fpdf/fpdi.php';
		
		@$sucursal=$_SESSION['sesionSucur'];
		
		$pdf = new FPDI('L');
		$pageCount = $pdf->setSourceFile("../../repositorio/fpdf/pdfCapacitacion/FormatoConstancias.pdf");
		$tplIdx = $pdf->importPage(1);
		$pdf->addPage();
		$pdf->useTemplate($tplIdx,9, -2.5);

		$pdf->SetFont('times','I');
		$pdf->SetFontSize(24);
		$pdf->SetFillColor(255,255,255);

		$pdf->SetXY(23.5, 89);
		$pdf->Cell(250,10,"".ucwords(strtolower(utf8_decode($nombreAlumn)))."",0,1,'C', true); 

		$pdf->SetXY(23.5, 115);
		$pdf->Cell(250,10,"".ucwords(strtolower(utf8_decode(@$arrayConstan['sendNameCurso'])))."",0,1,'C', true); 
		
		$pdf->SetFont('Arial');
		$pdf->SetFontSize(10);
		$pdf->SetFillColor(255,255,255);

		$pdf->SetXY(204, 18);
		$pdf->Cell(60,4,"".ucwords(strtolower($_SESSION['sesionSucur']))." a ".date("d")." de ".date("F")." del ".date("Y")."",0,1,'C', true);
		
		$pdf->SetXY(204, 52);
		$pdf->Cell(62,4,"No. Folio  ".@$arrayConstan['getNoFolio']."",0,1,'C', true);
		
		$pdf->SetXY(189, 180);
		$pdf->Cell(85,4,"".mb_strtoupper(@$arrayConstan['sendNUM_PC'], 'UTF-8')."",0,1,'C', true);
		$pdf->SetFontSize(9);
		$pdf->SetXY(134.5, 160.4);
		$pdf->Cell(50,4,"".ucwords(strtolower(utf8_decode(@$arrayConstan['sendNameInstructor'])))."",0,1,'L', true); 
		
		$pdf->SetFontSize(10);
		$pdf->SetXY(127, 165.5);
		$pdf->Cell(50,4,"".mb_strtoupper(@$arrayConstan['sendNUM_DC5'], 'UTF-8')."",0,1,'L', true); 
		// $pdf->SetXY(135.5, 172);
		$pdf->Image('../../web/images/FileUpload/BarCodeCapacitacion/'.@$arrayConstan['getNoFolio'].'.png',133,174,26,10,'png');
		$pdf->Image("../../".@$arrayConstan['sendRUTA_FIRMA']."",110,110,70,70);
		$pdf->SetFontSize(9);
		$pdf->SetXY(121.8, 185.4);
		$pdf->Cell(60,4, "No Folio:  ".@$arrayConstan['getNoFolio']."",0,1,'C', true);

		
		$nombre_fichero = "../../web/UploadPdf/PdfCapacitacion/FormatosCursos/$sucursal/".@$arrayConstan['getNoFolio']."/";

		if(file_exists($nombre_fichero)) {
			$pdf->Output('F',"../../web/UploadPdf/PdfCapacitacion/FormatosCursos/$sucursal/".@$arrayConstan['getNoFolio']."/$getIdCapacita.pdf",'UTF-8 (true)');
		}else {
			mkdir($nombre_fichero, 0777, true);
			$pdf->Output('F',"../../web/UploadPdf/PdfCapacitacion/FormatosCursos/$sucursal/".@$arrayConstan['getNoFolio']."/$getIdCapacita.pdf",'UTF-8 (true)');
		}
		
	}
	
	//ShowConstancias/DC3
	public function ShowConstancias($POST){
		$db = new DbCnnx();
		$getFolio=$POST['sendFolio'];
		$directorio = "../../web/UploadPdf/PdfCapacitacion/FormatosCursos/TOLUCA/$getFolio";
		$gestor_dir = opendir($directorio);
		while (false !== ($nombre_fichero = readdir($gestor_dir))) { 
			if($nombre_fichero!="." && $nombre_fichero!=".."){ ?>
			<?php $nameExplode = explode(".", $nombre_fichero); $sqlSearhFolios = "SELECT * FROM mod_capacitacion WHERE ID_CAPACITACION='".$nameExplode[0]."'"; $stmtTable = $db->select($sqlSearhFolios); ?>
			<div class="col-sm-3">
				<div class="file-box product">
					<div class="file product-thumbnail">
						<a href="#">
							<span class="corner"></span>
							<div class="icon">
								<i class="fa fa-file-pdf-o"></i>
							</div>
							<div class="file-name">
								<?php echo substr($stmtTable[0]['NOMBRE_RA'],0,20); if(strlen($stmtTable[0]['NOMBRE_RA'])>20){echo '...pdf';}else{echo '.pdf';} ?>
								<br/>
								<small><?php echo substr($stmtTable[0]['ENTREGA'],0,4); if(strlen($stmtTable[0]['ENTREGA'])>4){echo '..';} ?> / Fecha: <?php echo date('d-M-Y',strtotime($stmtTable[0]['FECHA_REGISTRO'])); ?></small>
							</div>
						</a>
						<div class="product-overlay">
							<a class="product-overlay-link" href="<?php echo $directorio.'/'.$nombre_fichero;?>" download><i class="fa fa-download"></i></a>	
						</div>
					</div>
				</div>                                          
			</div> <?php }
			
		}  
		exit;
	}
	
	//Asignación de Costo sobre un curso y Generación del Formato de Cotización
	public function GenerateFormatCotiza($POST){

		$db = new DbCnnx();
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		setlocale(LC_TIME, 'es_MX');
		require_once '../../repositorio/fpdf/fpdf.php';
		require_once '../../repositorio/fpdf/fpdi.php';
		
		@$sucursal=$_SESSION['sesionSucur'];
		$nombre_fichero = "../../web/UploadPdf/PdfCapacitacion/FormatosCotizacion/$sucursal/";
		$rutaCompleta = "../../web/UploadPdf/PdfCapacitacion/FormatosCotizacion/$sucursal/".@$POST['sendFolio'].".pdf";
		
		$SQL_updateMod_cotizacion = "UPDATE mod_cotizacion SET PDF_COTIZACION = '".substr($rutaCompleta,6)."', FECHA_COTIZACION = '".@$POST['txtfecha']."', CP = '".@$POST['sendCP']."', VIGENCIA_COTIZACION = '".strtoupper(@$POST['sendVigencia'])."', NOTA = '".strtoupper(@$POST['sendNota'])."', CONTACTO = '".strtoupper(@$POST['nameContacto'])."', NOMBRE_RAZONSOCI = '".strtoupper(@$POST['nameRazonSocial'])."', TOTAL = '".@$POST['sendTotal']."', NEW_FOLIO = '".@$POST['sendFolio']."' WHERE ID_COTIZACION = '".@$POST['sendOldFolio']."'";
		$rec = $db->query($SQL_updateMod_cotizacion);
		
		$SQL_updateMod_pago = "UPDATE mod_pago SET FULL_NAME = '".strtoupper(@$POST['nameContacto'])."', EMAIL = '".strtoupper(@$POST['sendCorreo'])."', CANTIDAD = '".strtoupper(@$POST['sendCantidad'])."', CONCEPTO = '".strtoupper(@$POST['sendConcepto'])."', PRECIO_UNIT = '".strtoupper(@$POST['sendPrecioUnit'])."', IMPORTE = '".strtoupper(@$POST['sendImporte'])."', SUBTOTAL = '".strtoupper(@$POST['sendSubTotal'])."', IVA = '".strtoupper(@$POST['sendIVA'])."', TOTAL = '".strtoupper(@$POST['sendTotal'])."', CANTIDAD_LETRA = '".strtoupper(@$POST['sendCantLetra'])."' WHERE ID_PAGO = '".@$POST['sendOldFolio']."'";
		$rec = $db->query($SQL_updateMod_pago);	
		
		$pdf = new FPDI();
		$pageCount = $pdf->setSourceFile("../../repositorio/fpdf/pdfCapacitacion/cotizacion.pdf");
		$tplIdx = $pdf->importPage(1);
		$pdf->addPage();
		$pdf->useTemplate($tplIdx, 10, 10, 200);

		$pdf->SetFont('Arial','B');
		$pdf->SetFontSize(10);
		$pdf->SetFillColor(255,255,255);
		
		$pdf->setTextColor(10, 2, 1);
		$pdf->SetXY(167.5, 49);
		$pdf->Cell(31,5,"".strtoupper(@$POST['sendFolio'])."",0,1,'C', true); 
		$pdf->SetFont('Arial');
		$pdf->SetFontSize(8);
		$pdf->setTextColor(10, 2, 1);
		$pdf->SetXY(168, 55);
		$pdf->Cell(30,5,"".utf8_decode('CAPACITACIÓN')."",0,1,'C', true); 
		
		$pdf->SetFontSize(9);
		$pdf->SetXY(109, 73.1);
		$pdf->Cell(7,4,"".date('j')."",0,1,'C', true); 

		$pdf->SetXY(141, 73.1);
		$pdf->Cell(20,4,"".strtoupper(date('F'))."",0,1,'C', true); 

		$pdf->SetXY(180, 73.1);
		$pdf->Cell(15,4,"".date('Y')."",0,1,'C', true);
		
		$pdf->SetFont('Arial');
		$pdf->SetFontSize(8);
		$pdf->SetXY(48, 79.3);
		$pdf->Cell(125,2,"".strtoupper(utf8_decode(@$POST['nameRazonSocial']))."",0,1,'L', true); 

		$pdf->SetXY(48, 83.8);
		$pdf->Cell(125,2,"".strtoupper(utf8_decode(@$POST['nameContacto']))."",0,1,'L', true); 


		$pdf->SetXY(48, 88.7);
		$pdf->Cell(125,2,"".utf8_decode(@$POST['sendCorreo'])."",0,1,'L', true);

		$pdf->SetXY(48, 97.8);
		$pdf->Cell(107,2,"".utf8_decode(@$POST['sendTel'])."",0,1,'L', true);

		$pdf->SetXY(178, 97.6);
		$pdf->Cell(17,2,"".@$POST['sendCP']."",0,1,'L', true);
		
		/***************************tabla****************************/
		$cont=1;
		$y=119;
		for($i=1; $i<=$cont; $i++){
			$pdf->SetFillColor(255,255,255); 
			$pdf->SetLineWidth(0);	

			$pdf->SetXY(21, $y);
			$pdf->Cell(24,6.8,"".@$POST['sendCantidad']."",0,1,'C', true);
			$Concepto = strtoupper(utf8_decode(@$POST['sendConcepto']));
			$pdf->SetXY(47, $y+1);
			$pdf->Cell(83,4,"".substr($Concepto,0,48)."",0,1,'L', true); 
			if(strlen($Concepto)>48){
				$pdf->SetXY(47, $y+5.5);
				$pdf->Cell(83,4,"".substr($Concepto,48,48)."",0,1,'L', true);  }
			if(strlen($Concepto)>96){
				$pdf->SetXY(47, $y+10);
				$pdf->Cell(83,4,"".substr($Concepto,96)."",0,1,'L', true); }

			$pdf->SetXY(132.5,$y);
			$pdf->Cell(31.5,6.8,"$ ".@$POST['sendPrecioUnit']."",0,1,'C', true);

			$pdf->SetXY(166, $y);
			$pdf->Cell(33,6.8,"$ ".@$POST['sendImporte']."",0,1,'C', true); 


			$y=$y+6.7;
		}
		
		$pdf->SetFontSize(6);
		$Nota = strtoupper(utf8_decode(@$POST['sendNota']));
		$pdf->SetXY(46, 204);
		$pdf->Cell(83,3,"NOTA: ".substr($Nota,0,60)."",0,1,'L', true); 
		if(strlen($Nota)>60){
				$pdf->SetXY(46, 208);
				$pdf->Cell(83,4,"".substr($Nota,60,66)."",0,1,'L', true);  }
		if(strlen($Nota)>126){
			$pdf->SetXY(46, 212);
			$pdf->Cell(83,4,"".substr($Nota,126)."",0,1,'L', true); }		
		
		$pdf->SetFontSize(8);
		$pdf->SetXY(96.7, 227);
		$pdf->Cell(26,3,"".strtoupper(utf8_decode(@$POST['sendVigencia']))."",0,1,'C', true); 

		$pdf->SetXY(55, 240);
		$pdf->Cell(108,4.5,"".strtoupper(utf8_decode(@$POST['sendCantLetra']))."",0,1,'L', true); 
		$pdf->SetFontSize(9);
		$pdf->SetXY(165.1, 255.9);
		$pdf->Cell(34.9,4.5,"$".@$POST['sendSubTotal']."",0,1,'C', true); 

		$pdf->SetXY(165.1, 260.8);
		$pdf->Cell(34.9,4.5,"$".@$POST['sendIVA']."",0,1,'C', true);

		$pdf->SetXY(165.1, 265.7);
		$pdf->Cell(34.9,4.5,"$".@$POST['sendTotal']."",0,1,'C', true);

		if(file_exists($nombre_fichero)) {
			$pdf->Output('F',$rutaCompleta,'UTF-8 (true)');
		}else {
			mkdir($nombre_fichero, 0777, true);
			$pdf->Output('F',$rutaCompleta,'UTF-8 (true)');
		}
		
		
	}
	
	
	///Modulo Proteccion Civil
	
		/* Guarda Nueva Constancia */
	public function saveNewConstancia($POST){
		
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
		@$noCliente=$POST["noCliente"];
        @$fecha_service=$POST["fecha_service"];
		@$typeRegistro=$POST["typeRegistro"];
		@$nameCurso=$POST["nameCurso"];
		@$nameInstruct=$POST["nameInstruct"];
		@$numDC5=mb_strtoupper($POST["numDC5"], 'UTF-8');
		@$numProteCivi=mb_strtoupper($POST["numProteCivi"], 'UTF-8');
		
		@$id_object=$POST["id_object"];
		@$nameRA=ucwords(mb_strtolower($POST["nameRA"], 'UTF-8'));
		@$folioRA=ucwords(mb_strtolower($POST["folioRA"], 'UTF-8'));
		
		@$rutaJson=$POST["rutaJson"];		       
		
				
		$createId = $noFolio.'-PC'.$id_object;
		if($noFolio == ""){
			echo "
			<script language='javascript'>
				alert('No se ha podido recibir N° Cliente');
			</script>";
		 }
		else{ 	
					
			$SQL_InsertConstan = sprintf("INSERT INTO mod_capacitacion(ID_CAPACITACION, TIPO_REGISTRO, NO_FOLIO,NO_CLIENTE, FECHA_REGISTRO, FECHA_CAPACITACION, ID_OBJETO, NOMBRE_RA, NAME_CURSO, NAME_INSTRUCTOR, AREA_ADMINISTRACION, ENTREGA, RUTA_JSON,PAGO_VALID, MODULO)
															  VALUES ('$createId', '$typeRegistro', '$noFolio',$noCliente,now(),'$fecha_service', '$id_object', '$nameRA', '$nameCurso', '$nameInstruct', 'OLGA LIDIA MORENO HERNANDEZ', 'CONSTANCIA', '$rutaJson','false', 'PROTECIVIL') ON DUPLICATE KEY UPDATE
															ID_CAPACITACION=('$createId'),TIPO_REGISTRO=('$typeRegistro'),NO_FOLIO=('$noFolio'),FECHA_CAPACITACION=('$fecha_service'),ID_OBJETO=('$id_object'),NOMBRE_RA=('$nameRA'),NAME_CURSO=('$nameCurso')");
			$rec = $db->query($SQL_InsertConstan);
			
			$sqlSearchConstan = "SELECT NO_FOLIO FROM mod_capacitacion WHERE NO_FOLIO='$noFolio'";
			$stmtTable = $db->combo($sqlSearchConstan);
			if($stmtTable->num_rows==1){
				//add Table Valid_modulo
				$QueryInsertValidAdm = "INSERT INTO valid_modulo VALUE('$noFolio','".@$_COOKIE['id']."','40013','OLGA LIDIA MORENO HERNANDEZ','ADMINISTRACION','','','Validar Constancia Proteccion C. $noFolio','','false','')"; 
				$recReturnId = $db->query($QueryInsertValidAdm);
			}

			if($rec==1){ echo '1#'; }
		}
    }
	
		/* Generar Json Lista de Alumnos Para Constancias Proteccion Civil */
	public function gererateJsonPC($POST){
		$db = new DbCnnx();
		
		@$noFolio=$POST["noFolio"];
		@$noCliente=$POST["noCliente"];
		@$CamposGrid=$POST["CamposGrid"];
		@$sucursal=$POST["sucursal"];
		@$arrayJqGrid = array_chunk($CamposGrid, 3);
		@$count = count($arrayJqGrid);
		$file='';		
		$Id=1;  
		for($i = 0; $i < $count; $i++){			
			$array[$i]= array(
				"Id" => "$Id",
				"name" => ucwords(mb_strtolower($arrayJqGrid[$i][1], 'UTF-8')),
				"folio" => $arrayJqGrid[$i][2]
			);
			$Id++;
		}
		$arr_alumnos = array(
			"rows" => $array			
		);
		
			$nombre_fichero = '../../repositorio/DataJson/DataCapacitacion/NewConstanciaPC/'.$sucursal.'';
			if (file_exists($nombre_fichero)) {
				$json_string = json_encode($arr_alumnos);
				$file = '../../repositorio/DataJson/DataCapacitacion/NewConstanciaPC/'.$sucursal.'/'.$noFolio.'.json';
				file_put_contents($file, $json_string); $rec=1;
			} else {
				mkdir($nombre_fichero, 0777, true);
				$json_string = json_encode($arr_alumnos);
				$file = '../../repositorio/DataJson/DataCapacitacion/NewConstanciaPC/'.$sucursal.'/'.$noFolio.'.json';
				file_put_contents($file, $json_string); $rec=1;
			}
			
			
			if($rec==1){ echo 'Exito Json'; }
	}
	
	public function loadListConstan(){
		$db = new DbCnnx();
		
		// $sqlListInscrp = "SELECT cp.*,cur.NAME,cur.INSTRUCTOR,cur.DESCRIPTION,cur.RUTA_IMG,pay.URL_EVIDENCIA_PAGO,pay.VALID_PAGO,pay.TYPE_PAGO,pay.VALID_COTIZACION,pay.SUBTOTAL,pay.IVA,pay.TOTAL,pay.CURP,pay.URL_FORMATO_PAGO,coti.NUM_PERSONAS,coti.PDF_COTIZACION FROM mod_capacitacion AS cp,cursos AS cur, mod_pago AS pay, mod_cotizacion AS coti WHERE NO_CLIENTE=".@$_COOKIE['id']." AND cp.NAME_CURSO=cur.NAME AND cp.NO_FOLIO=pay.ID_PAGO AND coti.NO_FOLIO=cp.NO_FOLIO GROUP BY NO_FOLIO ORDER BY ID_CAPACITACION ASC";
		$sqlListConstan = "SELECT cp.*,cur.NAME,cur.DESCRIPTION,cur.RUTA_IMG FROM mod_capacitacion AS cp, cursos AS cur WHERE NO_CLIENTE=".@$_COOKIE['id']." AND cp.NAME_CURSO=cur.NAME GROUP BY NO_FOLIO ORDER BY FECHA_REGISTRO DESC";
		$stmtTable = $db->combo($sqlListConstan);
		
		return $stmtTable;
	}
	
	/* VALID CAPACITACION.PHP  Costancias Proteccion Civil*/
	public function listPendientesValidConstanPC($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];		
		$sqlListValid = "SELECT cp.NO_FOLIO,cp.FECHA_REGISTRO,cp.ENTREGA,cp.MODULO,v.* FROM mod_capacitacion AS cp, valid_modulo AS v WHERE v.NOMBRE_USER='OLGA LIDIA MORENO HERNANDEZ' AND v.ID_VALID = cp.NO_FOLIO AND MODULO='PROTECIVIL' AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_REGISTRO DESC";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}
	
	/* GENERATECONSTAN.PHP  Editar Costancias Proteccion Civil*/
	public function editConstanPC($attrFolio){
		$db = new DbCnnx();
		$sqlEditInscrp = "SELECT FECHA_CAPACITACION,NAME_CURSO,NAME_INSTRUCTOR,NO_FOLIO,RUTA_JSON,(SELECT COUNT(*) FROM mod_capacitacion WHERE NO_FOLIO='$attrFolio' AND TIPO_REGISTRO='Registro' AND NOMBRE_RA <> '') AS COUNT FROM mod_capacitacion WHERE NO_FOLIO='$attrFolio' AND TIPO_REGISTRO='General'";
		$stmtTable = $db->select($sqlEditInscrp);
		
		return $stmtTable;
	}
	
	/* GENERATECONSTAN.PHP  Lista de Alumnos para Generar Costancias Proteccion Civil*/
	public function listALumns($array){
		$db = new DbCnnx();
		$sqlListAlumn = "SELECT *,(SELECT NAME_CURSO FROM mod_capacitacion WHERE NO_FOLIO='".$array['attrFolio']."' AND TIPO_REGISTRO='General') AS NOMBRE_CURSO FROM mod_capacitacion WHERE NO_FOLIO='".$array['attrFolio']."' AND TIPO_REGISTRO='Registro' AND NOMBRE_RA <> '' ORDER BY CAST(ID_OBJETO AS SIGNED)";
		$stmtTable = $db->combo($sqlListAlumn);
		$count=1;
		while($row = $stmtTable->fetch_assoc()) { ?>																								
			<tr class="unread">
				<td class="check-mail">
					<input type="checkbox" name="checkAsis[]" value="<?php echo $row['ID_CAPACITACION'];?>" class="i-checks" <?php if(@$row['ASISTENCIA']=='true'){ echo "checked";}?>>
				</td>
				<td class=""><small><?php echo $row['NOMBRE_RA'];?></small></td>
				<td class=""><small><?php echo ucwords(mb_strtolower($row['NOMBRE_CURSO'], 'UTF-8'));?></small></td>
				<td class="text-center"><small><?php echo ucwords(mb_strtolower($row['ENTREGA'], 'UTF-8'));?></small></td>
				<td class="text-center"><?php if($row['RUTA_PDF']!=''){ ?><a href="<?php echo $row['RUTA_PDF'];?>" download><i class="fa fa-download"></i></a> <?php } ?></td></tr>
		<?php $count ++; }
		?> <script>
				$('.i-checks').on('ifChanged', function(event){
					var getCheckAsis = event.target.value; var sendDatos='';
					if($(this).is(":checked")){ sendDatos =  {action:'CheckAsistencia', getCheckAsis:getCheckAsis, setAsistencia:'true'}; }else{ sendDatos =  {action:'CheckAsistencia', getCheckAsis:getCheckAsis, setAsistencia:'false'}; }
					$.ajax({
						type: "POST",
						url: "showConstancias.php",
						data: sendDatos,
						success: function(exito){}
					});
				});
			</script> <?php
	}
	
	//Genera Constancias Para Protección Civil
	public function GenerateConstanciasPC($POST){
		include '../../repositorio/fpdf/PhpExtras/barcode.php';
		$db = new DbCnnx();
		
		barcode('../../web/images/FileUpload/BarCodeCapacitacion/'.$POST['sendFolio'].'.png', $POST['sendFolio'], 20, 'horizontal', 'code128', false);
		$rutaBarcode="web/images/FileUpload/BarCodeCapacitacion/".$POST['sendFolio'].".png";

		$sqlSearhFolios = "SELECT ID_CAPACITACION,NOMBRE_RA,ENTREGA FROM mod_capacitacion WHERE NO_FOLIO='".$POST['sendFolio']."' AND TIPO_REGISTRO='Registro' AND NOMBRE_RA <> '' AND ASISTENCIA='true'";
		$stmtTable = $db->combo($sqlSearhFolios);
		$numFormatos = $stmtTable->num_rows; if($numFormatos>0){$countDocument=0;}else{$countDocument=0;}
				
		$sqlSearhModCp = "SELECT cp.NAME_CURSO,cp.NAME_INSTRUCTOR,mdi.NUM_DC5,mdi.NUM_PC,mdi.RUTA_FIRMA FROM mod_capacitacion AS cp, mod_instructor AS mdi WHERE cp.NO_FOLIO='".$POST['sendFolio']."' AND cp.TIPO_REGISTRO='General' AND cp.NAME_INSTRUCTOR=mdi.NOMBRE";
		$stmtTableModCap = $db->select($sqlSearhModCp);
		
		$arrayConstan=array("getNoFolio"=>$POST['sendFolio'], "sendNameCurso"=>$stmtTableModCap[0]['NAME_CURSO'], "sendNameInstructor"=>trim($stmtTableModCap[0]['NAME_INSTRUCTOR']), "sendNUM_DC5"=>$stmtTableModCap[0]['NUM_DC5'], "sendNUM_PC"=>$stmtTableModCap[0]['NUM_PC'], "sendRUTA_FIRMA"=>$stmtTableModCap[0]['RUTA_FIRMA']);

		 while($row = $stmtTable->fetch_assoc()){

			$RutaFpdfFormat = "../../web/UploadPdf/PdfCapacitacion/FormatosPC/".$_SESSION['sesionSucur']."/".$POST['sendFolio']."/".$row['ID_CAPACITACION'].".pdf";
			$this->ConstanciaPCPdf($arrayConstan,$row['ID_CAPACITACION'],$row['NOMBRE_RA']); 

			$SQL_updateRutaFpdfFormat = "UPDATE mod_capacitacion SET RUTA_PDF='$RutaFpdfFormat' WHERE ID_CAPACITACION='".$row['ID_CAPACITACION']."'"; $rec = $db->query($SQL_updateRutaFpdfFormat);
			$countDocument++;
		 }

		$SQL_updateRutaFpdfFormatTrue = "UPDATE mod_capacitacion SET RUTA_PDF='true', RUTA_BARCODE=('$rutaBarcode') WHERE NO_FOLIO='".$POST['sendFolio']."' AND TIPO_REGISTRO='General'"; $rec = $db->query($SQL_updateRutaFpdfFormatTrue);
		echo "<script>$('#RequestMsg').html('<span style=\"color: #a94442;font-size: 25px;\">Número de Constancias Generadas: ".$countDocument." de ".$numFormatos."</span>'); $('#btnCloseConstan').removeClass('hidden'); $('#btnSaveConstan').addClass('hidden'); $('.modal-body').toggleClass('sk-loading'); </script>"; 
		exit;
	}
	
	//Genera Plantilla CONSTANCIA en Pdf para el Area Constancia
	public function ConstanciaPCPdf($arrayConstan,$getIdCapacita,$nombreAlumn){

		$db = new DbCnnx();
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		require_once '../../repositorio/fpdf/fpdf.php';
		require_once '../../repositorio/fpdf/fpdi.php';
		
		@$sucursal=$_SESSION['sesionSucur'];
		
		$pdf = new FPDI('L');
		$pageCount = $pdf->setSourceFile("../../repositorio/fpdf/pdfCapacitacion/FormatoConstancias.pdf");
		$tplIdx = $pdf->importPage(1);
		$pdf->addPage();
		$pdf->useTemplate($tplIdx,9, -2.5);

		$pdf->SetFont('times','I');
		$pdf->SetFontSize(24);
		$pdf->SetFillColor(255,255,255);
		
		$pdf->SetXY(23.5, 89);
		$pdf->Cell(250,10,"".ucwords(strtolower(utf8_decode($nombreAlumn)))."",0,1,'C', true); 

		$pdf->SetXY(23.5, 115);
		$pdf->Cell(250,10,"".ucwords(strtolower(utf8_decode(@$arrayConstan['sendNameCurso'])))."",0,1,'C', true); 
		
		$pdf->SetFont('Arial');
		$pdf->SetFontSize(10);
		$pdf->SetFillColor(255,255,255);

		$pdf->SetXY(204, 18);
		$pdf->Cell(60,4,"".ucwords(strtolower($_SESSION['sesionSucur']))." a ".date("d")." de ".date("F")." del ".date("Y")."",0,1,'C', true);
		
		$pdf->SetXY(204, 52);
		$pdf->Cell(62,4,"No. Folio  ".@$arrayConstan['getNoFolio']."",0,1,'C', true);
		
		$pdf->SetXY(189, 180);
		$pdf->Cell(85,4,"".mb_strtoupper(@$arrayConstan['sendNUM_PC'], 'UTF-8')."",0,1,'C', true);
		$pdf->SetFontSize(9);
		$pdf->SetXY(134.5, 160.4);
		$pdf->Cell(50,4,"".ucwords(strtolower(utf8_decode(@$arrayConstan['sendNameInstructor'])))."",0,1,'L', true); 
		$pdf->SetFontSize(10);
		$pdf->SetXY(127, 165.5);
		$pdf->Cell(50,4,"".mb_strtoupper(@$arrayConstan['sendNUM_DC5'], 'UTF-8')."",0,1,'L', true);
		// $pdf->SetXY(135.5, 172);
		$pdf->Image('../../web/images/FileUpload/BarCodeCapacitacion/'.@$arrayConstan['getNoFolio'].'.png',133,174,26,10,'png');
		$pdf->Image("../../".@$arrayConstan['sendRUTA_FIRMA']."",110,113,70,70);
		$pdf->SetFontSize(9);
		$pdf->SetXY(121.8, 185.4);
		$pdf->Cell(50,4, "No Folio: ".@$arrayConstan['getNoFolio']."",0,1,'C', true);
		
		$nombre_fichero = "../../web/UploadPdf/PdfCapacitacion/FormatosPC/$sucursal/".@$arrayConstan['getNoFolio']."/";

		if(file_exists($nombre_fichero)) {
			$pdf->Output('F',"../../web/UploadPdf/PdfCapacitacion/FormatosPC/$sucursal/".@$arrayConstan['getNoFolio']."/$getIdCapacita.pdf",'UTF-8 (true)');
		}else {
			mkdir($nombre_fichero, 0777, true);
			$pdf->Output('F',"../../web/UploadPdf/PdfCapacitacion/FormatosPC/$sucursal/".@$arrayConstan['getNoFolio']."/$getIdCapacita.pdf",'UTF-8 (true)');
		}
		
	}
	
	//ShowConstancias para Proteccion Civil
	public function ShowConstanciasPC($POST){
		$db = new DbCnnx();
		$getFolio=$POST['sendFolio'];
		$directorio = "../../web/UploadPdf/PdfCapacitacion/FormatosPC/TOLUCA/$getFolio";
		$gestor_dir = opendir($directorio); ?>
		<style>
		.producto-overlay {
			display: block;
			height: 158px;
			background: rgba(127, 138, 136, 0.71);
			line-height: 158px;
			position: absolute;
			bottom: -158px;
			width: 100%;
			left: 0px;
			right: 0px;
			transition: .3s; }
		.producto:hover .producto-overlay { bottom: 0px; transition: .3s; }
		.producto-overlay a {
			font-size: 80px;
			margin: 0;
			color: #fff;
			width: 100%;
			float: left;
			text-align: center; }
		.producto-overlay a:hover { color: #ffffff; background: #6f7372c9 !important; }
		.producto-overlay a:first-child { background: rgba(0,0,0,0.2); }		
		.producto-thumbnail { position: relative; overflow: hidden; }
		a { color: #0c79639c; text-decoration: none; }
		</style> <?php
		while (false !== ($nombre_fichero = readdir($gestor_dir))) { 
			if($nombre_fichero!="." && $nombre_fichero!=".."){ ?>
			<?php $nameExplode = explode(".", $nombre_fichero); $sqlSearhFolios = "SELECT * FROM mod_capacitacion WHERE ID_CAPACITACION='".$nameExplode[0]."'"; $stmtTable = $db->select($sqlSearhFolios); ?>
			<div class="col-sm-3">
				<div class="file-box producto">
					<div class="file producto-thumbnail">
						<a href="#">
							<span class="corner"></span>
							<div class="icon">
								<i class="fa fa-file-pdf-o"></i>
							</div>
							<div class="file-name">
								<?php echo substr($stmtTable[0]['NOMBRE_RA'],0,20); if(strlen($stmtTable[0]['NOMBRE_RA'])>20){echo '...pdf';}else{echo '.pdf';} ?>
								<br/>
								<small><?php echo substr($stmtTable[0]['ENTREGA'],0,4); if(strlen($stmtTable[0]['ENTREGA'])>4){echo '..';} ?> / Fecha: <?php echo date('d-M-Y',strtotime($stmtTable[0]['FECHA_REGISTRO'])); ?></small>
							</div>
						</a>
						<div class="producto-overlay">
							<a class="producto-overlay-link" href="<?php echo $directorio.'/'.$nombre_fichero;?>" download><i class="fa fa-download"></i></a>	
						</div>
					</div>
				</div>                                          
			</div> <?php }
			
		}  
		exit;
	}
	
	
	
	///*******************Modulo Instructores
	
	
	// Lista de Instructores ///
	
	public function loadInstruct(){
		$db = new DbCnnx();
		$sqlListInstruct = "SELECT usuarios.ID_USER,CONCAT(NOMBRE_U,' ',APP_PATERNO_U,' ',APP_MATERNO_U) AS NAMEFULL,EMAIL,TELEFONO_OFI_U,TELEFONO_CEL_U RUTA,FEC_REGISTRO,SUCURSAL,RUTA, TYPE_DOCUMENT, ESPECIALIZACION
							FROM usuarios 
							LEFT JOIN documents ON usuarios.ID_USER = documents.ID_USER AND TYPE_DOCUMENT='PROFILE_PICTURE'
							LEFT JOIN mod_instructor ON usuarios.ID_USER = mod_instructor.ID_USER
							WHERE TIPO_USUARIO='INSTRUCTOR'
							ORDER BY FEC_REGISTRO DESC";
		$stmtTable = $db->combo($sqlListInstruct);
		
		return $stmtTable;
	}
	
		/* Guarda Nueva Constancia */
	public function saveRutaDocument($urlDocument,$typeDocument,$nameFile,$extFile){
		
		$db = new DbCnnx();			
			$urlDocument=substr($urlDocument,6);
			$SQL_SearchDocument = "SELECT ID_DOCUMENT FROM documents WHERE ID_USER='".@$_COOKIE['id']."' AND TYPE_DOCUMENT='$typeDocument'";
			$rec = $db->select($SQL_SearchDocument);
			$idDocument = date('Ymd').date('his');
			if($rec[0]['ID_DOCUMENT']==''){ $SQL_InsertDocument = "INSERT INTO documents(ID_DOCUMENT,NAME_DOCUMENT,EXT,TYPE_DOCUMENT,RUTA,FECHA_ACTUALIZACION,VALID,ID_USER) VALUES($idDocument,'$nameFile','$extFile','$typeDocument','$urlDocument',NOW(),'false','".@$_COOKIE['id']."')"; $rec = $db->query($SQL_InsertDocument); 
			  }else{ $SQL_InsertDocument = "UPDATE documents SET RUTA='$urlDocument',FECHA_ACTUALIZACION=NOW(),NAME_DOCUMENT='$nameFile',EXT='$extFile' WHERE ID_DOCUMENT='".$rec[0]['ID_DOCUMENT']."'"; $rec = $db->query($SQL_InsertDocument); }
			
			echo $SQL_InsertDocument;
			var_dump($rec);
		
    }
	
		/* Guardar Datos del Instructor */
	public function saveDataInstruct($POST){
		
		$db = new DbCnnx();
		
			@$perfil=$POST['perfil'];
			@$numDc5=$POST['numDc5'];
			@$numeroPC=$POST['numeroPC'];
			@$listEspeciali=$POST['listEspeciali'];
			$listCourse = implode(",", $listEspeciali);
			
			$sqlSearchVerify = "SELECT VALID FROM mod_instructor WHERE ID_USER='".@$_COOKIE['id']."'";
			$stmtTable = $db->select($sqlSearchVerify);

			if($stmtTable[0]['VALID']==''){
			$QueryInsertValidAdm = "INSERT INTO valid_modulo VALUE('CPINSTRUCTOR".@$_COOKIE['id']."','".@$_COOKIE['id']."','40013','OLGA LIDIA MORENO HERNANDEZ','ADMINISTRACION','','','Validar Nuevo Instructor','','false','')"; 
			$recReturnId = $db->query($QueryInsertValidAdm);
			$SQL_UpdateValid = "UPDATE mod_instructor SET VALID='false' WHERE ID_USER='".@$_COOKIE['id']."'";
			$rec = $db->query($SQL_UpdateValid); }
			

			$SQL_UpdateDataInstruct = "UPDATE mod_instructor SET NUM_DC5='$numDc5',NUM_PC='$numeroPC',PERFIL='$perfil',ESPECIALIZACION='$listCourse' WHERE ID_USER='".@$_COOKIE['id']."'";
			$rec = $db->query($SQL_UpdateDataInstruct);

			if($rec==1){ echo '1#'; }
		
    }
	
	/* VALID CAPACITACION.PHP  Nuevos Instructores*/
	public function listPendientesValidInstruct($ID_CLIENTE){
		$db = new DbCnnx();
		$sessionNomUser=@$_SESSION['sesionNomUser'];		
		$sqlListValid = "SELECT mins.ID_USER AS ID_INSTRUCT,mins.NOMBRE,v.* FROM mod_instructor AS mins, valid_modulo AS v WHERE v.NOMBRE_USER='OLGA LIDIA MORENO HERNANDEZ' AND v.ID_CLIENTE = mins.ID_USER AND (v.VALID='true' OR v.VALID='false') GROUP BY ID_VALID ORDER BY FECHA_VALIDACION DESC";
		$stmtTable = $db->combo($sqlListValid);
		
		return $stmtTable;
	}
	
	//ShowConstancias/DC3
	public function showDocumentInstruc($POST){
		$db = new DbCnnx();
		?><style> .product-overlay { display: block; height: 30px; background: rgba(127, 138, 136, 0.71); line-height: 30px;  position: absolute; bottom: -60px; width: 100%; left: 0px; right: 0px; transition: .5s; } .product:hover .product-overlay { bottom: 59px; transition: .2s; } .product-overlay a { font-size: 15px; margin: 0; color: #fff; width: 50%; float: left; text-align: center; } .product-overlay a:hover { color: #ffffff; background: #6f7372c9 !important; } .product-overlay a:first-child { background: rgba(0,0,0,0.2); } .product-thumbnail { position: relative; overflow: hidden; } a{ color: #0c7963de; text-decoration: none; } .footable.breakpoint > tbody > tr > td > span.footable-toggle {  padding-right: 10px; color: #ded8d8; } .file.product-thumbnail.success{border-top: 3px solid #0b7d677a; }  .file.product-thumbnail.danger{border-top: 3px solid #b523235c; } #RequestShowDocuments{ margin-top:30px; }</style> <?php
		$numInstructor=$POST['numInstructor'];
		$sqlSearchDocument="SELECT * FROM documents WHERE ID_USER='$numInstructor' AND TYPE_DOCUMENT<>'PROFILE_PICTURE' ORDER BY FECHA_ACTUALIZACION DESC";
		$stmtTable = $db->combo($sqlSearchDocument);
		$countDocument=0;
		while($row = $stmtTable->fetch_assoc()){ if($row['VALID']=='true'){ $classThumb='success'; }else{ $classThumb='danger'; }?>
			<div class="col-sm-3">
				<div class="file-box product">
					<div class="file product-thumbnail <?php echo $classThumb; ?>">
						<a href="<?php echo "../../".$row['RUTA']; ?>" target="_blank">
							<span class="corner"></span>
							<div class="icon">
								<i class="fa fa-file-pdf-o"></i>
							</div>
							<div class="file-name">
								<?php echo substr(ucwords(mb_strtolower($row['NAME_DOCUMENT'], 'UTF-8')),0,20); if(strlen($row['NAME_DOCUMENT'])>20){echo '...';}else{echo '';} ?>
								<br/>
								<small><?php echo substr($row['TYPE_DOCUMENT'],0,3); if(strlen($row['TYPE_DOCUMENT'])>3){echo '..';} ?> / Tiempo: <?php echo timeAgo($row['FECHA_ACTUALIZACION']); ?></small>
							</div>
						</a>
						<div class="product-overlay">
							<a class="product-overlay-link" onclick="UpdateValidDoc(<?php echo $row['ID_DOCUMENT']; ?>,'true')" href="#" id="UpdateValidDoc"><i class="fa fa-check"></i></a> 
							<a class="product-overlay-link" onclick="UpdateValidDoc(<?php echo $row['ID_DOCUMENT']; ?>,'false')" href="#" id="UpdateValidDoc"><i class="fa fa-close"></i></a> 
						</div>
					</div>
				</div>                                          
			</div>
		<?php $countDocument++; } 
		if($countDocument==0){ echo "<span class=\"text-center\" style=\"color: #a94442;font-size: 25px;margin-top:20px;\">No existen Documentos...</span>"; }
		exit;
	}
	
	//Load Data Instructores
	public function editInstruct(){
		$db = new DbCnnx();
		$hd=",(SELECT RUTA FROM documents WHERE ID_USER='".@$_COOKIE['id']."' AND TYPE_DOCUMENT='CURP') AS RUTA_CURPP";
		$hd2=",(SELECT NAME_DOCUMENT FROM documents  WHERE ID_USER='".@$_COOKIE['id']."' AND TYPE_DOCUMENT='CURP') AS NAME_DOCUMENT";
		$hd3=",(SELECT EXT FROM documents WHERE ID_USER='".@$_COOKIE['id']."' AND TYPE_DOCUMENT='CURP') AS EXT_DOCUMENT";
		$hd4=",(SELECT VALID FROM documents WHERE ID_USER='".@$_COOKIE['id']."' AND TYPE_DOCUMENT='CURP') AS VALID_DOC";
		$sqlEditInstruct = "SELECT *$hd$hd2$hd3$hd4 FROM mod_instructor WHERE ID_USER='".@$_COOKIE['id']."'";
		$stmtTable = $db->select($sqlEditInstruct);
		
		return $stmtTable;
	}
	
	
	//Actualiza la validacion del documento del Instructor
	public function UpdaValidDoc($POST){
		$db = new DbCnnx();

		$attrIdDocument=$POST['attrIdDocument'];
		$val=$POST['val'];
		$SQL_UpdaValidDoc = "UPDATE documents SET VALID='$val' WHERE ID_DOCUMENT='$attrIdDocument'";
		$rec = $db->query($SQL_UpdaValidDoc);
		
		$SQL_Search = "SELECT ID_USER FROM documents WHERE ID_DOCUMENT='$attrIdDocument'";
		$recSelect = $db->select($SQL_Search);
		//Count Total de Documentos
		$SQL_SearchIn = "SELECT COUNT(*) as TotalDocs FROM documents WHERE ID_USER='".$recSelect[0]['ID_USER']."' AND VALID='true'";
		$recSelect2 = $db->select($SQL_SearchIn);
		
		//Actualiza Valid si el Instructor ya subio todos sus documentos
		if($recSelect2[0]['TotalDocs']=='10'){ $SQL_UpdaValidMI = "UPDATE mod_instructor SET VALID='true' WHERE ID_USER='".$recSelect[0]['ID_USER']."'"; $rec = $db->query($SQL_UpdaValidMI);  
		                                      $SQL_UpdaValidVM = "UPDATE valid_modulo SET FECHA_VALIDACION=NOW(),VALID='true' WHERE ID_VALID='CPINSTRUCTOR".$recSelect[0]['ID_USER']."'"; $rec = $db->query($SQL_UpdaValidVM); }else{
		$SQL_UpdaValidMI = "UPDATE mod_instructor SET VALID='false' WHERE ID_USER='".$recSelect[0]['ID_USER']."'"; $rec = $db->query($SQL_UpdaValidMI); 
		$SQL_UpdaValidVM = "UPDATE valid_modulo SET FECHA_VALIDACION=NOW(),VALID='false' WHERE ID_VALID='CPINSTRUCTOR".$recSelect[0]['ID_USER']."'"; $rec = $db->query($SQL_UpdaValidVM); }	
		
		$creadArray=array('numInstructor'=>$recSelect[0]['ID_USER']); $this->showDocumentInstruc($creadArray);
	}
	
	
	//Load Data Instructores
	public function searchDataInstruc($POST){
		$db = new DbCnnx();
		$nameInstruct=trim($POST['nameInstruct']);
		$sqlSearchInstruct = "SELECT NUM_DC5,NUM_PC FROM mod_instructor WHERE NOMBRE='$nameInstruct'";
		$stmtTable = $db->select($sqlSearchInstruct);
		
		echo json_encode($stmtTable);
	}
	
	
 }

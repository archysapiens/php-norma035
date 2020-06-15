<?php

 class Client{

    // private $name;

    public function saveClient($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();
		?><script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/load.js"></script><?php
        @$no_cliente=$POST["no_cliente"];//*******************DECLARAMOS VARIABLES EN DONDE LLEGAN LOS PARAMETROS DEL ARCHIVO "modal_registro_clientes.php"*******************
		@$rfc_fisico=$POST["rfc_fisico"];
		@$nombre=$POST["nombre"];
		@$apellido_pat=$POST["apellido_pat"];
		@$apellido_mat=$POST["apellido_mat"];
		@$tel_ofi=$POST["tel_ofi"];
		@$tel_celular=$POST["tel_celu"];
		@$observaciones=$POST["observaciones"];
		@$email_correo=$POST["correo"];
		@$hora1=$POST["hora1"];
		@$hora2=$POST["hora2"];
		@$hora3=$POST["hora3"];
		@$hora4=$POST["hora4"];
		@$sucursal=$POST["sucursal"];
		@$nra=$POST["nra"];
		@$num_cta=$POST["num_cta"];
		@$giro=$POST["giro"];
		@$ruta=$POST["ruta"];
		@$estado=$POST["estado"];
		@$municipio=$POST["municipio"];
		@$cp=$POST["cp"];
		@$localidad=$POST["localidad"];
		@$calle=$POST["calle"];
		@$num_int=$POST["num_int"];
		@$num_ext=$POST["num_ext"];
		@$EntreCalle1=$POST["EntreCalle1"];
		@$EntreCalle2=$POST["EntreCalle2"];
		@$referencia=$POST["referencia"];
		@$latitud=$POST["latitud"];
		@$longitud=$POST["longitud"];
		@$medioPago=$POST["medioPago"];
		@$metodoPago=$POST["metodoPago"];
		
		
		$SQL = sprintf("select no_cliente from empresas where no_cliente=$no_cliente");
		$rec = $db->combo($SQL);
		$count = 0;
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$rows = (object) $row;
		}
		
		if($count > 0){
			echo "
			<script language='javascript'>
			alert('Ya existe este Numero de Cliente en la Base de Datos  (Verifique sus datos) ')
			window.location='newClient.php'
			</script>";
			//echo '<div id="Error">Usuario ya existente</div>';
		 }
		else{ 
		
			$QueryInsertPago = "INSERT INTO pago VALUE(DEFAULT,'$metodoPago','$medioPago')";
			$recReturnId = $db->queryReturnId($QueryInsertPago);
		
			$SQL_insert_empresa = sprintf("insert into empresas(NO_CLIENTE,RFC,NOMBRE,APP_PATERNO,APP_MATERNO,NRA,NO_CTA_CON,GIRO,ZONA,ESTADO,DEL_MPIO,CP,COLONIA,CALLE,NUM_EXT,NUM_INT,REFERENCIA,ENTRE_CALLE1,ENTRE_CALLE2,ESTATUS,FECHA_INGRESO,LATITUD,LONGITUD,ID_PAGO,ID_ALTA_SUCURSAL)
			values('$no_cliente','$rfc_fisico','$nombre','$apellido_pat','$apellido_mat','$nra','$num_cta','$giro','$ruta','$estado','$municipio','$cp','$localidad','$calle',
			'$num_int','$num_ext','$referencia','$EntreCalle1','$EntreCalle2','A',NOW(),'$latitud','$longitud',$recReturnId,(SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sucursal'))");
			
			$rec = $db->query($SQL_insert_empresa);
			
			$SQL_insert_contacto = sprintf("insert into contactos(NO_CLIENTE,NOMBRE_C,APP_PATERNO_C,APP_MATERNO_C,EMAIL,HORARIO_ATENCION,HOR1,HOR2,HORARIO_ATENCION2,HOR3,HOR4,TELEFONO_OFI,TELEFONO_CELL,OBSERVACIONES,RFC_EMP)
			values('$no_cliente','$nombre','$apellido_pat','$apellido_mat','$email_correo','$hora1 A $hora2','$hora1','$hora2','$hora3 A $hora4','$hora3','$hora4','$tel_ofi','$tel_celular','$observaciones','$rfc_fisico')");
			
			$rec = $db->query($SQL_insert_contacto);
			
			
			$SQL_consulta_datos = sprintf("SELECT emp.NO_CLIENTE,emp.RFC,.emp.RAZON_SOCIAL,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.NRA,emp.ZONA,emp.GIRO,emp.NO_CTA_CON,emp.ESTADO,
			emp.DEL_MPIO,emp.CP,emp.COLONIA,emp.CALLE,emp.NUM_EXT,emp.NUM_INT,emp.REFERENCIA,emp.ENTRE_CALLE1,emp.ENTRE_CALLE2,emp.LATITUD,emp.LONGITUD,
			con.NO_CLIENTE,con.RFC_EMP,con.NOMBRE_C,con.APP_PATERNO_C,con.APP_MATERNO_C,con.EMAIL,con.TELEFONO_OFI,con.TELEFONO_CELL,con.HOR1,con.HOR2,con.HOR3,con.HOR4,con.OBSERVACIONES 
			FROM empresas AS emp 
			inner join contactos as con 
			on emp.no_cliente=con.no_cliente
			where emp.no_cliente='$no_cliente'");
			$rec = $db->combo($SQL_consulta_datos);

			while ($row = $rec->fetch_assoc()) {
				$datos = (object) $row;
			}
			
			@$Boton ="";//DECLARAMOS EL BTON QUE ESTE SERA EL DE MODIFICAREL CUAL TRAERA TODOS LOS CAMPOS CARGADOS
			@$Boton = @$Boton . " <div align=\"center\">
				<a href=\"#Modal_Mod_Fis\" onclick=\"desplegarMarcadoresFisica();\" role=\"button\" class=\"btn btn-lg  btn-primary\" data-toggle=\"modal\" id=\"Act^".
				@$datos->NO_CLIENTE ."^". @$datos->RFC ."^". @$datos->NOMBRE ."^". @$datos->APP_PATERNO ."^". @$datos->APP_MATERNO ."^". @$datos->TELEFONO_OFI ."^". 
				@$datos->TELEFONO_CELL ."^". @$datos->OBSERVACIONES ."^". @$datos->EMAIL ."^".
				@$datos->HOR1 ."^". @$datos->HOR2 ."^". @$datos->HOR3 ."^".
				@$datos->HOR4 ."^". @$datos->NRA ."^". @$datos->NO_CTA_CON ."^". @$datos->GIRO ."^". @$datos->ZONA ."^". @$datos->ESTADO ."^". @$datos->DEL_MPIO ."^".
				@$datos->CP ."^". @$datos->COLONIA ."^". @$datos->CALLE ."^". @$datos->NUM_EXT ."^". @$datos->NUM_INT ."^". @$datos->REFERENCIA ."^".
				@$datos->LATITUD ."^". @$datos->LONGITUD ."^"."\">Modificar</div>";
		}//ewsta llave cierra la validacion si ya existe el NUMERO DE CLIENTE
?>
		<!--AQUI DEPSUES DE QUE LA INSERCCION FUE CORRECTA MANDAMOS A MOSTARR EN LA TABLA ALGUNOS CAMPOS-->
		<h3>Datos Registrados del Cliente</h3>
		<div align="center">
			<div class="table-responsive"> 
				<TABLE class="table table-bordered table-striped table-hover">   
					<TR ALIGN=CENTER >    
					<TH  class="warning">N&Uacute;MERO DE CLIENTE:  <?php echo @$datos->NO_CLIENTE?>  				 RFC:  <?php echo @$datos->RFC?></TH>
					</TR>
					<TR ALIGN=CENTER>    
					<TH>NOMBRE DEL CLIENTE:	<?php echo @$datos->NOMBRE?>  <?php echo @$datos->APP_PATERNO?>  <?php echo @$datos->APP_MATERNO?></TH>
					</TR>
					<TR ALIGN=CENTER>    
					<TH class="warning">DIRECCI&Oacute;N:	<?php echo @$datos->ESTADO ?>,MUNICIPIO/DELEGACI&Oacute;N: <?php echo @$datos->DEL_MPIO ?>, LOCALIDAD: <?php echo @$datos->COLONIA ?>,CP: <?php echo @$datos->CP ?></TH>
					</TR>
					<TR ALIGN=CENTER>    
					<TH class="">GIRO: <?php echo @$datos->GIRO ?></TH>
					</TR>
					<TR ALIGN=CENTER>    
					<TH><?php echo @$Boton?></TH>
					</TR>
				</TABLE>
				</CENTER>
			</div>
		</div>
		
		<!-CREACION DEL CUERPO DE  LA VENTANA MODAL PARA LA MODIFICACION DE LOS CLIENTES->
        <div class="modal inmodal fade" id="Modal_Mod_Fis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--EMPIEZA LA CREACION DE MODA*1*-->
            <div class="modal-dialog"><!--DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
                <div class="modal-content animated fadeInDown" style="width:620px;"><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
                    <div class="modal-header"><!--DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
                         	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         		<span aria-hidden="true">&times;</span>
                         	</button><!-ESTE ES EL BOTON DE CERRAR LA MODAL LA TACHESITA KE APRACESE ASTA ARRIBA EN LA ESQUINA (X)->
                         <h2 class="modal-title" id="myModalLabel">Modificar datos del Cliente Fisico</h2><!-TITULO DE LA VENTANA MODAL->
                    </div><!--TERMINA DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
                    
                    <div class="modal-body"><!--DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->     
                      <form class="form-horizontal"><!-AQUI INICIA LA CREACION DEL FORMULARIO-> 
                     
                           <div class="bs-example tabs-container with-nav-tabs panel-success"><!-111-AQUI EMPIEZA EL DIV PARA CREAR LAS TABS -111->
							    <ul class="nav nav-pills nav-tabs"><!--**22**AQUI LA DECLARACION DELAS LI PARA LAS TABS**22**-->
							        <li class="active"><a data-toggle="tab" href="#Datos_Fiscales2">Datos Fiscales</a></li>
							        <li><a data-toggle="tab" href="#Domicilio2">Domicilio</a></li>
							        <li><a data-toggle="tab" href="#mapa2" onclick="desplegarMarcadoresFisica();">Ubicaci&oacute;n mapa</a></li>
									<li><a data-toggle="tab" href="#pago" onclick="validarCampos()">Pago</a></li>
							    </ul><!--**22**AQUI TERMINA LA DECLARACION DELAS LI PARA LAS TABS**22**-->
							    <div class="tab-content"><!-**2**AQUI EMPIEZA EL CONTENIDO PARA CADA TAB **2**->
							        
							        <div id="Datos_Fiscales2" class="tab-pane fade in active"><!-**3**AQUI EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
							            <BR>
								        <div class="form-group">
				                           	<label class="control-label col-xs-3">No. de Cliente:</label>
				                             <div class="col-xs-8">
				                               	<input type="text" id="txtnoCliente_Fi" name="txtnoCliente" class="form-control txtnoCliente_Fi" placeholder="Introduzca el n&uacute;mero de Cliente" onkeydown="return validarNumeros(event)" disabled>
				                                <input type="text" id="txtnoCliente_Fi_Actualiza" class="form-control txtnoCliente_Fi_Actualiza" style="display:none"><!--Este campo lo ocupo para poder actualizalo-->
				                              </div>
				                        </div>

				                        <div class="form-group">
			                               	<label class="control-label col-xs-3">RFC:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtrfc_Fisico_Fi" name="txtrfc_Fisico" class="form-control txtrfc_Fisico_Fi" placeholder="El RFC debe contener 13 caracteres" onkeyup="javascript:this.value=this.value.toUpperCase();" >
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                                <label  class="control-label col-xs-3">Nombre:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtnombre_Fi" name="txtnombre" class="form-control txtnombre_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                               	<label class="control-label col-xs-3">A. Paterno:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtap_P_Fi" name="txtap_P" class="form-control txtap_P_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                                <label class="control-label col-xs-3">A. Materno:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtap_M_Fi" name="txtap_M" class="form-control txtap_M_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
			                                </div>
			                           	</div>
			                           		<div class="form-group">
			                               	<label class="control-label col-xs-3">Tel&eacute;fono Ofi:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txt_tel_ofi_cont_Fi" name="txt_tel_ofi_cont" class="form-control txt_tel_ofi_cont_Fi" onkeydown="return validarNumeros(event)">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                                <label class="control-label col-xs-3">Tel&eacute;fono Cel:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txt_tel_cel_cont_Fi" name="txt_tel_cel_cont" class="form-control txt_tel_cel_cont_Fi" onkeydown="return validarNumeros(event)">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                               	<label  class="control-label col-xs-3">Observaciones:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txt_obs_cont_Fi" name="txt_obs_cont" class="form-control txt_obs_cont_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                                <label  class="control-label col-xs-3">Email:</label>
			                                <div class="col-xs-8">
			                                	<input type="email" id="txt_email_cont_Fi" name="txt_email_cont" class="form-control txt_email_cont_Fi" placeholder="email@ejemplo.com" >
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                             	<?php include('../repositorio/horarios/horario1_act.php');?>   
			                           	</div>
			                   			<div class="form-group">
			                             	<?php include('../repositorio/horarios/horario2_act.php');?>   
			                           	</div>

							        </div><!-**3**AQUI TERMINA EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
							        
							        <div id="Domicilio2" class="tab-pane fade"><!-**4**AQUI EMPIEZA EL DIV PARA LA TAB DE DOMICILIO**4**->
										<br>
										<div class="form-group" style="text-align:left">
											<label class="control-label col-xs-3">Sucursal:</label>
											<div class="col-xs-8">
													<select id="txtsucursal" name="txtsucursal" class="selectSearch form-control txtsucursal" style="width:100%;">
														<option value="">SELECCIONA...</option>
														<option value="TOLUCA">TOLUCA</option>
														<option value="ATLACOMULCO">ATLACOMULCO</option>
														<option value="CDMX">CDMX</option>
													</select>
													<span class="fa fa-plus col-xs-1" data-toggle="modal" data-target="#myModalSucursal" style="margin-left:100%;margin-top:-7%;cursor:pointer;z-index:100;vertical-align: middle;"></span>
											</div>
										</div>
							            <div class="form-group">
			                               	<label  class="control-label col-xs-3">NRA:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtnra_Fi" name="txtnra" class="form-control txtnra_Fi" placeholder="N&uacute;mero de Registro Ambiental" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                               	<label  class="control-label col-xs-3">No. Cuenta:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtnum_cta_Fi" name="txtnum_cta" class="form-control txtnum_cta_Fi" placeholder="N&uacute;mero de Cuenta Concentradora" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>
			                           	<div class="form-group" style="text-align:left">
			                                <label class="control-label col-xs-3">Giro:</label>
			                                <div class="col-xs-8">
			                                	 <select id="txtgiro_Fi" name="txtgiro" class="selectSearch form-control txtgiro_Fi" style="width:100%;">
			                                		<option value="" selected="selected" style="display:none">SELECCIONA...</option>
			                                		<option value="CASA DE ASISTENCIA">CASA DE ASISTENCIA</option>
									                <option value="CENTRO M&Eacute;DICO">CENTRO M&Eacute;DICO</option>
									                <option value="CL&Iacute;NICA">CL&Iacute;NICA</option>
									                <option value="CONSULTORIO">CONSULTORIO</option>
									                <option value="EMPRESA">EMPRESA</option>
									                <option value="ESCUELA">ESCUELA</option>
									                <option value="FARMACIA">FARMACIA</option>
									                 <option value="FUNERARIA">FUNERARIA</option>
									                <option value="HOSPITAL">HOSPITAL</option>
									                <option value="HOTEL">HOTEL</option>
									                <option value="LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS">LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS</option>
									                <option value="ODONTOLOG&Iacute;A">ODONTOLOG&Iacute;A</option>
									                <option value="POD&Oacute;LOGO">POD&Oacute;LOGO</option>
									                <option value="SANATORIO">SANATORIO</option>
									                <option value="TATUAJES Y PERFORACIONES">TATUAJES Y PERFORACIONES</option>  
									                <option value="TEXTIL">TEXTIL</option>
									                <option value="VETERINARIA">VETERINARIA</option>  
									                <option value="OTRO">OTRO</option>  
			                                	 </select>
			                                </div>
			                           	</div>
			                           	<div class="form-group" style="text-align:left">
			                                <label class="control-label col-xs-3">Ruta:</label>
			                                <div class="col-xs-8">
			                                	 <select id="txtruta_Fi" name="txtruta" class="selectSearch form-control txtruta_Fi" style="width:100%;">
			                                		<option value="" selected="selected" style="display:none">SELECCIONA...</option>
			                                		<option value="A">A</option>
									                <option value="B">B</option>
									                <option value="C">C</option>
			                                		<option value="D">D</option>
									                <option value="E">E</option>
									                <option value="F">F</option>
			                                		<option value="G">G</option>
									                <option value="H">H</option>
									                <option value="I">I</option>
			                                		<option value="J">J</option>
									                <option value="K">K</option>
									                <option value="L">L</option>
			                                		<option value="M">M</option>
			                                		<option value="N">N</option>
									                <option value="O">O</option>
									                <option value="P">P</option>
			                                		<option value="Q">Q</option>
									                <option value="R">R</option>
									                <option value="S">S</option>
			                                		<option value="T">T</option>
									                <option value="U">U</option>
									                <option value="V">V</option>
			                                		<option value="W">W</option>
									                <option value="X">X</option>
									                <option value="Y">Y</option>
									                <option value="Z">Z</option>
			                                	 </select>
			                                </div>
			                           	</div>
							        			                           	
                                       <div class="form-group" style="text-align:left">
			                                <label for="inputEmail" class="control-label col-xs-3">ESTADO:</label>
			                                <div class="col-xs-8">
			                                	
												<select name='estadoFi' id='estadoFi'  class='selectSearch form-control estadoFi' style="width:100%;">
												<!--option value='' style='display:none'>Selecciona Opci&oacute;n</option-->
												 <option  value="" style="display:none">SELECCIONA...</option>
												</select>
			                                </div>
			                           	</div>

			                           	<div class="form-group" style="text-align:left">
			                                <label for="inputEmail" class="control-label col-xs-3">Municipio:</label>
			                                <div class="col-xs-8">
			                                	<select class="selectSearch form-control txtmunicipio2" id="municipioFi" name="municipioFi" style="width:100%;">
												<option value="" style="display:none">SELECCIONA...</option>
												</select>
			                                </div>
			                           	</div>

			                           	<div class="form-group" style="text-align:left">
			                                <label for="inputEmail" class="control-label col-xs-3">CP:</label>
			                                <div class="col-xs-8">
			                                	<select class="selectSearch form-control txtmunicipio2" id="cpFi" name="cpFi" style="width:100%;">
												<option value="" style="display:none">SELECCIONA...</option>
												</select>
			                                </div>
			                           	</div>

			                           	<div class="form-group" style="text-align:left">
			                                <label for="inputEmail" class="control-label col-xs-3">Localidad:</label>
			                                <div class="col-xs-8">
			                                	<select class="selectSearch form-control txtmunicipio2" id="localidadFi" name="localidadFi" style="width:100%;">
												<option value="" style="display:none">SELECCIONA...</option>
												</select>
			                                </div>
			                           	</div>
			                           	 	<div class="form-group">
			                               	<label  class="control-label col-xs-3">Calle:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtcalle_Fi" name="txtcalle" class="form-control txtcalle_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>
							            <div class="form-group">
			                               	<label  class="control-label col-xs-3">No. Ext:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txt_num_ext_Fi" name="txt_num_ext" class="form-control txt_num_ext_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>
							            <div class="form-group">
			                               	<label  class="control-label col-xs-3">No. Int:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txt_num_int_Fi" name="txt_num_int" class="form-control txt_num_int_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                               	<label  class="control-label col-xs-3">Referencia:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="txtreferencia_Fi" name="txtreferencia" class="form-control txtreferencia_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
			                                </div>
			                           	</div>

							        </div><!-**4**AQUI TERMINA EL DIV PARA LA TAB DE DOMICILIO**4**->
							        
							        <div id="mapa2" class="tab-pane fade"><!-**5**AQUI EMPIEZA EL DIV PARA LA TAB DE MAPA**5**-><br>
												<div id="mapaModificarFisica" style="width:100%; height:350px;margin-top:2%;margin-left:2%;"></div>
												<br>
							            <div class="form-group">
			                               	<label  class="control-label col-xs-3">Latitud:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="latitude_Fi" name="latitude" class="form-control latitude_Fi" >
			                                </div>
			                           	</div>
			                           	<div class="form-group">
			                               	<label  class="control-label col-xs-3">Longitud:</label>
			                                <div class="col-xs-8">
			                                	<input type="text" id="longitude_Fi" name="longitude" class="form-control longitude_Fi" >
			                                </div>
			                           	</div>
							 
							            <div id="contenedor_MANDA_ERROR_MODIFCAR_FISICO"></div><!--EN ESTE DIV TRAE LOS ERRORES DE LA INSERCCION-->


							        </div><!--**5**AQUI TERMINAA EL DIV PARA LA TAB DE MAPA**5**-->
									
									<div id="pago" class="tab-pane fade in">
										<br>
										<div class="form-group" style="text-align:left">
											<label class="control-label col-xs-3">Medio de Pago:</label>
											<div class="col-xs-8">
												<select id="txtmedioPago" name="txtmedioPago" class="selectSearch form-control txtmedioPago" style="width:100%;">
													<option value="" >SELECCIONA...</option>
													
													<option value="FACTURA">FACTURA</option>
													<option value="NOTA">NOTA</option>
												</select>
											</div>
										</div>
										<div class="form-group" style="text-align:left">
											<label class="control-label col-xs-3">Método de Pago:</label>
											<div class="col-xs-8">
												<select id="txtmetodoPago" name="txtmetodoPago" class="selectSearch form-control txtmetodoPago" style="width:100%;">
													<option value="" >SELECCIONA...</option>
													<option value="EFECTIVO">EFECTIVO</option>
													<option value="DEPOSITO">DEPOSITO</option>
													<option value="CHEQUE">CHEQUE</option>
													<option value="TRANSFERENCIA">TRANSFERENCIA</option>
													<option value="TARJETA DIRECTO">TARJETA DIRECTO</option>
													<optgroup label="TARJETA" class="text-muted">																						
														<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3</option>
														<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6</option>
														<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9</option>
														<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;12</option>
														
													</optgroup>
												</select>
											</div>
										</div>
										<br>
										<br>
										<br>
									</div>

							    </div><!--**2**AQUI TERMINA EL CONTENIDO PARA CADA TAB**2**-->
							</div><!--111-AQUI TERMINA EL DIV PARA CREAR LAS TABS -111-->

                      </form><!--AQUI TERMINA LA CREACION DEL FORMULARIO-->
                    </div><!--TERMINA EL DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->   

                    <div class="modal-footer">                        
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:5px;">Cerrar</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="btnModificar_Fisico">Modificar</button>
                    </div>
                </div><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
            </div><!--TERMINA DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
        </div><!--DIV DONDE TERMINA  LA CREACION DE MODA*1*-->
		
		<!--LO QUE HACE ESTA FUNCION ES PARA PODER CARGAR LOS CAMPOS QUE VIENEN UNIDOS POR MEDIO DE ESTE SIMBOLO "^" EL CUAL SERAN CORTADOS POR MEDIO DE LA INSTRUCCUION SPLIT
DONDE SE GUARDAN EN FORMA DE ARREGLOS Y LOS PASAMOS AL ID DE CADA INPUT ****esta funcion se ocupa en este archivo y tambien ene le archivo "query_modificar_cliente_fisico.php"*****"--> 
	 <script type="text/javascript">
	   	$(function()
	   	{  
	   		$('body').click(function(evt)
	   		{    
		       	var IdBotones = evt.target.id
		       	//alert(">" + IdBotones + "<");
		       	var Prefijo = IdBotones.substring(0, 3);
		       	//alert(">" + Prefijo + "<");
		       	if (Prefijo == "Act")
		       	{
		            //alert(IdBotones );
		            var arr = IdBotones.split('^');
		            var strno_clienteFi = arr[1];
		            var strRFC_Fi = arr[2] ;
		            var strNombre = arr[3] ;
		            var strAp_Pat = arr[4] ;
		            var strAp_Mat = arr[5] ;
		            var strTel_ofi = arr[6] ;
		            var strTel_cel= arr[7] ;
		            var strobserva = arr[8] ;
		            var stremail = arr[9] ;
		            var strhora1 = arr[10] ;
		            var strhora2 = arr[11] ;
		            var strhora3 = arr[12] ;
		            var strhora4 = arr[13] ;
		            var strNRA = arr[14] ;
		            var strno_cta = arr[15] ;
		            var strgiro = arr[16] ;
		            var strruta = arr[17] ;
		            var strestadoFi = arr[18] ;
		            var strmunicipioFi = arr[19] ;
		            var strcpFi = arr[20] ;
		            var strcoloniaFi = arr[21] ;
		            var strcalle = arr[22] ;
		            var strno_ext = arr[23] ;
		            var strno_int = arr[24] ;
		            var strreferencia = arr[25] ;
		            var strlatitud = arr[26] ;
		            var strlongitud = arr[27] ;
		               
		            $('#txtnoCliente_Fi_Actualiza').val(strno_clienteFi);
		            $('#txtnoCliente_Fi').val(strno_clienteFi);
		            $('#txtrfc_Fisico_Fi').val(strRFC_Fi);        
		            $('#txtnombre_Fi').val(strNombre);
		            $('#txtap_P_Fi').val(strAp_Pat);        
		            $('#txtap_M_Fi').val(strAp_Mat);
		            $('#txt_tel_ofi_cont_Fi').val(strTel_ofi);        
		            $('#txt_tel_cel_cont_Fi').val(strTel_cel);
		            $('#txt_obs_cont_Fi').val(strobserva);        
		            $('#txt_email_cont_Fi').val(stremail); 
		            $('#hora1_act').val(strhora1);
		            $('#hora2_act').val(strhora2);
		            $('#hora3_act').val(strhora3);
		            $('#hora4_act').val(strhora4);        
		            $('#txtnra_Fi').val(strNRA);
		            $('#txtnum_cta_Fi').val(strno_cta);        
		            $('#txtgiro_Fi').val(strgiro);
		            $('#txtruta_Fi').val(strruta);        
		            $('#estadoFi').val(strestadoFi).change();
		            setTimeout(function (){$('#municipioFi').val(strmunicipioFi).change()},3500) ;
		            setTimeout(function (){$('#cpFi').val(strcpFi).change()},6600) ;
		            setTimeout(function (){$('#localidadFi').val(strcoloniaFi).change()},9800) ;
		            $('#txtcalle_Fi').val(strcalle);        
		            $('#txt_num_ext_Fi').val(strno_ext);
		            $('#txt_num_int_Fi').val(strno_int);
		            $('#txtreferencia_Fi').val(strreferencia);
		            $('#latitude_Fi').val(strlatitud);
		            $('#longitude_Fi').val(strlongitud);         
		       }
		       else if (IdBotones == "guardar")
		       {
		       }         
			});

	   });
	</script>
		<!--LO QUE HACE ESTA FUNCION ES PARA PODER CARGAR LOS CAMPOS QUE VIENEN UNIDOS POR MEDIO DE ESTE SIMBOLO "^" EL CUAL SERAN CORTADOS POR MEDIO DE LA INSTRUCCUION SPLIT
		DONDE SE GUARDAN EN FORMA D EARREGLOS Y LOS APSAMSO AL ID DE CADA INPUT-->
				<!--INICIO DE LA FUNCION PARA MODIFICAR CLIENTE FISICO Y VALIDAR FORMULARUIO EL CUAL VA AL ARCHIVO "query_modificar_cliente_fisico.php"-->
			<script type="text/javascript">
				$(document).ready(function()
				{
					$( '#btnModificar_Fisico' ).click( function (event)
					{//CUANDO EL BOTON ESCUCHA EL EVENTO DE CLICK SE EJECUTA EL SIGUIENTE SCRIPT PARA GUARDAR LOS DATOS QUE VAN 
						//HACIA EL ARCHIVO DE quey_registrat_cliente_fisico.php ES IMPORTANTE QUE SE PONGA (event) en function ya que en Mozilla no escucha este evento	
						 event.preventDefault();
						 
						 $('.modal-backdrop.fade.in').remove(); 
						 $('body').removeClass('modal-open'); 
						 //alert('holaFisico');
						 
						//TRAEMOS LOS VALORES DE LOS INPUTS POR MEDIO DE LAS CLASES
						var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						var formUpdateFisico = 'formUpdateFisico';
						var no_cliente = $( '.txtnoCliente_Fi' ).val(),
						no_cliente_auxiliar = $( '.txtnoCliente_Fi_Actualiza' ).val(),//ESTE VALOR LO MANDO COMOAUXILIAR LO TRAIGO EN UN INPUT OCULTO PARA PODER ACTUALIZAR EL NO DE CLIENTE
						rfc_fisico = $( '.txtrfc_Fisico_Fi' ).val(),
						nombre = $( '.txtnombre_Fi' ).val(),
						apellido_pat = $( '.txtap_P_Fi' ).val(),
						apellido_mat = $( '.txtap_M_Fi' ).val(),
						tel_ofi = $('.txt_tel_ofi_cont_Fi' ).val(),
						tel_celu = $('.txt_tel_cel_cont_Fi' ).val(),
						observaciones = $( '.txt_obs_cont_Fi' ).val(),
						correo = $( '.txt_email_cont_Fi' ).val(),
						hora1 = $( '.hora1_act' ).val(),
						hora2 = $( '.hora2_act' ).val(),
						hora3 = $( '.hora3_act' ).val(),
						hora4 = $( '.hora4_act' ).val(),
						nra = $( '.txtnra_Fi' ).val(),
						num_cta = $( '.txtnum_cta_Fi' ).val(),
						giro = $( '.txtgiro_Fi' ).val(),
						ruta = $( '.txtruta_Fi' ).val(),
						estado = $('#estadoFi').val(),
						municipio = $( '#municipioFi' ).val(),
						cp = $( '#cpFi' ).val(),
						localidad = $( '#localidadFi' ).val(),
						calle = $( '.txtcalle_Fi' ).val(),
						num_int = $( '.txt_num_int_Fi' ).val(),
						num_ext = $( '.txt_num_ext_Fi' ).val(),
						referencia = $( '.txtreferencia_Fi' ).val(),
						latitud = $( '.latitude_Fi' ).val(),
						longitud = $( '.longitude_Fi' ).val();
						
						$(".error").fadeOut().remove(); 

						if ($(".txtnoCliente_Fi").val() == "" )
						{  
							$(".txtnoCliente_Fi").focus().after('<span class="error">Ingrese No.Cliente</span>');
							$( '#contenedor_MANDA_ERROR_MODIFCAR_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo No. de Cliente<h3>' ).fadeOut(3000);	 
							return false;  
						}
						if ($(".txtrfc_Fisico_Fi").val() == "" )
						{  
							$(".txtrfc_Fisico_Fi").focus().after('<span class="error">Ingrese RFC</span>');
							$( '#contenedor_MANDA_ERROR_MODIFCAR_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo RFC<h3>' ).fadeOut(3000);	 
							return false;  
						}
						if ($(".txtrfc_Fisico_Fi").val().length != 13)
						{  
							$(".txtrfc_Fisico_Fi").focus().after('<span class="error">13 Digitos</span>');
							$( '#contenedor_MANDA_ERROR_MODIFCAR_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>El RFC debe ser de 13 digitos<h3>' ).fadeOut(3000);	 
							return false;  
						}
						if ($(".txtnombre_Fi").val() == "" )
						{  
							$(".txtnombre_Fi").focus().after('<span class="error">Ingrese Nombre</span>');
							$( '#contenedor_MANDA_ERROR_MODIFCAR_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Ingrese el campo de Nombre<h3>' ).fadeOut(3000);	 
							return false;  
						}
						if ($(".txt_email_cont_Fi").val() == " " || !emailreg.test($(".txt_email_cont_Fi").val())) 
						{
							$(".txt_email_cont_Fi").focus().after('<span class="error">Ingrese un email correcto</span>');  
							$( '#contenedor_MANDA_ERROR_MODIFCAR_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Ingrese un email correcto<h3>' ).fadeOut(3000);
							return false;  
						}
							// SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
								$.post( 'newClient.php' , {  formUpdateFisico : formUpdateFisico,no_cliente : no_cliente,no_cliente_auxiliar:no_cliente_auxiliar,rfc_fisico : rfc_fisico,nombre:nombre,
									apellido_pat:apellido_pat,apellido_mat:apellido_mat, tel_ofi:tel_ofi,tel_celu:tel_celu, observaciones:observaciones, correo:correo,hora1:hora1,hora2:hora2,
									hora3:hora3,hora4:hora4,nra:nra, num_cta:num_cta, giro:giro, ruta:ruta, estado:estado, municipio:municipio, cp:cp, localidad:localidad, calle:calle,
									num_int:num_int, num_ext:num_ext, referencia:referencia, latitud:latitud, longitud:longitud } , 
								function ( exito )
								{      
									$( '#contenedor_inserccion_correcta' ).removeClass('').html( exito ).fadeIn(4000);  
								});
									$("#Modal_Mod_Fis").modal("hide");//ESTA LINEA QUIERE DECIR QUE CUANDO SE GUARDEN LOS DATOS SE CIERRE LA VENTANA MODAL
							// FIN SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
								
					});
						$(".txtnoCliente_Fi,.txtrfc_Fisico_Fi,.txtnombre_Fi").bind('blur keyup', function()
						{
							// DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR  
								if ($(this).val() != "") 
								{              
									 $('.error').fadeOut();
									return false;  
								}
							// FIN DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR    
						});
						$(".txt_email_cont").bind('blur keyup', function()
						{
							// DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR AQUI LOHAE EN EL CAMPO DE EMAIL   
								if ($(".txt_email_cont_Fi").val() != "" && emailreg.test($(".txt_email_cont_Fi").val())) 
								{  
									$('.error').fadeOut();  
									return false;  
								}  
							//FIN DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR AQUI LOHAE EN EL CAMPO DE EMAIL        
						});
				});
			</script>
		<!--FIN INICIO DE LA FUNCION PARA MODIFICAR CLIENTE FISICO Y VALIDAR FORMULARUIO-->
	<?php	
    }
	 public function updateClient($POST){
			// require('../bd/bd.php');
			$db = new DbCnnx();
			?><script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/load.js"></script><?php
			
			@$no_cliente_auxiliar=$POST["no_cliente_auxiliar"];
			@$no_cliente=$POST["no_cliente"];
			@$rfc_fisico=$POST["rfc_fisico"];
			@$nombre=$POST["nombre"];
			@$apellido_pat=$POST["apellido_pat"];
			@$apellido_mat=$POST["apellido_mat"];
			@$tel_ofi=$POST["tel_ofi"];
			@$tel_celular=$POST["tel_celu"];
			@$observaciones=$POST["observaciones"];
			@$email_correo=$POST["correo"];
			@$hora1=$POST["hora1"];
			@$hora2=$POST["hora2"];
			@$hora3=$POST["hora3"];
			@$hora4=$POST["hora4"];
			@$nra=$POST["nra"];
			@$num_cta=$POST["num_cta"];
			@$giro=$POST["giro"];
			@$ruta=$POST["ruta"];
			@$estado=$POST["estado"];;
			@$municipio=$POST["municipio"];
			@$cp=$POST["cp"];
			@$localidad=$POST["localidad"];
			@$calle=$POST["calle"];
			@$num_int=$POST["num_int"];
			@$num_ext=$POST["num_ext"];
			@$referencia=$POST["referencia"];
			@$latitud=$POST["latitud"];
			@$longitud=$POST["longitud"];
			
			//$query = "update empleados2 set estado=('$estado'),municipio=('$municipio'),cp=('$cp'),localidad=('$colonia') where nombre=('$nombre')";
			//mysqli_query($link, $query)or die ('ERROR' .mysqli_error());
			@$SQL_update_empresa = "update empresas set NO_CLIENTE=('$no_cliente'),RFC=('$rfc_fisico'),NOMBRE=('$nombre'),APP_PATERNO=('$apellido_pat'),APP_MATERNO=('$apellido_mat'),
				NRA=('$nra'),CALLE=('$calle'),NUM_EXT=('$num_ext'),NUM_INT=('$num_int'),ZONA=('$ruta'),GIRO=('$giro'),NO_CTA_CON=('$num_cta'),LATITUD=('$latitud'),
				LONGITUD=('$longitud'),ESTADO=('$estado'),DEL_MPIO=('$municipio'),CP=('$cp'),COLONIA=('$localidad')
				WHERE NO_CLIENTE=('$no_cliente_auxiliar')";
				//echo $query_update_empresa;
				
				$rec = $db->query($SQL_update_empresa);

				@$SQL_update_contacto = "update contactos set NO_CLIENTE=('$no_cliente'),NOMBRE_C=('$nombre'),APP_PATERNO_C=('$apellido_pat'),APP_MATERNO_C=('$apellido_mat'),EMAIL=('$email_correo'),
				HORARIO_ATENCION=('$hora1 A $hora2'),HOR1=('$hora1'),HOR2=('$hora2'),HORARIO_ATENCION2=('$hora3 A $hora4'),HOR3=('$hora3'),HOR4=('$hora4'),EMAIL=('$email_correo'),
				TELEFONO_OFI=('$tel_ofi'),TELEFONO_CELL=('$tel_celular'),OBSERVACIONES=('$observaciones'),RFC_EMP=('$rfc_fisico') where NO_CLIENTE=('$no_cliente_auxiliar')";
				//echo $query_update_contacto;

				$rec = $db->query($SQL_update_contacto);

				
				$SQL_consulta_datos = sprintf("SELECT emp.NO_CLIENTE,emp.RFC,.emp.RAZON_SOCIAL,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.NRA,emp.ZONA,emp.GIRO,emp.NO_CTA_CON,emp.ESTADO,
				emp.DEL_MPIO,emp.CP,emp.COLONIA,emp.CALLE,emp.NUM_EXT,emp.NUM_INT,emp.REFERENCIA,emp.LATITUD,emp.LONGITUD,
				con.NO_CLIENTE,con.RFC_EMP,con.NOMBRE_C,con.APP_PATERNO_C,con.APP_MATERNO_C,con.EMAIL,con.TELEFONO_OFI,con.TELEFONO_CELL,con.HOR1,con.HOR2,con.HOR3,con.HOR4,con.OBSERVACIONES 
				FROM empresas AS emp 
				inner join contactos as con 
				on emp.no_cliente=con.no_cliente
				where emp.no_cliente='$no_cliente'");
				
				$rec = $db->combo($SQL_consulta_datos);

				while ($row = $rec->fetch_assoc()) {
					$datos = (object) $row;
				}
				
				/* close connection */
				//mysqli_close($link);
				@$Boton ="";
				@$Boton = @$Boton . " <div align=\"center\">
					<a href=\"#Modal_Mod_Fisico\" onclick=\"desplegarMarcadoresFisica();\" role=\"button\" class=\"btn btn-lg  btn-primary\" data-toggle=\"modal\" id=\"Act^".
					@$datos->NO_CLIENTE ."^". @$datos->RFC ."^". @$datos->NOMBRE ."^". @$datos->APP_PATERNO ."^". @$datos->APP_MATERNO ."^".
					@$datos->TELEFONO_OFI ."^". @$datos->TELEFONO_CELL ."^". @$datos->OBSERVACIONES ."^". @$datos->EMAIL ."^".
					@$datos->HOR1 ."^". @$datos->HOR2 ."^". @$datos->HOR3 ."^". @$datos->HOR4 ."^". @$datos->NRA ."^".
					@$datos->NO_CTA_CON ."^". @$datos->GIRO ."^". @$datos->ZONA ."^". @$datos->ESTADO ."^". @$datos->DEL_MPIO ."^".
					@$datos->CP ."^". @$datos->COLONIA ."^". @$datos->CALLE ."^". @$datos->NUM_EXT ."^". @$datos->NUM_INT ."^".
					@$datos->REFERENCIA ."^". @$datos->LATITUD ."^".
					@$datos->LONGITUD ."^"."\">Modificar</div>";
				
				?>
				<h3>Datos Registrados del Cliente</h3>
				<div align="text-center">
					<div class="table-responsive"> 
						<TABLE class="table table-bordered table-striped table-hover">   
							<TR ALIGN=CENTER >    
							<TH  class="warning">N&Uacute;MERO DE CLIENTE:  <?php echo @$datos->NO_CLIENTE?>                 RFC:  <?php echo @$datos->RFC?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH>NOMBRE DEL CLIENTE: <?php echo @$datos->NOMBRE?>  <?php echo @$datos->APP_PATERNO?>  <?php echo @$datos->APP_MATERNO?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH class="warning">DIRECCI&Oacute;N:   <?php echo @$datos->ESTADO ?>,MUNICIPIO/DELEGACI&Oacute;N: <?php echo @$datos->DEL_MPIO ?>, LOCALIDAD: <?php echo @$datos->COLONIA ?>,CP: <?php echo @$datos->CP ?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH class="">GIRO: <?php echo @$datos->GIRO ?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH><?php echo @$Boton?></TH>
							</TR>
						</TABLE>
					</div>
				</div>
				
				<!-CREACION DEL CUERPO DE  LA VENTANA MODAL PARA EL REGSITRO DE CLIENTES->
				<div class="modal fade" id="Modal_Mod_Fisico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--EMPIEZA LA CREACION DE MODA*1*-->
					<div class="modal-dialog"><!--DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
						<div class="modal-content animated fadeInDown" style="width:620px;"><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
							<div class="modal-header"><!--DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button><!-ESTE ES EL BOTON DE CERRAR LA MODAL LA TACHESITA KE APRACESE ASTA ARRIBA EN LA ESQUINA (X)->
								 <h2 class="modal-title" id="myModalLabel">Modificar datos del Cliente Fisico</h2><!-TITULO DE LA VENTANA MODAL->
							</div><!--TERMINA DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
							
							<div class="modal-body"><!--DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->     
							  <form class="form-horizontal"><!-AQUI INICIA LA CREACION DEL FORMULARIO-> 
							 
								   <div class="bs-example tabs-container with-nav-tabs panel-success"><!-111-AQUI EMPIEZA EL DIV PARA CREAR LAS TABS -111->
						  <ul class="nav nav-pills nav-tabs"><!--**22**AQUI LA DECLARACION DELAS LI PARA LAS TABS**22**-->
							  <li class="active"><a data-toggle="tab" href="#Datos_Fiscales3">Datos Fiscales</a></li>
							  <li><a data-toggle="tab" href="#Domicilio3">Domicilio</a></li>
							  <li><a data-toggle="tab" href="#mapa3" onclick="desplegarMarcadoresFisica();">Ubicaci&oacute;n mapa</a></li>
							  <li><a data-toggle="tab" href="#pago" onclick="validarCampos()">Pago</a></li>
						  </ul><!--**22**AQUI TERMINA LA DECLARACION DELAS LI PARA LAS TABS**22**-->
						  <div class="tab-content"><!-**2**AQUI EMPIEZA EL CONTENIDO PARA CADA TAB **2**->
							  
							  <div id="Datos_Fiscales3" class="tab-pane fade in active"><!-**3**AQUI EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
								  <BR>
												<div class="form-group">
													<label class="control-label col-xs-3">No. de Cliente:</label>
													 <div class="col-xs-8">
														<input type="text" id="txtnoCliente_Fi" name="txtnoCliente" class="form-control txtnoCliente_Fi" placeholder="Introduzca el n&uacute;mero de Cliente" onkeydown="return validarNumeros(event)" disabled>
														<input type="text" id="txtnoCliente_Fi_Actualiza" class="form-control txtnoCliente_Fi_Actualiza" style="display:none"><!--Este campo lo ocupo para poder actualizalo-->
													  </div>
												</div>

												<div class="form-group">
													<label class="control-label col-xs-3">RFC:</label>
													<div class="col-xs-8">
														<input type="text" id="txtrfc_Fisico_Fi" name="txtrfc_Fisico" class="form-control txtrfc_Fisico_Fi" placeholder="El RFC debe contener 13 caracteres" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">Nombre:</label>
													<div class="col-xs-8">
														<input type="text" id="txtnombre_Fi" name="txtnombre" class="form-control txtnombre_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-xs-3">A. Paterno:</label>
													<div class="col-xs-8">
														<input type="text" id="txtap_P_Fi" name="txtap_P" class="form-control txtap_P_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-xs-3">A. Materno:</label>
													<div class="col-xs-8">
														<input type="text" id="txtap_M_Fi" name="txtap_M" class="form-control txtap_M_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
													</div>
												</div>
													<div class="form-group">
													<label class="control-label col-xs-3">Tel&eacute;fono Ofi:</label>
													<div class="col-xs-8">
														<input type="text" id="txt_tel_ofi_cont_Fi" name="txt_tel_ofi_cont" class="form-control txt_tel_ofi_cont_Fi" onkeydown="return validarNumeros(event)">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-xs-3">Tel&eacute;fono Cel:</label>
													<div class="col-xs-8">
														<input type="text" id="txt_tel_cel_cont_Fi" name="txt_tel_cel_cont" class="form-control txt_tel_cel_cont_Fi" onkeydown="return validarNumeros(event)">
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">Observaciones:</label>
													<div class="col-xs-8">
														<input type="text" id="txt_obs_cont_Fi" name="txt_obs_cont" class="form-control txt_obs_cont_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();" >
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">Email:</label>
													<div class="col-xs-8">
														<input type="email" id="txt_email_cont_Fi" name="txt_email_cont" class="form-control txt_email_cont_Fi" placeholder="email@ejemplo.com" >
													</div>
												</div>
												<div class="form-group">
													<?php include('../repositorio/horarios/horario1_act.php');?>   
												</div>
												<div class="form-group">
													<?php include('../repositorio/horarios/horario2_act.php');?>   
												</div>

							  </div><!--**3**AQUI TERMINA EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**-->
							  
							  <div id="Domicilio3" class="tab-pane fade"><!--**4**AQUI EMPIEZA EL DIV PARA LA TAB DE DOMICILIO**4**-->
							     <br>
								<div class="form-group" style="text-align:left">
									<label class="control-label col-xs-3">Sucursal:</label>
									<div class="col-xs-8">
											<select id="txtsucursal" name="txtsucursal" class="selectSearch form-control txtsucursal" style="width:100%;">
												<option value="">SELECCIONA...</option>
												<option value="TOLUCA">TOLUCA</option>
												<option value="ATLACOMULCO">ATLACOMULCO</option>
												<option value="CDMX">CDMX</option>
											</select>
											<span class="fa fa-plus col-xs-1" data-toggle="modal" data-target="#myModalSucursal" style="margin-left:100%;margin-top:-7%;cursor:pointer;z-index:100;vertical-align: middle;"></span>
									</div>
								</div>
								   <div class="form-group">
													<label  class="control-label col-xs-3">NRA:</label>
													<div class="col-xs-8">
														<input type="text" id="txtnra_Fi" name="txtnra" class="form-control txtnra_Fi" placeholder="N&uacute;mero de Registro Ambiental" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">No. Cuenta:</label>
													<div class="col-xs-8">
														<input type="text" id="txtnum_cta_Fi" name="txtnum_cta" class="form-control txtnum_cta_Fi" placeholder="N&uacute;mero de Cuenta Concentradora" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
												<div class="form-group" style="text-align:left">
													<label class="control-label col-xs-3">Giro:</label>
													<div class="col-xs-8">
														 <select id="txtgiro_Fi" name="txtgiro" class="selectSearch form-control txtgiro_Fi" style="width:100%;">
															<option value="" selected="selected" style="display:none">SELECCIONA...</option>
															<option value="CASA DE ASISTENCIA">CASA DE ASISTENCIA</option>
															<option value="CENTRO M&Eacute;DICO">CENTRO M&Eacute;DICO</option>
															<option value="CL&Iacute;NICA">CL&Iacute;NICA</option>
															<option value="CONSULTORIO">CONSULTORIO</option>
															<option value="EMPRESA">EMPRESA</option>
															<option value="ESCUELA">ESCUELA</option>
															<option value="FARMACIA">FARMACIA</option>
															<option value="FUNERARIA">FUNERARIA</option>
															<option value="HOSPITAL">HOSPITAL</option>
															<option value="HOTEL">HOTEL</option>
															<option value="LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS">LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS</option>
															<option value="ODONTOLOG&Iacute;A">ODONTOLOG&Iacute;A</option>
															<option value="POD&Oacute;LOGO">POD&Oacute;LOGO</option>
															<option value="SANATORIO">SANATORIO</option>
															<option value="TATUAJES Y PERFORACIONES">TATUAJES Y PERFORACIONES</option>  
															<option value="TEXTIL">TEXTIL</option>
															<option value="VETERINARIA">VETERINARIA</option>  
															<option value="OTRO">OTRO</option>  
														 </select>
													</div>
												</div>
												<div class="form-group" style="text-align:left">
													<label class="control-label col-xs-3">Ruta:</label>
													<div class="col-xs-8">
														 <select id="txtruta_Fi" name="txtruta" class="selectSearch form-control txtruta_Fi" style="width:100%;">
															<option value="" selected="selected" style="display:none">SELECCIONA...</option>
															<option value="A">A</option>
															<option value="B">B</option>
															<option value="C">C</option>
															<option value="D">D</option>
															<option value="E">E</option>
															<option value="F">F</option>
															<option value="G">G</option>
															<option value="H">H</option>
															<option value="I">I</option>
															<option value="J">J</option>
															<option value="K">K</option>
															<option value="L">L</option>
															<option value="M">M</option>
															<option value="N">N</option>
															<option value="O">O</option>
															<option value="P">P</option>
															<option value="Q">Q</option>
															<option value="R">R</option>
															<option value="S">S</option>
															<option value="T">T</option>
															<option value="U">U</option>
															<option value="V">V</option>
															<option value="W">W</option>
															<option value="X">X</option>
															<option value="Y">Y</option>
														 </select>
													</div>
												</div>
																					
												<div class="form-group" style="text-align:left">
													<label for="inputEmail" class="control-label col-xs-3">ESTADO:</label>
													<div class="col-xs-8">
														
														<select name='estadoFi' id='estadoFi'  class='selectSearch form-control estadoFi' style="width:100%;">
														<!--option value='' style='display:none'>Selecciona Opci&oacute;n</option-->
														</select>
													</div>
												</div>

												<div class="form-group" style="text-align:left">
													<label for="inputEmail" class="control-label col-xs-3">Municipio:</label>
													<div class="col-xs-8">
														<select class="selectSearch form-control txtmunicipio2" id="municipioFi" name="municipioFi" style="width:100%;">
														<option value="" style="display:none">SELECCIONA...</option>
														</select>
													</div>
												</div>

												<div class="form-group" style="text-align:left">
													<label for="inputEmail" class="control-label col-xs-3">CP:</label>
													<div class="col-xs-8">
														<select class="selectSearch form-control txtmunicipio2" id="cpFi" name="cpFi" style="width:100%;">
														<option value="" style="display:none">SELECCIONA...</option>
														</select>
													</div>
												</div>

												<div class="form-group" style="text-align:left">
													<label for="inputEmail" class="control-label col-xs-3">Localidad:</label>
													<div class="col-xs-8">
														<select class="selectSearch form-control txtmunicipio2" id="localidadFi" name="localidadFi" style="width:100%;">
														<option value="" style="display:none">SELECCIONA...</option>
														</select>
													</div>
												</div>
													<div class="form-group">
													<label  class="control-label col-xs-3">Calle:</label>
													<div class="col-xs-8">
														<input type="text" id="txtcalle_Fi" name="txtcalle" class="form-control txtcalle_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">No. Ext:</label>
													<div class="col-xs-8">
														<input type="text" id="txt_num_ext_Fi" name="txt_num_ext" class="form-control txt_num_ext_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">No. Int:</label>
													<div class="col-xs-8">
														<input type="text" id="txt_num_int_Fi" name="txt_num_int" class="form-control txt_num_int_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">Referencia:</label>
													<div class="col-xs-8">
														<input type="text" id="txtreferencia_Fi" name="txtreferencia" class="form-control txtreferencia_Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
													</div>
												</div>
							  
							  </div><!-**4**AQUI TERMINA EL DIV PARA LA TAB DE DOMICILIO**4**->
							  
							  <div id="mapa3" class="tab-pane fade"><!-**5**AQUI EMPIEZA EL DIV PARA LA TAB DE MAPA**5**->
								   <br>
														<div id="mapaModificarFisica" style="width:100%; height:350px;margin-top:2%;margin-left:2%;"></div>
														<br>
												<div class="form-group">
													<label  class="control-label col-xs-3">Latitud:</label>
													<div class="col-xs-8">
														<input type="text" id="latitude_Fi" name="latitude" class="form-control latitude_Fi" >
													</div>
												</div>
												<div class="form-group">
													<label  class="control-label col-xs-3">Longitud:</label>
													<div class="col-xs-8">
														<input type="text" id="longitude_Fi" name="longitude" class="form-control longitude_Fi" >
													</div>
												</div>
									 
												<div id="contenedor_MANDA_ERROR_UPDATE_FISICO"></div><!--EN ESTE DIV TRAE LOS ERRORES DE LA INSERCCION-->

							  </div><!--**5**AQUI TERMINAA EL DIV PARA LA TAB DE MAPA**5**-->
							<div id="pago" class="tab-pane fade in">
								<br>
								<div class="form-group" style="text-align:left">
									<label class="control-label col-xs-3">Medio de Pago:</label>
									<div class="col-xs-8">
										<select id="txtmedioPago" name="txtmedioPago" class="selectSearch form-control txtmedioPago" style="width:100%;">
											<option value="" >SELECCIONA...</option>
											
											<option value="FACTURA">FACTURA</option>
											<option value="NOTA">NOTA</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="text-align:left">
									<label class="control-label col-xs-3">Método de Pago:</label>
									<div class="col-xs-8">
										<select id="txtmetodoPago" name="txtmetodoPago" class="selectSearch form-control txtmetodoPago" style="width:100%;">
											<option value="" >SELECCIONA...</option>
											<option value="EFECTIVO">EFECTIVO</option>
											<option value="DEPOSITO">DEPOSITO</option>
											<option value="CHEQUE">CHEQUE</option>
											<option value="TRANSFERENCIA">TRANSFERENCIA</option>
											<option value="TARJETA DIRECTO">TARJETA DIRECTO</option>
											<optgroup label="TARJETA" class="text-muted">																						
												<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3</option>
												<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6</option>
												<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9</option>
												<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;12</option>
												
											</optgroup>
										</select>
									</div>
								</div>
								<br>
								<br>
								<br>
							</div>

						  </div><!--**2**AQUI TERMINA EL CONTENIDO PARA CADA TAB**2**-->
					  </div><!--111-AQUI TERMINA EL DIV PARA CREAR LAS TABS -111-->

							  </form><!--AQUI TERMINA LA CREACION DEL FORMULARIO-->
							</div><!--TERMINA EL DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->   

							<div class="modal-footer">								
								<button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:5px;">Cerrar</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal" id="btnModificar_Fisico2">Modificar</button>
							</div>
						</div><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
					</div><!--TERMINA DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
				</div><!--DIV DONDE TERMINA  LA CREACION DE MODA*1*-->
				
				<!--INICIO DE LA FUNCION PARA MODIFICAR CLIENTE FISICO Y VALIDAR FORMULARUIO EL LLEGA A A ESTE MISMO ARCHIVO QUE ES "query_modificar_cliente_fisico.php"-->
				<script type="text/javascript">
					$(document).ready(function()
					{
						$( '#btnModificar_Fisico2' ).click( function (event)
						{//CUANDO EL BOTON ESCUCHA EL EVENTO DE CLICK SE EJECUTA EL SIGUIENTE SCRIPT PARA GUARDAR LOS DATOS QUE VAN 
							//HACIA EL ARCHIVO DE quey_registrat_cliente_fisico.php ES IMPORTANTE QUE SE PONGA (event) en function ya que en Mozilla no escucha este evento 
							 event.preventDefault();
							 
							 $('.modal-backdrop.fade.in').remove(); 
							 $('body').removeClass('modal-open'); 
							 //alert('holaFisico2');
							 
							//TRAEMOS LOS VALORES DE LOS INPUTS POR MEDIO DE LAS CLASES
							var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							var formUpdateFisico = 'formUpdateFisico';
							var no_cliente = $( '.txtnoCliente_Fi' ).val(),
							no_cliente_auxiliar = $( '.txtnoCliente_Fi_Actualiza' ).val(),//ESTE VALOR LO MANDO COMOAUXILIAR LO TRAIGO EN UN INPUT OCULTO PARA PODER ACTUALIZAR EL NO DE CLIENTE
							rfc_fisico = $( '.txtrfc_Fisico_Fi' ).val(),
							nombre = $( '.txtnombre_Fi' ).val(),
							apellido_pat = $( '.txtap_P_Fi' ).val(),
							apellido_mat = $( '.txtap_M_Fi' ).val(),
							tel_ofi = $('.txt_tel_ofi_cont_Fi' ).val(),
							tel_celu = $('.txt_tel_cel_cont_Fi' ).val(),
							observaciones = $( '.txt_obs_cont_Fi' ).val(),
							correo = $( '.txt_email_cont_Fi' ).val(),
							hora1 = $( '.hora1_act' ).val(),
							hora2 = $( '.hora2_act' ).val(),
							hora3 = $( '.hora3_act' ).val(),
							hora4 = $( '.hora4_act' ).val(),
							nra = $( '.txtnra_Fi' ).val(),
							num_cta = $( '.txtnum_cta_Fi' ).val(),
							giro = $( '.txtgiro_Fi' ).val(),
							ruta = $( '.txtruta_Fi' ).val(),
							estado = $('#estadoFi').val(),
							municipio = $( '#municipioFi' ).val(),
							cp = $( '#cpFi' ).val(),
							localidad = $( '#localidadFi' ).val(),
							calle = $( '.txtcalle_Fi' ).val(),
							num_int = $( '.txt_num_int_Fi' ).val(),
							num_ext = $( '.txt_num_ext_Fi' ).val(),
							referencia = $( '.txtreferencia_Fi' ).val(),
							latitud = $( '.latitude_Fi' ).val(),
							longitud = $( '.longitude_Fi' ).val();
							
							$(".error").fadeOut().remove(); 

							if ($(".txtnoCliente_Fi").val() == "" )
							{  
								$(".txtnoCliente_Fi").focus().after('<span class="error">Ingrese No.Cliente</span>');
								$( '#contenedor_MANDA_ERROR_UPDATE_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo No. de Cliente<h3>' ).fadeOut(3000);  
								return false;  
							}
							if ($(".txtrfc_Fisico_Fi").val() == "" )
							{  
								$(".txtrfc_Fisico_Fi").focus().after('<span class="error">Ingrese RFC</span>');
								$( '#contenedor_MANDA_ERROR_UPDATE_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo RFC<h3>' ).fadeOut(3000);     
								return false;  
							}
							if ($(".txtrfc_Fisico_Fi").val().length != 13)
							{  
								$(".txtrfc_Fisico_Fi").focus().after('<span class="error">13 Digitos</span>');
								$( '#contenedor_MANDA_ERROR_UPDATE_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>El RFC debe ser de 13 digitos<h3>' ).fadeOut(3000);  
								return false;  
							}
							if ($(".txtnombre_Fi").val() == "" )
							{  
								$(".txtnombre_Fi").focus().after('<span class="error">Ingrese Nombre</span>');
								$( '#contenedor_MANDA_ERROR_UPDATE_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Ingrese el campo de Nombre<h3>' ).fadeOut(3000);     
								return false;  
							}
							if ($(".txt_email_cont_Fi").val() == " " || !emailreg.test($(".txt_email_cont_Fi").val())) 
							{
								$(".txt_email_cont_Fi").focus().after('<span class="error">Ingrese un email correcto</span>');  
								$( '#contenedor_MANDA_ERROR_UPDATE_FISICO' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Ingrese un email correcto<h3>' ).fadeOut(3000);
								return false;  
							}
								// SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
									$.post( 'newClient.php' , {  formUpdateFisico : formUpdateFisico, no_cliente : no_cliente,no_cliente_auxiliar:no_cliente_auxiliar,rfc_fisico : rfc_fisico,nombre:nombre,
										apellido_pat:apellido_pat,apellido_mat:apellido_mat, tel_ofi:tel_ofi,tel_celu:tel_celu, observaciones:observaciones, correo:correo,hora1:hora1,hora2:hora2,
										hora3:hora3,hora4:hora4,nra:nra, num_cta:num_cta, giro:giro, ruta:ruta, estado:estado, municipio:municipio, cp:cp, localidad:localidad, calle:calle,
										num_int:num_int, num_ext:num_ext, referencia:referencia, latitud:latitud, longitud:longitud } , 
									function ( exito )
									{      
										$( '#contenedor_inserccion_correcta' ).removeClass('').html( exito ).fadeIn(4000);  
									});
										$("#Modal_Mod_Fis").modal("hide");//ESTA LINEA QUIERE DECIR QUE CUANDO SE GUARDEN LOS DATOS SE CIERRE LA VENTANA MODAL
								// FIN SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
									
						});
							$(".txtnoCliente_Fi,.txtrfc_Fisico_Fi,.txtnombre_Fi").bind('blur keyup', function()
							{
								// DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR  
									if ($(this).val() != "") 
									{              
										 $('.error').fadeOut();
										return false;  
									}
								// FIN DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR    
							});
							$(".txt_email_cont").bind('blur keyup', function()
							{
								// DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR AQUI LOHAE EN EL CAMPO DE EMAIL   
									if ($(".txt_email_cont_Fi").val() != "" && emailreg.test($(".txt_email_cont_Fi").val())) 
									{  
										$('.error').fadeOut();  
										return false;  
									}  
								//FIN DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR AQUI LOHAE EN EL CAMPO DE EMAIL        
							});
					});
				</script>
			<!--INICIO DE LA FUNCION PARA MODIFICAR CLIENTE FISICO Y VALIDAR FORMULARUIO EL LLEGA A A ESTE MISMO ARCHIVO QUE ES "query_modificar_cliente_fisico.php"-->
		<?php			
	 }
	 public function saveClientMoral($POST){
		// require('../bd/bd.php');
		$db = new DbCnnx();
		?><script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/loadMoral.js"></script><?php
		
		@$no_cliente=$POST["no_cliente"];//*******************DECLARAMOS VARIABLES EN DONDE LLEGAN LOS PARAMETROS DEL ARCHIVO "modal_registro_clientes.php"*******************
		@$rfc_moral=$POST["rfc_moral"];
		@$razon_social=$POST["razon_social"];
		@$sucursal=$POST["sucursal"];
		@$nra=$POST["nra"];
		@$num_cta=$POST["num_cta"];
		@$giro=$POST["giro"];
		@$ruta=$POST["ruta"];
		@$estado=$POST["estado"];
		@$municipio=$POST["municipio"];
		@$cp=$POST["cp"];
		@$localidad=$POST["localidad"];
		@$calle=$POST["calle"];
		@$num_int=$POST["num_int"];
		@$num_ext=$POST["num_ext"];
		@$EntreCalle1=$POST["EntreCalle1"];
		@$EntreCalle2=$POST["EntreCalle2"];
		@$referencia=$POST["referencia"];
		@$latitud=$POST["latitud"];
		@$longitud=$POST["longitud"];
		@$medioPago=$POST["medioPago"];
		@$metodoPago=$POST["metodoPago"];
		
		
		$SQL = sprintf("select no_cliente from empresas where no_cliente=$no_cliente");
		$rec = $db->combo($SQL);
		$count = 0;
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$rows = (object) $row;
		}

			if (@$count>0)//si existe un regsitro con ese nuemro de cliente manda mensaje y no lo regsistra por que ya existe en la base de datos
			{
				echo "
				<script language='javascript'>
				alert('Ya existe este Numero de Cliente en la Base de Datos  (Verifique sus datos) ')
				window.location='Registro_de_Clientes.php'
				</script>";
				//echo '<div id="Error">Usuario ya existente</div>';
			} 
			else 
			{
				$QueryInsertPago = "INSERT INTO pago VALUE(DEFAULT,'$metodoPago','$medioPago')";
				$recReturnId = $db->queryReturnId($QueryInsertPago);
				
				//si no existe un cliente con este NO de cliente se hace la inserccion alas tabla de EMPRESAS 
				$SQL_insert_empresa = sprintf("insert into empresas(NO_CLIENTE,RFC,RAZON_SOCIAL,NRA,NO_CTA_CON,GIRO,ZONA,ESTADO,DEL_MPIO,CP,COLONIA,CALLE,NUM_EXT,NUM_INT,REFERENCIA,ENTRE_CALLE1,ENTRE_CALLE2,ESTATUS,FECHA_INGRESO,LATITUD,LONGITUD,ID_PAGO,ID_ALTA_SUCURSAL)
				values('$no_cliente','$rfc_moral','$razon_social','$nra','$num_cta','$giro','$ruta','$estado','$municipio','$cp','$localidad','$calle',
				'$num_int','$num_ext','$referencia','$EntreCalle1','$EntreCalle2','A',NOW(),'$latitud','$longitud',$recReturnId,(SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$sucursal'))");
				
				$rec = $db->query($SQL_insert_empresa);
				
				$SQL_consulta_datos = sprintf("SELECT emp.NO_CLIENTE,emp.RFC,.emp.RAZON_SOCIAL,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.NRA,emp.ZONA,emp.GIRO,emp.NO_CTA_CON,emp.ESTADO,
				emp.DEL_MPIO,emp.CP,emp.COLONIA,emp.CALLE,emp.NUM_EXT,emp.NUM_INT,emp.REFERENCIA,emp.LATITUD,emp.LONGITUD
				FROM empresas AS emp 
				where emp.no_cliente='$no_cliente'");
				$rec = $db->combo($SQL_consulta_datos);

				while ($row = $rec->fetch_assoc()) {
					$count++;
					$datos = (object) $row;
				}
				
				@$Boton ="";//DECLARAMOS EL BTON QUE ESTE SERA EL DE MODIFICAREL CUAL TRAERA TODOS LOS CAMPOS CARGADOS
				@$Boton = @$Boton . " <div align=\"center\">
					<a href=\"#Modal_Mod_Moral\" onclick=\"desplegarMarcadoresMoral();\" role=\"button\" class=\"btn btn-lg  btn-primary\" data-toggle=\"modal\" id=\"Act^".
					@$datos->NO_CLIENTE ."^". @$datos->RFC ."^". @$datos->RAZON_SOCIAL ."^". @$datos->NRA ."^".
					@$datos->NO_CTA_CON ."^". @$datos->GIRO ."^". @$datos->ZONA ."^". @$datos->ESTADO ."^". @$datos->DEL_MPIO ."^".
					@$datos->CP ."^". @$datos->COLONIA ."^". @$datos->CALLE ."^". @$datos->NUM_EXT ."^". @$datos->NUM_INT ."^".
					@$datos->REFERENCIA ."^". @$datos->LATITUD ."^".
					@$datos->LONGITUD ."^"."\">Modificar</div>";
			}//ewsta llave cierra la validacion si ya existe el NUMERO DE CLIENTE 
			
			?>
				<!--AQUI DEPSUES DE QUE LA INSERCCION FUE CORRECTA MANDAMOS A MOSTARR EN LA TABLA ALGUNOS CAMPOS-->
				<h3>Datos Registrados del Cliente</h3>
				<div align="center">
					<div class="table-responsive"> 
						<TABLE class="table table-bordered table-striped table-hover">   
							<TR ALIGN=CENTER >    
							<TH  class="warning">N&Uacute;MERO DE CLIENTE:  <?php echo @$datos->NO_CLIENTE?>                 RFC:  <?php echo @$datos->RFC?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH>NOMBRE DEL CLIENTE: <?php echo @$datos->RAZON_SOCIAL?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH class="warning">DIRECCI&Oacute;N:   <?php echo @$datos->ESTADO ?>,MUNICIPIO/DELEGACI&Oacute;N: <?php echo @$datos->DEL_MPIO ?>, LOCALIDAD: <?php echo @$datos->COLONIA ?>,CP: <?php echo @$datos->CP ?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH class="">GIRO: <?php echo @$datos->GIRO ?></TH>
							</TR>
							<TR ALIGN=CENTER>    
							<TH><?php echo @$Boton?></TH>
							</TR>
						</TABLE>
						</CENTER>
					</div>
				</div>

						  <!-CREACION DEL CUERPO DE  LA VENTANA MODAL PARA LA MODIFICACION DE LOS CLIENTES->
						<div class="modal fade" id="Modal_Mod_Moral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--EMPIEZA LA CREACION DE MODA*1*-->
							<div class="modal-dialog"><!--DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
								<div class="modal-content animated fadeInDown" style="width:620px;"><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
									<div class="modal-header"><!--DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button><!-ESTE ES EL BOTON DE CERRAR LA MODAL LA TACHESITA KE APRACESE ASTA ARRIBA EN LA ESQUINA (X)->
										 <h2 class="modal-title" id="myModalLabel">Modificar datos del Cliente Moral</h2><!-TITULO DE LA VENTANA MODAL->
									</div><!--TERMINA DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
									
									<div class="modal-body"><!--DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->     
									  <form class="form-horizontal"><!-AQUI INICIA LA CREACION DEL FORMULARIO-> 
									 
										   <div class="bs-example tabs-container with-nav-tabs panel-success"><!-111-AQUI EMPIEZA EL DIV PARA CREAR LAS TABS -111->
												<ul class="nav nav-pills nav-tabs"><!--**22**AQUI LA DECLARACION DELAS LI PARA LAS TABS**22**-->
													<li class="active"><a data-toggle="tab" href="#Datos_Fiscales2">Datos Fiscales</a></li>
													<li><a data-toggle="tab" href="#Domicilio2">Domicilio</a></li>
													<li><a data-toggle="tab" href="#mapa2" onclick="desplegarMarcadoresMoral()">Ubicaci&oacute;n mapa</a></li>
													<li><a data-toggle="tab" href="#pago" onclick="validarCampos()">Pago</a></li>
												</ul><!--**22**AQUI TERMINA LA DECLARACION DELAS LI PARA LAS TABS**22**-->
												<div class="tab-content"><!-**2**AQUI EMPIEZA EL CONTENIDO PARA CADA TAB **2**->
													
													<div id="Datos_Fiscales2" class="tab-pane fade in active"><!-**3** INICIO AQUI EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
														<BR>
														<div class="form-group">
															<label class="control-label col-xs-3">No. de Cliente:</label>
															 <div class="col-xs-8">
																<input type="text" id="txtnoCliente_Mo" name="txtnoCliente_Mo" class="form-control txtnoCliente_Mo" placeholder="Introduzca el n&uacute;mero de Cliente" onkeydown="return validarNumeros(event)" disabled>
																<input type="text" id="txtnoCliente_Mo_Actualiza" class="form-control txtnoCliente_Mo_Actualiza" style="display:none"><!--Este campo lo ocupo para poder actualizalo--> 
															 </div>
														</div>

														<div class="form-group">
															<label class="control-label col-xs-3">RFC:</label>
															<div class="col-xs-8">
																<input type="text" id="txtrfc_Moral_Mo" name="txtrfc_Moral_Mo" class="form-control txtrfc_Moral_Mo" placeholder="El RFC debe contener 12 caracteres" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">Raz&oacute;n Social:</label>
															<div class="col-xs-8">
																<input type="text" id="txtrazon_social_Mo" name="txtrazon_social_Mo" class="form-control txtrazon_social_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
													 
													</div><!-**3**FIN  AQUI TERMINA EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
													
													<div id="Domicilio2" class="tab-pane fade"><!-**4**AQUI EMPIEZA EL DIV PARA LA TAB DE DOMICILIO**4**->
														<br>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Sucursal:</label>
															<div class="col-xs-8">
																	<select id="txtsucursal" name="txtsucursal" class="selectSearch form-control txtsucursal" style="width:100%;">
																		<option value="">SELECCIONA...</option>
																		<option value="TOLUCA">TOLUCA</option>
																		<option value="ATLACOMULCO">ATLACOMULCO</option>
																		<option value="CDMX">CDMX</option>
																	</select>
																	<span class="fa fa-plus col-xs-1" data-toggle="modal" data-target="#myModalSucursal" style="margin-left:100%;margin-top:-7%;cursor:pointer;z-index:100;vertical-align: middle;"></span>
															</div>
														</div>
													    <div class="form-group">
															<label  class="control-label col-xs-3">NRA:</label>
															<div class="col-xs-8">
																<input type="text" id="txtnra_Mo" name="txtnra_Mo" class="form-control txtnra_Mo" placeholder="N&uacute;mero de Registro Ambiental" maxlength="30"onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">No. Cuenta:</label>
															<div class="col-xs-8">
																<input type="text" id="txtnum_cta_Mo" name="txtnum_cta_Mo" class="form-control txtnum_cta_Mo" placeholder="N&uacute;mero de Cuenta Concentradora" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Giro:</label>
															<div class="col-xs-8">
																 <select id="txtgiro_Mo" name="txtgiro_Mo" class="selectSearch form-control txtgiro_Mo" style="width:100%;">
																	<option value="" selected="selected" style="display:none">SELECCIONA...</option>
																	<option value="CASA DE ASISTENCIA">CASA DE ASISTENCIA</option>
																	<option value="CENTRO M&Eacute;DICO">CENTRO M&Eacute;DICO</option>
																	<option value="CL&Iacute;NICA">CL&Iacute;NICA</option>
																	<option value="CONSULTORIO">CONSULTORIO</option>
																	<option value="EMPRESA">EMPRESA</option>
																	<option value="ESCUELA">ESCUELA</option>
																	<option value="FARMACIA">FARMACIA</option>
																	<option value="FUNERARIA">FUNERARIA</option>
																	<option value="HOSPITAL">HOSPITAL</option>
																	<option value="HOTEL">HOTEL</option>
																	<option value="LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS">LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS</option>
																	<option value="ODONTOLOG&Iacute;A">ODONTOLOG&Iacute;A</option>
																	<option value="POD&Oacute;LOGO">POD&Oacute;LOGO</option>
																	<option value="SANATORIO">SANATORIO</option>
																	<option value="TATUAJES Y PERFORACIONES">TATUAJES Y PERFORACIONES</option>  
																	<option value="TEXTIL">TEXTIL</option>
																	<option value="VETERINARIA">VETERINARIA</option>  
																	<option value="OTRO">OTRO</option>  
																 </select>
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Ruta:</label>
															<div class="col-xs-8">
																 <select id="txtruta_Mo" name="txtruta_Mo" class="selectSearch form-control txtruta_Mo" style="width:100%;">
																	<option value="" selected="selected" style="display:none">SELECCIONA...</option>
																	<option value="A">A</option>
																	<option value="B">B</option>
																	<option value="C">C</option>
																	<option value="D">D</option>
																	<option value="E">E</option>
																	<option value="F">F</option>
																	<option value="G">G</option>
																	<option value="H">H</option>
																	<option value="I">I</option>
																	<option value="J">J</option>
																	<option value="K">K</option>
																	<option value="L">L</option>
																	<option value="M">M</option>
																	<option value="N">N</option>
																	<option value="O">O</option>
																	<option value="P">P</option>
																	<option value="Q">Q</option>
																	<option value="R">R</option>
																	<option value="S">S</option>
																	<option value="T">T</option>
																	<option value="U">U</option>
																	<option value="V">V</option>
																	<option value="W">W</option>
																	<option value="X">X</option>
																	<option value="Y">Y</option>
																	<option value="Z">Z</option>
																 </select>
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">ESTADO:</label>
															<div class="col-xs-8">
																<select name='estadoMo' id='estadoMo'  class='selectSearch form-control estadoMo' style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>

														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">Municipio:</label>
															<div class="col-xs-8">
																<select class="selectSearch form-control txtmunicipio2" id="municipioMo" name="municipioMo" style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>

														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">CP:</label>
															<div class="col-xs-8">
																<select class="selectSearch form-control txtmunicipio2" id="cpMo" name="cpMo" style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>

														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">Localidad:</label>
															<div class="col-xs-8">
																<select class="selectSearch form-control txtmunicipio2" id="localidadMo" name="localidadMo" style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>
															<div class="form-group">
															<label  class="control-label col-xs-3">Calle:</label>
															<div class="col-xs-8">
																<input type="text" id="txtcalle_Mo" name="txtcalle_Mo" class="form-control txtcalle_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">No. Ext:</label>
															<div class="col-xs-8">
																<input type="text" id="txt_num_ext_Mo" name="txt_num_ext_Mo" class="form-control txt_num_ext_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">No. Int:</label>
															<div class="col-xs-8">
																<input type="text" id="txt_num_int_Mo" name="txt_num_int_Mo" class="form-control txt_num_int_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">Referencia:</label>
															<div class="col-xs-8">
																<input type="text" id="txtreferencia_Mo" name="txtreferencia_Mo" class="form-control txtreferencia_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>

													</div><!-**4**AQUI TERMINA EL DIV PARA LA TAB DE DOMICILIO**4**->
													
													<div id="mapa2" class="tab-pane fade"><!-**5**AQUI EMPIEZA EL DIV PARA LA TAB DE MAPA**5**->
														<br>
																	 <div id="mapaModificarMoral" style="width:100%; height:350px;margin-top:2%;margin-left:2%;"></div>
																	 <br>
														<div class="form-group">
															<label  class="control-label col-xs-3">Latitud:</label>
															<div class="col-xs-8">
																<input type="text" id="latitude_Mo" name="latitude_Mo" class="form-control latitude_Mo" >
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">Longitud:</label>
															<div class="col-xs-8">
																<input type="text" id="longitude_Mo" name="longitude_Mo" class="form-control longitude_Mo" >
															</div>
														</div>
											 
														<div id="contenedor_MANDA_ERROR_MODIFCAR_MORAL"></div><!--EN ESTE DIV TRAE LOS ERRORES DE LA INSERCCION-->


													</div><!--**5**AQUI TERMINAA EL DIV PARA LA TAB DE MAPA**5**-->
													<div id="pago" class="tab-pane fade in">
														<br>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Medio de Pago:</label>
															<div class="col-xs-8">
																<select id="txtmedioPago" name="txtmedioPago" class="selectSearch form-control txtmedioPago" style="width:100%;">
																	<option value="" >SELECCIONA...</option>
																	
																	<option value="FACTURA">FACTURA</option>
																	<option value="NOTA">NOTA</option>
																</select>
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Método de Pago:</label>
															<div class="col-xs-8">
																<select id="txtmetodoPago" name="txtmetodoPago" class="selectSearch form-control txtmetodoPago" style="width:100%;">
																	<option value="" >SELECCIONA...</option>
																	<option value="EFECTIVO">EFECTIVO</option>
																	<option value="DEPOSITO">DEPOSITO</option>
																	<option value="CHEQUE">CHEQUE</option>
																	<option value="TRANSFERENCIA">TRANSFERENCIA</option>
																	<option value="TARJETA DIRECTO">TARJETA DIRECTO</option>
																	<optgroup label="TARJETA" class="text-muted">																						
																		<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3</option>
																		<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6</option>
																		<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9</option>
																		<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;12</option>
																		
																	</optgroup>
																</select>
															</div>
														</div>
														<br>
														<br>
														<br>
													</div>

												</div><!--**2**AQUI TERMINA EL CONTENIDO PARA CADA TAB**2**-->
											</div><!--111-AQUI TERMINA EL DIV PARA CREAR LAS TABS -111-->

									  </form><!--AQUI TERMINA LA CREACION DEL FORMULARIO-->
									</div><!--TERMINA EL DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->   

									<div class="modal-footer">										
										<button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:5px;">Cerrar</button>
										<button type="button" class="btn btn-primary" id="btnModificar_Moral">Modificar</button>
									</div>
								</div><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
							</div><!--TERMINA DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
						</div><!--DIV DONDE TERMINA  LA CREACION DE MODA*1*-->

				<!--LO QUE HACE ESTA FUNCION ES PARA PODER CARGAR LOS CAMPOS QUE VIENEN UNIDOS POR MEDIO DE ESTE SIMBOLO "^" EL CUAL SERAN CORTADOS POR MEDIO DE LA INSTRUCCUION SPLIT
				DONDE SE GUARDAN EN FORMA DE ARREGLOS Y LOS PASAMOS AL ID DE CADA INPUT ****esta funcion se ocupa en este archivo y tambien ene le archivo "query_modificar_cliente_fisico.php"*****"-->  	
					<script type="text/javascript">
						$(function(){  
							$('body').click(function(evt){    
								var IdBotones = evt.target.id
								//alert(">" + IdBotones + "<");
								var Prefijo = IdBotones.substring(0, 3);
								//alert(">" + Prefijo + "<");
								if (Prefijo == "Act")
								{
									//alert(IdBotones );
									var arr = IdBotones.split('^');
									var strno_cliente_Mo = arr[1];
									var strRFC_Mo = arr[2] ;
									var strrazon_social_Mo = arr[3] ;
									var strNRA_Mo = arr[4] ;
									var strno_cta_Mo = arr[5] ;
									var strgiro_Mo = arr[6] ;
									var strruta_Mo = arr[7] ;
									var strestado_Mo = arr[8] ;
									var strmunicipio_Mo = arr[9] ;
									var strcp_Mo = arr[10] ;
									var strcolonia_Mo = arr[11] ;
									var strcalle_Mo = arr[12] ;
									var strno_ext_Mo = arr[13] ;
									var strno_int_Mo = arr[14] ;
									var strreferencia_Mo = arr[15] ;
									var strlatitud_Mo = arr[16] ;
									var strlongitud_Mo = arr[17] ;
									   
									$('#txtnoCliente_Mo_Actualiza').val(strno_cliente_Mo);
									$('#txtnoCliente_Mo').val(strno_cliente_Mo);
									$('#txtrfc_Moral_Mo').val(strRFC_Mo);        
									$('#txtrazon_social_Mo').val(strrazon_social_Mo);        
									$('#txtnra_Mo').val(strNRA_Mo);
									$('#txtnum_cta_Mo').val(strno_cta_Mo);        
									$('#txtgiro_Mo').val(strgiro_Mo);
									$('#txtruta_Mo').val(strruta_Mo);        
									  
									$('#estadoMo').val(strestado_Mo).change();
									setTimeout(function (){$('#municipioMo').val(strmunicipio_Mo).change()},3500) ;
									setTimeout(function (){$('#cpMo').val(strcp_Mo).change()},6600) ;
									setTimeout(function (){$('#localidadMo').val(strcolonia_Mo).change()},9800) ;

									$('#txtcalle_Mo').val(strcalle_Mo);        
									$('#txt_num_ext_Mo').val(strno_ext_Mo);
									$('#txt_num_int_Mo').val(strno_int_Mo);
									$('#txtreferencia_Mo').val(strreferencia_Mo);
									$('#latitude_Mo').val(strlatitud_Mo);
									$('#longitude_Mo').val(strlongitud_Mo);         
								}
								else if (IdBotones == "guardar")
								{
								}         
							});
						});
					</script>
					<!--fin LO QUE HACE ESTA FUNCION ES PARA PODER CARGAR LOS CAMPOS QUE VIENEN UNIDOS POR MEDIO DE ESTE SIMBOLO "^" EL CUAL SERAN CORTADOS POR MEDIO DE LA INSTRUCCUION SPLIT
					DONDE SE GUARDAN EN FORMA DE ARREGLOS Y LOS PASAMOS AL ID DE CADA INPUT ****esta funcion se ocupa en este archivo y tambien ene le archivo "query_modificar_cliente_fisico.php"*****"-->  	
					  
					<!--INICIO DE LA FUNCION PARA MODIFICAR CLIENTE MORAL Y VALIDAR FORMULARUIO LOS PARAMETROS QUE SE MANDAN DESDE ESTA FUNCION LLEGAN AL ARCHIVO "query_modificar_cliente_moral.php"-->
						<script type="text/javascript">
							$(document).ready(function()
							{
								$( '#btnModificar_Moral' ).click( function (event)
								{//CUANDO EL BOTON ESCUCHA EL EVENTO DE CLICK SE EJECUTA EL SIGUIENTE SCRIPT PARA GUARDAR LOS DATOS QUE VAN 
								//HACIA EL ARCHIVO DE quey_registrat_cliente_fisico.php ES IMPORTANTE QUE SE PONGA (event) en function ya que en Mozilla no escucha este evento	
									event.preventDefault();
																		
									$('.modal-backdrop.fade.in').remove();
									$('body').removeClass('modal-open');
									//alert('holaModal');
									
									//TRAEMOS LOS VALORES DE LOS INPUTS POR MEDIO DE LAS CLASES
									var formUpdateMoral = 'formUpdateMoral';
									var no_cliente = $( '.txtnoCliente_Mo' ).val(),
									no_cliente_auxiliar = $( '.txtnoCliente_Mo_Actualiza' ).val(),//ESTE VALOR LO MANDO COMOAUXILIAR LO TRAIGO EN UN INPUT OCULTO PARA PODER ACTUALIZAR EL NO DE CLIENTE
									rfc_moral = $( '.txtrfc_Moral_Mo' ).val(),
									razon_social = $( '.txtrazon_social_Mo' ).val(),

									nra = $( '.txtnra_Mo' ).val(),
									num_cta = $( '.txtnum_cta_Mo' ).val(),
									giro = $( '.txtgiro_Mo' ).val(),
									ruta = $( '.txtruta_Mo' ).val(),
									estado = $( '#estadoMo' ).val(),
									municipio = $( '#municipioMo' ).val(),
									cp = $( '#cpMo' ).val(),
									localidad = $( '#localidadMo' ).val(),
									calle = $( '.txtcalle_Mo' ).val(),
									num_int = $( '.txt_num_int_Mo' ).val(),
									num_ext = $( '.txt_num_ext_Mo' ).val(),
									referencia = $( '.txtreferencia_Mo' ).val(),
									latitud = $( '.latitude_Mo' ).val(),
									longitud = $( '.longitude_Mo' ).val();
									
									$(".error").fadeOut().remove(); 

									if ($(".txtnoCliente_Mo").val() == "" )
									{  
										$(".txtnoCliente_Mo").focus().after('<span class="error">Ingrese No.Cliente</span>');
										$( '#contenedor_MANDA_ERROR_MODIFCAR_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo No. de Cliente<h3>' ).fadeOut(3000);	 
										return false;  
									}
									if ($(".txtrfc_Moral_Mo").val() == "" )
									{  
										$(".txtrfc_Moral_Mo").focus().after('<span class="error">Ingrese RFC</span>');
										$( '#contenedor_MANDA_ERROR_MODIFCAR_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo RFC<h3>' ).fadeOut(3000);	 
										return false;  
									}
									if ($(".txtrfc_Moral_Mo").val().length != 12)
									{  
										$(".txtrfc_Moral_Mo").focus().after('<span class="error">12 Digitos</span>');
										$( '#contenedor_MANDA_ERROR_MODIFCAR_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>El RFC debe ser de 12 digitos<h3>' ).fadeOut(3000);	 
										return false;  
									}
									if ($(".txtrazon_social_Mo").val() == "" )
									{  
										$(".txtrazon_social_Mo").focus().after('<span class="error">Ingrese Raz&oacute;n Social</span>');
										$( '#contenedor_MANDA_ERROR_MODIFCAR_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Ingrese el campo Raz&oacute;n Social<h3>' ).fadeOut(3000);	 
										return false;  
									}
										// SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
											$.post( 'newClient.php' , {formUpdateMoral : formUpdateMoral, no_cliente : no_cliente,no_cliente_auxiliar:no_cliente_auxiliar,rfc_moral : rfc_moral,razon_social:razon_social,
												nra:nra, num_cta:num_cta,giro:giro, ruta:ruta, estado:estado, municipio:municipio, cp:cp, localidad:localidad, calle:calle,num_int:num_int, num_ext:num_ext,
												referencia:referencia, latitud:latitud, longitud:longitud  } , 
											function ( exito )
											{      
												$( '#contenedor_inserccion_correcta' ).removeClass('').html( exito ).fadeIn(4000);  
											});
											$("#Modal_Mod_Moral").modal("hide");//ESTA LINEA QUIERE DECIR QUE CUANDO SE GUARDEN LOS DATOS SE CIERRE LA VENTANA MODAL
										// FIN SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
											
								});
									$(".txtnoCliente_Mo,.txtrfc_Moral_Mo,.txtrazon_social_Mo").bind('blur keyup', function()
									{
										// DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR  
											if ($(this).val() != "") 
											{              
												 $('.error').fadeOut();
												return false;  
											}
										// FIN DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR    
									});
							});
						</script>
					<!--FIN DE LA FUNCION PARA MODIFICAR CLIENTE MORAL Y VALIDAR FORMULARUIO LOS PARAMETROS QUE SE MANDAN DESDE ESTA FUNCION LLEGAN AL ARCHIVO "query_modificar_cliente_moral.php"-->
				
<?php
	 }
			 public function updateMoral($POST){
				// require('../bd/bd.php');
				$db = new DbCnnx();
				?><script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/loadMoral.js"></script><?php
				
				@$no_cliente=$_POST["no_cliente"];
				@$no_cliente_auxiliar=$_POST["no_cliente_auxiliar"];
				@$rfc_moral=$_POST["rfc_moral"];
				@$razon_social=$_POST["razon_social"];
				@$nra=$_POST["nra"];
				@$num_cta=$_POST["num_cta"];
				@$giro=$_POST["giro"];
				@$ruta=$_POST["ruta"];
				@$estado=$_POST["estado"];;
				@$municipio=$_POST["municipio"];
				@$cp=$_POST["cp"];
				@$localidad=$_POST["localidad"];
				@$calle=$_POST["calle"];
				@$num_int=$_POST["num_int"];
				@$num_ext=$_POST["num_ext"];
				@$referencia=$_POST["referencia"];
				@$latitud=$_POST["latitud"];
				@$longitud=$_POST["longitud"];

				//$query = "update empleados2 set estado=('$estado'),municipio=('$municipio'),cp=('$cp'),localidad=('$colonia') where nombre=('$nombre')";
				//mysqli_query($link, $query)or die ('ERROR' .mysqli_error());
				@$SQL_update_empresa = "update empresas set NO_CLIENTE=('$no_cliente'),RFC=('$rfc_moral'),RAZON_SOCIAL=('$razon_social'),NRA=('$nra'),CALLE=('$calle'),NUM_EXT=('$num_ext'),NUM_INT=('$num_int'),
					ZONA=('$ruta'),GIRO=('$giro'),NO_CTA_CON=('$num_cta'),LATITUD=('$latitud'),
					LONGITUD=('$longitud'),ESTADO=('$estado'),DEL_MPIO=('$municipio'),CP=('$cp'),COLONIA=('$localidad')
					WHERE NO_CLIENTE=('$no_cliente_auxiliar')";
					
					@$rec = $db->query($SQL_update_empresa);

					//@$query_update_contacto = "update contactos set NOMBRE_C=('$nombre'),APP_PATERNO_C=('$apellido_pat'),APP_MATERNO_C=('$apellido_mat'),EMAIL=('$email_correo'),TELEFONO_OFI=('$tel_ofi'),TELEFONO_CELL=('$tel_celular'),OBSERVACIONES=('$observaciones'),RFC_EMP=('$rfc_fisico') where NO_CLIENTE=('$no_cliente')";
					//mysqli_query($link, @$query_update_contacto)or die ('ERROR' .mysqli_error());

					//@$consulta = "SELECT * FROM empresas WHERE NO_CLIENTE='$no_cliente'";
				@$SQL_consulta_datos = "SELECT emp.NO_CLIENTE,emp.RFC,.emp.RAZON_SOCIAL,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.NRA,emp.ZONA,emp.GIRO,emp.NO_CTA_CON,emp.ESTADO,
					emp.DEL_MPIO,emp.CP,emp.COLONIA,emp.CALLE,emp.NUM_EXT,emp.NUM_INT,emp.REFERENCIA,emp.LATITUD,emp.LONGITUD
					FROM empresas AS emp 
					where emp.no_cliente='$no_cliente'";
					
					@$rec = $db->combo($SQL_consulta_datos);
				  
				  
					while ($row = $rec->fetch_assoc()) {
						@$datos = (object) $row;
					}
					/* close connection */
					//mysqli_close($link);
					@$Boton ="";
					@$Boton = @$Boton . " <div align=\"center\">
						<a href=\"#Modal_Modificar_Moral\" onclick=\"desplegarMarcadoresMoral();\" role=\"button\" class=\"btn btn-lg  btn-primary\" data-toggle=\"modal\" id=\"Act^".
						@$datos->NO_CLIENTE ."^". @$datos->RFC ."^". @$datos->RAZON_SOCIAL ."^". @$datos->NRA ."^". @$datos->NO_CTA_CON ."^". 
						@$datos->GIRO ."^". @$datos->ZONA ."^". @$datos->ESTADO ."^". @$datos->DEL_MPIO ."^". @$datos->CP ."^". @$datos->COLONIA ."^".
						@$datos->CALLE ."^". @$datos->NUM_EXT ."^". @$datos->NUM_INT ."^".
						@$datos->REFERENCIA ."^". @$datos->LATITUD ."^".
						@$datos->LONGITUD ."^"."\">Modificar</div>";
						
					?>

						<h3>Datos Registrados del Cliente</h3>
						<div align="center">
							<div class="table-responsive"> 
								<TABLE class="table table-bordered table-striped table-hover">   
									<TR ALIGN=CENTER >    
									<TH  class="warning">N&Uacute;MERO DE CLIENTE:  <?php echo @$datos->NO_CLIENTE?>                 RFC:  <?php echo @$datos->RFC?></TH>
									</TR>
									<TR ALIGN=CENTER>    
									<TH>NOMBRE DEL CLIENTE: <?php echo @$datos->RAZON_SOCIAL?></TH>
									</TR>
									<TR ALIGN=CENTER>    
									<TH class="warning">DIRECCI&Oacute;N:   <?php echo @$datos->ESTADO ?>,MUNICIPIO/DELEGACI&Oacute;N: <?php echo @$datos->DEL_MPIO ?>, LOCALIDAD: <?php echo @$datos->COLONIA ?>,CP: <?php echo @$datos->CP ?></TH>
									</TR>
									<TR ALIGN=CENTER>    
									<TH class="">GIRO: <?php echo @$datos->GIRO ?></TH>
									</TR>
									<TR ALIGN=CENTER>    
									<TH><?php echo @$Boton?></TH>
									</TR>
								</TABLE>
								</CENTER>
							</div>
						</div>
						
						<!-CREACION DEL CUERPO DE  LA VENTANA MODAL PARA LA MODIFICACION DE LOS CLIENTES->
						<div class="modal fade" id="Modal_Modificar_Moral" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><!--EMPIEZA LA CREACION DE MODA*1*-->
							<div class="modal-dialog"><!--DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
								<div class="modal-content animated fadeInDown" style="width:620px;"><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
									<div class="modal-header"><!--DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button><!-ESTE ES EL BOTON DE CERRAR LA MODAL LA TACHESITA KE APRACESE ASTA ARRIBA EN LA ESQUINA (X)->
										 <h2 class="modal-title" id="myModalLabel">Modificar datos del Cliente Moral</h2><!-TITULO DE LA VENTANA MODAL->
									</div><!--TERMINA DIV NUMERO 4 CREACION DE VENTANA MODAL CLIENTE**4**-->
									
									<div class="modal-body"><!--DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->     
									  <form class="form-horizontal"><!-AQUI INICIA LA CREACION DEL FORMULARIO-> 
									 
										   <div class="bs-example tabs-container with-nav-tabs panel-success"><!-111-AQUI EMPIEZA EL DIV PARA CREAR LAS TABS -111->
												<ul class="nav nav-pills nav-tabs"><!--**22**AQUI LA DECLARACION DELAS LI PARA LAS TABS**22**-->
													<li class="active"><a data-toggle="tab" href="#Datos_Fiscales2">Datos Fiscales</a></li>
													<li><a data-toggle="tab" href="#Domicilio2">Domicilio</a></li>
													<li><a data-toggle="tab" href="#mapa2" onclick="desplegarMarcadoresMoral()">Ubicaci&oacute;n mapa</a></li>
													<li><a data-toggle="tab" href="#pago" onclick="validarCampos()">Pago</a></li>
												</ul><!--**22**AQUI TERMINA LA DECLARACION DELAS LI PARA LAS TABS**22**-->
												<div class="tab-content"><!-**2**AQUI EMPIEZA EL CONTENIDO PARA CADA TAB **2**->
													
													<div id="Datos_Fiscales2" class="tab-pane fade in active"><!-**3**AQUI EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
														<BR>
														<div class="form-group">
															<label class="control-label col-xs-3">No. de Cliente:</label>
															 <div class="col-xs-8">
																<input type="text" id="txtnoCliente_Mo" name="txtnoCliente_Mo" class="form-control txtnoCliente_Mo" placeholder="Introduzca el n&uacute;mero de Cliente" onkeydown="return validarNumeros(event)" disabled>
																<input type="text" id="txtnoCliente_Mo_Actualiza" class="form-control txtnoCliente_Mo_Actualiza" style="display:none"><!--Este campo lo ocupo para poder actualizalo-->
															  </div>
														</div>

														<div class="form-group">
															<label class="control-label col-xs-3">RFC:</label>
															<div class="col-xs-8">
																<input type="text" id="txtrfc_Moral_Mo" name="txtrfc_Moral_Mo" class="form-control txtrfc_Moral_Mo" placeholder="El RFC debe contener 12 caracteres" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">Raz&oacute;n Social:</label>
															<div class="col-xs-8">
																<input type="text" id="txtrazon_social_Mo" name="txtrazon_social_Mo" class="form-control txtrazon_social_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();" >
															</div>
														</div>
													 

													</div><!-**3**AQUI TERMINA EMPIEZA EL CONTENIDO PARA LA TAB DE DATOS FISCALES**3**->
													
													<div id="Domicilio2" class="tab-pane fade"><!-**4**AQUI EMPIEZA EL DIV PARA LA TAB DE DOMICILIO**4**->
														<br>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Sucursal:</label>
															<div class="col-xs-8">
																	<select id="txtsucursal" name="txtsucursal" class="selectSearch form-control txtsucursal" style="width:100%;">
																		<option value="">SELECCIONA...</option>
																		<option value="TOLUCA">TOLUCA</option>
																		<option value="ATLACOMULCO">ATLACOMULCO</option>
																		<option value="CDMX">CDMX</option>
																	</select>
																	<span class="fa fa-plus col-xs-1" data-toggle="modal" data-target="#myModalSucursal" style="margin-left:100%;margin-top:-7%;cursor:pointer;z-index:100;vertical-align: middle;"></span>
															</div>
														</div>
													    <div class="form-group">
															<label  class="control-label col-xs-3">NRA:</label>
															<div class="col-xs-8">
																<input type="text" id="txtnra_Mo" name="txtnra_Mo" class="form-control txtnra_Mo" placeholder="N&uacute;mero de Registro Ambiental" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">No. Cuenta:</label>
															<div class="col-xs-8">
																<input type="text" id="txtnum_cta_Mo" name="txtnum_cta_Mo" class="form-control txtnum_cta_Mo" placeholder="N&uacute;mero de Cuenta Concentradora" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Giro:</label>
															<div class="col-xs-8">
																 <select id="txtgiro_Mo" name="txtgiro_Mo" class="selectSearch form-control txtgiro_Mo" style="width:100%;">
																	<option value="" selected="selected" style="display:none">SELECCIONA...</option>
																	<option value="CASA DE ASISTENCIA">CASA DE ASISTENCIA</option>
																	<option value="CENTRO M&Eacute;DICO">CENTRO M&Eacute;DICO</option>
																	<option value="CL&Iacute;NICA">CL&Iacute;NICA</option>
																	<option value="CONSULTORIO">CONSULTORIO</option>
																	<option value="EMPRESA">EMPRESA</option>
																	<option value="ESCUELA">ESCUELA</option>
																	<option value="FARMACIA">FARMACIA</option>
																	 <option value="FUNERARIA">FUNERARIA</option>
																	<option value="HOSPITAL">HOSPITAL</option>
																	<option value="HOTEL">HOTEL</option>
																	<option value="LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS">LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS</option>
																	<option value="ODONTOLOG&Iacute;A">ODONTOLOG&Iacute;A</option>
																	<option value="POD&Oacute;LOGO">POD&Oacute;LOGO</option>
																	<option value="SANATORIO">SANATORIO</option>
																	<option value="TATUAJES Y PERFORACIONES">TATUAJES Y PERFORACIONES</option>  
																	<option value="TEXTIL">TEXTIL</option>
																	<option value="VETERINARIA">VETERINARIA</option>  
																	<option value="OTRO">OTRO</option>  
																 </select>
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Ruta:</label>
															<div class="col-xs-8">
																 <select id="txtruta_Mo" name="txtruta_Mo" class="selectSearch form-control txtruta_Mo" style="width:100%;">
																	<option value="" selected="selected" style="display:none">SELECCIONA...</option>
																	<option value="A">A</option>
																	<option value="B">B</option>
																	<option value="C">C</option>
																	<option value="D">D</option>
																	<option value="E">E</option>
																	<option value="F">F</option>
																	<option value="G">G</option>
																	<option value="H">H</option>
																	<option value="I">I</option>
																	<option value="J">J</option>
																	<option value="K">K</option>
																	<option value="L">L</option>
																	<option value="M">M</option>
																	<option value="N">N</option>
																	<option value="O">O</option>
																	<option value="P">P</option>
																	<option value="Q">Q</option>
																	<option value="R">R</option>
																	<option value="S">S</option>
																	<option value="T">T</option>
																	<option value="U">U</option>
																	<option value="V">V</option>
																	<option value="W">W</option>
																	<option value="X">X</option>
																	<option value="Y">Y</option>
																	<option value="Z">Z</option>
																 </select>
															</div>
														</div>
																							
														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">ESTADO:</label>
															<div class="col-xs-8">
																<select name='estadoMo' id='estadoMo'  class='selectSearch form-control estadoMo' style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>

														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">Municipio:</label>
															<div class="col-xs-8">
																<select class="selectSearch form-control txtmunicipio2" id="municipioMo" name="municipioMo" style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>

														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">CP:</label>
															<div class="col-xs-8">
																<select class="selectSearch form-control txtmunicipio2" id="cpMo" name="cpMo" style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>

														<div class="form-group" style="text-align:left">
															<label for="inputEmail" class="control-label col-xs-3">Localidad:</label>
															<div class="col-xs-8">
																<select class="selectSearch form-control txtmunicipio2" id="localidadMo" name="localidadMo" style="width:100%;">
																<option  value="" style="display:none">SELECCIONA...</option>
																</select>
															</div>
														</div>
															<div class="form-group">
															<label  class="control-label col-xs-3">Calle:</label>
															<div class="col-xs-8">
																<input type="text" id="txtcalle_Mo" name="txtcalle_Mo" class="form-control txtcalle_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">No. Ext:</label>
															<div class="col-xs-8">
																<input type="text" id="txt_num_ext_Mo" name="txt_num_ext_Mo" class="form-control txt_num_ext_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">No. Int:</label>
															<div class="col-xs-8">
																<input type="text" id="txt_num_int_Mo" name="txt_num_int_Mo" class="form-control txt_num_int_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">Referencia:</label>
															<div class="col-xs-8">
																<input type="text" id="txtreferencia_Mo" name="txtreferencia_Mo" class="form-control txtreferencia_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">
															</div>
														</div>

													</div><!-**4**AQUI TERMINA EL DIV PARA LA TAB DE DOMICILIO**4**->
													
													<div id="mapa2" class="tab-pane fade"><!-**5**AQUI EMPIEZA EL DIV PARA LA TAB DE MAPA**5**->
														 <br>
																	 <div id="mapaModificarMoral" style="width:100%; height:350px;margin-top:2%;margin-left:2%;"></div>
																	 <br>
														<div class="form-group">
															<label  class="control-label col-xs-3">Latitud:</label>
															<div class="col-xs-8">
																<input type="text" id="latitude_Mo" name="latitude_Mo" class="form-control latitude_Mo" >
															</div>
														</div>
														<div class="form-group">
															<label  class="control-label col-xs-3">Longitud:</label>
															<div class="col-xs-8">
																<input type="text" id="longitude_Mo" name="longitude_Mo" class="form-control longitude_Mo" >
															</div>
														</div>
											 
														<div id="contenedor_MANDA_ERROR_UPDATE_MORAL"></div><!--EN ESTE DIV TRAE LOS ERRORES DE LA INSERCCION-->


													</div><!--**5**AQUI TERMINAA EL DIV PARA LA TAB DE MAPA**5**-->
													<div id="pago" class="tab-pane fade in">
														<br>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Medio de Pago:</label>
															<div class="col-xs-8">
																<select id="txtmedioPago" name="txtmedioPago" class="selectSearch form-control txtmedioPago" style="width:100%;">
																	<option value="" >SELECCIONA...</option>
																	
																	<option value="FACTURA">FACTURA</option>
																	<option value="NOTA">NOTA</option>
																</select>
															</div>
														</div>
														<div class="form-group" style="text-align:left">
															<label class="control-label col-xs-3">Método de Pago:</label>
															<div class="col-xs-8">
																<select id="txtmetodoPago" name="txtmetodoPago" class="selectSearch form-control txtmetodoPago" style="width:100%;">
																	<option value="" >SELECCIONA...</option>
																	<option value="EFECTIVO">EFECTIVO</option>
																	<option value="DEPOSITO">DEPOSITO</option>
																	<option value="CHEQUE">CHEQUE</option>
																	<option value="TRANSFERENCIA">TRANSFERENCIA</option>
																	<option value="TARJETA DIRECTO">TARJETA DIRECTO</option>
																	<optgroup label="TARJETA" class="text-muted">																						
																		<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3</option>
																		<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6</option>
																		<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9</option>
																		<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;12</option>
																		
																	</optgroup>
																</select>
															</div>
														</div>
														<br>
														<br>
														<br>
													</div>

												</div><!--**2**AQUI TERMINA EL CONTENIDO PARA CADA TAB**2**-->
											</div><!--111-AQUI TERMINA EL DIV PARA CREAR LAS TABS -111-->

									  </form><!--AQUI TERMINA LA CREACION DEL FORMULARIO-->
									</div><!--TERMINA EL DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->   

									<div class="modal-footer">										
										<button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:5px;">Cerrar</button>
										<button type="button" class="btn btn-primary" id="btnModificar_Moral2">Modificar</button>
									</div>
								</div><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
							</div><!--TERMINA DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
						</div><!--DIV DONDE TERMINA  LA CREACION DE MODA*1*-->
						
						<!--INICIO DE LA FUNCION PARA MODIFICAR CLIENTE FISICO Y VALIDAR FORMULARUIO EL LLEGA A A ESTE MISMO ARCHIVO QUE ES "query_modificar_cliente_moral.php"-->
						<script type="text/javascript">
							$(document).ready(function()
							{
								$( '#btnModificar_Moral2' ).click( function (event)
								{//CUANDO EL BOTON ESCUCHA EL EVENTO DE CLICK SE EJECUTA EL SIGUIENTE SCRIPT PARA GUARDAR LOS DATOS QUE VAN 
								//HACIA EL ARCHIVO DE quey_registrat_cliente_fisico.php ES IMPORTANTE QUE SE PONGA (event) en function ya que en Mozilla no escucha este evento 
									event.preventDefault();
									
									$('.modal-backdrop.fade.in').remove();
									$('body').removeClass('modal-open');
									//alert('holaModal2');
									
									//TRAEMOS LOS VALORES DE LOS INPUTS POR MEDIO DE LAS CLASES
									var formUpdateMoral='formUpdateMoral';
									var no_cliente = $( '.txtnoCliente_Mo' ).val(),
									no_cliente_auxiliar = $( '.txtnoCliente_Mo_Actualiza' ).val(),//ESTE VALOR LO MANDO COMOAUXILIAR LO TRAIGO EN UN INPUT OCULTO PARA PODER ACTUALIZAR EL NO DE CLIENTE
									rfc_moral = $( '.txtrfc_Moral_Mo' ).val(),
									razon_social = $( '.txtrazon_social_Mo' ).val(),

									nra = $( '.txtnra_Mo' ).val(),
									num_cta = $( '.txtnum_cta_Mo' ).val(),
									giro = $( '.txtgiro_Mo' ).val(),
									ruta = $( '.txtruta_Mo' ).val(),
									estado = $( '#estadoMo' ).val(),
									municipio = $( '#municipioMo' ).val(),
									cp = $( '#cpMo' ).val(),
									localidad = $( '#localidadMo' ).val(),
									calle = $( '.txtcalle_Mo' ).val(),
									num_int = $( '.txt_num_int_Mo' ).val(),
									num_ext = $( '.txt_num_ext_Mo' ).val(),
									referencia = $( '.txtreferencia_Mo' ).val(),
									latitud = $( '.latitude_Mo' ).val(),
									longitud = $( '.longitude_Mo' ).val();
									
									$(".error").fadeOut().remove(); 

									if ($(".txtnoCliente_Mo").val() == "" )
									{  
										$(".txtnoCliente_Mo").focus().after('<span class="error">Ingrese No.Cliente</span>');
										$( '#contenedor_MANDA_ERROR_UPDATE_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo No. de Cliente<h3>' ).fadeOut(3000);   
										return false;  
									}
									if ($(".txtrfc_Moral_Mo").val() == "" )
									{  
										$(".txtrfc_Moral_Mo").focus().after('<span class="error">Ingrese RFC</span>');
										$( '#contenedor_MANDA_ERROR_UPDATE_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Llena el campo RFC<h3>' ).fadeOut(3000);  
										return false;  
									}
									if ($(".txtrfc_Moral_Mo").val().length != 12)
									{  
										$(".txtrfc_Moral_Mo").focus().after('<span class="error">12 Digitos</span>');
										$( '#contenedor_MANDA_ERROR_UPDATE_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>El RFC debe ser de 12 digitos<h3>' ).fadeOut(3000);   
										return false;  
									}
									if ($(".txtrazon_social_Mo").val() == "" )
									{  
										$(".txtrazon_social_Mo").focus().after('<span class="error">Ingrese Raz&oacute;n Social</span>');
										$( '#contenedor_MANDA_ERROR_UPDATE_MORAL' ).fadeIn( 3000 ).addClass( '' ).html( '<h3>Ingrese el campo Raz&oacute;n Social<h3>' ).fadeOut(3000);    
										return false;  
									}
										// SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
											$.post( 'newClient.php' , {formUpdateMoral : formUpdateMoral, no_cliente : no_cliente,no_cliente_auxiliar:no_cliente_auxiliar,rfc_moral : rfc_moral,razon_social:razon_social,
												nra:nra, num_cta:num_cta, giro:giro, ruta:ruta, estado:estado, municipio:municipio, cp:cp, localidad:localidad, calle:calle, num_int:num_int, num_ext:num_ext, 
												referencia:referencia, latitud:latitud, longitud:longitud  } , 
											function ( exito )
											{      
												$( '#contenedor_inserccion_correcta' ).removeClass('').html( exito ).fadeIn(4000);  
											});
											$("#Modal_Contacto_Moral").modal("hide");//ESTA LINEA QUIERE DECIR QUE CUANDO SE GUARDEN LOS DATOS SE CIERRE LA VENTANA MODAL
										// FIN SI LOS CAMPOS ESTAN COMPLETOS MANDA LOS PARAMETROS A GUARDAR.PHP CUANDO ES CORRECTO SE MUESTRAN LOS DATOS EN LA TABLA INFOMATIVA EN EL DIV #contenedor_inserccion_correcta
											
								});
									$(".txtnoCliente_Mo,.txtrfc_Moral_Mo,.txtrazon_social_Mo").bind('blur keyup', function()
									{
										// DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR  
											if ($(this).val() != "") 
											{              
												 $('.error').fadeOut();
												return false;  
											}
										// FIN DESPUES DE MANDAR EL MENSAJE DE LLENAR CAMPOS SE VA BORRANDO EL MSJ AL ESCRIBIR    
									});
							});
						</script>
					<!--FIN DE LA FUNCION PARA MODIFICAR CLIENTE FISICO Y VALIDAR FORMULARUIO EL LLEGA A A ESTE MISMO ARCHIVO QUE ES "query_modificar_cliente_moral.php"-->
						
				<?php
			
			 }
			
		 public function saveClientMoralDatos($POST=''){
			 
		     $db = new DbCnnx();
			 
			@$no_cliente=$POST['NO_CLIENTE'];
			@$rfc=$POST['RFC_EMP'];

			//REALIZAMOS LA CONSULTA PARA PODER MOSTRAR LOS DATOS EN LA TABLA
			@$SQL_consulta = sprintf("SELECT *
			FROM empresas AS emp 
			inner join contactos as con 
			on emp.no_cliente=con.no_cliente 
			where emp.no_cliente='$no_cliente'");
			
			@$rec = $db->combo(@$SQL_consulta);
			
			?>
			<div class="table-responsive">
				<table  class="table table-hover table-responsive table-bordered">
					<thead>
						<tr>
							<th data-field="id_empresa">NO.CLIENTE</th>
							<th data-field="id_empresa">NOMBRE</th>
							<th data-field="id_empresa">AP.PATERNO</th>
							<th data-field="id_empresa">AP.MATERNO</th>
							<th data-field="id_empresa">EMAIL</th>
							<th data-field="id_empresa">TEL&Eacute;FONO OF.</th>
							<th data-field="id_empresa">TEL&Eacute;FONO CEL.</th>
							<th data-field="id_empresa">MODIFICAR</th>
						</tr>
					</thead>
				<tbody>
					<?php
					
					while ($row = @$rec->fetch_assoc()) {
						echo "<tr class='text-muted'>";
						echo "<th style=\"text-align:center;width: 1%;font-weight:normal;\">".$row['NO_CLIENTE']."</th>";
						echo "<th style=\"text-align:center;font-weight:normal;\">".$row['NOMBRE_C']."</th>";
						echo "<th style=\"text-align:center;font-weight:normal;\">".$row['APP_PATERNO_C']."</th>";
						echo "<th style=\"text-align:center;font-weight:normal;\">".$row['APP_MATERNO_C']."</th>";
						echo "<th style=\"text-align:center;font-weight:normal;\">".$row['EMAIL']."</th>";
						echo "<th style=\"text-align:center;font-weight:normal;\">".$row['TELEFONO_OFI']."</th>";
						echo "<th style=\"text-align:center;font-weight:normal;\">".$row['TELEFONO_CELL']."</th>";
						echo "<th style=\"text-align:center;width: 1%;\"><a href=\"#Modal_Actualizar_Contacto\" role=\"button\" class=\"btn btn-xs  btn-primary\" data-toggle=\"modal\" id=\"Act^".
									$row['NO_CLIENTE'] ."^".
									$row['RFC_EMP'] ."^".
									$row['NOMBRE_C'] ."^".
									$row['APP_PATERNO_C'] ."^".
									$row['APP_MATERNO_C'] ."^".
									$row['TELEFONO_OFI'] ."^".
									$row['TELEFONO_CELL'] ."^".
									$row['OBSERVACIONES'] ."^".
									$row['EMAIL'] ."^".
									$row['HOR1'] ."^".
									$row['HOR2'] ."^".
									$row['HOR3'] ."^".
									$row['HOR4'] ."^".
									"\"><i class='fa fa-pencil' aria-hidden='true'>&nbsp; Modificar</i></a> " . " </th>";
						echo "</tr>";
						echo "</tbody>";
					}	
					?>
				</tbody>
			</table>
		</div>  
		<script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/ajax_contactos_morales.js"></script>
		
		
			
		<?php			 
		 }
		 public function saveClientMoralContacto($POST=''){
			 // require('../bd/bd.php');
		     $db = new DbCnnx();
			 
			  $no_cliente=$POST["NO_CLIENTE"];;
			  $rfc=$POST["RFC_EMP"];
			  $nombre=$POST["NOMBRE_C"];
			  $ap_paterno=$POST["APP_PATERNO_C"];
			  $ap_materno=$POST["APP_MATERNO_C"];
			  $tel_oficina=$POST["TELEFONO_OFI"];
			  $tel_celular=$POST["TELEFONO_CELL"];
			  $observaciones=$POST["OBSERVACIONES"];
			  $email=$POST["EMAIL"];
			  $hora1=$POST["HOR1"];
			  $hora2=$POST["HOR2"];
			  $hora3=$POST["HOR3"];
			  $hora4=$POST["HOR4"];

			  $SQL_insert_contacto = sprintf("INSERT INTO contactos (NO_CLIENTE, NOMBRE_C,APP_PATERNO_C,APP_MATERNO_C,EMAIL,HORARIO_ATENCION,HOR1,HOR2,HORARIO_ATENCION2,HOR3,HOR4,TELEFONO_OFI,TELEFONO_CELL,OBSERVACIONES, RFC_EMP)
			  VALUES ('$no_cliente', '$nombre', '$ap_paterno', '$ap_materno', '$email','$hora1 A $hora2','$hora1','$hora2','$hora3 A $hora4','$hora3','$hora4', '$tel_oficina', '$tel_celular', '$observaciones', '$rfc')");
			
			  $rec = $db->query($SQL_insert_contacto);
			 
		 }
		 
		  public function updateClientMoralContacto($POST=''){
			  
			  // require('../bd/bd.php');
		      $db = new DbCnnx();

			  $no_cliente_auxiliar=$POST["NO_CLIENTE_AUXILIAR"];//estas variable la ocupo de auxiliares para poder actualizar
			  $nombre_auxiliar=$POST["NOMBRE_C_AUXILIAR"];//estas variable la ocupo de auxiliares para poder actualizar

			  $no_cliente=$POST["NO_CLIENTE_AUXILIAR"];
			  $rfc=$POST["RFC_EMP"];
			  $nombre=$POST["NOMBRE_C"];
			  $ap_paterno=$POST["APP_PATERNO_C"];
			  $ap_materno=$POST["APP_MATERNO_C"];
			  $tel_oficina=$POST["TELEFONO_OFI"];
			  $tel_celular=$POST["TELEFONO_CELL"];
			  $observaciones=$POST["OBSERVACIONES"];
			  $email=$POST["EMAIL"];
			  $hora1=$POST["HOR1"];
			  $hora2=$POST["HOR2"];
			  $hora3=$POST["HOR3"];
			  $hora4=$POST["HOR4"];
			  
			  $SQL_update_contacto ="UPDATE  contactos set  NO_CLIENTE=('$no_cliente'),NOMBRE_C=('$nombre'), APP_PATERNO_C=('$ap_paterno'), APP_MATERNO_C=('$ap_materno'), EMAIL=('$email'),
			  TELEFONO_OFI=('$tel_oficina'), TELEFONO_CELL=('$tel_celular'), OBSERVACIONES=('$observaciones'), HORARIO_ATENCION=('$hora1 A $hora2'),HOR1=('$hora1'),HOR2=('$hora2'),
			  HORARIO_ATENCION2=('$hora3 A $hora4'),HOR3=('$hora3'),HOR4=('$hora4'), RFC_EMP=('$rfc')
			  where NO_CLIENTE=('$no_cliente_auxiliar') AND NOMBRE_C=('$nombre_auxiliar')";
			
			  $rec = $db->query($SQL_update_contacto);
			  
					  //REALIZAMOS LA CONSULTA PARA PODER MOSTRAR LOS DATOS EN LA TABLA
							@$SQL_consulta = sprintf("SELECT *
							FROM empresas AS emp 
							inner join contactos as con 
							on emp.no_cliente=con.no_cliente 
							where emp.no_cliente='$no_cliente'");
							
							@$rec = $db->combo(@$SQL_consulta);
							
							?>
							<div class="table-responsive">
								<table  class="table table-hover table-responsive table-bordered">
									<thead>
										<tr>
											<th data-field="id_empresa">NO. CLIENTE</th>
											<th data-field="id_empresa">NOMBRE</th>
											<th data-field="id_empresa">AP.PATERNO</th>
											<th data-field="id_empresa">AP.MATERNO</th>
											<th data-field="id_empresa">EMAIL</th>
											<th data-field="id_empresa">TEL&Eacute;FONO OF.</th>
											<th data-field="id_empresa">TEL&Eacute;FONO CEL.</th>
											<th data-field="id_empresa">MODIFICAR</th>
										</tr>
									</thead>
								<tbody>
									<?php
									
									while ($row = @$rec->fetch_assoc()) {
										echo "<tr class='text-muted'>";
										echo "<th style=\"text-align:center;width: 1%;font-weight:normal;\">".$row['NO_CLIENTE']."</th>";
										echo "<th style=\"text-align:center;font-weight:normal;\">".$row['NOMBRE_C']."</th>";
										echo "<th style=\"text-align:center;font-weight:normal;\">".$row['APP_PATERNO_C']."</th>";
										echo "<th style=\"text-align:center;font-weight:normal;\">".$row['APP_MATERNO_C']."</th>";
										echo "<th style=\"text-align:center;font-weight:normal;\">".$row['EMAIL']."</th>";
										echo "<th style=\"text-align:center;font-weight:normal;\">".$row['TELEFONO_OFI']."</th>";
										echo "<th style=\"text-align:center;font-weight:normal;\">".$row['TELEFONO_CELL']."</th>";
										echo "<th style=\"text-align:center;width: 1%;\"><a href=\"#Modal_Actualizar_Contacto\" role=\"button\" class=\"btn btn-sm  btn-primary\" data-toggle=\"modal\" id=\"Act^".
													$row['NO_CLIENTE'] ."^".
													$row['RFC_EMP'] ."^".
													$row['NOMBRE_C'] ."^".
													$row['APP_PATERNO_C'] ."^".
													$row['APP_MATERNO_C'] ."^".
													$row['TELEFONO_OFI'] ."^".
													$row['TELEFONO_CELL'] ."^".
													$row['OBSERVACIONES'] ."^".
													$row['EMAIL'] ."^".
													$row['HOR1'] ."^".
													$row['HOR2'] ."^".
													$row['HOR3'] ."^".
													$row['HOR4'] ."^".
													"\"><i class='fa fa-pencil' aria-hidden='true'>&nbsp; Modificar</i></a> " . " </th>";
										echo "</tr>";
										echo "</tbody>";
									}	
									?>
								</tbody>
							</table>
						</div> <?php 
			 
		 }
		 
		public function searchClient($POST=''){
		  require('../bd/bd.php');
		$db = new DbCnnx();
		
		@$rfc=$POST;
			if(empty($rfc))
			{
				echo"<script language='JavaScript' type='text/JavaScript'>
					  alert('Por favor ingresa algun dato')
					   window.location='searchClient'
					</script>
				   ";
				 exit();
			}
				
				$SQL = sprintf("select emp.RFC,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.RAZON_SOCIAL,emp.NO_CLIENTE,emp.NRA,emp.CALLE,emp.NUM_EXT,emp.NUM_INT,
				emp.COLONIA,emp.DEL_MPIO,emp.ESTADO,emp.CP,emp.ZONA,emp.REFERENCIA,emp.ENTRE_CALLE1,emp.ENTRE_CALLE2,emp.LATITUD,emp.LONGITUD,emp.GIRO,emp.NO_CTA_CON
				,con.NO_CLIENTE,con.NOMBRE_C,con.APP_PATERNO_C,con.APP_MATERNO_C,con.EMAIL,con.TELEFONO_OFI,con.TELEFONO_CELL,con.HOR1,con.HOR2,con.HORARIO_ATENCION,
				con.HOR3,con.HOR4,con.HORARIO_ATENCION2,con.OBSERVACIONES,emp.ID_PAGO,emp.ID_ALTA_SUCURSAL
				 from empresas as emp
				 inner join contactos as con
				 on emp.NO_CLIENTE=con.NO_CLIENTE
				where emp.no_cliente=con.no_cliente and emp.RFC= con.rfc_emp and emp.NO_CLIENTE='$rfc'");
				
				$rec = $db->combo($SQL);
				

			$registro=$rec;
			if(!$registro)
			{
				 echo"<script language='JavaScript' type='text/JavaScript'>
						   alert($registro)
				   window.location='searchClient.php'
				 </script>
				   ";
			}
			 else
			 {

				while ($row = $rec->fetch_assoc()) {
					$datos = (object) $row;
					$QuerySearchId = "select * from pago where id_pago=$datos->ID_PAGO";
					$recSearchId = $db->combo($QuerySearchId);
					while ($rowSub = $recSearchId->fetch_assoc()) {
						$subDatos = (object) $rowSub;
					}
					$datos = (object) array_merge( (array) $datos, (array) $subDatos);
					// echo"<br>";
					// print_r($datos);
					if($datos->ID_ALTA_SUCURSAL!=''){
						$QuerySearchIdSucu = "select nombre as NameSucursal from alta_sucursal where ID_ALTA_SUCURSAL=$datos->ID_ALTA_SUCURSAL";
						$recSearchIdSucu = $db->combo($QuerySearchIdSucu);
						while ($rowSubSucu = $recSearchIdSucu->fetch_assoc()) {
							$subDatosSucu = (object) $rowSubSucu;
						}
						$datos = (object) array_merge( (array) $datos, (array) $subDatosSucu);
						// print_r($datos);
					}
					
				}

				  if(!@$datos->RFC)
				  {
				   echo"<script language='JavaScript' type='text/JavaScript'>
						   alert('LA CLAVE NO EXISTE')
					   window.location='searchClient.php'
					 </script>
					   ";
					 exit();
				  }
			 }
			
			?>
				<!--Funciones JavaScript para pasar la direccion a ventanas modales-->
				<script type = "text/javascript">
				//Funcion para persona Moral
				function funcionPasar() {

				var estadoM = document.getElementById('estadoMo').value;
				var localidadM = document.getElementById('localidadMo').value;
				var municipioM = document.getElementById("municipioMo").value;
				var codigoM = document.getElementById("cpMo").value
				//   document.getElementById('address').value= municipio.toString()+(",")+localidad.toString()+(",")+calle.toString();

				document.getElementById('addressMo').value= localidadM.toString()+(",")+(" ")+municipioM.toString()+(",")+(" ")+estadoM.toString()+(" ")+codigoM.toString();
				}
				//Funcion para persona fisica
				function funcionPasarFisica() {

				var estado = document.getElementById('estadoFi').value;
				var localidad = document.getElementById('localidadFi').value;
				var municipio = document.getElementById("municipioFi").value;
				var codigo = document.getElementById("cpFi").value
				//   document.getElementById('address').value= municipio.toString()+(",")+localidad.toString()+(",")+calle.toString();

				document.getElementById('addressFi').value= localidad.toString()+(",")+(" ")+municipio.toString()+(",")+(" ")+estado.toString()+(" ")+codigo.toString();
				}
				</script>
				<!--Terminan funciones para pasar direccion-->
				<!--Funcion para cargar la ventana modal con condicional dependiendo de tipo de persona-->
				<script>
				$(function(){

				$('body').click(function(evt){

				var IdBotones = evt.target.id
				var Prefijo = IdBotones.substring(0, 3);

			//En este if se cargan los datos de la persona moral
				if (Prefijo == "MOL"){

					 var arr = IdBotones.split('^');
			//Arreglo que se envia desde desde la cosulta de php para persona moral
					 var strno_cliente= arr[1] ;
					 var strRFC = arr[2] ;
					 var strNombre = arr[4] ;
					 var strRazon = arr[3] ;
					 var strappaterno = arr[5] ;
					 var strapmaterno = arr[6] ;
					 var strtel_ofi = arr[7] ;
					 var strtel_cell= arr[8] ;
					 var strobs = arr[9] ;
					 var stremail = arr[10] ;
					 var strhora= arr[11] ;
					 var strhora2= arr[12] ;
					 var strhora3= arr[13] ;
					 var strhora4= arr[14] ;
					 var strnra = arr[15] ;
					 var strno_ctaMo = arr[16] ;
					 var strgiroMo = arr[17] ;
					 var strzona = arr[18] ;
					 var strestado = arr[19] ;
					 var strmunicipio = arr[20] ;
					 var strcp = arr[21] ;
					 var strcolonia = arr[22] ;
					 var strcalle = arr[23] ;
					 var strnumext = arr[24] ;
					 var strnumint = arr[25] ;
					 var strreferencia = arr[26] ;
					 var strlatitud = arr[27];
					 var strlongitud = arr[28];
					 var medioPagoMo = arr[30];
					 var tipoPagoMo = arr[29];
					 var nameSucursal = arr[31];
					 var ID_PagoHidden = arr[32];
					 var entre_calle1Mo = arr[33];
					 var entre_calle2Mo = arr[34];
			//Se carga a los id de de los div de la ventana de la persona moral
					 $('#rfcMo').val(strRFC);
					 $('#nombreMo').val(strNombre);
					 $('#razonMo').val(strRazon);
					 $('#app_paternoMo').val(strappaterno);
					 $('#app_maternoMo').val(strapmaterno);
					 $('#no_clienteMo').val(strno_cliente);
					 $('#txtteloficinaMo').val(strtel_ofi);
					 $('#txttelCelularMo').val(strtel_cell);
					 $('#txtobservaMo').val(strobs);
					 $('#txtcorreoMo').val(stremail);
					 $('#HORACT1Mo').val(strhora);
					 $('#HORACT2Mo').val(strhora2);
					 $('#HORACT3Mo').val(strhora3);
					 $('#HORACT4Mo').val(strhora4);
					 $('#no_cta_Mo').val(strno_ctaMo);
					 $('#giroMo').val(strgiroMo);
					 $('#nraMo').val(strnra);
					 $('#zonaMo').val(strzona);
					 $('#txtsucursalMo').val(nameSucursal).change();
					 $('#txtmedioPagoMo').val(medioPagoMo).change();
					 $('#txtmetodoPagoMo').val(tipoPagoMo).change();
					 $('#estadoMo').val(strestado).change();
					  setTimeout(function (){$('#municipioMo').val(strmunicipio).change()},1800) ;
					  setTimeout(function (){$('#cpMo').val(strcp).change()},3300) ;
					  setTimeout(function (){$('#localidadMo').val(strcolonia).change()},4800) ;
					 $('#calleMo').val(strcalle);
					 $('#num_extMo').val(strnumext);
					 $('#num_intMo').val(strnumint);
					 $('#referenciaMo').val(strreferencia);
					 $('#txtentrecalle1Mo').val(entre_calle1Mo);
					 $('#txtentrecalle2Mo').val(entre_calle2Mo);
					 $('#latitudMo1').val(strlatitud);
					 $('#longitudMo1').val(strlongitud);
					 $('#rfcRESPALDOMo').val(strRFC);
					 $('#numeroRESPALDOMo').val(strno_cliente);
					 $('#txtIdPagoMo').val(ID_PagoHidden);
				}

			//En este elseif se cargan los datos de la persona fisica
					else if (Prefijo == "Fsc") {
			//Arreglo que devuelve la la consulta php
							  var arr = IdBotones.split('^');
							  var strno_clienteFi= arr[1] ;
							  var strRFCFi = arr[2] ;
							  var strNombreFi = arr[3] ;
							  var strappaternoFi = arr[4] ;
							  var strapmaternoFi = arr[5] ;
							  var strtel_ofiFi = arr[6] ;
							  var strtel_cellFi = arr[7] ;
							  var strobsFi = arr[8] ;
							  var stremailFi = arr[9] ;
							  var strhoraFi = arr[10] ;
							  var strhora2Fi = arr[11] ;
							  var strhora3Fi = arr[12] ;
							  var strhora4Fi = arr[13] ;
							  var strnraFi = arr[14] ;
							  var strno_ctaFi = arr[15] ;
							  var strgiroFi = arr[16] ;
							  var strzonaFi = arr[17] ;
							  var strestadoFi = arr[18] ;
							  var strmunicipioFi = arr[19] ;
							  var strcpFi = arr[20] ;
							  var strcoloniaFi = arr[21] ;
							  var strcalleFi = arr[22] ;
							  var strnumextFi = arr[23] ;
							  var strnumintFi = arr[24] ;
							  var strreferenciaFi = arr[25] ;
							  var strlatitudFi = arr[26];
							  var strlongitudFi = arr[27];
							  var medioPagoFi = arr[29];
							  var tipoPagoFi = arr[28];
							  var nameSucursalFi = arr[30];
							  var ID_PagoHiddenFi = arr[31];
							  var entre_calle1Fi = arr[32];
					          var entre_calle2Fi = arr[33];
							  // alert(medioPagoFi);
							  // alert(nameSucursalFi);
							  // alert(ID_PagoHiddenFi);

			//Se cargan a los elementos HTML por id de la ventana modal de persona fisica
							  $('#rfcFi').val(strRFCFi);
							  $('#nombreFi').val(strNombreFi);
							  $('#app_paternoFi').val(strappaternoFi);
							  $('#app_maternoFi').val(strapmaternoFi);
							  $('#no_clienteFi').val(strno_clienteFi);
							  $('#txtteloficinaFi').val(strtel_ofiFi);
							  $('#txttelCelularFi').val(strtel_cellFi);
							  $('#txtobservaFi').val(strobsFi);
							  $('#txtcorreoFi').val(stremailFi);
							  $('#HORACT1Fi').val(strhoraFi);
							  $('#HORACT2Fi').val(strhora2Fi);
							  $('#HORACT3Fi').val(strhora3Fi);
							  $('#HORACT4Fi').val(strhora4Fi);
							  $('#nraFi').val(strnraFi);
							  $('#no_cta_Fi').val(strno_ctaFi);
							  $('#giroFi').val(strgiroFi);
							  $('#zonaFi').val(strzonaFi);
							  $('#txtsucursalFi').val(nameSucursalFi).change();
							  $('#txtmedioPagoFi').val(medioPagoFi).change();
							  $('#txtmetodoPagoFi').val(tipoPagoFi).change();
							  $('#estadoFi').val(strestadoFi).change();
							   setTimeout(function (){$('#municipioFi').val(strmunicipioFi).change()},1800) ;
							   setTimeout(function (){$('#cpFi').val(strcpFi).change()},3300) ;
							   setTimeout(function (){$('#localidadFi').val(strcoloniaFi).change()},4800) ;
							  $('#calleFi').val(strcalleFi);
							  $('#num_extFi').val(strnumextFi);
							  $('#num_intFi').val(strnumintFi);
							  $('#referenciaFi').val(strreferenciaFi);
							  $('#txtentrecalle1Fi').val(entre_calle1Fi);
					          $('#txtentrecalle2Fi').val(entre_calle2Fi);
							  $('#rfcRESPALDOFi').val(strRFCFi);
							  $('#latitudF').val(strlatitudFi);
							  $('#longitudF').val(strlongitudFi);
							  $('#rfcRESPALDOFi').val(strRFCFi);
							  $('#numeroRESPALDOF').val(strno_clienteFi);
							  $('#txtIdPagoFi').val(ID_PagoHiddenFi);

				}

							  else if (IdBotones == "guardar"){
							  }
						});

				});
				</script>
							<!--div class="modal inmodal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"><?php // echo utf8_encode(@$datos->NOMBRE)?> <?php// echo utf8_encode(@$datos->APP_PATERNO)?> <?php// echo utf8_encode(@$datos->APP_MATERNO)?></h4>                                  
                                        </div>
                                        <div class="modal-body"-->
											<style>
											.alert-message
												{
													margin: 20px 0;
													padding: 20px;
													border-left: 3px solid #eee;
												}
												.alert-message h4
												{
													margin-top: 0;
													margin-bottom: 5px;
												}
												.alert-message p:last-child
												{
													margin-bottom: 0;
												}
												.alert-message code
												{
													background-color: #fff;
													border-radius: 3px;
												}
												.alert-message-success
												{
													background-color: #F4FDF0;
													border-color: #3C763D;
												}
												.alert-message-success h4
												{
													color: #3C763D;
													margin-top: -15px;
													margin-bottom: 20px;
												}

											</style>
											
											<div class="col-sm-6 col-md-6">
												<div class="alert-message alert-message-success">
													<h4>CLIENTE</h4>
														
															<ul class="list-group">
																<li class="list-group-item" style="height:32px;">
																	<span class="badge badge-default" style="margin-top:-3px;"><?php echo @$datos->NO_CLIENTE?></span>
																	<span class="pull-left" style="margin-top:-5px;"><strong>NO. CLIENTE:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<span class="pull-right" style="margin-top:-3px;"><?php echo @$datos->NameSucursal?></span>
																	<span class="pull-left" style="margin-top:-5px;"><strong>SUCURSAL:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><label name="razon_social" id="razon_social" class="text-primary"><?php echo @$datos->RAZON_SOCIAL?> <?php echo utf8_encode(@$datos->NOMBRE)?> <?php echo utf8_encode(@$datos->APP_PATERNO)?> <?php echo utf8_encode(@$datos->APP_MATERNO)?> </label></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>NOMBRE:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->RFC?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>RFC:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo utf8_encode(@$datos->GIRO)?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>GIRO:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->NRA?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>N&Uacute;MERO DE REGISTRO AMBIENTAL:</strong></span>
																</li>
																<?php if($datos->NO_CTA_CON=="NA"){

																}else{?>
																	<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->NO_CTA_CON?></small>
																	<span class="pull-left small" style="margin-top:-3px;"><strong>N&Uacute;MERO DE CUENTA CONCENTRADORA:</strong></span>
																	</li><?php
																}?>
																
																<li class="list-group-item" style="height:60px;">
																	<span class="pull-left" style="margin-top:-5px;"><strong>DIRECCI&Oacute;N:</strong></span>
																	<small class="pull-right small"><?php echo @$datos->ESTADO ?> <?php echo @$datos->DEL_MPIO ?> <?php echo @$datos->COLONIA ?> <?php echo @$datos->CALLE ?> CP. <?php echo @$datos->CP ?></small>																	
																</li>
																<li class="list-group-item" style="height:32px;">
																	<div class="col-xs-6">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->NUM_EXT?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>NO. EXT:</strong></span>
																	</div>
																	<div class="col-xs-6">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->NUM_INT?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>NO. INT:</strong></span>
																	</div>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo utf8_encode(@$datos->REFERENCIA)?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>REFERENCIA:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo utf8_encode(@$datos->ENTRE_CALLE1)?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>ENTRE CALLE 1:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo utf8_encode(@$datos->ENTRE_CALLE2)?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>ENTRE CALLE 2:</strong></span>
																</li>
															</ul>															
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="alert-message alert-message-success">
													<h4>CONTACTO</h4>
														
															<ul class="list-group">
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right small badge badge-default" style="margin-top:-3px;"><?php echo utf8_encode(@$datos->NOMBRE_C)?> <?php echo utf8_encode(@$datos->APP_PATERNO_C)?> <?php echo utf8_encode(@$datos->APP_MATERNO_C)?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>NOMBRE:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->TELEFONO_OFI?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>TEL&Eacute;FONO OFICINA:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->TELEFONO_CELL?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>TEL&Eacute;FONO CELULAR:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->EMAIL?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>EMAIL:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->HORARIO_ATENCION?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>HORARIO DE ATENCI&Oacute;N 1:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->HORARIO_ATENCION2?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>HORARIO DE ATENCI&Oacute;N 2:</strong></span>
																</li>																						
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->OBSERVACIONES?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>OBSERVACIONES:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->MEDIO_DE_PAGO?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>MEDIO DE PAGO:</strong></span>
																</li>
																<li class="list-group-item" style="height:32px;">
																	<small class="pull-right" style="margin-top:-3px;"><?php echo @$datos->TIPO_DE_PAGO?></small>
																	<span class="pull-left" style="margin-top:-5px;"><strong>MÉTODO DE PAGO:</strong></span>
																</li>
																
															</ul>															
												</div>
											</div>
                                            										
											
                                        <!--/div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div-->
								

							<?php
								/**
								Si la cadena tiene una longitud de  13 caracteres se pasa el array a la funcion javascript con el
								prefijo FSC, que posteriormente cargara los datos en los elementos HTML correspondientes
								**/
									if(strlen(@$datos->RFC)==13)
									{
									  $Table ="";
									  $Table = $Table . "
										<label data-field=\"name\" data-switchable=\"false\" style=\"margin-top:margin-top:-12px;margin-left:0px\">" .
										" <div align=\"center\">
										<a href=\"#ventanaFisica\" role=\"button\" class=\"btn btn-sm  btn-primary \" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" id=\"Fsc^".
										$datos->NO_CLIENTE ."^".
										$datos->RFC ."^".
										$datos->NOMBRE ."^".
										$datos->APP_PATERNO ."^".
												 $datos->APP_MATERNO ."^".

												  $datos->TELEFONO_OFI ."^".
												  $datos->TELEFONO_CELL ."^".
												  $datos->OBSERVACIONES ."^".
												  $datos->EMAIL ."^".
												  $datos->HOR1 ."^".
												  $datos->HOR2 ."^".
												  $datos->HOR3 ."^".
												  $datos->HOR4 ."^".

												  $datos->NRA ."^".
												  $datos->NO_CTA_CON ."^".
												  $datos->GIRO ."^".
												  $datos->ZONA ."^".
												  $datos->ESTADO ."^".
												  $datos->DEL_MPIO ."^".
												  $datos->CP ."^".
												  $datos->COLONIA ."^".
												  $datos->CALLE ."^".
												  $datos->NUM_EXT ."^".
												  $datos->NUM_INT ."^".
												  $datos->REFERENCIA ."^".
												  $datos->LATITUD ."^".
												  $datos->LONGITUD ."^".
												  $datos->TIPO_DE_PAGO ."^".
												  $datos->MEDIO_DE_PAGO ."^".
												  $datos->NameSucursal ."^".
												  $datos->ID_PAGO ."^".
												  $datos->ENTRE_CALLE1 ."^".
												  $datos->ENTRE_CALLE2 ."^"."\">MODIFICAR</a> </label></div>";



									}
									/**
									Si la cadena tiene una longitud de  12 caracteres se pasa el array a la funcion javascript con el
									prefijo MOL, que posteriormente cargara los datos en los elementos HTML correspondientes
									**/

									elseif(strlen(@$datos->RFC)==12){

									  $Table ="";
									  $Table = $Table . "

													<label data-field=\"name\" data-switchable=\"false\" style=\"margin-top:margin-top:-12px;margin-left:0px\">" .
													" <div align=\"center\">
													<a href=\"#ventanaMoral\" role=\"button\" class=\"btn btn-sm  btn-primary \" data-backdrop=\"static\" data-keyboard=\"false\" data-toggle=\"modal\" id=\"MOL^".

												  $datos->NO_CLIENTE ."^".
												  $datos->RFC."^".
												  $datos->RAZON_SOCIAL ."^".
												  $datos->NOMBRE_C ."^".
												  $datos->APP_PATERNO_C ."^".
												  $datos->APP_MATERNO_C ."^".

												  $datos->TELEFONO_OFI ."^".
												  $datos->TELEFONO_CELL ."^".
												  $datos->OBSERVACIONES ."^".
												  $datos->EMAIL ."^".
												  $datos->HOR1 ."^".
												  $datos->HOR2 ."^".
												  $datos->HOR3 ."^".
												  $datos->HOR4 ."^".


												  $datos->NRA ."^".
												  $datos->NO_CTA_CON ."^".
												  $datos->GIRO ."^".
												  $datos->ZONA ."^".
												  $datos->ESTADO ."^".
												  $datos->DEL_MPIO ."^".
												  $datos->CP ."^".
												  $datos->COLONIA ."^".
												  $datos->CALLE ."^".
												  $datos->NUM_EXT ."^".
												  $datos->NUM_INT ."^".
												  $datos->REFERENCIA ."^".
												  $datos->LATITUD ."^".
												  $datos->LONGITUD ."^".
												  $datos->TIPO_DE_PAGO ."^".
												  $datos->MEDIO_DE_PAGO ."^".
												  $datos->NameSucursal ."^".
												  $datos->ID_PAGO ."^".
												  $datos->ENTRE_CALLE1 ."^".
												  $datos->ENTRE_CALLE2 ."^"."\">MODIFICAR</a> </label></div>";


										}

									  //Aqui se imprime el boton de Actualizar independiente del tipo de persona
										  echo $Table;
										  // print_r($datos);

										?>
										<script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/loadDatos.js"></script>
										<script type="text/javascript" src="../web/js/HelperJs/scripts/registro_clientes/loadDatosMoral.js"></script>
									<!--Termina la consulta del boton Actualizar y del script php-->	
										<!--Aqui inicia la venta modal de la persona moral-->
										
											<div class="modal fade in" id="ventanaMoral" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content animated fadeInDown" style="width:620px;">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
															<h4 class="modal-title" id="NARANJA">DATOS</h4>
														</div>

															<div class="modal-body">
																	<div class="bs-example tabs-container with-nav-tabs panel-success">
																		<ul class="nav nav-pills nav-tabs" style="margin-top:-18px;">
																			<li class="active"><a data-toggle="tab" href="#sectionA">Datos Fiscales</a></li>
																			<li><a data-toggle="tab" href="#sectionB">Domicilio</a></li>
																			<li><a data-toggle="tab" href="#sectionC" id="search" value="Buscar" onclick="funcionPasar(); buscarCoordenadasMoralOriginal()">Ubicaci&oacute;n Mapa</a></li>
																			<!--li><a data-toggle="tab" href="#pago" onclick="validarCampos()">Pago</a></li-->
																		</ul>
																		<div class="tab-content">
																			<div id="sectionA" class="tab-pane in active"><!--EMPIEZAA 11111111111111 EL PRIMER TAB-->
																			<form name='form1' id='form1' method="post" class="form-horizontal" action="modificar_empresa_moral2.php" >

																						   
																						   <label style="margin-top:3%;margin-left:-52%;">N&Uacute;MERO DE CLIENTE:</label>
																						   <input type="text" class="form-control no_clienteMo" readonly style="margin-top:-6%;width:50%;margin-left:40%;" id="no_clienteMo" name="no_clienteMo" maxlength="12" onkeyup="javascript:this.value=this.value.toUpperCase();">
																							
																							<label style="margin-top:3%;margin-left:-46%;">MEDIO DE PAGO:</label>
																							<div style="margin-top:-6%;width:50%;margin-left:40%;">
																								<select id="txtmedioPagoMo" name="txtmedioPagoMo" class="selectSearch form-control txtmedioPagoMo" style="width:100%;">
																									<option value="">SELECCIONA...</option>																							
																									<option value="FACTURA">FACTURA</option>
																									<option value="NOTA">NOTA</option>
																								</select>
																							</div>
																							
																							<label style="margin-top:3%;margin-left:-48%;">MÉTODO DE PAGO:</label>
																							<div style="margin-top:-6%;width:50%;margin-left:40%;">
																								<select id="txtmetodoPagoMo" name="txtmetodoPagoMo" class="selectSearch form-control txtmetodoPagoMo" style="width:100%;">
																									<option value="">SELECCIONA...</option>
																									<option value="EFECTIVO">EFECTIVO</option>
																									<option value="DEPOSITO">DEPOSITO</option>
																									<option value="CHEQUE">CHEQUE</option>
																									<option value="TRANSFERENCIA">TRANSFERENCIA</option>
																									<option value="TARJETA DIRECTO">TARJETA DIRECTO</option>
																									<optgroup label="TARJETA" class="text-muted">																						
																										<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3</option>
																										<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6</option>
																										<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9</option>
																										<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;12</option>
																										
																									</optgroup>
																								</select>
																							</div>
																							<input type="text" name="txtIdPagoMo" id="txtIdPagoMo" style="display:none;"  class="form-control txtIdPagoMo" value="" />	
																							
																						   <label style="margin-top:3%;margin-left:-30%;">RFC:</label>
																						   <input type="text" class="form-control rfcMo"  style="margin-top:-6%;width:50%;margin-left:40%;" id="rfcMo" name="rfcMo" onkeyup="javascript:this.value=this.value.toUpperCase();">

																						   <label style="margin-top:3%;margin-left:-44%;">RAZ&Oacute;N SOCIAL:</label>
																						   <input type="text" class="form-control razonMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="razonMo" name="razonMo" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">

																						   <label class="text-success" style="margin-top:3%;margin-left:-10%;"id="NARANJA">DATOS DE CONTACTO</label><br>
																						   <label style="margin-top:3%;margin-left:-35%;">NOMBRE:</label>
																						   <input type="text" class="form-control nombreMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="nombreMo" name="nombreMo" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">

																						   <label style="margin-top:3%;margin-left:-50%;">APELLIDO PATERNO:</label>
																						   <input type="text" class="form-control app_paternoMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="app_paternoMo" name="app_paternoMo" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">

																						   <label style="margin-top:3%;margin-left:-50%;">APELLIDO MATERNO:</label>
																						   <input type="text" class="form-control app_maternoMo"  style="margin-top:-6%;width:50%;margin-left:40%;" id="app_maternoMo" name="app_maternoMo" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">

																						   <label style="margin-top:3%;margin-left:-50%;">TEL&Eacute;FONO OFICINA:</label>
																						   <input type="text" class="form-control txtteloficinaMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="txtteloficinaMo" name="txtteloficinaMo" onkeydown="return validarNumeros(event)">

																						   <label style="margin-top:3%;margin-left:-50%;">TEL&Eacute;FONO CELULAR:</label>
																						   <input type="text" class="form-control txttelCelularMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="txttelCelularMo" name="txttelCelularMo" onkeydown="return validarNumeros(event)">

																						   <label style="margin-top:3%;margin-left:-45%;">OBSERVACIONES:</label>
																						   <input type="text" class="form-control txtobservaMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="txtobservaMo" name="txtobservaMo" onkeyup="javascript:this.value=this.value.toUpperCase();"  >

																						   <label style="margin-top:3%;margin-left:-33%;">EMAIL:</label>
																						   <input type="email" class="form-control txtcorreoMo" style="margin-top:-6%;width:50%;margin-left:40%;" id="txtcorreoMo" name="txtcorreoMo" >

																						   <label style="margin-top:3%;margin-left:-53%;">HORARIO DE ATENCI&Oacute;N 1:</label>
																						   <select  id="HORACT1Mo" name="HORACT1Mo" class="form-control  HORACT1Mo"  style="margin-top:-6%;width:23%;margin-left:40%;">
																								<option value="">SELECCIONE</option>
																								<option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																								<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																								<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																								<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																								<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																								<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																								<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																								<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																								<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																								<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>

																							</select>

																							 <select  id="HORACT2Mo" name="HORACT2Mo" class="form-control HORACT2Mo" style="margin-top:-6%;width:23%;margin-left:68%;">
																							   <option value="">SELECCIONE</option>
																							   <option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																								<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																								<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																								<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																								<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																								<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																								<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																								<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																								<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																								<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>
																							 </select>

																							  <label style="margin-top:3%;margin-left:-53%;">HORARIO DE ATENCI&Oacute;N 2:</label>
																						   <select  id="HORACT3Mo" name="HORACT3Mo" class="form-control  HORACT3Mo"  style="margin-top:-6%;width:23%;margin-left:40%;">
																								<option value="">SELECCIONE</option>
																								<option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																								<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																								<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																								<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																								<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																								<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																								<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																								<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																								<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																								<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>

																							</select>

																							 <select  id="HORACT4Mo" name="HORACT4Mo" class="form-control HORACT4Mo" style="margin-top:-6%;width:23%;margin-left:68%;">
																							  <option value="">SELECCIONE</option>
																							   <option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																								<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																								<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																								<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																								<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																								<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																								<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																								<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																								<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																								<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>
																							 </select>

																						   <input type="text" class="form-control rfcRESPALDOMo"  style="display:none;" id="rfcRESPALDOMo" name="rfcRESPALDOMo" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();">
																						   <input type="text" class="form-control numeroRESPALDOMo"  style="display:none;"  id="numeroRESPALDOMo" name="numeroRESPALDOMo" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">
																						
																			  </div><!--TERMINA EL 11111111111111111 PRIMER TAB-->


																			<div id="sectionB" class="tab-pane "><!--EMPIEZAA 2222222 EL SEGUNDO TAB-->
																						<br>
																						
																							<label style="margin-top:3%;margin-left:-21%;">SUCURSAL:</label>
																							<div style="margin-top:-6%;width:50%;margin-left:50%;">
																									<select id="txtsucursalMo" name="txtsucursalMo" class="selectSearch form-control txtsucursalMo" style="width:100%;">
																										<option value="">SELECCIONA...</option>
																										<option value="TOLUCA">TOLUCA</option>
																										<option value="ATLACOMULCO">ATLACOMULCO</option>
																										<option value="CDMX">CDMX</option>
																									</select>
																									<span class="fa fa-plus col-xs-1" data-toggle="modal" data-target="#myModalSucursal" style="margin-left:100%;margin-top:-8%;cursor:pointer;z-index:100;vertical-align: middle;"></span>
																							</div>
																						
																						  <label style="margin-top:3%;margin-left:-50%;">N&Uacute;MERO DE REGISTRO AMBIENTAL:</label>
																						  <input type="text" class="form-control nraMo" style="margin-top:-6%;width:50%;margin-left:50%;" id="nraMo" name="nraMo" onkeyup="javascript:this.value=this.value.toUpperCase();" >

																						  <!--label style="margin-top:3%;margin-left:-50%;">NO. DE CUENTA CONCENTRADORA:</label-->
																						  <input type="text" class="form-control no_cta_Mo hidden" style="margin-top:-6%;width:50%;margin-left:50%;" id="no_cta_Mo" name="no_cta_Mo" onkeyup="javascript:this.value=this.value.toUpperCase();">

																						 <label style="margin-top:3%;margin-left:-15%;">GIRO:</label>
																							<select id="giroMo" name="giroMo" class="form-control giroMo" style="margin-top:-6%;width:50%;margin-left:50%;">
																							<option value="">SELECCIONA...</option>
																							<option value="CASA DE ASISTENCIA">CASA DE ASISTENCIA</option>
																							<option value="CENTRO M&Eacute;DICO">CENTRO M&Eacute;DICO</option>
																							<option value="CL&Iacute;NICA">CL&Iacute;NICA</option>
																							<option value="CONSULTORIO">CONSULTORIO</option>
																							<option value="EMPRESA">EMPRESA</option>
																							<option value="ESCUELA">ESCUELA</option>
																							<option value="FARMACIA">FARMACIA</option>
																							<option value="FUNERARIA">FUNERARIA</option>
																							<option value="HOSPITAL">HOSPITAL</option>
																							<option value="HOTEL">HOTEL</option>
																							<option value="LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS">LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS</option>
																							<option value="ODONTOLOG&Iacute;A">ODONTOLOG&Iacute;A</option>
																							<option value="POD&Oacute;LOGO">POD&Oacute;LOGO</option>
																							<option value="SANATORIO">SANATORIO</option>
																							<option value="TATUAJES Y PERFORACIONES">TATUAJES Y PERFORACIONES</option>  
																							<option value="TEXTIL">TEXTIL</option>
																							<option value="VETERINARIA">VETERINARIA</option>  
																							<option value="OTRO">OTRO</option>  
																						  </select>

																						 <label style="margin-top:3%;margin-left:-15%;">RUTA:</label>
																							 <select id="zonaMo" name="zonaMo" class="form-control zonaMo" style="margin-top:-6%;width:50%;margin-left:50%;">
																								 <option value="">SELECCIONA...</option>
																								   <option value="A">A</option>
																									<option value="B">B</option>
																									<option value="C">C</option>
																									<option value="D">D</option>
																									<option value="E">E</option>
																									<option value="F">F</option>
																									<option value="G">G</option>
																									<option value="H">H</option>
																									<option value="I">I</option>
																									<option value="J">J</option>
																									<option value="K">K</option>
																									<option value="L">L</option>
																									<option value="M">M</option>
																									<option value="N">N</option>
																									<option value="O">O</option>
																									<option value="P">P</option>
																									<option value="Q">Q</option>
																									<option value="R">R</option>
																									<option value="S">S</option>
																									<option value="T">T</option>
																									<option value="U">U</option>
																									<option value="V">V</option>
																									<option value="W">W</option>
																									<option value="X">X</option>
																									<option value="Y">Y</option>
																								  </select>

																						   <label style="margin-top:3%;margin-left:-18%;">ESTADO:</label>
																						   <div>  <div id="edos"><select name='estadoMo' id='estadoMo' style='margin-top:-6%; width:50%; margin-left: 50%;'  class='form-control estadoMo'>
																						   <option  value="" style="display:none">SELECCIONA...</option> </select> </div></div>

																						   <label style="margin-top:3%;margin-left:-21%;">MUNICIPIO:</label>
																						   <div><select  id="municipioMo" name="municipioMo" style="margin-top:-6%;width:50%;margin-left:50%;" class="form-control municipioMo"  ><option  value="" style="display:none">SELECCIONA...</option></select></div>

																						   <input type="text"  name="municipioMGuaMo" style="display:none;" id="municipioMGuaMo" onchange="mostrarValorMun(this.options[this.selectedIndex].innerHTML);" class="form-control municipioM" value="" />

																						   <label style="margin-top:3%;margin-left:-11%;">CP:</label>
																						   <div><select   id="cpMo" name="cpMo"  style="margin-top:-6%;width:50%;margin-left:50%;" class="form-control cpMo" ><option  value="" style="display:none">SELECCIONA...</option></select></div>

																						   <input type="text"  name="cpMGuaMo" id="cpMGuaMo" style="display:none;" onchange="mostrarValorCP(this.options[this.selectedIndex].innerHTML);" class="form-control cpMGuaMo" value="" />

																						   <label style="margin-top:3%;margin-left:-21%;">LOCALIDAD:</label>
																						   <div><select id="localidadMo" name="localidadMo"  style="margin-top:-6%;width:50%;margin-left:50%;" class="form-control localidadMo" ><option  value="" style="display:none">SELECCIONA...</option></select></div>

																						   <input type="text" name="localidadMGuaMo" id="localidadMGuaMo" style="display:none;" onchange="mostrarValorLOC(this.options[this.selectedIndex].innerHTML);" class="form-control localidadMGuaMo" value="" />

																						   <label style="margin-top:3%;margin-left:-14%;">CALLE:</label>
																						   <input type="text" class="form-control calleMo" style="margin-top:-6%;width:50%;margin-left:50%;" id="calleMo" name="calleMo" onkeyup="javascript:this.value=this.value.toUpperCase();">

																						   <label style="margin-top:3%;margin-left:-30%;">N&Uacute;MERO EXTERIOR:</label>
																						   <input type="text" class="form-control num_extMo" style="margin-top:-6%;width:50%;margin-left:50%;" id="num_extMo" name="num_extMo" onkeyup="javascript:this.value=this.value.toUpperCase();">

																						   <label style="margin-top:3%;margin-left:-30%;">N&Uacute;MERO INTERIOR:</label>
																						   <input type="text" class="form-control num_intMo" style="margin-top:-6%;width:50%;margin-left:50%;" id="num_intMo" name="num_intMo" onkeyup="javascript:this.value=this.value.toUpperCase();" >																						
																							
																							<label style="margin-top:3%;margin-left:-21%;">Entre Calle 1:</label>
																						   <input type="text" class="form-control txtentrecalle1Mo" style="margin-top:-6%;width:50%;margin-left:50%;" id="txtentrecalle1Mo" name="txtentrecalle1Mo" onkeyup="javascript:this.value=this.value.toUpperCase();" >
																							
																							<label style="margin-top:3%;margin-left:-21%;">Entre Calle 2:</label>
																						   <input type="text" class="form-control txtentrecalle2Mo" style="margin-top:-6%;width:50%;margin-left:50%;" id="txtentrecalle2Mo" name="txtentrecalle2Mo" onkeyup="javascript:this.value=this.value.toUpperCase();" >
																							
																						   <label style="margin-top:3%;margin-left:-21%;">REFERENCIA:</label>
																						   <input type="text" class="form-control referenciaMo" style="margin-top:-6%;width:50%;margin-left:50%;" id="referenciaMo" name="referenciaMo" onkeyup="javascript:this.value=this.value.toUpperCase();">

																						<!--<input type="submit" id="btnModificarFISICA" name="btnModificarFISICA"   class="btn btn-success btnModificarFISICA"  value="Mofificar"></div>-->
																			</div><!--TERMINA EL 2222222222222222 SEGUNDO TAB-->


																			<div id="sectionC" class="tab-pane "><!--EMPIEZAA EL 333333333333333 TERCER TAB-->

																			  <label style="margin-top:2%;margin-left:-1%;padding-bottom:15px;">ACTUALIZA LAS COORDENADAS MEDIANTE DIRECCI&Oacute;N &nbsp; &nbsp; <button type="button" class="btn btn-xs btn-default" id="buscarDMo" onclick="buscarDireccionMoral()">Buscar Direcci&oacute;n</button></label>
																		<div><input type="text"  maxlength="200" id="addressMo" placeholder="Dirección" style="margin-top:-1%; margin-left: 1%; width:100%"class="form-control addressMo"/>  </div><br>

																		<!--div style="margin-top:-3%; margin-left: 40%"><button type="button" class="btn btn-success" id="buscarDMo" onclick="buscarDireccionMoral()">Buscar Direcci&oacute;n</button></div-->

																		<label style="margin-top:3%;margin-left:-1%;padding-bottom:15px;">ACTUALIZA MEDIANTE LAS COORDENADAS &nbsp; &nbsp; <button type="button" class="btn btn-xs btn-default" id="buscarCMo" onclick="buscarCoordenadasMoralC()">Buscar Coordenadas</button></label><br>

																		<div style="margin-top:1%;margin-left:-78%;"><label>LATITUD:</label></div>
																		<div style="margin-top:-6%;margin-left:20%;"><input type="text" class="form-control latitudMo1" style="width:30%"  id="latitudMo1" name="latitudMo1"></div>

																		<div style="margin-left:18%; margin-top:-5%"> <label>LONGITUD:</label></div>
																		<input type="text" class="form-control longitudMo1" style="margin-top:-6%;width:25%;margin-left:68%;" id="longitudMo1" name="longitudMo1"><br>

																		<!--div style="margin-top:-2%; margin-left: 40%"><button type="button" class="btn btn-success" id="buscarCMo" onclick="buscarCoordenadasMoralC()">Buscar Coordenadas</button></div-->

																		<div id="map_canvasMoral" style="width:550px; height:250px;margin-top:2%;margin-left:1%;"></div>




																			</div><!--TERMINA EL TERCER 333333333 TAB-->
																			
																		</div>
																	</div>
															</div>

														<div class="modal-footer">
															<button type="button" class="btn btn-default" id="modalcerrar" data-dismiss="modal" style="margin-top:4px;">CERRAR</button>
															<button type="submit" id="btnModificarMoral" name="btnModificarMoral"  class="btn btn-primary">MODIFICAR</button>
														</div>
												</form>
													</div>
												</div>
											</div>
										
										<!--Aqui termina la venta modal de la persona moral-->
										
										
										
										
										<script>
											$(function(){
											 $("#btnModificarMoral").click(function(){
												 //alert( "olass" );
												
												 $( '.modal-backdrop.fade.in' ).remove();
												 $('body').removeClass('modal-open');
												 $("#ventanaMoral").modal("hide");
												 
												 $('.ibox-content.ibox-content-Windown.text-center').hide();
												

												var rfcRESPALDOMo = $( '.rfcRESPALDOMo' ).val(),
												numeroRESPALDOMo = $( '.numeroRESPALDOMo' ).val(),//ESTE VALOR LO MANDO COMOAUXILIAR LO TRAIGO EN UN INPUT OCULTO PARA PODER ACTUALIZAR EL NO DE CLIENTE
												razonMo = $( '.razonMo' ).val(),
												rfcMo = $( '.rfcMo' ).val(),
												nombreMo = $( '.nombreMo' ).val(),
												app_paternoMo = $( '.app_paternoMo' ).val(),
												app_maternoMo = $('.app_maternoMo' ).val(),
												no_clienteMo = $('.no_clienteMo' ).val(),
												txtteloficinaMo = $( '.txtteloficinaMo' ).val(),
												txttelCelularMo = $( '.txttelCelularMo' ).val(),
												txtobservaMo = $( '.txtobservaMo' ).val(),
												txtcorreoMo = $( '.txtcorreoMo' ).val(),
												HORACT1Mo = $( '.HORACT1Mo' ).val(),
												HORACT2Mo = $( '.HORACT2Mo' ).val(),
												HORACT3Mo = $( '.HORACT3Mo' ).val(),
												HORACT4Mo = $( '.HORACT4Mo' ).val(),
												calleMo = $( '.calleMo' ).val(),
												nraMo = $( '.nraMo' ).val(),
												txtsucursalMo = $( '.txtsucursalMo' ).val(),
												no_cta_Mo = $('.no_cta_Mo').val(),
												giroMo = $( '.giroMo' ).val(),
												num_extMo = $( '.num_extMo' ).val(),
												num_intMo = $( '.num_intMo' ).val(),
												localidadMo = $( '.localidadMo' ).val(),
												municipioMo = $( '.municipioMo' ).val(),
												zonaMo = $( '.zonaMo' ).val(),
												estadoMo = $( '.estadoMo' ).val(),
												cpMo = $( '.cpMo' ).val(),
												referenciaMo = $( '.referenciaMo' ).val(),
												tentrecalle1Mo = $( '.txtentrecalle1Mo' ).val(),
												tentrecalle2Mo = $( '.txtentrecalle2Mo' ).val(),
												latitudMo1 = $( '.latitudMo1' ).val(),
												longitudMo1 = $( '.longitudMo1' ).val();
												medioPagoMo = $( '.txtmedioPagoMo' ).val();
												metodoPagoMo = $( '.txtmetodoPagoMo' ).val();
												txtIdPagoMo = $( '.txtIdPagoMo' ).val();
												 
												$.post( 'searchClient.php' , { rfcRESPALDOMo:rfcRESPALDOMo,numeroRESPALDOMo:numeroRESPALDOMo,razonMo:razonMo,rfcMo:rfcMo,nombreMo:nombreMo,app_paternoMo:app_paternoMo,app_maternoMo:app_maternoMo,
																		no_clienteMo:no_clienteMo,txtteloficinaMo:txtteloficinaMo,txttelCelularMo:txttelCelularMo,txtobservaMo:txtobservaMo,txtcorreoMo:txtcorreoMo,HORACT1Mo:HORACT1Mo,
																		HORACT2Mo:HORACT2Mo,HORACT3Mo:HORACT3Mo,HORACT4Mo:HORACT4Mo,calleMo:calleMo,txtsucursalMo:txtsucursalMo,nraMo:nraMo,no_cta_Mo:no_cta_Mo,giroMo:giroMo,num_extMo:num_extMo,num_intMo:num_intMo,
																		localidadMo:localidadMo,municipioMo:municipioMo,zonaMo:zonaMo,estadoMo:estadoMo,cpMo:cpMo,referenciaMo:referenciaMo,tentrecalle1Mo:tentrecalle1Mo,tentrecalle2Mo:tentrecalle2Mo,latitudMo1:latitudMo1,longitudMo1:longitudMo1, medioPagoMo:medioPagoMo,metodoPagoMo:metodoPagoMo,txtIdPagoMo:txtIdPagoMo } , 
												function ( exito )
												{      
													var idClient = $('.no_clienteMo').val();
													$.post( 'searchClient.php' , { idClient : idClient } ,
													function (exito)
													{
														$( '#contenedor_SearchModal_correcta' ).html( exito ).fadeIn();
													});
													$( '#respuesta' ).html(exito);  
												});	 												 												 							
												
												
												$('.ibox-content.ibox-content-Windown.text-center').show(2000);
												return false; // Evitar ejecutar el submit del formulario.
											 });
											});
										</script>
										
										
										

										<!--Aqui inicia la venta modal de la persona fisica-->
										
											<div class="modal inmodal fade" id="ventanaFisica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content animated fadeInDown" style="width:620px;">
														<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button><!-ESTE ES EL BOTON DE CERRAR LA MODAL LA TACHESITA KE APRACESE ASTA ARRIBA EN LA ESQUINA (X)->
															 <h2 class="modal-title" id="NARANJA">DATOS</h2>
														</div>
														
														<div class="modal-body">
														  <form class="form-horizontal" name='form2' id='form2' method="post" action="modificar_empresa_fisica2.php">
														 
															   <div class="bs-example tabs-container with-nav-tabs panel-success">
																	<ul class="nav nav-pills nav-tabs">
																		<li class="active"><a data-toggle="tab" href="#sectionAFi">Datos Fiscales</a></li>
																		<li><a data-toggle="tab" href="#sectionBFi">Domicilio</a></li>
																		<li><a data-toggle="tab" href="#sectionCFi" id="buscaroriginal" onclick="funcionPasarFisica(); buscarCoordenadasFisicaOriginal() ">Ubicaci&oacute;n Mapa</a></li>
																		<!--li><a data-toggle="tab" href="#pagoFi" onclick="validarCampos()">Pago</a></li-->
																	</ul>
																	<div class="tab-content">
																		
																		<div id="sectionAFi" class="tab-pane fade in active">
																			<BR>
																			<div class="form-group">
																				<label class="control-label col-xs-3">No. de Cliente:</label>
																				<div class="col-xs-8">
																					<input type="text" readonly class="form-control no_clienteFi"  id="no_clienteFi" name="no_clienteFi" onkeydown="return validarNumeros(event)">
																				</div>
																			</div>
																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Medio de Pago:</label>
																				<div class="col-xs-8">
																					<select id="txtmedioPagoFi" name="txtmedioPagoFi" class="selectSearch form-control txtmedioPagoFi" style="width:100%;">
																						<option value="">SELECCIONA...</option>																						
																						<option value="FACTURA">FACTURA</option>
																						<option value="NOTA">NOTA</option>
																					</select>
																				</div>
																			</div>
																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Método de Pago:</label>
																				<div class="col-xs-8">
																					<select id="txtmetodoPagoFi" name="txtmetodoPagoFi" class="selectSearch form-control txtmetodoPagoFi" style="width:100%;">
																						<option value="">SELECCIONA...</option>
																						<option value="EFECTIVO">EFECTIVO</option>
																						<option value="DEPOSITO">DEPOSITO</option>
																						<option value="CHEQUE">CHEQUE</option>
																						<option value="TRANSFERENCIA">TRANSFERENCIA</option>
																						<option value="TARJETA DIRECTO">TARJETA DIRECTO</option>
																						<optgroup label="TARJETA" class="text-muted">																						
																							<option value="3">&nbsp;&nbsp;&nbsp;&nbsp;3</option>
																							<option value="6">&nbsp;&nbsp;&nbsp;&nbsp;6</option>
																							<option value="9">&nbsp;&nbsp;&nbsp;&nbsp;9</option>
																							<option value="12">&nbsp;&nbsp;&nbsp;&nbsp;12</option>
																							
																						</optgroup>
																					</select>
																				</div>
																			</div>
																			<input type="text" name="txtIdPagoFi" id="txtIdPagoFi" style="display:none;"  class="form-control txtIdPagoFi" value="" />
																			<div class="form-group">
																				<label class="control-label col-xs-3">RFC:</label>
																				<div class="col-xs-8">
																					<input type="text"  class="form-control rfcFi" id="rfcFi" name="rfcFi"  onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																			</div>
																			
																			<div class="form-group">
																				<label class="control-label col-xs-3">Nombre:</label>
																				<div class="col-xs-8">
																					<input type="text" class="form-control nombreFi" id="nombreFi" name="nombreFi" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">
																				</div>
																			</div>
																			<div class="form-group">
																				<label class="control-label col-xs-3">Apellidos:</label>
																				<div class="col-xs-4">
																					<input type="text" id="app_paternoFi" name="app_paternoFi" class="form-control app_paternoFi" placeholder="Apellido Paterno" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
																				</div>
																				
																				<div class="col-xs-4">
																					<input type="text" id="app_maternoFi" name="app_maternoFi" class="form-control app_maternoFi" placeholder="Apellido Materno" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)">
																				</div>
																			</div>
																			
																			<div class="form-group">
																				<label class="control-label col-xs-3">Tel&eacute;fono Ofi:</label>
																				<div class="col-xs-3">
																					<input type="text" id="txtteloficinaFi" name="txtteloficinaFi" class="form-control txtteloficinaFi" onkeydown="return validarNumeros(event)">
																				</div>
																				
																				<label class="control-label col-xs-2">Tel&eacute;fono Cel:</label>
																				<div class="col-xs-3">
																					<input type="text" id="txttelCelularFi" name="txttelCelularFi" class="form-control txttelCelularFi" onkeydown="return validarNumeros(event)">
																				</div>
																			</div> 																			
																			
																			<div class="form-group">
																				<label class="control-label col-xs-3">Observaciones:</label>
																				<div class="col-xs-8">
																					<input type="text" class="form-control txtobservaFi"  id="txtobservaFi" name="txtobservaFi" onkeyup="javascript:this.value=this.value.toUpperCase();"  >
																				</div>
																			</div>	
																			
																			<div class="form-group">
																				<label class="control-label col-xs-3">Email:</label>
																				<div class="col-xs-8">
																					<input type="email" class="form-control txtcorreoFi"  id="txtcorreoFi" name="txtcorreoFi" >
																				</div>
																			</div>
																			
																			<div class="form-group">
																				 <label class="control-label col-xs-3">Hor. Atención 1:</label>
																				 <div class="col-xs-4">
																					<select  id="HORACT1Fi" name="HORACT1Fi" class="form-control  HORACT1Fi"  >
																						<option value="">SELECCIONE</option>
																						<option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																						<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																						<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																						<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																						<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																						<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																						<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																						<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																						<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																						<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>

																					</select>
																				 </div>
																				 <div class="col-xs-4">
																					<select  id="HORACT2Fi" name="HORACT2Fi" class="form-control HORACT2Fi" >
																					   <option value="">SELECCIONE</option>
																					   <option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																						<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																						<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																						<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																						<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																						<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																						<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																						<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																						<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																						<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>
																					 </select>
																				 
																				 </div>
																			</div>
																			
																			<div class="form-group">
																				<label class="control-label col-xs-3">Hor. Atención 2:</label>
																				<div class="col-xs-4">
																					<select  id="HORACT3Fi" name="HORACT3Fi" class="form-control  HORACT3Fi"  >
																						<option value="">SELECCIONE</option>
																						<option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																						<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																						<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																						<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																						<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																						<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																						<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																						<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																						<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																						<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>

																					</select>
																				</div>
																				<div class="col-xs-4">
																					 <select  id="HORACT4Fi" name="HORACT4Fi" class="form-control HORACT4Fi" >
																						<option value="">SELECCIONE</option>
																						<option value="12:00AM">12:00AM</option> <option value="12:30AM">12:30AM</option> <option value="01:00AM">01:00AM</option> <option value="01:30AM">01:30AM</option> <option value="02:00AM">02:00AM</option>
																						<option value="02:30AM">02:30AM</option> <option value="03:00AM">03:00AM</option> <option value="03:30AM">03:30AM</option> <option value="04:00AM">04:00AM</option> <option value="04:30AM">04:30AM</option>
																						<option value="05:00AM">05:00AM</option> <option value="05:30AM">05:30AM</option> <option value="06:00AM">06:00AM</option> <option value="06:30AM">06:30AM</option> <option value="07:00AM">07:00AM</option>
																						<option value="07:30AM">07:30AM</option> <option value="08:00AM">08:00AM</option> <option value="08:30AM">08:30AM</option> <option value="09:00AM">09:00AM</option> <option value="09:30AM">09:30AM</option>
																						<option value="10:00AM">10:00AM</option> <option value="10:30AM">10:30AM</option> <option value="11:00AM">11:00AM</option> <option value="11:30AM">11:30AM</option>

																						<option value="12:00PM">12:00PM</option> <option value="12:30PM">12:30PM</option> <option value="01:00PM">01:00PM</option> <option value="01:30PM">01:30PM</option> <option value="02:00PM">02:00PM</option>
																						<option value="02:30PM">02:30PM</option> <option value="03:00PM">03:00PM</option> <option value="03:30PM">03:30PM</option> <option value="04:00PM">04:00PM</option> <option value="04:30PM">04:30PM</option>
																						<option value="05:00PM">05:00PM</option> <option value="05:30PM">05:30PM</option> <option value="06:00PM">06:00PM</option> <option value="06:30PM">06:30PM</option> <option value="07:00PM">07:00PM</option>
																						<option value="07:30PM">07:30PM</option> <option value="08:00PM">08:00PM</option> <option value="08:30PM">08:30PM</option> <option value="09:00PM">09:00PM</option> <option value="09:30PM">09:30PM</option>
																						<option value="10:00PM">10:00PM</option> <option value="10:30PM">10:30PM</option> <option value="11:00PM">11:00PM</option> <option value="11:30PM">11:30PM</option>
																					 </select>
																					<input type="text" class="form-control rfcRESPALDOFi"  style="display:none;" id="rfcRESPALDOFi" name="rfcRESPALDOFi" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();">
																					<input type="text" class="form-control numeroRESPALDOF" style="display:none;" id="numeroRESPALDOF" name="numeroRESPALDOF" onkeyup="javascript:this.value=this.value.toUpperCase();"  onkeydown="return validarLetras(event)">

																					<div id="contenedor_MANDA_ERROR"></div><!--EN ESTE DIV TRAE LOS ERRORES DE LA INSERCCION TRAE LAS VALIDACIONES OARA CADA CAMPO CORRESPONIENTE-->
																				</div>									   
																			</div>
																			
																		</div>
																		
																		<div id="sectionBFi" class="tab-pane fade">
																			<br>
																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Sucursal:</label>
																				<div class="col-xs-8">
																						<select id="txtsucursalFi" name="txtsucursalFi" class="selectSearch form-control txtsucursalFi" style="width:100%;">
																							<option value="">SELECCIONA...</option>
																							<option value="TOLUCA">TOLUCA</option>
																							<option value="ATLACOMULCO">ATLACOMULCO</option>
																							<option value="CDMX">CDMX</option>
																						</select>
																						<span class="fa fa-plus col-xs-1" data-toggle="modal" data-target="#myModalSucursal" style="margin-left:100%;margin-top:-7%;cursor:pointer;z-index:100;vertical-align: middle;"></span>
																				</div>
																			</div>
																			<div class="form-group">
																				<label  class="control-label col-xs-3">NRA:</label>
																				<div class="col-xs-8">
																					<input type="text" class="form-control nraFi" id="nraFi" name="nraFi" placeholder="N&uacute;mero de Registro Ambiental" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();" >
																				</div>
																			</div>
																			
																			<div class="form-group hidden">
																				<label  class="control-label col-xs-3">No. Cuenta:</label>
																				<div class="col-xs-8">
																					<input type="text" class="form-control no_cta_Fi"  id="no_cta_Fi" name="no_cta_Fi" placeholder="N&uacute;mero de Cuenta Concentradora" maxlength="30" onkeyup="javascript:this.value=this.value.toUpperCase();" >			                            
																				</div>
																			</div>
																			
																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Giro:</label>
																				<div class="col-xs-8">
																					 <select id="giroFi" name="giroFi" class="form-control giroFi">
																						<option value="">SELECCIONA...</option>
																						<option value="CASA DE ASISTENCIA">CASA DE ASISTENCIA</option>
																						<option value="CENTRO M&Eacute;DICO">CENTRO M&Eacute;DICO</option>
																						<option value="CL&Iacute;NICA">CL&Iacute;NICA</option>
																						<option value="CONSULTORIO">CONSULTORIO</option>
																						<option value="EMPRESA">EMPRESA</option>
																						<option value="ESCUELA">ESCUELA</option>
																						<option value="FARMACIA">FARMACIA</option>
																						<option value="FUNERARIA">FUNERARIA</option>
																						<option value="HOSPITAL">HOSPITAL</option>
																						<option value="HOTEL">HOTEL</option>
																						<option value="LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS">LABORATORIO DE AN&Aacute;LISIS CL&Iacute;NICOS</option>
																						<option value="ODONTOLOG&Iacute;A">ODONTOLOG&Iacute;A</option>
																						<option value="POD&Oacute;LOGO">POD&Oacute;LOGO</option>
																						<option value="SANATORIO">SANATORIO</option>
																						<option value="TATUAJES Y PERFORACIONES">TATUAJES Y PERFORACIONES</option>  
																						<option value="TEXTIL">TEXTIL</option>
																						<option value="VETERINARIA">VETERINARIA</option>  
																						<option value="OTRO">OTRO</option>   
																					  </select>
																				</div>
																			</div>
																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Ruta:</label>
																				<div class="col-xs-8">
																					<select id="zonaFi" name="zonaFi" class="form-control zonaFi">
																						<option value="">SELECCIONA...</option>
																						<option value="A">A</option>
																						<option value="B">B</option>
																						<option value="C">C</option>
																						<option value="D">D</option>
																						<option value="E">E</option>
																						<option value="F">F</option>
																						<option value="G">G</option>
																						<option value="H">H</option>
																						<option value="I">I</option>
																						<option value="J">J</option>
																						<option value="K">K</option>
																						<option value="L">L</option>
																						<option value="M">M</option>
																						<option value="N">N</option>
																						<option value="O">O</option>
																						<option value="P">P</option>
																						<option value="Q">Q</option>
																						<option value="R">R</option>
																						<option value="S">S</option>
																						<option value="T">T</option>
																						<option value="U">U</option>
																						<option value="V">V</option>
																						<option value="W">W</option>
																						<option value="X">X</option>
																						<option value="Y">Y</option>
																					</select>
																				</div>
																			</div>
																												
																		   <div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">ESTADO:</label>
																				<div class="col-xs-8">			                                	
																					<div>  <div id="edos"><select name='estadoFi' id='estadoFi' ' class='form-control estadoFi'>
																					<option  value="" style="display:none">SELECCIONA...</option> </select> </div></div>
																				</div>
																			</div>

																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Municipio:</label>
																				<div class="col-xs-8">
																					<div><select  id="municipioFi" name="municipioFi"  class="form-control municipioFi"  ><option  value="" style="display:none">SELECCIONA...</option></select></div>
																					<input type="text" name="municipioMGuaFi" style="display:none;" id="municipioMGuaFi" onchange="mostrarValorMunFi(this.options[this.selectedIndex].innerHTML);" class="form-control municipioMGuaFi" value="" />
																				</div>
																			</div>

																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">CP:</label>
																				<div class="col-xs-8">
																					<div><select   id="cpFi" name="cpFi"  class="form-control cpFi" ><option  value="" style="display:none">SELECCIONA...</option></select></div>
																					<input type="text"  name="cpMGuaFi" id="cpMGuaFi" style="display:none;" onchange="mostrarValorCPFi(this.options[this.selectedIndex].innerHTML);" class="form-control cpMGuaFi" value="" />
																				</div>
																			</div>

																			<div class="form-group" style="text-align:left">
																				<label class="control-label col-xs-3">Localidad:</label>
																				<div class="col-xs-8">
																					<div><select    id="localidadFi" name="localidadFi"   class="form-control localidadFi" ><option  value="" style="display:none">SELECCIONA...</option></select></div>
																					<input type="text" name="localidadMGuaFi" id="localidadMGuaFi" style="display:none;" onchange="mostrarValorLOCFi(this.options[this.selectedIndex].innerHTML);" class="form-control localidadMGuaFi" value="" />
																				</div>
																			</div>
																			
																			<div class="form-group">
																				<label  class="control-label col-xs-3">Calle:</label>
																				<div class="col-xs-8">
																					<input type="text" class="form-control calleFi"  id="calleFi" name="calleFi" onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																			</div>
																			<div class="form-group">
																				<label  class="control-label col-xs-3">No. Ext:</label>
																				<div class="col-xs-3">
																					<input type="text" id="num_extFi" name="num_extFi" class="form-control num_extFi" onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																				
																				 <label  class="control-label col-xs-2">No. Int:</label>
																				<div class="col-xs-3">
																					<input type="text" id="num_intFi" name="num_intFi" class="form-control num_intFi" onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																			</div>
																			<div class="form-group">
																				<label  class="control-label col-xs-3">Entre:</label>
																				<div class="col-xs-4">
																					<input type="text" id="txtentrecalle1Fi" name="txtentrecalle1Fi" placeholder="Calle 1" class="form-control txtentrecalle1Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																				<span style="margin-left:-520px;font-size:large;">/</span>
																				<div class="col-xs-4">
																					<input type="text" id="txtentrecalle2Fi" name="txtentrecalle2Fi" placeholder="Calle 2" class="form-control txtentrecalle2Fi" onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																			</div>
																			
																			<div class="form-group">
																				<label  class="control-label col-xs-3">Referencia:</label>
																				<div class="col-xs-8">
																					<input type="text" class="form-control referenciaFi"  id="referenciaFi" name="referenciaFi" onkeyup="javascript:this.value=this.value.toUpperCase();">
																				</div>
																			</div>

																		</div><!-**4**AQUI TERMINA EL DIV PARA LA TAB DE DOMICILIO**4**->
																		
																		<div id="sectionCFi" class="tab-pane fade"><!-**5**AQUI EMPIEZA EL DIV PARA LA TAB DE MAPA**5**-><br>
																			
																			<label style="margin-top:2%;margin-left:-1%;padding-bottom:15px;">ACTUALIZA LAS COORDENADAS MEDIANTE DIRECCI&Oacute;N  &nbsp; &nbsp;  <button type="button" class="btn btn-xs btn-default" id="buscarDFi" onclick="buscarDireccionFisica()" >Buscar Direcci&oacute;n</button></label>
																			<div><input type="text" maxlength="200" id="addressFi" placeholder="Dirección" style="margin-top:-1%; margin-left: 1%; width:100%"class="form-control addressFi"/>  </div><br>

																			<!--div style="margin-top:-3%; margin-left: 40%"><button type="button" class="btn btn-success" id="buscarDFi" onclick="buscarDireccionFisica()" >Buscar Direcci&oacute;n</button></div-->

																			<label style="margin-top:3%;margin-left:-1%;padding-bottom:15px;">ACTUALIZA MEDIANTE LAS COORDENADAS &nbsp; &nbsp; <button type="button" class="btn btn-xs btn-default" id="buscarCFi" onclick="buscarCoordenadasFisicaC()">Buscar Coordenadas</button></label><br>

																			<div style="margin-top:1%;margin-left:-78%;"><label>LATITUD:</label></div>
																			<div style="margin-top:-6%;margin-left:20%;"><input type="text" class="form-control latitudF" style="width:30%" id="latitudF" name="latitudF"></div>

																			<div style="margin-left:18%; margin-top:-5%"> <label>LONGITUD:</label></div>
																			<input type="text" class="form-control longitudF" style="margin-top:-6%;width:25%;margin-left:68%;" id="longitudF" name="longitudF"><br>

																			<!--div style="margin-top:-2%; margin-left: 40%"><button type="button" class="btn btn-success" id="buscarCFi" onclick="buscarCoordenadasFisicaC()">Buscar Coordenadas</button></div-->

																			<div id="map_canvasF" style="width:550px; height:250px;margin-top:2%;margin-left:1%;"></div>
																		
																		</div><!--**5**AQUI TERMINAA EL DIV PARA LA TAB DE MAPA**5**-->																		

																	</div><!--**2**AQUI TERMINA EL CONTENIDO PARA CADA TAB**2**-->
																</div><!--111-AQUI TERMINA EL DIV PARA CREAR LAS TABS -111-->

														  </form><!--AQUI TERMINA LA CREACION DEL FORMULARIO-->
														</div><!--TERMINA EL DIV NUMERO 5 CREACION DE VENTANA MODAL EMPEZAMOS HACER EL FORMULARIO CLIENTE**5**-->   

														<div class="modal-footer">
															<button type="button" class="btn btn-default" id="modalcerrar" data-dismiss="modal" style="margin-top:4px;">CERRAR</button>
															<button type="submit" id="btnModificarFisicaF" name="btnModificarFisicaF"  class="btn btn-primary">MODIFICAR</button>
														</div>
													</div><!--DIV NUMERO 3 CREACION DE VENTANA MODAL CLIENTE**3**-->
												</div><!--TERMINA DIV NUMERO 2 CREACION DE VENTANA MODAL CLIENTE**2**-->
											</div><!--DIV DONDE TERMINA  LA CREACION DE MODA*1*-->
											
										<script>
											$(function(){
											 $("#btnModificarFisicaF").click(function(){
												 //alert( "olasFisica" );
												
												 $( '.modal-backdrop.fade.in' ).remove();
												 $('body').removeClass('modal-open');
												 $("#ventanaMoral").modal("hide");
												 
												 $('.ibox-content.ibox-content-Windown.text-center').hide();
												

												var rfcRESPALDOFi = $( '.rfcRESPALDOFi' ).val(),
												numeroRESPALDOF = $( '.numeroRESPALDOF' ).val(),//ESTE VALOR LO MANDO COMOAUXILIAR LO TRAIGO EN UN INPUT OCULTO PARA PODER ACTUALIZAR EL NO DE CLIENTE
												rfcFi = $( '.rfcFi' ).val(),
												nombreFi = $( '.nombreFi' ).val(),
												app_paternoFi = $( '.app_paternoFi' ).val(),
												app_maternoFi = $( '.app_maternoFi' ).val(),
												no_clienteFi = $('.no_clienteFi' ).val(),
												txtteloficinaFi = $('.txtteloficinaFi' ).val(),
												txttelCelularFi = $( '.txttelCelularFi' ).val(),
												txtobservaFi = $( '.txtobservaFi' ).val(),
												txtcorreoFi = $( '.txtcorreoFi' ).val(),
												HORACT1Fi = $( '.HORACT1Fi' ).val(),
												HORACT2Fi = $( '.HORACT2Fi' ).val(),
												HORACT3Fi = $( '.HORACT3Fi' ).val(),
												HORACT4Fi = $( '.HORACT4Fi' ).val(),
												estatus_Fi = $( '.estatus_Fi' ).val(),
												calleFi = $( '.calleFi' ).val(),
												nraFi = $( '.nraFi' ).val(),
												txtsucursalFi = $( '.txtsucursalFi' ).val(),
												no_cta_Fi = $('.no_cta_Fi').val(),
												giroFi = $( '.giroFi' ).val(),
												num_extFi = $( '.num_extFi' ).val(),
												num_intFi = $( '.num_intFi' ).val(),
												localidadFi = $( '.localidadFi' ).val(),
												municipioFi = $( '.municipioFi' ).val(),
												zonaFi = $( '.zonaFi' ).val(),
												estadoFi = $( '.estadoFi' ).val(),
												cpFi = $( '.cpFi' ).val(),
												tentrecalle1Fi = $( '.txtentrecalle1Fi' ).val(),
												tentrecalle2Fi = $( '.txtentrecalle2Fi' ).val(),
												referenciaFi = $( '.referenciaFi' ).val(),
												latitudF = $( '.latitudF' ).val(),
												longitudF = $( '.longitudF' ).val();												
												medioPagoFi = $( '.txtmedioPagoFi' ).val();
												metodoPagoFi = $( '.txtmetodoPagoFi' ).val();
												txtIdPagoFi = $( '.txtIdPagoFi' ).val();
												 
												$.post( 'searchClient.php' , { rfcRESPALDOFi:rfcRESPALDOFi,numeroRESPALDOF:numeroRESPALDOF,rfcFi:rfcFi,nombreFi:nombreFi,app_paternoFi:app_paternoFi,app_maternoFi:app_maternoFi,no_clienteFi:no_clienteFi,
																				txtteloficinaFi:txtteloficinaFi,txttelCelularFi:txttelCelularFi,txtobservaFi:txtobservaFi,txtcorreoFi:txtcorreoFi,HORACT1Fi:HORACT1Fi,HORACT2Fi:HORACT2Fi,HORACT3Fi:HORACT3Fi,HORACT4Fi:HORACT4Fi,
																				estatus_Fi:estatus_Fi,calleFi:calleFi,txtsucursalFi:txtsucursalFi,nraFi:nraFi,no_cta_Fi:no_cta_Fi,giroFi:giroFi,num_extFi:num_extFi,num_intFi:num_intFi,localidadFi:localidadFi,municipioFi:municipioFi,zonaFi:zonaFi,
																				estadoFi:estadoFi,cpFi:cpFi,tentrecalle1Fi:tentrecalle1Fi,tentrecalle2Fi:tentrecalle2Fi,referenciaFi:referenciaFi,latitudF:latitudF,longitudF:longitudF,medioPagoFi:medioPagoFi,metodoPagoFi:metodoPagoFi,txtIdPagoFi:txtIdPagoFi } , 
												function ( exito )
												{      
													var idClient = $('.no_clienteFi').val();
													$.post( 'searchClient.php' , { idClient : idClient } ,
													function (exito)
													{
														$( '#contenedor_SearchModal_correcta' ).html( exito ).fadeIn();
													});
													$( '#respuesta' ).html(exito);  
												});	 												 												 							
												
												
												$('.ibox-content.ibox-content-Windown.text-center').show(2000);
												return false; // Evitar ejecutar el submit del formulario.
											 });
											});
										</script>	
										<!--Aqui termina el div de la clase row que esta debajo del include accesar_modificar_datos_general.php-->
										<script language="JavaScript" type="text/javascript" src="../web/js/HelperJs/jsCliente/buscarDireccionesFisica.js"></script>

										<script language="JavaScript" type="text/javascript" src="../web/js/HelperJs/jsCliente/buscarDireccionesMoral.js"></script>
							
			<?php
	  }
	  	public function searchUpdateClientMoral($POST=''){
		    require('../bd/bd.php');
			$db = new DbCnnx();

			@$rfcRES = $POST['rfcRESPALDOMo'];
			@$no_clienteR = $POST['numeroRESPALDOMo'];
			@$razon_soc = $POST['razonMo'];
			@$rfc = $POST['rfcMo'];
			@$nombre=$POST['nombreMo'];
			@$app_paterno=$POST['app_paternoMo'];
			@$app_materno=$POST['app_maternoMo'];
			@$no_cliente = $POST['no_clienteMo'];
			@$tel_ofi = $POST[ 'txtteloficinaMo' ];
			@$tel_cell = $POST['txttelCelularMo'];
			@$obs = $POST['txtobservaMo'];
			@$email = $POST['txtcorreoMo'];
			@$hor = $POST['HORACT1Mo'];
			@$hor2 = $POST['HORACT2Mo'];
			@$hor3 = $POST['HORACT3Mo'];
			@$hor4 = $POST['HORACT4Mo'];
			//@$estatus = $_POST['estatus_MO'];echo "$estatus";
			@$calle= $POST['calleMo'];
			@$txtsucursalMo = $POST['txtsucursalMo'];
			@$nra = $POST['nraMo'];
			@$no_cta_con = $POST['no_cta_Mo'];
			@$giro = $POST['giroMo'];
			@$num_ext = $POST['num_extMo'];
			@$num_int = $POST['num_intMo'];
			@$colonia = $POST['localidadMo'];
			@$del_mpio = $POST['municipioMo'];
			@$zona= $POST['zonaMo'];
			@$estado= $POST['estadoMo'];
			@$cp= $POST['cpMo'];
			@$tentrecalle1Mo = $POST['tentrecalle1Mo'];
			@$tentrecalle2Mo = $POST['tentrecalle2Mo'];
			@$referencia = $POST['referenciaMo'];
			@$latitud = $POST['latitudMo1'];
			@$longitud = $POST['longitudMo1'];
			@$metodoPagoMo = $POST['metodoPagoMo'];
			@$medioPagoMo = $POST['medioPagoMo'];
			@$txtIdPagoMo = $POST['txtIdPagoMo'];

			if(strlen(@$rfc)!=12)
			{
				echo "
				<script language='javascript'>
				alert('Error al Modificar RFC debe ser de 12 digitos (Verifique sus datos) ')
				window.location=''
				</script>";
			}
			else
			{
				$QueryUpdatePago ="Update pago set TIPO_DE_PAGO=('$metodoPagoMo'),MEDIO_DE_PAGO=('$medioPagoMo') where ID_PAGO=$txtIdPagoMo";
				$exectUpdate = $db->query($QueryUpdatePago);
				
				// echo $QueryUpdatePago;
				
				@$SQL_VALIDA = "update empresas set RFC=('$rfc'),NO_CLIENTE=('$no_cliente'),RAZON_SOCIAL=('$razon_soc'),CALLE=('$calle'),
				NUM_INT=('$num_int'),NUM_EXT=('$num_ext'),ZONA=('$zona'),DEL_MPIO=('$del_mpio'),ESTADO=('$estado'),COLONIA=('$colonia'),
				CP=('$cp'),REFERENCIA=('$referencia'),ENTRE_CALLE1=('$tentrecalle1Mo'),ENTRE_CALLE2=('$tentrecalle2Mo'),NRA=('$nra'),ID_PAGO=('$txtIdPagoMo'),ID_ALTA_SUCURSAL=((SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$txtsucursalMo')),LATITUD=('$latitud'), LONGITUD=('$longitud'),NO_CTA_CON=('$no_cta_con'),GIRO=('$giro') 
				where RFC=('$rfcRES') AND NO_CLIENTE=('$no_clienteR')";
				
				$rec = $db->query($SQL_VALIDA);
				
				// echo $SQL_VALIDA;
				
				
				@$SQL_VALIDA2 = "update contactos set RFC_EMP=('$rfc'),NO_CLIENTE=('$no_cliente'),NOMBRE_C=('$nombre'), APP_PATERNO_C=('$app_paterno'),APP_MATERNO_C=('$app_materno'),
				EMAIL=('$email'),TELEFONO_OFI=('$tel_ofi'),TELEFONO_CELL=('$tel_cell'),
				HORARIO_ATENCION=('$hor A $hor2'),HOR1=('$hor'),HOR2=('$hor2'),HORARIO_ATENCION2=('$hor3 A $hor4'),HOR3=('$hor3'),HOR4=('$hor4'),OBSERVACIONES=('$obs') 
				where RFC_EMP=('$rfcRES') AND NO_CLIENTE=('$no_clienteR') ";
				
				$rec = $db->query($SQL_VALIDA2);

				@$SQL_VALIDA3 = "update contratos set NO_CLIENTE_EMP=('$no_cliente'),rfc_empresa=('$rfc') where NO_CLIENTE_EMP=('$no_clienteR')";
				
				$rec = $db->query($SQL_VALIDA3);

				@$SQL_VALIDA4 = "update bitacora set clave_CLIENTE=('$no_cliente'),rfc_empresa=('$rfc') where clave_CLIENTE=('$no_clienteR')";
				
				$rec = $db->query($SQL_VALIDA4);

				@$SQL_VALIDA5 = "update log_queja set NO_CLIENTE_EMP=('$no_cliente'),rfc_empresa=('$rfc') where NO_CLIENTE_EMP=('$no_clienteR')";
				
				$rec = $db->query($SQL_VALIDA5);


				if ($db->query($SQL_VALIDA) === TRUE && $db->query($SQL_VALIDA2) === TRUE && $db->query($SQL_VALIDA3) === TRUE && $db->query($SQL_VALIDA4) === TRUE && $db->query($SQL_VALIDA5) === TRUE ) 
				{
					echo "
					<script language='javascript'>
					setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							positionClass: 'toast-bottom-right',
							showMethod: 'slideDown',
							timeOut: 4000
						};
						toastr.success('','DATOS ACTUALIZADOS CORRECTAMENTE');
					},1200);
					</script>";
				} 
				else 
				{
					echo "Error updating record: ";
				}
				
			}
		}
		
		public function searchUpdateClient($POST=''){
		    require('../bd/bd.php');
			$db = new DbCnnx();

			  //Estas dos lineas no se estan recibiendo
			  @$rfcRES = $POST['rfcRESPALDOFi']; 
			  @$no_clienteRES = $POST['numeroRESPALDOF'];
				//echo "@$rfcRES y  @$no_clienteRES";
				
			  @$rfc = $POST['rfcFi'];
			  @$nombre=$POST['nombreFi'];
			  @$app_paterno=$POST['app_paternoFi'];
			  @$app_materno=$POST['app_maternoFi'];
			  @$no_cliente = $POST['no_clienteFi'];
			  @$tel_ofi = $POST[ 'txtteloficinaFi' ];
			  @$tel_cell = $POST['txttelCelularFi'];
			  @$obs = $POST['txtobservaFi'];
			  @$email = $POST['txtcorreoFi'];
			  @$hor = $POST['HORACT1Fi'];
			  @$hor2 = $POST['HORACT2Fi'];
			  @$hor3 = $POST['HORACT3Fi'];
			  @$hor4 = $POST['HORACT4Fi'];
			  //@$estatus = $_POST['estatus_Fi'];
			  
			  @$calle= $POST['calleFi'];
			  @$txtsucursalFi = $POST['txtsucursalFi'];
			  @$nra = $POST['nraFi'];
			  @$no_cta_con = $POST['no_cta_Fi'];
			  @$giro = $POST['giroFi'];
			  @$num_ext = $POST['num_extFi'];
			  @$num_int = $POST['num_intFi'];
			  @$colonia = $POST['localidadFi'];
			  @$del_mpio = $POST['municipioFi'];
			  @$zona= $POST['zonaFi'];
			  @$estado= $POST['estadoFi'];
			  @$cp= $POST['cpFi'];
			  @$referencia = $POST['referenciaFi'];
			  @$tentrecalle1Fi = $POST['tentrecalle1Fi'];
			  @$tentrecalle2Fi = $POST['tentrecalle2Fi'];
			  @$latitud = $POST['latitudF'];
			  @$longitud = $POST['longitudF'];
			  @$metodoPagoFi = $POST['metodoPagoFi'];
			  @$medioPagoFi = $POST['medioPagoFi'];
			  @$txtIdPagoFi = $POST['txtIdPagoFi'];

			 if(strlen(@$rfc)!=13)
			{
				echo "
				<script language='javascript'>
				alert('Error al Modificar RFC debe ser de 13 digitos (Verifique sus datos) ')
				window.location=''
				</script>";
			}
			else
			{
				
				$QueryUpdatePago ="Update pago set TIPO_DE_PAGO=('$metodoPagoFi'),MEDIO_DE_PAGO=('$medioPagoFi') where ID_PAGO=$txtIdPagoFi";
				$exectUpdate = $db->query($QueryUpdatePago);
				
				// echo $QueryUpdatePago;
				
				@$SQL_VALIDA = "update empresas set rfc=('$rfc'),no_cliente=('$no_cliente'),nombre=('$nombre'), app_paterno=('$app_paterno'),app_materno=('$app_materno'),calle=('$calle'),
				  num_int=('$num_int'),num_ext=('$num_ext'),zona=('$zona'),del_mpio=('$del_mpio'),estado=('$estado'),colonia=('$colonia'),
				  cp=('$cp'),referencia=('$referencia'),ENTRE_CALLE1=('$tentrecalle1Fi'),ENTRE_CALLE2=('$tentrecalle2Fi'),nra=('$nra'),ID_PAGO=('$txtIdPagoFi'),ID_ALTA_SUCURSAL=((SELECT ID_ALTA_SUCURSAL FROM alta_sucursal WHERE NOMBRE='$txtsucursalFi')),latitud=('$latitud'), longitud=('$longitud'), no_cta_con=('$no_cta_con'), giro=('$giro') 
				  where rfc=('$rfc') and no_cliente=('$no_cliente')";
				
				$rec = $db->query($SQL_VALIDA);
				
				
				@$SQL_VALIDA2 = "update contactos set rfc_emp=('$rfc'),no_cliente=('$no_cliente'),nombre_c=('$nombre'), app_paterno_c=('$app_paterno'),app_materno_c=('$app_materno'),
				  email=('$email'),telefono_ofi=('$tel_ofi'),telefono_cell=('$tel_cell'),
				  horario_atencion=('$hor A $hor2'),HOR1=('$hor'),HOR2=('$hor2'),horario_atencion2=('$hor3 A $hor4'),HOR3=('$hor3'),HOR4=('$hor4'),observaciones=('$obs')
				  where rfc_emp=('$rfc') and no_cliente=('$no_cliente')";
				
				$rec = $db->query($SQL_VALIDA2);

				@$SQL_VALIDA3 = "update contratos set NO_CLIENTE_EMP=('$no_cliente'),rfc_empresa=('$rfc') where NO_CLIENTE_EMP=('$no_clienteRES')";
				
				$rec = $db->query($SQL_VALIDA3);

				@$SQL_VALIDA4 = "update bitacora set CLAVE_CLIENTE=('$no_cliente'),rfc_empresa=('$rfc') where CLAVE_CLIENTE=('$no_clienteRES')";
				
				$rec = $db->query($SQL_VALIDA4);

				@$SQL_VALIDA5 = "update log_queja set NO_CLIENTE_EMP=('$no_cliente'),rfc_empresa=('$rfc') where NO_CLIENTE_EMP=('$no_clienteRES')";
				
				$rec = $db->query($SQL_VALIDA5);


				if ($db->query($SQL_VALIDA) === TRUE && $db->query($SQL_VALIDA2) === TRUE && $db->query($SQL_VALIDA3) === TRUE && $db->query($SQL_VALIDA4) === TRUE && $db->query($SQL_VALIDA5) === TRUE ) 
				{
					echo "
					<script language='javascript'>
					setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							positionClass: 'toast-bottom-right',
							showMethod: 'slideDown',
							timeOut: 4000
						};
						toastr.success('','DATOS ACTUALIZADOS CORRECTAMENTE');
					},1200);
					</script>";
				} 
				else 
				{
					echo "Error updating record: ";
				}
				
			}
		}
			
			public function loadSelectSucursal(){
				
				$db = new DbCnnx();
				$sqlListTables = "SELECT * FROM alta_sucursal";
				$stmtTable = $db->combo($sqlListTables);
				
				return $stmtTable;
			}
 }

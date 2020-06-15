<?php session_start();
sleep(1);
require('../../bd/bd.php');

$db = new DbCnnx();

if($_REQUEST['noCliente']!='')
{
	$noCliente= $_REQUEST['noCliente'];
	@$txtSucu= $_REQUEST['txtSucu'];
	@$TypeAutocomplite= $_REQUEST['TypeAutocomplite']; //OrdenDeTrabajo
	@$rutaPdfOrdenT= $_REQUEST['rutaPdfOrdenT'];
	@$GetnoFolio= $_REQUEST['SendnoFolio'];
		
		switch ($TypeAutocomplite) {			
			case "OrdenDeTrabajo":
						
					$QuerySearchRefac = "SELECT ID_REFACCIONES,PIEZAS_REFACCION FROM ordent_ext WHERE no_cliente=$noCliente AND NO_FOLIO='$GetnoFolio' AND TIPO_REGISTRO='RefacExt'";					
					$recRefac = $db->combo($QuerySearchRefac);	
					
					$QuerySearch = "SELECT ot.*,valid.ID_VALID,valid.VALID,cont.NOMBRE_C,cont.APP_PATERNO_C,cont.APP_MATERNO_C,cont.EMAIL,emp.GIRO,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.ESTADO,emp.DEL_MPIO,emp.COLONIA,emp.CP,emp.CALLE,emp.NUM_EXT,emp.NUM_INT FROM empresas AS emp,contactos AS cont,ordent_ext AS ot,valid_modulo AS valid WHERE emp.no_cliente=$noCliente AND cont.no_cliente=$noCliente AND ot.NO_CLIENTE=$noCliente AND ot.NO_FOLIO='$GetnoFolio' AND valid.ID_VALID='$GetnoFolio' AND TIPO_REGISTRO='General' GROUP BY ot.NO_CLIENTE";					
					$rec = $db->combo($QuerySearch);
					
					while ($rowOrdenT = $rec->fetch_assoc()) {
						$NombreCliente=$rowOrdenT['NOMBRE'].' '.$rowOrdenT['APP_PATERNO'].' '.$rowOrdenT['APP_MATERNO'];
						$NombreClienteMo=$rowOrdenT['NOMBRE_C'].' '.$rowOrdenT['APP_PATERNO_C'].' '.$rowOrdenT['APP_MATERNO_C'];
						$DireccionCliente=$rowOrdenT['CALLE'].' / '.$rowOrdenT['NUM_INT'].' / '.$rowOrdenT['NUM_EXT'].' / '.$rowOrdenT['COLONIA'].' / '.$rowOrdenT['DEL_MPIO'].' / '.$rowOrdenT['ESTADO'].'-'.$rowOrdenT['CP'];

						if($rowOrdenT['EMAIL']==''){$Correo='';}else{$Correo=$rowOrdenT['EMAIL'];}
						if($rowOrdenT['GIRO']==''){$Giro='GIRO';}else{$Giro=$rowOrdenT['GIRO'];}						
						
						$NO_FOLIO=$rowOrdenT['NO_FOLIO'];
						$FECHA_RECOLECT=$rowOrdenT['FECHA_RECOLECT'];
						$FECHA_ENTREGA=$rowOrdenT['FECHA_ENTREGA'];
						$FECHA_ORDENT=$rowOrdenT['FECHA_ORDENT'];
						$TYPE_SERVICE=$rowOrdenT['TYPE_SERVICE'];
						$CANTIDAD_MANGUE=$rowOrdenT['CANTIDAD_MANGUE'];
						$SERVICIO_MANGUE=$rowOrdenT['SERVICIO_MANGUE'];
						$PH_MANGUE=$rowOrdenT['PH_MANGUE'];
						$EXTE_PRESTADOS=$rowOrdenT['EXTE_PRESTADOS'];
						$EXTE_RECOLECT=$rowOrdenT['EXTE_RECOLECT'];
						$EXTE_FALTANTES=$rowOrdenT['EXTE_FALTANTES'];
						$CANTIDAD_AA=$rowOrdenT['CANTIDAD_AA'];
						$SERVICIO_AA=$rowOrdenT['SERVICIO_AA'];
						$PH_AA=$rowOrdenT['PH_AA'];
						$TECNICO_APLICADOR=$rowOrdenT['TECNICO_APLICADOR'];
						$RUTA_JSON=$rowOrdenT['RUTA_JSON'];
						$RUTA_PDF=$rowOrdenT['RUTA_PDF'];
						$RESPONSABLE_AREA=$rowOrdenT['RESPONSABLE_AREA'];					
						$AREA_ADMINISTRACION=$rowOrdenT['AREA_ADMINISTRACION'];									
						@$VALID = $rowOrdenT['VALID'];
						@$RECIBIDE = $rowOrdenT['RECIBIDE'];
						@$PRECIONUM = $rowOrdenT['PRECIONUM'];
						@$PRECIOLETRAS = $rowOrdenT['PRECIOLETRAS'];
						
						if($rowOrdenT['NOMBRE']==''){
							$ResultFinal = $NombreClienteMo.' # '.$DireccionCliente.' # '.$Giro.' # '.@$txtSucu.' # '.@$Correo.' # '.$FECHA_RECOLECT.' # '.$FECHA_ENTREGA.' # '.$TYPE_SERVICE.' # '.$CANTIDAD_MANGUE.' # '.$SERVICIO_MANGUE.' # '.$PH_MANGUE.' # '.$EXTE_PRESTADOS.' # '.$EXTE_RECOLECT.' # '.$EXTE_FALTANTES.' # '.$CANTIDAD_AA.' # '.$SERVICIO_AA.' # '.$PH_AA.' # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION.' # '.$NO_FOLIO.' # '.$VALID.' # '.$RUTA_JSON.' # '.$RUTA_PDF;
						}else{
							$ResultFinal = $NombreCliente.' # '.$DireccionCliente.' # '.$Giro.' # '.@$txtSucu.' # '.@$Correo.' # '.$FECHA_RECOLECT.' # '.$FECHA_ENTREGA.' # '.$TYPE_SERVICE.' # '.$CANTIDAD_MANGUE.' # '.$SERVICIO_MANGUE.' # '.$PH_MANGUE.' # '.$EXTE_PRESTADOS.' # '.$EXTE_RECOLECT.' # '.$EXTE_FALTANTES.' # '.$CANTIDAD_AA.' # '.$SERVICIO_AA.' # '.$PH_AA.' # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION.' # '.$NO_FOLIO.' # '.$VALID.' # '.$RUTA_JSON.' # '.$RUTA_PDF;;}
					}

					@$SQL0 = "SELECT COUNT(*) AS numRowsAgentes FROM ordent_ext WHERE NO_FOLIO='$NO_FOLIO' AND TIPO_REGISTRO='AgenteExt'";
					@$rowss = $db->select($SQL0);
					@$numRowsAgentes = $rowss[0]['numRowsAgentes'];
					if(@$numRowsAgentes!=''){
						$ReportResultFinal = @$ResultFinal.' # '.$numRowsAgentes;
					}else{
						echo 'vacio';
					}
					
					?>
						<div  style="padding-bottom: 3px;">
							<button type="button" class="close" style="color: #000;padding-top:6px;padding-right:10px;" data-dismiss="modal">&times;</button>														
						</div>											
						<div class="modal-body" style="margin-top:15px;">
							<style>
							.modalContentDocment {
							  width: 100%;
							  height: 100%;
							  margin: 10px;
							  padding: 10px;
							}
							.datepicker table tr td span.active:hover,
							.datepicker table tr td span.active:hover:hover,
							.datepicker table tr td span.active.disabled:hover,
							.datepicker table tr td span.active.disabled:hover:hover,
							.datepicker table tr td span.active:active,
							.datepicker table tr td span.active:hover:active,
							.datepicker table tr td span.active.disabled:active,
							.datepicker table tr td span.active.disabled:hover:active,
							.datepicker table tr td span.active.active,
							.datepicker table tr td span.active:hover.active,
							.datepicker table tr td span.active.disabled.active,
							.datepicker table tr td span.active.disabled:hover.active,
							.datepicker table tr td span.active.disabled,
							.datepicker table tr td span.active:hover.disabled,
							.datepicker table tr td span.active.disabled.disabled,
							.datepicker table tr td span.active.disabled:hover.disabled,
							.datepicker table tr td span.active[disabled],
							.datepicker table tr td span.active:hover[disabled],
							.datepicker table tr td span.active.disabled[disabled],
							.datepicker table tr td span.active.disabled:hover[disabled] {
							  background-color: #11987d;
							}
							</style>
							<script>
								$(function() {
								  $("#txttypeService").val("<?php echo @$TYPE_SERVICE; ?>").change();
								});
							</script>
							<form class="form-horizontal" name="frm_Extintores" id="frm_Extintores">
								<div class="bs-example tabs-container with-nav-tabs panel-success">									
									<div class="form-group form-group-sm">
										<label class="control-label col-xs-2">N° DE FOLIO:</label>
										<div class="col-xs-3 control-label-noFolio">
											<input type="text" id="txtnoFolio" name="txtnoFolio" class="form-control txtnoFolio" aria-describedby="helpBlock" onkeydown="return validarNumeros(event)" value="<?php echo @$NO_FOLIO; ?>" disabled>
										</div>
																							
										<label class="control-label col-xs-1">FECHA:</label>
										<div class="col-xs-2">
											<input type="text" id="txtfecha" name="txtfecha" value="<?php echo @$FECHA_ORDENT; ?>" class="form-control txtfecha">
										</div>
																						
										<label class="control-label col-xs-2">N° CLIENTE:</label>
										<div class="col-xs-2 control-label-noCliente">
											<input type="text" id="txtnoCliente" name="txtnoCliente" class="form-control txtnoCliente" aria-describedby="helpBlock" onkeydown="return validarNumeros(event)" value="<?php echo @$noCliente; ?>" disabled>
										</div>
										<div class="col-xs-3">
											<input type="text" id="txtSucu" name="txtSucu" value="<?=@$_SESSION['sesionSucur']?>" class="form-control txtSucu hidden" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label  class="control-label col-xs-3">NOMBRE DEL CLIENTE:</label>
										<div class="col-xs-9">
											<input type="text" id="txtnomClient" name="txtnomClient" class="form-control txtnomClient" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo @$NombreClienteMo.@$NombreCliente; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label  class="control-label col-xs-3">DIRECCION:</label>
										<div class="col-xs-9">
											<input type="text" id="txtdirection" name="txtdirection" class="form-control txtdirection" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo @$DireccionCliente; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm">														
										<label class="control-label col-xs-3 font-normal">FECHA DE RECOLECCIÓN:</label>
										<div class="col-xs-3" id="dateRecolect">
											<div class="input-group date">
												<input type="text" name="txtfechaRecolect" class="form-control txtfechaRecolect" id="txtfechaRecolect" value="<?php echo @$FECHA_RECOLECT; ?>">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<label class="control-label col-xs-3 font-normal">FECHA DE ENTREGA:</label>
										<div class="col-xs-3" id="dateEntrega">
											<div class="input-group date">
												<input type="text" name="txtfechaEntrega" class="form-control txtfechaEntrega" id="txtfechaEntrega" value="<?php echo @$FECHA_ENTREGA; ?>">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>																											
									</div>
									<br>
									<h4 style="color:#11987d">Mantenimiento o Recarga de Extintores</h4>													
									<br>
									<div class="panele">
										<div class="panele-body">
											<table id="jqGrid" class="table"></table>
											<div id="jqGridPager"></div>
										</div>
									</div>
									<br>
									<div class="form-group form-group-sm">	
										<div class="col-xs-3 table-responsive">															
											<table class="table table-condensed">																
												<caption class="text-center" style="color:#11987d"><strong>Mangeras contra incendio</strong></caption>																
												<tr>
													<td><input type="text" name="txtCantidad" class="form-control txtCantidad" id="txtCantidad" value="<?php echo @$CANTIDAD_MANGUE; ?>" style="height: 20px;"></td>
													<td class="pull-left">Cantidad</td>       
												</tr>																
												<tr>
													<td><input type="text" name="txtServicio" class="form-control txtServicio" id="txtServicio" value="<?php echo @$SERVICIO_MANGUE; ?>" style="height: 20px;"></td>
													<td class="pull-left">Servicio</td>     
												</tr>        																
												<tr>
													<td><input type="text" name="txtPruebaH" class="form-control txtPruebaH" id="txtPruebaH" value="<?php echo @$PH_MANGUE; ?>" style="height: 20px;"></td>
													<td class="pull-left">Prueba&nbsp;H.</td>     
												</tr>																
											</table>
											<table class="table table-condensed">																
												<caption class="text-center" style="color:#11987d"><strong>Tipo de Servicio</strong></caption>																
												<tr>
													<td><select id="txttypeService" name="txttypeService" class="form-control txttypeService input-sm" style="width:100%;">
															<option value="Mantenimiento">Mantenimiento</option>																																																									
															<option value="Recarga">Recarga</option>																																																									
														</select>
													</td>
														  
												</tr>																																 																
											</table>
										</div>									
										<div class="col-xs-3 table-responsive">															
											<table id="refacciones" class="table table-condensed">	
												<thead>
													<caption class="text-center" style="color:#11987d"><strong>Refacciones</strong></caption>
													<tr><th scope="col">Especificación</th><th scope="col">Piezas</th></tr>
												</thead>
												<tbody> 
													<?php $count=1; while($rowRefac = $recRefac->fetch_assoc()){
													$ID_REFACCIONES=$rowRefac['ID_REFACCIONES'];
													$PIEZAS_REFACCION=$rowRefac['PIEZAS_REFACCION'];
													echo"<tr>
															<td><input type=\"text\" name=\"txtEspecificacion$count\" class=\"form-control txtEspecificacion$count\" id=\"txtEspecificacion$count\" style=\"height: 20px;\" value=\"$ID_REFACCIONES\"></td>
															<td><input type=\"text\" name=\"txtPiezas$count\" class=\"form-control txtPiezas$count\" id=\"txtPiezas$count\" style=\"height: 20px;\" value=\"$PIEZAS_REFACCION\"></td>       
														  </tr> ";
													$count++; } ?>
												</tbody>
											</table>
										</div>
										<div class="col-xs-6">	
											<div class="col-xs-6 table-responsive">															
												<table class="table table-condensed">																
													<caption class="text-center" style="color:#11987d"><strong>Ext. Emergentes</strong></caption>																
													<tr>
														<td><input type="text" name="txtExtPrestado" class="form-control txtExtPrestado" id="txtExtPrestado" value="<?php echo @$EXTE_PRESTADOS; ?>" style="height: 20px;"></td>
														<td class="pull-left">Prestados</td>       
													</tr>																
													<tr>
														<td><input type="text" name="txtExtRecolect" class="form-control txtExtRecolect" id="txtExtRecolect" value="<?php echo @$EXTE_RECOLECT; ?>" style="height: 20px;"></td>
														<td class="pull-left">Recolectados</td>     
													</tr>        																
													<tr>
														<td><input type="text" name="txtExtFaltantes" class="form-control txtExtFaltantes" id="txtExtFaltantes" value="<?php echo @$EXTE_FALTANTES; ?>" style="height: 20px;"></td>
														<td class="pull-left">Faltantes</td>     
													</tr>																
												</table>
											</div>											
											<div class="col-xs-6 table-responsive">															
												<table class="table table-condensed">																
													<caption class="text-center" style="color:#11987d"><strong>Aire Autónomo</strong></caption>																
													<tr>
														<td><input type="text" name="txtCantidadAire" class="form-control txtCantidadAire" id="txtCantidadAire" value="<?php echo @$CANTIDAD_AA; ?>" style="height: 20px;"></td>
														<td class="pull-left">Cantidad</td>       
													</tr>																
													<tr>
														<td><input type="text" name="txtServicioAire" class="form-control txtServicioAire" id="txtServicioAire" value="<?php echo @$SERVICIO_AA; ?>" style="height: 20px;"></td>
														<td class="pull-left">Servicio</td>     
													</tr>        																
													<tr>
														<td><input type="text" name="txtPruebaHAire" class="form-control txtPruebaHAire" id="txtPruebaHAire" value="<?php echo @$PH_AA; ?>" style="height: 20px;"></td>
														<td class="pull-left">Prueba&nbsp;H.</td>     
													</tr>																
												</table>
											</div>
											<div class="col-xs-12"> Recibí de <a href="#" id="RecibiDe" data-type="text" data-pk="1" data-title="Escribir Nombre" style="color: #159078;text-transform: uppercase;"><?php echo @$RECIBIDE; ?></a> Extintores emergentes de P.Q.S Y CO2, en calidad de prestamo por el tiempo que duren mis equipos en su
											talles de servicio, así mismo me comprometo a entregarlos en el momento de la recepción de mis equipos, el no devolverlos implica el compromiso
											de pagarles a razon de $: <a href="#" id="PrecioNum" data-type="text" data-pk="2" data-title="Cantidad en Numeros" style="color: #159078;"><?php echo @$PRECIONUM; ?></a> ( <a href="#" id="PrecioLetras" data-type="text" data-pk="3" data-title="Cantidad en Letras" style="color: #159078;text-transform: capitalize;"><?php echo @$PRECIOLETRAS; ?></a>  Pesos 00/100 M.N) más IVA, cada uno.
											</div>
										</div>														
									</div>
									<br>																								
									<div class="form-group form-group-sm" style="text-align:left">																			
										<label  class="control-label col-xs-3">RESPONSABLE ÁREA:</label>
										<div class="col-xs-9">															
											<input type="text" id="txtresponsable" name="txtresponsable" class="selectSearch form-control txtresponsable input-sm" value="<?php echo @$RESPONSABLE_AREA; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm" style="text-align:left">																			
										<label  class="control-label col-xs-3">TÉCNICO APLICADOR:</label>
										<div class="col-xs-9">
											<input type="text" id="txttecnico" name="txttecnico" class="selectSearch form-control txttecnico input-sm" value="<?php echo @$TECNICO_APLICADOR; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm" style="text-align:left">																			
										<label  class="control-label col-xs-3">ÁREA ADMINISTRACIÓN:</label>
										<div class="col-xs-9">
											<input type="text" id="txtadministracion" name="txtadministracion" class="selectSearch form-control txtadministracion input-sm" value="<?php echo @$AREA_ADMINISTRACION; ?>"disabled>
											<input type="text" id="txtrutaPdf" name="txtrutaPdf" class="form-control txtrutaPdf input-sm hidden" value="<?php echo @$rutaPdfOrdenT; ?>" disabled>
										</div>
									</div>
								</div>
							</form>	 <br>													
						</div>
						<div class="modal-footer" style="margin-top:-5px;">		
							<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="SendActualiOrdenT" data-style="expand-right"> <span class="fa fa-save"></span> &nbsp; Guardar</button>
							<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>												
						</div>
						<script>
							$(document).ready(function () {
								var sizeWidthJqGrid = $('.tabs-container').width();
								$("#jqGrid").jqGrid({											
									url: '../../repositorio/DataJson/DataExtintores/listarJsonBlank.php?rutaJson=<?php echo $RUTA_JSON; ?>',
									editurl: 'validExtintores.php',
									datatype: "json",
									colModel: [
										// {
											// label: "Acciones",
											// name: "actions",
											// width: 45,
											// formatter: "actions",
											// formatoptions: {
												// keys: true,
												// editOptions: {},
												// addOptions: {},
												// delOptions: {}
											// }       
										// },
										{
											label: 'CANTIDAD',
											name: 'Cantidad',													
											width: 52,
											sortable: false,
											required: true,
											editable: true 
										},
										{
											label : 'CAPACIDAD',
											name: 'Capacidad',
											width: 52,
											sortable: false,
											required: true,
											editable: true 
										},
										{
											label: 'PQS | CO2 | Agua | AFFF ',
											name: 'AgenteExt',
											width: 90,
											editable: true,
											edittype: "select",
											sortable: false,
											editoptions: {
												 value: ":;PQS:PQS;CO2:CO2;Agua:Agua;AFFF:AFFF"
											}
										},
										{
											label: 'OTROS',
											name: 'AgenteExtOtros',
											width: 70,
											sortable: false,
											required: true,
											editable: true 
										},
										{
											label: 'OBSERVACIONES',
											name: 'Obser',
											width: 100,
											sortable: false,
											required: true,
											editable: true 
										}
									],
									// sortname: 'Id',
									// sortorder : 'asc',
									loadonce: true,
									viewrecords: true,
									onSelectRow: editRow,
									height: 205,
									width: sizeWidthJqGrid,
									shrinkToFit: true,
									rowNum: <?php echo @$numRowsAgentes; ?>,
									rownumbers: false, // show row numbers
									pager: "#jqGridPager",
									caption: "Mantenimiento o Recarga de Extintores",
									loadingText: 'Cargando...',
									noRecordText: 'No se encontraron registros'
								});								
								
								  //Agregar el Boton de Guardar Tabla//
										paginador = $('#jqGrid').getGridParam('pager');
										jQuery('#jqGrid').navGrid(paginador, {
											edit: false,
											add: false,
											del: false,
											search: false,
											refresh: false
										}).navButtonAdd(paginador, {
											caption: "Guardar",
											buttonicon: "fa fa-save",
											onClickButton: function() {
												var idJqgrid = jQuery("#jqGrid").jqGrid('getGridParam','selrow');
												if (idJqgrid){ var ret = jQuery("#jqGrid").jqGrid('saveRow',idJqgrid); } else { }
											}
										});
									//*************************************//
								
								 $('#jqGrid').setGroupHeaders(
									{
										useColSpanStyle: true,
										groupHeaders: [{ "numberOfColumns": 2, "titleText": "<center>AGENTE EXTINGUIDOR</center>", "startColumnName": "AgenteExt" }]
									});
								
								var lastSelection;

								function editRow(id) {
									 if (id && id !== lastSelection) {												
										var grid = $("#jqGrid");
										grid.jqGrid('saveRow',lastSelection);
										grid.jqGrid('editRow',id, {keys: true} );
										lastSelection = id;												
										$('#'+id+'_Ubicacion').blur(function(event){											
											grid.jqGrid('saveRow',lastSelection);
										});
									 }
								}										
								// the bindKeys() 
								$("#jqGrid").jqGrid('bindKeys');																	
								$('.ui-jqgrid-titlebar.ui-jqgrid-caption.ui-widget-header.ui-corner-top.ui-helper-clearfix').append('<a href="javascript:;" class="ui-jqgrid-titlebar-close ui-corner-all HeaderButton" style="right:2.5%;" data-click="panel-expand"><i class="fa fa-expand"></i></a>');
							});		
							$( '#SendActualiOrdenT' ).click( function (event) {											
								event.preventDefault();	
								
									//Guardar Tabla Jqgrid
										var idJqgridE = jQuery("#jqGrid").jqGrid('getGridParam','selrow');
											if(idJqgridE){ var retJqgrid = jQuery("#jqGrid").jqGrid('saveRow',idJqgridE); } else { }
								
								$(this).prop( "disabled", true ).addClass('fa-spin');
								var formUpdatedOrdenT = 'formUpdatedOrdenT';
								var noFolio = $( '.txtnoFolio' ).val(),										
								noCliente = $( '.txtnoCliente' ).val(),
								sucursal = $( '.txtSucu' ).val(),
								fechaRecolect = $( '.txtfechaRecolect' ).val(),
								fechaEntrega = $( '.txtfechaEntrega' ).val(),
								fecha_service = $( '.txtfecha' ).val(),
								cantidad = $( '.txtCantidad' ).val(),
								servicio = $( '.txtServicio' ).val(),
								pruebaH = $( '.txtPruebaH' ).val(),
								typeService = $( '.txttypeService' ).val(),
								extPrestado = $( '.txtExtPrestado' ).val(),
								extRecolect = $( '.txtExtRecolect' ).val(),
								extFaltantes = $( '.txtExtFaltantes' ).val(),
								cantidadAire = $( '.txtCantidadAire' ).val(),
								servicioAire = $( '.txtServicioAire' ).val(),
								pruebaHAire = $( '.txtPruebaHAire' ).val(),
								rutaPdfOrdenT = '../'+$('.txtrutaPdf').val(),
								recibiDe = $('#RecibiDe').text(),																				
								precioNum = $('#PrecioNum').text(),																				
								precioLetras = $('#PrecioLetras').text(),
								TypeUser = 'TECNICO';	

								/* Recorrer tabla de Agentes Extintores */
								var banderaNextStep = false,
									CamposGrid = [];
									var id_object = 0
										
										$("#jqGrid tbody tr").each(function (index){											
											var cantidadAE, capacidadAE, agenteExtAE, agenteExtOtroAE, obser_object;
											$(this).children("td").each(function (index2){
												switch (index2){
													case 0: cantidadAE = $.trim($(this).text()); break;
													case 1: capacidadAE = $.trim($(this).text()); break;
													case 2: agenteExtAE = $.trim($(this).text()); break;
													case 3: agenteExtOtroAE = $.trim($(this).text()); break;
													case 4: obser_object = $.trim($(this).text()); break;													
												}
												// $(this).css("background-color", "#ECF8E0");																								
											});											
											// if(cantidadAE!='' || capacidadAE!=''){
											if(id_object!=0){																								
												$.post( 'newExtintores.php' , { formUpdatedOrdenT:formUpdatedOrdenT,noFolio:noFolio,typeRegistro:'AgenteExt',noCliente:noCliente,fechaRecolect:fechaRecolect,fechaEntrega:fechaEntrega,
																	id_object:id_object,cantidadAE:cantidadAE,capacidadAE:capacidadAE,agenteExtAE:agenteExtAE,agenteExtOtroAE:agenteExtOtroAE,obser_object:obser_object} );														
												banderaNextStep = true;
												CamposGrid.push(id_object,cantidadAE,capacidadAE,agenteExtAE,agenteExtOtroAE,obser_object);
											} id_object++;
										});
								
								if(banderaNextStep==true){
									$.post( 'newExtintores.php' , { GererateJsonOT : 'GererateJsonOT', CamposGrid:CamposGrid , noCliente:noCliente, sucursal:sucursal });	
								}
								
								/* Recorrer Tabla Refacciones */
									var JqgridRefaciones = false;
										var idObjectTR = 1;
										$("#refacciones tbody tr").each(function (index){											
											var refac, piee;
											refac = $.trim($('#txtEspecificacion'+idObjectTR).val());
											piee = $.trim($('#txtPiezas'+idObjectTR).val());	
												
											if(refac!='' || piee!=''){												
												$.post( 'newExtintores.php' , {formUpdatedOrdenT:formUpdatedOrdenT,noFolio:noFolio,typeRegistro:'RefacExt',noCliente:noCliente,fechaRecolect:fechaRecolect,fechaEntrega:fechaEntrega, id_object:'R'+idObjectTR,refac:refac,piezas:piee});
												JqgridRefaciones = true;
												// alert(idObjectTR+' refaccion= '+refac+' y piezas= '+piee);												
											}
											idObjectTR++;
												
										});
								/* Fin de recorrer Tabla Refacciones */
								
								$.post( 'newExtintores.php' , { formUpdatedOrdenT:formUpdatedOrdenT,noFolio:noFolio,typeRegistro:'General',fecha_service:fecha_service,noCliente:noCliente,fechaRecolect:fechaRecolect,fechaEntrega:fechaEntrega,cantidadAire:cantidadAire,servicioAire:servicioAire,
														cantidad:cantidad,servicio:servicio,pruebaH:pruebaH,typeService:typeService,extPrestado:extPrestado,extRecolect:extRecolect,extFaltantes:extFaltantes,pruebaHAire:pruebaHAire,recibiDe:recibiDe,precioNum:precioNum,precioLetras:precioLetras},
										function ( exito ){													
											// var varResult = exito.split("#");	
											// $('.result-Ajax').html(exito).fadeIn(2000);
											// alert(exito);
											
												setTimeout(function() {	
													// Actualiza Pdf deacuerdo a los cambios capturados por el Tecnico
													var hrefUrlUpdateOrdenTPdf = '../../repositorio/fpdf/pdfExtintores/UpdateOrdenTPdf.php?';												
													var hrefParamUpdateOrdenTPdf = "rutaPdfOrdenT="+rutaPdfOrdenT+"&fechaRecolect="+fechaRecolect+"&fechaEntrega="+fechaEntrega+"&TypeUser="+TypeUser+"&noFolio="+noFolio+"&cantidad="+cantidad+"&servicio="+servicio+"&pruebaH="+pruebaH+"&typeService="+typeService+"&extPrestado="+extPrestado+"&extRecolect="+extRecolect+"&extFaltantes="+extFaltantes+"&cantidadAire="+cantidadAire+"&servicioAire="+servicioAire+"&pruebaHAire="+pruebaHAire+"&recibiDe="+recibiDe+"&precioNum="+precioNum+"&precioLetras="+precioLetras;
													$("#GeneratePdf").load(hrefUrlUpdateOrdenTPdf,hrefParamUpdateOrdenTPdf);
													$('#SendActualiOrdenT').prop( "disabled", false ).removeClass('fa-spin');
													$('#modalOrdenTrabajoEdit').modal('hide');
												},2000);
												setTimeout(function() {
													toastr.options = {
														closeButton: true,
														progressBar: true,
														positionClass: 'toast-top-right',
														showMethod: 'slideDown',
														timeOut: 5000
													};
													toastr.success('','DATOS ACTUALIZADOS CORRECTAMENTE');
												},3200);
											
										});

								
								return false;
							});
							$(document).ready( function(event){
								$('#dateRecolect .input-group.date').datepicker({
								startView: 1,
								daysOfWeekDisabled: "0,6",
								keyboardNavigation: false,
								forceParse: false,
								autoclose: true,
								format: "yyyy-mm-dd"
								});	
								$('#dateEntrega .input-group.date').datepicker({
									startView: 1,
									daysOfWeekDisabled: "0,6",
									keyboardNavigation: false,
									forceParse: false,
									autoclose: true,
									format: "yyyy-mm-dd"
								});
								//editables 
									$('#RecibiDe').editable({
									   url: 'validExtintores.php',
									   type: 'text',
									   pk: 1,
									   name: 'RecibiDe',
									   inputclass: 'text-uppercase',
									   title: 'Escribir Nombre'
									});
									$('#PrecioNum').editable({
									   url: 'validExtintores.php',
									   type: 'text',
									   pk: 1,
									   name: 'PrecioNum',
									   inputclass: 'text-capitalize',
									   title: 'Escribir Nombre'
									});
									$('#PrecioLetras').editable({
									   url: 'validExtintores.php',
									   type: 'text',
									   pk: 1,
									   name: 'PrecioLetras',
									   inputclass: 'text-capitalize',
									   title: 'Escribir Nombre'
									});
							});
						</script>
					<?php
				break;
			case "PolizaGarantia":
						
					$QuerySearch = "SELECT pg.*,valid.ID_VALID,valid.VALID,cont.NOMBRE_C,cont.APP_PATERNO_C,cont.APP_MATERNO_C,cont.EMAIL,emp.GIRO,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.ESTADO,emp.DEL_MPIO,emp.COLONIA,emp.CP,emp.CALLE,emp.NUM_EXT,emp.NUM_INT FROM empresas AS emp,contactos AS cont,poliza_ext AS pg,valid_modulo AS valid WHERE emp.no_cliente=$noCliente AND cont.no_cliente=$noCliente AND pg.NO_CLIENTE=$noCliente AND pg.NO_FOLIO='$GetnoFolio' AND valid.ID_VALID='$GetnoFolio' AND TIPO_REGISTRO='General' GROUP BY pg.NO_CLIENTE";					
					$rec = $db->combo($QuerySearch);
					$VisibleCampos='hidden';
					while ($rowOrdenT = $rec->fetch_assoc()) {
						$NombreCliente=$rowOrdenT['NOMBRE'].' '.$rowOrdenT['APP_PATERNO'].' '.$rowOrdenT['APP_MATERNO'];
						$NombreClienteMo=$rowOrdenT['NOMBRE_C'].' '.$rowOrdenT['APP_PATERNO_C'].' '.$rowOrdenT['APP_MATERNO_C'];
						$DireccionCliente=$rowOrdenT['CALLE'].' / '.$rowOrdenT['NUM_INT'].' / '.$rowOrdenT['NUM_EXT'].' / '.$rowOrdenT['COLONIA'].' / '.$rowOrdenT['DEL_MPIO'].' / '.$rowOrdenT['ESTADO'].'-'.$rowOrdenT['CP'];

						if($rowOrdenT['EMAIL']==''){$Correo='';}else{$Correo=$rowOrdenT['EMAIL'];}
						if($rowOrdenT['GIRO']==''){$Giro='GIRO';}else{$Giro=$rowOrdenT['GIRO'];}						
						
						$NO_FOLIO=$rowOrdenT['NO_FOLIO'];
						$FECHA_POLIZA=$rowOrdenT['FECHA_POLIZA'];
						$EXAMEN_VISUAL=$rowOrdenT['EXAMEN_VISUAL'];
						$MEDIO_PRUEBA=$rowOrdenT['MEDIO_PRUEBA'];
						$PRESION_OPERACION=$rowOrdenT['PRESION_OPERACION'];
						$PRESION_PRUEBA=$rowOrdenT['PRESION_PRUEBA'];
						$DURACION_PRUEBA=$rowOrdenT['DURACION_PRUEBA'];
						$OBSERV_POLIZA=$rowOrdenT['OBSERV_POLIZA'];
						$TYPE_DOCUMENT=$rowOrdenT['TYPE_DOCUMENT'];
						if($TYPE_DOCUMENT=='POLIZA-PH'){$VisibleCampos='';}
						$TECNICO_APLICADOR=$rowOrdenT['TECNICO_APLICADOR'];
						$RUTA_JSON=$rowOrdenT['RUTA_JSON'];
						$RUTA_PDF=$rowOrdenT['RUTA_PDF'];
						$RUTA_PDF_PH=$rowOrdenT['RUTA_PDF_PH'];
						$CLIENTE_VALID=$rowOrdenT['CLIENTE_VALID'];
						$RESPONSABLE_AREA=$rowOrdenT['RESPONSABLE_AREA'];					
						$AREA_ADMINISTRACION=$rowOrdenT['AREA_ADMINISTRACION'];									
						@$VALID = $rowOrdenT['VALID'];
						
									
						
						if($rowOrdenT['NOMBRE']==''){
							$ResultFinal = $NombreClienteMo.' # '.$DireccionCliente.' # '.$Giro.' # '.@$txtSucu.' # '.@$Correo.' # '.$EXAMEN_VISUAL.' # '.$MEDIO_PRUEBA.' # '.$PRESION_OPERACION.' # '.$PRESION_PRUEBA.' # '.$DURACION_PRUEBA.' # '.$OBSERV_POLIZA.' # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION.' # '.$NO_FOLIO.' # '.$VALID.' # '.$RUTA_JSON.' # '.$RUTA_PDF;
						}else{
							$ResultFinal = $NombreCliente.' # '.$DireccionCliente.' # '.$Giro.' # '.@$txtSucu.' # '.@$Correo.' # '.$EXAMEN_VISUAL.' # '.$MEDIO_PRUEBA.' # '.$PRESION_OPERACION.' # '.$PRESION_PRUEBA.' # '.$DURACION_PRUEBA.' # '.$OBSERV_POLIZA.' # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION.' # '.$NO_FOLIO.' # '.$VALID.' # '.$RUTA_JSON.' # '.$RUTA_PDF;;}
					}

					@$SQL0 = "SELECT COUNT(*) AS numRowsAgentes FROM poliza_ext WHERE NO_FOLIO='$NO_FOLIO' AND TIPO_REGISTRO='AgenteExt'";
					@$rowss = $db->select($SQL0);
					@$numRowsAgentes = $rowss[0]['numRowsAgentes'];
					if(@$numRowsAgentes!=''){
						$ReportResultFinal = @$ResultFinal.' # '.$numRowsAgentes;
					}else{
						echo 'vacio';
					}
					
					?>
						<div  style="padding-bottom: 3px;">
							<button type="button" class="close" style="color: #000;padding-top:6px;padding-right:10px;" data-dismiss="modal">&times;</button>														
						</div>											
						<div class="modal-body" style="margin-top:15px;">
							<style>
							.modalContentDocment {
							  width: 100%;
							  height: 100%;
							  margin: 10px;
							  padding: 10px;
							}
							.datepicker table tr td span.active:hover,
							.datepicker table tr td span.active:hover:hover,
							.datepicker table tr td span.active.disabled:hover,
							.datepicker table tr td span.active.disabled:hover:hover,
							.datepicker table tr td span.active:active,
							.datepicker table tr td span.active:hover:active,
							.datepicker table tr td span.active.disabled:active,
							.datepicker table tr td span.active.disabled:hover:active,
							.datepicker table tr td span.active.active,
							.datepicker table tr td span.active:hover.active,
							.datepicker table tr td span.active.disabled.active,
							.datepicker table tr td span.active.disabled:hover.active,
							.datepicker table tr td span.active.disabled,
							.datepicker table tr td span.active:hover.disabled,
							.datepicker table tr td span.active.disabled.disabled,
							.datepicker table tr td span.active.disabled:hover.disabled,
							.datepicker table tr td span.active[disabled],
							.datepicker table tr td span.active:hover[disabled],
							.datepicker table tr td span.active.disabled[disabled],
							.datepicker table tr td span.active.disabled:hover[disabled] {
							  background-color: #11987d;
							}
							</style>
							<script>
								$(function() {
								  $("#txttypeService").val("<?php echo @$TYPE_SERVICE; ?>").change();
								});
							</script>
							<form class="form-horizontal" name="frm_PolizaG" id="frm_PolizaG">
								<div class="bs-example tabs-container with-nav-tabs panel-success">
									<div class="form-group form-group-sm">
										<label class="control-label col-xs-2">N° DE FOLIO:</label>
										<div class="col-xs-3 control-label-noFolio">
											<input type="text" id="txtnoFolio" name="txtnoFolio" class="form-control txtnoFolio" aria-describedby="helpBlock" onkeydown="return validarNumeros(event)" value="<?php echo @$NO_FOLIO; ?>" disabled>
										</div>
																							
										<label class="control-label col-xs-1">FECHA:</label>
										<div class="col-xs-2" id="dateFecha">
											<div class="input-group date">
												<input type="text" name="txtfecha" class="form-control txtfecha" id="txtfecha" value="<?php echo @$FECHA_POLIZA; ?>">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>												
										<label class="control-label col-xs-2">N° CLIENTE:</label>
										<div class="col-xs-2 control-label-noCliente">
											<input type="text" id="txtnoCliente" name="txtnoCliente" class="form-control txtnoCliente" aria-describedby="helpBlock" onkeydown="return validarNumeros(event)" value="<?php echo @$noCliente; ?>" disabled>
										</div>
										<div class="col-xs-3">
											<input type="text" id="txtSucu" name="txtSucu" value="<?=@$_SESSION['sesionSucur']?>" class="form-control txtSucu hidden" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label  class="control-label col-xs-3">NOMBRE DEL CLIENTE:</label>
										<div class="col-xs-9">
											<input type="text" id="txtnomClient" name="txtnomClient" class="form-control txtnomClient" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)" value="<?php echo @$NombreClienteMo.@$NombreCliente; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label  class="control-label col-xs-3">DIRECCION:</label>
										<div class="col-xs-9">
											<input type="text" id="txtdirection" name="txtdirection" class="form-control txtdirection" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)" value="<?php echo @$DireccionCliente; ?>" disabled>
										</div>
									</div>
									<table class="table table-bordered table-responsive-sm hidden">
										<thead>
											<tr>
												<th>#</th>
												<th>Tipo y Características Genéricas del Extintor y Extinguidor</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1-.</td>
												<td>Recipiente del extintor presurizado permanentemente, conteniendo como agente extinguidor agua, agua con adictivos, espuma y agua. En sus diferentes capacidades.</td>																
											</tr>
											<tr>
												<td>2-.</td>
												<td>Recipiente del extintor presurizado permanentemente, conteniendo como agente extinguidor polvo químico seco, agentes limpios, químico húmedo. En sus diferentes capacidades.</td>
											</tr>
											<tr>
												<td>5-.</td>
												<td>Extintor que contiene bióxido de carbono como agente extinguidor, y todos los cartuchos o cápsulas de los extintores categoría 3 y 4. En sus diferentes capacidades.</td>
											</tr>
										</tbody>
									</table>													
									<h4 style="color:#11987d">Características Genéricas del Extintor</h4>													
									<br>
									<div class="panele">
										<div class="panele-body">
											<table id="jqGrid" class="table"></table>
											<div id="jqGridPager"></div>
										</div>
									</div>
									<br>
									<div class="form-group form-group-sm <?=$VisibleCampos;?>" id="divExamVisu">
										<label  class="control-label col-xs-3">EXAMEN VISUAL:</label>
										<div class="col-xs-9">
											<input type="text" id="txtexamVisu" name="txtexamVisu" class="form-control txtexamVisu" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)" value="<?php echo @$EXAMEN_VISUAL; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm <?=$VisibleCampos;?>" id="divMedioPrue">
										<label  class="control-label col-xs-3">MEDIO DE PRUEBA:</label>
										<div class="col-xs-9">
											<input type="text" id="txtmedioPrue" name="txtmedioPrue" class="form-control txtmedioPrue" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)" value="<?php echo @$MEDIO_PRUEBA; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm <?=$VisibleCampos;?>" id="divPresOpe">
										<label  class="control-label col-xs-3">PRESION DE OPERACIÓN:</label>
										<div class="col-xs-3">															
											<input type="text" id="txtpresOpe" name="txtpresOpe" class="form-control txtpresOpe" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo @$PRESION_OPERACION; ?>" disabled>								
										</div>
										<label  class="control-label col-xs-3">PRESION DE PRUEBA:</label>
										<div class="col-xs-3">															
											<input type="text" id="txtpresPrue" name="txtpresPrue" class="form-control txtpresPrue" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo @$PRESION_PRUEBA; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm <?=$VisibleCampos;?>" id="divDuraPrue">
										<label  class="control-label col-xs-3">DURACION DE LA PRUEBA:</label>
										<div class="col-xs-9">
											<input type="text" id="txtduraPrue" name="txtduraPrue" class="form-control txtduraPrue" onkeyup="javascript:this.value=this.value.toUpperCase();" onkeydown="return validarLetras(event)" value="<?php echo @$DURACION_PRUEBA; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm <?=$VisibleCampos;?>" id="divObser">																			
										<label  class="control-label col-xs-3">OBSERVACIONES:</label>
										<div class="col-xs-9">															
											<textarea class="form-control txtObser text-uppercase" id="txtObser" name="txtObser" placeholder="Observaciones" onkeydown="return validarLetras(event)" disabled><?php echo @$OBSERV_POLIZA; ?></textarea>
										</div>
									</div>																								
									<div class="form-group form-group-sm" style="text-align:left">																			
										<label  class="control-label col-xs-3">RESPONSABLE ÁREA:</label>
										<div class="col-xs-9">															
											<input type="text" id="txtresponsable" name="txtresponsable" class="selectSearch form-control txtresponsable input-sm" value="<?php echo @$RESPONSABLE_AREA; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm" style="text-align:left">																			
										<label  class="control-label col-xs-3">TÉCNICO APLICADOR:</label>
										<div class="col-xs-9">
											<input type="text" id="txttecnico" name="txttecnico" class="selectSearch form-control txttecnico input-sm" value="<?php echo @$TECNICO_APLICADOR; ?>" disabled>
										</div>
									</div>
									<div class="form-group form-group-sm" style="text-align:left">																			
										<label  class="control-label col-xs-3">ÁREA ADMINISTRACIÓN:</label>
										<div class="col-xs-9">
											<input type="text" id="txtadministracion" name="txtadministracion" class="selectSearch form-control txtadministracion input-sm" value="<?php echo @$AREA_ADMINISTRACION; ?>"disabled>
											<input type="text" id="txtrutaPdf" name="txtrutaPdf" class="form-control txtrutaPdf input-sm hidden" value="<?php echo @$RUTA_PDF; ?>" disabled>
											<input type="text" id="txtrutaPdf_PH" name="txtrutaPdf_PH" class="form-control txtrutaPdf_PH input-sm hidden" value="<?php echo @$RUTA_PDF_PH; ?>" disabled>
										</div>
									</div>		
								</div>
							</form>	<br>													
						</div>
						<div class="modal-footer" style="margin-top:-5px;">		
							<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="SendActualiPolizaG" data-style="expand-right"> <span class="fa fa-save"></span> &nbsp; Guardar</button>
							<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>												
						</div>
						<script>
							$(document).ready(function () {
								var sizeWidthJqGrid = $('.tabs-container').width();
								$("#jqGrid").jqGrid({											
									url: '../../repositorio/DataJson/DataExtintores/listarJsonBlank.php?rutaJson=<?php echo $RUTA_JSON; ?>',
									editurl: 'validExtintores.php',
									datatype: "json",
									colModel: [
										{
											label: 'CANTIDAD (PZA)',
											name: 'Cantidad',													
											width: 52,
											sortable: false,
											required: true,
											editable: false 
										},
										{
											label : 'CAPACIDAD KG',
											name: 'Capacidad',
											width: 52,
											sortable: false,
											required: true,
											editable: false 
										},
										{
											label: 'PQS | CO2 | AGUA | AFFF ',
											name: 'AgenteExt',
											width: 90,
											editable: false,
											edittype: "select",
											sortable: false,
											editoptions: {
												 value: ":;PQS:PQS;CO2:CO2;Agua:Agua;AFFF:AFFF"
											}
										},
										{
											label: 'OTROS',
											name: 'AgenteExtOtros',
											width: 70,
											sortable: false,
											required: true,
											editable: false 
										},
										{
											label: 'RECARGA | NUEVO | MANTEN ',
											name: 'TypeService',
											width: 90,
											editable: false,
											edittype: "select",
											sortable: false,
											editoptions: {
												 value: ":;Mantenimiento:Mantenimiento;Recarga:Recarga;Nuevo:Nuevo"
											} 
										}
									],
									// sortname: 'Id',
									// sortorder : 'asc',
									loadonce: true,
									viewrecords: true,
									onSelectRow: editRow,
									height: 205,
									width: sizeWidthJqGrid,
									shrinkToFit: true,
									rowNum: <?php echo @$numRowsAgentes; ?>,
									rownumbers: false, // show row numbers
									pager: "#jqGridPager",
									caption: "Características Genéricas del Extintor",
									loadingText: 'Cargando...',
									noRecordText: 'No se encontraron registros'
								});								
								
								  //Agregar el Boton de Guardar Tabla//
										paginador = $('#jqGrid').getGridParam('pager');
										jQuery('#jqGrid').navGrid(paginador, {
											edit: false,
											add: false,
											del: false,
											search: false,
											refresh: false
										}).navButtonAdd(paginador, {
											caption: "Guardar",
											buttonicon: "fa fa-save",
											onClickButton: function() {
												var idJqgrid = jQuery("#jqGrid").jqGrid('getGridParam','selrow');
												if (idJqgrid){ var ret = jQuery("#jqGrid").jqGrid('saveRow',idJqgrid); } else { }
											}
										});
									//*************************************//
								
								 $('#jqGrid').setGroupHeaders(
									{
										useColSpanStyle: true,
										groupHeaders: [{ "numberOfColumns": 2, "titleText": "<center>AGENTE EXTINGUIDOR</center>", "startColumnName": "AgenteExt" },
													{ "numberOfColumns": 1, "titleText": "<center>TIPO DE SERVICIO</center>", "startColumnName": "TypeService" }]
									});
								
								var lastSelection;
								function editRow(id) {
									 if (id && id !== lastSelection) {												
										var grid = $("#jqGrid");
										grid.jqGrid('saveRow',lastSelection);
										grid.jqGrid('editRow',id, {keys: true} );
										lastSelection = id;												
									 }
								}										
								// the bindKeys() 
								$("#jqGrid").jqGrid('bindKeys');																	
								$('.ui-jqgrid-titlebar.ui-jqgrid-caption.ui-widget-header.ui-corner-top.ui-helper-clearfix').append('<a href="javascript:;" class="ui-jqgrid-titlebar-close ui-corner-all HeaderButton" style="right:2.5%;" data-click="panel-expand"><i class="fa fa-expand"></i></a>');																						
							});		
							$( '#SendActualiPolizaG' ).click( function (event) {											
								event.preventDefault();									
									//Guardar Tabla Jqgrid
										var idJqgridE = jQuery("#jqGrid").jqGrid('getGridParam','selrow');
											if(idJqgridE){ var retJqgrid = jQuery("#jqGrid").jqGrid('saveRow',idJqgridE); } else { }
								
								$(this).prop( "disabled", true ).addClass('fa-spin');
								var formUpdatedPolizaG = 'formUpdatedPolizaG';
								var noFolio = $( '.txtnoFolio' ).val(),										
								noCliente = $( '.txtnoCliente' ).val(),
								sucursal = $( '.txtSucu' ).val(),
								fecha_service = $( '.txtfecha' ).val(),
								examVisu = $( '.txtexamVisu' ).val(),
								medioPrue = $( '.txtmedioPrue' ).val(),
								presOpe = $( '.txtpresOpe' ).val(),
								presPrue = $( '.txtpresPrue' ).val(),
								duraPrue = $( '.txtduraPrue' ).val(),
								Obser = $( '.txtObser' ).val(),																		
								rutaPdfPolizaG = '../../../'+$('.txtrutaPdf').val(),
								rutaPdfPH = '../../../'+$('.txtrutaPdf_PH').val(),
								TypeUser = 'TECNICO';	

								/* Recorrer tabla de Agentes Extintores */
								var banderaNextStep = false;
									// CamposGrid = [];
									// var id_object = 0
										// $("#jqGrid tbody tr").each(function (index){											
											// var cantidadAE, capacidadAE, agenteExtAE, agenteExtOtroAE, typeService_object;
											// $(this).children("td").each(function (index2){
												// switch (index2){
													// case 0: cantidadAE = $.trim($(this).text()); break;
													// case 1: capacidadAE = $.trim($(this).text()); break;
													// case 2: agenteExtAE = $.trim($(this).text()); break;
													// case 3: agenteExtOtroAE = $.trim($(this).text()); break;
													// case 4: typeService_object = $.trim($(this).text()); break;													
												// }
												// // $(this).css("background-color", "#ECF8E0");																								
											// });											
											// // if(cantidadAE!='' || capacidadAE!=''){
											// if(id_object!=0){													
												// $.post( 'newPolizaG.php' , { formUpdatedPolizaG:formUpdatedPolizaG,noFolio:noFolio,typeRegistro:'AgenteExt',fecha_service:fecha_service,noCliente:noCliente,SetIdClient:noCliente,SetPdfPH:'<?php echo $SetPdfPH; ?>',
																	// id_object:id_object,cantidadAE:cantidadAE,capacidadAE:capacidadAE,agenteExtAE:agenteExtAE,agenteExtOtroAE:agenteExtOtroAE,typeService_object:typeService_object,typeDocument:typeDocument,responsable:responsable,tecnico:tecnico,administracion:administracion,nomClient:nomClient} );														
												// banderaNextStep = true;
												// CamposGrid.push(id_object,cantidadAE,capacidadAE,agenteExtAE,agenteExtOtroAE,typeService_object);
											// } id_object++;
											// // }
										// });	
								
								if(banderaNextStep==true){
									$.post( 'newPolizaG.php' , { GererateJsonPG : 'GererateJsonPG', CamposGrid:CamposGrid , noCliente:noCliente, sucursal:sucursal, SetIdClient:noCliente, SetPdfPH:'false' });	
								}															
								
								$.post( 'newPolizaG.php' , { formUpdatedPolizaG:formUpdatedPolizaG,noFolio:noFolio,typeRegistro:'General',fecha_service:fecha_service,noCliente:noCliente,
														examVisu:examVisu,medioPrue:medioPrue,presOpe:presOpe,presPrue:presPrue,duraPrue:duraPrue,Obser:Obser,typeDocument:'<?php echo $TYPE_DOCUMENT; ?>',SetIdClient:noCliente,SetPdfPH:'false'},
										function ( exito ){												
											// var varResult = exito.split("#");	
											// $('.result-Ajax').html(exito).fadeIn(2000);
											// alert(exito);											
												setTimeout(function() {	 
													// Actualiza Pdf deacuerdo a los cambios capturados por el Tecnico
													var hrefUrlUpdatePolizaPdf = '../../repositorio/fpdf/pdfExtintores/UpdatePolizaGPdf.php?';												
													var hrefParamUpdatePolizaPdf = "rutaPdfPolizaG="+rutaPdfPolizaG+"&fecha_service="+fecha_service+"&TypeUser="+TypeUser+"&noFolio="+noFolio+"&typeDocument=POLIZA";
													$("#GeneratePdf").load(hrefUrlUpdatePolizaPdf,hrefParamUpdatePolizaPdf);													
														if('<?php echo $TYPE_DOCUMENT; ?>'=='POLIZA-PH'){
															var hrefParamUpdatePHPdf = "rutaPdfPH="+rutaPdfPH+"&fecha_service="+fecha_service+"&TypeUser="+TypeUser+"&noFolio="+noFolio+"&typeDocument=<?php echo $TYPE_DOCUMENT; ?>";
															$("#GeneratePdf2").load(hrefUrlUpdatePolizaPdf,hrefParamUpdatePHPdf);	
														}													
													$('#SendActualiPolizaG').prop( "disabled", false ).removeClass('fa-spin');
													$('#modalOrdenTrabajoEdit').modal('hide');
												},2000);
												setTimeout(function() {
													toastr.options = {
														closeButton: true,
														progressBar: true,
														positionClass: 'toast-top-right',
														showMethod: 'slideDown',
														timeOut: 5000
													};
													toastr.success('','DATOS ACTUALIZADOS CORRECTAMENTE');
												},3200);
											
										});											
								return false;
							});
							$(document).ready( function(event){
								$('#dateFecha .input-group.date').datepicker({
								startView: 1,
								daysOfWeekDisabled: "0,6",
								keyboardNavigation: false,
								forceParse: false,
								autoclose: true,
								format: "yyyy-mm-dd"
								});																	
							});
						</script>
					<?php
				break;
			default:
				echo 'vacio';
		}
}else{
	echo 'vacio';
}?>

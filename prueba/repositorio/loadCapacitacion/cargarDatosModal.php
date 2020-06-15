<?php session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
	
	sleep(1);
	require('../../bd/bd.php');

	$db = new DbCnnx();
	
	@$txtSucu= $_SESSION['sesionSucur'];
	@$TypeAutocomplite= $_REQUEST['TypeAutocomplite']; 
	@$GetnoFolio= $_REQUEST['SendnoFolio'];
		
		switch ($TypeAutocomplite) {			
			case "ViewConstanc":
						
					$QuerySearchConstan = "SELECT (SELECT COUNT(*) FROM mod_capacitacion WHERE NO_FOLIO='$GetnoFolio' AND NOMBRE_RA!='') AS NumPerson,ID_CAPACITACION,FECHA_REGISTRO,NAME_CURSO,NAME_INSTRUCTOR,RUTA_JSON FROM mod_capacitacion WHERE NO_FOLIO='$GetnoFolio' AND TIPO_REGISTRO='General' GROUP BY NO_FOLIO";										
					$reConstant = $db->select($QuerySearchConstan);
					$recConstant = $db->combo($QuerySearchConstan);	
					@$numRows = $recConstant->num_rows;
					if(@$numRows==0){ echo 'vacio'; }else{ ?>
															
						<div class="modal-body">
							<style> .modalContentDocment { width: 85%; } </style>
							<button type="button" class="close" id="closeModalEvidence" onclick="location.reload();"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
							<h3><strong>Detalle de Constancia Protección Civil</strong></h3> <hr style="border-top: 2px dashed #188670de;">
							<div class="sk-spinner sk-spinner-double-bounce" style="display:none;margin-top:18%;margin-left: 45%;z-index: 99999;position: absolute;">
								<div class="sk-double-bounce1"></div>
								<div class="sk-double-bounce2"></div>
							</div>
							<div class="row">
								<div class="col-sm-12" style="text-align:center;vertical-align:middle">												
									<form class="form-horizontal" name="frm_Constancias" id="frm_Constancias">
										<div class="bs-example tabs-container with-nav-tabs panel-success">													
											<div class="form-group form-group-sm">
												<label class="control-label col-xs-2 control-noFolio">N° DE FOLIO:</label>
												<div class="col-xs-4 control-label-noFolio">
													<input type="text" id="txtnoFolio" name="txtnoFolio" value="<?php echo $GetnoFolio; ?>" class="form-control txtnoFolio" aria-describedby="helpBlock" disabled>
												</div>
																									
												<label class="control-label col-xs-2">FECHA:</label>
												<div class="col-xs-4">
													<input type="date" id="txtfecha" name="txtfecha" class="form-control txtfecha" value="<?php echo date('Y-m-d',strtotime($reConstant[0]['FECHA_REGISTRO'])); ?>" disabled>
												</div>
											</div>													                   
											<div class="form-group form-group-sm ">
												<label class="control-label col-xs-2">Nombre del Curso: </label>
												<div class="col-xs-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-list-alt"></i>
														</span>
														<input type="text" name="txtNameCurso" id="txtNameCurso" value="<?php echo ucwords(mb_strtolower($reConstant[0]['NAME_CURSO'], 'UTF-8')); ?>" placeholder="Nombre del Curso" class="form-control txtNameCurso text-uppercase" disabled>
													</div>
												</div>
												<label class="control-label col-xs-2">Nombre Instructor:</label>
												<div class="col-xs-4">														
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-list-alt"></i>
														</span>
														<input type="text" name="txtInstructor" id="txtInstructor" value="<?php echo $reConstant[0]['NAME_INSTRUCTOR']; ?>" placeholder="Nombre del instructor" class="form-control txtInstructor text-uppercase" disabled>
													</div>	
												</div>	
											</div>
											<div class="form-group form-group-sm">
												<label class="control-label col-xs-2 control-NumDC5">Número DC5:</label>
												<div class="col-xs-4 control-NumDC5">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-sort-numeric-asc"></i>
														</span>
														<input type="text" name="txtNumeroDc" id="txtNumeroDc" placeholder="Escriba el número de DC5 del instructor" class="form-control txtNumeroDc text-uppercase" disabled>
													</div>
												</div>
												<label class="control-label col-xs-2 control-NumPCivil">Num. Protección Civil:</label>
												<div class="col-xs-4 control-NumPCivil">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-sort-numeric-asc"></i>
														</span>
														<input type="text" name="txtNumeroPC" id="txtNumeroPC" placeholder="Escriba el número de protección civil " class="form-control txtNumeroPC text-uppercase" disabled>
													</div>
												</div>
											</div>
											<div class="jqGrid_wrapper">
												<table id="table_list_1"></table>
												<div id="pager_list_1"></div>
											</div>													
										</div>
									</form>	<br>											
								</div>																			
							</div>	
							<?php var_dump($reConstant); ?>
							<br>													
						</div>
						<div class="modal-footer" style="margin-top:-5px;">		
							<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>	
							<script>
								$(document).ready(function () {										
									// Configuration for jqGrid Example 1
									var sizeWidthJqGrid = $('.tabs-container').width(); var validJqgridCurp = true;
									$("#table_list_1").jqGrid({
										url: '../../repositorio/DataJson/DataCapacitacion/listarJsonBlank.php?rutaJson=<?php echo $reConstant[0]['RUTA_JSON']; ?>',
										editurl: 'generateConstan.php',
										datatype: "json",
										height: 250,
										autowidth: true,
										width: sizeWidthJqGrid,
										shrinkToFit: true,
										rowNum: <?php echo $reConstant[0]['NumPerson']; ?>,
										loadonce: true,
										colModel: [
											{
												label: 'N°',
												name: 'Id',
												width: 20,
												sortable: false	
											},
											{
												label : 'Nombre Completo',
												name: 'name',
												width: 200,
												sortable: false,
												required: true,
												editable: false 
											},
											{
												label: 'Folio',
												name: 'folio',
												width: 180,
												sortable: false,
												required: true,
												editable: false 
											}
										],
										pager: "#pager_list_1",
										viewrecords: true,
										caption: "REGISTRO DE ALUMNOS",
										hidegrid: true,
										loadingText: 'Cargando...',
										noRecordText: 'No se encontraron registros'
									});
									// Add responsive to jqGrid
									$(window).bind('resize', function () {
										var width = $('.jqGrid_wrapper').width();
										$('#table_list_1').setGridWidth(width);
									});
									
									var lastSelection;
												
									// the bindKeys() 
									$("#table_list_1").jqGrid('bindKeys');																	
									$('.ui-jqgrid-titlebar.ui-jqgrid-caption.ui-widget-header.ui-corner-top.ui-helper-clearfix').append('<a href="javascript:;" class="ui-jqgrid-titlebar-close ui-corner-all HeaderButton" style="right:2.5%;" data-click="panel-expand"><i class="fa fa-expand"></i></a>');	
								});												
							</script>
						</div>
						
					<?php }
				break;
			default:
				echo 'vacio';
		}
}else{
	echo 'vacio';
}?>

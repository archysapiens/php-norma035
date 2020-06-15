<?php session_start();
sleep(1);
require('../../bd/bd.php');

$db = new DbCnnx();

if($_REQUEST['noCliente']!='')
{
	@$noCliente= $_REQUEST['noCliente'];
	@$noFolio= $_REQUEST['noFolio'];
	@$sufijo= $_REQUEST['sufijo'];
	@$typeDocument= $_REQUEST['typeDocument'];
	@$carpetByFirmaClient= $_REQUEST['carpetByFirmaClient'];	
	@$hrefRutaFpdfClient= $_REQUEST['hrefRutaFpdfClient'];
	@$hrefRutaFpdfPHPClient= $_REQUEST['hrefRutaFpdfPHPClient'];
	
		
		$QuerySearch = "SELECT * FROM usuarios WHERE no_cliente_emp='$noCliente' limit 1";
		$row = $db->select($QuerySearch);
		@$EmailOfEnvioClient = $row[0]['EMAIL'];
		@$NomCompletClient = $row[0]['NOMBRE_U'].' '.$row[0]['APP_PATERNO_U'].' '.$row[0]['APP_MATERNO_U'];
		@$IdUser = $row[0]['NO_CLIENTE_EMP'];
		@$hrefRutaFirmaClient= $_REQUEST['hrefRutaFirmaClient'].@$NomCompletClient.'-'.@$noFolio.'-'.@$noCliente.'.png';
		
		?>
						<script src="<?=@$sufijo?>web/js/plugins/canvas/canvasClient.js"></script> <!--Canvas -->
						<div  style="padding-bottom: 3px;">
							<button type="button" class="close" style="color: #000;padding-top:6px;padding-right:10px;" data-dismiss="modal">&times;</button>
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" id="FirstTabClient" class="active"><a href="#emailClient" aria-controls="emailClient" role="tab" data-toggle="tab">Correo de Envio</a></li>
								<li role="presentation" id="SecondTabClient" ><a href="#canvasTabFirmaClient" aria-controls="canvasTabFirmaClient" role="tab" data-toggle="tab">Firma Cliente</a></li>															
							</ul>
						</div>											
						<div class="modal-body ">
							<div class="tab-content">															
								<div role="tabpanel" class="tab-pane active" id="emailClient" style="height:280px;">
									<div class="form-group form-group-sm row" style="padding-top:50px">
										<label  for="example-email-input" class="control-label col-xs-2">Correo:</label>
										<div class="col-xs-8">															
											<div class="input-group">	
												<div class="input-group-addon">
													<span class="fa fa-envelope"></span>
												</div>
												<input class="form-control txtcorreoClientEnvio" name="txtcorreoClientEnvio" type="email" value="<?=@$EmailOfEnvioClient;?>" placeholder="correo@example.com" id="txtcorreoClientEnvio" aria-describedby="passwordHelpBlock" required>																				
											</div>
											<small id="passwordHelpBlock" class="form-text text-muted text-danger" style="color: rgb(185, 38, 38);"><br>
												&nbsp; &nbsp; &nbsp; Revisar Correo de envio <b><?=@$EmailOfEnvioClient;?></b>
											</small>
										</div>
										<a id="NexTabCanvasFirmaClient" style="margin-top:120px;" href="#canvasTabFirmaClient" aria-controls="canvasTabFirmaClient" data-toggle="tab" class="btn btn-primary btn-md active" role="button">Next &nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="canvasTabFirmaClient">
									<canvas id="canvasClient">Su navegador no soporta Firma Electronica :( </canvas>
								</div>
							</div>														
						</div>
						<div class="modal-footer" style="margin-top:-5px;">
							<field>															
								<a id="downloadClient" class="btn btn-primary btn-md active hidden" role="button">Guardar Firma</a>
								<button type="button" id="limpiarFirmaClient" class="btn btn-default  btn-md active hidden">Limpiar</button>
								<button type="button" class="btn btn-white hidden" data-dismiss="modal">Cerrar</button>
							</field>
						</div>
						
						<script type="text/javascript">
							$(".modal-content .close").click(function() { $('#ChangeViewport').attr('content', 'maximum-scale=1'); });
							$("#FirstTabClient").click(function() {							
								$('#downloadClient').addClass('hidden');
								$('#limpiarFirmaClient').addClass('hidden');
							});
							$("#SecondTabClient").click(function() {
								$('#limpiarFirmaClient').removeClass('hidden');
								$('#downloadClient').removeClass('hidden');
							});
							$("#NexTabCanvasFirmaClient").click(function() {
								$('#FirstTabClient').removeClass('active');
								$('#SecondTabClient').addClass('active');
								$('#limpiarFirmaClient').removeClass('hidden');
								$('#downloadClient').removeClass('hidden');
							});
							var hrefRutaFirmaClient = '<?php echo $hrefRutaFirmaClient;?>';
							var hrefRutaFpdfClient = '<?php echo $hrefRutaFpdfClient;?>';
							var hrefRutaFpdfPHPClient = '<?php echo $hrefRutaFpdfPHPClient;?>';
							
							$('#downloadClient').click(function(event){
								$('#ChangeViewport').attr('content', 'maximum-scale=1');		
								event.preventDefault();											
								var correoEnvioClient = $('.txtcorreoClientEnvio').val();
								var dirTypeFumi = '<?php echo $carpetByFirmaClient;?>';
								var nomCompletClient = '<?php echo $NomCompletClient;?>';																																		
								var FolioValidClient = '<?php echo $noFolio;?>';																																	
								var IdClientValid = '<?php echo $noCliente;?>';																																	
								var sendSucursal = '<?php echo @$_SESSION['sesionSucur'];?>';																																	
								var IdUser = '<?php echo @$IdUser;?>';																																	
								var typeDocument = '<?php echo @$typeDocument;?>';										
								var TypeUser = 'CLIENTE';
								var orientacion = '';
										
										if(typeDocument=='POLIZA-PH'){ orientacion='V'; }								
										if(typeDocument=='POLIZA'){ orientacion='V'; }								
									
									var RequestFirma = downloadCanvasFirmaClient(this, 'canvasClient', nomCompletClient+'-'+FolioValidClient+'-'+IdClientValid, correoEnvioClient, dirTypeFumi, '<?php echo @$_SESSION['sesionSucur'];?>', TypeUser, IdUser);														
									if(RequestFirma==true){
										$(".GeneratePdfFirmClient").removeClass('hidden');
										$(".modalDialogFirma").addClass('hidden');
										$(".GeneratePdfFirmClient").html("<img src='../../web/images/loading_BIG.gif' style='color:white;padding-top:20%;padding-left:32%'/>");
										setTimeout(function(){ 											
											if(TypeUser =='CLIENTE'){
												var hrefUrlAddFirma = '../../repositorio/fpdf/pdfExtintores/addFirma.php?';	
												if(typeDocument=='POLIZA-PH'){												
													var hrefParamAddFirmaPHFpdf = "hrefRutaFpdf="+hrefRutaFpdfPHPClient+"&hrefRutaFirma="+hrefRutaFirmaClient+"&TypeUser="+TypeUser+"&NoFolio="+FolioValidClient+"&sendSucursal="+sendSucursal+"&IdClientValid="+IdClientValid+"&position="+orientacion+"&typePDF=pruebasH";
													$(".GeneratePdfFirmClient").load(hrefUrlAddFirma,hrefParamAddFirmaPHFpdf); }																							
												var hrefParamAddFirmaFpdf = "hrefRutaFpdf="+hrefRutaFpdfClient+"&hrefRutaFirma="+hrefRutaFirmaClient+"&TypeUser="+TypeUser+"&NoFolio="+FolioValidClient+"&sendSucursal="+sendSucursal+"&IdClientValid="+IdClientValid+"&position="+orientacion;
												$(".GeneratePdfFirmClient").load(hrefUrlAddFirma,hrefParamAddFirmaFpdf);
											}																					
											$('#CanvasFirmaCliente').modal('hide');
											$(".GeneratePdfFirmClient").addClass('hidden');												
											$.confirm({
												title: 'Validación Correcta!',
												content: '',
												type: 'green',
												theme: 'modern',
												typeAnimated: true,
												animationSpeed: 1000, // 2 seconds
												animation: 'scale',
												closeAnimation: 'scale',
												closeIcon: true,
												draggable: true,
												icon: 'fa fa-check',
												closeIconClass: 'fa fa-close',
												closeIcon: function(){ location.reload(); },
												buttons: {
													close: function () {
														location.reload();
													}
												}
											});											
										}, 10000);
									}													
																													
							});	
						</script>
						<!--Guardar imagen en .PNG-->
						<script>
							function downloadCanvasFirmaClient(link, canvasId, filename, correoEnvio, dirTypeFumi, sucursal, TypeUser, IdUser) {
								dataHref = document.getElementById(canvasId).toDataURL();
								// alert(Trazados);
								if(Trazados!='' && Trazados!=',' && Trazados!=',,' && Trazados!=',,,' && Trazados!=',,,,' && Trazados!=',,,,,' && Trazados!=',,,,,,'){										
									// alert('conFirma');
									var params = 'dataHref='+dataHref+'&IdUser='+IdUser+'&TypeUser='+TypeUser+'&sucursal='+sucursal+'&dirTypeFumi='+dirTypeFumi+'&dataFilename='+filename+'&correoEnvio='+correoEnvio;
									var xhr = new XMLHttpRequest();
									xhr.onreadystatechange = function() {
									  // request complete
									  if (xhr.readyState == 4) {
										// window.open('http://localhost/ArchysoftMVC/Ecosheys/web/images/FileUpload/canvasFirma/'+xhr.responseText,'_blank');
									  }
									}
									xhr.open('POST','../../repositorio/loadExtintores/canvasFirmaClient.php',true);
									xhr.setRequestHeader('Content-Type', 'application/upload');
									xhr.send(params);
									
									return true;
								}else{
									alert('No hay Firma');
									return false;
								}									
							}
						</script>
		
		<?php
}else{
	echo 'vacio';
}?>

<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!='' & $_REQUEST['SetIdClient']!='' & $_REQUEST['SetPdfPH']!=''){
	
	var_dump($_REQUEST['SetIdClient']);
	exit;
$SetIdClient = $_REQUEST['SetIdClient'];
$SetPdfPH = $_REQUEST['SetPdfPH'];
$sufijo='../../'; $sufijoMenu='../';
require('../../clases/Extintores.php');
require('../../bd/bd.php');
include("../../template/menu.php");
include("../../helpers.php");

$Extintores = new Extintores();

$SelectResponsable=$Extintores->loadSelectResponsable();
$SelectTecnico=$Extintores->loadSelectTecnico();
$SelectAdministrativa=$Extintores->loadSelectAdministrativa();

if(isset($_POST['formCreatedNewPolizaG'])){
		$Extintores->savePolizaAndPH($_POST);
	}else if(isset($_POST['GererateJsonPG'])){
		$Extintores->gererateJsonPG($_POST);}
	else if(isset($_POST['formAddEmailEnvio'])){
		$Extintores->saveAddEmailCorreoEnvioPG($_POST);}
	else if(isset($_POST['formUpdatedPolizaG'])){
		$Extintores->updatePolizaGAndPHTecnico($_POST);}
	else{
 ?>
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<!--meta name="viewport" content="width=device-width, initial-scale=1"-->
					<meta name="viewport" content="maximum-scale=1">
					<meta name="description" content="">
					<meta name="author" content="">
					<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
					<title>Servicios Ecosheys</title>					
						<link href="<?=@$sufijo?>web/css/bootstrap.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/font-awesome/css/font-awesome.css" rel="stylesheet">
						<!-- Toastr style -->
						<link href="<?=@$sufijo?>web/css/plugins/toastr/toastr.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/select2/4.0.3select2.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/animate.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/timeLine.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<link rel="stylesheet" href="<?=@$sufijo?>web/css/plugins/alert/alert.min.css">
						<?php if(@$_SESSION['sesionPrivi']=='ADMINISTRADOR' or @$_SESSION['sesionPrivi']=='OPERATIVA'){ ?>
						<script>
							 $(document).ready(function() {
								$(".selectSearch").select2({
								  placeholder: "SELECCIONA...",
								  allowClear: true
								});			
							});
						</script>
						<?php } ?>
				</head>
				<body> <?php

					$loadCssHeader='';

					$breadcrumb='Servicios de Extintores';
					$breadcrumbPrincipal='Póliza de Garantía y/o Carta Responsiva';
					$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'SelectResponsable'=>$SelectResponsable,'SelectAdministrativa'=>$SelectAdministrativa,'SelectTecnico'=>$SelectTecnico,'SetIdClient'=>$SetIdClient,'SetPdfPH'=>$SetPdfPH);

					view('Extintores/newPolizaG',$variables); 
					include("../login/control_session.php"); ?>
		
					
						<?php top_scroll(); ?>
						<!-- Mainly scripts -->
						<script src="<?=@$sufijo?>web/js/jquery-2.1.1.js"></script>
						<script src="<?=@$sufijo?>web/js/bootstrap.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/metisMenu/jquery.metisMenu.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/alert/alert.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/select2/select2.js"></script>
						<!-- Modal 
						<script src="web/js/plugins/modal/jquery.modal.js"></script> -->
						<!-- Flot -->
						<script src="<?=@$sufijo?>web/js/plugins/flot/jquery.flot.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/flot/jquery.flot.spline.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/flot/jquery.flot.resize.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/flot/jquery.flot.pie.js"></script>						
						<!-- Peity -->
						<script src="<?=@$sufijo?>web/js/plugins/peity/jquery.peity.min.js"></script>
						<!-- jqGrid -->
						<script src="<?=@$sufijo?>web/js/plugins/jqGrid/i18n/grid.locale-es.js"></script>					
						<script type="text/javascript" src="<?=@$sufijo?>web/js/plugins/jqgrid/jquery.jqGrid.min.js" ></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/plugins/jqgrid/jqgridExcelExportClientSide.js" ></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/plugins/jqgrid/jqgridExcelExportClientSide-libs.js" ></script>
						<!-- Custom and plugin javascript -->
						<script src="<?=@$sufijo?>web/js/inspinia.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/pace/pace.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/canvas/canvas.js"></script> <!--Canvas -->
						<!-- Toastr -->
						<script src="<?=@$sufijo?>web/js/plugins/toastr/toastr.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> 
						<!-- Ladda -->
						<script src="<?=@$sufijo?>web/js/plugins/ladda/spin.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/ladda/ladda.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/ladda/ladda.jquery.min.js"></script>

						<script src="<?=@$sufijo?>web/js/apps.js"></script>	
						<script src="<?=@$sufijo?>web/js/plugins/jquery-ui/jquery-ui.min.js"></script>
						<!-- REQUIRED: Functional Widgets -->
						<script src="<?=@$sufijo?>web/js/plugins/smartwidgets/include/jarvis.widget.min.js"></script>
						 <!-- Data picker -->
						<script src="<?=@$sufijo?>web/js/plugins/datapicker/bootstrap-datepicker-spanish.js"></script>
						<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
									
						<script>
						$(document).ready(function(){
							App.init();
							// $('.timepicker').timepicker('setTime', new Date());							
							// $('.timepicker2').timepicker('setTime', new Date());							
							// $('.timepicker').on('click', function (){});
							// $('.timepicker2').on('click', function (){});
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
								   url: 'newExtintores.php',
								   type: 'text',
								   pk: 1,
								   name: 'RecibiDe',
								   inputclass: 'text-uppercase',
								   title: 'Escribir Nombre'
								});
								$('#PrecioNum').editable({
								   url: 'newExtintores.php',
								   type: 'text',
								   pk: 1,
								   name: 'PrecioNum',
								   inputclass: 'text-capitalize',
								   title: 'Escribir Nombre'
								});
								$('#PrecioLetras').editable({
								   url: 'newExtintores.php',
								   type: 'text',
								   pk: 1,
								   name: 'PrecioLetras',
								   inputclass: 'text-capitalize',
								   title: 'Escribir Nombre'
								});
						});
						</script>
						<script>
						$(document).ready(function (){
							Ladda.bind( '.ladda-button',{ timeout: 7000 });
							Ladda.bind( '.progress-demo .ladda-button',{
								callback: function( instance ){
									var progress = 0;
									var interval = setInterval( function(){
										progress = Math.min( progress + Math.random() * 0.1, 1 );
										instance.setProgress( progress );

										if( progress === 1 ){
											instance.stop();
											clearInterval( interval );
										}
									}, 400 );
								}
							});
						});
						window.addEventListener("load", function() {
						  frm_PolizaG.txtnoCliente.addEventListener("keypress", soloNumeros, false);
						});

						//Solo permite introducir numeros.
						function soloNumeros(e){
						  var key = window.event ? e.which : e.keyCode;
						  if (key < 48 || key > 57) {
							e.preventDefault();
						  }
						}
						</script><?php
		
	}
}
else{
    // session_unset();
    echo"<script> location.href = 'newExtintores.php' </script>";
}
?>

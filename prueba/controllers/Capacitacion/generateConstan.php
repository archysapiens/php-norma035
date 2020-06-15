<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
	
	if(isset($_REQUEST['action'])){ 
		switch ($_REQUEST['action']) {
			case 'NuevaConstancia':
				$arraySession = array('action'=>'Nueva Constancia','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession; exit;
				break;
			case 'EditConstanPC':
				$arraySession = array('action'=>'Editar Constancia(s) de Proteccción Civil','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession; exit;
				break;
			} }
	
$sufijo='../../'; $sufijoMenu='../';
require('../../clases/Capacitacion.php');
require('../../repositorio/NiceDate.php');
require('../../bd/bd.php');
include("../../template/menu.php");
include("../../helpers.php");

$Capacitacion = new Capacitacion();

$SelectCourse=$Capacitacion->loadSelectCourse();
$SelectInstruct=$Capacitacion->loadSelectInstruct();
$loadListConstan=$Capacitacion->loadListConstan();
	if($loadListConstan->num_rows > 0){ $visibility='ListConstan'; }else{ $visibility='NewConstan'; }
	if(isset($_SESSION['page']['paramters']['visibility'])){ $visibility=$_SESSION['page']['paramters']['visibility'];  unset($_SESSION['page']); }
	if(isset($_SESSION['page']['paramters']['attrFolio'])){ $visibility='NewConstan'; $getRequest=$_SESSION['page']['paramters']; unset($_SESSION['page']); }

	if(isset($getRequest)){ $editConstancia=$Capacitacion->editConstanPC($getRequest['attrFolio']); }else{ $editConstancia=''; }
if(isset($_POST['formCreatedNewConstan'])){
		$Capacitacion->saveNewConstancia($_POST);
		exit;
	}elseif(isset($_POST['GererateJsonPC'])){
		$Capacitacion->gererateJsonPC($_POST); exit;
	}else if($_REQUEST['action']=='GenerateConstanciasPC'){
		$Capacitacion->GenerateConstanciasPC($_REQUEST); exit; 
	}elseif($_REQUEST['action']=='ListALumns'){
		$Capacitacion->listALumns($_REQUEST); exit; 
	}else if($_REQUEST['action']=='ShowConstancias'){
			$Capacitacion->ShowConstanciasPC($_REQUEST); exit; }
	elseif($_REQUEST['action']=='searchDataInstruc'){
		$Capacitacion->searchDataInstruc($_REQUEST); exit; 
	}else{
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
						 <!-- FooTable -->
						<link href="<?=@$sufijo?>web/css/plugins/footable/footable.core.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/timeLine.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/iCheck/custom.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<link rel="stylesheet" href="<?=@$sufijo?>web/css/plugins/alert/alert.min.css">
						<style>body { -moz-transform: scale(0.9, 0.9); zoom: 0.9; zoom: 90%; }</style>
				</head>
				<body> <?php

					$loadCssHeader='';

					$breadcrumb='Servicios de Protección Civil';
					$breadcrumbPrincipal='Constancias Protección Civil';
					$variables= array('visibility'=>$visibility,'sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'SelectCourse'=>$SelectCourse,'SelectInstruct'=>$SelectInstruct,'loadListConstan'=>$loadListConstan,'editConstancia'=>$editConstancia);

					view('Capacitacion/generateConstan',$variables); 
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
						 <!-- FooTable -->
						<script src="<?=@$sufijo?>web/js/plugins/footable/footable.all.min.js"></script>
						<!-- Toastr -->
						<script src="<?=@$sufijo?>web/js/plugins/toastr/toastr.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> 
						<!-- iCheck -->
						<script src="<?=@$sufijo?>web/js/plugins/iCheck/icheck.min.js"></script>
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
						<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
									
						<script>
						$(document).ready(function(){
							App.init();
							$('.footable').footable({
								"columns": [{
									"sortable": false
								}]
							});
							$('#txtNumeroDc').mask("AAAA-AAAAAA-AAA-ZZZZZ", {
								translation: {
								  'Z': {
									pattern: /[0-9]/, optional: true
								  }
								}
							});
							$('#txtNumeroPC').mask("AAA/AAA/AAAA/AAA/AAAAAAAAAAAAAAAA-ZZZZZ", {
								translation: {
								  'Z': {
									pattern: /[0-9]/, optional: true
								  }
								}
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
						</script><?php
		
	}
}
else{
    session_unset();
    echo"<script> location.href = '../../' </script>";
}
?>

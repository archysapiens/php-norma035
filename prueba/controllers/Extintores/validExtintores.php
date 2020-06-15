<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
$sufijo='../../'; $sufijoMenu='../';
require('../../clases/Extintores.php');
require('../../repositorio/NiceDate.php');
require('../../bd/bd.php');
include("../../template/menu.php");
include("../../helpers.php");
include("../login/control_session.php");

$Extintores = new Extintores();

$ListPendientesOrdenDeT=$Extintores->listPendientesValidOrdenT(@$_COOKIE['id_emp']);
$ListPendientesPolizaG=$Extintores->listPendientesValidPolizaG(@$_COOKIE['id_emp']);

if(isset($_POST['formUpdateCertifiFumiTec'])){
		$Extintores->updateCertiFumiTec($_POST);
	}else{
 ?>	
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<!--meta name="viewport" content="width=device-width, initial-scale=1"-->
					<!--meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' /--> 
					<meta name="viewport" content="maximum-scale=1" id="ChangeViewport"/>
					<meta name="description" content="">
					<meta name="author" content="">

					<!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
					<title>Servicios Ecosheys</title>
						<link href="<?=@$sufijo?>web/css/bootstrap.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/font-awesome/css/font-awesome.css" rel="stylesheet">
						<!-- Toastr style -->
						<link href="<?=@$sufijo?>web/css/plugins/toastr/toastr.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/select2/4.0.3select2.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/tabsEcosheys.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/animate.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
						<!-- FooTable -->
						<link href="<?=@$sufijo?>web/css/plugins/footable/footable.core.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<link rel="stylesheet" href="<?=@$sufijo?>web/css/plugins/alert/alert.min.css">
						<style>body { -moz-transform: scale(0.9, 0.9); zoom: 0.9; zoom: 90%; }</style>
				</head>
				<body> <?php

				$loadCssHeader='';

				$breadcrumb='Servicios';
				$breadcrumbPrincipal='Orden de Trabajo';
				$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'ListPendientesOrdenDeT'=>$ListPendientesOrdenDeT,'ListPendientesPolizaG'=>$ListPendientesPolizaG);

				/*nombre del archivo a llamar y manda las variables*/
				view('Extintores/validExtintores',$variables);  ?>		
					
					
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
					<script type="text/javascript" src="<?=@$sufijo?>web/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
					<!-- Peity -->
					<script src="<?=@$sufijo?>web/js/plugins/peity/jquery.peity.min.js"></script>

					<!-- jqGrid -->
					<script src="<?=@$sufijo?>web/js/plugins/jqGrid/i18n/grid.locale-es.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/jqGrid/jquery.jqGrid.min.js"></script>
					<!-- Custom and plugin javascript -->
					<script src="<?=@$sufijo?>web/js/inspinia.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/pace/pace.min.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/canvas/canvas.js"></script> <!--Canvas -->
					<!-- Toastr -->
					<script src="<?=@$sufijo?>web/js/plugins/toastr/toastr.min.js"></script>
					<!-- FooTable -->
					<script src="<?=@$sufijo?>web/js/plugins/footable/footable.all.min.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/jquery-ui/jquery-ui.min.js"></script>
					<script src="<?=@$sufijo?>web/js/apps.js"></script>
					<!-- REQUIRED: Functional Widgets -->
					<script src="<?=@$sufijo?>web/js/plugins/smartwidgets/include/jarvis.widget.min.js"></script>
					<!-- Data picker -->
					<script src="<?=@$sufijo?>web/js/plugins/datapicker/bootstrap-datepicker-spanish.js"></script>
					<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

					 <script>
						$(document).ready(function(){
							App.init();						
							$('.footable').footable();
						});
					</script>
					
					<?php
		}
}
else{
    session_unset();
    echo"<script> location.href = '../../' </script>";
}
?>

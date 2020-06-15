<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
$sufijo='../'; $sufijoMenu='';
require('../clases/Client.php');
require('../bd/bd.php');
include("../template/menu.php");
include("../helpers.php");
include("login/control_session.php");

$Cliente = new Client();
$SelectSucursal=$Cliente->loadSelectSucursal();

	if(isset($_POST['formCreatedFisico'])){
		$Cliente->saveClient($_POST);
	}
	else if(isset($_POST['formCreatedMoral'])){
		$Cliente->saveClientMoral($_POST);
	}
	else if(isset($_POST['formUpdateFisico'])){
		$Cliente->updateClient($_POST);
	}
	else if(isset($_POST['formCreatedMoralDatos'])){

		$Cliente->saveClientMoralContacto($_POST);
		sleep(1);
		$Cliente->saveClientMoralDatos($_POST);
	}
	else if(isset($_POST['formUpdateMoral'])){
		$Cliente->updateMoral($_POST);
	}
	else if(isset($_POST['formUpdateMoralDatos'])){

		$Cliente->updateClientMoralContacto($_POST);
	}
	else{ ?>
	
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
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
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<!-- newClient -->
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/registro_clientes/sepomex.js"></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/jsCliente/ajax_selects_persona_fisica2.js"></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/jsCliente/ajax_selects_Persona_Moral2.js"></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/registro_clientes/funciones_registro_clientes.js"></script>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/registro_clientes/ajax_contactos_morales.js"></script>
						<script src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery.chained.min.js"></script>
						<script src="<?=@$sufijo?>web/js/HelperJs/scripts/registro_clientes/validaciones_cajasde_texto.js"></script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBetuqbipUER_7WRsoQsVpCghN6wR9G0JA"></script>
						<script>
							 $(document).ready(function() {
								$(".selectSearch").select2({
								  placeholder: "SELECCIONA...",
								  allowClear: true
								});			
							});
						</script>
				</head>
				<body> <?php

						$loadCssHeader='';

						$breadcrumb='newCliente';
						$breadcrumbPrincipal='';
						$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'SelectSucursal'=>$SelectSucursal);

						/*nombre del archivo a llamar y manda las variables*/
						view('newClient',$variables);  ?>
		
					
					<?php top_scroll(); ?>
					<!-- Mainly scripts -->
					<script src="<?=@$sufijo?>web/js/jquery-2.1.1.js"></script>
					<script src="<?=@$sufijo?>web/js/bootstrap.min.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/metisMenu/jquery.metisMenu.js"></script>
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
					<!-- Custom and plugin javascript -->
					<script src="<?=@$sufijo?>web/js/inspinia.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/pace/pace.min.js"></script>
					<!-- Toastr -->
					<script src="<?=@$sufijo?>web/js/plugins/toastr/toastr.min.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/jquery-ui/jquery-ui.min.js"></script>
					<!-- REQUIRED: Functional Widgets -->
					<script src="<?=@$sufijo?>web/js/plugins/smartwidgets/include/jarvis.widget.min.js"></script>
					<script src="<?=@$sufijo?>web/js/apps.js"></script>
					<script>
						 $(document).ready(function() {
							App.init();
						});
					</script><?php
		
	}
}
else{
    session_unset();
    echo"<script> location.href = '../' </script>";
}
?>

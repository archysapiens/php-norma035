<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
$sufijo='../../'; $sufijoMenu='../';
require('../../clases/Fumigacion.php');
require('../../bd/bd.php');
include("../../template/menu.php");
include("../../helpers.php");
include("../login/control_session.php");

$Fumigacion = new Fumigacion();

$SelectAreas=$Fumigacion->loadSelectArea();
$SelectPlagas=$Fumigacion->loadSelectPlagas();
$SelectMetodo=$Fumigacion->loadSelectMetodo();
$SelectMetodo2=$Fumigacion->loadSelectMetodo2();
$SelectNomComercial=$Fumigacion->loadSelectNomComercial();
$SelectNomQuimico=$Fumigacion->loadSelectNomQuimico();
$SelectTypeFumi=$Fumigacion->loadSelectTypeFumi();
$SelectComposicion=$Fumigacion->loadSelectComposicion();
$SelectDosis=$Fumigacion->loadSelectDosis();
$SelectCofepris=$Fumigacion->loadSelectCofepris();
$SelectPeriodicidad=$Fumigacion->loadSelectPeriodicidad();
$SelectResponsable=$Fumigacion->loadSelectResponsable();
$SelectTecnico=$Fumigacion->loadSelectTecnico();
$SelectAdministrativa=$Fumigacion->loadSelectAdministrativa();

if(isset($_POST['formCreatedCertificate'])){
		$Fumigacion->saveCertificate($_POST);
	}else if(isset($_POST['formAddEmailEnvio'])){
		$Fumigacion->saveAddEmailCorreoEnvio($_POST);}
	else if(isset($_POST['folioDeleteTable'])){
		$Fumigacion->deleteTableNewCertificado($_POST);}
	else if(isset($_POST['folioDeleteTableReport'])){
		$Fumigacion->deleteTableNewReport($_POST);}
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
						<link href="<?=@$sufijo?>web/css/tabsEcosheys.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
						<!-- Data picker -->
						<link href="<?=@$sufijo?>web/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/animate.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/timeLine.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<link rel="stylesheet" href="<?=@$sufijo?>web/css/plugins/alert/alert.min.css">
						
						<script>
							 $(document).ready(function() {
								$(".selectSearch").select2({
								  placeholder: "SELECCIONA...",
								  allowClear: true,
								  tags: true,
								  tokenSeparators: [',', ' ']
								});			
							});
						</script>
				</head>
				<body> <?php
	
			$loadCssHeader='';

			$breadcrumb='Servicios Urbanos de Fumigación';
			$breadcrumbPrincipal='Certificado de Fumigación';
			$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'idClient'=>@$_REQUEST['id'],'SelectAreas'=>$SelectAreas,'SelectPlagas'=>$SelectPlagas,'SelectMetodo'=>$SelectMetodo,'SelectMetodo2'=>$SelectMetodo2,
			'SelectNomComercial'=>$SelectNomComercial,'SelectNomQuimico'=>$SelectNomQuimico,'SelectComposicion'=>$SelectComposicion,'SelectDosis'=>$SelectDosis,'SelectCofepris'=>$SelectCofepris,'SelectPeriodicidad'=>$SelectPeriodicidad,'SelectResponsable'=>$SelectResponsable,'SelectTecnico'=>$SelectTecnico,'SelectAdministrativa'=>$SelectAdministrativa,
			'SelectTypeFumi'=>$SelectTypeFumi);

			/*nombre del archivo a llamar y manda las variables*/
			view('Fumigacion/newFumigacion',$variables);  ?>
						
					  <script>
						$(document).ready(function(){	
							
							$('.timepicker').timepicker({
								'showDuration': true
							});
							$('.timepicker').timepicker('setTime', new Date());							
							$('.timepicker2').timepicker('setTime', new Date());							
							$('.timepicker').on('click', function (){});
							$('.timepicker2').on('click', function (){});
							 $('#data_2 .input-group.date').datepicker({
								 viewMode: "months", 
								 minViewMode: "months",
								 startView: 1,
								 language: 'es', 
								 keyboardNavigation: true,
								 forceParse: true,
								 autoclose: true,
								 format: "MM-yyyy"
							});
						});
					</script>
					
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
					<script type="text/javascript" src="<?=@$sufijo?>web/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
					<!-- Data picker -->
					<script src="<?=@$sufijo?>web/js/plugins/datapicker/bootstrap-datepicker.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/datapicker/bootstrap-datepicker-spanish.js"></script>
					<!-- Clock picker -->
					<script src="<?=@$sufijo?>web/js/plugins/clockpicker/clockpicker.js"></script>
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
					<!-- REQUIRED: Functional Widgets -->
					<script src="<?=@$sufijo?>web/js/plugins/smartwidgets/include/jarvis.widget.min.js"></script>
					<script src="<?=@$sufijo?>web/js/apps.js"></script>	
					<!--script src="<?//=@$sufijo?>web/js/plugins/jquery-ui/jquery-ui.min.js"></script-->
					<script>
						$(document).ready(function(){
							App.init();						
						});
					</script>
					<script>
						$(document).ready(function (){
							Ladda.bind( '.ladda-button',{ timeout: 4000 });
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

					</script>
					<?php
		}
}
else{
    session_unset();
    echo"<script> location.href = '../../' </script>";
}
?>

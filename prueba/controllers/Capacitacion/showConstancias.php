<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
	
	if($_REQUEST['action']=='UploadEvidenceList'){
		$arraySession = array('action'=>'Upload Evidence Lista Asistencia','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession; exit; }
	
$sufijo='../../'; $sufijoMenu='../';
require('../../clases/Capacitacion.php');
require('../../bd/bd.php');
require('../../repositorio/NiceDate.php');
include("../../template/menu.php");
include("../../helpers.php");

$Capacitacion = new Capacitacion();

$ListasConstancias=$Capacitacion->listPendientesConstancias();
$SelectInstruct=$Capacitacion->loadSelectInstruct();

if(@$_FILES['fileEvidence']['name']!=''){
		$nameImgEvidence = $_FILES['fileEvidence']['name'];
		$tmpImgEvidence = $_FILES['fileEvidence']['tmp_name'];
		$extImgEvidence = pathinfo($nameImgEvidence);

		$nombre_fichero = "../../repositorio/loadCapacitacion/img/asistencias/".@$_SESSION['sesionSucur']."";
		if(file_exists($nombre_fichero)) { }else { mkdir($nombre_fichero, 0777, true); }

		$sendEvidenceFolio=$_SESSION['page']['paramters']['sendEvidenceFolio']; 					
		$sendImgUploadEvi=$_SESSION['page']['paramters']['sendImgUploadEvi']; 					
		$urlnueva = $nombre_fichero."/".$sendEvidenceFolio.".png";			
		if(is_uploaded_file($tmpImgEvidence)){ copy($tmpImgEvidence,$urlnueva); }
		$Capacitacion->uploadImgEvidenceListAlumn($sendEvidenceFolio,$urlnueva,$sendImgUploadEvi);
		
		echo json_encode("Listo!!!!");  unset($_SESSION['page']); exit; }
if(isset($_REQUEST['action'])){
		if($_REQUEST['action']=='ListAsistencia'){
			$Capacitacion->listAsistencia($_REQUEST); exit; 
		}else if($_REQUEST['action']=='CheckAsistencia'){
			$Capacitacion->CheckAsistencia($_REQUEST); exit; 
		}else if($_REQUEST['action']=='CheckDocument'){
			$Capacitacion->CheckDocument($_REQUEST); exit; 
		}else if($_REQUEST['action']=='SearchDatosCurso'){
			$Capacitacion->SearchDatosCurso($_REQUEST); exit; 
		}else if($_REQUEST['action']=='GenerateConstancias'){
			$Capacitacion->GenerateConstancias($_REQUEST); exit; 
		}else if($_REQUEST['action']=='ShowConstancias'){
			$Capacitacion->ShowConstancias($_REQUEST); exit; 
		}
		exit;
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
						<link href="<?=@$sufijo?>web/css/plugins/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
						 <!-- FooTable -->
						<link href="<?=@$sufijo?>web/css/plugins/footable/footable.core.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/iCheck/custom.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
						<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<link rel="stylesheet" href="<?=@$sufijo?>web/css/plugins/alert/alert.min.css">
						<style>body { -moz-transform: scale(0.9, 0.9); zoom: 0.9; zoom: 90%; }</style>
				</head>
				<body> <?php

					$loadCssHeader='';

					$breadcrumb='Servicios de Capacitacion';
					$breadcrumbPrincipal='Orden de Trabajo para Mantenimiento o Recarga';
					$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'ListasConstancias'=>$ListasConstancias,'SelectInstruct'=>$SelectInstruct);

					view('Capacitacion/showConstancias',$variables); 
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
						<!--FileInput-->
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/fileinput.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/locales/es.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/themes/fa/theme.js" type="text/javascript"></script>
						<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
									
						<script>
						$(document).ready(function(){
							App.init();
							$('.footable').footable({
								"columns": [{
									"sortable": false
								}]
							});
						});
						$("#file-1").fileinput({
							theme: 'fa',
							uploadUrl: 'showConstancias.php', // you must set a valid URL here else you will get an error
							allowedFileExtensions: ['jpg', 'png', 'gif'],
							overwriteInitial: false,
							maxFileSize: 400,
							maxFilesNum: 2,
							showClose:false,
							previewClass: "bg-gray",
							browseLabel: "Buscar",
							removeClass: "btn btn-white",
							removeLabel: "Eliminar",
							uploadClass: "btn btn-white",
							uploadLabel: "Cargar",
							msgPlaceholder: "Seleccionar Imagen",
							msgUploadEnd:"Se guardo Correctamente su Evidencia...",
							progressClass:"progress-bar progress-bar-primary progress-bar-striped active",
							progressCompleteClass:"progress-bar progress-bar-info",
							dropZoneTitle:"Arrastre y suelte archivos aquí ...",
							// resizeImages:true,
							// allowedFileTypes: ['image'],
							slugCallback: function (filename) {
								return filename.replace('(', '_').replace(']', '_');
							}
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

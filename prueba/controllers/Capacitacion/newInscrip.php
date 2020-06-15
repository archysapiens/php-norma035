<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
	
	if(isset($_REQUEST['action'])){ 
		switch ($_REQUEST['action']) {
			case 'NuevaInscrip':
				$arraySession = array('action'=>'Nueva Inscripcion','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession; exit;
				break;
			case 'EditInscrip':
				$arraySession = array('action'=>'Editar Inscripcion','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession; exit;
				break;
			case 'SearchCosto':
				$arraySession = array('action'=>'Search Costo Curso','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession;
				break;
			case 'UploadEvidence':
				$arraySession = array('action'=>'Upload Evidence','paramters'=>$_REQUEST); $_SESSION['page'] = $arraySession; exit;
				break;
			} }
	
	$sufijo='../../'; $sufijoMenu='../';
	require('../../clases/Capacitacion.php');
	require('../../repositorio/NiceDate.php');
	require('../../bd/bd.php');
	include("../../template/menu.php");
	include("../../helpers.php");
	require('../../repositorio/PHPExcel/Classes/PHPExcel/IOFactory.php');

	$Capacitacion = new Capacitacion();
	
	$SelectCourse=$Capacitacion->loadSelectCourse();
	$loadInscription=$Capacitacion->loadInscription();
	if($loadInscription->num_rows > 0){ $visibility='ListInscrip'; }else{ $visibility='NewInscripNow'; }
	if(isset($_SESSION['page']['paramters']['visibility'])){ $visibility=$_SESSION['page']['paramters']['visibility'];  unset($_SESSION['page']); }
	if(isset($_SESSION['page']['paramters']['attrFolio'])){ $visibility='NewInscripNow'; $getRequest=$_SESSION['page']['paramters']; unset($_SESSION['page']); }
	if(isset($_SESSION['page']['paramters']['valCourseSelect'])){ $Capacitacion->searchCostoCourse($_SESSION['page']['paramters']['valCourseSelect']); }

	if(isset($getRequest)){ $editInscription=$Capacitacion->editInscription($getRequest['attrFolio']); }else{ $editInscription=''; }
	
if(isset($_POST['formCreatedNewCapaci'])){
		$Capacitacion->saveNewInscrip($_POST);
		exit;
	}else if(isset($_POST['GererateJsonCP'])){
		$Capacitacion->gerateJsonCP($_POST);}
	else if(isset($_POST['formCreatedNewPago'])){
		$Capacitacion->saveNewPago($_POST);}  
	else if(@$_FILES['file']['name']!=''){
		$nameEXCEL = $_FILES['file']['name'];
		$tmpEXCEL = $_FILES['file']['tmp_name'];
		$extEXCEL = pathinfo($nameEXCEL);
		$noFolio=$_REQUEST['noFolio']; $dateUpload = date("Y-m-d", strtotime("-1 day", strtotime(date( "Y-m-d" )))); $dateUploadHor = date("h-i-s");  					
		$urlnueva = "../../repositorio/loadCapacitacion/xlsx/CP".substr(@$_SESSION['sesionSucur'],0,3).$dateUpload."_".@$_COOKIE['id']."_".$dateUploadHor.".xlsx";			
		if(is_uploaded_file($tmpEXCEL)){
			copy($tmpEXCEL,$urlnueva);					
			$objPHPExcel = PHPExcel_IOFactory::load($urlnueva);
			$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true);			
			$Capacitacion->uploadExcel($objHoja,'CP'.substr(@$_SESSION['sesionSucur'],0,3).$dateUpload."_".@$_COOKIE['id']."_".$dateUploadHor); }
		exit;
	}
	else if(@$_FILES['fileEvidence']['name']!=''){
		$nameImgEvidence = $_FILES['fileEvidence']['name'];
		$tmpImgEvidence = $_FILES['fileEvidence']['tmp_name'];
		$extImgEvidence = pathinfo($nameImgEvidence);
		
		$nombre_fichero = "../../repositorio/loadCapacitacion/img/pagos/".@$_SESSION['sesionSucur']."";

		if (file_exists($nombre_fichero)) { }else { mkdir($nombre_fichero, 0777, true); }

		$sendEvidenceFolio=$_SESSION['page']['paramters']['sendEvidenceFolio']; 					
		$sendImgUploadEvi=$_SESSION['page']['paramters']['sendImgUploadEvi']; 					
		$urlnueva = $nombre_fichero."/".$sendEvidenceFolio.".png";			
		if(is_uploaded_file($tmpImgEvidence)){ copy($tmpImgEvidence,$urlnueva); }
		$Capacitacion->uploadImgEvidence($sendEvidenceFolio,$urlnueva,$sendImgUploadEvi);
	
		echo json_encode("<script>toastr.success('Pronto recibirá una respuesta', '¡Evidencia Lista!');</script>"); 
		// var_dump($extImgEvidence);
		// echo "<br><br>";
		// echo $urlnueva;
		// echo "<br><br>";
		// var_dump($_REQUEST);
		// echo "<br><br>";
		// var_dump($_SESSION);
		unset($_SESSION['page']);
		// echo"<script> location.reload();  </script>";
		exit;
	}else if(isset($_REQUEST['TypeForm'])){ 
		$Capacitacion->saveNewCotizacion($_REQUEST);
		exit;
	} else{
 ?>
			<!DOCTYPE html>
			<html lang="en" id="loadPage">
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
						<link href="<?=@$sufijo?>web/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/timeLine.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
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

					$breadcrumb='Servicios de Capacitacion';
					$breadcrumbPrincipal='Nueva Inscripción';
					$variables= array('visibility'=>$visibility,'sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'loadInscription'=>$loadInscription,'editInscription'=>$editInscription,'SelectCourse'=>$SelectCourse);

					view('Capacitacion/newInscrip',$variables); 
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
						<!-- Toastr --> 
						<script src="<?=@$sufijo?>web/js/plugins/toastr/toastr.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> 
						 <!-- Jasny -->
						<!--script src="<?=@$sufijo?>web/js/plugins/easyPaginate/jquery.easyPaginate.js"></script-->
						<script src="<?=@$sufijo?>web/js/plugins/jasny/jasny-bootstrap.min.js"></script>
						<?php if($visibility != 'NewInscripNow'){?>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/fileinput.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/locales/es.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/themes/fa/theme.js" type="text/javascript"></script>
						<?php }?>
						<!-- Geolocalizacion -->
						<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA6V_PGPL3DgRUcj9H3d3fmNXbAUZchO7A&language=es&region=mx&amp;libraries=places"></script>
						<script src="<?=@$sufijo?>web/js/HelperJs/jquery.geocomplete.js"></script>
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
							
						});
						<?php if($visibility != 'NewInscripNow'){?>
							$("#file-1").fileinput({
								theme: 'fa',
								uploadUrl: 'newInscrip.php', // you must set a valid URL here else you will get an error
								allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
								overwriteInitial: false,
								maxFileSize: 400,
								maxFilesNum: 1,
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
						<?php } ?>
						// $('#easyPaginate').easyPaginate({
							// paginateElement: '.iboxRectangular',
							// elementsPerPage: 12,
							// effect: 'climb'
						// });
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

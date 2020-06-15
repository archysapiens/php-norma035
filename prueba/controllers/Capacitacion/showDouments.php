<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
$sufijo='../../'; $sufijoMenu='../';
require('../../clases/Capacitacion.php');
require('../../bd/bd.php');
include("../../template/menu.php");
include("../../helpers.php");

$Capacitacion = new Capacitacion();

$editInstruct=$Capacitacion->editInstruct();

if(isset($_POST['formSaveDatosInstruct'])){
		$Capacitacion->saveDataInstruct($_POST);
		exit;
	}else if(@$_FILES['file']['name']!=''){
		$nameFile = $_FILES['file']['name'];
		$typeFile = $_FILES['file']['type'];
		$tmpFile = $_FILES['file']['tmp_name'];
		$extFile = pathinfo($nameFile);
		$dateUpload = date("Ymd"); $dateUploadHor = date("his");  		
		if(file_exists("../../web/UploadPdf/PdfCapacitacion/FormatosInstruc/".@$_SESSION['sesionSucur']."/".@$_COOKIE['id']."/")) { }else{ mkdir("../../web/UploadPdf/PdfCapacitacion/FormatosInstruc/".@$_SESSION['sesionSucur']."/".@$_COOKIE['id']."/", 0777, true); }
		// $urlnueva = "../../web/UploadPdf/PdfCapacitacion/FormatosInstruc/".@$_SESSION['sesionSucur']."/".@$_COOKIE['id']."/".$dateUpload."_".$dateUploadHor."_".$_REQUEST['sendTypeDocument'].".".$extFile['extension'];			
		$urlnueva = "../../web/UploadPdf/PdfCapacitacion/FormatosInstruc/".@$_SESSION['sesionSucur']."/".@$_COOKIE['id']."/".$_REQUEST['sendTypeDocument'].".".$extFile['extension'];			
		if(is_uploaded_file($tmpFile)){ copy($tmpFile,$urlnueva); $Capacitacion->saveRutaDocument($urlnueva,$_REQUEST['sendTypeDocument'],$nameFile,$extFile['extension']); }
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
						<link href="<?=@$sufijo?>web/css/timeLine.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
						<link href="<?=@$sufijo?>web/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/imagen.css" rel="stylesheet" rel="stylesheet" id="bootstrap-css">
						<link href="<?=@$sufijo?>web/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						<link rel="stylesheet" href="<?=@$sufijo?>web/css/plugins/alert/alert.min.css">
				</head>
				<body> <?php

					$loadCssHeader='';

					$breadcrumb='Servicios de Capacitacion';
					$breadcrumbPrincipal='Documentos Personales'; 
					$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader,'editInstruct'=>$editInstruct);

					view('Capacitacion/showDouments',$variables); 
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
						 <!-- Chosen -->
						<script src="<?=@$sufijo?>web/js/plugins/chosen/chosen.jquery.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/canvas/canvas.js"></script> <!--Canvas -->
						<!-- Toastr -->
						<script src="<?=@$sufijo?>web/js/plugins/toastr/toastr.min.js"></script>
						 <script src="<?=@$sufijo?>web/js/plugins/chosen/chosen.jquery.js"></script>
						 <!--  Plugin for the Wizard -->
						 <script src="<?=@$sufijo?>web/js/jquery.bootstrap.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/material-bootstrap-wizard.js"></script>
						<script src="<?=@$sufijo?>web/js/jquery.validate.min.js"></script>
						<script src="<?=@$sufijo?>web/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> 
						<!-- Ladda -->
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/fileinput.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/locales/es.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
						<script src="<?=@$sufijo?>web/js/plugins/fileinput/themes/fa/theme.js" type="text/javascript"></script>
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
							$('#txtNumeroDc5').mask("AAAA-AAAAAA-AAA-ZZZZZ", {
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
						
						<?php if($editInstruct[0]['RUTA_CURPP']!=''){ ?>
						$("#file-CURP").fileinput({
							theme: 'fa',
							previewClass: "btn bg-gray",
							browseLabel: "Buscar",
							removeClass: "btn btn-white hidden",
							removeLabel: "Eliminar",
							uploadClass: "btn btn-white hidden",
							uploadLabel: "Cargar",
							msgUploadEnd:"Listo...",
							progressClass:"progress-bar progress-bar-primary progress-bar-striped active",
							progressCompleteClass:"progress-bar progress-bar-info",
							dropZoneTitle:"Arrastre y suelte archivos aquí ...",
							uploadAsync: false,
							minFileCount: 1,
							maxFileCount: 1,
							overwriteInitial: true,
							initialPreview: [ '<?php echo $sufijo.$editInstruct[0]['RUTA_CURPP']; ?>'],
							initialPreviewAsData: true, // defaults markup
							initialPreviewFileType: 'image', // image is the default and can be overridden in config below
							initialPreviewConfig: [ {type: "pdf", size: 8000, caption: "PDF-Sample.pdf", url: "/file-upload-batch/2", key: 10} ],
							uploadExtraData: { img_key: "1000", img_keywords: "happy, nature" }
						});
						<?php }else{ ?>
						$("#file-CURP, #file-COMPR_LAB, #file-COMPR_DOMI, #file-CV, #file-IFE, #file-DC3, #file-DC5, #file-DIPLOMA, #file-CED_PROF, #file-RFC").fileinput({
							theme: 'fa',
							previewClass: "btn bg-gray",
							browseLabel: "Buscar",
							removeClass: "btn btn-white hidden",
							removeLabel: "Eliminar",
							uploadClass: "btn btn-white hidden",
							uploadLabel: "Cargar",
							msgUploadEnd:"Listo...",
							progressClass:"progress-bar progress-bar-primary progress-bar-striped active",
							progressCompleteClass:"progress-bar progress-bar-info",
							dropZoneTitle:"Arrastre y suelte archivos aquí ...",
						});
						<?php } ?>
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
						var config = {
							'.chosen-select'           : {},
							'.chosen-select-deselect'  : {allow_single_deselect:true},
							'.chosen-select-no-single' : {disable_search_threshold:10},
							'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
							'.chosen-select-width'     : {width:"95%"}
							}
						for (var selector in config) {
							$(selector).chosen(config[selector]);
						}
						</script><?php
		
	}
}
else{
    session_unset();
    echo"<script> location.href = '../../' </script>";
}
?>

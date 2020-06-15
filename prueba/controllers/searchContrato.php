<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
require('../bd/bd.php');
include("../template/menu.php");
include("../helpers.php");
include("login/control_session.php");
$sufijo='../';?>

	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">
				<link href="<?=@$sufijo?>web/css/bootstrap.min.css" rel="stylesheet">
				<link href="<?=@$sufijo?>web/font-awesome/css/font-awesome.css" rel="stylesheet">
				<!-- Data Tables -->
				<link href="<?=@$sufijo?>web/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
				<link href="<?=@$sufijo?>web/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
				<link href="<?=@$sufijo?>web/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
				<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
				<link href="<?=@$sufijo?>web/css/animate.css" rel="stylesheet">
				<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.js"></script>
				<script language="JavaScript" type="text/javascript" src="ajax_actualizar_contratos.js"></script>  
		</head>
		<body> <?php
		
			$breadcrumb='searchContrato';
			$breadcrumbPrincipal='Contratos Ecosheys';
			$variables= array('breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal);

			/*nombre del archivo a llamar y manda las variables*/
			view('searchContrato',$variables); ?>
			
			
		<!-- Mainly scripts -->
		<script src="<?=@$sufijo?>web/js/jquery-2.1.1.js"></script>
		<script src="<?=@$sufijo?>web/js/bootstrap.min.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/jeditable/jquery.jeditable.js"></script>
		<!-- Data Tables -->
		<script src="<?=@$sufijo?>web/js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/dataTables/dataTables.responsive.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
		<!-- Custom and plugin javascript -->
		<script src="<?=@$sufijo?>web/js/inspinia.js"></script>
		<script src="<?=@$sufijo?>web/js/plugins/pace/pace.min.js"></script>
		<script src="<?=@$sufijo?>web/js/HelperJs/searchContrato/searchContrato.js"></script>
</html>					
		<?php			
					
}
else{
	session_unset();
	echo"<script> location.href = '../' </script>";
}
?>

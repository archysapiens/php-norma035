<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
$sufijo='../'; $sufijoMenu='';
require('../bd/bd.php');
include("../template/menu.php");
include("../helpers.php");
include("login/control_session.php");

	 ?>
	
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
						<link href="<?=@$sufijo?>web/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
						<link href="<?=@$sufijo?>web/css/tabsEcosheys.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/animate.css" rel="stylesheet">
						<link href="<?=@$sufijo?>web/css/style.css" rel="stylesheet">
						<link rel="icon" type="image/x-icon" href="<?=@$sufijo?>ico-echosheys.ico">
						<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
						
				</head>
				<body> <?php

					$loadCssHeader='';

					$breadcrumb='Planeación';
					$breadcrumbPrincipal='';
					$variables= array('sufijo'=>$sufijo,'sufijoMenu'=>$sufijoMenu,'breadcrumb'=>$breadcrumb,'breadcrumbPrincipal'=>$breadcrumbPrincipal,'loadCssHeader'=>$loadCssHeader);

					/*nombre del archivo a llamar y manda las variables*/
					view('Planeacion',$variables);  ?>
					
					
					
					
					
					<!-- Mainly scripts -->
					<script src="<?=@$sufijo?>web/js/plugins/fullcalendar/moment.min.js"></script>
					<script src="<?=@$sufijo?>web/js/jquery-2.1.1.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/jquery-ui/jquery-ui.min.js"></script>
					<script src="<?=@$sufijo?>web/js/bootstrap.min.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/metisMenu/jquery.metisMenu.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

					<!-- Custom and plugin javascript -->
					<script src="<?=@$sufijo?>web/js/inspinia.js"></script>
					<script src="<?=@$sufijo?>web/js/plugins/pace/pace.min.js"></script>

					<!-- jQuery UI custom -->
					<script src="<?=@$sufijo?>web/js/jquery-ui.custom.min.js"></script>

					<!-- iCheck -->
					<script src="<?=@$sufijo?>web/js/plugins/iCheck/icheck.min.js"></script>

					<!-- Full Calendar -->
					<script src="<?=@$sufijo?>web/js/plugins/fullcalendar/fullcalendar.min.js"></script>
					
					
					<script>
						$(document).ready(function() {

								$('.i-checks').iCheck({
									checkboxClass: 'icheckbox_square-green',
									radioClass: 'iradio_square-green'
								});

							/* initialize the external events
							 -----------------------------------------------------------------*/


							$('#external-events div.external-event').each(function() {

								// store data so the calendar knows to render an event upon drop
								$(this).data('event', {
									title: $.trim($(this).text()), // use the element's text as the event title
									stick: true // maintain when user navigates (see docs on the renderEvent method)
								});

								// make the event draggable using jQuery UI
								$(this).draggable({
									zIndex: 1111999,
									revert: true,      // will cause the event to go back to its
									revertDuration: 0  //  original position after the drag
								});

							});


							/* initialize the calendar
							 -----------------------------------------------------------------*/
							var date = new Date();
							var d = date.getDate();
							var m = date.getMonth();
							var y = date.getFullYear();

							$('#calendar').fullCalendar({
								header: {
									left: 'prev,next today',
									center: 'title',
									right: 'month,agendaWeek,agendaDay'
								},
								editable: true,
								droppable: true, // this allows things to be dropped onto the calendar
								drop: function() {
									// is the "remove after drop" checkbox checked?
									if ($('#drop-remove').is(':checked')) {
										// if so, remove the element from the "Draggable Events" list
										$(this).remove();
									}
								},
								events: [									
									{
										id: 1,
										title: 'Servicio Fumigación',
										start: new Date(y, m, 1),
										url: 'Fumigacion/newFumigacion.php'
									}
								]
							});


						});
					</script>
					<?php
		
	
}
else{
    session_unset();
    echo"<script> location.href = '../' </script>";
}
?>

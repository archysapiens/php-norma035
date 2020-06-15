<?php
require('bd/bd.php');
$db = new DbCnnx();
if(isset($_REQUEST['TypeForm'])){ 

	require('clases/Email.php');
	include_once("repositorio/Email/class.phpmailer.php");
	include_once("repositorio/Email/class.smtp.php");
	
	$Email = new Email();
	$sendArray = array(
		"nombreFull" => $_REQUEST['txtNombreFull'],
		"email" => $_REQUEST['txtEmail'],
		"phone" => $_REQUEST['txtPhone'],
		"place" => $_REQUEST['txtPlace'],
		"curso" => $_REQUEST['txtCurso'],
		"numPerson" => $_REQUEST['txtNumPerson'],
		"nivel" => $_REQUEST['txtNivel'],
		"typeForm" => $_REQUEST['TypeForm']
	); // print_r($_REQUEST);
	$SQL_InsertCotizaci = sprintf("INSERT INTO mod_cotizacion(ID_COTIZACION,TYPE_COTIZA, NO_FOLIO, TYPE_SERVICIO, NOMBRE_FULL, EMAIL, TELEFONO, LUGAR, CURSO, NUM_PERSONAS, NIVEL, MANUALES)
								   VALUES('".date("Ymd-his")."','COTIZACION','','Capacitación','".ucwords(mb_strtolower($_REQUEST['txtNombreFull'], 'UTF-8'))."','".$_REQUEST['txtEmail']."','".$_REQUEST['txtPhone']."','".$_REQUEST['txtPlace']."','".$_REQUEST['txtCurso']."','".$_REQUEST['txtNumPerson']."','".$_REQUEST['txtNivel']."','".$_REQUEST['txtManuales']."')");
	$rec = $db->query($SQL_InsertCotizaci);
	echo @$SQL_InsertCotizaci;
	$Email->sendEmailCotizacion('','Nueva Cotizacion',$sendArray);	
	exit;
	  }else{ ?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Capacitación</title>

		<!-- Bootstrap core CSS -->
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/css/bootstrap.min.css" rel="stylesheet">

		<!-- Animation CSS -->
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/css/animate.css" rel="stylesheet">
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/css/plugins/toastr/toastr.min.css" rel="stylesheet">
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/css/plugins/iCheck/custom.css" rel="stylesheet">
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
		<link rel="icon" href="https://ecosheys.com.mx/assets/cropped-Favicon-eco-32x32.png" sizes="32x32" />
		<link rel="icon" href="https://ecosheys.com.mx/assets/cropped-Favicon-eco-192x192.png" sizes="192x192" />
		<!-- Custom styles for this template -->
		<link href="http://www.archysoft.com.mx/ecosheys_dev/web/css/style.css" rel="stylesheet">		
	</head>
	<style>
	#accordion .panel-default > .panel-heading {
		color: #333;
		background-color: transparent;
		border: none;
		border-radius: 0px;
		padding: 0;
	}
	#accordion.panel-group .panel {
		margin-bottom: 1px;
		border-radius: 0px;
		background-color: transparent;
	}
	#accordion .panel-title {
		overflow: hidden;
		text-transform: capitalize;
		letter-spacing: 0px;
	}
	#accordion .panel-title a {
		padding: 15px 20px 5px 35px !important;
		font-size: 13px;
		display: table;
		width: 100%;
		position: relative;
		font-weight: 400;
		overflow: hidden;
	}
	#accordion .panel-default {
		border: none;
	}
	/*#accordion .panel-title a span {
		position: absolute;
		top: 10px;
		left: 0px;
		color: #B4B4B4;
		font-size: 13px;
		border: 1px solid #ececec;
		width: 30px;
		height: 30px;
		line-height: 30px;
		text-align: center;
		-webkit-transition: .4s;
		-moz-transition: .4s;
		-o-transition: .4s;
		transition: .4s;
	}*/
	#accordion.panel-group .panel.active .panel-title a span {
		background: #8dc73f;
		color: #fff;
		transition: .4s;
	}
	#accordion .panel-title a i {
		color: #aaa;
		font-size: 14px;
		margin-right: 7px;
		position: relative;
		top: 1px;
		transition: .4s;
	}
	#accordion .panel-default > .panel-heading + .panel-collapse > .panel-body {
		border: none;
		padding: 10px 0 0;
	}
	#accordion2 .panel-default > .panel-heading + .panel-collapse > .panel-body {
		padding: 20px 0 25px 60px;
		margin: 0px;
	}
	#accordion .panel .panel-heading a:after,
	#accordion .panel .panel-heading a.collapsed:after{
		font-family: 'FontAwesome'; 
		font-size: 13px;	
		margin-right: 10px; 
		width: 30px;
		height: 30px;
		line-height: 30px;
		text-align: center;
		position: absolute;
		top: 8px;
		left: 0px;
	}
	.pac-container { z-index: 9999999 !important;  }
	#accordion .panel .panel-heading a:after {  
	  content: "\2212";  
	  color: #9e9d9d;
	}
	#accordion .panel .panel-heading a.collapsed:after {
		content: "\2b";	
		color: #9e9d9d;	
		background: transparent;
	}
	#onepage-landing #accordion .panel .panel-heading a:after {  
	  content: "\2212";  
	  color: #fff;
	}
	#onepage-landing #accordion .panel .panel-heading a.collapsed:after {
		content: "\2b";	
		color: #fff;
	}
	#accordion .panel-default > .panel-heading + .panel-collapse > .panel-body {
		padding: 10px 36px 0;
	}
	.landing-page .navbar-default .nav li a {
		color:  #010d15;
		font-family: 'Open Sans', helvetica, arial, sans-serif;
		font-weight: 700;
		letter-spacing: 1px;
		text-transform: uppercase;
		font-size: 13px !important;
	}
	.landing-page .navbar-default .navbar-nav > .active > a, .landing-page .navbar-default .navbar-nav > .active > a:hover {
		color: #010d15;
	}
	.landing-page h1 {
		margin-top: 10px;
		font-size: 38px;
		font-weight: 200;
	}
	.landing-page .navy-line {
		width: 90px;
	}
	.landing-page section p {
		color: #6e7372c7;
	}
	.img-thumbnail.rino {
		max-width: 52%;
		opacity:0.8;
	}
	body.mini-navbar .footer.fixed, body.body-small.mini-navbar .footer.fixed {
		margin: 0 0 0 0px;
	}
	.footer.fixed {
		margin-left: 0px !important;
	}
	.landing-page .btn-primary {
		background-color: #1ab394;
		border-color: #1ab394;
		color: #FFFFFF;
		font-size: 13px;
		padding: 2px 7px;
		font-weight: 500;
	}
	.landing-page .navbar-fixed-top {
		border-bottom: 1px solid #e7eaec !important;
	}
	.inmodal .modal-header {
		padding: 15px !important;
		text-align: center;
		border-top: 9px solid #1a927a;
	}
	.inmodal .modal-title {
		font-size: 22px;
	}
	.inmodal .modal-body {
		background: #ffffff;
		border-bottom: 1px solid #e8ecec;
	}
	@media (max-width: 676px) { 
		#FooterButton{
			margin-left:20% !important;
		}
		.img-thumbnail.rino {
			max-width: 100%;
		}
		#rinoImg{ margin-left: 0px !important; }
	}
	.radio-success input[type="radio"] + label::after {
	  background-color: #5a5a5acf !important;
	}
	.radio-success input[type="radio"]:checked + label::before {
	  border-color: #5a5a5acf !important;
	}
	.radio-success input[type="radio"]:checked + label::after {
	  background-color: #5a5a5acf !important;
	}
	.modal-header {
		min-height: 16.43px;
		padding: 15px;
		border-bottom: 1px dashed #1ab394;
	}
	.modal-body.sk-loading:after {
		content: '';
		background-color: rgba(255, 255, 255, 0.7);
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 999;
	}
	.img-thumbnail { max-height: 260px !important; }
	</style>
	<body id="page-top" class="landing-page no-skin-config">
	<div class="navbar-wrapper">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				   <img src="http://www.archysoft.com.mx/ecosheys_dev/web/img/EcoSheys-RINO-DIBUJO.png" id="logo-ecosheys" width="199px" height="75px"/>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a class="page-scroll" href="#page-top">Inicio</a></li>
						<li><a class="page-scroll" href="#features">Nuestros servicios</a></li>
						<li><a class="page-scroll" href="#team">Contáctanos</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<section class="features gray-section" style="margin-top: 0">
		<div class="container">
			<div class="row wow fadeInUp animated" style="margin-top: 45px;visibility: visible; animation-name: fadeInUp;">
				<div class="col-lg-12 text-center">
					<div class="navy-line"></div>
					<h1>Capacitación</h1>
					<p style="margin-top:30px;">Basándonos en las obligaciones que la Secretaría del Trabajo y Previsión Social (STPS) establece, en donde se determina a la capacitación y/o adestramiento como una obligación, Servicios Ecosheys brinda distintos módulos de capacitación, según el requerimiento normativo que necesites cubrir o según las habilidades que les demandes a tus trabajadores.</p>
					<p>Otorgamos constancias de habilidades laborales (dc3) y constancias con validez ante protección civil del estado.</p>
				</div>
			</div>
			<?php 
				$sqlSearhAreaTematic = "SELECT AREA_TEMATICA,RUTA_IMG FROM cursos GROUP BY AREA_TEMATICA ORDER BY AREA_TEMATICA";
				$stmtTable = $db->combo($sqlSearhAreaTematic);
					
				while($row = $stmtTable->fetch_assoc()){ ?>
					<div class="row">
						<div class="col-lg-5 col-lg-offset-1 features-text wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
							<h4><?php echo $row['AREA_TEMATICA']; ?></h4>
							<div class="space30"></div>
							<div class="panel-group" id="accordion"> <?php 
								$sqlSearhCurso = "SELECT ID_CURSO,NAME,DESCRIPTION FROM cursos WHERE AREA_TEMATICA='".$row['AREA_TEMATICA']."' ORDER BY NAME";
								$stmtTable2 = $db->combo($sqlSearhCurso); 
								while($row2 = $stmtTable2->fetch_assoc()){ ?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row2['ID_CURSO']; ?>">
												<?php echo strtoupper($row2['NAME']); ?>
												</a>
											</h4>
										</div>
										<div id="<?php echo $row2['ID_CURSO']; ?>" class="panel-collapse collapse">
											<div class="panel-body">
												<p><?php echo $row2['DESCRIPTION']; ?></p>
											</div>
										</div>
									</div>
									<div class="clearfix space10"></div>
								<?php } ?>
											
							</div>
						</div>
						<div class="col-lg-5 features-text wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
							 <img src="<?php echo substr($row['RUTA_IMG'], 6); ?>" alt="capa" class="img-thumbnail" width="400px" height="275px"/>
						</div>
					</div>	
				<?php } ?>
			<div class="row"></div>
		</div>
	</section>
	<section id="contact" class="contact" style="margin-top: 0">
		<div class="container wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
			<div class="row m-b-lg">
				<div class="col-lg-12 text-center">
					<div class="navy-line"></div>
					<h1>Contáctanos</h1>
					<p style="margin-top:30px;">Somos especialistas en Servicios Integrales de Salud, Higiene, Ecologìa y Seguridad Industrial.</p>
				</div>
			</div>
			<div class="row m-b-lg">
				<div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 col-lg-offset-3">
					<img src="https://pbs.twimg.com/profile_images/378800000544650537/e421bb464e10caf9d1d90bded23ab16f_400x400.jpeg" style="margin-left:90px;" id="rinoImg" class="img-thumbnail rino" width="180px" height="10px"/>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
					<address>
						<strong><span class="navy">INFORMACIÓN DE CONTACTO.</span></strong><br/>
						San Cristobal Huichochitlan<br/>
						Estado de México<br/>
						México<br/>
						<abbr title="Phone">Teléfonos:</abbr>  (722) 507-42-51
															<div style="margin-left:67px;">  (722) 179-78-92 </div>
						<abbr title="Phone">Atlacomulco:</abbr> (712) 124-85-24
					</address>
				</div>           
			</div>
			<div class="row" style="margin-bottom:100px">
				<div class="col-lg-12 text-center">                
					<p class="m-t-sm">
						O síguenos en la plataforma social
					</p>
					<ul class="list-inline social-icon">
						<li><a href="https://twitter.com/ecosheys_mexico"><i class="fa fa-twitter"></i></a>
						</li>
						<li><a href="https://www.facebook.com/ecosheys/"><i class="fa fa-facebook"></i></a>
						</li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg hidden">
					<p><strong> Copyright © 2018 Ecosheys </strong><br/> Aviso de Privacidad.</p>
				</div>
			</div>
		</div>
	</section>
	<div class="footer fixed">
		<div class="pull-right">
			<p><strong> Copyright © 2018 Ecosheys </strong> &nbsp; &nbsp; &nbsp;<a href="https://ecosheys.com.mx/aviso-de-privacidad/"> Aviso de Privacidad.</a></p>
		</div>
		<div style="margin-left:110px;" id="FooterButton">
			<button data-toggle="modal" class="btn btn-primary btn-xs btn-outline" data-target="#modalCotizar" data-backdrop="static" data-keyboard="false" type="button"><i class="fa fa-dollar"></i>&nbsp; Cotizar</button>
			<button data-toggle="modal" class="btn btn-primary btn-xs btn-outline" data-target="#modalInscrip" data-backdrop="static" data-keyboard="false" style="margin-left:12px;" type="button"><i class="fa fa-edit"></i>&nbsp; Inscribirme</button>
		</div>                
	</div>
	<div class="modal inmodal" id="modalCotizar" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
					<h5 class="modal-title">Cotizacion de curso</h5>                                            
				</div>
				<form class="form-horizontal" name="frm_Cotizacion" action="#" method="post" id="frm_Cotizacion">
				<div class="modal-body">
					<div class="sk-spinner sk-spinner-double-bounce" style="display:none;margin-top:18%;margin-left: 45%;z-index: 99999;position: absolute;">
						<div class="sk-double-bounce1"></div>
						<div class="sk-double-bounce2"></div>
					</div>
					<div class="row">					
						<div class="col-lg-10 col-md-10 col-sm-10 col-md-offset-1">					
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Nombre:</label>
								<div class="col-lg-10 col-md-10 col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user"></i>
										</span>
										<input type="text" name="txtNombreFull" id="txtNombreFull" placeholder="Nombre Completo" class="form-control txtNombreFull text-capitalize" required autofocus>
									</div>
								</div>
							</div>
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Email:</label>
								<div class="col-lg-10 col-md-10 col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-at"></i>
										</span>
										<input type="email" name="txtEmail" id="txtEmail" placeholder="Correo Electronico" class="form-control txtEmail" required>
									</div>
								</div>
							</div>
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Teléfono:</label>
								<div class="col-lg-10 col-md-10 col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-phone"></i>
										</span>
										<input type="tel" name="txtPhone" id="txtPhone" placeholder="Numero de Telefono" class="form-control txtPhone" required>
									</div>
								</div>
							</div>
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Lugar:</label>
								<div class="col-lg-10 col-md-10 col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</span>
										<input type="text" name="txtPlace" id="txtPlace" placeholder="Lugar donde sera el curso" class="form-control txtPlace text-capitalize">
									</div>
								</div>
							</div>
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Curso:</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-list"></i>
										</span> 
										<select id="txtCurso" name="txtCurso" class="form-control m-b txtCurso input-sm"><?php
											$sqlSearhCurso = "SELECT ID_CURSO,NAME FROM cursos";
											$stmtTable2 = $db->combo($sqlSearhCurso);
											while($row = $stmtTable2->fetch_assoc()){ ?>
												<option value="<?php echo strtoupper($row['NAME']); ?>"><?php echo strtoupper($row['NAME']); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>						
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Personas:</label>
								<div class="col-lg-10 col-md-10 col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-users"></i>
										</span>
										<input type="number" name="txtNumPerson" id="txtNumPerson" placeholder="Numero de personas" class="form-control txtNumPerson">
									</div>
								</div>
							</div>																																		
							<div class="form-group form-group-sm"><label class="col-lg-2 col-md-2 col-sm-2 control-label">Nivel:</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-university"></i>
										</span>
										<select id="txtNivel" name="txtNivel" class="form-control m-b txtNivel input-sm">
											<option>Basico</option>
											<option>Medio</option>
											<option>Alto</option>
										</select>
									</div>
								</div>
							</div>						
							<div class="form-group form-group-sm"><label class="col-sm-4 control-label">Requiere Manuales:</label>
								<div class="col-sm-8">	
									<div class="radio radio-success radio-inline">
										<input type="radio" id="inlineRadio1" value="si" name="txtManuales" checked="">
										<label for="inlineRadio1">Si </label>
									</div>
									<div class="radio radio-inline">
										<input type="radio" id="inlineRadio2" value="no" name="txtManuales">
										<label for="inlineRadio2">No </label>
									</div>																							
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-block btn-md" style="font-size: 15px !important;padding: 5px 7px !important;font-weight: 390 !important;margin-top:30px;" name="btnCotizar" id="btnCotizar"> Cotizar </button>
						</div>                                          
					</div>                                          
				</div>
				<div class="modal-footer" style="align:center">
					
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal inmodal" id="modalInscrip" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
					<h4 class="modal-title">Inscripción</h4>                                            
				</div>
				<div class="modal-body" >
					<div class="row">						
						<div class="col-sm-12">
							<img alt="image" class="img" width="100%" src="http://www.archysoft.com.mx/ecosheys2017/web/images/inscripcion.png" />
						</div>				 	
					</div>                                         
				</div>
				<div class="modal-footer" style="align:center">
					<div class="pull-left" >
						<a href="http://www.archysoft.com.mx/ecosheys2017" target="_blank" style="color: #13715e !important;" rel="noopener noreferrer"> www.archysoft.com.mx/ecosheys2017</a>
					</div>
					<button type="button" class="btn btn-default" data-dismiss="modal"> &nbsp; Cerrar  </button>
				</div>
			</div>
		</div>
	</div>
	<div class="returnAjax" id="returnAjax"></div>
	<a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade in hidden" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- Mainly scripts -->
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/jquery-3.1.1.min.js"></script>
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/bootstrap.min.js"></script>
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Chosen -->
		<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/plugins/chosen/chosen.jquery.js"></script>
	<!-- Geolocalizacion -->
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA6V_PGPL3DgRUcj9H3d3fmNXbAUZchO7A&language=es&region=mx&sensor=false&amp;libraries=places"></script>
		<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/HelperJs/jquery.geocomplete.js"></script>
	<!-- Custom and plugin javascript -->
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/inspinia.js"></script>
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/plugins/pace/pace.min.js"></script>
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/plugins/wow/wow.min.js"></script>
	<script src="http://www.archysoft.com.mx/ecosheys_dev/web/js/plugins/toastr/toastr.min.js"></script>

	<script>

		$(document).ready(function () {

			$('body').scrollspy({
				target: '.navbar-fixed-top',
				offset: 80
			});

			// Page scrolling feature
			$('a.page-scroll').bind('click', function(event) {
				var link = $(this);
				$('html, body').stop().animate({
					scrollTop: $(link.attr('href')).offset().top - 50
				}, 500);
				event.preventDefault();
				$("#navbar").collapse('hide');
			});
			
			// Form submit
			$('#frm_Cotizacion').submit(function (event) {
				event.preventDefault();	
					$('.modal-body').toggleClass('sk-loading'); $('.sk-spinner-double-bounce').css("display","block");
					$('#btnCotizar').prop("disabled", true);									
					$.post("ecosheys.php", $(this).serialize()+'&TypeForm=NewQuotation', function(data){
						
					  }).done(function(data) {
						$('#returnAjax').html(data);
						setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 8000
							};
							toastr.success('Pronto recibirá una respuesta', '¡Cotización Solicitada!');
							$('.modal-body').toggleClass('sk-loading'); $('.sk-spinner-double-bounce').css("display","none");
							$('#btnCotizar').prop("disabled", false);
							$('#modalCotizar').modal('hide');
						}, 2300);

						$("#frm_Cotizacion")[0].reset();
						
					  })
					  .fail(function() {
						alert( "error" );
					  })		
			});
		});

		var cbpAnimatedHeader = (function() {
			var docElem = document.documentElement,
					header = document.querySelector( '.navbar-default' ),
					didScroll = false,
					changeHeaderOn = 200;
			function init() {
				window.addEventListener( 'scroll', function( event ) {
					if( !didScroll ) {
						didScroll = true;
						setTimeout( scrollPage, 250 );
					}
				}, false );
			}
			function scrollPage() {
				var sy = scrollY();
				if ( sy >= changeHeaderOn ) {
					$(header).addClass('navbar-scroll')
				}
				else {
					$(header).removeClass('navbar-scroll')
				}
				didScroll = false;
			}
			function scrollY() {
				return window.pageYOffset || docElem.scrollTop;
			}
			init();

		})();

		// Activate WOW.js plugin for animation on scrol
		new WOW().init();

	</script>
	<script>
      $(function(){
        $("#txtPlace").geocomplete()
          .bind("geocode:result", function(event, result){ })
          .bind("geocode:error", function(event, status){ })
          .bind("geocode:multiple", function(event, results){ });
      });
    </script>

	</body>
	</html>
<?php } ?>
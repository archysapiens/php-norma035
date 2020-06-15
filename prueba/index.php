<?php

require('bd/bd.php');
require('bd/base64.php');
require('helpers.php');
require('template/header.php');
require('clases/Login.php');

    session_start();
	//session_unset();
	//session_destroy();

		$login = new Login();
		$login->readLogin();
		$sufijo='';

		if(!isset($_SESSION['sesionUsuario']))
		{
			
			if(isset($_POST['login'])){

				if(read_login($_POST['inputUsuario'],$_POST['inputPassword'],$result) == 1)
				{

					if($result->ESTATUS != 'A')
					{
						session_unset();
						echo " <script type = 'text/JavaScript'>
							   $(document).ready(function(){
								$('.ajax_login').html(\"<div class='panel panel-warning col-sm-12'> <div class='panel-heading'><h5>Usuario inactivo, Consulte al Administrador.</h5></div></div><hr>\");
								$('#error-user').html(\"<div class='form-group has-warning has-feedback'><div class='input-group'><span class='input-group-addon'><i class='fa fa-user fa-lg'></i></span><input type='email' id='inputUsuario' name='inputUsuario' class='form-control' placeholder='Usuario Autorizado' required autofocus></div></div>\");
								$('#error-psw').html(\"<div class='form-group has-warning has-feedback'><div class='input-group'><span class='input-group-addon'><i class='fa fa-key fa-lg'></i></span><input type='password' id='inputPassword' name='inputPassword' class='form-control' size='25' placeholder='Contraseña' required></div></div>\");
								$('#error-remember').html(\"<div class='form-group has-warning has-feedback'><div id='remember' class='checkbox'><label><input type='checkbox' value='remember-me' data-toggle='tooltip' data-placement='bottom' title='Recuérdame'> Recuérdame</label></div></div>\");
								$('#error-btn').html(\"<div class='form-group has-warning has-feedback'><input type='submit' name='login' id='iniciar' value='Iniciar' data-toggle='tooltip' data-placement='bottom' title='Iniciar' class='btn btn-warning loading'></div>\");
								});
						   </script>";
					}
					else{
							
							$_SESSION['sesionUsuario'] = $result->USUARIO;
							$_SESSION['sesionNomUser'] = $result->NOMBRE_U.' '.$result->APP_PATERNO_U.' '.$result->APP_MATERNO_U;
							$_SESSION['sesionPrivi'] = $result->TIPO_USUARIO;
							$_SESSION['sesionArea'] = $result->AREA; 
							$_SESSION['sesionSucur'] = $result->SUCURSAL;
							$_SESSION['sesionStatus'] = $result->ESTATUS;
							$_SESSION['intervalo']  = 30; // en minutos
							$_SESSION['inicio'] = time();
							//traer datos de la tabla usuarios ********
							//Se crea una cookie e inicia sesión de usuario.
							if($_SESSION['sesionPrivi'] == 'CLIENTE'){setCookie('id_emp', $result->NO_CLIENTE_EMP);}
							setCookie('id', $result->ID_USER);

							if( $_SESSION['sesionPrivi'] == 'ADMINISTRADOR' or $_SESSION['sesionPrivi'] == 'TECNICO' or $_SESSION['sesionPrivi'] == 'CLIENTE' or $_SESSION['sesionPrivi'] == 'RESPONSABLE' or $_SESSION['sesionPrivi'] == 'ALUMNO' or $_SESSION['sesionPrivi'] == 'INSTRUCTOR') {
								?> <script> location.href='controllers/inicio.php';</script> <?php
							}else{
								session_unset();
							}
							
					}
				}
				else
				{
					session_unset();

					 echo " <script type = 'text/JavaScript'>
							   $(document).ready(function(){
								$('.ajax_login').html(\"<div class='panel panel-danger col-sm-12'> <div class='panel-heading'><h5>Usuario o Contraseña incorrectos</h5></div></div><hr>\");
								$('#error-user').html(\"<div class='form-group has-error has-feedback'><div class='input-group'><span class='input-group-addon'><i class='fa fa-user fa-lg'></i></span><input type='email' id='inputUsuario' name='inputUsuario' class='form-control' placeholder='Usuario Autorizado' required autofocus></div></div>\");
								$('#error-psw').html(\"<div class='form-group has-error has-feedback'><div class='input-group'><span class='input-group-addon'><i class='fa fa-key fa-lg'></i></span><input type='password' id='inputPassword' name='inputPassword' class='form-control' size='25' placeholder='Contraseña' required></div></div>\");
								$('#error-remember').html(\"<div class='form-group has-error has-feedback'><div id='remember' class='checkbox'><label><input type='checkbox' value='remember-me' data-toggle='tooltip' data-placement='bottom' title='Recuérdame'> Recuérdame</label></div></div>\");
								$('#error-btn').html(\"<div class='form-group has-error has-feedback'><input type='submit' name='login' id='iniciar' value='Iniciar' data-toggle='tooltip' data-placement='right'  class='btn btn-danger loading'></div>\");
								});
						   </script>";
				}
			}
			if(isset($_REQUEST['TypeForm'])){ $login->signupForm($_REQUEST); exit; }
			if(isset($_REQUEST['token'])){ $login->activeAccount($_REQUEST); exit; }

				$login->getLogin();

		}
		else
		{
			?> <script> location.href='controllers/inicio.php';</script> <?php
		}

require('template/footer.php');
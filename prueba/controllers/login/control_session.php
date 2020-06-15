<?php
	$pageAnterior = $_SERVER['REQUEST_URI'];
	$opcionesPage = explode("/", $pageAnterior);
	$ultimaPage=array_pop($opcionesPage);
	if(count($opcionesPage)==5){$_SESSION['pageAnterior'] = $opcionesPage[4].'/'.$ultimaPage;
	}else{$_SESSION['pageAnterior'] = $ultimaPage;}
	$segundos = time();
	$tiempo_transcurrido = $segundos;
	$tiempo_maximo = $_SESSION['inicio']  + ( $_SESSION['intervalo'] * 60 ) ; // se multiplica por 60 segundos ya que se configura en minutos
	if($tiempo_transcurrido > $tiempo_maximo){
	// header('location: '.$sufijoMenu.'login/lockscreen.php'); 
	//Actualización Lockscreen por Ajax ?>
		<script type="text/javascript" src="<?=@$sufijo?>web/js/HelperJs/scripts/jquery-ui-1-11-2/jquery-1.11.2.js"></script>
		<!-- MESSAGE BOX-->
		<div class="message-box animated fadeIn open" data-sound="alert" id="mb-signout">
			<div class="lock-word animated fadeInDown">
				<span class="first-word">LOCKED</span><span>SCREEN</span>
			</div>
			<div class="middle-box text-center lockscreen animated fadeInDown">
				<div>
					<div class="m-b-md">
					<img alt="image" class="img-circle circle-border" height="155" width="150" src="<?=@$sufijo?>web/img/trabajador.jpg">
					</div>
					<h3 style="color:white;font-size:22px"><?=$_SESSION['sesionUsuario']?></h3>
					<p class="text-muted" style="color:white;font-size:13px">Usted está en la pantalla de bloqueo. La aplicación principal se ha cerrado y debe introducir su contraseña para volver a la aplicación.</p>
					<form class="m-t form-signin" role="form" action="todo.php" method="post" autocomplete="off" id="idFormLockScreen">
						<div class="form-group has-feedback" id="hasFeedbackLock">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
								<input type="password" name="inputPassword" class="form-control inputPassword" size='25' placeholder="******" required>
							</div>							
							<input type="text" name="unlock" class="form-control hidden" value="resetTime">
						</div>
						<button type="button" name="unlock" id="unlock" value="resetTime" class="btn btn-primary block full-width">Desbloquear</button>
					</form>
				</div><div id="resultLockScreen" class="hidden"></div>
			</div>
		</div>
		<!-- END MESSAGE BOX-->
		<script>
			$("#unlock").click(function(event) {
				event.preventDefault();
				var i=$('.inputPassword');
				var b=$('#unlock');
				b.addClass('disabled');
				$.ajax({
					type: "POST",
					url: "<?=@$sufijoMenu?>login/lockscreen.php",
					data: $("#idFormLockScreen").serialize(),
					success: function(result) {
						$('#resultLockScreen').html(result);
						if(result=='error'){
							$('#hasFeedbackLock').addClass('has-error');
							i.val('');
							setTimeout(function() {
								toastr.options = {
									closeButton: true,
									progressBar: true,
									positionClass: 'toast-top-center',
									showMethod: 'slideDown',
									timeOut: 5000
								};
								toastr.error('','Contraseña Incorrecta');
								b.removeClass('disabled');
							},1200); }else{
							window.location.href = result; }																		
					}
				});												
				
				return false;
			});
		</script>  <?php	
	//fin de Actualización Lockscreen
	}else{
	// se resetea el inicio
	$_SESSION['inicio'] = time();
	}
?>
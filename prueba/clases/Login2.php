<?php

class Login {

    public function getLogin(){
		 echo"
            <script>
            $(document).ready(function(){
            $('[data-toggle=\"tooltip\"]').tooltip();
             });
            </script>";
	   ?>
			<style>
                /*
				 * Specific styles of signin component
				 */
				/*
				 * General styles
				 */
				body, html {
					height: 100%;
					background-repeat: no-repeat;
					  /* background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33)); */
					/* background-color:#f5f5f5; **/
					background-color:#fFfFfF;
				}

				.card-container.card {
					width: 350px;
					padding: 40px 40px;
				}

				.btn {
					font-weight: 700;
					height: 36px;
					-moz-user-select: none;
					-webkit-user-select: none;
					user-select: none;
					cursor: default;
				}

				/*
				 * Card component
				 */
				.card {
					background-color: #F7F7F7;
					/* just in case there no content*/
					padding: 20px 25px 30px;
					margin: 0 auto 35px;
					margin-top: 50px;
					/* shadows and rounded borders */
					-moz-border-radius: 3px;
					-webkit-border-radius: 2px;
					border-radius: 2px;
					-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
					-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
					box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
				}

				.profile-img-card {
					width: 136px;
					height: 136px;
					margin: 0 auto 10px;
					display: block;
					-moz-border-radius: 50%;
					-webkit-border-radius: 50%;
					border-radius: 50%;
				}

				/*
				 * Form styles
				 */
				.profile-name-card {
					font-size: 16px;
					font-weight: bold;
					text-align: center;
					margin: 10px 0 0;
					min-height: 1em;
				}

				.reauth-email {
					display: block;
					color: #404040;
					line-height: 2;
					margin-bottom: 10px;
					font-size: 14px;
					text-align: center;
					overflow: hidden;
					text-overflow: ellipsis;
					white-space: nowrap;
					-moz-box-sizing: border-box;
					-webkit-box-sizing: border-box;
					box-sizing: border-box;
				}

				.form-signin .form-control:focus {
					border-color: rgb(104, 145, 162);
					outline: 0;
					-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
					box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
				}

				.btn-signin {
					/*background-color: #4d90fe; */
					background-color: rgb(104, 145, 162);
					/* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
					padding: 0px;
					font-weight: 700;
					font-size: 14px;
					height: 36px;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
					border-radius: 3px;
					border: none;
					-o-transition: all 0.218s;
					-moz-transition: all 0.218s;
					-webkit-transition: all 0.218s;
					transition: all 0.218s;
				}

				.btn-signin:hover,
				.btn-signin:active,
				.btn-signin:focus {
					background-color: rgb(12, 97, 33);
				}

				.forgot-password {
					color: rgb(104, 145, 162);
				}

				.forgot-password:hover,
				.forgot-password:active,
				.forgot-password:focus{
					color: rgb(12, 97, 33);
				}
            </style>
			<body>
			<style>
			@media screen and (max-width: 600px){
				#logo-ecosheys{
					width:150px;
					height:70px;
				}
				h2{
					font-size: 18px;
				}
				.welcome-messagee{
					font-size: 5.8px;
					padding-left:5px;
				}
				#line-defo{
					display:none;
				}
			}
			</style>
			<table align="center" height="60" style="width: 100%">
				<tr>
					<td width="40%" align="left"><img src="web/img/EcoSheys-RINO-DIBUJO.png" id="logo-ecosheys" width="289px" height="95px"/></td>
					<td width="60%" align="right">
						<div class="col-lg-11"><h2> Sistema Administrativo Empresarial </h2></div>
					</td>
				</tr>
			</table>
			
			<div class="container">
				<div class="card card-container">
					<img id="profile-img" class="profile-img-card" src="web/img/trabajador.jpg" />
					<p id="profile-name" class="profile-name-card"></p>
					<form class="form-signin" method="post" action="" role="form" autocomplete="off">
						<span id="reauth-email" class="reauth-email"></span>
							<div class="form-group" id="error-user">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user fa-lg"></i>
									</span>
									<input type="email" value="" id="inputUsuario" name="inputUsuario" class="form-control" placeholder="Usuario Autorizado" required autofocus>
								</div>
							</div>
							<div class="form-group" id="error-psw">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-key fa-lg"></i>
									</span>
									<input type="password"  id="inputPassword" name="inputPassword" class="form-control" size='25' placeholder="Contraseña" required>
								</div>
							</div>
							<div class="form-group" id="error-remember">
								<div id="remember" class="checkbox">
									<label>
										<input type="checkbox" value="remember-me" data-toggle="tooltip" data-placement="bottom" title="Recuérdame"> Recuérdame
									</label>
								</div>
							</div>
							<div class="form-group text-center" id="error-btn">
								<button type='submit' name="login" id="btnEnviar" class="btn btn-lg btn-primary btn-block btn-signin loading" data-style="zoom-out"><span class="ladda-label">Ingresar</span></button>
							</div>
							
						<!--<button id="btnEnviar" name="login" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button> -->
					</form><!-- /form -->
					<a href="#" class="forgot-password"> ¿Olvido su Password? </a><br><br>

					<a href="#" class="forgot-password"> Registrarse ahora </a>

					 <center><div class='ajax_login'></div></center>
				</div><!-- /card-container -->
			</div><!-- /container -->
			
			<div id="footerEPN" style="clear:both; margin-top: 12px;">
				  <div style="clear: both; width: 100%; border-top: 1px solid #dedede; margin-bottom: 1px;"></div>
				<div style="border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; font-family: 'Times New Roman', serif; font-size: 14px; color: #666666; text-align: center; padding: 14px 0px;">Copyright © 2017 Ecosheys  <a href="http://portal.salud.gob.mx/contenidos/inicio/politicas.html" style="text-decoration: none; color: #808080;"></a></div>
				<div style="clear: both; width: 100%; border-top: 1px solid #dedede; margin-top: 1px;"></div>
				<div style="clear:both; width: 100%;">
				  <div style="float: left; border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; width: 570px; height:1px; margin-top: 38px;" id="line-defo"></div>
					<div><img src="web/img/logo-eco-pequenio.png" width="180" height="72" />
					</div>
					<div style="float: right; border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; width: 570px; height:1px; margin-top: -33px;"></div>
					<div style="clear: both; width: 100%;"></div>
				</div>
				<div style="margin: 32px auto 42px auto; text-align: center; font-family: 'Times New Roman', serif; font-weight: lighter; font-size: 14px;">
				  <p style="color: #808080; line-height: 5px;">San Cristobal Huichochitlan</p>
				  <p style="color: #808080; line-height: 5px;">Estado de México</p>
				</div>
				<div style="clear: both; width: 100%;"></div>
			</div>
            </body>
		<?php	
    }

    public function readLogin(){

        function read_login($user,$password,&$result)
        {
			$db = new DbCnnx();
            $SQL = sprintf("SELECT * FROM usuarios WHERE USUARIO='$user' AND PASSWORD='$password'");
            $rec = $db->combo($SQL);
			$count = 0;
			while ($row = $rec->fetch_assoc()) {
                $count++;
				$rows[] = $row;
				$result = (object) $row;
            }
			
			if($count == 1){ return 1; }
            else{ return 0; }
			
        }
		
    }
	
	public function unlock($user,$password){

			$db = new DbCnnx();
            $SQL = sprintf("SELECT * FROM usuarios WHERE USUARIO='$user' AND PASSWORD='$password'");
            $rec = $db->combo($SQL);
			$count = 0;
			while ($row = $rec->fetch_assoc()) {
                $count++;
            }
			
			if($count == 1){ return 1; }
            else{ return 0; }
			
    }
	
	public function lock(){
		$_SESSION['inicio'] = 0;
    }

}
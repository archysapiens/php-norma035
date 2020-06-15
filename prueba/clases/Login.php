<?php

class Login {

    public function getLogin(){  ?>			
			
			<style>
				#body2{	
					background-image: linear-gradient(to bottom, rgba(212, 207, 207, 0.33) 0%,rgba(195, 188, 188, 0.22) 100%), url("https://pbs.twimg.com/profile_images/378800000544650537/e421bb464e10caf9d1d90bded23ab16f.jpeg");
					width:1350px;
					height:700px;
					opacity:0.1;
					position:absolute;
				}
				.profile-img-card {
					width: 136px;
					height: 136px;
					margin: -10px 45% 10px;
					display: block;
					-moz-border-radius: 50%;
					-webkit-border-radius: 50%;
					border-radius: 50%;
				}
				@media(max-width: 990px){
					body {	
					  background: #e9e9e9;
					  color: #666666;
					  font-family: 'RobotoDraft', 'Roboto', sans-serif;
					  font-size: 14px;
					  -webkit-font-smoothing: antialiased;
					  -moz-osx-font-smoothing: grayscale;
					}
					/* Pen Title */
					.pen-title {
					  padding: 50px 0;
					  text-align: center;
					  letter-spacing: 2px;
					}
					.pen-title h1 {
					  margin: 0 0 20px;
					  font-size: 48px;
					  font-weight: 300;
					}
					.pen-title span {
					  font-size: 12px;
					}
					.pen-title span .fa {
					  color: #11987d;
					}
					.pen-title span a {
					  color: #11987d;
					  font-weight: 600;
					  text-decoration: none;
					}
					/* Form Module */
					.form-module {
					  position: relative;
					  background: #ffffff;
					  max-width: 320px;
					  width: 100%;
					  border-top: 5px solid #11987d;
					  -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
							  box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
					  margin: 0 auto;
					}
					.form-module .toggle {
					  cursor: pointer;
					  position: absolute;
					  top: -0;
					  right: -0;
					  background: #11987d;
					  width: 30px;
					  height: 30px;
					  margin: -5px 0 0;
					  color: #ffffff;
					  font-size: 12px;
					  line-height: 30px;
					  text-align: center;
					}
					.form-module .toggle .tooltip {
					  position: absolute;
					  top: 5px;
					  right: -65px;
					  display: block;
					  background: rgba(0, 0, 0, 0.6);
					  width: auto;
					  padding: 5px;
					  font-size: 10px;
					  line-height: 1;
					  text-transform: uppercase;
					}
					.form-module .toggle .tooltip:before {
					  content: '';
					  position: absolute;
					  top: 5px;
					  left: -5px;
					  display: block;
					  border-top: 5px solid transparent;
					  border-bottom: 5px solid transparent;
					  border-right: 5px solid rgba(0, 0, 0, 0.6);
					}
					.form-module .form {
					  display: none;
					  padding: 40px;
					}
					.form-module .form:nth-child(2) {
					  display: block;
					}
					.form-module h2 {
					  margin: 0 0 20px;
					  color: #11987d;
					  font-size: 18px;
					  font-weight: 400;
					  line-height: 1;
					}
					.form-module input {
					  outline: none;
					  display: block;
					  width: 100%;
					  border: 1px solid #d9d9d9;
					  margin: 0 0 20px;
					  padding: 10px 15px;
					  -webkit-box-sizing: border-box;
							  box-sizing: border-box;
					  font-wieght: 400;
					  -webkit-transition: 0.3s ease;
					  transition: 0.3s ease;
					}
					.form-module input:focus {
					  border: 1px solid #11987d;
					  color: #333333;
					}
					.form-module button {
					  cursor: pointer;
					  background: #11987d;
					  width: 100%;
					  border: 0;
					  padding: 10px 15px;
					  color: #ffffff;
					  -webkit-transition: 0.3s ease;
					  transition: 0.3s ease;
					}
					.form-module button:hover {
					  background: #0d7762;
					}
					.form-module .cta {
					  background: #f2f2f2;
					  width: 100%;
					  padding: 15px 40px;
					  -webkit-box-sizing: border-box;
							  box-sizing: border-box;
					  color: #666666;
					  font-size: 12px;
					  text-align: center;
					}
					.form-module .cta a {
					  color: #333333;
					  text-decoration: none;
					}
					.form form span.error {
					  color: #a51111c4;
					  font-family: "Montserrat", sans-serif;
					  font-size: 12px;
					  position: absolute;
					  bottom: -20px;
					  right: 0;
					  display: none;
					}
				}				
			
				@media(min-width: 990px) {
					body {
					  font-family: "Montserrat", sans-serif;
					  /*background-image: linear-gradient(to bottom, rgba(212, 207, 207, 0.33) 0%,rgba(195, 188, 188, 0.22) 100%), url("https://pbs.twimg.com/profile_images/378800000544650537/e421bb464e10caf9d1d90bded23ab16f.jpeg");
					  background-size: 150px 150px;*/
					  /*background: #abaaa836;*/
					  background: url(./web/images/alas1.png);
					  background-size: 100%,100%;
					  -moz-transform: scale(0.9, 0.9); zoom: 0.9; zoom: 90%;
					}
					.container {
					  max-width: 900px;
					}
					a {
					  display: inline-block;
					  text-decoration: none;
					}
					input { outline: none !important; }
					h1 {
					  text-align: center;
					  text-transform: uppercase;
					  margin-bottom: 40px;
					  font-weight: 700;
					}
					section#formHolder {
					  padding: 50px 0;
					}
					.brand {
					  padding: 20px;
					  background: url(https://goo.gl/A0ynht);
					  background-size: cover;
					  background-position: center center;
					  color: #fff;
					  min-height: 540px;
					  position: relative;
					  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
					  transition: all 0.6s cubic-bezier(1, -0.375, 0.285, 0.995);
					  z-index: 9999;				  
					}
					.brand.active {
					  width: 100%;
					}
					.brand::before {
					  content: "";
					  display: block;
					  width: 100%;
					  height: 100%;
					  position: absolute;
					  top: 0;
					  left: 0;
					  background: #D4C19C!important;
					  z-index: -1;
					  border-radius:1%;
					}
					.brand a.logo {
					  color: #fff;
					  font-size: 22px;
					  font-weight: 700;
					  text-decoration: none;
					  line-height: 4em;
					}
					.brand a.logo span {
					  font-size: 30px;
					  color: #fff;
					  transform: translateX(-5px);
					  display: inline-block;
					}
					.brand .heading {
					  position: absolute;
					  top: 57%;
					  left: 50%;
					  transform: translate(-50%, -50%);
					  text-align: center;
					  transition: all 0.6s;
					}
					.brand .heading.active {
					  top: 100px;
					  left: 100px;
					  transform: translate(0);
					}
					.brand .heading h2 {
					  font-size: 70px;
					  font-weight: 700;
					  text-transform: uppercase;
					  margin-bottom: 0;
					}
					.brand .heading p {
					  font-size: 15px;
					  font-weight: 300;
					  text-transform: uppercase;
					  letter-spacing: 2px;
					  white-space: 4px;
					  font-family: "Raleway", sans-serif;
					}
					.brand .success-msg {
					  width: 100%;
					  text-align: center;
					  position: absolute;
					  top: 50%;
					  left: 50%;
					  transform: translate(-50%, -50%);
					  margin-top: 60px;
					}
					.brand .success-msg p {
					  font-size: 25px;
					  font-weight: 400;
					  font-family: "Raleway", sans-serif;
					}
					.brand .success-msg a {
					  font-size: 12px;
					  text-transform: uppercase;
					  padding: 8px 30px;
					  background: #149e82;
					  text-decoration: none;
					  color: #fff;
					  border-radius: 30px;
					}
					.brand .success-msg p, .brand .success-msg a {
					  transition: all 0.9s;
					  transform: translateY(20px);
					  opacity: 0;
					}
					.brand .success-msg p.active, .brand .success-msg a.active {
					  transform: translateY(0);
					  opacity: 1;
					}
					.form {
					  position: relative;
					}
					.form .form-peice {
					  background: #377664;
					  min-height: 480px;
					  margin-top: 30px;
					  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
					  color: #bbbbbb;
					  padding: 30px 0 60px;
					  transition: all 0.9s cubic-bezier(1, -0.375, 0.285, 0.995);
					  position: absolute;
					  top: 0;
					  left: -30%;
					  width: 130%;
					  overflow: hidden;
					  border-radius:30%;
					}
					.form .form-peice.switched {
					  transform: translateX(-100%);
					  width: 100%;
					  left: 0;
					}
					.form form {
					  padding: 0 40px;
					  margin: 0;
					  width: 70%;
					  position: absolute;
					  top: 50%;
					  left: 60%;
					  transform: translate(-50%, -50%);
					}
					.form form .form-group {
					  margin-bottom: 5px;
					  position: relative;
					}
					.form form .form-group.hasError input {
					  border-color: #a51111c4 !important;
					}
					.form form .form-group.hasError label {
					  color: #a51111c4 !important;
					}
					.form form label {
					  font-size: 12px;
					  font-weight: 400;
					  text-transform: uppercase;
					  font-family: "Montserrat", sans-serif;
					  transform: translateY(40px);
					  transition: all 0.4s;
					  cursor: text;
					  z-index: -1;
					}
					.form form label.active {
					  transform: translateY(10px);
					  font-size: 10px;
					}
					.form form label.fontSwitch {
					  font-family: "Raleway", sans-serif !important;
					  font-weight: 600;
					}
					.form form input:not([type=submit]) {
					  background: none;
					  outline: none;
					  border: none;
					  display: block;
					  padding: 10px 0;
					  width: 100%;
					  border-bottom: 1px solid #acb4b3;
					  color: #444;
					  font-size: 15px;
					  font-family: "Montserrat", sans-serif;
					  z-index: 1;
					}
					.form form input:not([type=submit]).hasError {
					  border-color: #a51111c4;
					}
					.form form span.error {
					  color: #a51111c4;
					  font-family: "Montserrat", sans-serif;
					  font-size: 12px;
					  position: absolute;
					  bottom: -20px;
					  right: 0;
					  display: none;
					}
					.form form input[type=password] {
					  color: #149e82;
					}
					.form form .CTA {
					  margin-top: 30px;
					}
					.form form .CTA input {
					  font-size: 12px;
					  text-transform: uppercase;
					  padding: 5px 30px;
					  background: #149e82;
					  color: #fff;
					  border-radius: 30px;
					  margin-right: 20px;
					  border: none;
					  font-family: "Montserrat", sans-serif;
					}
					.form form .CTA a.switch {
					  font-size: 13px;
					  font-weight: 400;
					  font-family: "Montserrat", sans-serif;
					  color: #bbbbbb;
					  text-decoration: underline;
					  transition: all 0.3s;
					}
					.form form .CTA a.switch:hover {
					  color: #149e82;
					}
					footer {
					  text-align: center;
					}
					footer p {
					  color: #777;
					}
					footer p a, footer p a:focus {
					  color: #b8b09f;
					  transition: all 0.3s;
					  text-decoration: none !important;
					}
					footer p a:hover, footer p a:focus:hover {
					  color: #149e82;
					}
						@media (max-width: 768px) {
						  .container {
							overflow: hidden;
						  }
						  section#formHolder {
							padding: 0;
						  }
						  section#formHolder div.brand {
							min-height: 200px !important;
						  }
						  section#formHolder div.brand.active {
							min-height: 100vh !important;
						  }
						  section#formHolder div.brand .heading.active {
							top: 200px;
							left: 50%;
							transform: translate(-50%, -50%);
						  }
						  section#formHolder div.brand .success-msg p {
							font-size: 16px;
						  }
						  section#formHolder div.brand .success-msg a {
							padding: 5px 30px;
							font-size: 10px;
						  }
						  section#formHolder .form {
							width: 80vw;
							min-height: 500px;
							margin-left: 10vw;
						  }
						  section#formHolder .form .form-peice {
							margin: 0;
							top: 0;
							left: 0;
							width: 100% !important;
							transition: all 0.5s ease-in-out;
						  }
						  section#formHolder .form .form-peice.switched {
							transform: translateY(-100%);
							width: 100%;
							left: 0;
						  }
						  section#formHolder .form .form-peice > form {
							width: 100% !important;
							padding: 60px;
							left: 50%;
						  }
						}
						@media (max-width: 480px) {
						  section#formHolder .form {
							width: 100vw;
							margin-left: 0;
						  }
						  h2 {
							font-size: 50px !important;
						  }
						}
					#logo-ecosheys{
						border: 0;
						border-radius: 4%;
						opacity:0.9;
					}				
				}	
				.wrapper-msg {
					display: block;
					background: #383838f0;
					padding: 20px 30px;
					position:absolute;
					z-index:99999;
				}
				.wrapper-msg.urgency-high .msg {
					color: #fff;
				}
				.dashboard-banner .wrapper-msg .msg {
					font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
				   /* padding-bottom: 20px;
					border-bottom: thin solid #767676; */
				}
				.msg {
					margin: 10px 0 10px 26px;
				}
				.wrapper-msg .msg-content, .wrapper-msg .msg-icon {
					display: inline-block;
					vertical-align: middle;
				}
            </style>
			<body>
				<div id="body2"> </div>				
				<div class="dashboard-notifications hidden" tabindex="-1" id="FlashNotify">
					<div class="dashboard-banner">								
						<div class="wrapper-msg urgency-high" id="wrapper-msg">
						  <div class="msg">
							<div class="msg-content" style="margin-top:-40px;">
							  <h2 class="title" id="msgTitle"> ¡Ya casi ha terminado! <i class="fa fa-check" style="font-size:32px;"></i> </h2>
							  <div class="copy">
								<p class="activation-message" id="msgContent">Hay sólo un paso más: Antes de inscribirse en un curso, necesita activar su cuenta. Hemos enviado un mensaje de correo electrónico a <strong id="ValEmailSend" style="color: #389683;"></strong> con instrucciones para activar su cuenta. Si no encuentra este mensaje en su bandeja de entrada, revise sus otras carpetas de correo y la carpeta de correo no deseado.
								</p>
							  </div>
							</div>
						  </div>
						</div>
					</div>
				</div>
				<table align="center" height="60" style="width: 100%" class="visible-xs visible-sm">
					<tr>
						<td width="40%" align="left"><img src="web/img/EcoSheys-RINO-DIJO.png" id="logo-ecosheys" width="289px" height="95px"/></td>
						<td width="60%" align="right"> <div class="col-lg-11"><h2> Sistema Administrativo Empresarial </h2></div> </td>
					</tr>
				</table>			
				<div class="container">
					<section id="formHolder" class="hidden-xs hidden-sm">
						<div class="row">
							<!-- Brand Box -->
							<div class="col-sm-6 brand">
								<a href="#" class="logo">Sistema Administrativo Empresarial <span>.</span></a>
								<div class="heading">
									<img src="web/images/patria.gif" id="logo-ecosheys" width="289px" height="170px"/>
								</div>
								<div class="success-msg">
									<p>Great! You are one of our members now</p>
									<a href="#" class="profile">Your Profile</a>
								</div>
							</div>
							<!-- Form Box -->
							<div class="col-sm-6 form">
								<!-- Login Form -->
								<div class="login form-peice ">
									<div class="toggle"><i class="fa fa-times fa-pencil"></i>
										<div class="tooltip">Click Me</div>
									</div>
									<img id="profile-img" class="profile-img-card" src="web/img/Elbeni.png"/>
									<form class="login-form" action="#" method="post">                  
										<div class="form-group" id="error-user" style="padding-top:130px;">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-user fa-lg"></i>
												</span>
												<input type="email" value="" id="inputUsuario" name="inputUsuario" class="form-control" placeholder="Usuario Autorizado" required autofocus>
											</div>
										</div>
										<div class="form-group" id="error-psw" style="padding-top:20px;">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-key fa-lg"></i>
												</span>
												<input type="password"  id="inputPassword" name="inputPassword" class="form-control" size='25' placeholder="Contraseña" required>
											</div>
										</div>                
										<div class="CTA">
											<div class="form-group text-center" id="error-btn">
												<button type='submit' name="login" id="btnEnviar" class="btn btn-md btn-primary btn-signin loading" data-style="zoom-out"><span class="ladda-label">Ingresar</span></button>
											</div>
											<a href="#" class="switch">Registrame</a>
										</div>
									</form>
								</div><!-- End Login Form -->
								
								<!-- Signup Form -->
								<div class="signup form-peice switched">
									<form class="signup-form" action="#" method="post">					
										<div class="form-group">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-user fa-lg"></i>
												</span>
												<input type="text" value="" id="name" name="username" class="form-control name text-capitalize" placeholder="Nombre Completo" required>
												<span class="error"></span>
											</div>						
										</div>
										<div class="form-group" style="padding-top:12px;">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-at fa-lg"></i>
												</span>
												<input type="email" value="" id="email" name="emailAdress" class="form-control email" placeholder="Correo electrónico" required>
												<span class="error"></span>
											</div>						
										</div>
										<div class="form-group" style="padding-top:12px;">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-phone fa-lg"></i>
												</span>
												<input type="text" value="" id="phone" name="phone" class="form-control" placeholder="Teléfono">
											</div>
										</div>
										<div class="form-group" style="padding-top:12px;">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-building fa-lg"></i>
												</span>
												<input type="text" value="" id="company" name="company" class="form-control text-capitalize" placeholder="Empresa">
											</div>
										</div>
										<div class="form-group" style="padding-top:12px;">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-user-plus fa-lg"></i>
												</span>
												<select class="form-control m-b" name="typeUser" id="typeUser">
													<option>Alumno</option>
													<option>Instructor</option>
												</select>
											</div>
										</div>
										<div class="form-group" style="padding-top:12px;">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-key fa-lg"></i>
												</span>
												<input type="password" value="" id="password" name="password" class="form-control pass" placeholder="Contraseña" required>
												<span class="error"></span>
											</div>						
										</div>
										<div class="form-group" style="padding-top:12px;">
											<div class="input-group">						
												<span class="input-group-addon">
													<i class="fa fa-key fa-lg"></i>
												</span>
												<input type="password" value="" id="passwordCon" name="passwordCon" class="form-control passConfirm" placeholder="Confirm Contraseña" required>
												<span class="error"></span>
											</div>
										</div>			
										<div class="CTA">
											<input type="submit" value="Regístrate ahora" id="submit" name="btnRegister" class="btnRegister">
											<a href="#" class="switch">Tengo una cuenta</a>
										</div>
									</form>
								</div><!-- End Signup Form -->
							</div>
						</div>
					</section>
				   
					<!-- Login para Móvil -->
					<div id="Form Mixin" class="visible-xs visible-sm">
						<!-- Form Module-->
						<div class="module form-module">			
							<div class="toggle"><i class="fa fa-times fa-pencil"></i>
								<div class="tooltip">Registrame</div>
							</div>		  
							<div class="form">
								<div class="" style="margin-bottom:30px;margin-right:125px">
									<img id="profile-img" class="profile-img-card" src="web/img/trabajador.jpg"/>	    
								</div>		  				  			
								<form class="login-form" action="#" method="post">
									<div class="form-group" id="error-user" style="padding-top:13px;">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user fa-lg"></i>
											</span>
											<input type="email" value="" id="inputUsuario" name="inputUsuario" class="form-control" placeholder="Usuario Autorizado" required autofocus>
										</div>
									</div>
									<div class="form-group" id="error-psw" style="padding-top:5px;">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key fa-lg"></i>
											</span>
											<input type="password"  id="inputPassword" name="inputPassword" class="form-control" size='25' placeholder="Contraseña" required>
										</div>
									</div>			  
									<div class="form-group text-center" id="error-btn" style="padding-top:10px;">
										<button type='submit' name="login" id="btnEnviar" class="btn btn-md btn-primary btn-signin loading" data-style="zoom-out"><span class="ladda-label">Ingresar</span></button>
									</div>
								</form>
							</div>
							<div class="form">
								<h2 style="margin-top:-25px;margin-bottom:30px;font-size:22px;text-align:center;">Crea una cuenta</h2>
								<form class="signup-form" action="#" method="post" id="signup-form">
									<div class="form-group">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-user fa-lg"></i>
											</span>
											<input type="text" value="" id="name" name="username" class="form-control name text-capitalize" placeholder="Nombre Completo" required>
											<span class="error"></span>
										</div>						
									</div>
									<div class="form-group" style="padding-top:4px;">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-at fa-lg"></i>
											</span>
											<input type="email" value="" id="email" name="emailAdress" class="form-control email" placeholder="Correo electrónico" required>
											<span class="error"></span>
										</div>						
									</div>
									<div class="form-group" style="padding-top:4px;">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-phone fa-lg"></i>
											</span>
											<input type="text" value="" id="phone" name="phone" class="form-control" placeholder="Teléfono">
										</div>
									</div>
									<div class="form-group" style="padding-top:4px;">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-building fa-lg"></i>
											</span>
											<input type="text" value="" id="company" name="company" class="form-control text-capitalize" placeholder="Empresa">
										</div>
									</div>
									<div class="form-group" style="padding-top:4px;">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-user-plus fa-lg"></i>
											</span>
											<select class="form-control m-b" name="typeUser" id="typeUser">
												<option>Alumno</option>
												<option>Instructor</option>
											</select>
										</div>
									</div>
									<div class="form-group" style="padding-top:4px;">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-key fa-lg"></i>
											</span>
											<input type="password" value="" id="password" name="password" class="form-control pass" placeholder="Contraseña" required>
											<span class="error"></span>
										</div>						
									</div>
									<div class="form-group" style="padding-top:4px;">
										<div class="input-group">						
											<span class="input-group-addon">
												<i class="fa fa-key fa-lg"></i>
											</span>
											<input type="password" value="" id="passwordCon" name="passwordCon" class="form-control passConfirm" placeholder="Confirm Contraseña" required>
											<span class="error"></span>
										</div>
									</div>
									<div class="form-group text-center" id="errorRegister-btn" style="padding-top:10px;">
										<button type='submit' name="btnRegister" id="btnRegister" class="btn btn-md btn-primary btn-signin loading" data-style="zoom-out"><span class="ladda-label">Register</span></button>
									</div>
								</form>
							</div>
							<div class="cta" style="margin-top:-30px;"><a href="http://andytran.me">¿Olvidaste tu contraseña?</a></div>
						</div>
					</div>      
				</div>			
				<div id="footerEPN" style="clear:both; margin-top: 12px;">
					  <div style="clear: both; width: 100%; border-top: 1px solid #dedede; margin-bottom: 1px;"></div>
					<div style="border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; font-family: 'Times New Roman', serif; font-size: 14px; color: #666666; text-align: center; padding: 14px 0px;">Copyright © 2017 Ecosheys  <a href="http://portal.salud.gob.mx/contenidos/inicio/politicas.html" style="text-decoration: none; color: #808080;"></a></div>
					<div style="clear: both; width: 100%; border-top: 1px solid #dedede; margin-top: 1px;"></div>
					<div style="clear:both; width: 100%;">
					  <div style="float: left; border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; width: 570px; height:1px; margin-top: 38px;" id="line-defo"></div>
						<div><img src="web/img/saludnue.png" width="180" height="72" />
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
				<div id="return" class="hidden"> </div>
				<script>
					// Toggle Function
					$('.toggle').click(function(){
					  // Switches the Icon
					  $(this).children('i').toggleClass('fa-pencil');
					  // Switches the forms  
					  $('.form').animate({
						height: "toggle",
						'padding-top': 'toggle',
						'padding-bottom': 'toggle',
						opacity: "toggle"
					  }, "slow");
					});
				</script>
				<script>
					/*global $, document, window, setTimeout, navigator, console, location*/
					$(document).ready(function () {
						'use strict';
						var usernameError = true,
							emailError    = true,
							passwordError = true,
							passConfirm   = true;
						// Detect browser for css purpose
						if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
							$('.form form label').addClass('fontSwitch');
						}
						// Label effect
						$('input').focus(function () {
							$(this).siblings('label').addClass('active');
						});
						// Form validation
						$('input').keyup(function () {
							// User Name
							if ($(this).hasClass('name')) {
								if ($(this).val().length === 0) {
									$(this).siblings('span.error').text('Por favor escriba su nombre completo').fadeIn().parent('.form-group').addClass('hasError');
									usernameError = true;
								} else if ($(this).val().length > 1 && $(this).val().length <= 6) {
									$(this).siblings('span.error').text('Por favor escriba al menos 6 caracteres').fadeIn().parent('.form-group').addClass('hasError');
									usernameError = true;
								} else {
									$(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
									usernameError = false;
								}
							}
							// Email
							if ($(this).hasClass('email')) {
								if ($(this).val().length == '') {
									$(this).siblings('span.error').text('Por favor escriba su correo electrónico').fadeIn().parent('.form-group').addClass('hasError');
									emailError = true;
								} else {
									$(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
									emailError = false;
								}
							}
							// PassWord
							if ($(this).hasClass('pass')) {
								if ($(this).val().length < 8) {
									$(this).siblings('span.error').text('Por favor escriba al menos 8 charcters').fadeIn().parent('.form-group').addClass('hasError');
									passwordError = true;
								} else {
									$(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
									passwordError = false;
								}
							}
							// PassWord confirmation
							if ($('.pass').val() !== $('.passConfirm').val()) {
								$('.passConfirm').siblings('.error').text('Las contraseñas no coinciden').fadeIn().parent('.form-group').addClass('hasError');
								passConfirm = false;
							} else {
								$('.passConfirm').siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
								passConfirm = false;
							}
							// label effect
							if ($(this).val().length > 0) {
								$(this).siblings('label').addClass('active');
							} else {
								$(this).siblings('label').removeClass('active');
							}
						});
						// form switch
						$('a.switch').click(function (e) {
							$(this).toggleClass('active');
							e.preventDefault();
							if ($('a.switch').hasClass('active')) {
								$(this).parents('.form-peice').addClass('switched').siblings('.form-peice').removeClass('switched');
							} else {
								$(this).parents('.form-peice').removeClass('switched').siblings('.form-peice').addClass('switched');
							}
						});
						// Form submit
						$('form.signup-form').submit(function (event) {
							event.preventDefault(); 
							$('input[type="submit"]').prop("disabled", true).val('  Cargando... ');
							$('#btnRegister').prop("disabled", true).html('Cargando <span class="loading"></span>');						
							if (usernameError == true || emailError == true || passwordError == true || passConfirm == true) {
								$('.name, .email, .pass, .passConfirm').blur();
							} else {
								$(this).attr('id','FormListo');								
								$.post("index.php", $('#FormListo').serialize()+'&TypeForm=Register', function(data){
									
								}).done(function(data) {
									$('#btnRegister').prop("disabled", false).html('<span class="ladda-label">Register</span>');
									$('input[type="submit"]').prop("disabled", false).val('Regístrate ahora');
									$('#return').html(data.substr(1000));									
									if($('#return').html()=='Error1'){ alert('Correo Electronico, Ya existe!'); }else{
									$('.signup').addClass('switched');								
									$('.login').removeClass('switched');
									$('#FlashNotify').removeClass('hidden');
									$('#ValEmailSend').html(' '+$('#email').val()+' '); }
									$("#FormListo")[0].reset();
								  })
								  .fail(function() {
									alert( "error" );
								  })
								/*$('.signup, .login').addClass('switched');
								setTimeout(function () { $('.signup, .login').hide(); }, 700);
								setTimeout(function () { $('.brand').addClass('active'); }, 300);
								setTimeout(function () { $('.heading').addClass('active'); }, 600);
								setTimeout(function () { $('.success-msg p').addClass('active'); }, 900);
								setTimeout(function () { $('.success-msg a').addClass('active'); }, 1050);
								setTimeout(function () { $('.form').hide(); }, 700);*/
							}
						});
						// Reload page
						$('a.profile').on('click', function () {
							location.reload(true);
						});
					});
				</script>
				<script>
					$(document).ready(function(){
						$('[data-toggle=\"tooltip\"]').tooltip();
					});
				</script>
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
	
	public function signupForm($REQUEST){
		$db = new DbCnnx(); 
		@$emailAdress = $REQUEST['emailAdress'];
		$SQL_Verify_Email = "SELECT USUARIO,EMAIL FROM usuarios WHERE USUARIO='$emailAdress' AND EMAIL='$emailAdress'";
		$rec = $db->combo($SQL_Verify_Email);	$count = 0;	 while($row = $rec->fetch_assoc()){ $count++; }
		if($count==0){
			@$username = ucwords(strtolower($REQUEST['username']));			
			@$phone = $REQUEST['phone'];
			@$company = ucwords(strtolower($REQUEST['company']));
			@$typeUser = $REQUEST['typeUser'];
			@$password = $REQUEST['password'];
			@$passwordCon = $REQUEST['passwordCon'];
			$GenerateToken=$this->generateRandomString(25);
			
			if(@$password==@$passwordCon){
				
				require('Email.php');
				include_once("repositorio/Email/class.phpmailer.php");
				include_once("repositorio/Email/class.smtp.php");
				
				$SQL = sprintf("INSERT INTO alta_users_tmp VALUE(DEFAULT,'$username','$emailAdress','$typeUser','$phone','$company','','$password','$GenerateToken','Inactivo')");
				$rec = $db->query($SQL);
				// $SQL = sprintf("INSERT INTO usuarios VALUE(40018,40018,'$username','','','$emailAdress','$phone','$phone','$typeUser','','','',now(),'$emailAdress',$password,'TOLUCA','A')");
				// $rec = $db->query($SQL);
				$Email = new Email();
				// $returnEncrypData = $this->encrypt($GenerateToken);
				$returnEncrypData = $GenerateToken;
				$sendArray = array(
					"to" => $emailAdress,
					"name" => $username,
					"token" => $returnEncrypData
				);
				$Email->sendEmailSignup('','Nuevo Usuario',$sendArray);														
			}
		}else{
             echo "<script>$('#return').html('Error1');</script>";
		}
			
    }
	
	public function activeAccount($REQUEST){
		$this->getLogin();
		@$token = $REQUEST['token'];		
		// $returnDecrypData = $this->decrypt(@$token);
		$returnDecrypData = @$token; 
		$db = new DbCnnx(); 
		$rs = "SELECT MAX(NO_CLIENTE_EMP) AS getIdMax FROM usuarios";						
		$getIdMax = $db->select($rs);
		$id = trim($getIdMax[0]['getIdMax'])+1;						
		$SQL_GET_Token = "SELECT * FROM alta_users_tmp WHERE token='$returnDecrypData' and status='Inactivo'";
		$rec = $db->combo($SQL_GET_Token);	
		$count = 0;	
		$array=array();
		while($row = $rec->fetch_assoc()){ $count++; $array=$row; }
		
		if($count == 1){ $SQL_update_ActiveUser = "UPDATE alta_users_tmp SET status='Activo' WHERE token='$returnDecrypData'";						
					     $rec = $db->query($SQL_update_ActiveUser); 
						 $SQL = "INSERT INTO alta_users VALUE(DEFAULT,'".$array['nombre']."','".$array['type']."',$id,'$token','Active')";						
						 $rec = $db->query($SQL);
						 $SQL = "INSERT INTO usuarios VALUE($id,$id,'".$array['nombre']."','','','".$array['emailAdress']."','".$array['phone']."','".$array['phone']."','".$array['type']."','','','',now(),'".$array['emailAdress']."','".$array['password']."','TOLUCA','A')";
                         $rec = $db->query($SQL);
						  $SQL = "INSERT INTO mod_instructor(ID_USER,NOMBRE)VALUE($id,'".$array['nombre']."')";
                         $rec = $db->query($SQL);
						 echo "<script>$('#wrapper-msg').css({ 'width' : '100%', 'text-align' : 'center' });</script>";
						 echo "<script>$('#FlashNotify').removeClass('hidden');</script>";
						 echo "<script>$('#msgTitle').html('¡Éxito! A activado su cuenta  <i class=\"fa fa-check\" style=\"font-size:32px;\"></i>');</script>";
						 echo "<script>$('#msgContent').html('Ahora recibirá actualizaciones y notificaciones de nosotros por correo con relación a los cursos en los cuales Ud. pudiera estar interesado, ahora puede Iniciar Sesión');</script>";  }
            else{  }		
					
    }
	
	//Método con str_shuffle() 
	public function generateRandomString($length = 10) { 
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	} 
	
	public static function encrypt($input) {
		$Key = "SystemEc0sh3ysSecur1tyFinality";
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($Key), $input, MCRYPT_MODE_CBC, md5(md5($Key))));
        return $output;
    }
 
    public static function decrypt($input) {
		$Key = "SystemEc0sh3ysSecur1tyFinality";
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5($Key))), "\0");
        return $output;
    }

}
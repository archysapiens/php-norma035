<?php

function capturaContacto(){

return "
<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-2 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
		<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>										
								<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>

					<span class=\"\">

											
<i class=\"ace-icon fa fa-at big-icon\"></i>

					</span>




				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-10\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

						<span class=\"label label-purple arrowed-in-right\">
							<i class=\"ace-icon fa fa-circle smaller-80 align-middle\"></i>
							Servidor Publico
						</span>
					</h4>

					<div class=\"profile-user-info\">

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Email </div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
						<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\"blue fa fa-at\"></i>
												</span>
												<input type=\"text\" value=\"\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Email\" required=\"\" autofocus=\"\">
											</div>							
													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Oficina </div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\"blue fa fa-phone\"></i>
												</span>
												<input type=\"tel\" value=\"\" id=\"telefono\" name=\"telefono\" class=\"form-control\" placeholder=\"Numero De oficina\" required=\"\" autofocus=\"\">
											</div>					
					</span>
												</div>
											</div>




						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Celular </div>

							<div class=\"profile-info-value col-xs-6 \">
								<span>
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\"blue fa fa-mobile-phone\"></i>
												</span>
												<input type=\"tel\" value=\"\" id=\"telefonoce\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Celular\" required=\"\" autofocus=\"\">
											</div>
								</span>
							</div>
						</div>

						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Twitter </div>

							<div class=\"profile-info-value  col-xs-6 \">
								<span>
								<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-tumblr-square\" ></i>
												</span>
												<input type=\"email\" value=\"\" id=\"telefonoce\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"twitter\" required=\"\" autofocus=\"\">
											</div>
								</span>
							</div>
						</div>

						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Uso Futuro </div>

							<div class=\"profile-info-value  col-xs-6 \">
				<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\"blue fa fa-facebook-official\"></i>
												</span>
												<input type=\"text\" value=\"\" id=\"telefonoce\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Uso Futuro\" required=\"\" autofocus=\"\">
											</div>				
								
								</span>
							</div>
						</div>

					</div>

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>

";
} // fin de function capturaContacto()



function creaTabuladores($SeccionImagen){


$Personales=$SeccionImagen;
$Contacto= capturaContacto();
$Domicilio =""; // capturaDomicilio();
$Documentos =""; // capturaDocumentos();


return "
          
<div class=\"wrapper wrapper-content animated fadeInRight\" id=\"main_page_2\" style=\"
    padding-top: 0px;\">
						<div class=\"row\">
							<div class=\"col-lg-12 \">
								<div class=\"ibox float-e-margins\">

<!-- inicio formulario -->



							<div class=\"col-xs-12\">
								<!-- PAGE CONTENT BEGINS -->
								<div class=\"tabbable\">
									<ul class=\"nav nav-tabs padding-18 tab-size-bigger\" id=\"myTab\">
										<li class=\"active\">
											<a data-toggle=\"tab\" href=\"#faq-tab-1\">
												<i class=\"blue ace-icon fa fa-user bigger-220\"></i>
												Personales
											</a>
										</li>

										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-2\">
												<i class=\"blue ace-icon fa  fa-at bigger-220\"></i>
												Contácto
											</a>
										</li>

										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-3\">
												<i class=\"blue ace-icon fa fa-street-view bigger-220\"></i>
												Domicilio
											</a>
										</li>


										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-4\">
												<i class=\"blue ace-icon fa fa-paperclip bigger-220\"></i>
												Documentos
											</a>
										</li>

										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-5\">
												<i class=\"blue ace-icon fa fa-credit-card bigger-220\"></i>
												Clave Pago
											</a>
										</li>



										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-6\">
												<i class=\"green ace-icon fa fa-th-list bigger-220\"></i>
												Percepciones
											</a>
										</li>


										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-7\">
												<i class=\"orange ace-icon fa fa-th-list bigger-220\"></i>
												Deducciones
											</a>
										</li>


									</ul>



									<div class=\"tab-content no-border padding-24\">


										<div id=\"faq-tab-1\" class=\"tab-pane fade in active\">
											<h4 class=\"blue\">
												<i class=\"ace-icon fa fa-check bigger-110\"></i>
												Datos Personales del Servidor Público
											</h4>

$Personales


											<div class=\"space-8\"></div>

											<div id=\"faq-list-1\" class=\"panel-group accordion-style1 accordion-style2\">

												<div class=\"panel panel-default\">

												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>







										<div id=\"faq-tab-2\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"blue  ace-icon fa fa-at bigger-110\"></i>
												Información de Contácto
											</h4>
<div class=\"space-8\"></div>

$Contacto


											<div class=\"space-8\"></div>

											<div id=\"faq-list-2\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>





										<div id=\"faq-tab-3\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"blue ace-icon fa fa-street-view bigger-110\"></i>
												Datos de Domicilio
											</h4>
$Domicilio


											<div class=\"space-8\"></div>

											<div id=\"faq-list-3\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>
										<div id=\"faq-tab-4\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"blue ace-icon fa fa-paperclip bigger-110\"></i>
												Documentos del Servidor Público
											</h4>
$Documentos

											<div class=\"space-8\"></div>

											<div id=\"faq-list-4\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
													
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>
<!-- fin propuesto-->
							


										<div id=\"faq-tab-5\" class=\"tab-pane fade\">
						<div id=\"faq-tab-5\" class=\"tab-pane fade active in\">
											<h4 class=\"blue\">
												<i class=\"purple ace-icon fa fa-magic bigger-110\"></i>
												Clave de Pago
											</h4>

<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-2 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>				
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>		
		<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>										
								<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>

					<span class=\"\">

											
<i class=\"ace-icon fa fa-credit-card    big-icon\"></i>

					</span>




				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-10\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

						<span class=\"label label-purple arrowed-in-right\">
							<i class=\"ace-icon fa fa-circle smaller-80 align-middle\"></i>
							CF41075 - Coordinador Paramedico en Area Normativa A
						</span>
					</h4>

					<div class=\"profile-user-info\">

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> ProgSubprog
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>				
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card\"></i>
												</span>
												<input type=\"text\" value=\"E010\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Función\" required=\"\" autofocus=\"\">
											</div>						
												</div>
												
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Unidad
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<span class=\"lbl\">
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card\"></i>
												</span>
												<input type=\"text\" value=\"610\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Sunfunción\" required=\"\" autofocus=\"\">
											</div>
													




													</span>
												</div>
												
											</div>



						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Partida
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
												<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card\"></i>
												</span>
												<input type=\"text\" value=\"1204\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Grupo\" required=\"\" autofocus=\"\">
											</div>
													<span>
					


					


													</span>	
												</div>
												
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Puesto
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					


				
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card\"></i>
												</span>
												<input type=\"text\" value=\"M04001\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"All\" required=\"\" autofocus=\"\">
											</div>

													</span>

													




													
												</div>
												
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Proyecto Programa
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					


					
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card\"></i>
												</span>
												<input type=\"text\" value=\"2\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"PP\" required=\"\" autofocus=\"\">
											</div>

													</span>

													




													
												</div>
											
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Grupo Funcional
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

					
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card \"></i>
												</span>
												<input type=\"text\" value=\"2\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"UR\" required=\"\" autofocus=\"\">
											</div>

													</span>
</span>
													




													
												</div>
												
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Función
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

					
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card \"></i>
												</span>
												<input type=\"text\" value=\"3\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"UR\" required=\"\" autofocus=\"\">
											</div>

													</span>
</span>
													




													
												</div>
												
											</div>											
														<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Subfunción
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

					
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card \"></i>
												</span>
												<input type=\"text\" value=\"03\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"UR\" required=\"\" autofocus=\"\">
											</div>

													</span>
</span>
													




													
												</div>
												
											</div>	
															<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Num Puesto
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

					
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card \"></i>
												</span>
												<input type=\"text\" value=\"5528 \" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"UR\" required=\"\" autofocus=\"\">
											</div>

													</span>
</span>
													




													
												</div>
												
											</div>
											<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Clave De Pago
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

					
<div class=\"input-group\">
												<span class=\"input-group-addon\">
													<i class=\" blue fa fa-credit-card \"></i>
												</span>
												<input type=\"text\" value=\"E0106101204M040010901923035528  \" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"UR\" required=\"\" autofocus=\"\">
											</div>

													</span>
</span>
													




													
												</div>
												
											</div>											
											

					</div>

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>



											<div class=\"space-8\"></div>

											<div id=\"faq-list-5\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>
										</div>
<!-- fin 5 propuesto-->






										<div id=\"faq-tab-6\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"purple ace-icon fa fa-magic bigger-110\"></i>
												Conceptos de Percepción
											</h4>

											<div class=\"space-8\"></div>

											<div id=\"faq-list-6\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-6-1\" data-parent=\"#faq-list-6\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus\" data-icon-hide=\"ace-icon fa fa-minus\" data-icon-show=\"ace-icon fa fa-hand-o-right\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">
															Concepto 1-07-00
															</span>
														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-6-1\">
														<div class=\"panel-body\">
															$ 20,000.00 SUELDOS BASE

														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-6-2\" data-parent=\"#faq-list-6\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus bigger-120\" 
															data-icon-hide=\"ace-icon fa-minus\" data-icon-show=\"ace-icon fa fa-frown-o\"></i>
<span class=\"label label-info arrowed-in-right arrowed\">
															Concepto 1-06-CG
															</span>
														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-6-2\">
														<div class=\"panel-body\">
															$ 40,000.00  COMPENSACION GARANTIZADA 

														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">

														<a href=\"#faq-6-3\" data-parent=\"#faq-list-6\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed \">
															<i class=\"ace-icon fa fa-plus smaller-80\" 
															data-icon-hide=\"ace-icon fa fa-minus\" data-icon-show=\"ace-icon fa fa-plus\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">
															Concepto 1-38-00
															</span>
														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-6-3\">
														<div class=\"panel-body\">
$ 2,000.00  AYUDA DE DESPENSA

														</div>
													</div>
												</div>


											</div>
										</div>
<!-- fin 6 propuesto-->








										<div id=\"faq-tab-7\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"purple ace-icon fa fa-magic bigger-110\"></i>
												Conceptos de Deducción
											</h4>

											<div class=\"space-8\"></div>

											<div id=\"faq-list-7\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-1\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus\" data-icon-hide=\"ace-icon fa fa-hand-o-down\" data-icon-show=\"ace-icon fa fa-hand-o-right\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">
															Concepto 2-01-00
															</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-1\">
														<div class=\"panel-body\">
IMPUESTO SOBRE LA RENTA


														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-2\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus bigger-120\" data-icon-hide=\"ace-icon fa fa-smile-o\" data-icon-show=\"ace-icon fa fa-frown-o\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\"> Concepto 2-02-SI</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-2\">
														<div class=\"panel-body\">
SEGURO DE INVALIDEZ Y VIDA, ISSSTE


														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-3\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus smaller-80\" data-icon-hide=\"ace-icon fa fa-minus\" data-icon-show=\"ace-icon fa fa-plus\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">Concepto 2-02-SR</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-3\">
														<div class=\"panel-body\">

SEGURO DE RETIRO, CESANTÍA EN EDAD AVANZADA Y VEJEZ, ISSSTE



														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-4\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus smaller-80\" data-icon-hide=\"ace-icon fa fa-minus\" data-icon-show=\"ace-icon fa fa-plus\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">Concepto 2-02-SS</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-4\">
														<div class=\"panel-body\">
SERVICIOS SOCIALES Y CULTURALES, ISSSTE


														</div>
													</div>
												</div>
											</div>
										</div>
<!-- fin 7 propuesto-->




									</div>
						





<!-- fin formulario -->












									<div class=\"ibox-content\">
										<div class=\"board\">
											<div class=\"board-inner\">
												<div class=\"tabs-left\"></div>
											</div>



										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					



<script src=\"../js/bootstrapValidator.min.js\"></script>

 <!-- iCheck -->
    <script src=\"../js/plugins/iCheck/icheck.min.js\"></script>
	
<script>
$(document).ready(function () {

                $('#FormUser').bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        txt_nombre: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_app_p: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_app_m: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_foto: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_cargo: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_email: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9.-_\s]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_psw: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                
                                different: {
                                    field: 'txt_email',
                                    message: 'La contraseña no puede ser la misma que el correo'
                                }
                            }
                        },
                        txt_conf_psw: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                identical: {
                                    field: 'txt_psw',
                                    message: 'La contraseña y su confirmación no coinciden'
                                },
                                different: {
                                    field: 'txt_email',
                                    message: 'La contraseña no puede ser lo mismo que el correo'
                                }
                            }
                        },
                        txt_organismos: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_uni_respon: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_pregunta_seguridad: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_licencia: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: 'Error en Número de Licencia '
                                }
                            }
                        },
                        txt_respuesta: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        }
                    }
                });

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
           

  });
</script>
 <!--<link href=\"http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css\" rel=\"stylesheet\">-->
<link href=\"../css/fileinput.min.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\" />
<!---<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>-->
<script src=\"../js/fileinput.min.js\" type=\"text/javascript\"></script>
<!-- <link href=\"../css/boopstrap.min.css\" media=\"all\" rel=\"stylesheet\" type=\"text/css\"/>-->




";




	
}// fin de creaTabuladores




function capturaPersonalesIncidencias(){

return "

<!--
<div id=\"home\" class=\"tab-pane active\">
-->
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-3 center\">
				<div class=\"space space-4\"></div>
				
					<span class=\"profile-picture\">
<img class=\"editable img-responsive\" style=\"width: 200px;border-radius: 50%;\" alt=\"Servidor Público\" id=\"avatar2\" src=\"../css/assets/images/avatars/profile-pic.jpg\">
					</span>

					<div class=\"space space-4\"></div>


				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-9\">



							   <div class=\"bs-example tabs-container with-nav-tabs panel-success\">									
									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Unidad Responsable:</label>
										<div class=\"col-xs-3 control-label-txtEstado\">
											<input type=\"text\" id=\"txtEstado\" name=\"txtEstado\" class=\"form-control txtEstado text-uppercase\" disabled>
										</div>
										<label class=\"control-label col-xs-3\">Unidad Responsable:</label>
										<div class=\"col-xs-4\">
											
											<input type=\"text\" id=\"txtUrDesc\" name=\"txtUrDesc\" class=\"form-control txtUrDesc text-uppercase\" disabled>

										</div>
									</div>								

									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">CURP:</label>
										<div class=\"col-xs-3 control-label-txtCURP\">
											<input type=\"text\" id=\"txtCURP\" name=\"txtCURP\" class=\"form-control txtCURP text-uppercase\" disabled >
										</div>
										<label class=\"control-label col-xs-3\">RFC</label>
										<div class=\"col-xs-4 control-label-txtRFC\">
											<input type=\"text\" id=\"txtRFC\" name=\"txtRFC\" class=\"form-control txtRFC text-uppercase\" pattern=\"[A-Z]\" disabled >
										</div>
									</div>


									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Nombre:</label>
										<div class=\"col-xs-3 control-label-txtNombre\">
											<input type=\"text\" id=\"txtNombre\" name=\"txtNombre\" class=\"form-control txtNombre text-uppercase\" disabled >
										</div>
										<label class=\"control-label col-xs-3\">Rama:</label>
										<div class=\"col-xs-4 control-label-txtRama\">
											<input type=\"text\" id=\"txtRama\" name=\"txtRama\" class=\"form-control txtRama text-uppercase\" pattern=\"[A-Z]\" disabled >
										</div>
									</div>




									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Codigo de Puesto:</label>
										<div class=\"col-xs-3 control-label-txtCoP\">
											<input type=\"text\" id=\"txtCoP\" name=\"txtCoP\" class=\"form-control txtCoP text-uppercase\" disabled>
										</div>
										<label class=\"control-label col-xs-3\">Descripcion:</label>
										<div class=\"col-xs-4 control-label-txtDescrip\">
											<input type=\"text\" id=\"txtDescrip\" name=\"txtDescrip\" class=\"form-control txtDescrip text-uppercase\" pattern=\"[A-Z]\" disabled>
										</div>
									</div>




									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Movimiento:</label>
										<div class=\"col-xs-3 control-label-txtCoP\">

										<select class=\"form-control\" id=\"listaMovimientos\">
										    <option values=2201 >2201-Licencia o prorroga sin goce de sueldo por asuntos particulares</option>
										    <option>8001-Descuento por faltas injustificadas</option>
										    <option>8002-Suspensión por sanción disciplinaria</option>
										    <option>9201-Prima dominical</option>
										    <option>9204-Pago estimulo trimestral</option>
										    <option>9205-Pago de estímulo anua</option>
										    <option>9207-Asistencia perfecta</option>
										    <option>9303-Pago de tesis</option>
										  </select>



										</div>
										<label class=\"control-label col-xs-3\">Numero:</label>
										<div class=\"col-xs-4 control-label-txtDescrip\">
											<input type=\"text\" id=\"txtOcurrencias\" name=\"txtOcurrencias\" class=\"form-control txtOcurrencias text-uppercase\" pattern=\"[0-9]\" >
										</div>
									</div>



									<div class=\"form-group form-group-sm\">
								


				</div><!-- /.col -->
<!--

			</div> 

			<div class=\"space-20\"></div>

		</div>
-->		
";

}// fin de capturaPersonales


?>

<?php


echo "
          
<div class=\"wrapper wrapper-content animated fadeInRight\" id=\"main_page_2\" style=\"
    padding-top: 0px;\">
						<div class=\"row\">
							<div class=\"col-lg-10 col-md-offset-1\">
								<div class=\"ibox float-e-margins\">
									<div class=\"ibox-title\">
										<h3>4002 - Alta A Personal De Confianza </h3>
									</div>
									<div class=\"ibox-content\">
										<div class=\"board\">
											<div class=\"board-inner\">
												<div class=\"tabs-left\"></div>
												<ul class=\"nav nav-tabs\" id=\"myTab\" role=\"tablist\">
													<li class=\"active personal\">
														<a href=\"#personal\" data-toggle=\"tab\" aria-controls=\"personal\" role=\"tab\" title=\"Datos Personales\">
															<span class=\"round-tabs one\">
															<i class=\"fa fa-user fa-2x\"></i>
															</span> 
														</a>
													</li>
													<li class=\"contacto\">
														<a href=\"#contacto\" data-toggle=\"tab\" aria-controls=\"contacto\" role=\"tab\" title=\"Datos Presupuestales\">
															<span class=\"round-tabs two\">
															<i class=\"fa fa-usd fa-2x\"></i>
															</span> 
														</a>
													</li>
													<li class=\"organismo\" >
														<a href=\"#organismo\" data-toggle=\"tab\" aria-controls=\"organismo\" role=\"tab\" title=\"Clave Presupuestal\">
															<span class=\"round-tabs three\">
															<i class=\"fa fa-usd fa-2x\"></i>
															</span> 
														</a>
													</li>

													<li class=\"organismo\" >
														<a href=\"#percepciones\" data-toggle=\"tab\" aria-controls=\"organismo\" role=\"tab\" title=\"Percepciones\">
															<span class=\"round-tabs three\">
															<i class=\"fa fa-th-list fa-2x\"> </i>
															</span> 
														</a>
													</li>


													<li class=\"organismo\" >
														<a href=\"#percepciones\" data-toggle=\"tab\" aria-controls=\"organismo\" role=\"tab\" title=\"Justificación\">
															<span class=\"round-tabs three\">
															<i class=\"fa fa-check-square fa-2x\"> </i>
															</span> 
														</a>
													</li>


													<li class=\"organismo\" >
														<a href=\"#percepciones\" data-toggle=\"tab\" aria-controls=\"organismo\" role=\"tab\" title=\"Datos Generales\">
															<span class=\"round-tabs three\">
															<i class=\"fa fa-database fa-2x\"> </i>
															</span> 
														</a>
													</li>


													<li class=\"organismo\" >
														<a href=\"#percepciones\" data-toggle=\"tab\" aria-controls=\"organismo\" role=\"tab\" title=\"Documentos\">
															<span class=\"round-tabs three\">
															<i class=\"fa fa-file-pdf-o fa-2x\"> </i>
															</span> 
														</a>
													</li>






												</ul>
											</div>
											<form role=\"form\" id=\"FormUser\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
												<div class=\"tab-content\">
													<div class=\"tab-pane fade in active\" role=\"tabpanel\" id=\"personal\">
														<h3 class=\"head text-center\"></h3><br>
														<p class=\"text-danger pull-left\">(*) Campos obligatorios.</p><br><br>
														<div class=\"col-sm-5 col-sm-offset-1 b-r animated fadeInUp\" data-wow-duration=\"1000ms\" data-wow-delay=\"600ms\">
															<div class=\"form-group\" id=\"1\"><label>* Nombre: </label> <input type=\"text\" placeholder=\"Pedro\" name=\"txt_nombre\" id=\"txt_nombre\" class=\"form-control text-capitalize\" required autofocus></div>
															<div class=\"form-group\" id=\"2\"><label>* Primer Apellido : </label> <input type=\"text\" placeholder=\"Perez\" name=\"txt_app_p\" id=\"txt_app_p\" class=\"form-control text-capitalize\" required></div>
															<div class=\"form-group\" id=\"3\"><label>* Segundo Apellido :</label> <input type=\"text\" placeholder=\"Perez\" name=\"txt_app_m\" id=\"txt_app_m\" class=\"form-control text-capitalize\" required></div>
															<div class=\"form-group\"><label>* Sexo: </label><div class=\"i-checks\"><label><input type=\"radio\" name=\"sexo\" value=\"Masculino\" class=\"form-control\" checked> <i></i> Masculino </label>&nbsp; &nbsp; <label><input type=\"radio\" name=\"sexo\" value=\"Femenino\" class=\"form-control\"> <i></i> Femenino</label></div></div>
															<div class=\"form-group\" id=\"data_1\">
																<label >Fecha de Nacimiento:</label>
																<div class=\"input-group date\">
																	<span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span><input type=\"text\" class=\"form-control\" name=\"txt_fech_nac\" onchange=\"edad(this.value)\" placeholder=\"2000/08/16\" value=\"2000/08/16\" >
																</div>
															</div>
															<div class=\"form-group\"><label>Edad: </label> <input type=\"text\" name=\"txt_edad\" id=\"txt_edad\" class=\"form-control\" value=\"16\" readonly></div>
														</div>
														<div class=\"col-sm-5 animated fadeInUp\" data-wow-duration=\"1000ms\" data-wow-delay=\"600ms\">
															<div id=\"image-holder\" style=\"width:180px;height:130px\">
																<img src=\"../images/Captura1.PNG\" width=\"180px\" height=\"130px\" class=\"img-rounded\">
															</div>
																<div class=\"btn-group\" style=\"top:2px;\">
																	<label title=\"Cargar Imágen\" for=\"txt_foto\" class=\"btn btn-primary\">
																		<input type=\"file\" accept=\"image/png, image/jpeg, image/gif\" name=\"txt_foto\" id=\"txt_foto\" class=\"form-control img hide\" required/>
																		Cargar
																	</label></div>
																	<div class=\"form-group\" id=\"4\"><label>* Cargo: </label> <input type=\"text\" placeholder=\"\" name=\"txt_cargo\" id=\"txt_cargo\" class=\"form-control text-capitalize\" required autofocus></div>
																	<div class=\"form-group\" id=\"5\"><label> Tel&eacutefono de oficina:</label><input type=\"text\" name=\"txt_tel_ofi\" data-mask=\"(999) 999-9999\" placeholder=\"(###) ###-####\"></div> 
																	<div class=\"form-group\" id=\"6\"><label> Extens&iacuteon:</label><input type=\"text\" name=\"txt_ext\" data-mask=\"99999\" placeholder=\"#####\"></div> 
																	<div class=\"form-group\" id=\"7\"><label> Otro Tel&eacutefono de Contacto:</label><input type=\"text\" name=\"txt_tel_per\" class=\"form-control\" data-mask=\"(999) 999-9999\" placeholder=\"(###) ###-####\"></div>
																
															<div style=\"margin-top:80px;\" class=\"text-center\">
																<ul class=\"list-inline pull-right\">
																	<li><button class=\"btn btn-primary next-step\" id=\"primero\" type=\"submit\"><span class=\"bold\">Siguiente</span>&nbsp;&nbsp;<i class=\"glyphicon glyphicon-chevron-right\"></i><i class=\"glyphicon glyphicon-chevron-right\"></i></button></li>
																</ul>
															</div>
														</div>
													</div>
													<div class=\"tab-pane fade\"  role=\"tabpanel\" id=\"contacto\">
														<h3 class=\"head text-center\"></h3><br>
														<p class=\"text-danger pull-left\">(*) Campos obligatorios.</p><br><br>
														<div class=\"col-sm-7 col-sm-offset-2 animated fadeInUp\" data-wow-duration=\"100ms\">
															<div class=\"form-group\" id=\"8\"><label>* Correo:</label><input type=\"email\" placeholder=\"ejemplo@ejemplo\" name=\"txt_email\" id=\"txt_email\" class=\"form-control\" required autofocus></div>
															<div class=\"form-group\" id=\"9\"><label>* Contrase&ntilde;a:</label> <input type=\"password\" placeholder=\"********\" name=\"txt_psw\" id=\"txt_psw\" class=\"form-control\" required></div>
															<div class=\"form-group\" id=\"10\"><label>* Confirmar Contrase&ntilde;a:</label> <input type=\"password\" placeholder=\"********\" name=\"txt_conf_psw\" id=\"txt_conf_psw\" class=\"form-control\" required></div>
															<div class=\"form-group\"><label>* Pregunta de Seguridad </label>
																<select name=\"txt_pregunta_seguridad\" class=\"select2_demo_3 form-control\" style=\"width:330px;\" required>
																	<option></option>";

 															echo" <option value=1> Valor </option> ";

																echo"</select>
															</div>
															<div class=\"form-group\"><label>* Respuesta </label> <input type=\"text\" placeholder=\"Escribe tu respuesta\" name=\"txt_respuesta\" class=\"form-control\" required></div>										
															<div style=\"margin-top:40px;\" class=\"text-center\">
																<ul class=\"list-inline text-center\">
																	<li><button class=\"btn btn-default prev-step\"  type=\"button\"><i class=\"glyphicon glyphicon-chevron-left\"></i><i class=\"glyphicon glyphicon-chevron-left\"></i>&nbsp;&nbsp;<span class=\"bold\">Anterior</span></button></li>
																	<li><button class=\"btn btn-primary next-step-contacto\"  type=\"submit\"><span class=\"bold\">Siguiente</span>&nbsp;&nbsp;<i class=\"glyphicon glyphicon-chevron-right\"></i><i class=\"glyphicon glyphicon-chevron-right\"></i></button></li>
																</ul>
															</div>
														</div>
													</div>
													<div class=\"tab-pane fade\" role=\"tabpanel\" id=\"organismo\">
														<h3 class=\"head text-center\"></h3><br>
														<p class=\"text-danger pull-left\">(*) Campos obligatorios.</p><br><br>
														<div class=\"col-sm-7 col-sm-offset-2 animated fadeInUp\" data-wow-duration=\"1000ms\" data-wow-delay=\"600ms\">
															<div class=\"form-group\" id=\"7\"><label>* Organismos P&uacuteblicos Descentralizados (Entidades Federativas):  </label>
																<select name=\"txt_organismos\" id=\"txt_organismos\" class=\"form-control select2_demo_3 paloma\" style=\"width:330px;\" required>
																	<option></option>";

																	 
																		   echo" <option value=1> Valor </option> ";
																	 

																echo"</select>
															</div>
															<div class=\"form-group\" id=\"8\"><label>* Licencia Secretar&iacutea Salud: </label>
<input type=\"text\" placeholder=\"Núemero de Licencia\" name=\"txt_licencia\" id=\"txt_licencia\" class=\"form-control\" required autofocus>

";


														echo"
															</div>
															
																	<div class=\"i-checks\"><label> <input type=\"checkbox\" name=\"txt_creden[]\" class=\"form-control \"  checked=\"checked\" value=\"10\"/> <i></i> + Producto de N&oacutemina </label></div>


																
															</div><br><br><br><br><br><br><br>
															<div style=\"margin-top:40px;\" class=\"text-center\">
																<ul class=\"list-inline text-center\">
																	<br><li><button class=\"btn btn-default prev-step\"  type=\"button\"><i class=\"glyphicon glyphicon-chevron-left\"><i class=\"glyphicon glyphicon-chevron-left\"></i></i>&nbsp;&nbsp;<span class=\"bold\">Anterior</span></button></li>
																	<li><button class=\"btn btn-primary next-step-final\" name=\"submitConfirmarAlta\" id=\"submitConfirmarAlta\" value=\"confirmar\" type=\"submit\"><i class=\"glyphicon glyphicon-floppy-disk\"></i>&nbsp;&nbsp;<span class=\"bold\">Guardar</span></button></li>
																</ul>
															</div>
														</div>
													</div>
													<div class=\"clearfix\"></div>
												</div>
											</form>
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

";


?>
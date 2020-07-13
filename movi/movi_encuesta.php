<?php


$ID="XXX";
if(isset($_POST['Id']))
	$ID=$_POST['Id'];

$Fecha="XXX";
if(isset($_POST['Fecha']))
	$Fecha=$_POST['Fecha'];


echo "
    <div class=\"row\" style=\"  padding-left: 0px;\">






                <div class=\"col-lg-12\" style=\"  padding-left: 0px;\>
                    <div class=\" ibox\"=\"\">



     <div class=\"row\">
                    <div class=\"col-lg-3\">
                        <div class=\"ibox float-e-margins\">
                            <div class=\"ibox-title\">
                                <span class=\"label label-success pull-right\">Bajo</span>
                                <h5> CONDICIONES AMBIENTALES</h5>
                            </div>
                            <div class=\"ibox-content\">
                                <h1 class=\"no-margins\">0</h1>
                                <div class=\"stat-percent font-bold text-success\">90% <i class=\"fa fa-bolt\"></i></div>
                                <small>Total Evaluado</small>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-lg-3\">
                        <div class=\"ibox float-e-margins\">
                            <div class=\"ibox-title\">
                                <span class=\"label label-info pull-right\">Annual</span>
                                <h5>RITMO DE TRABAJO</h5>
                            </div>
                            <div class=\"ibox-content\">
                                <h1 class=\"no-margins\">0</h1>
                                <div class=\"stat-percent font-bold text-info\">20% <i class=\"fa fa-level-up\"></i></div>
                                <small>New orders</small>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-lg-3\">
                        <div class=\"ibox float-e-margins\">
                            <div class=\"ibox-title\">
                                <span class=\"label label-primary pull-right\">Today</span>
                                <h5> ESFUERZO MENTAL</h5>
                            </div>
                            <div class=\"ibox-content\">
                                <h1 class=\"no-margins\">0</h1>
                                <div class=\"stat-percent font-bold text-navy\">44% <i class=\"fa fa-level-up\"></i></div>
                                <small>New visits</small>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-lg-3\">
                        <div class=\"ibox float-e-margins\">
                            <div class=\"ibox-title\">
                                <span class=\"label label-danger pull-right\">Low value</span>
                                <h5>RESPONSABILIDADES</h5>
                            </div>
                            <div class=\"ibox-content\">
                                <h1 class=\"no-margins\">0</h1>
                                <div class=\"stat-percent font-bold text-danger\">38% <i class=\"fa fa-level-down\"></i></div>
                                <small>In first month</small>
                            </div>
                        </div>
                   </div>

				   
        </div>
		
		
		
		


<!--					
                        <div class=\"ibox-title\">
                        <h5>#  &nbsp;&nbsp;&nbsp; </h5>
                            <h5>@</h5>
                            <div class=\"ibox-tools\">
                                <a href=\"\" class=\"btn btn-primary btn-xs\">15-jun-2020</a>
                            </div>
                        </div>

						
                        <div class=\"ibox-content\">

                            <div class=\"m-b-lg\">
                                <div class=\"input-group\">
                                    <input type=\"text\" placeholder=\"Teclee nombre ...\" 
                                    class=\" form-control\">

                                    <span class=\"input-group-btn\">
                                        <button type=\"button\" class=\"btn btn-white\">
                            <i class=\"fa  fa-search pull-left\"></i>
                                        Buscar</button>

                                   </span>
                                </div>
								
                                <div class=\"m-t-md\">


                                    <strong> 61 Movimientos</strong>



                                </div>
-->

                            </div>



    <div id=\"user-profile-2\" class=\"user-profile\">
        <div class=\"tabbable\">
            <ul class=\"nav nav-tabs padding-18\">
                <li class=\"active\">
                    <a data-toggle=\"tab\" href=\"#home\">
                        <i class=\"green ace-icon fa fa-user bigger-200\"></i>
                        $ID
                    </a>
                </li>

<!--
                <li>
                    <a data-toggle=\"tab\" href=\"#feed\">
                        <i class=\"green ace-icon fa fa-check bigger-220\"></i>
                        Encuesta de Salida
                    </a>
                </li>

                <li>
                    <a data-toggle=\"tab\" href=\"#friends\">
                        <i class=\"blue  fa fa-clock-o bigger-200\"></i>
                        Capacitación
                    </a>
                </li>

                <li>
                    <a data-toggle=\"tab\" href=\"#pictures\">
                        <i class=\"orange ace-icon fa fa-exclamation-triangle bigger-200\"></i>
                        Rechazados
                    </a>
                </li>
	-->			
            </ul>

            <div class=\"tab-content no-border padding-24\">




                <div id=\"home\" class=\"tab-pane in active\">

                        



                            <div class=\"table-responsive\" id=\"tabla-movimietnos\">
                            <table class=\"table table-hover issue-tracker\">
                                <tbody>

                                <tr>
								<td>
									
									<input id=\"checkbox3\" type=\"checkbox\">
									<label for=\"checkbox3\" style=\" margin-left: 10px;\" >
									<img alt=\"image\" class=\"img-circle\" src=\"../images/jenny.jpg\" style=\"  width: 75px;\">
									</label>
								
								</td>

                                    <td class=\"issue-info\">
									<h2>
                                        <a href=\"#\" id=\"href-rfc1\">
                                            Jenny Lara Guerra
                                        </a>
									</h2>	
                                        <small>
                                           SOPORTE ADMINISTRATIVO C/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>

                                    <td>
                                        Juan Lopez Arellano
                                    </td>
                                    <td>
                                        12.02.2020 10:00 am
                                    </td>

                                    <td>
                                       
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" id=\"ival\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-paper-plane fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>

									<input id=\"checkbox3\" type=\"checkbox\">
									<label for=\"checkbox3\" style=\" margin-left: 10px;\" >
									<img alt=\"image\" class=\"img-circle\" src=\"../images/johana.jpg\" style=\"  width: 75px;\">
									</label>

                                    </td>
                                    <td class=\"issue-info\">
									<h2>
                                        <a href=\"#\" id=\"href-rfc2\">
                                            Johana Garcia Mendoza
                                        </a>
									</h2>
                                        <small>
                                           APOYO ADMINISTRATIVO EN SALUD A8/ DIRECCION GENERAL DE COMUNICACION SOCIAL
                                        </small>
                                    </td>
                                    <td>
                                        Anna Mendoza Ramirez
                                    </td>
                                    <td>
                                        10.02.2020 05:32 am
                                    </td>

                                    <td>
                                
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" id=\"ival2\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-paper-plane fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
									
									<input id=\"checkbox3\" type=\"checkbox\">
									<label for=\"checkbox3\" style=\" margin-left: 10px;\" >
									<img alt=\"image\" class=\"img-circle\" src=\"../images/eric.jpg\" style=\"  width: 75px;\">
									</label>

									
                                    </td>
                                    <td class=\"issue-info\">
									<h2>
                                        <a href=\"#\" id=\"href-rfc3\">
                                           Eric Mendoza Ramirez
                                        </a>
									</h2>
                                        <small>
                                             DEPARTAMENTO PARA LA ATENCION PREHOSPITALARIA DE LOS ACCIDENTES/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>
                                    <td>
                                        Carlos Eduardo Avila Vilchiz
                                    </td>
                                    <td>
                                        02.03.2020 06:02 am
                                    </td>
                                    <td>
                          
                                    </td>
                                    <td class=\"text-right\">

                                       <a href=\"#\" id=\"ival2\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-paper-plane fa-2x\"></i>  </a>

                                    </td>

                                </tr>




                                <tr>
                                    <td>

									<input id=\"checkbox3\" type=\"checkbox\">
									<label for=\"checkbox3\" style=\" margin-left: 10px;\" >
									<img alt=\"image\" class=\"img-circle\" src=\"../images/nancy.jpg\" style=\"  width: 75px;\">
									</label>

									
                                    </td>
                                    <td class=\"issue-info\">
									<h2>
                                        <a href=\"#\">
                                          Nancy Ruiz Samaniego
                                        </a>
									</h2>	

                                        <small>
                                            SOPORTE ADMINISTRATIVO A/ CENTRO NACIONAL PARA LA PREVENCION DE ACCIDENTES
                                        </small>
                                    </td>
                                    <td>
                                        Alejandro Hernández López
                                    </td>
                                    <td>
                                        28.11.2020 05:10 pm
                                    </td>


                                    <td>
                                       
                                    </td>
                                    <td class=\"text-right\">

                                      <a href=\"#\" id=\"ival2\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-paper-plane fa-2x\"></i>  </a>

                                    </td>


                                </tr>
								
                                <tr>
                                    <td>

									<input id=\"checkbox3\" type=\"checkbox\">
									<label for=\"checkbox3\" style=\" margin-left: 10px;\" >
									<img alt=\"image\" class=\"img-circle\" src=\"../images/santiago.jpg\" style=\"  width: 75px;\">
									</label>

                                    </td>
                                    <td class=\"issue-info\">
									<h2>
                                        <a href=\"#\">
                                          Santiago Molina Monroy  
                                        </a>
									</h2>
                                        <small>
                                            DEPARTAMENTO DE LEGISLACION/ COMISION NACIONAL CONTRA LAS ADICCIONES
                                        </small>
                                    </td>
                                    <td>
                                        Marco Antonio Garcia Zepeda
                                    </td>
                                    <td>
                                        18.09.2020 06:20 pm
                                    </td>

                                    <td>
                                       
                                    </td>
                                    <td class=\"text-right\">

                                  <a href=\"#\" id=\"ival2\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-paper-plane fa-2x\"></i>  </a>

                                    </td>

                                </tr>
								
                                </tbody>
                            </table>

                            </div> 



                    <div class=\"space-20\"></div>

                    <div class=\"row\">

                    </div>
                </div><!-- /#home -->

                <div id=\"feed\" class=\"tab-pane\">
                    <div class=\"profile-feed row\">
                        
                            <div class=\"table-responsive\" id=\"tabla-movimietnos\">
                            <table class=\"table table-hover issue-tracker\">
                                <tbody>

                                <tr>

                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>

                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc1\">
                                            4001 - Alta A Personal De Base
                                        </a>

                                        <small>
                                           SOPORTE ADMINISTRATIVO C/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>

                                    <td>
                                        Juan Lopez Arellano
                                    </td>
                                    <td>
                                        12.02.2020 10:00 am
                                    </td>

                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc2\">
                                            4002 - Alta A Personal De Confianza
                                        </a>

                                        <small>
                                           APOYO ADMINISTRATIVO EN SALUD A8/ DIRECCION GENERAL DE COMUNICACION SOCIAL
                                        </small>
                                    </td>
                                    <td>
                                        Anna Mendoza Ramirez
                                    </td>
                                    <td>
                                        10.02.2020 05:32 am
                                    </td>

                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc3\">
                                           4003 - Alta A Personal Provisional
                                        </a>

                                        <small>
                                             DEPARTAMENTO PARA LA ATENCION PREHOSPITALARIA DE LOS ACCIDENTES/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>
                                    <td>
                                        Carlos Eduardo Avila Vilchiz
                                    </td>
                                    <td>
                                        02.03.2020 06:02 am
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>



                                
                                <tr>

                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>

                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc1\">
                                          4004 - Alta A Personal Interino 
                                        </a>

                                        <small>
                                             SOPORTE ADMINISTRATIVO C/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>

                                    <td>
                                        Juan Lopez Arellano
                                    </td>
                                    <td>
                                        12.02.2020 10:00 am
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc2\">
                                           4005 - Alta A Personal Eventual  
                                        </a>

                                        <small>
                                             APOYO ADMINISTRATIVO EN SALUD A8/ DIRECCION GENERAL DE COMUNICACION SOCIAL
                                        </small>
                                    </td>
                                    <td>
                                        Anna Mendoza Ramirez
                                    </td>
                                    <td>
                                        10.02.2020 05:32 am
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc3\">
                                           4006 - Alta A Contrato De Honorarios 
                                        </a>

                                        <small>
                                            DEPARTAMENTO PARA LA ATENCION PREHOSPITALARIA DE LOS ACCIDENTES/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>
                                    <td>
                                        Carlos Eduardo Avila Vilchiz
                                    </td>
                                    <td>
                                        02.03.2020 06:02 am
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>




                                <tr>
                                    <td>
                                        <span class=\"label label-success arrowed\" style=\"font-size:15px\">Aprobado</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\" id=\"href-rfc4\">
                                           4008 - Alta A Personal De Recursos Humanos En Formación
                                        </a>

                                        <small>
                                             COORDINACION ADMINISTRATIVA/ COMISION COORDINADORA DE LOS INSTITUTOS NACIONALES DE SALUD Y HOSPITALES DE ALTA ESPECIALIDAD
                                        </small>
                                    </td>
                                    <td>
                                        Monica Contreras Romero
                                    </td>
                                    <td>
                                        01.10.2020 11:02 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline  btn-success\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>


                                </tr>



                                </tbody>
                            </table>

                            </div>
                            


                    </div><!-- /.row -->

                
                </div><!-- /#feed -->

    <div id=\"friends\" class=\"tab-pane\">




 <div class=\"table-responsive\" id=\"tabla-movimietnos\">
                            <table class=\"table table-hover issue-tracker\">
                                <tbody>

                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                          5602 - Alta En Sistema Por Promoción O Descenso     
                                        </a>

                                        <small>
                                            SOPORTE ADMINISTRATIVO A/ CENTRO NACIONAL PARA LA PREVENCION DE ACCIDENTES
                                        </small>
                                    </td>
                                    <td>
                                        Alejandro Hernández López
                                    </td>
                                    <td>
                                        28.11.2020 05:10 pm
                                    </td>


                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" id=\"ipen\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>


                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                          5604 - Alta En Sistema Por Promoción O Descenso Escalafonario  
                                        </a>

                                        <small>
                                            DEPARTAMENTO DE LEGISLACION/ COMISION NACIONAL CONTRA LAS ADICCIONES
                                        </small>
                                    </td>
                                    <td>
                                        Marco Antonio Garcia Zepeda
                                    </td>
                                    <td>
                                        18.09.2020 06:20 pm
                                    </td>

                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                            4001 - Alta A Personal De Base  
                                        </a>

                                        <small>
                                            CITOTECNOLOGO B/ COMISION COORDINADORA DE LOS INSTITUTOS NACIONALES DE SALUD Y HOSPITALES DE ALTA ESPECIALIDAD
                                        </small>
                                    </td>
                                    <td>
                                        Carolina Segundo Apolina
                                    </td>
                                    <td>
                                        11.03.2020 07:30 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                           4002 - Alta A Personal De Confianza 
                                        </a>

                                        <small>
                                            SOPORTE ADMINISTRATIVO A/ CENTRO NACIONAL PARA LA PREVENCION DE ACCIDENTES
                                        </small>
                                    </td>
                                    <td>
                                        Alejandro Hernández López
                                    </td>
                                    <td>
                                        28.11.2020 05:10 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                           4003 - Alta A Personal Provisional   
                                        </a>

                                        <small>
                                             DEPARTAMENTO DE LEGISLACION/ COMISION NACIONAL CONTRA LAS ADICCIONES
                                        </small>
                                    </td>
                                    <td>
                                        Marco Antonio Garcia Zepeda
                                    </td>
                                    <td>
                                        18.09.2020 06:20 pm
                                    </td>

                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                           4004 - Alta A Personal Interino
                                        </a>

                                        <small>
                                             CITOTECNOLOGO B/ COMISION COORDINADORA DE LOS INSTITUTOS NACIONALES DE SALUD Y HOSPITALES DE ALTA ESPECIALIDAD
                                        </small>
                                    </td>
                                    <td>
                                        Carolina Segundo Apolina
                                    </td>
                                    <td>
                                        11.03.2020 07:30 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>


                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                           4008 - Alta A Personal De Recursos Humanos En Formación
                                        </a>

                                        <small>
                                             DIRECCION DE DERECHOS HUMANOS E INVESTIGACION NORMATIVA EN SALUD/ DIRECCION GENERAL. DE PROGRAMACION, ORGANIZACION Y PRESUPUESTO
                                        </small>
                                    </td>
                                    <td>
                                        Carmen Cruz Hernandez
                                    </td>
                                    <td>
                                        05.04.2020 08:40 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                        4006 - Alta A Contrato De Honorarios
                                            
                                        </a>

                                        <small>
                                            DEPARTAMENTO DE APOYO A LA INVESTIGACION/ COORDINACION GENERAL DE ASUNTOS JURIDICOS Y DERECHOS HUMANOS
                                        </small>
                                    </td>
                                    <td>
                                        Monica Mendoza Sanchez
                                    </td>
                                    <td>
                                        10.06.2014 08:10 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>

                                </tr>


                                <tr>
                                    <td>
                                        <span class=\"label label-warning\">Pendiente</span>
                                    </td>
                                    <td class=\"issue-info\">
                                        <a href=\"#\">
                                           4001 - Alta A Personal De Base   
                                        </a>

                                        <small>
                                             SOPORTE ADMINISTRATIVO C/ COORDINACION GENERAL DE ASUNTOS JURIDICOS Y DERECHOS HUMANOS
                                        </small>
                                    </td>
                                    <td>
                                        Anna Paola Romero Maldonado
                                    </td>
                                    <td>
                                        13.05.2014 09:20 pm
                                    </td>
                                    <td>
                                       
                                       <a href=\"#\" class=\"disabled btn btn-app btn-outline  btn-default\">
                                       <i class=\"fa fa-print fa-2x\"></i>  </a>
                                    </td>
                                    <td class=\"text-right\">

                                        <a href=\"#\" class=\"btn btn-app btn-outline btn-warning\">
                                       <i class=\"fa fa-info-circle fa-2x\"></i>  </a>

                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            </div>


                    <div class=\"profile-users clearfix\">
                        <div class=\"itemdiv memberdiv\">
                            

                        </div>




                    </div>



                </div><!-- /#friends -->







                        </div>

                    </div>
                </div>
            


                        </div>
						

";


?>
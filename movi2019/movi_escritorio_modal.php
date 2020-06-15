<?php

function creaCategoriaModal(){
	global $TipoMov;
$Modal="";
switch ($TipoMov){

    case "mp": $Modal ="<div class=\"modal inmodal\" id=\"myModal45\" tabindex=\"-1\" role=\"dialog\"  aria-hidden=\"true\">
		                                <div class=\"modal-dialog\">

		                                    <div class=\"modal-content animated fadeIn\">
		                                        <div class=\"modal-header\">
		                                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
		                                            <i class=\"fa fa-user-plus modal-icon\"></i>
		                                            <h4 class=\"modal-title\"> Vacantes Disponibles</h4>
		                                            <small>513 DIRECCION GENERAL DE RECURSOS HUMANOS</small>
		                                        </div>




		                                        <div class=\"modal-body\" style=\"padding-top: 1px;\">
		<!-- Inicia modal Body -->





		                        <div class=\"ibox-content forum-container\">

		                            <div class=\"forum-title\">
		                                 <h3>Total Vacantes: 38</h3>
		                            </div>
		                            <div class=\"forum-item active\">
		                                <div class=\"row\">
		                                    <div class=\"col-md-9\">
		                                        <div class=\"forum-icon\">
		                                            <i class=\"fa fa-hospital-o\"></i>
		                                        </div>
		                                        <a id=\"vac-confianza\" href=\"#\" class=\"forum-item-title\">PERSONAL DE CONFIANZA</a>
		                                    </div>
		                                    <div class=\"col-md-2 forum-info\">
		                                        <div>
		                                         <span class=\"views-number\">
		                                            5
		                                        </span>
		                                            
		                                        </div>
		                                    </div>

		                                </div>
		                            </div>

		                            <div class=\"forum-item\">
		                                <div class=\"row\">
		                                    <div class=\"col-md-9\">
		                                        <div class=\"forum-icon\">
		                                            <i class=\"fa fa-user-md\"></i>
		                                        </div>
		                                        <a id=\"vac-base\"  href=\"#\" class=\"forum-item-title\">PERSONAL DE BASE</a>
		                                    </div>

		                                    <div class=\"col-md-2 forum-info\">
		                                        <div>
		                                         <span class=\"views-number\">
		                                            17

		                                        </span>
		                                            
		                                        </div>
		                                    </div>


		                                </div>
		                            </div>

		                            <div class=\"forum-item active\">
		                                <div class=\"row\">
		                                    <div class=\"col-md-9\">
		                                        <div class=\"forum-icon\">
		                                            <i class=\"fa fa-user-md\"></i>
		                                        </div>
		                                        <a id=\"vac-eventual\"  href=\"#\" class=\"forum-item-title\">PERSONAL EVENTUAL</a>
		                                    </div>

		                                    <div class=\"col-md-2 forum-info\">
		                                        <div>
		                                         <span class=\"views-number\">
		                                            5

		                                        </span>
		                                            
		                                        </div>
		                                    </div>


		                                </div>
		                            </div>

		                            <div class=\"forum-item\">
		                                <div class=\"row\">
		                                    <div class=\"col-md-9\">
		                                        <div class=\"forum-icon\">
		                                            <i class=\"fa fa-user-md\"></i>
		                                        </div>
		                                        <a id=\"vac-provisional\"  href=\"#\" class=\"forum-item-title\">PERSONAL PROVISIONAL</a>
		                                    </div>

		                                    <div class=\"col-md-2 forum-info\">
		                                        <div>
		                                         <span class=\"views-number\">
		                                            9
		                                        </span>
		                                            
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class=\"forum-item active\">
		                                <div class=\"row\">
		                                    <div class=\"col-md-9\">
		                                        <div class=\"forum-icon\">
		                                            <i class=\"fa fa-user-md\"></i>
		                                        </div>
		                                        <a id=\"vac-interino\"  href=\"#\" class=\"forum-item-title\">PERSONAL INTERINO</a>
		                                    </div>

		                                    <div class=\"col-md-2 forum-info\">
		                                        <div>
		                                         <span class=\"views-number\">
		                                            2

		                                        </span>
		                                            
		                                        </div>
		                                    </div>


		                                </div>
		                            </div>




		</div>




		<!-- Termna modal body -->


		                                        </div>
		                                        <div class=\"modal-footer\">
		                                            <button type=\"button\" class=\"btn btn-white\" data-dismiss=\"modal\">Cerrar</button>
		                                            <button type=\"button\" class=\"btn btn-primary\">Ingresar Datos</button>
		                                        </div>


		                                    </div>
		                                </div>
		                            </div>



		"; break;
    case "rf": $Modal ="<!-- Modal par Medicos Residentes -->

                          <div class=\"modal inmodal\" id=\"modal-residentes\" tabindex=\"-1\" role=\"dialog\"  aria-hidden=\"true\">
                                <div class=\"modal-dialog\">

                                    <div class=\"modal-content animated fadeIn\">
                                        <div class=\"modal-header\">
                                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
                                            <i class=\"fa fa-user-plus modal-icon\"></i>
                                            <h4 class=\"modal-title\"> Vacantes Disponibles</h4>
                                            <small>513 DIRECCION GENERAL DE RECURSOS HUMANOS</small>
                                        </div>


                                        <div class=\"modal-body\" style=\"padding-top: 1px;\">
<!-- Inicia modal Body -->


                        <div class=\"ibox-content forum-container\">

                            <div class=\"forum-title\">
                                 <h3>Total Vacantes: 60</h3>
                            </div>
                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-9\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-hospital-o\"></i>
                                        </div>
                                        <a id=\"vac-rf-mr\" href=\"#\" class=\"forum-item-title\">MÉDICOS RESIDENTES</a>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <div>
                                         <span class=\"views-number\">
                                            10
                                        </span>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-9\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a id=\"vac-rf-cs\"  href=\"#\" class=\"forum-item-title\">M.R. PARA TRABAJO SOCIAL COMUNITARIO(CARAVANAS DE LA SALUD) </a>
                                    </div>

                                    <div class=\"col-md-2 forum-info\">
                                        <div>
                                         <span class=\"views-number\">
                                            10

                                        </span>
                                            
                                        </div>
                                    </div>


                                </div>
                            </div>



                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-9\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-hospital-o\"></i>
                                        </div>
                                        <a id=\"vac-rf-ip\" href=\"#\" class=\"forum-item-title\">INTERNOS DE PRE-GRADO</a>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <div>
                                         <span class=\"views-number\">
                                            30
                                        </span>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-9\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a id=\"vac-rf-ssam\"  href=\"#\" class=\"forum-item-title\">SERVICIO SOCIAL ÁREA MÉDICA</a>
                                    </div>

                                    <div class=\"col-md-2 forum-info\">
                                        <div>
                                         <span class=\"views-number\">
                                            10

                                        </span>
                                            
                                        </div>
                                    </div>


                                </div>
                            </div>

</div>




<!-- Termna modal body -->

                                        </div>
                                        <div class=\"modal-footer\">
                                            <button type=\"button\" class=\"btn btn-white\" data-dismiss=\"modal\">Cerrar</button>
                                            <button type=\"button\" class=\"btn btn-primary\">Aceptar</button>
                                        </div>


                                    </div>
                                </div>
                            </div>





<!-- Fin Modal par Medicos Residentes -->

"; break;
    case "inc": $Modal ="../images/corporate-researcher-color.png"; break;
    case "ssa": $Modal ="../images/academic-researcher-color.png"; break;
}

return 	$Modal;

}// fin de creaCategoriaModal


?>
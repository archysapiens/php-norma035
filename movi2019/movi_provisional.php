<?php

echo " 
<script>

    $('a').click(function(){
            var IdQna = event.target.id;
            var reg = new RegExp(/^vac-noseusa/);
            console.log( IdQna);

        if( reg.test(IdQna)){
            $('#myModal45 .close').click();
            $.post('smweb_formulario.php', { \"id\": 1, \"pzavteid\":123 },
              function(response,status) {
                    //alert(response);
                    var string = response;
               $('#main_page').html(response);
               Noe.close() ;
              }// fin function
            ); // fin post
        }
        else {
            if(IdQna == 'Qhis') {   
                var varhtml ='?'+ $('#Qhis').attr('href');
                $('#contenido').load( \"ptfma_historico.php\"+ varhtml);
                return false;
              }
       }
    }
);
</script>


 <div id=\"wrapper\">



                        <div class=\"ibox-content forum-container\">

                            <div class=\"forum-title\">
                                <div class=\"pull-right forum-desc\">
                                    <samll>Total : 9</samll>
                                </div>
                                <h3>Total de Vacantes Provisional</h3>
                            </div>

                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-1\" class=\"forum-item-title\">Apoyo Administrativo En Salud A4 </a>
                                        <div class=\"forum-sub-title\">Clave de Pago:M0015001103M030220900223040004   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                        M03022
                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-2\" class=\"forum-item-title\">Tecnico Laboratorista B</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: M0013161103M020950900223010027   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                           M02095

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							    <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-3\" class=\"forum-item-title\">Apoyo Administrativo En Salud A7</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: M0016101103M030190900223040153    </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                           M03019

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
						        <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-4\" class=\"forum-item-title\">Apoyo Administrativo En Salud A7</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: M0016101103M030190900223040130    </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                           M03019

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
							     <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-5\" class=\"forum-item-title\">Apoyo Administrativo En Salud A6</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: P0183151103M030200901423040002     </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                         M03020

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
							 <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-6\" class=\"forum-item-title\">Apoyo Administrativo En Salud A4</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: M0015101103M030220900223040021     </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                        M03022

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
								     <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-7\" class=\"forum-item-title\">Auxiliar De Enfermeria B</a>
                                        <div class=\"forum-sub-title\">Clave de Pago:E0231601103M020820901823020150   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                       M02082

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
								     <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-8\" class=\"forum-item-title\">Medico Especialista B</a>
                                        <div class=\"forum-sub-title\">Clave de Pago:E0231601103M020820901823020150   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                   M01010

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
								     <div class=\"forum-item\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa-9\" class=\"forum-item-title\">Apoyo Administrativo En Salud A7</a>
                                        <div class=\"forum-sub-title\">Clave de Pago:M0015131103M030190900223040199    </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                   M03019
                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
							 </div>
                </div>";


?>                
           
  


    
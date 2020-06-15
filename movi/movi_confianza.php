<?php

echo " 
<script>

    $('a').click(function(){
            var IdQna = event.target.id;
            var reg = new RegExp(/^vac-noseusa/);
            console.log( IdQna);

        if( reg.test(IdQna)){
            $('#myModal45 .close').click();
            $.post('movi_formulario.php', { \"id\": 1, \"pzavteid\":123 },
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
                                    <samll>Total : 5</samll>
                                </div>
                                <h3>Total de Vacantes Confianza</h3>
                            </div>

                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa\" class=\"forum-item-title\">Secretario Particular Del C. Secretario De Salud</a>
                                        <div class=\"forum-sub-title\">Maestro De Puestos :12-100-1-M1C031P-0000064-E-G-B </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CF41075
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
                                        <a href=\"#\" id=\"vac-noseusa1\" class=\"forum-item-title\">Asesor Del C. Secretario De Salud</a>
                                        <div class=\"forum-sub-title\">Maestro De Puestos: 12-100-1-M1C019P-0000067-E-G-S  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CF40001

                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa2\" class=\"forum-item-title\">Dirección De Protocolo</a>
                                        <div class=\"forum-sub-title\">Maestro De Puestos: 12-100-1-M1C017P-0000071-E-G-S </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CF40002
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
                                        <a href=\"#\" id=\"vac-noseusa3\" class=\"forum-item-title\">Secretario Técnico</a>
                                        <div class=\"forum-sub-title\">Maestro De Puestos:  12-100-1-M1C019P-0000078-E-G-K  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CF40003
                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa4\" class=\"forum-item-title\">Secretaria De Apoyo De Guardia</a>
                                        <div class=\"forum-sub-title\">Maestro De Puestos: 12-100-1-M1C014P-0000076-E-G-S  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CF40003
                                        </span>
                                        <div>
                                            <small>Codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
";

?>
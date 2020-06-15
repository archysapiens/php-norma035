<?php

echo " 
<script>

    $('a').click(function(){
            var IdQna = event.target.id;
            var reg = new RegExp(/^vac-noseusa/);
            console.log( IdQna);

        if( reg.test(IdQna)){
            $('#modal-residentes .close').click();
            $.post('smweb_formulario-rf.php', { \"id\": 1, \"pzavteid\":123 },
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
                                <h3>Total de Vacantes Para Medicos Residentes</h3>
                            </div>

                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa\" class=\"forum-item-title\">Medico Residente 1 Grado</a>
                                        <div class=\"forum-sub-title\">Clave de Pago:E0106101204M040010901923035528  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            M04001
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
                                        <a href=\"#\" id=\"vac-noseusa4\" class=\"forum-item-title\">Medico Residente 2 Grado</a>
                                        <div class=\"forum-sub-title\">clave de pago: E0106101204M040020901923035271   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            M04002
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
                                        <a href=\"#\" id=\"vac-noseusa1\" class=\"forum-item-title\">Medico Residente 3 Grado</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: E0106101204M040030901923035577   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            M04003

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
                                        <a href=\"#\" id=\"vac-noseusa2\" class=\"forum-item-title\">Medico Residente 4 Grado</a>
                                        <div class=\"forum-sub-title\">clave de pago: E0106101204M040040901923033861   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            M04004
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
                                        <a href=\"#\" id=\"vac-noseusa3\" class=\"forum-item-title\">Medico Residente 5 Grado</a>
                                        <div class=\"forum-sub-title\">clave de pago: E0106101204M040050901923035009 
  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            M04005
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
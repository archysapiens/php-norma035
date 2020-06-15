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
                                    <samll>Total : 5</samll>
                                </div>
                                <h3>Total de Vacantes eventual</h3>
                            </div>

                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa\"  class=\"forum-item-title\">Subdirector De Area</a>
                                        <div class=\"forum-sub-title\">Clave de Pago:S072U001202CFN20020901523010003  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CFN2002
                                        </span>
                                        <div>
                                            <small>Código</small>
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
                                        <a href=\"#\" id=\"vac-noseusa-1\" class=\"forum-item-title\">Director General</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: G004S001202CFK30020901723010001   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                           CFK3002

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
                                        <a href=\"#\" id=\"vac-noseusa-2\" class=\"forum-item-title\">Jefe De Departamento </a>
                                        <div class=\"forum-sub-title\">clave de pago: S2006111202CFO20030901523010001   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CFO2003
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
                                        <a href=\"#\" id=\"vac-noseusa-3\" class=\"forum-item-title\">Subdirector De Area </a>
                                        <div class=\"forum-sub-title\">clave de pago: P0126001202CFN30030901423040002   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            
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
                                        <a href=\"#\" id=\"vac-noseusa-4\" class=\"forum-item-title\">Director De Area</a>
                                        <div class=\"forum-sub-title\">clave de pago: P0125141202CFM20010902023030001   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                            CFM2001
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
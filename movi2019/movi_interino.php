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
                                    <samll>Total : 2</samll>
                                </div>
                                <h3>Total de Vacantes Interino</h3>
                            </div>

                            <div class=\"forum-item active\">
                                <div class=\"row\">
                                    <div class=\"col-md-10\">
                                        <div class=\"forum-icon\">
                                            <i class=\"fa fa-user-md\"></i>
                                        </div>
                                        <a href=\"#\" id=\"vac-noseusa\" class=\"forum-item-title\">Medico Especialista A </a>
                                        <div class=\"forum-sub-title\">Clave de Pago:E0231601103M010040901823020598   </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                          M01004
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
                                        <a href=\"#\" id=\"vac-noseusa-1\" class=\"forum-item-title\">Apoyo Administrativo En Salud A8</a>
                                        <div class=\"forum-sub-title\">Clave de Pago: E0231601103M030180901823020118  </div>
                                    </div>
                                    <div class=\"col-md-2 forum-info\">
                                        <span class=\"views-number\">
                                           M03018

                                        </span>
                                        <div>
                                            <small>codigo</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    
                </div>
            </div> ";

  


 ?>   
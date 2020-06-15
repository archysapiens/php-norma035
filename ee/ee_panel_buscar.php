<?php
session_start();

include 'ee_panel_buscar.inc';

$FechaProceso="";
if(isset($_POST['fecha_proceso']))
    $FechaProceso=$_POST['fecha_proceso'];

$Icono ="";
$ListaUnidadResponsable="";

$SeccionImagen =  capturaPersonalesIncidencias();

$MostrarTabuladores = capturaPersonalesIncidencias(); // creaTabuladores($SeccionImagen);



$Script ="

<script>
    /* MESSAGE BOX */
      $(\".mb-control\").on(\"click\",function(){
        var box = $($(this).data(\"box\"));
        if(box.length > 0){
          box.toggleClass(\"open\");
          
          var sound = box.data(\"sound\");
          
          if(sound === 'alert')
            playAudio('alert');
          
          if(sound === 'fail')
            playAudio('fail');
          
        }        
        return false;
      });


      $(\".mb-control-close\").on(\"click\",function(){
         $(this).parents(\".message-box\").removeClass(\"open\");
         return false;
      });    
    /* END MESSAGE BOX */
    /* PLAY SOUND FUNCTION */
      function playAudio(file){
        if(file === 'alert')
          document.getElementById('audio-alert').play();

        if(file === 'fail')
          document.getElementById('audio-fail').play();    
      }
    /* END PLAY SOUND FUNCTION */
    
    (function($) {
    \"use strict\";
        // FULLWIDTH SEARCH
    $(\".ss-trigger-img\").click(function() {
        $(\".ss-content\").addClass(\"ss-content-act\");
        console.log('ss-trigger-img');
        $(\"#searchBlock\").focus();
        console.log('searchBlock/focus');
    });

    $(\"#NewSearch\").click(function() {
        console.log('NewSearch');
        $(\".ss-content\").addClass(\"ss-content-act\");        
        $('.ss-content').find('.ssc-inner-top').removeClass('ssc-inner-top').addClass('ssc-inner');
        $(\"#searchBlock\").val('');
        $(\"#resultsInput\").html('');        
    });                    
/**            
    $(\"#NewPlantilla\").click(function() {
        // Vaciar de Formulario
        
            $('#txtEstado').val('DF').removeAttr(\"disabled\").prop(\"disabled\", true);
            $('#txtUR').val('').removeAttr(\"disabled\");
            $('#txtCoP').val('').removeAttr(\"disabled\");
            $('#txtDescrip').val('').removeAttr(\"disabled\");
            $('#txtNivel').val('').removeAttr(\"disabled\");
            $('#txtTotalP').val('').removeAttr(\"disabled\");
            
            $('#btnActualizar_Plantilla').hide();
            $('#btnGuardar_Plantilla').show();
    });

**/
    $(\".ss-close\").click(function() {
        $(\".ss-content\").removeClass(\"ss-content-act\");        
        $('.ss-content').find('.ssc-inner-top').removeClass('ssc-inner-top').addClass('ssc-inner');
        $(\"#searchBlock\").val('');
        $(\"#resultsInput\").html('');
    });
    
})(jQuery); // End of use strict
    
  </script>


 <script>
    $('#resultsInput').on('click', '#tagsEdit', function(event){
        console.log('resultsInput');

        var setEstado = $(this).attr('dataEstado');
        var setUR = $(this).attr('dataUR');

        var setURDesc = $(this).attr('dataURId');

        var setCoP = $(this).attr('dataCoP');
        var setDescrip = $(this).attr('dataDescrip');

        var setNivel = $(this).attr('dataNivel');
        var setTotalP = $(this).attr('dataTotalP');
        var setURId = $(this).attr('dataURId');
        var setCURP = $(this).attr('dataCURP');
        var setRFC = $(this).attr('dataRFC');
        var setImagen = $(this).attr('dataImagen');
        var setNombre= $(this).attr('dataNombre');
        var setRama= $(this).attr('dataRama');


//llama a movi_panel_incidencias_lista_mov.php
/**        
        $.post( 'movi_panel_incidencias_lista_mov.php',{ codigo: setCoP},  function( data ) {
           $('#listaMovimientos').html(data);
           console.log(data) ;
        });
**/
        // llenado de Formulario
        
            $('#txtEstado').val(setEstado).prop(\"disabled\", true);            
            $('#txtUR').val(setURId).change();
            $('#txtCoP').val(setCoP).prop(\"disabled\", true);
            $('#txtDescrip').val(setDescrip).prop(\"disabled\", true);
            $('#txtNivel').val(setNivel).prop(\"disabled\", true);
            $('#txtTotalP').val(setTotalP);
            $('#txtUR').attr( \"setURId\", setURId );
            $('#btnActualizar_Plantilla').show();
            $('#btnGuardar_Plantilla').hide();
            $('#txtUrDesc').val(setURDesc).prop(\"disabled\", true);
            $('#txtCURP').val(setCURP).prop(\"disabled\", true);
            $('#txtRFC').val(setRFC).prop(\"disabled\", true);
            $('#avatar2').attr('src',setImagen);
            $('#txtNombre').val(setNombre).prop(\"disabled\", true);
            $('#txtRama').val(setRama).prop(\"disabled\", true);

        $(\".ss-content\").removeClass(\"ss-content-act\");    
        $('#divFormPlantilla').removeClass('hidden');
        $('.ss-trigger-img').addClass('hidden');
    });
    $(\"#searchBlock\").keyup(function() {
        var inputSearchBlock = $(this).val();
            $(\"#resultsInput\").html('');            
            $.ajax({
                url: \"ee_busqueda_sp.php\",
                data: { action:'Search',inputSearchBlock: inputSearchBlock},
                cache: true,
                    beforeSend: function( xhr ) {
                        $(\"#resultsInput\").html('');
                        $(\"#changeSearch\").children('i').addClass('fa-spinner fa-spin');                        
                    }
            }).done(function( html ) {
                $(\"#resultsInput\").html('');
                $('.ss-content').find('.ssc-inner').removeClass('ssc-inner').addClass('ssc-inner-top');
                $(\"#resultsInput\" ).append(html);
                $(\"#changeSearch\").children('i').removeClass('fa-spinner fa-spin');    
                <!-- $( \"#resultsInput\" ).delay(900).fadeIn('slow').append(html); -->
                if(inputSearchBlock==''){
                    $('.ss-content').find('.ssc-inner-top').removeClass('ssc-inner-top').addClass('ssc-inner');
                }
            });
           
                                                                                        
        return false;
    });
    $(\"#btnActualizar_Plantilla\").click(function() {
        
        console.log('btnActualizar_Plantilla/envio de movimiento');
        $('#btnActualizar_Plantilla').prop(\"disabled\", true);        
        $('#btnActualizar_Plantilla .fa-send').addClass('fa-spinner fa-spin');        
                                    
            // Recoger Valores del formulario
                var getTotalP = $('#txtTotalP').val();                        
                var getEstado = $('#txtEstado').val();                        
                var getNivel = $('#txtNivel').val();                        
                var getCoP = $('#txtCoP').val();    
                var getIdUR = $('#txtUR').attr(\"setURId\");
            
            $.ajax({
                url: \"ee_busqueda_sp.php\",
                data: { action:'Update',getTotalP: getTotalP, getEstado:getEstado,getNivel:getNivel,getCoP:getCoP,getIdUR:getIdUR},
                cache: true
            }).done(function( html ) {
                $(\"#resultsInput\").html(html);                
            });
            
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('','Datos Actualizados');
                $('#btnActualizar_Plantilla').removeAttr(\"disabled\");
                $('#btnActualizar_Plantilla .fa-send').removeClass('fa-spinner fa-spin');
            },2000);
            
    });
    $(\"#btnGuardar_Plantilla\").click(function() {
        
        $('#btnGuardar_Plantilla').prop(\"disabled\", true);    
        $('#btnGuardar_Plantilla .fa-send').addClass('fa-spinner fa-spin');
                        
            // Recoger Valores del formulario
                var getTotalP = $('#txtTotalP').val();                        
                var getEstado = $('#txtEstado').val();                        
                var getNivel = $('#txtNivel').val();

                var getCoP = $('#txtCoP').val();
                var getIdUR = $('#txtUR').val();

                var getDescrip = $('#txtDescrip').val();
            
            $.ajax({
                url: \"ee_busqueda_sp.php\",
                data: { action:'Insert',getTotalP: getTotalP, getEstado:getEstado,getNivel:getNivel,getCoP:getCoP,getIdUR:getIdUR,getDescrip:getDescrip},
                cache: true
            }).done(function( html ) {
                $(\"#resultsInput\").html(html);                
            });
            
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
            
                toastr.success('','Datos Guardados');
                $('#btnGuardar_Plantilla').removeAttr(\"disabled\");
                $('#btnGuardar_Plantilla .fa-send').removeClass('fa-spinner fa-spin');
            },2000);    
    });
</script>



";


$TituloPanel ="<div class=\"col-lg-12\" id=\"productos-nomina\">
                    <div class=\"ibox float-e-margins\">
                      <div class=\"ibox-title animated bounceIn\">
                        <h5>
                            <i class=\"fa $Icono fa-2x\" style=\"color: #1ab394;\"></i>
                            Busqueda de Expedientes 
                        </h5>
                        <div class=\"ibox-tools\">
                            Fecha : $FechaProceso
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                        </div>
                </div>";

              $Body="  <div class=\"ibox-content animated bounceIn\" id=\"contenido\">
		
               <div class=\"ibox-content\" style=\"height:340px;\">
						<img src=\"https://www.edupics.com/coloring-page-magnifying-glass-dl22950.jpg\" height=\"250\" width='250' style='margin-left:37%;cursor:pointer;' alt=\"image\" class=\"img-circle ss-trigger-img\"/>
						
						<div class=\"col-lg-11 hidden\" style=\"vertical-align:middle\" id=\"divFormPlantilla\">	<br>
							<div class=\"row col-lg-12\" style=\"text-align:center;padding-bottom:40px;\">								
								<div class=\"col-sm-6\">
<!--                                
									<span class=\"img-circle fa fa-user-plus fa-3x\" style=\"color:#1ab394;cursor:pointer\" id=\"NewPlantilla\" alt=\"search\" ></span>
-->
                                    
								</div>
								<div class=\"col-sm-6\">
									<span class=\"img-circle fa fa-search fa-3x\" style=\"color:#1ab394;cursor:pointer\" id=\"NewSearch\" alt=\"add\" ></span>	
								</div>														
							</div>

							<form class=\"form-horizontal\" name=\"frm_Plantilla\" id=\"frm_Plantilla\">

<!-- insercionde apartadode imagen -->




$MostrarTabuladores 





<!-- FIN insercionde apartadode imagen -->






										</div>

									</div>
								</div>
							</form>	<br>	




							<button type=\"button\" class=\"ladda-button btn btn-primary btn-block pull-right\" data-style=\"expand-right\" id=\"btnGuardar_Plantilla\" style=\"display:none\"> <span class=\"fa fa-send\"></span> &nbsp; Guardar</button>																								
							<button type=\"button\" class=\"green ladda-button btn btn-success btn-block pull-right\" data-style=\"expand-right\" id=\"btnActualizar_Plantilla\" style=\"display:none\"> <span class=\"fa fa-send\"></span> &nbsp; Actualizar</button>																								
							<div class=\"result-Ajax hidden\"> </div>
						</div>
						
				</div>

";      


echo $Script.$TituloPanel.$Body;


?>
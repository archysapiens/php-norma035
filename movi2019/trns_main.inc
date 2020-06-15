<?php
/*********************************************************************
 * 
 * Funcion : construyeDropzones
 * Objetivo: Construir los los Dropzones y las funciones 
 *           de operacion JS
 * Parametros
 * $Configuracion:  Viene una cadena
 *              Arreglo de datos de ancabezado que tiene 
 *               lo siguiente:
 *                CERO  Año del periodo
 *                UNO   Quincena a entregar
 *                DOS   Fecha Limite de entrega de Info
 *                TRES  Numero Max de Quincenas
 *                CUATRO Fecha Lim. de Ultima quincena
 *               
 *               SECCION II Tipos de Archivos Autorizados
 *                  1  Archivos X00  
 *                  2  Archivos 416  
 *                  3  Archivos 610    
 **********************************************************************/
function construyeDropzones($ConfiguracionPanels){
date_default_timezone_set('America/Mexico_City');
$FechaProceso = date("d-m-Y");
$HoraProceso = date("H:i:s");
$DropZones="";
$DropZonesActions="";
$DatosConfig = explode("|", $ConfiguracionPanels);
$NumCampos = count($DatosConfig);
  for($Contador = UNO; $Contador < $NumCampos - UNO; $Contador++){
            $TiposArchivos = $DatosConfig[$Contador];
            $DatosTipoArchivo = explode("@", $TiposArchivos);
            $TipoArchivo = $DatosTipoArchivo[CERO];
            $Descripcion = $DatosTipoArchivo[UNO];
            $Estatus     = $DatosTipoArchivo[DOS];
            $FechaStage  = $DatosTipoArchivo[TRES];
            $NombreForma = "my-awesome-dropzone_". 
                                strtolower(str_replace(" ", "_", $Descripcion));
            $DescripcionBoton= strtolower(str_replace(" ", "_", $Descripcion));                    
            if($Estatus != "K"){
            $DropZones .= "
                        /**
                            Objeto myDropzone$TipoArchivo
                            Se encarga de subir los archivo de nomina tipo $Descripcion
                            Fecha : $FechaProceso $HoraProceso
                            Autor : Secretaria de Salud
                        **/

                        var myDropzone$TipoArchivo = new Dropzone(\"form#$NombreForma\",
                        { 
                            uploadMultiple: true,
                            headers: { \"TIPOA\": \"$TipoArchivo\" },
                            params: {\"TIPOA\": \"$TipoArchivo\"},
                            thumbnailWidth: 40,
                            thumbnailHeight: 40,
                            parallelUploads: 20,
                            autoProcessQueue: false,
                            init: function(){
                                this.on(\"error\", function(file, responseText) {
                                        alert('error >'+responseText );
                                        //alert(responseText);
                                });
                                this.on(\"addedfile\", function(file) {
                                       // alert(file.name );
                                        //$(\"#enviar1\").prop( \"disabled\", false );
                                            //alert(responseText);
                                });
                                this.on(\"success\", function(file, responseText) {
                                       
                                        $('#myModal4').modal('hide');
                                   //alert(\"success >\" + responseText +\"<\");
                                            //alert(responseText);
                                   $('#$DescripcionBoton').html(responseText); 
                                });
                                this.on(\"complete\", function(file, responseText) {
                                        //alert(file.name + 'tam >' + file.size +'<') ;
                                            //alert(responseText);
                                 });
                            }
                           });  // fin de myDropzone$TipoArchivo     ";


                 $DropZonesActions .=  "

                                /**
                                    Control de DropZone $Descripcion

                                **/

                                $('#clear-dropzone_$DescripcionBoton').click(function(){
                                  myDropzone$TipoArchivo.removeAllFiles(true);
                                });
                                                                               
                                $('#enviar_$DescripcionBoton').click(function(){
                                   $('#myModal4').modal('show');
                                   myDropzone$TipoArchivo.processQueue();
                                });
                                ";
         }// if($Estatus=="K")                      

  }// fin for
  return $DropZones.$DropZonesActions;
} // fin de construyeDropzones


/*********************************************************************
 * 
 * Funcion : construyeTipoPanel
 * Objetivo: Construir los tipos de paneles
 *           
 * Parametros
 * $TipoPanel:  Determina si va a ser Panel de Carga "E" o ""
 * $Icono    :  Icno a Utilizar
 * $TipoArchivo: 1,2,3 
 *                  1  Archivos X00  
 *                  2  Archivos 416  
 *                  3  Archivos 610    
 * $Descripcion: Descriptivo del tipo de archivo(arriba)
 * $FechaLim   : Fecha limite en que el envio de archivos Cierra
 * $IdPanel    : Identificador asigando a cada panel
 * $HeaderArray: Encabezado con los siguientes datos
 *                CERO  Año del periodo
 *                UNO   Quincena a entregar
 *                DOS   Fecha Limite de entrega de Info
 *                TRES  Numero Max de Quincenas
 *                CUATRO Fecha Lim. de Ultima quincena
 *
 **********************************************************************/

function construyeTipoPanel($TipoPanel,$Icono,$TipoArchivo,$Descripcion,$FechaStage,$FechaLim,$IdPanel,$HeaderArray ){
$Body="";
$StrValidacion ="?tipo_archivo=".urlencode($TipoArchivo) ."&anio=".
                    urlencode($HeaderArray[CERO])."&quincena=".urlencode($HeaderArray[UNO]);

$TituloPanel ="<div class=\"col-lg-12\" id=\"productos-nomina\">
                    <div class=\"ibox float-e-margins\">
                      <div class=\"ibox-title animated bounceIn\">
                        <h5>
                            <i class=\"fa $Icono fa-2x\" style=\"color: #1ab394;\"></i>
                            Integración de Productos de Nómina $Descripcion
                        </h5>
                        <div class=\"ibox-tools\">
                            Fecha Limite de entrega: $FechaLim
                            <a class=\"collapse-link\">
                                <i class=\"fa fa-chevron-up\"></i>
                            </a>
                        </div>
                </div>";

if($TipoPanel=="" or $TipoPanel=="E" or $TipoPanel=="F"){

              $Body="  <div class=\"ibox-content animated bounceIn\" id=\"$IdPanel\">

                        <div class=\"row\" style =\" text-align:center;vertical-align:middle\">
                            <div class=\"col-sm-5 b-r\">

                            <br><br><br>
                            <i class=\"fa fa-cloud-upload fa-5x\"></i>

                                <h3 class=\"m-t-none m-b\">Área Central,Órganos  Descentralizados, Organismos Públicos  Descentralizados,Honorarios</h3>
                                

                                <form role=\"form\">
                                    <div class=\"form-group\">
                                        <label>Bases de Datos Nomina</label> 
                                        <div id=\"resumen_carga_$IdPanel\">
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class=\"col-sm-7\" id=\"zona-de-carga\">
                            <form id=\"my-awesome-dropzone_$IdPanel\" class=\"dropzone\" 
                                        action=\"pfma_validacion_archivos.php$StrValidacion\">
                                    <p>Arrastre los archivos o solo haga click</p>
                                <div class=\"dropzone-previews\">
                                </div>

                            </form>   
                              <button id=\"enviar_$IdPanel\" type\"button\"
                               class=\"btn btn-primary pull-right\">
                                  Validar</button>&nbsp;&nbsp;

                               <button id=\"clear-dropzone_$IdPanel\" type\"button\" class=\"btn btn-primary pull-right\">
                                  Limpiar</button>   

                            </div> <!-- fin de zona-de-carga -->
                        </div> <!-- fin de row -->
                    </div> <!-- fin de ibox-content x00 -->
                </div> <!-- fin de float-e-margins -->
            </div>";      
  }elseif ($TipoPanel=="K") {
                  $Quincena = $HeaderArray[UNO];
                  $NomUsuario = $_SESSION['nombre_usuario'];
                  $Body="  <div class=\"ibox-content animated bounceIn\" id=\"$IdPanel\">
                            <div class=\"row\">
                                <div class=\"col-lg-12\">
                                    <div class=\"m-b-md\">

                                        <a href=\"#\" class=\"btn btn-white btn-xs pull-right\">
                                        <i class=\"fa fa-check-circle fa-5x\"></i></a>
                                        <h2>Directivas de Calidad Aplicadas Correctamente</h2>
                                    </div>
                                    <dl class=\"dl-horizontal\">
                                        <dt>Estatus:</dt> <dd>
                                        <span class=\"label label-primary-ssa\">Validado</span></dd>
                                    </dl>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-lg-5\">
                                    <dl class=\"dl-horizontal\">

                                        <dt>Tipo Archivo:</dt> <dd>$Descripcion</dd>
                                        <dt>Quincena:</dt> <dd>   $Quincena </dd>
                                        <dt>Enviada por:</dt> <dd><a href=\"#\" class=\"text-navy\"> $NomUsuario</a> </dd>
                                        <dt>Registros:</dt> <dd>  1024 </dd>
                                        <dt>Detalle:</dt> <dd>  1824 </dd>
                                    </dl>
                                </div>
                                <div class=\"col-lg-7\" id=\"cluster_info\">
                                    <dl class=\"dl-horizontal\">

                                        <dt>Fecha Envio:</dt> <dd>$FechaStage</dd>
                                        <dt>Percepciones:</dt> <dd>  12,000,000.00 </dd>
                                        <dt>Deducciones:</dt> <dd>  1,300,000.00 </dd>
                                        <dt>Complementarios:</dt>
                                        <dd class=\"project-people\">
                                              <a id=\"view-pdf\" class=\"btn btn-outline btn-default view-pdf\" href=\"#\">
                                              <i class=\"fa fa-file-pdf-o fa-2x\"></i>
                                              </a>
                                              <a id=\"view-pdf\" class=\"btn btn-outline btn-default view-pdf\" href=\"#\">
                                              <i class=\"fa fa-file-pdf-o fa-2x\"></i>
                                              </a>
                                              <a id=\"view-pdf\" class=\"btn btn-outline btn-default view-pdf\" href=\"#\">
                                              <i class=\"fa fa-file-image-o fa-2x\"></i>
                                              </a>

                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-lg-12\">
                                    <dl class=\"dl-horizontal\">
                                        <dt>Completed:</dt>
                                        <dd>
                                            <div class=\"progress progress-striped active m-b-sm\">
                                                <div style=\"width: 100%;\" class=\"progress-bar\"></div>
                                            </div>
                                            <small>Análisis de datos <strong>100%</strong>. Validación de Directivas de Calidad <strong>100%</strong>.</small>
                                        </dd>
                                    </dl>
                                </div>
                            </div>


</div> <!-- fin de panle -->

            </div>";      

  } // fin del If        

  return $TituloPanel.$Body; 
} // fin de construyeTipoPanel

/************************************************
 * 
 * Funcion : construyePanelesCarga
 * Objetivo: Construir dinamicamente los paneles 
 *           de carga (X00,416 o 610).
 * Parametros
 * $ConfiguracionPanels: Arreglo de datos de ancabezado que tiene 
 *               lo siguiente:
 *                CERO  Año del periodo
 *                UNO   Quincena a entregar
 *                DOS   Fecha Limite de entrega de Info
 *                TRES  Numero Max de Quincenas
 *                CUATRO Fecha Lim. de Ultima quincena
 *               
 *               SECCION II Tipos de Archivos Autorizados
 *                  1  Archivos X00  
 *                  2  Archivos 416  
 *                  3  Archivos 610    
 *
*************************************************/
function construyePanelesCarga($ConfiguracionPanels){
 $MsgPanelesCarga="";   
 $DatosConfig = explode("|", $ConfiguracionPanels);
 $NumCampos =count($DatosConfig); 
// echo "NumCampos". $NumCampos ."<br>";
 $ArrayIconos =array(" fa-hospital-o ", " fa-user-md ", " fa-medkit ", " fa-user-md ");
 if(is_array($DatosConfig)) {
    
        $HeaderConfig =$DatosConfig[CERO];
        $HeaderArray = explode("@", $HeaderConfig);
        $Anio = $HeaderArray[CERO];
        $Qna = $HeaderArray[UNO];
        $FechaLim = $HeaderArray[DOS];
        $MaxQna = $HeaderArray[TRES];
        $MaxLim = $HeaderArray[CUATRO];
        $Panels ="";
        for($Contador = UNO; $Contador < $NumCampos - UNO; $Contador++){
            $TiposArchivos = $DatosConfig[$Contador];
            $DatosTipoArchivo = explode("@", $TiposArchivos);
//            echo "Campos de Archivo " . count($DatosTipoArchivo) . "<br>";
            $TipoArchivo = $DatosTipoArchivo[CERO];
            $Descripcion = $DatosTipoArchivo[UNO];
            $Estatus     = $DatosTipoArchivo[DOS];
            $FechaStage  = $DatosTipoArchivo[TRES];

/**            
            echo " TipoArchivo >". $TipoArchivo ."< ";
            echo " Descripcion >". $Descripcion ."< ";
            echo " Estatus >". $Estatus ."< ";
            echo " FechaStage >". $FechaStage ."< <br>";
**/
            $IdPanel = strtolower(str_replace(" ", "_", $Descripcion));
            //echo "Descripcion >".$Descripcion."< <br>";
            //echo "IdPanel >".$IdPanel."< <br>";

            $Icono = $ArrayIconos[$Contador-UNO];

            $Panels .= construyeTipoPanel($Estatus, $Icono,$TipoArchivo,$Descripcion,$FechaStage,$FechaLim,$IdPanel,$HeaderArray);
        }  // fin del for   
       $MsgPanelesCarga=$Panels ;
  }
  else{
    $MsgPanelesCarga="Sistema ptma_opcd.inc/construyePanelesCarga/$ConfiguracionPanels";  
  }  
return $MsgPanelesCarga;
}// fin de construyePanelesCarga

/************************************************
 * 
 * Funcion : construyeListaQnas
 * Objetivo: Construir dinamicamente la lista de acceso a 
 *           los procesos de carga (X00,416 o 610)
 * Parametros
 * $HeaderArray: Arreglo de datos de ancabezado que tiene 
 *               lo siguiente:
 *                CERO  Año del periodo
 *                UNO   Quincena a entregar
 *                DOS   Fecha Limite de entrega de Info
 *                TRES  Numero Max de Quincenas
 *                CUATRO Fecha Lim. de Ultima quincena
 *
*************************************************/
function construyeListaQnas($HeaderArray){
  if(is_array($HeaderArray)) {
    try{
        $Anio = $HeaderArray[CERO];
        $Qna = $HeaderArray[UNO];
        $FechaLim = $HeaderArray[DOS];
        $MaxQna = $HeaderArray[TRES];
        $MaxLim = $HeaderArray[CUATRO];
    }   catch (Exception $e) {

       $MsgconstruyeListaQnas="Excepción del Sistema: ".  $e->getMessage(). " <br>";

    }

    $HdrLista = "<li class=\"active\">
                    <a href=\"quincenaurl=$Qna&anioquincenaurl=$Anio\" id=\"Qhis\">
                        Anteriores 
                    </a>
                     </li>
                 <li class=\"divider\"></li>  ";

    $TailLista = "<li><a href=\"$Qna\"id=\"Q100\">Próximas 
                      <span class=\"label label-primary pull-right\">NEW
                      </span></a>
                    </li> ";                        

    $Contador  = $Qna;
    $BodyLista = "";
    while(($Contador <= ($Qna+1)) and (($Qna+1) <= $MaxQna)){
       $BodyLista.= "<li><a href=\"ptma_opcd.php?quincenaurl=$Contador&anioquincenaurl=$Anio\" id=\"Q$Contador\">Quincena $Contador</a></li>
                      <li class=\"divider\" style=\" background-color:#D8D8D8\"> </li> ";
       $Contador++;               
    }// fin del while
    $MsgconstruyeListaQnas=$HdrLista.$BodyLista.$TailLista;
  }
  else{
        $MsgconstruyeListaQnas= "Sistema ptma_opcd.inc/construyeListaQnas/Array";
  } // fin de if(is_array( 
  return  $MsgconstruyeListaQnas; 
} // fin de construyeListaQnas

/**
  
  Funcion : configuraSesion
  Objetivo: Requerimiento: Es necesario contar con una 
             interfaz gráfica que nos permita lo     siguiente:
            Consultar en las tablas organismos, usuarios, 
            archivos y privilegios, para conocer cuáles son 
            los archivos que el usuario podrá subir(X00, 416, 610, etc)
            Una vez que se tengan los tipos de archivos autorizados a subir, se debe verificar en que estatus se encuentran, ya que pueden haber sido reportados como erróneos y aun no se validan o pueden estar validados, de ahí que el panel de control se auto configura.
            Ejemplo:
            Usuario debe entregar archivos X00 y 416
            Tendrá dos paneles de carga
            Se valida que cada tipo de archivo haya realizado operaciones de validación.
            Caso I Nueva Validación
            El usuario No ha intentado validar archivos, por lo que aparece el panel libre.
            Caso II Error en validación
            Se muestra habilitado el panel de carga con la indicación que ya tiene una validación previa y el panel disponible.
            Caso III EL usuario ha validado sin errores
            El usuario realizo la validación de sus archivos, posiblemente tuvo errores y al final valido su información y esta ok
            Caso IV Al usuario le hicieron algunas recomendaciones
            El usuario realizo la validación de sus archivos, posiblemente tuvo errores y le han solicitado nuevamente suba la información, con las indicaciones aplicadas y la información actualizada.
 PARAMETROS
 $quincenaurl, Cuando se seleciona alguna quincena en especifico           

**/
function configuraSesion($QuincenaUrl,$AnioQuincenaUrl)
{
$Usuario="";
if(isset($_SESSION['inputUsuario']))
    $Usuario=$_SESSION['inputUsuario'];
$Passwd="";
if(isset($_SESSION['inputPassword']))
    $Passwd=$_SESSION['inputPassword'];
$IdOrg="";
if(isset($_SESSION['idorg']))
    $IdOrg=$_SESSION['idorg'];
$Organismo="";
if(isset($_SESSION['organismo']))
    $Organismo=$_SESSION['organismo'];

$NombreUsuario="";
if(isset($_SESSION['nombre_usuario']))
    $NombreUsuario=$_SESSION['nombre_usuario'];

$DatosConfig="XXX";
$db = new DbCnnx();    

if( ($QuincenaUrl !="") and (is_numeric($QuincenaUrl)) and (is_numeric($AnioQuincenaUrl)) ){
            $SQLPeriodo ="SELECT MIN(anio) AS anio,
                        MIN(numero) AS num_quincena,MIN(fecha_envio) AS fecha_limite,
                        MAX(numero) as max_quincena, MAX(fecha_envio) as max_limite
                        FROM periodos
                        WHERE numero >= ".$QuincenaUrl . " and anio=".$AnioQuincenaUrl;
}else{
            $SQLPeriodo ="SELECT MIN(anio) AS anio,
                        MIN(numero) AS num_quincena,MIN(fecha_envio) AS fecha_limite,
                        MAX(numero) as max_quincena, MAX(fecha_envio) as max_limite
                        FROM periodos
                        WHERE fecha_envio > CURDATE()";
}// fin de if($quincenaurl !="")

//echo "configuraSesion SQL>". $SQLPeriodo ."< <br>";

$rows = $db->select($SQLPeriodo);
//echo "Error >". $db->error() ."< <br>";
$Contador=  CERO;
$Anio="";
$NumQna="";
$FecLim="";
//print_r ($rows);
if(!is_array($rows)){
   // $DatosConfig.= "Error en la definicion de periodos <br>";
    $DatosConfig="X";
   // echo "DatosConfig=DatosConfig <br>";
}    
else
{
      //  echo "Antes del while Contador >$Contador< <br>";
        while(isset($rows[$Contador]['anio']))
        {
            $Anio = $rows[$Contador]['anio'];
            $NumQna = $rows[$Contador]['num_quincena'];
            $FecLim = $rows[$Contador]['fecha_limite'];
            $MaxQna = $rows[$Contador]['max_quincena'];
            $MaxLim = $rows[$Contador]['max_limite'];
            $Contador++;
        }// fin de while

        $Header=$Anio."@".$NumQna."@".$FecLim."@".$MaxQna."@".$MaxLim;
        if((strlen($Anio) >CERO) and (strlen($NumQna) >CERO) and (strlen($FecLim) >CERO)){
            $IdOrg = $db->quote($IdOrg);
            $SQLRemesas ="SELECT rem.id,rem.fecha_asignacion,rem.fecha_actualizacion,
                            rem.id_organismos,rem.estatus,rem.id_archivos,rem.anio_periodos,
                            rem.numero_periodos, arc.descripcion
                            FROM remesas rem, archivos arc
                            WHERE rem.id_archivos=arc.id AND 
                            rem.anio_periodos=".$Anio."  
                            AND rem.numero_periodos=".$NumQna.
                            " AND rem.id_organismos=".$IdOrg;     
            //echo "<br> SQLRemesas >$SQLRemesas< <br>";                
            $RowsRmsas = $db->select($SQLRemesas);
            $Contador=  CERO;
            if(!$RowsRmsas)
                //$DatosConfig.="Error en las Remesas <br>";
                $DatosConfig="XX";
            else{
                    while(isset($RowsRmsas[$Contador]['id']))  {
                        $IdRmsa = $RowsRmsas[$Contador]['id'];                            
                        $IdOrg = $RowsRmsas[$Contador]['id_organismos'];
                        $IdArvos = $RowsRmsas[$Contador]['id_archivos'];
                        $DescArvos = $RowsRmsas[$Contador]['descripcion'];
                        
                        $SQLBitacora= "SELECT  id_remesas,
                                    DATE_FORMAT(MAX(fecha_evento), '%d-%m-%Y %H:%i:%s') as fecha
                                    ,estatus 
                                    FROM bitacora
                                    where  id_remesas=".$IdRmsa.
                                   "  GROUP BY id_remesas, estatus
                                    ORDER BY fecha_evento DESC";
                      //  $DatosConfig .=            $SQLBitacora ."<br>";
                        $RowsBit = $db->select($SQLBitacora) ;
                        $IdRmsaBit  = "";
                        $FechaStage = "";
                        $Estatus    = "";
                        if(isset($RowsBit[CERO]['id_remesas']))
                            $IdRmsaBit  = $RowsBit[CERO]['id_remesas'];
                        if(isset($RowsBit[CERO]['fecha']))
                            $FechaStage = $RowsBit[CERO]['fecha'];
                        if(isset($RowsBit[CERO]['estatus']))
                            $Estatus    = $RowsBit[CERO]['estatus'];
                        $DatosConfig =$DatosConfig. $IdArvos."@".$DescArvos."@".$Estatus. "@". $FechaStage."|";
                        if($Contador == CERO)
                            $DatosConfig =$Header."|".$IdArvos."@".$DescArvos."@".$Estatus."@".$FechaStage."|";
                        $Contador++;
                    }// fin del while remesas    
            } // fin de if(!$RowsRmsas)
        } // fin de if((strlen($Anio) >CERO) a    
} // fin de if(!$rows) Periodos               
//echo "return >".$DatosConfig. "< <br>";    
return $DatosConfig;    

} // fin de configuraSesion.



/**
  
  Funcion : obtenResultadosValidacion
  Objetivo: Elaborar la presentacion de 
            resultados obtenidos despues del 
            proceso de validacion 
  

**/

function obtenResultadosValidacion($TipoNomina, $Estatus,$ArrArchivos, $ArrRpteValidacion, 
    $ArchivoErr, $NumRegAna)
{
    date_default_timezone_set('America/Mexico_City');
    $FechaProceso = date("d-m-Y");
    $HoraProceso = date("H:i:s");
    $Organismo= $_SESSION['organismo'] ;
    $Icono = "<i class=\"fa fa-warning fa-5x\" style=\"color:#F00404\"></i>";

    $Estat = "<span class=\"label label-primary\" 
               style=\"background-color: #F00404;\">Error</span>
                            ";
    $Archivos ="";                        

    $NumArchivos = count($ArrArchivos);
    //echo "NumArchivos >" . $NumArchivos . "< <br>";
    for($Ind=0;$Ind < $NumArchivos; $Ind++){
        $Archivos .="<dd>".  $ArrArchivos[$Ind] . "</dd>";         
    }// fin del for    


$BtonSubir=" <div style=\" text-align:center;vertical-align:middle\">
            <button id=\"cargaotravez\" class=\"btn btn-warning btn-lg \" type=\"button\">
                <i id=\"cargaotravezicon\" class=\"fa fa-upload\">
                </i>&nbsp;&nbsp;
            <span id=\"cargaotravezspan\" class=\"bold\">Subir</span></button>
            </div>
                ";

$ReporteAnalisis =    "
                            <div class=\"row alert alert-info\">
                                <div class=\"col-xs-4\">
                                    <i class=\"fa fa-files-o fa-3x\" ></i>
                                </div>
                                <div class=\"col-xs-8 text-right\">
                                    Se recibieron $NumArchivos archivos de Nómina. 
                                </div>
                            </div>


                            <div class=\"row alert alert-success\">
                                <div class=\"col-xs-4\">
                                    <i class=\"fa fa-gears fa-3x\" ></i>
                                </div>
                                <div class=\"col-xs-8 text-right\">
                                    Se Analizan $NumArchivos archivos de Nómina. 
                                </div>
                            </div>

                            <div class=\"row alert alert-danger\">
                                <div class=\"col-xs-4\">
                                    <i class=\"fa fa-times-circle fa-3x\" ></i>
                                </div>
                                <div class=\"col-xs-8 text-right\">
                                   Después del análisis,  se detectaron $NumRegAna <a href=\"$ArchivoErr\" download> Errores.</a> 
                                </div>
                            </div>
                      ";


if ($Estatus == EXITO){
    $Icono = "<i class=\"fa fa-check-circle-o fa-5x\" style=\"color:#1ab394\"></i>";
    $Estat = "<span class=\"label label-primary\" 
            style=\"background-color: #1ab394;\">Correcto</span>";
    $ReporteAnalisis = "
                            <div class=\"row alert alert-info\">
                                <div class=\"col-xs-4\">
                                    <i class=\"fa fa-files-o fa-3x\" ></i>
                                </div>
                                <div class=\"col-xs-8 text-right\">
                                    Se recibieron 2 archivos de Nómina. 
                                </div>
                            </div>


                            <div class=\"row alert alert-success\">
                                <div class=\"col-xs-4\">
                                    <i class=\"fa fa-gears fa-3x\" ></i>
                                </div>
                                <div class=\"col-xs-8 text-right\">
                                    Se recibieron 2 archivos de Nómina. 
                                </div>
                            </div>             ";

     $BtonSubir = "";                   

}    
/**
$Icono="";
$Archivos="";
$Estat ="";
$ReporteAnalisis="";
$BtonSubir="";                   
**/
return "
        <div class=\"row\" >
            <div class=\"col-lg-12\">
                <div class=\"ibox float-e-margins\">
                    <div class=\"ibox-title\">
                        <h5>Resultado de Verificación de Productos de Nómina</h5>
                        <div class=\"ibox-tools\">
                            
                        </div>
                </div>
                <div class=\"ibox-content\">

                    <div class=\"row\">

                    <div class=\"col-sm-5 b-r\" style=\"background-color:#f5f5f5\">

                        <div style=\"text-align:center;vertical-align:middle;\">

                        $Icono
                        
                        
                        </div>

                        <br>
                        
                            <dl class=\"dl-horizontal\">
                                    <dt>Entidad:</dt> <dd><strong>$Organismo</strong></dd>
                                    <dt>Fecha Validacion:</dt> <dd>  $FechaProceso</dd>
                                    <dt>Hora:</dt> <dd> $HoraProceso </dd>
                                    <dt>Estatus:</dt> <dd>
                                                    $Estat </dd>
                                    
                                    <dt>Archivos Analizados:</dt> $Archivos

                            </dl>
                        
                        
                            $BtonSubir

                    </div>
                <div class=\"col-sm-7\" id=\"zona-de-resultados-val\">
                    <div class=\"ibox-content\">
                        $ReporteAnalisis

                    </div>     
                </div>         
                     ";


}// fin de obtenResultadosValidacion($TipoNomina)

/*********************************************************************
 * 
 * Funcion : fncBuildRow1
 * Objetivo: Construir los renglones osecciones  a mostrar
 *           
 * Parametros
 * $Qna:  Quincena Procesada
 * $FechaLim    :  Fecha Limite de recepcion de Archivos
 * $PanlesCarga: Paneles de carga a mostrar
 *
 **********************************************************************/

function fncBuildRow1($Qna, $FechaLim, $PanlesCarga){

$ArrArchivo = "archivo1.zip";

$ArrResultados = "2 Archivos Analizados";

$Organismo = $_SESSION['organismo'];

$Resultados ="" ; 
obtenResultadosValidacion(416,0,$ArrArchivo,$ArrResultados,"archivo1.txt",0);


	return "
    <div class=\"row wrapper border-bottom white-bg page-heading\">
                <div class=\"col-lg-10\">
                    
                    <ol class=\"breadcrumb\">
                        <li>
                            <a href=\"#\">Quincena $Qna </a>
                        </li>
                        <li>
                            <a href=\"#\"> $Organismo</a>
                        </li>
                        <li class=\"active\">
                            <strong>Recepción de Productos </strong>
                        </li>
                    </ol>
                </div>
            </div>

   <div class=\"wrapper wrapper-content animated fadeInRight\" id=\"main_page\">
    <div class=\"row\">





            $PanlesCarga




   <!-- SECCION DE RESULTADOS -->
<!--
        <div id=\"resultados\"  class=\"wrapper wrapper-content animated fadeInRight\">
-->
                $Resultados
                <div class=\"col-lg-12\" id=\"x00\"  style=\" text-align:center;vertical-align:middle\">
                <div>
                    <button class=\"btn btn-primary btn-lg\" type=\"button\" id=\"EnviarRemesa\">
                    <i class=\"fa fa-upload\"></i>&nbsp;Enviar Archivos</button>
                </div> 
                </div> 


<!--          
        </div> 
-->        
    <!-- FIN SECCION DE RESULTADOS -->

                        </div>
                    </div>
                </div>
              </div>
            </div>                     
          </div>	";
}


function fncBuildTopNavBar()
{

return "
	<div id=\"page-wrapper\" class=\"gray-bg dashbard-1\">
        <div class=\"row border-bottom\">
        <nav class=\"navbar navbar-static-top\" role=\"navigation\" style=\"margin-bottom: 0\">
            <div class=\"navbar-header\">
                <a class=\"navbar-minimalize minimalize-styl-2 btn btn-primary\" href=\"#\">
                    <i class=\"fa fa-bars\"></i> 
                </a>
            </div>
            <ul class=\"nav navbar-top-links navbar-right\">
                <li>
                    <span class=\"m-r-sm text-muted welcome-message\">
                    Sistema de Recepción de Productos de Nómina</span>
                </li>
                <li class=\"dropdown\">
                    <a class=\"dropdown-toggle count-info\" data-toggle=\"dropdown\" href=\"#\">
                        <i class=\"fa fa-bell\"></i>  <span class=\"label label-primary\">8</span>
                    </a>
                    <ul class=\"dropdown-menu dropdown-alerts\">
                        <li>
                            <a href=\"#\">
                                <div>
                                    <i class=\"glyphicon glyphicon-time \"></i> 
                                    Inicia perido de recepción
                                    <span class=\"pull-right text-muted small\">Hace 4 min. </span>
                                </div>
                            </a>
                        </li>
                        <li class=\"divider\"></li>
                        <li>
                            <a href=\"#\">
                                <div>
                                    <i class=\"glyphicon glyphicon-alert\">
                                    </i> Inconsistencia en archivos
                                    <span class=\"pull-right text-muted small\">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class=\"divider\" style=\" background-color:#D8D8D8\" ></li>
                        <li>
                            <a href=\"#\">
                                <div>
                                    <i class=\"glyphicon glyphicon-ok-sign\">
                                    </i> Quincena 5
                                    <span class=\"pull-right text-muted small\">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class=\"divider\"></li>
                        <li>
                            <div class=\"text-center link-block\">
                                <a href=\"#\">
                                    <strong>Todos los Avisos</strong>
                                    <i class=\"fa fa-angle-right\"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href=\"../index.php\">
                        <i class=\"fa fa-sign-out\"></i> Salir
                    </a>
                </li>
                <li>
                    <a class=\"right-sidebar-toggle\">
                        <i class=\"fa fa-tasks\"></i>
                    </a>
                </li>
            </ul>

        </nav>
        </div>";
} // fin de fncBuildTopNavBar



function fncBuildJS($Welcome,$DropZones)
{

$Biemvenida = "";
$Bandera="NO asigno";
if($Welcome === "inicial"){
$Biemvenida = " setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
            };
            toastr.success('Dirección General de Recursos Humanos','Secretaria de Salud');
            },1200);";
$Bandera="SI asigno";
}// fin del fin

return "
   <!-- Mainly scripts -->
    <script src=\"../js/jquery-2.1.1.js\"></script>
    <script src=\"../js/bootstrap.min.js\"></script>
    <script src=\"../js/plugins/metisMenu/jquery.metisMenu.js\"></script>
    <script src=\"../js/plugins/slimscroll/jquery.slimscroll.min.js\"></script>

    <!-- Flot -->
    <script src=\"../js/plugins/flot/jquery.flot.js\"></script>
    <script src=\"../js/plugins/flot/jquery.flot.tooltip.min.js\"></script>
    <script src=\"../js/plugins/flot/jquery.flot.spline.js\"></script>
    <script src=\"../js/plugins/flot/jquery.flot.resize.js\"></script>
    <script src=\"../js/plugins/flot/jquery.flot.pie.js\"></script>

    <!-- Peity  -->
    <script src=\"../js/plugins/peity/jquery.peity.min.js\"></script>
    <script src=\"../js/demo/peity-demo.js\"></script>

    <!-- Custom and plugin javascript  -->
    <script src=\"../js/inspinia.js\"></script>
    <script src=\"../js/plugins/pace/pace.min.js\"></script>

    <!-- jQuery UI -->
    <script src=\"../js/plugins/jquery-ui/jquery-ui.min.js\"></script>

    <!-- GITTER -->
    <script src=\"../js/plugins/gritter/jquery.gritter.min.js\"></script>

    <!-- Sparkline -->
    <script src=\"../js/plugins/sparkline/jquery.sparkline.min.js\"></script>
    

    <!-- Sparkline demo data  -->
    <script src=\"../js/demo/sparkline-demo.js\"></script>

    <!-- ChartJS-->
    <script src=\"../js/plugins/chartJs/Chart.min.js\"></script>

    <!-- Toastr -->
    <script src=\"../js/plugins/toastr/toastr.min.js\"></script>

     <!-- DROPZONE -->
    <script src=\"../js/plugins/dropzone/dropzone.js\"></script>
<!--
    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js\"></script>

  -->  
 

    <script>
        $(document).ready(function() {

            $Biemvenida

            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $(\"#flot-dashboard-chart\").length && $.plot($(\"#flot-dashboard-chart\"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: \"#d5d5d5\",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: [\"#1ab394\", \"#1C84C6\"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: 300,
                    color: \"#a3e1d4\",
                    highlight: \"#1ab394\",
                    label: \"App\"
                },
                {
                    value: 50,
                    color: \"#dedede\",
                    highlight: \"#1ab394\",
                    label: \"Software\"
                },
                {
                    value: 100,
                    color: \"#A4CEE8\",
                    highlight: \"#1ab394\",
                    label: \"Laptop\"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: \"#fff\",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: \"easeOutBounce\",
                animateRotate: true,
                animateScale: false
            };

            var ctx = document.getElementById(\"doughnutChart\").getContext(\"2d\");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [
                {
                    value: 300,
                    color: \"#a3e1d4\",
                    highlight: \"#1ab394\",
                    label: \"App\"
                },
                {
                    value: 140,
                    color: \"#dedede\",
                    highlight: \"#1ab394\",
                    label: \"Software\"
                },
                {
                    value: 200,
                    color: \"#A4CEE8\",
                    highlight: \"#1ab394\",
                    label: \"Laptop\"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: \"rgba(255,255,255,0.75)\",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: \"#fff\",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: \"easeOutBounce\",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById(\"polarChart\").getContext(\"2d\");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

        });

    </script>

<script>

$DropZones


</script>


<script>

$(\"body\").click(function(e){
 // alert('>' + e.target.id + '<  >' + e.target.type +'<');
  //  alert(document.querySelector('#cargaotravez'));

  if ((e.target.id===\"cargaotravez\" )|| (e.target.id===\"cargaotravezicon\")||(e.target.id===\"cargaotravezspan\"))
   {
       // alert('a cargar otra vez ');
        //$('#x00').load(\"../ptfma_dropzone.php\");
        //window.open(\"ptma_opcd.php\");
        window.location.href = \"ptma_opcd.php\";
   }  
   
}); // 





</script>

	";

} // fin de fncBuildJS


function fncBuildHead()
{

return " 	
		<!DOCTYPE html>
		<html>

		<head>

		    <meta charset=\"utf-8\">
		    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

		    <title>Secretaria de Salud</title>

		    <link href=\"../css/bootstrap.min.css\" rel=\"stylesheet\">
		    <link href=\"../font-awesome/css/font-awesome.css\" rel=\"stylesheet\">

		    <!-- Toastr style -->
		    <link href=\"../css/plugins/toastr/toastr.min.css\" rel=\"stylesheet\">

		    <!-- Gritter -->
		    <link href=\"../js/plugins/gritter/jquery.gritter.css\" rel=\"stylesheet\">


            <link href=\"../css/animate.css\" rel=\"stylesheet\">
            <link href=\"../css/style.css\" rel=\"stylesheet\">            

            <link href=\"../css/plugins/dropzone/basic.css\" rel=\"stylesheet\">
            <link href=\"../css/plugins/dropzone/dropzone.css\" rel=\"stylesheet\">



		</head>";
} // fin de fncBuildHead


function fncBuildBody($ConfiguracionPanels)
{
    $ConfiguracionPanels;
    $DatosConfig = explode("|", $ConfiguracionPanels);
    $HeaderConfig =$DatosConfig[CERO];
    $HeaderArray = explode("@", $HeaderConfig);
    $Anio = $HeaderArray[CERO];
    $Qna = $HeaderArray[UNO];
    $FechaLim = $HeaderArray[DOS];
    $MaxQna = $HeaderArray[TRES];
    $MaxLim = $HeaderArray[CUATRO];


	$PrimParte = fncBuildTopNavBar();
    $PanelesCarga = construyePanelesCarga($ConfiguracionPanels);
	$Row1= fncBuildRow1($Qna, $FechaLim, $PanelesCarga);

    $ListaQuincenas = construyeListaQnas($HeaderArray);
/**
$ConfiguracionPanels <br>
$DatosConfig[0]<br>
$Anio <br>
$Qna  <br>
$FechaLim <br>
**/

	return "

<body>

<br>


<table align=\"center\" height=\"60\" style=\"width: 100%\">
  <tr>
     <td width=\"40%\" align=\"left\"><img src=\"../images/logoSALUD_hoz.png\" width=\"289\" height=\"95\" /></td>
     <!--<td width=\"420\" align=\"left\">
     <img src=\"../images/70Salud.jpg\" width=\"375\" height=\"91\" /></td>-->
     <!--<td width=\"683\" align=\"right\">
     <div id=\"dominio\">Recepción Art. 74</div>

     
     </td>  -->  
     <td width=\"60%\" align=\"right\">
             <div class=\"col-lg-11\">
                    <h2> Dirección General de Recursos Humanos
                    
                    </h2>
        </div>

     
     </td>    
  </tr>
</table> 


    <div id=\"wrapper\">
        <nav class=\"navbar-default navbar-static-side\" role=\"navigation\">
            <div class=\"sidebar-collapse\">
                <ul class=\"nav metismenu \" id=\"side-menu\">
                    <li class=\"nav-header\">
                        <div class=\"dropdown profile-element\"> <span>
                            <img alt=\"image\" class=\"img-circle\" 
                            src=\"../img/profile_small.jpg\" />
                             </span>
                            <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\">
                            <span class=\"clear\"> <span class=\"block m-t-xs\"> 
                            <strong class=\"font-bold text-muted\">Noe Alvarez Salvador</strong>
                             </span> <span class=\"text-muted text-xs block\">
                             Responsable de Nómina <b class=\"caret\"></b></span> </span> </a>
                            <ul class=\"dropdown-menu animated fadeInRight m-t-xs\">
                                <li><a href=\"#\">Profile</a></li>
                                <li class=\"divider\"></li>
                                <li><a href=\"../index.php\">Salir</a></li>
                            </ul>
                        </div>
                        <div class=\"logo-element\">
                            Salud
                        </div>
                    </li>
<li>
                       <a id=\"timeline\" href=\"ptfma_timeline.php?id=Aguascalientes\" class=\"btn btn-w-m btn-outline btn-info \">
<i class=\"fa fa-calendar fa-2x pull-left\"></i>
<span class=\"nav-label pull-rigth\">buscar</span>
</a>

                    </li>

<li>
                       <a id=\"timeline\" href=\"ptfma_timeline.php?id=Aguascalientes\" class=\"btn btn-w-m btn-outline btn-info \">
<i class=\"fa fa-calendar fa-2x pull-left\"></i>
<span class=\"nav-label pull-rigth\">buscar</span>
</a>

                    </li>


<li>
                       <a id=\"timeline\" href=\"ptfma_timeline.php?id=Aguascalientes\" class=\"btn btn-w-m btn-outline btn-info \">
<i class=\"fa fa-calendar fa-2x pull-left\"></i>
<span class=\"nav-label pull-rigth\">buscar</span>
</a>

                    </li>


                    <li class=\"active\">
                        <a href=\"#\">
                          <i class=\"fa fa-th-large\"></i> 
                          <span class=\"nav-label\">Productos de Nómina</span> 
                          <span class=\"fa arrow\"></span></a>
                        <ul class=\"nav nav-second-level\">
                        <li>
                       <a id=\"timeline\" href=\"ptfma_timeline.php?id=Aguascalientes\" class=\"btn btn-w-m btn-outline btn-info \">
<i class=\"fa fa-calendar fa-2x pull-left\"></i>
<span class=\"nav-label pull-rigth\">buscar</span>
</a>

                        <li><a href=\"#\" id=\"Q74000\">
                        <button class=\"btn btn-default \" type=\"button\"><i class=\"fa fa-map-marker\"></i>&nbsp;&nbsp;Map</button>
                    </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=\"#\"><i class=\"glyphicon glyphicon-list-alt\"></i> 
                        <span class=\"nav-label\">Articulo 74</span><span class=\"fa arrow\"></span></a>
                        <ul class=\"nav nav-second-level collapse\">
                            <li><a href=\"#\" id=\"Q74000\">Historico</a></li>
                            <li><a href=\"#\" id=\"Q74006\">Quincena 6</a></li>
                            <li><a href=\"#\" id=\"Q74007\">Quincena 7</a></li>
                            <li><a href=\"#\" id=\"Q74100\">Siguientes </a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>

        $PrimParte

        $Row1
							";


} // fin de fncBuildBody

function fncBuildTail($JS)
{

return "
    <div class=\"spiner-example modal inmodal\" id=\"myModal4\" tabindex=\"-1\" 
    role=\"dialog\" aria-hidden=\"true\" style=\"display:none; position: absolute;\">
<br>
      <br>
      <br>

      <div class=\"sk-spinner sk-spinner-fading-circle\">

                         <div class=\"sk-circle1 sk-circle \" 
                                style=\"width: 300%;height: 300%;\"></div>

                            <div class=\"sk-circle2 sk-circle \" 
                                style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle3 sk-circle \" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle4 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle5 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle6 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle7 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle8 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle9 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle10 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle11 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
                            <div class=\"sk-circle12 sk-circle\" 
                            style=\"width: 300%;height: 300%;\"></div>
        </div>
    </div>
                







			$JS


<script>

		$('a').click(function(){
			var IdQna = event.target.id;
			var reg = new RegExp(/^Q[0-9]{1,3}/);


	  		//alert('Alguien Pulso >' + IdQna +'< estatus' + reg.test(IdQna) );


				if( reg.test(IdQna))
				{
					//alert('Elejiste ' + IdQna);

					//$('#page-wrapper').load( \"dashboard.php\" );


				}
                else {
                    if(IdQna == 'Qhis')
                     {   
                    // alert('antes');
                    var varhtml ='?'+ $('#Qhis').attr('href');
                    //alert(varhtml);
                    
                    $('#main_page').load( \"ptfma_historico.php\"+ varhtml);
                    return false;
                    }

                }



			}
		);

        $('#EnviarRemesa').click(function(){
            //var IdB = event.target.id;
            alert ('Enviar Remesa');
            }
        );



</script>
			</body>
			</html>
	";
} // fin de fncBuildTail


?>
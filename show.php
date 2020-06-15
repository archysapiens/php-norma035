<?php 

    include('../general/CnxGral.inc');
    // PARAMETRO RECIBIDO DE ARCHIVO HR_DER.PHP QUE VIENE DEL AUTOCOMPLITE
        $Id=$_POST['id'];  
    // FIN PARAMETRO RECIBIDO DE ARCHIVO HR_DER.PHP QUE VIENE DEL AUTOCOMPLITE    

    //include('../../general/conecxion.php');

    //include('../../general/CnxGral.inc');

    $link = fncConxBaseDatos(HOST, USU, PWD, BD );


    // INICIO CONSULTA QUE GENERA LA TABLA CON LAS FECHAS
        $sql=" select  *
        from  trns
        where id='$Id'";
    // FIN INICIO CONSULTA QUE GENERA LA TABLA CON LAS FECHAS

//    echo "$sql";

    $resultado = $link->query("SET lc_time_names = 'es_MX'");
    $resultado = $link->query($sql);
    $Table ="";
    $ContadorFecha=0;
    $DatePickers="";
    $DatePickersSet="";
    $VarFechas="";
    @$RazonSocial="";
    @$Nombre_Cliente="";
    @$Cliente="";
    @$NombreServicio ="";
    $Body="";
    // INICIO WHILE ENCARGADO DE GENERAR TODAS LAS FECHAS QUE COINCIDEN CON LA CONSULTA 
    while ($row=mysqli_fetch_array($resultado,MYSQLI_ASSOC))
    {
        $Rfc= ""; //$row['rfc'];
        $Curp = $row['curp'];
        $Nombre = $row['nombre'];
        $Body="
                 <div class=\"ibox-content\">
                            <form method=\"get\" class=\"form-horizontal\">
                                <div class=\"form-group \">
                                <label class=\"col-sm-2 control-label\">Número de Empleado</label>

                                    <div class=\"col-sm-8\">
                                    <input id=\"inputBuscar\" type=\"text\" class=\"form-control\" value=\"$Id\"></div>
                                </div>
                                <div class=\"hr-line-dashed\"></div>
                                <div class=\"form-group\"><label class=\"col-sm-2 control-label\">Filiación</label>
                                    <div class=\"col-sm-8\"><input type=\"text\" class=\"form-control\" value =\"$Rfc\"> 

                                    </div>
                                </div>
                                <div class=\"hr-line-dashed\"></div>
                                <div class=\"form-group\"><label class=\"col-sm-2 control-label\">CURP</label>

                                    <div class=\"col-sm-8\"><input type=\"text\" class=\"form-control\" name=\"password\" value =\"$Curp\"></div>
                                </div>
                                <div class=\"hr-line-dashed\"></div>
                                <div class=\"form-group\"><label class=\"col-sm-2 control-label\">Nombre del Empleado</label>

                                    <div class=\"col-sm-8\"><input type=\"text\" placeholder=\"Nombre del Empleado\" class=\"form-control\" value=\"$Nombre\"></div>
                                </div>

                                <div class=\"form-group has-warning\"><label class=\"col-sm-2 control-label\">Banco</label>

                                    <div class=\"col-sm-8\"><input type=\"text\" placeholder=\"Banco\" class=\"form-control\"></div>
                                </div>
                                <div class=\"form-group has-warning\"><label class=\"col-sm-2 control-label\">Banco Nuevo</label>

                                    <div class=\"col-sm-8\">
                                    <input type=\"text\" placeholder=\"Banco Nuevo\" class=\"form-control \"></div>
                                </div>


                                
                                <div class=\"hr-line-dashed\"></div>

                                <div class=\"hr-line-dashed\"></div>
                                <div class=\"form-group\"><label class=\"col-sm-2 control-label\">Clave del Servicio Profesional de Carrera (FUNCION)<br/>

                                </label>

                                    <div class=\"col-sm-8\">
                                        <div><label> <input type=\"radio\" checked=\"\" value=\"option1\" id=\"optionsRadios1\" name=\"optionsRadios\"> 01 </label></div>
                                        <div><label> <input type=\"radio\" value=\"option2\" id=\"optionsRadios2\" name=\"optionsRadios\"> 02</label></div>
                                    </div>
                                </div>
                                <div class=\"hr-line-dashed\"></div>
                                <div class=\"form-group\"><label class=\"col-sm-2 control-label\">Grupo Funcional</label>

                                    <div class=\"col-sm-8\"><label class=\"checkbox-inline\"> <input type=\"checkbox\" value=\"option1\" id=\"inlineCheckbox1\"> 1 </label> <label class=\"checkbox-inline\">
                                        <input type=\"checkbox\" value=\"option2\" id=\"inlineCheckbox2\"> 2 </label> <label class=\"checkbox-inline\">
                                        <input type=\"checkbox\" value=\"option3\" id=\"inlineCheckbox3\"> 3 </label></div>
                                </div>
                                <div class=\"hr-line-dashed\"></div>


<div class=\"col-sm-4 col-sm-offset-2\">
                                        <button class=\"btn btn-white\" type=\"submit\">Cancel</button>
                                        <button class=\"btn btn-primary\" type=\"submit\">Guardar Cambios</button>
</div>

</form>

            ";

    };
    mysqli_free_result($resultado);
    // FIN INICIO WHILE ENCARGADO DE GENERAR TODAS LAS FECHAS QUE COINCIDEN CON LA CONSULTA 

   

    echo "$Body";


?>


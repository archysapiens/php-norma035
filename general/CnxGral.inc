<?php
/*******************************************************
 *                                                     *
 *      Nombre  : CnxGral.inc                        *
 *      Objtvo  : Contiene las funciones Generales     *
 *                del sistema                          *
 *      Autor   : Noe ALvarez Salvador                 *
 *      Fecha   : 07-Dic-2015                          *
 *                                                     *
 *******************************************************/
/*****  local   *******/


define ("HOST","localhost");
define ("USU","root");
define ("PWD","");
define ("BD","trns");
$Path_Aplic = "llanito/";

define ("LIMITE_RESULTADOS",7);
$Empresa="Servicios Ecosheys";


/*******  la web *********/

/*
define ("HOST","200.52.83.41");
define ("USU","archysof_dvlp");
define ("PWD","4rch1s0ft");
define ("BD","archysoft_com_mx_dvlp");
$Path_Aplic = "";
**/




$SCRIPT     ="./cgi/stm31.js";

function fncConxBaseDatos($Host, $Usr, $Pwd, $BD ){
global $Empresa;
     /* Connecting and  selecting database */
    $link = mysqli_connect($Host,$Usr,$Pwd,$BD);
     if (mysqli_connect_errno()) {
      printf("Error de conexión: %s\n", mysqli_connect_error());
      exit();
  }
    return $link;
}    /* fin  fncConxBaseDatos  */


?>

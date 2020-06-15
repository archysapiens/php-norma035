<?php
session_start();
include "../general/DBC.php";
include "../general/generales.inc";
include "ee_escritorio_modal.php";
include "ee_consulta.inc";

$_POST = $_SESSION ;

/*
foreach($_SESSION as $key => $value) 
{ 
    echo $key . " = " . $value . "<br>"; 
}
**/
/** Para distinguien entre una llamada despues de log in y una llamada ya en la
    operacion
**/    

$TipoMov="";
if(isset($_GET['tipo']))
	$TipoMov=$_GET['tipo'];

$OrigenLlamada=""; //r - ruteador m - multiperfil
if(isset($_GET['origen']))
	$OrigenLlamada=$_GET['origen'];


$Bienvenida="";
if(isset($_SESSION['modalidad']))
	$Bienvenida=$_SESSION['modalidad'];

$quincenaurl="";
if(isset($_GET['quincenaurl']))
	$quincenaurl=$_GET['quincenaurl'];

$anioquincenaurl="";
if(isset($_GET['anioquincenaurl']))
	$anioquincenaurl=$_GET['anioquincenaurl'];
/**
echo "Inciando <br>";
echo "quincenaurl >$quincenaurl< <br>";
echo "anioquincenaurl >$anioquincenaurl< <br>";
**/
/*
$Configuracion 	= configuraSesion($quincenaurl,$anioquincenaurl);

$Dropzones  	= construyeDropzones($Configuracion);
*/
$Dropzones ="";
$JS = fncBuildJS($Bienvenida,$Dropzones);

$Configuracion="a@b@c@d@e@f|a@b@c@d@e@f|a@b@c@d@e@f|a@b@c@d@e@f|a@b@c@d@e@f|a@b@c@d@e@f|";

$Hndl = fopen("../staging/ee_salidat.html", 'w');
/**
echo fncBuildHead();
echo fncBuildBody($Configuracion);
echo fncBuildTail($JS);
**/

//print_r($_SESSION);

fwrite($Hndl, fncBuildHead());
fwrite($Hndl, fncBuildBody($Configuracion));
fwrite($Hndl, fncBuildTail($JS));
fclose($Hndl);

readfile("../staging/ee_salidat.html");
exit;

?>
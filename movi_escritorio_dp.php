<?php
session_start();
include "../general/DBC.php";
include "../general/generales.inc";
include "movi_escritorio_dp.inc";

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

echo fncBuildHead();
echo fncBuildBody($Configuracion);
echo fncBuildTail($JS);

$_SESSION['modalidad']="operacion";



?>
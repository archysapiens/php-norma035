<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include "login.inc";

$ParamJS="";
$JS = fncDefJS($ParamJS);
$CSS = fncBuildCSS();
$Lib="";
$Title="";
$ParamBody="";
$Mensaje="";

if (isset($_GET['msg']))
	$Mensaje=" <span class=\"label label-primary\" 
            style=\"background-color: #F00404;\">" . $_GET['msg'] . "</span>";
$ParamBody=$Mensaje;

echo fncBuildHead($JS, $CSS, $Lib, $Title, $ParamBody);
echo fncBuildBody($ParamBody);
echo fncBuidTail($Lib,$Lib);



?>


<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

session_start();

$rutaJson='';
if(@$_GET['rutaJson']!=''){ $rutaJson = '../'.@$_GET['rutaJson']; }else{
	
	$callback= @$_GET['callback'];
	$nomJson= @$_GET['nomJson'];
	$carpetJson= @$_GET['carpetJson'];
	$rutaJson = $carpetJson.'/'.$nomJson.'.json';
}

$sord = $_GET['sord']; 
$sidx = $_GET['sidx'];
$page = $_GET['page']; 
$limit = $_GET['rows']; 
 
$str_datos = file_get_contents("$rutaJson");
// $datos = json_decode($str_datos,true);
 
print_r($str_datos);

?>
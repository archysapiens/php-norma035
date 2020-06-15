<?php

putenv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
putenv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib:/ipc/Informatica/9.5.1/server/bin:/oradev/instantclient_12_1");
include "../general/generales.inc";
require("../general/ac_db_inc.php");

function llenaListaMovimientos($Codigo){
	
$hndl= fopen("../staging/llenaListaMovimientos.dbg","w");

$sql= "SELECT MOVIMIENTO, NOMBRE FROM MOVI_PUESTO_MOV WHERE CODIGO like '%$Codigo%' and tipo like '%INCIDENCIA%'";

fwrite($hndl, $sql);
$DBCnnx = new DbOracle("pro_nnomina", "ArchiSoft");
$res = $DBCnnx->execFetchAll($sql, "Query Example");

$Lista="";
foreach ($res as $key ) {
			$Mov = $key['MOVIMIENTO'];
			$Nombre = $key['NOMBRE'];
			$Lista .= "<option value=$Mov> $Mov - $Nombre </option>";
		}
fclose($hndl);		
return 	$Lista;		
}// fin de llenaListaMovimientos


$Codigo="";
if (isset($_POST['codigo']))
	$Codigo=$_POST['codigo'];

echo llenaListaMovimientos($Codigo); 

?>
<?php

function preparaConsulta($StrTokens, $UR){

$Hndl = fopen("../staging/eecb_busqueda_sp_$UR.dbg", "w");

$ArrTokens = explode(" ", $StrTokens);
$ContadorTokens=CERO;
$TotalTokens = count($ArrTokens);

$QuerySelect = "SELECT /*+ parallel(MOVI_SERVIDORES_PUBLICOS,16)*/  sp.NUEMP, sp.RFC, sp.CURP, sp.NOMBRE, sp.PUESTO, sp.NUMPTO, nvl((SELECT DESCRIPCION FROM MOVI_PUESTOS WHERE CODIGO=sp.PUESTO),'') DESCRIPCION_PUESTO , nvl((SELECT RAMA FROM MOVI_PUESTOS WHERE CODIGO=sp.PUESTO),'') RAMA,  nvl((SELECT DESCRIPCION FROM MOVI_UR WHERE ur='$UR'),'') DESCRIPCION_UR FROM MOVI_SERVIDORES_PUBLICOS sp ";
$QueryOrder  = "ORDER BY  sp.RFC, sp.CURP, sp.NOMBRE, sp.PUESTO, sp.NUMPTO OFFSET 0 ROWS FETCH NEXT 9 ROWS ONLY ";

/** sE ELIMINO EL ur PARA PRUEBAS **/

$QuerySelect = "SELECT /*+ parallel(MOVI_SERVIDORES_PUBLICOS,16)*/  sp.NUEMP, sp.RFC, sp.CURP, sp.NOMBRE, sp.PUESTO, sp.NUMPTO, nvl((SELECT DESCRIPCION FROM MOVI_PUESTOS WHERE CODIGO=sp.PUESTO),'') DESCRIPCION_PUESTO , nvl((SELECT RAMA FROM MOVI_PUESTOS WHERE CODIGO=sp.PUESTO),'') RAMA,  '100' DESCRIPCION_UR FROM MOVI_SERVIDORES_PUBLICOS sp ";
$QueryOrder  = "ORDER BY  sp.RFC, sp.CURP, sp.NOMBRE, sp.PUESTO, sp.NUMPTO OFFSET 0 ROWS FETCH NEXT 9 ROWS ONLY ";


$QryWhere = "where sp.ur='$UR' and ";
/** sE ELIMINO EL ur PARA PRUEBAS **/

$QryWhere = "where  ";

//$QryWhere = "where ";
while($ContadorTokens < $TotalTokens){
	$Token =$ArrTokens[$ContadorTokens];
	if($ContadorTokens==CERO)
		$QryWhere .= " (sp.rfc like '%$Token%' or sp.CURP like '%$Token%'  or sp.nombre like '%$Token%' or sp.puesto like '%$Token%' ) ";
	else
		$QryWhere .= " and (sp.rfc like '%$Token%' or sp.CURP like '%$Token%'  or sp.nombre like '%$Token%' or sp.puesto like '%$Token%' )";
	$ContadorTokens++;
}// fin del while

fwrite($Hndl, $QuerySelect.$QryWhere.$QueryOrder);
fclose($Hndl);

return $QuerySelect.$QryWhere.$QueryOrder;

}// fin de preparaConsulta

?>
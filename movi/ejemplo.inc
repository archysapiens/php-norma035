<?php

function buscaMovimiento(//Parametros){

	$DBCnnx = new DbOracle("pro_nnomina", "ArchiSoft");

	$sql="Select * from movi_fomope";
	// si es consulta utilizar execFetchAll
	$res = $DBCnnx->execFetchAll($sql, "Query Example");	

	// SI es insert, update o delete usar

	$res_Tab = $DbTab->execute($sql, "pro_nnomina");


}// fin de buscaMovimiento


?>
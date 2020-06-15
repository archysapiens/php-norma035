<?php

require('../general/ac_db_inc.php');

$db = new DbOracle("test_db", "ArchiSoft");
	
	$datos=array();

	$CRITERIO = "%".strtoupper($_REQUEST['term'])."%";

	// CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE
		$sql="SELECT puestos_id,codigo, descripcion,  nivel_puesto
		FROM CtPuestos 
		WHERE codigo  LIKE :Patron OR 
		descripcion LIKE :Patron ";

		$res = $db->execFetchAll($sql, "Query Example", array(array(":Patron", $CRITERIO, -1)));

        $ContRes =0;
        foreach ($res as $row) {
			$Codigo = utf8_encode($row['CODIGO']);
			$Descripcion = utf8_encode($row['DESCRIPCION']);
			$datos[] = array("value" => utf8_encode($row['CODIGO']) ." - ".utf8_encode($row['DESCRIPCION']) ,
					"CODIGO" => utf8_encode($row['CODIGO'])	,
					"PUESTO_ID" => utf8_encode($row['PUESTOS_ID']),
					"NIVEL_PUESTO" => utf8_encode($row['NIVEL_PUESTO']),
					"DESCRIPCION" => $Descripcion,
			);
        }	
		echo json_encode($datos);
?>



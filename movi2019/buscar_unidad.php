<?php

require('../general/ac_db_inc.php');

$db = new DbOracle("test_db", "ArchiSoft");
	
	$datos=array();

	$CRITERIO = "%".strtoupper($_REQUEST['term'])."%";

	// CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE
		$sql="SELECT unidades_id,nombre_unidad, descripcion
		FROM CtUnidades 
		WHERE nombre_unidad  LIKE :Patron OR 
		descripcion LIKE :Patron ";

		$res = $db->execFetchAll($sql, "Query Example", array(array(":Patron", $CRITERIO, -1)));

        $ContRes =0;
        foreach ($res as $row) {
			$Nombre = utf8_encode($row['NOMBRE_UNIDAD']);
			$Descripcion = utf8_encode($row['DESCRIPCION']);
			$datos[] = array("value" => utf8_encode($row['NOMBRE_UNIDAD']) ." - ".utf8_encode($row['DESCRIPCION']) ,
					"UNIDADES_ID" => utf8_encode($row['UNIDADES_ID'])	  ,
					"NOMBRE_UNIDAD" => utf8_encode($row['NOMBRE_UNIDAD']) ,
					"DESCRIPCION" => $Descripcion,
			);
        }	
		echo json_encode($datos);
?>



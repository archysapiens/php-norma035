<?php

require('../general/ac_db_inc.php');

$db = new DbOracle("", "");
	
	$datos=array();

	$CRITERIO = "%".strtoupper($_REQUEST['term'])."%";

	// CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE

	$sql="SELECT cu.unidades_id,cu.nombre_unidad, cu.descripcion, pv.plazavacante_id, cap.DESCRIPCION as DenoPuesto
		FROM plazasvacantes_xa pv ,CtUnidades cu, CTCARGOPUESTO cap
		WHERE pv.unidades_id=cu.unidades_id and( 
		cu.nombre_unidad  LIKE :Patron OR 
		cu.descripcion LIKE :Patron) AND PV.CONVOCATORIA IS NULL and 
		pv.CARGOPUESTO_ID=cap.CARGOPUESTO_ID
		order by cu.nombre_unidad";

		$res = $db->execFetchAll($sql, "Query Example", array(array(":Patron", $CRITERIO, -1)));

        $ContRes =0;
        foreach ($res as $row) {
			$Nombre = utf8_encode($row['NOMBRE_UNIDAD']);
			$Descripcion = utf8_encode($row['DESCRIPCION']);
			$DenoPuesto =utf8_encode($row['DENOPUESTO']);
			$datos[] = array("value" => utf8_encode($row['NOMBRE_UNIDAD']) ." - ".utf8_encode($row['DESCRIPCION'])." - ".utf8_encode($DenoPuesto) ,
					"UNIDADES_ID" => utf8_encode($row['UNIDADES_ID'])	,
					"NOMBRE" => $Nombre	,
					"DESCRIPCION" => $Descripcion,
					"PLAZAVACANTE_ID" => $row['PLAZAVACANTE_ID'],
			);
        }	
		echo json_encode($datos);
?>



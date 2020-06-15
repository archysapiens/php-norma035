<?php
	//include('../../general/conecxion.php');
	include('../general/CnxGral.inc');
    

	$link = fncConxBaseDatos(HOST, USU, PWD, BD );

	$datos=array();

	$CRITERIO = $_REQUEST['term'];

	// CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE
		$sql="SELECT *
		FROM TRNS 
		WHERE ID LIKE '%$CRITERIO%' OR 
		RFC LIKE '%$CRITERIO%'  or
		NOMBRE LIKE '%$CRITERIO%'  
		group by ID";

		$resultado = $link->query($sql);
	// FIN CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE

	// WHILE ENCARGADO DE GENERAR TODOS LOS REGISTROS DE LOS CLIENTES CON SU NO CLIENTE, RAZON SOCIAL, NOMBRE, APP PATERNO, APP MATERNO 
        $ContRes =0;
		while (($row=mysqli_fetch_array($resultado,MYSQLI_ASSOC)) and $ContRes <LIMITE_RESULTADOS)
		{
			$Id = utf8_encode($row['id']);
			$Rfc = utf8_encode($row['rfc']);
			$datos[] = array("value" => utf8_encode($row['id']) ."  ".utf8_encode($row['nombre']) ,
					"id" => $Id	,
					"rfc" => $Rfc, 
					"nombre" => utf8_encode($row['nombre']), 
					"banco" => utf8_encode($row['banco']),
					"bancon" => utf8_encode($row['bancon']),
			);
			$ContRes++;
		}
		mysqli_free_result($resultado);

	// FIN WHILE ENCARGADO DE GENERAR TODOS LOS REGISTROS DE LOS CLIENTES CON SU NO CLIENTE, RAZON SOCIAL, NOMBRE, APP PATERNO, APP MATERNO 

	// CIERRA CONECXION Y TRANFORMA  JSON
		mysqli_close($link);
		echo json_encode($datos);
	// FIN CIERRA CONECXION Y TRANFORMA  JSON
?>



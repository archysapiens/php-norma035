<?php
// echo "Respondiendo desde buscar_area_resultado >>".$_POST['id'] ."<<";

require('../general/ac_db_inc.php');
$db = new DbOracle("test_db", "ArchiSoft");

$Area="";
if(isset($_POST['id']))
	$Area= $_POST['id'];
	
$datos=array();

$CRITERIO = "%".strtoupper($_REQUEST['term'])."%";

//CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE

	$sql="SELECT ca.areas_id,ca.nombre, ca.descripcion
	FROM plazasvacantes_xa pv ,CtAreas ca
	WHERE pv.areas_id=ca.areas_id and( 
	ca.nombre  LIKE :Patron OR 
	ca.descripcion LIKE :Patron) ";

	$res = $db->execFetchAll($sql, "Query Example", array(array(":Patron", $CRITERIO, -1)));

    $ContRes =0;
    foreach ($res as $row) {
		$Nombre = utf8_encode($row['NOMBRE']);
		$Descripcion = utf8_encode($row['DESCRIPCION']);
		$datos[] = array("value" => utf8_encode($row['NOMBRE']) ." - ".utf8_encode($row['DESCRIPCION']) ,
				"AREAS_ID" => utf8_encode($row['AREAS_ID'])	,
				"NOMBRE" => $Nombre	,
				"DESCRIPCION" => $Descripcion,
		);
    }	
	echo json_encode($datos);


?>



<?php

require('../general/ac_db_inc.php');

$Unidad = $_POST['id'];
$Plaza = $_POST['pzavteid'];

$db = new DbOracle("test_db", "ArchiSoft");
	
// CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE
$sql="SELECT count(*) as total
FROM plazasvacantes_xa 
WHERE unidades_id=:unidad and plazavacante_id=:pza";

$res = $db->execFetchAll($sql, "Query Example", array(array(":unidad", $Unidad, -1),
									array(":pza", $Plaza, -1)));

$TOTAL=-1;
foreach ($res as $row) {
	$TOTAL = utf8_encode($row['TOTAL']);
}	
echo $TOTAL;

?>



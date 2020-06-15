<?php
require('../general/ac_db_inc.php');

$Convocatoria = strtoupper ($_POST['convocatoria']) ;
$PzaVteId= $_POST['VacanteId'] ;


$db = new DbOracle("test_db", "ArchiSoft");

$sql = "update   PlazasVacantes_Xa 
	set CONVOCATORIA=:conv where plazavacante_id=:pzavteid";

$res = $db->execute($sql, "Query Example", array(array(":pzavteid", $PzaVteId, -1),
											array(":conv", $Convocatoria, -1)	));

?>
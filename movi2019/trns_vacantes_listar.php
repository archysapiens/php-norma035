<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require('../general/ac_db_inc.php');

$db = new DbOracle("test_db", "ArchiSoft");

session_start();

$HeadJQ= $_GET['callback'];

$sql =  "select pv.plazavacante_id as id, ca.descripcion as deno,
cp.DESCRIPCION as Puesto,cp.NIVEL_PUESTO, ca.nombre, cet.descripcion as edo, pv.convocatoria
from plazasvacantes_xa pv, ctareas ca, ctunidades cu, ctestadotrabajador cet, ctpuestos cp, CTCARGOPUESTO cap
where pv.areas_id=ca.areas_id and 
pv.unidades_id=cu.unidades_id and 
pv.ESTADOTRABAJDOR_ID=cet.estadotrabajador_id and
pv.PUESTOS_ID=cp.PUESTOS_ID and 
pv.CARGOPUESTO_ID=cap.CARGOPUESTO_ID
order by pv.plazavacante_id";		

	$Contador = 0;
	$BodyJS="";
    $res = $db->execFetchAll($sql, "Query Example");
    foreach ($res as $row) {
    	$ID=$row['ID'];
		$DENO=$row['DENO'];
		$Puesto=$row['PUESTO'];
		$Nivel =$row['NIVEL_PUESTO'];
		$Nombre=$row['NOMBRE'];
		$EDO=$row['EDO'];
		$CONVOCATORIA =$row['CONVOCATORIA'];

		if($Contador == 0 )
			$BodyJS.= "{id: \"$ID\", name: \"$DENO\", invdate: \"$Puesto\", note: \"$Nivel\",tax:\"$Nombre\" ,a:\"$EDO\",b:\"$CONVOCATORIA\" } ";
		else
			$BodyJS.= ",{id: \"$ID\", name: \"$DENO\", invdate: \"$Puesto\", note: \"$Nivel\",tax:\"$Nombre\",a:\"$EDO\",b:\"$CONVOCATORIA\" } ";
		$Contador++;
    }	

echo utf8_encode(" 
			$HeadJQ(
			{
			   \"page\":\"1\",
			   \"total\":1,
			   \"records\":\"3\", 
			   \"rows\":
			[
			 $BodyJS
			]
			 })");

?>
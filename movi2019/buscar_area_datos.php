<?php

require('../general/ac_db_inc.php');

$Area = $_POST['id'];
$PlazaVcanteId = $_POST['pzavteid'];

$db = new DbOracle("test_db", "ArchiSoft");
	
// CONSULTA QUE GENERA LOS DATOS EN EL AUTOCOMPLITE
$sql="select ca.nombre, cu.nombre_unidad, cet.descripcion as descripcion1, cp.CODIGO, cp.DESCRIPCION as descripcion21, 
		cap.DESCRIPCION as descripcion3,pv.PLAZAVACANTE_ID,nvl((select b.DESCRIPCION from ctareasuperior a, ctareasuperior b
                        where b.ur=a.AR_INMSUP AND a.UR= cu.NOMBRE_UNIDAD), 
                        (select a.DESCRIPCION
                         from ctareasuperior a
                          where a.UR= cu.NOMBRE_UNIDAD)) as descripcion2
from plazasvacantes_xa pv, ctareas ca, ctunidades cu, ctestadotrabajador cet, 
				ctpuestos cp , CTCARGOPUESTO cap
where pv.areas_id=ca.areas_id and 
pv.unidades_id=cu.unidades_id and
pv.ESTADOTRABAJDOR_ID=cet.estadotrabajador_id and
pv.PUESTOS_ID=cp.PUESTOS_ID and
pv.CARGOPUESTO_ID=cap.CARGOPUESTO_ID and pv.PLAZAVACANTE_ID=:PzaVteId";

$res = $db->execFetchAll($sql, "Query Example", array(array(":PzaVteId", $PlazaVcanteId, -1)));

        $ContRes =0;
        foreach ($res as $row) {
			//$Nombre = utf8_encode($row['NOMBRE']);
			$Descripcion1 = utf8_encode($row['DESCRIPCION1']);
			$Descripcion2 = utf8_encode($row['DESCRIPCION3']);
			$Descripcion3 = utf8_encode($row['DESCRIPCION2']);
			$StrResultado =$Descripcion2."|".$Descripcion3."|".$Descripcion1;

        }	
		//echo json_encode($StrResultado);
		echo $StrResultado;
?>



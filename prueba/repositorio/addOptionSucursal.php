<?php
sleep(1);
require('../bd/bd.php');

$db = new DbCnnx();

if($_REQUEST)
{
	$nameSucursal= $_REQUEST['nameSucursal'];
	
	$QuerySearch = "select NOMBRE from alta_sucursal where NOMBRE = '".strtolower($nameSucursal)."'";
	$rec = $db->combo($QuerySearch);
	$count = 0;
	while ($row = $rec->fetch_assoc()) {
		$count++;
		$rows[] = $row;
	}
	if (@$count>0){echo "Sucursal existente";}
	else{
	$Query = "INSERT INTO alta_sucursal VALUE(DEFAULT,'$nameSucursal')";
	$rec = $db->query($Query);
	}

}?>

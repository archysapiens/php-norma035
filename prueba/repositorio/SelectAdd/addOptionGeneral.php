<?php
sleep(1);
require('../../bd/bd.php');

$db = new DbCnnx();

if($_REQUEST)
{
	@$nameCampoAdd= utf8_decode($_REQUEST['nameCampoAdd']);	
	@$nameSelectAdd= utf8_decode($_REQUEST['nameSelectAdd']);
	@$valueCorreo= utf8_decode(@$_REQUEST['valueCorreo']);
	@$valueContrasena= utf8_decode(@$_REQUEST['valueContrasena']);
	$QuerySearch = "select NOMBRE from $nameSelectAdd where NOMBRE = '".strtolower($nameCampoAdd)."'";
	
	$rec = $db->combo($QuerySearch);
	$count = 0;
	while ($row = $rec->fetch_assoc()) {
		$count++;
		$rows[] = $row;
	}
	if (@$count>0){echo "Campo existente";}
	else{
		$Query = "INSERT INTO $nameSelectAdd VALUE(DEFAULT,'$nameCampoAdd')";
		$rec = $db->query($Query);
		// if($valueCorreo!='' and $valueContrasena!=''){
			// $Query = "INSERT INTO usuarios VALUE(DEFAULT,'0','$nameCampoAdd','','','$valueCorreo','','','TECNICO','','','',NOW(),'$valueCorreo','$valueCorreo','TOLUCA','A')";
			// $rec = $db->query($Query);
		// }
		
	}

}?>

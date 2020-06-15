<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../general/CnxGral.inc';
//include 'lista_tecnico.inc';

$HndConx= fncConxBaseDatos(HOST, USU, PWD, BD );
session_start();
$HeadJQ= $_GET['callback'];

$SQL=" SELECT  id,  rfc,  curp,  nombre,  sar,  banco,
  				bancon,  cuenta,  clabe,  funcion
		FROM trns
		order by id	";		

	$result = mysqli_query($HndConx, $SQL);

	
	$BodyJS="";
	$Contador=0;
	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{

		$Id=$row['id'];
		$Rfc=$row['rfc'];
		$Curp =$row['curp'];
		$Nombre=$row['nombre'];
		$Sar=$row['sar'];
		$Banco =$row['banco'];
		$Bancon =$row['bancon'];

		if($Contador ==0)
			$BodyJS.= "{id: \"$Id\", name: \"$Rfc\", invdate: \"$Curp\", note: \"$Nombre\",tax:\"$Sar\" ,a:\"$Banco\",b:\"$Bancon\" } ";
		else
			$BodyJS.= ",{id: \"$Id\", name: \"$Rfc\", invdate: \"$Curp\", note: \"$Nombre\",tax:\"$Sar\",a:\"$Banco\",b:\"$Bancon\" } ";
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
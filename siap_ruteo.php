<?php
//include "./general/DBC.php";
include "./general/generales.inc";
require("./general/ac_db_inc.php");
 
echo "Inicia programa <br>";

$ArrUsuarioInterfaz = explode("@",$_POST['inputUsuario']);

$UsuarioInterfaz = $ArrUsuarioInterfaz[0];

$Usuario = $_POST['inputUsuario'];

$Passwd = $_POST['inputPassword'];



echo "Consulta <br>";

$sql = "SELECT count(*) as existe FROM usuarios usu  where usu.id='" . 
		$Usuario .	"'  AND usu.password='" . 
		$Passwd."'";


echo "sql >$sql< <br>";


//$db = new DbOracle("test_db", "ArchySoft");

echo "Antes del execFetchAll";

//$res = $db->execFetchAll($sql, "Query Example");

echo "Antes del If";

if($Usuario == "personal@salud.gob.mx")
	header("location: smweb/siap_personal.php");
elseif ($Usuario == "ur@salud.gob.mx")
	//header("location: smweb/smweb_escritorio.php");
	header("location: smweb_multi_perfil.php");
elseif ($Usuario == "ura.ssamx@gmail.com")
	header("location: smweb/smweb_escritorio_ura.php");
elseif ($Usuario == "ip.ssamx@gmail.com")
	header("location: smweb/smweb_escritorio_ip.php");
elseif ($Usuario == "dpssamx5@gmail.com")
	header("location: smweb/smweb_escritorio_dp.php");
elseif ($Usuario == "spc.ssamx@gmail.com")
	header("location: smweb/smweb_escritorio_spc.php");
else
	header("location: index.php");

?>
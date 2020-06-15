<?php
include('clases/class.combos.php');
require('../../bd/bd.php');

$municipios = new selects();
$municipios->code = $_GET["code"];
$municipios = $municipios->cargarMunicipios();
foreach($municipios as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
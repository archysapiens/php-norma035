<?php
include('clases/class.combos.php');
require('../../bd/bd.php');

$selects = new selects();
$estados = $selects->cargarESTA();
foreach($estados as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>
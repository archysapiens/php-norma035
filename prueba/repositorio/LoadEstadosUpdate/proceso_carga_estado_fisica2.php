<?php
function generaEstadosFis()
{
require('../../bd/bd.php');
$db = new DbCnnx();
		$SQL ="SELECT DISTINCT UPPER(estado) as estado
										FROM zonas_final 
										where estado='DISTRITO FEDERAL' 
										OR estado='ESTADO DE MEXICO' 
										OR estado='QUERETARO'
										OR estado='PUEBLA'
										OR estado='MICHOACAN DE OCAMPO'
										OR estado='MORELOS'
										OR estado='HIDALGO'
										ORDER BY estado ASC";
		$rec = $db->combo($SQL);
										
									
  //desconectarFisica();
	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='estadoFi' id='estadoFi'  class='form-control estadoFi' onChange='cargaContenidoFisica2(this.id)'>";
	echo "<option value='' style='display:none'>Selecciona Opci&oacute;n</option>";

	while ($row = $rec->fetch_assoc()) {
			echo"<option value=".$row['estado'].">".$row['estado']."</option>";
		}
	echo "</select>";

}
?>

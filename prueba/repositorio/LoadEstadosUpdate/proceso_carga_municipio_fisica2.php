<?php


// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"estadoMFi"=>"zonas_final",
"municipioFi"=>"zonas_final"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}



$selectDestino=$_GET["select"];

$opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) )
{
	$tabla=$listadoSelects[$selectDestino];

//	include('../../general/conexion_persona_fisica.php');
//	conectarFisica();
	
	
	$db = new DbCnnx();
		$SQL = "SELECT DISTINCT UPPER(mnpio) as mnpio FROM $tabla WHERE estado='$opcionSeleccionada ' order by mnpio asc";
		$rec = $db->combo($SQL);
		

	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id= '".$selectDestino."'   class='form-control municipioFi' onChange='cargaContenidoFisica2(this.id);'>";
	echo "<option value='' style='display:none'>Selecciona Opci&oacute;n</option>";
	while ($row = $rec->fetch_assoc()) {
			// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
			echo"<option value=".$row['mnpio'].">".$row['mnpio']."</option>";
		}
	echo "</select>";
}
?>

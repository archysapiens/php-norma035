<?php

class selects
{
	
	var $code = "";
	
	function cargarESTA()
	{
		$db = new DbCnnx();
	//	$consulta = parent::consulta("SELECT DISTINCT UPPER(estado) FROM zonas_final  ORDER BY estado ASC");
		$consulta = sprintf("SELECT DISTINCT UPPER(estado)
										FROM zonas_final 
										where estado='DISTRITO FEDERAL' 
										OR estado='ESTADO DE MEXICO' 
										OR estado='QUERETARO'
										OR estado='PUEBLA'
										OR estado='MICHOACAN DE OCAMPO'
										OR estado='MORELOS'
										OR estado='HIDALGO'
										ORDER BY estado ASC");
		$rec = $db->combo($consulta);
		$count = 0;
		$estados = array();
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$code = $row["UPPER(estado)"];
			$name = $row["UPPER(estado)"];				
			$estados[$code]=$name;
		}
		if($count > 0){ return $estados; }
            else{ return false; }
		
	}
	function cargarMunicipios()
	{
		$db = new DbCnnx();
		$consulta = sprintf("SELECT DISTINCT UPPER(mnpio) FROM zonas_final WHERE estado like '".$this->code."' order by  mnpio asc");
		//$sql = "select DISTINCT UPPER(mnpio) from zonas_final where estado  like '$nombre_estado%' order by  mnpio asc";
		$rec = $db->combo($consulta);
		$count = 0;
		$municipios = array();
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$name = $row["UPPER(mnpio)"];				
			$municipios[$name]=$name;
		}
		if($count > 0){ return $municipios; }
            else{ return false; }
		
	}
		
	function cargarCiudades()
	{
		$db = new DbCnnx();
		$consulta = sprintf("SELECT DISTINCT CP FROM zonas_final WHERE mnpio like '".$this->code."' order by  CP asc");
		$rec = $db->combo($consulta);
		$count = 0;
		$ciudades = array();
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$name = $row["CP"];				
			$ciudades[$name]=$name;
		}
		if($count > 0){ return $ciudades; }
            else{ return false; }
		
	}		

	
	function cargarLocalidades()
	{
		$db = new DbCnnx();
		$consulta = sprintf("SELECT DISTINCT UPPER(asenta) FROM zonas_final WHERE cp like '".$this->code."' order by asenta asc");
		$rec = $db->combo($consulta);
		$count = 0;
		$localidades = array();
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$name = $row["UPPER(asenta)"];				
			$localidades[$name]=$name;
		}
		if($count > 0){ return $localidades; }
            else{ return false; }
		
	}		
function cargarESTASUC()
	{
		$consulta = parent::consulta("SELECT DISTINCT UPPER(estado) FROM zonas_final ORDER BY estado ASC");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$estados = array();
			while($esta = parent::fetch_assoc($consulta))
			{
				$code = $esta["UPPER(estado)"];
				$name = $esta["UPPER(estado)"];				
				$estados[$code]=$name;
			}
			return $estados;
		}
		else
		{
			return false;
		}
	}
	function cargarMunicipiosSUC()
	{
		$consulta = parent::consulta("SELECT DISTINCT UPPER(mnpio) FROM zonas_final WHERE estado like '".$this->code."' order by  mnpio asc");
		//$sql = "select DISTINCT UPPER(mnpio) from zonas_final where estado  like '$nombre_estado%' order by  mnpio asc";
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$municipios = array();
			while($muni = parent::fetch_assoc($consulta))
			{
				$name = $muni["UPPER(mnpio)"];				
				$municipios[$name]=$name;
			}
			return $municipios;
		}
		else
		{
			return false;
		}
	}
		
	function cargarCiudadesSUC()
	{
		$consulta = parent::consulta("SELECT DISTINCT CP FROM zonas_final WHERE mnpio like '".$this->code."' order by  CP asc");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$ciudades = array();
			while($ciudad = parent::fetch_assoc($consulta))
			{
				$name = $ciudad["CP"];				
				$ciudades[$name]=$name;
			}
			return $ciudades;
		}
		else
		{
			return false;
		}
	}		

	
	function cargarLocalidadesSUC()
	{
		$consulta = parent::consulta("SELECT DISTINCT UPPER(asenta) FROM zonas_final WHERE cp like '".$this->code."' order by asenta asc");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$localidades = array();
			while($loca = parent::fetch_assoc($consulta))
			{
				$name = $loca["UPPER(asenta)"];				
				$localidades[$name]=$name;
			}
			return $localidades;
		}
		else
		{
			return false;
		}
	}		
}

?>
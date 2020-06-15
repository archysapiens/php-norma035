<?php 
   function conectar()
   {
	@$servidor="200.52.83.41";
	@$usuario="archysof_dvlp";
	@$password="4rch1s0ft";
	@$bd="archysoft_com_mx_dvlp";
	@$conexion=mysql_connect(@$servidor,@$usuario,@$password);
	if (!$conexion)
	{
		echo"ERROR AL CONECTARCE CON EL SERVIDOR";
		exit();
	}

	@$coneccion=mysql_select_db(@$bd,@$conexion);

	if (!@$coneccion)
	{
		echo"ERROR AL ABRIR LA BASE DE DATOS";
		exit();
	}
     	return (@$conexion);
   }
?>
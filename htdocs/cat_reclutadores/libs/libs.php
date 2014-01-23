<?php
//*********************************************************************
//Nombre: clase funciones.
//Funcion del Modulo: Guadar la funciones que se ocuparan.
//Fecha: 06/05/2013
//Relizo: Ricardo Lugo Recillas
//*********************************************************************	

 class funciones {

 	public function conectar()
 	{
	 	$host = "localhost";
		$user = "root";
		$passwd ="";
		$db = "bdupgenia";
		$conexion=mysql_connect($host,$user,$passwd,$db) or die(mysql_error());
		$selecDB=mysql_select_db($db,$conexion)or die(mysql_error());

 	}
	
	function desconectar()
	{
	      //mysqli_close($conexion);
	}




 }







?>
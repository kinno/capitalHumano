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
		$passwd ="admin";
		$db = "bdrh";
		$conexion=mysql_connect($host,$user,$passwd,$db) or die(mysql_error());
		$selecDB=mysql_select_db($db,$conexion)or die(mysql_error());

 	}


 	function combo()
 	{ 
 		
 		$this->conectar();
 		
 		 $sqlC="SELECT *  FROM  tblroles ";
 		$queryC=mysql_query($sqlC) or die(mysql_error());
 		while($row=mysql_fetch_array($queryC))
 		{
 			echo"<option value=".$row['idRol'].">".$row['nomRol']."</option>";

 		}
 		

 	}
 	function comboLimitado($Valor){
 		
 		$this->conectar();
 		$sqlC1="SELECT *  FROM  tblroles where idRol =".$Valor;
 		$queryC1=mysql_query($sqlC1) or die(mysql_error());
 		$nomRol=mysql_result($queryC1,0,'nomRol');
 		echo"<option value='".$Valor."'>".$nomRol."</option>";


 		
 		$sqlC="SELECT *  FROM  tblroles where idRol !=".$Valor;
 		$queryC=mysql_query($sqlC) or die(mysql_error());
 		while($row=mysql_fetch_array($queryC))
 		{
 			echo"<option value=".$row['idRol'].">".$row['nomRol']."</option>";

 		}

 	}

 	function calcular_edad($fecha)
 	{
    $dias = explode("-", $fecha, 3);
    $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
    $edad = (int)((time()-$dias)/31556926 );
    return $edad;
	}
 	

 	

 	




 }







?>
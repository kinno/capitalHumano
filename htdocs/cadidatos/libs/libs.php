<?php
//*********************************************************************
//Nombre: clase funciones.
//Funcion del Modulo: Guadar la funciones que se ocuparan.
//Fecha: 06/05/2013
//Relizo: Ricardo Lugo Recillas
//*********************************************************************	
header("Content-Type: text/html;charset=utf-8");

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
	function ComboPIdiomas($id) //regresa un combo box con los porcentajes para los idiomas
	{
   
    $combo="<select class='sel' id='idiomas".$id."'>";
    $combo.="<option value='vacio'>Porcentaje</option>";
    for($i=0;$i<10;$i++){
        $j=($i+1)*10;
    $combo=$combo."<option value=$j>$j</option>";
    //.">".($i+1)*10."</option>";
    }
    $combo=$combo."</select></span>";
    return $combo;
	}
	
	function desconectar()
	{
	      //mysqli_close($conexion);
	}
	
	//Se carga el Arreglo de Años 1901 - Actual - 10
	function arrayAnio($val)
	{
		for($anio=(date ("Y") - 10); $anio>(date ("Y") - 80); $anio--){
			echo"<option value='".$anio."'>".$anio."</option>";
		}
	}

	//GMM001 - Llena combo de Estados
	function comboEstados($val)
 	{ 
 		$this->conectar();
 		if($val != '')
 		{
 			$sqlC="SELECT *  FROM  entidad_federativa where id_entidad !=".$val;
 			$sqlCI="SELECT *  FROM  entidad_federativa where id_entidad =".$val;
 			$queryI=mysql_query($sqlCI)or die('no se selecciona igual');
 			$rI=mysql_fetch_array($queryI);
 			echo"<option value='".$rI['id_entidad']."'>".mb_convert_encoding($rI['nombre_entidad'], "UTF-8")."</option>";
 		}
 		else
 		{
 			$sqlC="SELECT *  FROM  entidad_federativa";

 		}

 		
 		$queryC=mysql_query($sqlC) or die(mysql_error());
 		while($row=mysql_fetch_array($queryC))
 		{
 			echo"<option value=".$row['id_entidad'].">".mb_convert_encoding($row['nombre_entidad'], "UTF-8")."</option>";
 		}
 	}  		
 } 

?>


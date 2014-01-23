<?php 
include"libs.php";

$edo=(int)$_POST["elegido"];

//$mun=(int)$_POST["municipio"];


$mun=(int)$_POST["municipio"];


$funciones= new funciones;
$funciones->conectar();
$sqlC="SELECT * FROM codigo_postal where id_entidad=$edo and id_municipio=$mun order by nombre_colonia";
$queryC=mysql_query($sqlC) or die(mysql_error());
     echo"<option value='0'>Selecciona un Valor</option>";
	
  	while($row=mysql_fetch_array($queryC))
  	{
    	echo"<option value=".$row['id_colonia'].">".mb_convert_encoding($row['nombre_colonia'], "UTF-8")."</option>";
  	}  	
?>

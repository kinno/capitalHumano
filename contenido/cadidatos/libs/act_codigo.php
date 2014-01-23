<?php 
include"libs.php";

$edo=(int)$_POST["edo"];
$mun=(int)$_POST["mun"];
$col=(int)$_POST["col"];

$funciones= new funciones;
$funciones->conectar();
$sqlC="SELECT * FROM codigo_postal where id_entidad=$edo and id_municipio=$mun and id_colonia=$col";
$queryC=mysql_query($sqlC) or die(mysql_error());
  	while($row=mysql_fetch_array($queryC))
  	{
  		echo $row['cp'];
  		//<input type='text' class='texto' name='CodigoP' id='CodigoP' onkeypress='return soloNumeros(event)'>
    }  	   
?>

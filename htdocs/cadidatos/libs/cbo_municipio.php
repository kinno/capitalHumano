<?php 
include"libs.php";

$var= (int)$_POST["elegido"];

$funciones= new funciones;
$funciones->conectar();
$sqlC="SELECT * FROM municipio where id_entidad=$var";
$queryC=mysql_query($sqlC) or die(mysql_error());
  while($row=mysql_fetch_array($queryC))
  {
    echo"<option value=".$row['id_municipio'].">".mb_convert_encoding($row['nombre_municipio'], "UTF-8")."</option>";
  }	
?>





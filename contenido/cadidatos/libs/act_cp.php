<?php 
/*
	Actueliza Estado, Municipio y Colonias, cuando cambian CP
*/
include"libs.php";

$cp=$_POST["cp"];
$tipo=$_POST["tipo"];

$funciones= new funciones;
$funciones->conectar();

if($tipo=="cbo_colonia"){	
	$sqlC="SELECT * FROM codigo_postal where cp='$cp' order by nombre_colonia";
	$queryC=mysql_query($sqlC) or die(mysql_error());
	echo "<option value=0>Selecciona un valor</option>";
  	while($row=mysql_fetch_array($queryC))
  	{
    	echo"<option value=".$row['id_colonia'].">".mb_convert_encoding($row['nombre_colonia'], "UTF-8")."</option>";
  	}  	
  }

if($tipo=="act_estado"){	

	$sqlC="SELECT id_entidad FROM codigo_postal where cp='$cp' LIMIT 1";
	$queryC=mysql_query($sqlC) or die(mysql_error());
	while($row=mysql_fetch_array($queryC))
  	{
  		//Clave del Estado
    	$idestado=$row['id_entidad'];
  	}

  	$sqlC="SELECT *  FROM  entidad_federativa";
  	$queryC=mysql_query($sqlC) or die(mysql_error());
  	echo "<option value=0>Selecciona un valor</option>";
  	while($row=mysql_fetch_array($queryC))
 	{
 		$sel="";   //El Estado que aparecera seleccionado
 		if($idestado==$row["id_entidad"]){
 			$sel="selected='selected'";
		}
 		echo"<option value=".$row['id_entidad']."' ".$sel.">".mb_convert_encoding($row['nombre_entidad'], "UTF-8")."</option>"; 	
 	}					 
}

if($tipo=="act_municipio"){  

  $sqlC="SELECT id_entidad, id_municipio FROM codigo_postal where cp='$cp' LIMIT 1";
  $queryC=mysql_query($sqlC) or die(mysql_error());
  while($row=mysql_fetch_array($queryC))
    {
      //Clave del Municipio
      $idestado=$row['id_entidad'];
      $idmunicipio=$row['id_municipio'];
    }

    $sqlC="SELECT * FROM municipio where id_entidad='$idestado'";
    $queryC=mysql_query($sqlC) or die(mysql_error());
    echo "<option value=0>Selecciona un valor</option>";
    while($row=mysql_fetch_array($queryC))
  {
    $sel="";   //El Estado que aparecera seleccionado
    if($idmunicipio==$row["id_municipio"]){
      $sel="selected='selected'";
    }
    echo"<option value=".$row['id_municipio']."' ".$sel.">".mb_convert_encoding($row['nombre_municipio'], "UTF-8")."</option>";   
  }          
}

?>

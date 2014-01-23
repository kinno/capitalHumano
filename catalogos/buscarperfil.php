<?php
$idPerfil=$_POST['id']; //recuperamos el id
	 	$host = "localhost";
		$user = "root";
		$passwd ="admin";
		$db = "bdrh";
		$conexion=mysql_connect($host,$user,$passwd,$db) or die(mysql_error());
		$selecDB=mysql_select_db($db,$conexion)or die(mysql_error());
                mysql_query("set names 'utf8'");
$query="SELECT * FROM tblPerfil where idPerfil=".$idPerfil;
$queryB=mysql_query($query) or die(mysql_error());
$perfil[0]= array("perfil"   => mysql_result($queryB,0,'descPerfil'));
$perfil[1]= array("conoc"    => mysql_result($queryB,0,'conocPerfil'));
$perfil[2]= array("escoexpi" => mysql_result($queryB,0,'perfPerfil'));
$perfil[3]= array("habi"     => mysql_result($queryB,0,'habPerfil'));
print json_encode($perfil);
?>

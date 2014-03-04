<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folSolici = $_POST['folSolici'];
$idUsuario = $_POST['idUsuario'];
$descCancela = $_POST['descCancela'];
$obsCancela = $_POST['obsCancela'];
$dato = $vacantes->cancelar_vacante($folSolici, $idUsuario, $descCancela, $obsCancela);
echo $dato;
?>

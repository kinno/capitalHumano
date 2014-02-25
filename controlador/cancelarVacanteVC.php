<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folSolici = $_POST['folSolici'];
$idUsuario = $_POST['idUsuario'];
$dato = $vacantes->cancelar_vacante($folSolici, $idUsuario);
echo $dato;
?>

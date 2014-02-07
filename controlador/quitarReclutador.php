<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folSolici = $_POST['folSolici'];
$idReclutador = $_POST['idReclutador'];
echo $dato = $vacantes->quitar_reclutador($folSolici, $idReclutador)

?>

<?php
include_once("../libs/libvacantes.php");
$vacantes = new Vacantes();
$numVacante = $_POST['numVacante'];
$idCandid = $_POST['idCandid'];
$dato = $vacantes->asignar_candidato($numVacante, $idCandid);
    echo $dato;
?>

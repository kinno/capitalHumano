<?php
session_start();
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
 //$numVacante = $_POST['numVacante'];
 $idCandid = $_POST['idCandid'];
$folioVacante = $_POST['folioVacante'];
$dato = $vacantes->asignar_candidato($idCandid,$folioVacante,$_SESSION['id']);
    echo $dato;
?>

<?php
session_start();
$idUsuario = $_SESSION['id'];
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$idVacCand = $_POST['idVacCand'];
$fecEntrev= $_POST['fecha'];
$horEntrev = $_POST['hora'];
$nomEentrev = $_POST['entrevistador'];
$lugarEentrev = $_POST['lugar'];
$dato=$vacantes->agendaEntrevista($idVacCand, $fecEntrev, $horEntrev, $nomEentrev, $lugarEentrev, $idUsuario);
echo $dato;
        
?>

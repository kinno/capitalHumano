<?php
include_once("../libs/libvacantes.php");
$vacantes = new Vacantes();
$numVacante = $_POST['nVacante'];
$fecEntrev= $_POST['fecha'];
$horEntrev = $_POST['hora'];
$nomEentrev = $_POST['entrevistador'];
$lugarEentrev = $_POST['lugar'];
$ObsEntrev = $_POST['comentario'];
$statEntrev = $_POST['est'];
$dato=$vacantes->agendaEntrevista($numVacante, $fecEntrev, $horEntrev, $nomEentrev, $lugarEentrev, $ObsEntrev,$statEntrev);
echo $dato;
        
?>

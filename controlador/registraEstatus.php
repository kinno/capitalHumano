<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$idEntrev = $_POST['idEntrev'];
$est= $_POST['est'];
$observaciones = $_POST['observaciones'];

$dato=$vacantes->registra_estatus($idEntrev, $est, $observaciones);
echo $dato;
        
?>

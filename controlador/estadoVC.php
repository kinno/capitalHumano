<?php
session_start();
$idUsuario = $_SESSION['id'];
include_once '../funciones/libvacantes.php';
$vacantes = new Vacantes();
$idVacCand = $_POST['vacCand'];
$estado = $_POST['estado'];
$dato=$vacantes->estado_candidato($idVacCand, $estado,$idUsuario);
echo $dato;
?>

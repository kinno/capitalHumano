<?php
session_start();
$idUsuario = $_SESSION['id'];
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$datos=$vacantes->busca_entrevistas($idUsuario);
echo json_encode($datos);
//print_r($datos);
?>

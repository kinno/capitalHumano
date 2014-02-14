<?php
session_start();
include '../funciones/libCandidatos.php';
$candidato = new Candidato();
$dato = $candidato->modificarCandidato($_POST, $_SESSION['id']);
print_r($_POST);
echo $dato;
?>

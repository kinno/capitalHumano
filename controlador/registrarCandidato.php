<?php
session_start();
include '../funciones/libCandidatos.php';
$candidato = new Candidato();
$dato = $candidato->registrarCandidato($_POST, $_SESSION['id']);
echo $dato;
?>

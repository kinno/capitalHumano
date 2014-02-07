<?php
session_start();
include '../funciones/libCandidatos.php';
/*
 * echo '<pre>';
print_r($_POST);
echo '</pre>';
 * 
 */
$candidato = new Candidato();
$dato = $candidato->registrarCandidato($_POST, $_SESSION['id']);
echo $dato;
?>

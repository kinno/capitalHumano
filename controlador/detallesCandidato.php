<?php
include_once("../funciones/libCandidatos.php");
$candidato = new Candidato();
$idCandid = $_POST['idCandid'];
$dato = $candidato->detalles_candidato($idCandid);
print $dato;

?>

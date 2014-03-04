<?php
include_once '../funciones/libCandidatos.php';
$candidato = new Candidato();
$datos = $candidato->cambiar_estatus($_POST['idCandid']);
echo $datos;
?>

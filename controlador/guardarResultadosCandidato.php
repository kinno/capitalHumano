<?php

include '../funciones/libCandidatos.php';
$candidato = new Candidato();
$dato = $candidato->guardar_resultadosReferencia($_POST);
echo $dato;

?>

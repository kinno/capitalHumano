<?php
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->guarda_subproyecto($_POST['nomSubpry'],$_POST['idPry']);
echo $datos;
?>

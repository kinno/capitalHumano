<?php
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->actualiza_usuario($_POST);
echo $datos;
?>

<?php
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$dato = $catalogos->activa_usuario($_POST['id'], $_SESSION['id']);
echo $dato;
?>

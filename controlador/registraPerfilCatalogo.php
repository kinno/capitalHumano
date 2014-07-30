<?php
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->agrega_perfil($_POST, $_SESSION['id']);
echo $datos;
?>

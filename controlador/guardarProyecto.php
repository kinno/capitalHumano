<?php
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->guarda_proyecto($_POST['nomProyecto'], $_SESSION['id']);
echo $datos;
?>

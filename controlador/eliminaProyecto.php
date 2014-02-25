<?php
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->elimina_proyecto($_POST['idProyecto']);
echo $datos;
?>

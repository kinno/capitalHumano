<?php
include"../funciones/libCatalogos.php";
$catalogo = new Catalogos();
$respuesta=$catalogo->actualiza_lugar($_POST);
echo $respuesta;
?>

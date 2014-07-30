<?php

include"../funciones/libCatalogos.php";
$catalogo = new Catalogos();
$respuesta=$catalogo->agrega_lugar($_POST);
echo $respuesta;
?>

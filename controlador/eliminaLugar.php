<?php

include"../funciones/libCatalogos.php";
$catalogo = new Catalogos();
$respuesta=$catalogo->elimina_lugar($_POST['idlugar']);
echo $respuesta;
?>

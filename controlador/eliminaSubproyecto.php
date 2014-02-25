<?php
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->elimina_subproyecto($_POST['idSubproyecto']);
echo $datos;
?>

<?php
include_once("../funciones/funciones.php");
$idProyecto = $_POST['idProyecto'];
$listaSubproyec=ComboSubproyecto($idProyecto); 
echo $listaSubproyec;
?>

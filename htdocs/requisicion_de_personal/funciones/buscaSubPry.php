<?php
include_once("funciones.php");
$idProyecto = $_POST['idProyecto'];
$listaSubproyec=ComboSubproyecto($idProyecto); 
echo $listaSubproyec;
?>

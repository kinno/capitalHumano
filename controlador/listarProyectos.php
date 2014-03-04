<?php
include_once '../funciones/libCatalogos.php';
$proyectos = new Catalogos();
$datos = $proyectos->despliega_proyectos();
?>
<select id="idReclutador" onchange="reporteProyectos(this.value)">
    <option>Seleccione...</option>
    <?php
    foreach ($datos as $k => $v) {
        echo '<option value="'.$v['idProyecto'].'">'.$v['nomProyecto'].'</option>';
    }
    ?>
</select>
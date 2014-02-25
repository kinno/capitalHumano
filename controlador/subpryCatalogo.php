<?php
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos = $catalogos->despliega_subpry($_POST['idProyecto']);
$idProyecto = $_POST['idProyecto'];
?>
<div id="subProyectos" class="ui-widget ui-widget-content ui-corner-all"  style=" width: 915px; height: 400px; overflow-y: scroll;">
    <table class="ui-widget" width="100%">
        <tr class="head ui-state-default"><td style="font-size: 19px; padding:10px;" colspan="2">Subproyectos</td></tr>
        <?php
        foreach ($datos as $k => $v) {
        echo '<tr><td style="padding:5px;">'.$v['nomSubproy'].'</td><td><span class="elimsubpry" onclick="eliminarSubproyecto('.$v['idSubproyecto'].')" title="Eliminar subproyecto"></span></td></tr>';
        }
        ?>
    </table>
</div>
<center><span id="nvoSubproyecto" title="Agregar subproyecto" onclick="nuevoSubproyecto(<?echo $idProyecto;?>);">Agregar subproyecto</span></center>
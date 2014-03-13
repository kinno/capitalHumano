<?php
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos();
$datos=$catalogos->despliega_proyectos();
?>
<style>
    .prys:hover{
    cursor: pointer;
    font-weight: bold;
    background-color: #D4E7F6;
    }
    .active{
        cursor: pointer;
    font-weight: bold;
    background-color: #D4E7F6;
    }
    #proyectos td{
        max-width: 150px;
    }
</style>
    <table id="proyectos" class="ui-widget-content ui-widget ui-corner-all" border="1" cellspacing="1" style="padding:10px;text-align: center; float: left;">
            <tr class="head ui-state-default"><td style="font-size: 19px; padding:10px;" colspan="2">Proyecto:</td></tr>
            <?php
            foreach ($datos as $k => $v) {
                echo '<tr><td class="prys" style="padding:10px;" onclick="buscaSubpry('.$v['idProyecto'].',this);"><span>'.$v['nomProyecto'].'</span></td><td><span class="elimProyecto" onclick="eliminarProyecto('.$v['idProyecto'].')" title="Eliminar proyecto"></span></td></tr>';
            }
            ?>
            <tr><td colspan="2"><span id="nvoProyecto" title="Agregar proyecto" onclick="nuevoProyecto();">Agregar Proyecto</span></td></tr>
    </table>
<div style="float: left; margin-left: 15px;" id="subpryCont" >
</div>
<div id="panelNProyecto">
    <label for="nomProyecto">Nombre del Proyecto: </label>
    <input type="text" id="nomProyecto" id="nomProyecto">
    <span id="gproyecto" onclick="guardarProyecto();">Guardar</span>
</div>    
<div id="panelNSubproyecto">
    <input type="hidden" id="idPry">
    <label for="nomProyecto">Nombre del subproyecto: </label>
    <input type="text" id="nomsubproyecto" id="nomsubproyecto">
    <span id="gsubproyecto" onclick="guardarSubproyecto();">Guardar</span>
</div>




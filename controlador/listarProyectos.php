<?php
include_once '../funciones/libCatalogos.php';
$proyectos = new Catalogos();
$datos = $proyectos->despliega_proyectos();
?>
<div>
<div style="margin-top: 15px; float: left; margin-left: 23%">
    <fieldset style="max-width: 290px;">
        <legend>Proyectos</legend>
        <ul style="margin:0px; padding:0px;">
    <?php
        foreach ($datos as $k => $v) {
            echo '<li style="display:inline; margin: 0px 5px;"><div style="display:inline-block;"><input type="checkbox" id="pry'.$v['idProyecto'].'" class="idProyectos" value="'.$v['idProyecto'].'" />&nbsp;<span>'.$v['nomProyecto'].'</span></div></li>';
        }
    ?>
        </ul>
    </fieldset>    
</div>   
<div id="btnPeriodo" style="float:left; margin-left: 15px; margin-top: 15px;"><span>Periodo: </span><input type="radio" value="1" id="rAnual" name="radio1" onclick="abrePeriodo(1)"/><label for="rAnual">Anual</label><input type="radio" value="2" id="rPeriodo" name="radio1" onclick="abrePeriodo(2)"/><label for="rPeriodo">Periodo</label></div>
<div id="fechas" class="ui-state-active" style="display:none;float:left; margin-left: 15px; margin-top: 15px;" ><label for="periodoInicial">De:</label><input type="fecha" id="periodoInicial" class="ui-corner-all"/><label for="periodoFinal">A:</label><input type="fecha" id="periodoFinal" class="ui-corner-all"/></div>
<div style="float:left;margin-top: 15px; margin-left: 15px;"><span id="consultaReporte" onclick="reporteProyectos()">Consultar</span></div>
<div style="clear: both"></div>
</div>

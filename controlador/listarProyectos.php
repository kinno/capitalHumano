<?php
include_once '../funciones/libCatalogos.php';
$proyectos = new Catalogos();
$datos = $proyectos->despliega_proyectos();
?>
<div style="margin-left: 25%;">
<div style="margin-top: 15px; float: left">
    <label for="idProyectos">Proyecto: </label>
    <select style="width:250px;" class="ui-corner-all" id="idProyectos">
    <option value="">Seleccione...</option>
    <?php
    foreach ($datos as $k => $v) {
        echo '<option value="'.$v['idProyecto'].'">'.$v['nomProyecto'].'</option>';
    }
    ?>
</select>
</div>   
<div id="btnPeriodo" style="float:left; margin-left: 15px; margin-top: 15px;"><span>Periodo: </span><input type="radio" value="1" id="rAnual" name="radio1" onclick="abrePeriodo(1)"/><label for="rAnual">Anual</label><input type="radio" value="2" id="rPeriodo" name="radio1" onclick="abrePeriodo(2)"/><label for="rPeriodo">Periodo</label></div>
<div id="fechas" class="ui-state-active" style="display:none;float:left; margin-left: 15px; margin-top: 15px;" ><label for="periodoInicial">De:</label><input type="fecha" id="periodoInicial" class="ui-corner-all"/><label for="periodoFinal">A:</label><input type="fecha" id="periodoFinal" class="ui-corner-all"/></div>
<div style="float:left;margin-top: 15px; margin-left: 15px;"><span id="consultaReporte" onclick="reporteProyectos()">Consultar</span></div>
<div style="clear: both"></div>
</div>

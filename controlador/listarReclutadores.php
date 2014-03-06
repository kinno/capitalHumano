<?php
include_once '../funciones/libvacantes.php';
$reclutador = new Vacantes();
$datos = $reclutador->obtener_reclutadores();
?>
<div style="margin-left: 25%;">
<div style="margin-top: 15px; float: left">
     <fieldset>
        <legend>Reclutador</legend>
    <?php
    foreach ($datos as $k => $v) {
        echo '<input type="checkbox" class="idReclutador" value="'.$v['idUsuario'].'" /><span>'.$v['nomUsuario'].' '.$v['appUsuario'].' '.$v['apmUsuario'].'</span><br>';
    }
    ?>
    </fieldset>
</div>   
<div id="btnPeriodoR" style="float:left; margin-left: 15px; margin-top: 15px;"><span>Periodo: </span><input type="radio" value="1" id="rAnualR" name="radio2" onclick="abrePeriodoR(1)"/><label for="rAnualR">Anual</label><input type="radio" value="2" id="rPeriodoR" name="radio2" onclick="abrePeriodoR(2)"/><label for="rPeriodoR">Periodo</label></div>
<div id="fechasR" class="ui-state-active" style="display:none;float:left; margin-left: 15px; margin-top: 15px;" ><label for="periodoInicialR">De:</label><input type="fecha" id="periodoInicialR" class="ui-corner-all"/><label for="periodoFinalR">A:</label><input type="fecha" id="periodoFinalR" class="ui-corner-all"/></div>
<div style="float:left;margin-top: 15px; margin-left: 15px;"><span id="consultaReporteR" onclick="reporteReclutador()">Consultar</span></div>
<div style="clear: both"></div>
</div>
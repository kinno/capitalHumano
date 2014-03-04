<?php
include_once '../funciones/libvacantes.php';
$reclutador = new Vacantes();
$datos = $reclutador->obtener_reclutadores();
?>
<select id="idReclutador" onchange="reporteReclutador(this.value)">
    <option>Seleccione...</option>
    <?php
    foreach ($datos as $k => $v) {
        echo '<option value="'.$v['idUsuario'].'">'.$v['nomUsuario'].' '.$v['appUsuario'].' '.$v['apmUsuario'].'</option>';
    }
    ?>
</select>
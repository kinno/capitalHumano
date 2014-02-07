<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folio = $_POST['folioVacante'];
$dato = $vacantes->candidatos_registrados($folio);
echo '<div style="float:left;position:absolute;"><span id="plus" onclick="abreBusqueda();">Agregar candidato</span></div>';
echo '<div style="margin-left:150px;">
        <table border="0" style="width:100%" class="ui-corner-all">
            <tr >
                <td style="width:50%" class="ui-widget-header">Nombre del candidato</td><td class="ui-widget-header">Perfil</td>
            </tr>
        ';
                if(count($dato)>0){
                foreach ($dato as $k => $v) {
                    echo '<tr><td>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['nomCandid'].'</td><td>'.$v['conCandid'].'</td></tr>';
                }
                }
                else{
                    echo '<tr><td colspan="2">Aun no hay candidatos asignados</td></tr>';
                }
echo    '</table>
      </div>';
?>

 
<?php
session_start();
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folio = $_POST['folioVacante'];
$dato = $vacantes->candidatos_registrados($folio,$_SESSION['id']);
$idEstado=0;
echo '<div style="float:left;position:absolute;"><span id="plus" onclick="abreBusqueda();">Agregar candidato</span></div>';
echo '<div style="margin-left:150px;">
        <table border="0" style="width:100%" class="ui-corner-all">
            <tr >
                <td style="width:50%" class="ui-widget-header">Nombre del candidato</td><td class="ui-widget-header">Último estatus de entrevista</td>
            </tr>
        ';
                if(count($dato)>0){
                foreach ($dato as $k => $v) {
                    $estado = $vacantes->obtener_estadoCandidato($folio,'',$v['idCandid']);
                    foreach ($estado as $key => $value) {
                        $idEstado = $value['estatus'];
                    }
                    if($idEstado==1)
                        $color = 'style="background-color:#0ece1b"';
                    else if($idEstado==2)
                        $color = 'style="background-color:#a2d0f2"';
                    else if($idEstado==3)
                         $color = 'style="background-color:#ef5353"';
                     else {
                          $color = '';
                     }
                    echo '<tr '.$color.'><td>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
                    $estatusEntrevista = $vacantes->ultima_obsentrevista($v['idVacCand']);
                    if(count($estatusEntrevista)>0){
                        foreach ($estatusEntrevista as $key => $value) {
                            echo '<td>'.$value[0].'</td></tr>';
                        }
                    }
                    else{
                        echo '<td>--</td></tr>'; //Si no hay última observación
                    }
                }
                }
                else{
                    echo '<tr><td colspan="2">Aun no hay candidatos asignados</td></tr>';
                }
echo    '</table>
      </div>';
?>

 
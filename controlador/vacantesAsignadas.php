<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folSolici = $_POST['folSolici'];
$datos=$vacantes->datos_vacante($folSolici);
echo '<table style="width:100%;text-align:center;" id="tablaProyecto">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Proyecto</th>
                <th>Lider de Proyecto</th>
                <th>Perfil que se solicita</th>
                <th>Vacantes</th>
             </tr>
         </thead>
         <tbody>';
foreach ($datos as $k => $v) {
        echo '<tr><td id="idVacante">'.$v['folSolici'].'</td><td>'.$v['nomSubproy'].'</td><td>'.$v['liderProyecto'].'</td><td>'.$v['descPerfil'].'</td><td>'.$v['numVSolici'].'</td></tr>';
}       
echo '
         </tbody>
    </table>';


$datos=$vacantes->vacante_reclutador($folSolici);
echo 
    '<center><table style="width:100%;text-align:center;" class="ui-corner-all" id="tablaReclutadores">
        <thead>
            <tr>
                <th>Reclutador</th>
                <th>Vacantes Asignadas</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>';
    $i=0;
    foreach ($datos as $k => $v) {
       
    echo '<tr>
            <td><input type="hidden" id="id'.$i.'" value="'.$v['idReclutador'].'"/>'.$v['nomUsuario'].' '.$v['appUsuario'].' '.$v['apmUsuario'].'</td>
            <td>'.$v['asignadas'].'</td>
            <td><span onclick="eliminarReclutador('.$i.')" class="eliminar"></span><span onclick="abrirpanelReasignar('.$i.')" class="reasignar" title="Asigar a otro reclutador"></span></td>
        </tr>';
    $i++;
}

echo'   </tbody>
     </table>
     </center>
    <span onclick="abreVacantes();" id="back">Asignar reclutadores</span>
    <input type="hidden" id="panel">';
?>

    


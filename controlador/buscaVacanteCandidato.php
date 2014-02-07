<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folio = $_POST['folioVacante'];
$dato = $vacantes->candidatos_registrados($folio);

echo '<div style="float:left;position:absolute;" id="divCandidatos">
           <select id="cndidatos" onchange="buscaEntrevistas(this.value)">
                <option value="-1">Seleccione candidato...</option>';
        foreach ($dato as $k => $v) {
            echo '<option value="'.$v['idVacCand'].'">'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['nomCandid'].'</option>';
        }
echo '      </select>
        
        </div>';

echo '<div id="entrev" style="margin-left:200px; display:none;">
        
      </div>';
?>


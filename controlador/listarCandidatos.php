<?php 

include"../funciones/libCandidatos.php";
$candidato = new Candidato();
$datos=$candidato->obtener_candidatos();
?>
<span id="nuevoCandidato" onclick="abrirpanelAgregar();">Agregar candidato</span>
<table cellpadding="0" cellspacing="0" border="0" class="solicitudes" id="listaCandidatos">
    <thead >
        <tr class="head">

            <th>Nombre</th>
            <th>Escolaridad</th>
            <th>Grado</th>
            <th>Último salario</th>
            <th>Pretensiones min</th>
            <th>Pretensiones max</th>
            <th>Último estatus</th>
            <th>Acciones</th>

        </tr>
    </thead>
      <tbody>
        <?php

       $i=0;
       foreach($datos as $v)
       {
                   echo '<tr align=center valign=top>';

                   echo '<td id="candidato'.$i.'"><input type="hidden" id="idCandid'.$i.'" value="'.$v['idCandid'].'"/>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
                   echo '<td id="escolaridad"'.$i.'>'.$v['carreraCandid'].'</td>';
                   echo '<td id="estudios'.$i.'">'.$v['nlvestudiosCandid'].'</td>';
                   echo '<td id="salario'.$i.'">$'.$v['ultimosalarioCandid'].'</td>';
                   echo '<td id="pmin'.$i.'">$'.$v['pretensionesminCandid'].'</td>';
                   echo '<td id="pmax'.$i.'">$'.$v['pretensionesmaxCandid'].'</td>';
                   echo '<td id="conocimientos'.$i.'" style="background-color: '.$v['estatus'].'">'.$v['descEstatus'].'</td>';
                   echo '<td class="btnsDA"><button class="detalleCandidato" onclick="detalleCandidato('.$v['idCandid'].')" style="height:20px; width:30px;" title="Ver detalle"><button class="modificarCandidato" onclick="modificarCandidato('.$i.')" style="height:20px; width:30px;" title="Modificar datos"></button></td>';
                   echo '</tr>';
                   $i++;
            }
        ?>
    <tbody>
</table>
<div id="detalleCandidato" title="Detalle de candidato" class="overlay-container">
    <div id="contenedor">
        
    </div>
</div>

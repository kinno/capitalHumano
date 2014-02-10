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
            <th>Conocimientos</th>
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
                   echo '<td id="conocimientos'.$i.'">'.$v['conocimientosCandid'].'</td>';
                   echo '<td id="conocimientos'.$i.'" style="background-color: '.$v['estatus'].'">'.$v['descEstatus'].'</td>';
                   echo '<td class="btnsDA"><button class="detalleCandidato" onclick="detalleCandidato('.$v['idCandid'].')" style="height:20px; width:30px;" title="Ver detalle"><button class="modificarCandidato" onclick="modificarCandidato('.$i.')" style="height:20px; width:30px;" title="Modificar datos"></button></td>';
                   echo '</tr>';
                   $i++;
            }
        ?>
    <tbody>
</table>
<div id="detalleCandidato" class="overlay-container">
    <div id="contenedor">
        
    </div>
</div>

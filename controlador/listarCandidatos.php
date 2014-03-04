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
           $band=false;
           if($v['estatus']==1){
               $background="style='background-color:#0ece1b;'";
               $band = true;
           }
           if($v['estatus']==2)
               $background="style='background-color:#EDEF7D;'";
           if($v['estatus']==3)
               $background="style='background-color:#ef5353;'";
           if($v['estatus']==4)
               $background="style='background-color:#a2d0f2;'";
           
                   echo '<tr align=center valign=top '.$background.'>';
                   echo '<td id="candidato'.$i.'"><input type="hidden" id="idCandid'.$i.'" value="'.$v['idCandid'].'"/>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
                   echo '<td id="escolaridad"'.$i.'>'.$v['carreraCandid'].'</td>';
                   echo '<td id="estudios'.$i.'">'.$v['nlvestudiosCandid'].'</td>';
                   echo '<td id="salario'.$i.'">$'.$v['ultimosalarioCandid'].'</td>';
                   echo '<td id="pmin'.$i.'">$'.$v['pretensionesminCandid'].'</td>';
                   echo '<td id="pmax'.$i.'">$'.$v['pretensionesmaxCandid'].'</td>';
                   echo '<td id="conocimientos'.$i.'" style="background-color: '.$v['estatus'].'">'.$v['descEstatus'].'</td>';
                   echo '<td class="btnsDA"><button class="detalleCandidato" onclick="detalleCandidato('.$v['idCandid'].')" style="height:20px; width:30px;" title="Ver detalle">';
                        if($band){
                         echo '<button class="modificarCandidato" onclick="cambiarEstatus('.$v['idCandid'].')" style="height:20px; width:30px;" title="Liberar candidato"></button>';   
                        }
                   echo '</td>';
                   echo '</tr>';
                   $i++;
            }
        ?>
    <tbody>
</table>
<div id="descColores">
    <span style="color:#0ece1b;">&#9600;</span><span>Contratado</span>
    <span style="color:#EDEF7D;">&#9600;</span><span>Rechazado pero candidato a otra vacante</span>
    <span style="color:#ef5353;">&#9600;</span><span>Rechazado</span>
    <span style="color:#a2d0f2;">&#9600;</span><span>Disponible</span>
</div>
<div id="detalleCandidato" title="Detalle de candidato" class="overlay-container">
    <div id="contenedor">
        
    </div>
    <div id="msjRespuesta" style="display:none;">
        
    </div>
</div>

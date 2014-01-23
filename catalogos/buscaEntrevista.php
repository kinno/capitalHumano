<?php
include_once("libvacantes.php");
$vacantes = new Vacantes();
$numVacante = $_POST['numVacante'];
$dato = $vacantes->entrevista_especifica($numVacante);
?>
<article id="contenido">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="listaEntrevistas">

                <thead >
                    <tr>
                        <th>Candidato</th>
                        <th>Proyecto</th>
                        <th>Perfil</th>
                        <th>Fecha y hora</th>
                        <th>Lugar</th>
                        <th>Observaciones</th>

                    </tr>
                </thead>
                  <tbody>
                    <?php

                  
                   foreach($dato as $v)
                   {
                               echo '<tr align=center valign=top>';
                               echo '<td>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
                               echo '<td>'.$v['nomProyecto'].'</td>';
                               echo '<td>'.$v['descPerfil'].'</td>'; 
                               echo '<td>'.$v['fecEntrev'].'</td>';
                               echo '<td>'.$v['lugarEntrev'].'</td>';
                               echo '<td>'.$v['ObsEntrev'].'</td>';
                               echo '</tr>';
                              
                        }
                    ?>
                <tbody>
            </table>
</article>
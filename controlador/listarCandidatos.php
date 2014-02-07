<?php 

include"../funciones/libCandidatos.php";
$candidato = new Candidato();
$candid=$candidato->obtenerCandidatos();
?>

<table width="100%" cellpadding="0" cellspacing="0" border="0" id="listaCand">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Escolaridad</th>
      <th>Residencia</th>
      <th>Conocimientos</th>
      <th colspan=2>Acciones</th>
    </tr>
  </thead>
  <tbody>
   <?php
   foreach ($candid as $k => $v) {
       echo '<tr>';
       echo '<td>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
       echo '<td>'.$v['idEscolar'].'</td>';
       echo '<td>'.$v['id_entidad'].' '.$v['id_municipio'].'</td>';
       echo '<td>'.$v['conCandid'].'</td>';
       echo '<td width="10%"><a value="Acercar Ventana Modal" class="button" data-type="zoomin" onclick="on()">Modificar</a></td>';
       echo '<td width="10%"><a value="Acercar Ventana Modal" class="button" data-type="zoomin" onclick="referencias()">Referencias</a></td>';
       echo '</tr>';
   }
   ?>
   </tbody>
</table>
<div class="overlay-container">
  <center>
    <div class="window-container zoomin" id='mostrar'>         
    </div>
  </center>
</div>

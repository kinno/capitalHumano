<?php 
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos;
$datos = $catalogos->despliega_perfiles();

if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
 ?> 
<?php
echo '<div id="listado">';
if($permisosEspeciales==1)
    echo '<span class="nvoUsuario" onclick="panelNuevoUsuario();">Nuevo Perfil</span>';
?>
<table cellpadding="0" cellspacing="0" border="0" class="ui-widget solicitudes" id="listaPerfil">
<thead>
    <tr class="head">
        <th >Perfil</th>
        <th >Estudios</th>
        <th >Conocimientos</th>
        <th >Acciones</th> <!-- Campo de acciones para el cat�logo -->
    </tr>
</thead>
  <tbody>
    <?php
    foreach ($datos as $k => $v) {
               echo '<tr>';
               echo '<td >'.$v['descPerfil'].'</td>';
               echo '<td >'.$v['perfPerfil'].'</td>';


               echo '<td >'.$v['conocPerfil'].'</td>';
               if($permisosEspeciales==1){			   					   
                    echo '<td><span class="modPerfil" onclick="panelModPerfil('.$v['idPerfil'].')" title="Modificar"></span>';
                    if($v['fecbaja']=='')
                       {
                           echo '<span class="elimPerfil" onclick="eliminarPerfil('.$v['idPerfil'].')" title="Eliminar"></span>';
                       }
                   else
                       {
                           echo '<span class="activaPerfil" onclick="activaPerfil('.$v['usuario'].')" title="Activa"></span>';
                       }
               }else{

                     echo'<td></td>';
               }
               echo '</tr>';
    }
    ?>
</tbody>
</table>  
</div>    
<div id="nuevoUsuario" style="display:none" class="ui-widget">

</div>
<div id="modificaUsuario" title="Modificar Usuario">
        <div id="contModifica" class="ui-widget"></div>
</div>

  
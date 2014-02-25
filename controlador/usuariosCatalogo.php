<?php 
session_start();
include_once '../funciones/libCatalogos.php';
$catalogos = new Catalogos;
$datos = $catalogos->despliega_usuarios();

if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
 ?> 
<?php
echo '<div id="listado">';
if($permisosEspeciales==1)
    echo '<span class="nvoUsuario" onclick="panelNuevoUsuario();">Nuevo Usuario</span>';
?>
<table cellpadding="0" cellspacing="0" border="0" class="solicitudes ui-widget" id="listaUsuarios">
                <thead >
                    <tr class="head">
                        <th >Rol</th>
                        <th>Nombre</th>                        
                        <th>Usuario</th>                        
                        <th>Correo</th>
                        <th>Status</th>
                        <th >Acciones</th>                      
                    </tr>
                </thead>
                  <tbody>
                    <?php
                    foreach ($datos as $k => $v) {
                        
                        echo '<tr style="text-align:center;">';
                        echo    '<td>'.$v['nomRol'].'</td>';
                        echo    '<td>'.$v['nomUsuario'].' '.$v['appUsuario'].' '.$v['apmUsuario'].'</td>';
                        echo    '<td>'.$v['nickUsuario'].'</td>';
                        echo    '<td>'.$v['mailUsuario'].'</td>';
                            if($v['status']==1)
                                {
                                    echo '<td>Activo</td>';
                                }
                            else
                                {
                                    echo '<td>Inactivo</td>';
                                }
                                
                        if($permisosEspeciales==1){			   					   
                             echo '<td><button class="modUsuario" onclick="panelModUsuario('.$v['usuario'].')" title="Modificar"></button>';
                             if($v['status']==1)
                                {
                                    echo '<button class="elimUsuario" onclick="eliminarUsuario('.$v['usuario'].')" title="Eliminar"></button>';
                                }
                            else
                                {
                                    echo '<button class="activaUsuario" onclick="activaUsuario('.$v['usuario'].')" title="Activa"></button>';
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

  
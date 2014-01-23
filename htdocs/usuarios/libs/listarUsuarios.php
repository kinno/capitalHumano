<?php 
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
header("Content-Type: text/html;charset=utf-8");
include"../../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$sqlB="select * from tblusuarios";// order by idRol,nomUsuario, appUsuario, apmUsuario";
		$queryB=mysql_query($sqlB) or die(mysql_error());
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<script type="text/javascript" language="javascript" src="../../js/funcionesUsuario.js"></script>
<script type="text/javascript">
/*
function on(id){
  $(document).ready(function () {
                 $('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
               $.ajax({
                        type:'get',
                        url:'forUS.php',
                        data:
                        {
                          ids:id
                        },
                        success:function(data){
                          $('#mostrar').html(data);     
                        },
                        error: function()
                        {
                          alert("error");
                        }
                    });
              return false;
        
             });
    } */
</script>
  


  <table cellpadding="0" cellspacing="0" border="0" class="solicitudes" id="listaUsuario">
                <thead >
                    <tr class="head">
                        <th width="15%">Rol</th>
                        <th width="25%">Nombre</th>                        
                        <th width="15%">Usuario</th>                        
                        <th width="25%">Correo</th>
                        <th width="10%">Status</th>
                        <th width="10%">Acciones</th>                      
                    </tr>
                </thead>
                  <tbody>
                    <?php

                   while($reg=  mysql_fetch_array($queryB))
                   {
                     	  $id=$reg['idUsuario'];
                        $sqlR="select * from tblroles where idRol=".$reg['idRol'];
                   	    $queryR=mysql_query($sqlR)or die(mysql_error());
                   	    $rol=mysql_result($queryR,0,'nomRol');
                        $t='Activo';

                        //Se Obtien nombre del Usuario      
                        $usuario=$reg['nomUsuario'].' '.$reg['appUsuario'].' '.$reg['apmUsuario'];                 
                        if($reg['status']==1)
                            $clase='verde';
                        else
                            $clase='rojo';
                                
                        echo '<tr align=center valign=top class="'.$clase.'">';
                          echo '<td>'.$rol.'</td>';
                          echo '<td ><center>'.$usuario.'</center></td>';
                          echo '<td>'.$reg['nickUsuario'].'</td>';                        
                          echo '<td>'.$reg['mailUsuario'].'</td>';
							   if($reg['status']==1)
							   {
								   echo '<td>Activo</td>';
							   }
							   else
							   {
								   echo '<td>Inactivo</td>';
							   }
				if($permisosEspeciales==1)			   					   
                               echo '<td><button class="modUsuario" onclick="on('.$id.')" title="Modificar"></button></td>';
                                else
                                    echo'<td></td>';
                               echo '</tr>';
                     
                  }
                   ?>
                <tbody>
            </table>

    <div id="modificaUsuario" title="Modificar Usuario">
        <div id="contModifica"></div>
  </div>
  </div> 

  
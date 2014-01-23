<?php 
header("Content-Type: text/html;charset=utf-8");
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
//header("Content-Type: text/html;charset=utf-8");
include"../../libs/libs.php"; 
$funciones= new funciones;
$funciones->conectar();
$sqlB="select * from tblperfil";
$queryB=mysql_query($sqlB) or die(mysql_error()); //SE EJECUTA LA CONSULTA

?>
<html>
<!--<script type="text/javascript" language="javascript" src="js/jslistadoPerf.js"></script>-->
<script type="text/javascript" language="javascript" src="../../js/funcionesPerfil.js"></script>
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
                        url:'perfiles.php',
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
}

  */
</script>
<body> 


  <table cellpadding="0" cellspacing="0" border="0" class="display" id="listaPerfil">
  
                <thead >
                    <tr>
                        <th >Descripción del Perfil</th>
			<th>Perfil</th>
                        <th>Complejidad del Perfil</th>
			<th>Funciones</th>
			<th>Habilidades</th>
			<th>Conocimientos</th>
			<th>Acciones</th> <!-- Campo de acciones para el cat�logo -->
			
			          </tr>
                </thead>
                <tfoot>
                    <tr>
                       
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                       
                       
                     
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

                   
                   while($reg=  mysql_fetch_array($queryB))
                   {

                   	     $id=$reg['idPerfil'];
                             
                               echo '<tr align=justify valign=top class="verde">';
			       echo '<td ><center>'.$reg['descPerfil'].'</center></td>';
                               echo '<td align=left>'.$reg['perfPerfil'].'</td>';
                               echo '<td><center>'.$reg['compPerfil'].'</center></td>';
			       echo '<td align=justify>'.$reg['funcPerfil'].'</td>';
			       echo '<td align=justify>'.$reg['habPerfil'].'</td>';
			       echo '<td align=justify>'.$reg['conocPerfil'].'</td>';
                               if($permisosEspeciales==1)
                                echo '<td><center><button id=modPerfil onclick="on('.$id.')">Modificar</button></center></td>';                               
                               else
                                echo '<td></td>';   
                               echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>

    <div id="modificaPerfil" title="Modificar Perfil">
        <div id="contModifica"></div>
  </div>
  </div> 
</body>
</html>
  
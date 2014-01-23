<?php 
header("Content-Type: text/html;charset=utf-8");
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
include"../../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$sqlB="SELECT * FROM tblescolar WHERE fecbaja IS NULL";      //GMM001 - Cambiar Consulta
	$queryB=mysql_query($sqlB) or die(mysql_error());
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<script type="text/javascript" language="javascript" src="../../js/funcionesEscolaridad.js"></script>

<script type="text/javascript">
/*
//**************************************************************
//Nombre: function
//Descripcion: 
//Parametros: 
//Realizo: Graciela Martinez Mejia
//Fecha:   21/05/2013
//**************************************************************
function on(id){
   $(document).ready(function () {
    $('.overlay-container').fadeIn(function() {
        window.setTimeout(function(){
        $('.window-container.zoomin').addClass('window-container-visible');},0000);
    });
    $.ajax({
            type:'get',
            url:'Esc.php',
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

<!--GMM001- Se listan los Registros-->
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="listaEsc">  <!--GMM001- Cambiar nombre del listado-->
  <thead >
      <tr>
         <th width="10%"> </th>
         <th width="10%">Id</th>
         <th width="50%">Escolaridad</th>  <!--GMM001-->
		   <th width="30%">Acciones</th>
      </tr>
   </thead>
   <tfoot>
    <tr>                       
      <th width="10%"> </th>
      <th width="10%"></th>
      <th width="50%"></th>
      <th width="30%"></th>                                                 
    </tr>
   </tfoot>
   <tbody>
      <?php
         while($reg=  mysql_fetch_array($queryB))
         {
            $id=$reg['idEscolar'];           
            echo '<tr >';
            echo '<td width="10%"><center> </center></td>';
            echo '<td width="10%"><center>'.$reg['idEscolar'].'</center></td>';
            echo '<td width="50%">'.$reg['nomEscolar'].'</td>';
            if($permisosEspeciales==1)
                echo '<td><center><button onclick="on('.$id.')">Modificar</button></center></td>';
            else
                echo'<td></td>';
            echo '<td><center></center>';
            echo '</tr>';                     
         }
      ?>
   <tbody>      
</table>
<div id="modificaEscolaridad" title="Modificar escolaridad">
        <div id="contModifica"></div>
  </div>
  </body>

<!-- ********************************************* -->
  
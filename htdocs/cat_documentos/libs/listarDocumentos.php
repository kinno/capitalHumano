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
$sqlB="select * from tbldocumento WHERE fecbaja IS NULL";      //GMM001 - Cambiar Consulta
		$queryB=mysql_query($sqlB) or die(mysql_error());
?>

<script type="text/javascript" language="javascript" src="../../js/funcionesDocumentos.js"></script>
<script type="text/javascript">
/*
function on(id){
  $(document).ready(function (){

    $('.overlay-container').fadeIn(function(){
        window.setTimeout(function(){
          $('.window-container.zoomin').addClass('window-container-visible');},0000);
    });

    $.ajax({
        type:'get',
        url:'documento.php',
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

  <table cellpadding="0" cellspacing="0" border="0" class="display" id="listaDoc">
    <thead >
      <tr>
         <th width="10%"> </th>
         <th width="10%">Id</th>
         <th width="50%">Documentos</th> 
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
            $id=$reg['idDocumento'];           
            echo '<tr>';
            echo '<td><center> </center></td>';
            echo '<td><center>'.$reg['idDocumento'].'</center></td>';
            echo '<td>'.$reg['desDocumento'].'</td>';           
            if($permisosEspeciales==1)
                echo '<td><center><button onclick="on('.$id.')">Modificar</button></center></td>';
            else
                echo '<td></td>';
            echo '<td><center></center>';
            echo '</tr>';                     
         }
      ?>
   <tbody>                      
  </table>

  <div id="modificaPerfil" title="Modificar Perfil">
        <div id="contModifica"></div>
  </div>
  </body>
</html>

  
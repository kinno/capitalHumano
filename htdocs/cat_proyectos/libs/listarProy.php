<?php 
include"../../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$sqlB="SELECT * FROM tblproyecto WHERE fecbaja IS NULL";      //GMM001 - Cambiar Consulta
  $queryB=mysql_query($sqlB) or die(mysql_error());
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<script type="text/javascript" language="javascript" src="js/jslistadoProy.js"></script> <!--GMM001- Cambiar nombre del Archivo-->
<script type="text/javascript">


//**************************************************************
//Nombre: function
//Descripcion: 
//Parametros: 
//Realizo: Monse
//Fecha:   22/05/2013
//**************************************************************
function on(id){
   $(document).ready(function () {
    $('.overlay-container').fadeIn(function() {
        window.setTimeout(function(){
        $('.window-container.zoomin').addClass('window-container-visible');},0000);
    });
    $.ajax({
            type:'get',
            url:'Proy.php',
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
</script>

<!--GMM001- Se listan los Registros-->
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="listaProy">  <!--GMM001- Cambiar nombre del listado-->
  <thead >
      <tr>
        <th width="10%"> </th>
        <th width="10%">Id</th>
        <th width="50%">Proyectos</th>  <!--GMM001-->
        <th width="30%">Acciones</th>
      </tr>
   </thead>
   <tfoot>
    <tr>                       
      <th width="10%"> </th>
      <th width="10%"></th>
      <th width="60%"></th>
      <th width="30%"></th>                                                 
    </tr>
   </tfoot>
   <tbody>
      <?php
         while($reg=  mysql_fetch_array($queryB))
         {
            $id=$reg['idProyecto'];           
            echo '<tr >';
            echo '<td width="10%"><center> </center></td>';
            echo '<td width="10%"><center>'.mb_convert_encoding($reg['idProyecto'], "UTF-8").'</center></td>';
            echo '<td width="50%">'.mb_convert_encoding($reg['nomProyecto'], "UTF-8").'</td>';            
            echo '<td><center><a value="Acercar Ventana Modal" class="button" data-type="zoomin" onclick="on('.$id.')">Modificar</a></center></td>';
            echo '<td><center></center>';
            echo '</tr>';                     
         }
      ?>
   <tbody>      
</table>
<div class="overlay-container">
  <center>
    <div class="window-container zoomin" id='mostrar'>         
    </div>
  </center>
</div>


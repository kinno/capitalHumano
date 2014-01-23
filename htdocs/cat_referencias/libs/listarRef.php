<?php 
header("Content-Type: text/html;charset=utf-8");
include"../../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();

$idCandid=$_GET['idCandid'];

$sqlB="SELECT * FROM tblreferencias WHERE idCandid=$idCandid AND fecbaja IS NULL";     
	$queryB=mysql_query($sqlB) or die(mysql_error());

?>


<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<script type="text/javascript" language="javascript" src="js/jslistadoRef.js"></script> <!--GMM001- Cambiar nombre del Archivo-->
<script type="text/javascript">

//**************************************************************
//Nombre: function
//Descripcion: Lista las referencias de un Candidato
//Parametros: 
//Realizo: Graciela Martinez Mejia
//Fecha:   23/05/2013
//**************************************************************
function on(id,idC){
  
   $(document).ready(function () {

    $('.overlay-container').fadeIn(function() {
        window.setTimeout(function(){
        $('.window-container.zoomin').addClass('window-container-visible');},0000);
    });

    $.ajax({
            type:'get',
            url:'Ref.php',
            data:
            {
              idCandid:idC,
              numRef:id
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
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="listaRef">  <!--GMM001- Cambiar nombre del listado-->
  <thead >
      <tr>
          <th width="10%">Num</th>
          <th width="25%">Candidato</th>  <!--GMM001-->
          <th width="25%">Empresa</th>   
          <th width="25%">Nombre Exjefe</th>   
          <th width="15%">Acciones</th>
      </tr>
   </thead>
   <tfoot>
    <tr>                       
          <th width="10%"></th>
          <th width="25%"></th>
          <th width="25%"></th>
          <th width="25%"></th>
          <th width="15%"></th>                                                 
    </tr>
   </tfoot>
   <tbody>
      <?php
         while($reg=  mysql_fetch_array($queryB))
         {
               $id=$reg['numRef'];
               $idC=$reg['idCandid']; 

               //GMM001-Se Obtiene nombre del candidato
               $sqlR="select * from tblcandidato where idCandid=".$reg['idCandid'];
               $queryR=mysql_query($sqlR)or die(mysql_error());
               $candidato=mysql_result($queryR,0,'nomCandid').' '.mysql_result($queryR,0,'appCandid').' '.mysql_result($queryR,0,'apmCandid') ;              

               echo '<tr >';
               echo '<td width="10%">'.mb_convert_encoding($reg['numRef'], "UTF-8").'</td>';            
               echo '<td width="25%">'.mb_convert_encoding($candidato, "UTF-8").'</td>';
               echo '<td width="25%">'.mb_convert_encoding($reg['empRef'], "UTF-8").'</td>';            
               echo '<td width="25%">'.mb_convert_encoding($reg['nomRef'], "UTF-8").'</td>';            
            echo '<td><center><a value="Acercar Ventana Modal" class="button" data-type="zoomin" onclick="on('.$id.','.$idC.')">Modificar</a></center></td>';
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


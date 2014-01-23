<?php 
//*********************************************************************
//Nombre: 
//Funcion del Modulo: Lista de Candidatos tabla principal
//Fecha:  20/05/2013
//Relizo: Graciela Martinez Mejia
//********************************************************************* 
include"libs.php";
$funciones= new funciones;
$funciones->conectar();
$sqlB="select * from tblcandidato";  //GMM001 - Modifico tabla para consulta
$queryB=mysql_query($sqlB) or die(mysql_error());
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<script type="text/javascript" language="javascript" src="js/jslistadoCand.js"></script>   

<script type="text/javascript">

  function referencias(id){       
    $(document).ready(function () {
      window.location='referencias.php?idCandid='+id;     
    }); 
  }

  function on(id){     
   $(document).ready(function () {

    $('.overlay-container').fadeIn(function() {
        window.setTimeout(function(){
        $('.window-container.zoomin').addClass('window-container-visible');},0000);
    });
    
    $.ajax({
            type:'get',
            url:'upCandi.php',
            data:
            {
              idC:id
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
  
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="listaCand">   <!--GMM001 - Este nombe va en: jslistadoCand.js-->
  <thead >
    <tr>
      <th width="5%">Id</th>
      <th width="16%">Nombre</th>
      <th width="20%">Escolaridad</th>
      <th width="14%">Residencia</th>
      <th width="25%">Conocimientos</th>
      <th width="20%" colspan=2>Acciones</th>
    </tr>
  </thead>
  <tfoot>
    <tr>                       
      <th width="5%"></th>
      <th width="16%"></th>
      <th width="20%"></th>
      <th width="14%"></th>
      <th width="25%"></th>
      <th width="20%" colspan=2></th>                                                 
    </tr>
  </tfoot>

  <tbody>
   <?php
      while($reg=  mysql_fetch_array($queryB))
      {
         //GMM001-Obtengo el id
         $id =$reg['idCandid'];

         //GMM001-Se Obtiene nombre del candidato
         $candidato=$reg['nomCandid'].' '.$reg['appCandid'].' '.$reg['apmCandid'];         

         //GMM001-Se Obtiene Escolaridad
         $sqlR="SELECT * FROM tblescolar WHERE idEscolar=".$reg['idEscolar'];
         $queryR=mysql_query($sqlR)or die(mysql_error());
         $escolaridad=mysql_result($queryR,0,'nomEscolar');
         
         //GMM001-Se Obtiene Residencia
         $sqlR="SELECT * FROM entidad_federativa WHERE id_entidad=".$reg['id_entidad'];
         $queryR=mysql_query($sqlR)or die(mysql_error());
         $residencia=mysql_result($queryR,0,'nombre_entidad');

         $sqlR="SELECT * FROM municipio WHERE id_municipio=".$reg['id_municipio']." and id_entidad=".$reg['id_entidad'];
         $queryR=mysql_query($sqlR)or die(mysql_error());
         $residencia=$residencia.' - '.mysql_result($queryR,0,'nombre_municipio');

         echo '<tr>';
            echo '<td width="5%"><center>'.mb_convert_encoding($reg['idCandid'], "UTF-8").'</center></td>';
            echo '<td width="16%">'.mb_convert_encoding($candidato, "UTF-8").'</td>';
            echo '<td width="20%">'.mb_convert_encoding($escolaridad, "UTF-8").'</td>';
            echo '<td width="14%">'.mb_convert_encoding($residencia, "UTF-8").'</td>';
            echo '<td width="25%">'.mb_convert_encoding($reg['conCandid'], "UTF-8").'</td>';
            echo '<td width="10%"><a value="Acercar Ventana Modal" class="button" data-type="zoomin" onclick="on('.$id.')">Modificar</a></td>';
            echo '<td width="10%"><a value="Acercar Ventana Modal" class="button" data-type="zoomin" onclick="referencias('.$id.')">Referencias</a></td>';
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

<?php 
include"../../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$sqlB="select * from tblReclut";
		$queryB=mysql_query($sqlB) or die(mysql_error());
?>

<script type="text/javascript" language="javascript" src="js/jslistadoRec.js"></script>
<script type="text/javascript">

function on(id){
  $(document).ready(function () {
                 $('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
               $.ajax({
                        type:'get',
                        url:'recluta.php',
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
  


  <table cellpadding="0" cellspacing="0" border="0" class="display" id="listaReclut">
                <thead >
                    <tr>
                        <th>Nombre</th><!--Estado-->
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
			<th>Acciones</th>
			<th>Estado</th>
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

                   	     $id=$reg['idReclut'];
                               echo '<tr >';
			       echo '<td ><center>'.mb_convert_encoding($reg['nomReclut'], "UTF-8").'</center></td>';
                               echo '<td><center>'.mb_convert_encoding($reg['appReclut'], "UTF-8").'</center></td>';
                               echo '<td><center>'.mb_convert_encoding($reg['apmReclut'], "UTF-8").'</center></td>';
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
  </div> 

  
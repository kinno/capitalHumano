<?php 
//header("Content-Type: text/html;charset=utf-8");
session_start();

if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
include"../libs/libs.php"; //cambio
$funciones= new funciones;
$funciones->conectar();
$sqlB="select * from tblperfil where fecbaja is null";
$queryB=mysql_query($sqlB) or die(mysql_error()); //SE EJECUTA LA CONSULTA
?>
<script type="text/javascript" language="javascript" src="../js/funcionesSolicitudes.js"></script>
            <table cellpadding="0" cellspacing="0" border="0" class="perfiles" id="listaPerfil">

                            <thead >
                                <tr>
                                    <th >Perfil</th>
                                    <!--<th >Perfil</th>
                                    <th >Funciones</th>
                                    <th >Habilidades</th>
                                    <th >Conocimientos</th> -->
                                    <th >Acciones</th> 
                                </tr>
                            </thead>


                              <tbody>
                                <?php

                                //mysql_query("set names 'utf8'");
                               while($reg=  mysql_fetch_array($queryB))
                               {

                                         $id=$reg['idPerfil'];
                                           echo '<tr>';
                                           echo '<td style="font-size:20px;">'.$reg['descPerfil'].'</td>';
                                           /*echo '<td >'.$reg['perfPerfil'].'</td>';
                                           echo '<td >'.$reg['funcPerfil'].'</td>';
                                           echo '<td >'.$reg['habPerfil'].'</td>';
                                           echo '<td >'.$reg['conocPerfil'].'</td>';*/
                                           echo '<td><span class="seleccionar" onclick="recuperaPerfil('.$id.') " title="Seleccionar"></span>
                                                 </td>';
                                           echo '</tr>';
                                    }
                                ?>
                            </tbody>
            </table>  

  
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

                            <thead>
                                <tr class="head">
                                    <th id="0">Descripción<br>del<br>Perfil</th>
                                    <th id="1">Perfil</th>
                                    <th id="2">Funciones</th>
                                    <th id="3">Habilidades</th>
                                    <th id="4">Conocimientos</th>
                                    <th id="5">Acciones</th> <!-- Campo de acciones para el cat�logo -->
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
                                           echo '<td >'.$reg['perfPerfil'].'</td>';
                                           echo '<td >'.$reg['funcPerfil'].'</td>';
                                           echo '<td >'.$reg['habPerfil'].'</td>';
                                           echo '<td >'.$reg['conocPerfil'].'</td>';
                                           echo '<td><button class="seleccionar" onclick="recuperaPerfil('.$id.') " title="Seleccionar"></button>
                                                 </td>';
                                           echo '</tr>';
                                    }
                                ?>
                            </tbody>
            </table>  

  
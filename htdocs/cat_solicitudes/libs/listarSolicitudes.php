<?php 
include"../../libs/libs.php"; 
$funciones= new funciones;
$funciones->conectar();
session_start(); //inicia la sesi�n 
//print_r($_SESSION);
$SESION=$_SESSION['rol'];//esta variable contendra el id rol del usuario que haya iniciado la sesi�n
$idUser=$_SESSION['id'];
$cabecera="Acciones";
$cabecera2="";

if($SESION==1){//ADMIN
    $consulta="";
}    
if($SESION==2)  //recursos humanos
{
   $cabecera='Estatus';
   $cabecera2="<th>Detalle</th>";
   $consulta=""; //Esta parte se le concatena a la consulta de la tabla solicitud (linea 8) en caso de que el que la sesi�n sea del gerente d eoperaciones
}
if($SESION==3){//Director Operaciones
    $consulta='where statSolici=1';
}    
if($SESION==4){//Lider de proyecto
     $cabecera='Estatus';
   $cabecera2="<th>Detalle</th>";
    $consulta='where idUsuario='.$idUser;
}    




$sqlB="select * from tblsolicitud $consulta";
$queryB=mysql_query($sqlB) or die(mysql_error()); //SE EJECUTA LA CONSULTA
?>
 
 
<script type="text/javascript" language="javascript" src="../../js/funcionesSolicitudes.js"></script>
<script>
    listarSolicitudes();
</script>
  <table cellpadding="0" cellspacing="0" border="0" class="solicitudes" id="listaSolicitud">
  
                <thead >
                    <tr class="head">
                        <th>Folio</th>
			<th>Proyecto</th>
                        <th>Perfil que se Solicita</th>
			<th>Fecha en que se requiere</th>
                        <?php echo $cabecera2 ?>
                        <th><?php echo $cabecera ?></th>

                    </tr>
                </thead>
                  <tbody>
                    <?php

                   
                   while($reg=  mysql_fetch_array($queryB))
                   {

                               $folio=$reg['folSolici'];
			       $estatus=$reg['statSolici'];
                               
                               $background='';
                               /*
                               if($estatus==1)
                                   $background="style='background-color:#FFCC33'";
                               if($estatus==2)
                                   $background="style='background-color:#5FB404'";
                               if($estatus==3)
                                   $background="style='background-color:#F00'";
                              */
			       echo '<tr align=justify valign=top '.$background.'>';
			       echo '<td ><center>'.$reg['folSolici'].'</center></td>';
			       $idSubproyecto=$reg['idSubproyecto'];
			       $consulta1="SELECT nomSubproy FROM tblsubproyecto WHERE idSubproyecto=$idSubproyecto";
			       $query1=mysql_query($consulta1) or die(mysql_error());
			       $resul1=mysql_fetch_array($query1);
                               echo '<td align=center>'.$resul1['nomSubproy'].'</td>';
			       $idPerfil=$reg['idPerfil'];
                               $consulta2="SELECT descPerfil FROM tblperfil WHERE idPerfil=$idPerfil";
                               $query2=mysql_query($consulta2) or die(mysql_error());
                               $resul2=mysql_fetch_array($query2);
                               echo '<td><center>'.$resul2['descPerfil'].'</center></td>';
			       echo '<td align=center>'.$reg['iniSolici'].'</td>';
			       if($SESION==4||$SESION==5||$SESION==2) //recursos humanos
			       {
				 $rh=2;
				echo '<td align=center><button class="ver" onclick="detallesSolicitud('.$folio.','.$rh.')" title="Ver detalles"></button></td>';
				switch($estatus)
				{
				 case "1":
				    $solicitado="<td align=center><IMG SRC='../../img/solicitado.png' title='Solicitado'></td>";
				    echo $solicitado;
				    break;
				 case "2":
				    $aceptado="<td align=center><IMG SRC='../../img/paloma.png' title='Aprobado'></td>";
				    echo $aceptado;
				    break;
				 default:
				    $rechazado="<td align=center><IMG SRC='../../img/tache.png' title='Rechazado'></td>";
				    echo $rechazado;
				    break;
				}
				
			       }else{  //Gerente de operaciones
				$gop=1;
				echo '<td align=center><button class="modificar" onclick="detallesSolicitud('.$folio.','.$gop.')" title="Modificar Estatus" ></button></td>';
				
			       }
			       
                               
                               echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>

  
<?php
include_once("libs/libvacantes.php");
$vacantes = new Vacantes();
$datos = $vacantes->obtener_solicitudes();
?>
<!doctype html>
<html lang='es'>
<head>
	
	<meta charset='utf8'>
        <link type="text/css" href="../../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/funcionesVacantes.js"></script>
</head>
<body>
    <div class="ui-widget">    
                <p align="center"><span class='titulo ui-corner-all'>Catálogo de Solicitudes Aprobadas</span></p>
                <article id="contenido" class="ui-widget-content">
                    <table cellpadding="0" cellspacing="0" border="0" class="solicitudes" id="listaSolicitud">

                                <thead >
                                    <tr class="head">
                                        <th>Folio</th>
                                        <th>Proyecto</th>
                                        <th>Perfil que se Solicita</th>
                                        <th>Vacantes</th>
                                        <th>Puestos Asignados</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                  <tbody>
                                    <?php

                                   $i=0;
                                   foreach($datos as $v)
                                   {
                                               echo '<tr align=center valign=top>';
                                               echo '<td id="folio'.$i.'">'.$v['folSolici'].'</td>';
                                               echo '<td id="proyecto'.$i.'">'.$v['nomProyecto'].'</td>';
                                               echo '<td>'.$v['descPerfil'].'</td>';
                                               echo '<td id="numPuestos'.$i.'">'.$v['numVSolici'].'</td>';
                                               $datos2=$vacantes->obtener_numasignadas($v['folSolici']);
                                               foreach($datos2 as $num){
                                               }

                                               echo '<td id="numFaltantes'.$i.'">'.$num[0].'</td>';
                                                if($v['numVSolici']==$num[0])
                                                    $disabled='disabled';
                                                else        
                                                    $disabled='';
                                               echo '<td><input type="button" value="Asignar Reclutador" onclick="abreDialog('.$i.');" '.$disabled.'></td>';
                                              /* $folio=$reg['folSolici'];
                                               $estatus=$reg['statSolici'];
                                               echo '<tr align=justify valign=top>';
                                               echo '<td ><center>'.$reg['folSolici'].'</center></td>';
                                               $idProyecto=$reg['idProyecto'];
                                               $consulta1="SELECT nomProyecto FROM tblproyecto WHERE idProyecto=$idProyecto";
                                               $query1=mysql_query($consulta1) or die(mysql_error());
                                               $resul1=mysql_fetch_array($query1);
                                               echo '<td align=center>'.$resul1['nomProyecto'].'</td>';
                                               $idPerfil=$reg['idPerfil'];
                                               $consulta2="SELECT descPerfil FROM tblperfil WHERE idPerfil=$idPerfil";
                                               $query2=mysql_query($consulta2) or die(mysql_error());
                                               $resul2=mysql_fetch_array($query2);
                                               echo '<td><center>'.$resul2['descPerfil'].'</center></td>';
                                               echo '<td align=center>'.$reg['iniSolici'].'</td>';
                                               echo '</tr>';*/
                                               $i++;
                                        }
                                    ?>
                                <tbody>
                            </table>
                </article>
    </div>
<div id="dialog" title="Asignar Vacante a Reclutador">
    <center>
    <div id="content">
        
            <table cellpadding="5">
                <tr align="center">
                    <td>Folio</td>
                    <td>Proyecto</td>
                    <td>Complejidad</td>
                    <td>Puestos</td>
                    <td>Reclutador</td>
                </tr>
                <tr align="center">
                    <td id="folioVacante"></td>
                    <td id="proyectoVacante"></td>
                    <td>
                        <select id="complejidad">
                            <option value="1">Muy Bajo</option>
                            <option value="2">Bajo</option>
                            <option value="3">Medio</option>
                            <option value="4">Avanzado</option>
                            <option value="5">Complejo</option>
                        </select>
                    </td>
                    <td id="puestosVacante"><input id="spinner" name="spinner" value="1" readonly/></td>
                    <td id="ReclutadorVacante">
                        <select id="reclutador" class="ui-widget">
                            <option value="-1">Seleccione un reclutador</option>
                            <?php
                                $datos3 = $vacantes->obtener_reclutadores();
                                foreach($datos3 as $r){
                                echo '<option value="'.$r['idReclut'].'">'.$r['nomReclut'].' '.$r['appReclut'].' '.$r['apmReclut'].'</option>';
                                   }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" id="resp"></td>
                    <td><button id="asigna">Asignar</button></td>
                </tr>
            </table>
        
    </div>
    </center>
</div>
</body>
</html>
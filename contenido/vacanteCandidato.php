<?php
session_start();
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$datos = $vacantes->obtener_vacantes($_SESSION['id']);
?>
<!doctype html>
<html lang='es'>
<head>
	
	<meta charset='utf8'>
	<link type="text/css" href="../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" /> 
	<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.highlight.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.ui.timepicker.js"></script>
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/funcionesVacantes.js"></script>
        
	
</head>
<body>
<div class="ui-widget">	
<p><span class='titulo' id='candidato'>Catálogo de Vacantes</span></p>
<article id="contenido" class="ui-widget-content" style="border:none;">
    <table cellpadding="0" cellspacing="0" border="0" class="solicitudes" id="listaVacantes">
  
                <thead >
                    <tr class="head">
                        <th>Folio</th>
			<th>Proyecto</th>
                        <th>Perfil</th>
                        <th>Complejidad</th>
                        <th>Fecha de Solicitud</th>
                        <th>Vacantes</th>
			<th>Candidatos</th>			
			<th></th>

                    </tr>
                </thead>
                  <tbody>
                    <?php

                   $i=0;
                   foreach($datos as $v)
                   {
                               echo '<tr align="center" valign="top" id="vacante'.$i.'">';
                               echo '<td id="folio'.$i.'">'.$v['folSolici'].'<input type="hidden" id="numVacante'.$i.'" value="'.$v['numVacante'].'"></td>';
                               echo '<td id="proyecto'.$i.'">'.$v['nomProyecto'].'</td>';
                               echo '<td>'.$v['descPerfil'].'</td>';
                               echo '<td id="complejidad'.$i.'">';
                                    if($v['compPerfil']==1)
                                        echo 'Muy Bajo';
                                    if($v['compPerfil']==2)
                                        echo 'Bajo';
                                    if($v['compPerfil']==3)
                                        echo 'Medio';
                                    if($v['compPerfil']==4)
                                        echo 'Avanzado';
                                    if($v['compPerfil']==5)
                                        echo 'Complejo';
                               echo  '</td>';
                                echo '<td>'.date("d-m-Y",  strtotime($v['fecalta'])).'</td>';
                                echo '<td>'.$v['Vacantes'].'</td>';
                                $numCandidatos = $vacantes->num_candidatosAsignados($v['folSolici']);
                               echo '<td>'.$numCandidatos[0].'</td>';
                               echo '<td class="btnsVac"><span style="height:15px;" class="modif" title="Modificar estatus de vacante"></span><span style="height:15px;" onclick="abrirPanel('.$i.');" class="up" title="Abrir panel"></span></td>';
                                                                      
                               $i++;
                        }
                    ?>
                <tbody>
            </table>
</article>
</div>
<!-- Dialog de ventana emergente -->
<div id="dialog" title="Búsqueda de Candidato" style="display:none">
    <center>
    <div id="content">
        <input type="hidden" id="vacante"/>
        <input type="hidden" id="fila">
        <!-- tabla de candidatos en ventana emergente -->
        <?php
            $datos2=$vacantes->obtener_candidatos();
        ?>
            <p><span class='titulo' id='candidato'>Catálogo de Candidatos</span></p>
                    <article id="contenido">
                        <table cellpadding="0" cellspacing="0" border="0" class="solicitudes" id="listaCandidatos">

                                    <thead >
                                        <tr class="head">

                                            <th>Nombre</th>
                                            <th>Escolaridad</th>
                                            <th>Grado</th>
                                            <th>Último salario</th>
                                            <th>Pretensiones min</th>
                                            <th>Pretensiones max</th>
                                            <th>Último estatus</th>
                                            <th>Acciones</th>

                                        </tr>
                                    </thead>
                                      <tbody>
                                        <?php

                                       $i=0;
                                       foreach($datos2 as $v)
                                       {
                                                   echo '<tr align=center valign=top>';
                                                  
                                                   echo '<td id="candidato'.$i.'"><input type="hidden" id="idCandid'.$i.'" value="'.$v['idCandid'].'"/>'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
                                                   echo '<td id="escolaridad"'.$i.'>'.$v['carreraCandid'].'</td>';
                                                   echo '<td id="estudios'.$i.'">'.$v['nlvestudiosCandid'].'</td>';
                                                   echo '<td id="salario'.$i.'">$'.$v['ultimosalarioCandid'].'</td>';
                                                   echo '<td id="pmin'.$i.'">$'.$v['pretensionesminCandid'].'</td>';
                                                   echo '<td id="pmax'.$i.'">$'.$v['pretensionesmaxCandid'].'</td>';
                                                   echo '<td id="conocimientos'.$i.'" style="background-color: '.$v['estatus'].'">'.$v['descEstatus'].'</td>';
                                                   echo '<td class="btnsDA"><button class="detalleCandidato" onclick="detallesCandidato('.$v['idCandid'].')" style="height:20px; width:30px;" title="Ver detalle"><button class="asignarCandidato" onclick="asignarCandidato('.$i.')" style="height:20px; width:30px;" title="Asignar candidato"></button></td>';
                                                   echo '</tr>';
                                                   $i++;
                                            }
                                        ?>
                                    <tbody>
                                </table>
                    </article>
        
    </div>
    </center>
    <div id="resp"></div>
</div>
<div id="dialogEntrevista" title="Agendar Entrevista" style="display:none;">
    <center>
     <input type="hidden" id="idVacCand">
    <div id="content">
       
            <table cellpadding="5">
                <tr class="header" align="center">
                    <td>Fecha de Entrevista</td>
                    <td>Hora de Entrevista</td>
                    <td>Entrevistador</td>
                    <td>Lugar</td>
                    
                </tr>
                <tr class="content">
                    <td><input type="fecha" id="fecha" name="fecha"/></td>
                    <td><input type="hora" id="hora" name="hora" /></td>
                    <td><input type="text" id="entrevistador" name="entrevistador"/></td>
                    <td><?php
                               include_once("../funciones/funciones.php");
                              $lugar=  comboLugares();
                            echo $lugar;
                            ?>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" id="resp"></td>
                    <td><button id="asigna" onclick="registraEntrevista()">Agendar</button></td>
                </tr>
            </table>
        <div id="err"></div>
    </div>
    </center>
</div>
<div id="resultadoEntrevista" title="Resultado de entrevista" style="display:none">
    <center>
    <div id="content">
       <input type="hidden" id="idEntr">
       <table>
           <tr>
               <td>
                   
                   <?php
                        include_once("../funciones/funciones.php");
                        $est=  comboEstatus();
                        echo $est;
                    ?>
               </td>
           </tr>
           <tr>
               <td>
                   <textarea id="observaciones" placeholder="Ingrese observaciones..." style="width:250px; height: 200px;"></textarea>
               </td>
           </tr>
           <tr>
               <td>
                   <span id="regEntrev" onclick="registrarEstatus()">Registrar</span>
               </td> 
           </tr>
       </table>
    </div>
    </center>
</div>
<div id="detalleCandidato" title="Detalle de candidato" class="overlay-container">
    <div id="condetalle">
        
    </div>
</div>
</body>
</html>
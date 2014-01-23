<?php
include_once("../catalogos/libvacantes.php");
$vacantes = new Vacantes();
$datos = $vacantes->obtener_vacantes();
?>
<!doctype html>
<html lang='es'>
<head>
	
	<meta charset='utf8'>
	<link type="text/css" href="../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/style.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
	<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.highlight.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.ui.timepicker.js"></script>
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/funcionesVacantes.js"></script>
        
	
</head>
<body>
	
<p><span class='titulo' id='candidato'>Catálogo de Vacantes</span></p>
<article id="contenido">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="listaVacantes">
  
                <thead >
                    <tr>
                        <th>Folio</th>
			<th>Proyecto</th>
                        <th>Perfil</th>
                        <th>Reclutador</th>
                        <th>Complejidad</th>
			<th>Estatus</th>
                        <th>Candidato</th>
			<th>Acciones</th>

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
			
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

                   $i=0;
                   foreach($datos as $v)
                   {
                               echo '<tr align=center valign=top>';
                               echo '<td id="folio'.$i.'">'.$v['folSolici'].'<input type="hidden" id="numVacante'.$i.'" value="'.$v['numVacante'].'"></td>';
                               echo '<td id="proyecto'.$i.'">'.$v['nomProyecto'].'</td>';
                               echo '<td>'.$v['descPerfil'].'</td>';
                               echo '<td id="reclutador'.$i.'">'.$v['nomReclut'].' '.$v['appReclut'].' '.$v['apmReclut'].'</td>'; 
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
                               echo '<td>';
                                    if($v['statVacante']==1)
                                        echo 'Cerrada';
                                    if($v['statVacante']==2)
                                        echo 'Proceso';
                                    if($v['statVacante']==3)
                                        echo 'Cancelada';
                                    
                               echo '</td>';
                               echo '<td id="candid'.$i.'">';
                                    if($v['idCandid']==''){
                                        echo '';
                                    $botonAgenda='';
                                    }
                                    else{
                                        $datosaux=$vacantes->nombre_candidato($v['idCandid']);
                                        echo $datosaux;
                                        $botonAgenda='<button id="agenda" title="Agendar Entrevista" onclick="agendaEntrevista('.$i.')" ></button>';
                                    }
                               echo '</td>';
                               echo '<td id="acciones'.$i.'">';
                                    $entrevistaRegistrada=$vacantes->con_entrevista($v['numVacante']);
                                    if($entrevistaRegistrada=='si')
                                        $botonEntrevista='<button id="ver" title="Ver Entrevistas" onclick="buscaEntrevistas('.$i.')" ></button>';
                                    else
                                        $botonEntrevista = '';
                               echo '<button id="buscar" title="Buscar Candidato" onclick="abreBusqueda('.$i.')" ></button>'.$botonEntrevista.$botonAgenda.'</td>';
                               echo '</tr>';                                               
                               $i++;
                        }
                    ?>
                <tbody>
            </table>
</article>
<!-- Dialog de ventana emergente -->
<div id="dialog" title="Búsqueda de Candidato">
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
                        <table cellpadding="0" cellspacing="0" border="0" class="display" id="listaCandidatos">

                                    <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Escolaridad</th>
                                            <th>Residencia</th>
                                            <th>Conocimientos</th>
                                            <th colspan=2>Acciones</th>

                                        </tr>
                                    </thead>
                                      <tbody>
                                        <?php

                                       $i=0;
                                       foreach($datos2 as $v)
                                       {
                                                   echo '<tr align=center valign=top>';
                                                   echo '<td id="idCandid'.$i.'">'.$v['idCandid'].'</td>';
                                                   echo '<td id="candidato'.$i.'">'.$v['nomCandid'].' '.$v['appCandid'].' '.$v['apmCandid'].'</td>';
                                                   echo '<td id="escolaridad"'.$i.'>'.$v['idEscolar'].'</td>';
                                                   echo '<td id="residencia'.$i.'"></td>'; 
                                                   echo '<td id="conocimientos'.$i.'">'.$v['conCandid'].'</td>';
                                                   echo '<td><button onclick="asignarCandidato('.$i.')">Registrar Candidato</button></td>';
                                                   echo '</tr>';
                                                   $i++;
                                            }
                                        ?>
                                    <tbody>
                                </table>
                    </article>
        
    </div>
    </center>
</div>
<div id="dialogEntrevista" title="Agendar Entrevista">
    <center>
     <input type="hidden" id="nVacante">
    <div id="content">
       
            <table cellpadding="5">
                <tr class="header" align="center">
                    <td>Fecha de Entrevista</td>
                    <td>Hora de Entrevista</td>
                    <td>Entrevistador</td>
                    <td>Lugar</td>
                    <td>Comentario</td>
                    <td>Estatus</td>
                </tr>
                <tr class="content">
                    <td><input type="fecha" id="fecha" name="fecha"/></td>
                    <td><input type="hora" id="hora" name="hora" /></td>
                    <td><select id="entrevistador" name="entrevistador">
                            <option value="-1"></option>
                        <?php
                            $entrevistador=$vacantes->obtener_reclutadores();
                            foreach ($entrevistador as $e){
                                echo '<option value="'.$e['idReclut'].'">'.$e[nomReclut].' '.$e['appReclut'].' '.$e['apmReclut'].'</option>';
                            }
                        ?>
                        </select>       
                    </td>
                    <td><input type="text" id="lugar" name="lugar"/></td>
                    <td><textarea name="comentario" form="usrform" id="comentario" style="width:250px; height: 50px;"></textarea></td>
                    <td>
                        <select id="est">
                            <option></option>
                            <option value="F">Entrevista Confirmada</option>
                            <option value="E">Pendiente de Realizar</option>
                            <option value="D">Cancelada por el candidato</option>
                            <option value="C">Cancelada por el Cliente</option>
                            <option value="B">Entrevista Reagendada</option>
                            <option value="A">Cancelada por RH</option>
                        </select>
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
<div id="entrevistasRegistradas" title="Entrevistas Registradas">
    <center>
    <div id="content">
       
           
    </div>
    </center>
</div>
</body>
</html>
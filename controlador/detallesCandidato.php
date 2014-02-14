<?php
include_once("../funciones/ChromePhp.php");
include_once("../funciones/libCandidatos.php");
$candidato = new Candidato();
$idCandid = $_POST['idCandid'];
$dato = $candidato->detalles_candidato($idCandid);
?>
<style>
  .ui-tabs-vertical { width: 99%; }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 170px; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 80%;}
  .datos{text-align: center; font-weight:bold; background-color: #EAF5FE;}
  </style>
<?php
foreach ($dato as $k => $v) {
    $referencias = $candidato->referencias_candidato($idCandid);
    if($v['genCandid']=='M'){
        $selectedM="selected";
        $selectedF="";
    }
    else{
        $selectedM="";
        $selectedF="selected";
    }
    $selTitulado="";
    $selPasante="";
    $selTrunco="";
    if($v['nlvestudiosCandid']=='Titulado'){
        $selTitulado="selected";
    }else if($v['nlvestudiosCandid']=='Pasante'){
        $selPasante="selected";
    }else if($v['nlvestudiosCandid']=='Trunco'){
        $selTrunco="selected";
    }
    
    $selSi="";
    $selNo="";
    if($v['tbjoactualCandid']=='Si'){
        $selSi ="selected";
    }else{
        $selNo = "selected";
    }
    
    $selvSi="";
    $selvNo="";
    if($v['viajasCandid']=="Si"){
        $selvSi="selected";
    }else{
        $selvNo="selected";
    }
    
    echo '
<form id="datosPersonales">        
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Datos personales</a></li>
    <li><a href="#tabs-2">Datos académicos</a></li>
    <li><a href="#tabs-3">Datos profesionales</a></li>
    <li><a href="#tabs-4">Referencias laborales</a></li>
    <li><a href="#tabs-5">Estatus</a></li>
  </ul>
  <div id="tabs-1">
    <table>
        <tr>
            <td>
                <fieldset>
                    <legend>Nombre Candidato</legend>
                    <table style="padding:5px;" cellspacing="5">
                        <tr >
                            <td><input type="text" id="nomCandid" name="nomCandid" value="'.$v['nomCandid'].'" /></td>
                            <td><input type="text" id="appCandid" name="appCandid" value="'.$v['appCandid'].'" /></td>
                            <td><input type="text" id="apmCandid" name="apmCandid" value="'.$v['apmCandid'].'" /></td>

                        </tr>
                        <tr style="text-align: center;">
                            <td>Nombre</td>
                            <td>Apellido paterno</td>
                            <td>Apellido materno</td>

                        </tr>
                        <tr>
                            <td><input type="text" id="fechaNCandid" name="fechaNCandid" value="'.$v['fecNCandid'].'"></td>
                            <td><input type="text" id="nacionalidadCandid" name="nacionalidadCandid" value="'.$v['nacionalidadCandid'].'"/></td>
                            <td>
                            <label for="generoCandidato">Género</label>
                            <select id="generoCandidato" name="generoCandidato">
                               <option value="M" '.$selectedM.'>Masculino</option>
                               <option value="F" '.$selectedF.'>Femenino</option>
                            </select>
                        </tr>
                        <tr style="text-align: center;">
                            <td>Fecha de nacimiento</td>
                            <td>Nacionalidad</td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td>
                <fieldset>
                    <legend>Residencia</legend>
                    <table style="padding:4px;" cellspacing="5">
                        <tr>
                            <td><input type="text" id="domCandid" name="domCandid" value="'.$v['domCandid'].'" style="width:300px"/></td>
                            <td><input type="text" id="coloniaCandid" name="coloniaCandid" value="'.$v['coloniaCandid'].'" style="width:200px;"/></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>Domicilio</td>
                            <td>Colonia</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table style="width:100%; text-align: center;">
                                    <tr>
                                        <td><input type="text" id="cpCandid" name="cpCandid" value="'.$v['cpCandid'].'"/></td>
                                        <td><input type="text" id="municipioCandid" name="municipioCandid" value="'.$v['municipioCandid'].'"/></td>
                                        <td><input type="text" id="entidadCandid" name="entidadCandid" value="'.$v['entidadCandid'].'"/></td>
                                    </tr>
                                    <tr>
                                        <td>C. P.</td>
                                        <td>Municipio</td>
                                        <td>Estado</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                    <fieldset>
                    <legend>Forma de contacto</legend>
                        <table style="width:250px">
                            <tr>
                                <td><input type="text" id="celCandid" name="celCandid" value="'.$v['celCandid'].'"/></td>
                                <td><input type="text" id="telCandid" name="telCandid" value="'.$v['telCandid'].'"/></td>
                                <td><input style="width:250px;" type="text" id="mailCandid" name="mailCandid" value="'.$v['mailCandid'].'"/></td>
                                <td><input style="width:250px;" type="text" value="'.$v['skypeCandid'].'"/></td>

                            </tr>
                            <tr style="text-align: center;">
                                <td>Celular</td>
                                <td>Teléfono</td>
                                <td>Correo Electronico</td>
                                <td>Skype</td>
                            </tr>
                        </table>
                    </fieldset>
                </fieldset>
            </td>
        </tr>
    </table>
  </div>

  <div id="tabs-2">
            <fieldset style="text-align: left;">
            <legend>Historial Académico</legend>
                <center>
                <table style="padding:5px;" cellspacing="5">
                    <tr>
                        <td><input type="text" id="carreraCandid" name="carreraCandid" value="'.$v['carreraCandid'].'" style="width:250px"/></td>
                        <td>
                            <label for="nvlestudiosCandid">Nivel de estudios: </label>
                                <select id="nvlestudiosCandid" name="nvlestudiosCandid">
                                    <option '.$selTitulado.' value="Titulado">Titulado</option>
                                    <option '.$selPasante.' value="Pasante">Pasante</option>
                                    <option '.$selTrunco.' value="Trunco">Trunco</option>
                                </select>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td>Carrera</td>
                        <td>Nivel</td>
                    </tr>
                 </table>
                 </center>
                 <table>
                    <tr>
                        <td><fieldset><legend>Certificaciones</legend><textarea id="otros" name="otros" style="width:500px">'.$v['otros'].'</textarea></fieldset></td>
                        <td><fieldset><legend>Idiomas</legend><textarea id="idiomas" name="idiomas" style="width:400px">'.$v['idiomasCandid'].'</textarea></fieldset></td>
                    </tr>
                </table>
        </fieldset>
  </div>

  <div id="tabs-3">
            <table style="padding:5px;" cellspacing="5">
            <tr>
                <td>
                    <label for="tbjoactualCandid">¿Tabaja actualmente?: </label>
                        <select id="tbjoactualCandid" name="tbjoactualCandid">
                            <option '.$selSi.' value="Si">Si</option>
                            <option '.$selNo.' value="No">No</option>
                        </select>
                </td>
                <td>
                    <label for="salarioCandid">Último salario: </label>
                    <input type="text" id="salarioCandid" name="salarioCandid" value="$'.$v['ultimosalarioCandid'].'"/>
                </td>
                <td>
                    <label for="pretensionesminCandid">Pretensiones min: </label>
                    <input type="text" id="pretensionesminCandid" name="pretensionesminCandid" value="$'.$v['pretensionesminCandid'].'"/>
                </td>
                <td>
                    <label for="pretensionesmaxCandid">Pretensiones max: </label>
                    <input type="text" id="pretensionesmaxCandid" name="pretensionesmaxCandid" value="$'.$v['pretensionesmaxCandid'].'"/>
                </td>
                <td>
                    <label for="viajasCandid">¿Disponibilidad de viajar?: </label>
                    <select id="viajasCandid" name="viajasCandid">
                        <option '.$selvSi.' value="Si">Si</option>
                        <option '.$selvNo.' value="No">No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>Conocimientos</legend>
                                    <textarea id="conocimientosCandid" name="conocimientosCandid" style="width:98%; height: 200px;">'.$v['conocimientosCandid'].'</textarea>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <legend>Áreas de interes</legend>
                                    <textarea id="areasintCandid" name="areasintCandid" style="width:98%; height: 200px;">'.$v['areasintCandid'].'</textarea>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <legend>Áreas de experiencia</legend>
                                    <textarea id="areasexpCandid" name="areasexpCandid" style="width:98%; height: 200px;">'.$v['areasexpCandid'].'</textarea>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
  </div>

 <div id="tabs-4">

                ';
                    $i=0;
                    foreach ($referencias as $k => $r) {
                        echo '
                        <fieldset id="fieldset'.$i.'" style="text-align:left;">
                            <legend>Referencia</legend>  
                            <center>
                            <table style="padding:5px;" cellspacing="5">
                                <tr>
                                    <td><input type="text" value="'.$r['nomrefCandid'].'" style="width:250px"/></td>
                                    <td>
                                        <input type="text" value="'.$r['telrefCandid'].'"/>
                                    </td>
                                    <td>
                                        <input type="text" value="'.$r['relrefCandid'].'"/>
                                    </td>
                                    <td>
                                        <span></span>
                                    </td>
                                </tr>
                                <tr style="text-align: center;">
                                    <td>Nombre de referencia</td>
                                    <td>Teléfono de referencia</td>
                                    <td>Relación</td>
                               </tr>
                                ';
                        $resultadosReferencia=$candidato->resultado_referencia($r['idReferencia']);
                        if(count($resultadosReferencia)==0){
                            echo '<tr><td colspan="3"> <input type="button" onclick="abrirResultados('.$r['idReferencia'].','.$i.');" value="+"/>
                                        </td></tr>';
                            /**
                             * CHECAR PORQUE SE ENVIA EL FORMULARIO CON CUALQUIER BOTON!!!!
                             * <span class="regResultados" onclick="abrirResultados('.$r['idReferencia'].','.$i.');">Registrar Resultado</span>
                                       <span class="guardarResultados" onclick="registrarResultados()" style="display:none;">Guardar</span>
                             */
                        }
                        foreach ($resultadosReferencia as $k => $rr) {
                            /*Resultados de la consulta*/
                        }
                        echo '</table>
                              </center>
                        </fieldset>';
                        $i++;
                    }
                    
        echo' 

  </div>

<div id="tabs-5">
            <table>
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>Descripción de estatus</legend>
                                    <textarea id="estatusCandid" name="estatusCandid" style="width:900px; height: 200px;">'.$v['descEstatus'].'</textarea>
                                </fieldset>
                            </td>
                         </tr>
                         
                    </table>
  </div>
</div>
<input type="hidden" id="idCandid" name="idCandid" value="'.$v['idCandid'].'">
</form>
<span id="edit" onclick="abrirCampos();">Editar información</span>
<span id="guardar" onclick="actualizarCampos();" style="display:none">Guardar</span>
';
}
?>

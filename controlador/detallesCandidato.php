<?php
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
  .datos{text-align: center; font-weight:bold;}
  </style>
<?php
foreach ($dato as $k => $v) {
    echo '
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
                        <tr class="datos">
                            <td><input type="text" value="'.$v['nomCandid'].'" /></td>
                            <td><input type="text" value="'.$v['appCandid'].'" /></td>
                            <td><input type="text" value="'.$v['apmCandid'].'" /></td>

                        </tr>
                        <tr style="text-align: center;">
                            <td>Nombre</td>
                            <td>Apellido paterno</td>
                            <td>Apellido materno</td>

                        </tr>
                        <tr>
                            <td><input type="text" value="'.$v['fecNCandid'].'"></td>
                            <td><input type="text" value="'.$v['nacionalidadCandid'].'"/></td>
                            <td><input type="text" value="'.$v['genCandid'].'"/></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>Fecha de nacimiento</td>
                            <td>Nacionalidad</td>
                            <td>Género</td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td>
                <fieldset>
                    <legend>Residencia</legend>
                    <table style="padding:4px;" cellspacing="5">
                        <tr>
                            <td><input type="text" value="'.$v['domCandid'].'" style="width:300px"/></td>
                            <td><input type="text" value="'.$v['coloniaCandid'].'" style="width:200px;"/></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>Domicilio</td>
                            <td>Colonia</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table style="width:100%; text-align: center;">
                                    <tr>
                                        <td><input type="text" value="'.$v['cpCandid'].'"/></td>
                                        <td><input type="text" value="'.$v['municipioCandid'].'"/></td>
                                        <td><input type="text" value="'.$v['entidadCandid'].'"/></td>
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
                                <td><input type="text" value="'.$v['celCandid'].'"/></td>
                                <td><input type="text" value="'.$v['telCandid'].'"/></td>
                                <td><input style="width:250px;" type="text" value="'.$v['mailCandid'].'"/></td>
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
                        <td><input type="text" value="'.$v['carreraCandid'].'" style="width:250px"/></td>
                        <td>
                            <input type="text" value="'.$v['nlvestudiosCandid'].'"/>
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
                        <td><fieldset><legend>Certificaciones</legend><textarea style="width:500px">'.$v['otros'].'</textarea></fieldset></td>
                        <td><fieldset><legend>Idiomas</legend><textarea style="width:400px">'.$v['idiomasCandid'].'</textarea></fieldset></td>
                    </tr>
                </table>
        </fieldset>
  </div>

  <div id="tabs-3">
            <table style="padding:5px;" cellspacing="5">
            <tr>
                <td>
                    <label for="tbjoactualCandid">¿Tabaja actualmente?: </label>
                    <input type="text" id="tbjoactualCandid" value="'.$v['tbjoactualCandid'].'"/>
                </td>
                <td>
                    <label for="pretensionesCandid">Pretensiones económicas: </label>
                    <input type="text" id="pretensionesCandid" value="$'.$v['pretensionesCandid'].'"/>
                </td>
                <td>
                    <label for="viajasCandid">¿Disponibilidad de viajar?: </label>
                    <input type="text" id="viajasCandid" value="'.$v['viajasCandid'].'"/>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>Conocimientos</legend>
                                    <textarea  style="width:98%; height: 200px;">'.$v['conocimientosCandid'].'</textarea>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <legend>Áreas de interes</legend>
                                    <textarea  style="width:98%; height: 200px;">'.$v['areasintCandid'].'</textarea>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <legend>Áreas de experiencia</legend>
                                    <textarea style="width:98%; height: 200px;">'.$v['areasexpCandid'].'</textarea>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
  </div>
  
<div id="tabs-5">
            <table>
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>Descripción de estatus</legend>
                                    <textarea style="width:900px; height: 300px;">'.$v['descEstatus'].'</textarea>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
  </div>
</div>';
}
?>

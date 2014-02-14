<?php

?>
<form id="resultadoReferencia">
<div id="panelResultados" style="display:none; border:1px solid #A6C9E2; background-color: #EAF5FE;" class="ui-corner-all">
    <input type="hidden" id="idsReferencia" name="idsReferencia"/>
    <table style="width:100%">
        <tr>
            <td style="width:60%;">
                <fieldset >
                    <legend>Datos laborales</legend>
                    <center>
                    <table style="padding: 5px;">
                        <tr>
                            <td>Periodo que laboró:</td><td> De <input type="fecha"  name="periodoInicio" class="ui-corner-all"/> a: <input type="fecha" name="periodoFinal" class="ui-corner-all"/></td>
                        </tr>
                        <tr>
                            <td>Sueldo que percibía:</td><td> $<input type="text" id="sueldoPercibido" name="sueldoPercibido" class="ui-corner-all"/> pesos mensuales</td>
                        </tr>
                        <tr>
                            <td>Motivo de salida:</td><td> <textarea id="motivoSalida" name="motivoSalida" style="width:295px;" class="ui-corner-all" placeholder="Ingrese motivo de salida"></textarea></td>
                        </tr>
                        <tr>
                            <td>Último puesto:</td><td><input type="text" id="ultimoPuesto" name="ultimoPuesto" class="ui-corner-all"/> Volver a contratar: <select id="recontratar" name="recontratar" class="ui-corner-all"><option>...</option><option value="Si">Si</option><option value="No">No</option></select></td>
                        </tr>
                        <tr>
                            <td>Comentarios acerca <br/> del desempeño:</td><td> <textarea id="comentarios" name="comentarios" style="width:295px; height: 50px" class="ui-corner-all" placeholder="Comentarios"></textarea></td>
                        </tr>
                    </table>
                    </center>
                </fieldset>
            </td>
            <td>
                <fieldset>
                    <legend>Evaluación</legend>
                    <table style="padding: 5px; text-align: right;">
                        <tr>
                            <td>Responsabilidad:</td>
                            <td>
                                <select id="responsabilidad" name="responsabilidad" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        
                            <td>Asistencia:</td>
                            <td>
                                <select id="asistencia" name="asistencia" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        <tr>
                            <td>Puntualidad:</td>
                            <td>
                                <select id="puntualidad" name="puntualidad" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                       
                            <td>Actitud con compañeros:</td>
                            <td>
                                <select id="actitud" name="actitud" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Compromiso:</td>
                            <td>
                                <select id="compromiso" name="compromiso" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        
                            <td>Honestidad:</td>
                            <td>
                                <select id="honestidad" name="honestidad" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Relación con superiores:</td>
                            <td>
                                <select id="relacion" name="relacion" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        
                            <td>Iniciativa:</td>
                            <td>
                                <select id="iniciativa" name="iniciativa" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Lealtad:</td>
                            <td>
                                <select id="lealtad" name="lealtad" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        
                            <td>Apego a políticas y procedimientos:</td>
                            <td>
                                <select id="apego" name="apego" class="ui-corner-all">
                                    <option>...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <span class="guardarResultados" onclick="registrarResultados(this)">Guardar</span>
            </td>
        </tr>
    </table>
</div>
    <div id="respResultados" style="display:none;">
        
    </div>
</form>
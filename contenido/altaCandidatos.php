<!--<!doctype html>
<html>
<head>
      <meta charset='utf8'>
        <link type="text/css" href="../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/funcionesCandidato.js"></script>
</head>
<body>
-->
        <div id="conteiner" class="ui-widget">    
            <p align=center><span class='titulo ui-corner-all'>Registro de candidato</span></p> 
            <center>
                <form id="fdatosPersonales">
            <div id="acordeon">
                
                <h3>Datos Personales</h3>
                <div id="datosPersonales"> 
                    
                    <table>
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>Nombre Candidato</legend>
                                    <table style="padding:5px;" cellspacing="5">
                                        <tr>
                                            <td><input type="text" id="nomCandid" name="nomCandid"/></td>
                                            <td><input type="text" id="appCandid" name="appCandid"/></td>
                                            <td><input type="text" id="apmCandid" name="apmCandid"/></td>

                                        </tr>
                                        <tr style="text-align: center;">
                                            <td>Nombre</td>
                                            <td>Apellido paterno</td>
                                            <td>Apellido materno</td>

                                        </tr>
                                        <tr>
                                            <td><input type="text" id="fechaNCandid" name="fechaNCandid" placeholder="dd-mm-aaaa"/></td>
                                            <td><input type="text" id="nacionalidadCandid" name="nacionalidadCandid"/></td>
                                            <td>
                                                <label for="generoCandidato">Género: </label>
                                                <select id="generoCandidato" name="generoCandidato">
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                            </td>
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
                                            <td><input type="text" id="domCandid" name="domCandid" style="width:300px"/></td>
                                            <td><input type="text" id="coloniaCandid" name="coloniaCandid" style="width:200px;"/></td>
                                        </tr>
                                        <tr style="text-align: center;">
                                            <td>Domicilio</td>
                                            <td>Colonia</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table style="width:100%; text-align: center;">
                                                    <tr>
                                                        <td><input type="text" id="cpCandid" name="cpCandid"/></td>
                                                        <td><input type="text" id="municipioCandid" name="municipioCandid"/></td>
                                                        <td><input type="text" id="entidadCandid" name="entidadCandid"/></td>
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
                                                <td><input type="text" id="celCandid" name="celCandid"/></td>
                                                <td><input type="text" id="telCandid" name="telCandid"/></td>
                                                <td><input type="text" id="mailCandid" name="mailCandid"/></td>

                                            </tr>
                                            <tr style="text-align: center;">
                                                <td>Celular</td>
                                                <td>Teléfono</td>
                                                <td>Correo Electronico</td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                       
                </div>
                
                <h3>Datos Académicos</h3>
                <div id="datosAcademicos">
                   
                    <fieldset style="text-align: left;">
                        <legend>Historial Académico</legend>
                    <table style="padding:5px;" cellspacing="5">
                        <tr>
                            <td><input type="text" id="carreraCandid" name="carreraCandid" style="width:250px"/></td>
                            <td>
                                <label for="nvlestudiosCandid">Nivel de estudios: </label>
                                <select id="nvlestudiosCandid" name="nvlestudiosCandid">
                                    <option>Seleccione...</option>
                                    <option value="Titulado">Titulado</option>
                                    <option value="Pasante">Pasante</option>
                                    <option value="Trunco">Trunco</option>
                                </select>
                            </td>
                            <td><input type="text" id="otros" name="otros" style="width:500px;"/></td>
                            <td><input type="text" id="idiomas" name="idiomas"/></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td>Carrera</td>
                            <td></td>
                            <td>Otros estudios y/o Certificaciones</td>
                            <td>Idiomas</td>
                        </tr>
                    </table>
                    </fieldset>
                    
                </div>

                <h3>Datos Profesionales</h3>  
                <div id="datosProfesionales">
                    
                    <table style="padding:5px;" cellspacing="5">
                        <tr>
                            <td>
                                <label for="tbjoactualCandid">¿Tabaja actualmente?: </label>
                                <select id="tbjoactualCandid" name="tbjoactualCandid">
                                    <option>Seleccione...</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <label for="pretensionesCandid">Pretensiones económicas: </label>
                                $<input type="text" id="pretensionesCandid" name="pretensionesCandid" />
                            </td>
                            <td>
                                <label for="viajasCandid">¿Disponibilidad de viajar?: </label>
                                <select id="viajasCandid" name="viajasCandid">
                                    <option>Seleccione...</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table style="width:100%">
                                    <tr>
                                        <td>
                                            <fieldset>
                                                <legend>Conocimientos</legend>
                                                <textarea id="conocimientosCandid" name="conocimientosCandid" style="width:98%; height: 200px;"></textarea>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <fieldset>
                                                <legend>Áreas de interes</legend>
                                                <textarea id="areasintCandid" name="areasintCandid" style="width:98%; height: 200px;"></textarea>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <fieldset>
                                                <legend>Áreas de experiencia</legend>
                                                <textarea id="areasexpCandid" name="areasexpCandid" style="width:98%; height: 200px;"></textarea>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                     
                </div>
                
                <h3>Referencias Laborales</h3>  
                <div id="referenciasLaborales">
                    
                    <table>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                      
                </div>
                
                <h3>Estatus</h3>  
                <div id="estatusCandidato">
                    
                    <table>
                        <tr>
                            <td>
                                <fieldset>
                                    <legend>Descripción de estatus</legend>
                                    <textarea id="estatusCandid" name="estatusCandid" style="width:500px; height: 200px;"></textarea>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="colorEstatus">Estatus: </label>
                                <select id="colorEstatus" name="colorEstatus">
                                    <option>Seleccione...</option>
                                    <option value="#F00" style="background-color: #F00;">No volver a marcar</option>
                                    <option value="#EDEF7D" style="background-color: #EDEF7D;">Potencial</option>
                                    <option value="#6CE26C" style="background-color: #6CE26C;">Finalista</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                      
                </div>  
                
            </div>   
                    </form> 
            </center>
            <div id="btnsC">
                    <span id="enviar" onclick="guardarCandidato();">Guardar</span>
                    <span id="back" onclick="abrirpanelListar();">Regresar</span>           
            </div>       
    </div>
    <div id='res'class="ui-widget ui-corner-all" style="display:none;background-color:#D5E8F6; height: 500px;">
        
    </div>
<!--
</body>
</html>
-->

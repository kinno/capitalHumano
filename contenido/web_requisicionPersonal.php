<?php 
header("Content-Type: text/html;charset=utf-8");
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;
  ?>
<!doctype html>
<html lang='es'>
<head>
    <meta charset='utf8'>
    
         <!-- Librerias de jquery --> 
        <script src="../js/jquery.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
        
        <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.highlight.js"></script>
        <script src="../js/funcionesSolicitudes.js" type="text/javascript"></script>

             <!-- Hojas de estilo-->
         <link href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
         <link type="text/css" href="../css/demo_table.css" rel="stylesheet" />
        <!-- Estilo para el "selectable"-->
        <style>
        #feedback { font-size: 12px; }
        #selectable .ui-selecting { background: #FECA40; }
        #selectable .ui-selected { background: #F39814; color: white; }
        #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
        #selectable li { margin: 3px; padding: 0.4em; font-size: 10px;; height: 18px; }
        </style>
       
 
</head>
<body>
<div class="ui-widget">    
        <p align=center><span class='titulo ui-corner-all'>Requisición de Personal</span></p> 
        <form id="solicitud">
        <center>
        <div id="acordeon">
            <h3>Datos Generales</h3>
            <div class="datGenerales" id="datGenerales" class="acor">
                <div class="folio" id="folio" style="text-align: right; ">
                  <?php
                   include_once("../funciones/funciones.php");
                   $folio=GenFolios();
                   echo '<label for="folio">Folio: </label>';
                   echo '<input type="text" id="folios" value='.$folio.' readonly="readonly" style="text-align:center" ></input>';
                  ?>
                  </div>
                <table>
                    <tr >
                        <td align="center">
                            <label>Proyecto:</label><br/>
                            <?php
                               include_once("../funciones/funciones.php");
                               $listaProyec=ComboProyecto(); //función que devuelve un combo box con los proyectos del catálogo de proyectos
                               echo $listaProyec;
                            ?><br>
                            <span id="suproyecto">
                               
                            </span>
                        </td>
                    </tr>
                 </table>   
                <table>
                    <tr>
                        <td>
                            <fieldset style="text-align: left">
                                <legend>Tipo de Vacante</legend>
                                <center>
                                <input type="radio" class="rRequerido1" name="tipoVacante" value="1" id="creacion" />
                                Nuevo
                                <input type="radio" class="rRequerido1" name="tipoVacante" value="2" id="remplazo" />
                                Remplazo 
                                <input type="radio" class="rRequerido1" name="tipoVacante" value="3" id="temporal" />
                                Temporal
                                </center>
                              </fieldset>
                            <fieldset style="text-align: left">
                                <legend>Duración</legend>
                                Inicio: <input type="fecha" id="inicioD"> Termino: <input type="fecha" id="finalD">
                            </fieldset>
                        </td>
                    </tr>
                </table>

          </div>
            <h3>Descripción del Puesto</h3>
            <div class="descPuesto" id="descPuesto" >                  
                <!-- Emulando una tabla con contenedores-->        
                <table >
                    <tr >
                        <td with="300px;">
                            <label>Puesto:</label><span id="catperf" style="float:right" onclick="verPerfiles();" title="Buscar perfil"></span><br/>
                             <textarea id="perfil" readonly="readonly" rows='1' cols='40' ></textarea>
                             
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <label for="nVacante">Número de Puestos:</label>
                            <input id="nVacante" name="nVacante" value="1" readonly/>
                            
                        </td>
                    </tr>
                </table>
                <table>
                    <tr >
                        <td>
                            <fieldset style="text-align:left;width: auto;">
                                <legend>Horario Laboral:</legend>
                                <table>
                                    <tr>
                                        <td>Dias de Trabajo:</td>
                                        <td>
                                            <input type="hidden" id="diasTrabajo">
                                            <ol id="selectable">
                                              <li class="ui-widget-content">Lunes</li>
                                              <li class="ui-widget-content">Martes</li>
                                              <li class="ui-widget-content">Miércoles</li>
                                              <li class="ui-widget-content">Jueves</li>
                                              <li class="ui-widget-content">Viernes</li>
                                              <li class="ui-widget-content">Sábado</li>
                                              <li class="ui-widget-content">Domingo</li>
                                            </ol>
                                            <!--
                                            <select name="diasTrabajo" size="1" id="diasTrabajo" style="width:150px;">
                                            <option value="vacio" selected="selected"> </option>
                                            <option value="lunVie">Lunes-Viernes</option>
                                            <option value="lunSab">Lunes-Sábado</option>
                                            </select>
                                            -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Horario de Trabajo:</td>
                                        <td>
                                            <p>
                                                <input type="text" id="horario" style="border: 0; color: #f6931f; font-weight: bold; text-align: center;" />
                                              </p>
                                              <div id="slider-range"></div>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                        <td>
                            <fieldset id="fechLugar"  style="margin-top: -136px;text-align:left;width: auto">
                                <legend>Fecha y Lugar</legend>
                                <table>
                                    <tr>
                                        <td>
                                            Fecha de Requisición:
                                        </td>
                                        <td>
                                            <?php
                                            /*
                                             * METODO PARA CALCULAR LA FECHA DE SOLICITUD DE PERSONAL
                                             * DESPUÉS DE LAS 6PM SE REGISTRA LA SOLICITUD UN DÍA DESPUÉS
                                             * 
                                             */
                                            $horaActual=strtotime(date("H:i"));
                                            $horaValida = strtotime("18:00");
                                            if($horaActual>$horaValida){
                                                echo 'Despues de ';
                                                $fechaValida = strtotime ( '+1 day' , strtotime ( date("d-m-Y") ) ) ;
                                                $fechaValida = date ( 'd-m-Y' , $fechaValida );
                                            }
                                            else{
                                                echo 'Antes de';
                                                $fechaValida = date("d-m-Y");
                                            }
                                            ?>
                                            <input type="text" id="fechaRequi" readonly="readonly" value="<?php echo $fechaValida; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Lugar de Trabajo:
                                        </td>
                                        <td>
                                            <?php
                                                $lugar=  comboLugares();
                                                echo $lugar;
                                            ?>
                                        </td>
                                    </tr>
                                </table>

                            </fieldset>
                            
                            
                            <fieldset id="rangoSal"  style="text-align:left;width: 300px;">
                                <legend>Percepciones:</legend>
                                <table>
                                    <tr>
                                        <td>
                                            Salario Mínimo:
                                        </td>   
                                        <td>
                                            $<input type="text" name="salarioMin" class="requerido" id="salarioMin" style="width:150px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Salario Máximo:
                                        </td>
                                        <td>
                                            $<input type="text" name="salarioMax" class="requerido" id="salarioMax" style="width:150px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Otras Percepciones:
                                        </td>
                                        <td>
                                             &nbsp;&nbsp;<input type="text" name="otrasPercep" id="otrasPercep" style="width:150px;"/>
                                        </td>

                                    </tr>
                                </table>

                            </fieldset>
                        </td>
                    </tr>
                </table>
          </div>

            <h3>Requisitos para el Puesto</h3>  
            <div class="requisitos" id="requisitos" >

                <table>
                    <tr >
                        <td>
                            <fieldset >
                                <legend>Descripción de Perfil </legend>
                                 <label>Escolaridad y Experiencia:</label><br/>
                                 <textarea id="Esco-Expi" rows='5' cols='80' readonly="readonly"></textarea> <br />
                                 <label>Conocimientos:</label><br/>
                                 <textarea id="conoc"  rows='5' cols='80' readonly="readonly" ></textarea><br />
                                 <label>Habilidades:</label><br/>
                                 <textarea id="habi" rows='5' cols='80' readonly="readonly" ></textarea><br />
                                 <label>Descripción de Actividades:</label><br/>
                                 <textarea id="activi" rows='5' cols='80'></textarea><br />
                            </fieldset>
                        </td>
                        <td>
                            <fieldset style="text-align:left;width: 300px;">
                                <legend>Otros Requisitos</legend>
                                <div>

                                    <fieldset style="text-align:left; width:auto;" >
                                        <legend>Idiomas</legend> 
                                           <label>
                                           <input type="checkbox"  name="idioma1" value="1" id="idiomas_0" onclick="mostrar('ingles'); verifCheck(this.id);" />          
                                           Inglés</label>
                                           <span id="ingles" style="display:none">
                                            Hablado: <input id="pHablado1" class="spinnerPorcentaje" name="pHablado1" value="0" style="width:25px;" readonly/>%  Escrito: <input id="pEscrito1" class="spinnerPorcentaje" name="pEscrito1" value="0" style="width:25px;" readonly/>%
                                           </span>
                                           <br/>
                                           <label>
                                           <input type="checkbox" name="idioma2" value="2" id="idiomas_1" onclick="mostrar('frances'); verifCheck(this.id)"  />
                                           Francés</label> 
                                           <span id="frances" style="display:none">
                                                Hablado: <input id="pHablado2" class="spinnerPorcentaje" name="pHablado2" value="0" style="width:25px;" readonly/>%  Escrito: <input id="pEscrito2" class="spinnerPorcentaje" name="pEscrito2" value="0" style="width:25px;" readonly/>%
                                            </span>
                                           <br/>
                                           <label>
                                           <input type="checkbox" name="idioma3" value="3" id="idiomas_2" onclick="mostrar('aleman');verifCheck(this.id)" />
                                           Alemán</label>
                                           <span id="aleman" style="display:none"> 
                                            Hablado: <input id="pHablado3" class="spinnerPorcentaje" name="pHablado3" value="0" style="width:25px;" readonly/>%  Escrito: <input id="pEscrito3" class="spinnerPorcentaje" name="pEscrito3" value="0" style="width:25px;" readonly/>%
                                            </span>
                                           <br/>
                                           <label>
                                           <input type="checkbox" name="idioma4" value="4" id="idiomas_3" onclick="mostrar('portugues');verifCheck(this.id)" />
                                           Portugués</label> 
                                           <span id="portugues" style="display:none">
                                             Hablado: <input id="pHablado4" class="spinnerPorcentaje" name="pHablado4" value="0" style="width:25px;" readonly/>%  Escrito: <input id="pEscrito4" class="spinnerPorcentaje" name="pEscrito4" value="0" style="width:25px;" readonly/>%
                                           </span>
                                           </fieldset>

                                    </div>
                                        <div id="VyC" style="margin-top: 10px;">
                                           <fieldset>
                                                <legend>¿Requiere viajar?</legend>
                                                <input type="radio" class="rRequerido2" name="reqViajar" value="1" id="si" onclick="muestraFrecuencia(id)"/>
                                                 Si
                                                <input type="radio" class="rRequerido2" name="reqViajar" value="0" id="no" onclick="muestraFrecuencia(id)" />
                                                 No 
                                                 <div id="frec" style="display: none;">
                                                 <label for="frecuencia">¿Con qué Frecuencia?</label>
                                                 <input type="text" name="frecuencia" id="frecuencia" />
                                                 </div>

                                            </fieldset>
                                           <br/>

                               </div>
                            </fieldset>   
                                <div style="clear:both; margin-top:10px">
                                    <label>Comentarios:</label><br/>
                                    <textarea name="comentarios" id="comentarios"  rows='11' cols='60' ></textarea> 
                                </div>

                        </td>
                    </tr>
                </table>
            </div>   
        </div>        
        </center>
        </form>
        <span>
                <button name="Enviar" id="enviar" onclick="envia();"/>Enviar</button>
                <div id='res'class="ui-widget" style="float: right;width:400px;"></div>
        </span>


        
</div>
<div id="ventanaPerfil" title="Seleccionar un perfil">
    <div id="contDialog" ></div>
</div>  
</body>
</html>

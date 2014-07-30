<?php
//include"../libs/libs.php";
echo "
    <center>
    <fieldset class='ui-widget'>
        <legend>Detalle del Perfil</legend>
        <form id='formPerfil'>
               
                <table class='ui-widget'>
                        <tr>
                                <td>Descripción de Perfil</td>
                                <td >
                                <input type='text' name='descPerfil' id='descPerfil' class='texto'>
                                </td>
                        </tr>
                        <tr>
                                <td>Complejidad</td>
                                <td >
                                <input type='text' name='compPerfil' id='compPerfil' class='texto'>
                                </td>
                        </tr>
                 </table>
                 <table class='ui-widget'>
                        <tr>
                                <td>
                                    <fieldset>
                                        <legend>Estudios</legend>
                                        <textarea style='width:345px; height:100px;' name='perfPerfil' id='perfPerfil' ></textarea></td>
                                    </fieldset>   
                                <td >
                                    <fieldset>
                                        <legend>Conocimientos</legend>
                                        <textarea style='width:345px; height:100px;' name='conocPerfil' id='conocPerfil' ></textarea></td>
                                    </fieldset>   
                                </td>
                        </tr>
                        <tr>
                                <td>
                                    <fieldset>
                                        <legend>Habilidades</legend>
                                        <textarea style='width:345px; height:100px;' name='habPerfil' id='habPerfil' ></textarea></td>
                                    </fieldset>   
                                <td >
                                    <fieldset>
                                        <legend>Funciones</legend>
                                        <textarea style='width:345px; height:100px;' name='funcPerfil' id='funcPerfil' ></textarea></td>
                                    </fieldset>   
                                </td>
                        </tr>
                </table>
                
        </form>
    </fieldset>
    <span id='guardarDatos' onclick='registrarPerfil();'>Guardar</span>
    </center>
    "; 
?>
<?php
session_start();
include '../funciones/libCatalogos.php';
$catalogos=new Catalogos();
$datos = $catalogos->detalle_perfiles($_POST['id']);

foreach ($datos as $k => $v) {
echo "
    <center>
    <fieldset>
        <legend>Detalle del Perfil</legend>
        <form id='formPerfil'>
               
                <table class='ui-widget'>
                        <tr>
                                <td>Descripción de Perfil</td>
                                <td ><input type='hidden' id='idPerfil' name='idPerfil' value='".$v['idPerfil']."'>
                                <input type='text' name='descPerfil' id='descPerfil' class='texto' value='".$v['descPerfil']."'>
                                </td>
                        </tr>
                        <tr>
                                <td>Complejidad</td>
                                <td >
                                <input type='text' name='compPerfil' id='compPerfil' class='texto' value='".$v['compPerfil']."'>
                                </td>
                        </tr>
                 </table>
                 <table class='ui-widget'>
                        <tr>
                                <td>
                                    <fieldset>
                                        <legend>Estudios</legend>
                                        <textarea style='width:345px; height:100px;' name='perfPerfil' id='perfPerfil' >".$v['perfPerfil']."</textarea></td>
                                    </fieldset>   
                                <td >
                                    <fieldset>
                                        <legend>Conocimientos</legend>
                                        <textarea style='width:345px; height:100px;' name='conocPerfil' id='conocPerfil' >".$v['conocPerfil']."</textarea></td>
                                    </fieldset>   
                                </td>
                        </tr>
                        <tr>
                                <td>
                                    <fieldset>
                                        <legend>Habilidades</legend>
                                        <textarea style='width:345px; height:100px;' name='habPerfil' id='habPerfil' >".$v['habPerfil']."</textarea></td>
                                    </fieldset>   
                                <td >
                                    <fieldset>
                                        <legend>Funciones</legend>
                                        <textarea style='width:345px; height:100px;' name='funcPerfil' id='funcPerfil' >".$v['funcPerfil']."</textarea></td>
                                    </fieldset>   
                                </td>
                        </tr>
                </table>
                
        </form>
    </fieldset>
    <span id='guardarDatos' onclick='modificaPerfil();'>Guardar</span>
    </center>
    ";    
}
?>



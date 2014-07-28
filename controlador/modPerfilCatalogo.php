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
        <form id='formUsr'>
               
                <table class='ui-widget'>
                        <tr>
                                <td colspan='2' >Descripción de Perfil</td>
                                <td ><input type='hidden' id='idPerfil' name='idPerfil' value='".$v['idPerfil']."'>
                                <input type='text' name='nombreUs' id='nombreUs' class='texto' value='".$v['descPerfil']."'>
                                </td>
                        </tr>
                        <tr>
                                <td colspan='2'></td>
                                <td ><input type='hidden' id='idPerfil' name='idPerfil' value='".$v['idPerfil']."'>
                                <input type='text' name='nombreUs' id='nombreUs' class='texto' value='".$v['descPerfil']."'>
                                </td>
                        </tr>
                </table>
                
        </form>
    </fieldset>
    <span id='guardarDatos' onclick='modificaUsuario();'>Guardar</span>
    </center>
    ";    
}
?>



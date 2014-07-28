<?php
session_start();
include '../funciones/libCatalogos.php';
$catalogos=new Catalogos();
$datos = $catalogos->detalle_usuario($_POST['id']);

foreach ($datos as $k => $v) {
echo "
    <center>
    <fieldset>
        <legend>Información del Usuario</legend>
        <form id='formUsr'>
               
                <table class='ui-widget'>
                        <tr>
                                <td colspan='2' >Nombre</td>
                                <td ><input type='hidden' id='idUs' name='idUs' value='".$v['id']."'>
                                <input type='text' name='nombreUs' id='nombreUs' class='texto' value='".$v['nomUsuario']."'>
                                </td>
                        </tr>
                        <tr>
                                <td colspan='2'>Apellido Paterno</td>
                                <td >
                                <input type='text' name='appUs' id='appUs' class='texto' value='".$v['appUsuario']."'>
                                </td>
                        </tr>
                        <tr>
                                <td colspan='2' >Apellido Materno</td>
                                <td >
                                <input type='text' name='apmUs' id='apmUs' class='texto' value='".$v['apmUsuario']."'>
                                </td>
                        </tr>
                        <tr>
                                <td colspan='2' >Correo</td>
                                <td >
                                <input type='text' name='mailUs' id='mailUs'class='texto' value='".$v['mailUsuario']."'>
                                </td>
                        </tr>
                       <tr>
                                <td colspan='2' >Rol</td>
                                <td >
                                <select name='rolUs' id='rolUs' class='sel'>";
                                 $catalogos->comboLimitado($v['idRol']);
                           echo"</select>
                                </td>
                        </tr>
                        <tr>
                                <td colspan='2' >Nombre Usuario</td>
                                <td >
                                <input type='text' name='nickUs' id='nickUs' class='texto' value='".$v['nickUsuario']."'>
                                </td>
                        </tr>
                        <tr><td colspan='2' >Contraseña</td><td class='content'><input type='password' name='pwdUs' id='pwdUs' class='texto' value=''></td></tr>
                </table>
            </form>
      </fieldset>
    <span id='guardarDatos' onclick='modificaUsuario();'>Guardar</span>
    </center>
    ";    
}
?>



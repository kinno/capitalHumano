<?php
 echo '';
?>
<center>
<fieldset class="ui-widget-content">
    <legend>Infomación del lugar</legend>
<form id="formLugar">
    <table class="widget">
        <tr>
            <td style="text-align: right;">
                <label class="ui-widget">Nombre del lugar:</label>
            </td>
            <td>
                <input type="text" name="titulolugar" style='width:600px;'/>                
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                <label class="ui-widget">Dirección:</label>
            </td>
            <td>
                <input type="text" name="direccionlugar" style='width:600px;'/>                
            </td>
        </tr>
        <tr>
            <td style="padding:5px;">
                <span id="btonGuardar" onclick='addLugar();'>Guardar</span>
                <span id="btonCancel" onclick='cancelAddLugar();'>Cancelar</span>
            </td>
            <td>                  
            </td>
        </tr>
    </table>
</form>
</fieldset>
</center>
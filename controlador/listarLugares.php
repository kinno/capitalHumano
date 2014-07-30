<?php
include"../funciones/libCatalogos.php";
$catalogo = new Catalogos();
$lugares=$catalogo->despliega_lugares();
$resLugares = "<div> <span id='btonAddLug' title='Agregar nuevo lugar' onclick='agregarLugar();'>Agregar nuevo</span>
                <table cellpadding='0' cellspacing='0' border='0' class='solicitudes ui-widget' id='listaLugares'>
                    <thead>
                        <tr>
                            <th>
                                Lugar
                            </th>
                            <th>
                                Direcci&oacute;n
                            </th>
                            <th>
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>";
foreach ($lugares as $lugar) {    
    $resLugares .="     <tr>
                            <td>
                                ".$lugar['titulolugar']."
                            </td>
                            <td>
                                ".$lugar['direccionlugar']."
                            </td>
                            <td>
                                <span title='Modificar Lugar' class='btonModLug' onclick='setLugar(".$lugar["idlugar"].",".'"'.$lugar['titulolugar'].'"'.",".'"'.$lugar['direccionlugar'].'"'.",this);'></span>
                                <span title='Eliminar Lugar' class='btonDelLug' onclick='eliminaLugar(".$lugar["idlugar"].",this);'></span>
                            </td>
                        </tr>";
}
$resLugares .="    </tbody>
                </table>
                </div>
                <div id='dialogSetLugar' style='display:none;' title='Actualizar informaci&oacute;n del lugar'>
                    <fieldset class='ui-widget-content'>
                        <legend>Infomación del lugar</legend>
                        <form id='formLugar'>
                            <table class='widget'>
                                <tr>
                                    <td style='text-align: right;'>
                                        <label class='ui-widget'>Nombre del lugar:</label>
                                    </td>
                                    <td>
                                        <input type='hidden' name='idlugar' id='idlugar'/>                
                                        <input type='text' name='titulolugar' id='titulolugar' style='width:600px;'/>                
                                    </td>
                                </tr>
                                <tr>
                                    <td style='text-align: right;'>
                                        <label class='ui-widget'>Dirección:</label>
                                    </td>
                                    <td>
                                        <input type='text' name='direccionlugar' id='direccionlugar' style='width:600px;'/>                
                                    </td>
                                </tr>                                
                            </table>
                        </form>
                    </fieldset>
                </div>";
echo $resLugares;
?>
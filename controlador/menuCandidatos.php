<?php


?>
<div style='padding-top:15px; height: auto;'>
    <div id='menuCandidatos' style='background-color:#FDF3CB; width:150px; margin-left:15px; float: left;'>
        <table style="width: 100%">
            <tr>
                <td>
                    Menú
                </td>    
            </tr>
            <tr>
                <td>
                    <ul style="list-style: none; padding:0px;">
                        <li onclick="listarCandidatos();">Candidatos</li>
                        <li onclick="listarEntrevistas();">Entrevistas</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <div id='containerCandidatos' style='width:83%; height:215px; overflow-y:scroll ;background-color:#ECEFF5;margin-left:180px; padding:15px; display:none;'></div>
    <div id='containerEntrevistas' style='width:83%; height:150px;overflow-y:scroll; background-color:#ECEFF5;margin-left:180px; padding:15px; display:none;'></div>
</div>
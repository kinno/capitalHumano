<?php

?>
<div style='padding-top:15px; height: auto;' class="ui-widget">
    <div id='menuCandidatos' style='width:150px; margin-left:15px; float: left;'>
        <div class="ui-corner-all" style="background-color: #87B6DA;text-align: center;font-size: 12px;font-weight: bold; padding:15px;">
            <div id="radios">  
            <span class="btnCandidatos" onclick="listarCandidatos();">Candidatos</span>
            <span class="btnEntrevistas" onclick="listarEntrevistas();">Entrevistas</span>
            </div>
        </div> 
    </div>
    <div id='containerCandidatos' class="ui-corner-all" style='width:83%; height:215px; background-color: #f2f8fc; overflow-y:scroll;margin-left:180px; padding:15px; display:none;'></div>
    <div id='containerEntrevistas' style='width:83%; height:150px; background-color: #f2f8fc; overflow-y:scroll; margin-left:180px; padding:15px; display:none;'></div>
</div>
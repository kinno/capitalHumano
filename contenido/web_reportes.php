<html lang='es'>
<head>
	
	<meta charset='utf8'>
        <link type="text/css" href="../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/funcionesReportes.js"></script>
</head>
<body>
    <div class="ui-widget">
        <center>
        <div id="mnuReportes">
           <!--<input type="radio" name="radio" id="general"><label for="general">Reporte general</label>-->
            <input type="radio" name="radio" id="proyecto" onclick="panelProyecto()"><label for="proyecto">Reporte por proyecto</label>
            <input type="radio" name="radio" id="reclutador" onclick="panelReclutador()"><label for="reclutador">Reporte por reclutador</label>
        </div>
        </center>
    </div>
    <div id="reportesContainer" class="ui-widget">
        <!--<div id="divGeneral" style="display:none"></div>-->
        <div id="divProyecto" style="display:none">
            <div id="selectProyecto" class="ui-widget"></div>
            <div id="rProyecto" class="ui-widget ui-widget-content ui-corner-all" style="display:none; margin-top: 15px;"></div>
        </div>
        <div id="divReclutador" style="display:none">
            <div id="selectReclutadores" class="ui-widget"></div>
            <div id="rReclutador" class="ui-widget ui-widget-content ui-corner-all" style="display:none; margin-top: 15px;"></div>
        </div>
    </div>
</body>
</html>
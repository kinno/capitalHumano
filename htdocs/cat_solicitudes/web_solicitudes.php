<!doctype html>
<html lang='es'>
<head>
	
	<meta charset='utf8'>
        <link type="text/css" href="../../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/funcionesSolicitudes.js"></script>
        
        <script>
            cargarSolicitudes();
        </script>
</head>
<body>
    <div class="ui-widget">
    <p align="center"><span class='titulo ui-corner-all' id='candidato'>Catálogo de Solicitudes</span></p>
    <article id="contenido" class="ui-widget-content">
    </article>    
    <div id="ventanaSolicitud" title="Detalles de la Solicitud">
            <div id="contDialog"></div>
      </div>
    </div>
</body>
</html>
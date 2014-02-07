<!doctype html>
<html>
<head>
      <meta charset='utf8'>
        <link type="text/css" href="../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/funcionesCandidato.js"></script>
<script>
            cargarCandidatos();
</script>
</head>
<body>
    <div class="ui-widget">
        <p align="center"><span class='titulo ui-corner-all' id='candidato'>Catálogo de candidatos</span></p>
        <article id="contenido" style="border:none;" class="ui-widget-content">
        </article>    
    </div>
    
    <div id="nuevoCandidato" title="Agregar nuevo vacante">
            <div id="contDialog"></div>
    </div>
</body>
</html>

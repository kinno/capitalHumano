<html lang='es'>
<head>
	
	<meta charset='utf8'>
        <link type="text/css" href="../css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="../js/funcionesCatalogos.js"></script>
</head>
<body>
    <div class="ui-widget" style="float: left; margin-left: 20px">
       <ul id="menu">
        <li><a href="#" id="catUsuarios" onclick="despliegaUsuarios();"><div><span class="ui-icon ui-icon-person"></span>Usuarios</div></a></li>
        <li><a href="#" id="catPerfiles" onclick="despliegaPerfiles();"><div><span class="ui-icon ui-icon-clipboard"></span>Perfiles</div></a></li>
        <li><a href="#" id="catProyectos" onclick="despliegaProyectos();"><div><span class="ui-icon ui-icon-wrench"></span>Proyectos</div></a></li>
        <li><a href="#" id="catLugares" onclick="despliegaLugares();"><div><span class="ui-icon ui-icon-transferthick-e-w"></span>Lugares</div></a></li>
      </ul>
    </div>
    <div class="ui-widget ui-corner-all" style="border: #217BC0 1px solid ;float:left;margin-left: 40px; width: 85%; height: 90%; padding: 15px;">
        <article id="mainContent" class="ui-widget-content" style="display:none; border: none; height: auto;">
            
        </article>
    </div>
</body>
</html>
<?php
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;

?>

<!doctype html>
<html lang='es'>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title></title>

<!--	<link type="text/css" href="css/style.css" rel="stylesheet" /> -->
<link type="text/css" href="../../css/demo_table.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>

        <script type="text/javascript" languaje="javascript" src="../../js/funcionesUsuario.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.highlight.js"></script>
        
        <link type="text/css" href="../../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" />


	<script type="text/javascript">
	verlistado();
	</script>
        
</head>
<body>
    <div class="ui-widget">  
        <p align="center"><span class='titulo ui-corner-all' id='Usuarios'>Catálogo de Usuarios</span></p>
        <?php
        if($permisosEspeciales==1){
            echo "<center><span class='close' id='nuevo'>Agregar</span></center>";
        }
        ?>
        <article id="contenido" class="ui-widget-content">	
        </article>

        <!-- Dialog que sustituye a la ventana emergente creada anteriormente      
              Realizó: Regino Tabares
        -->
          <div id="nuevoUsuario" title="Registrar nuevo usuario">
              <div id="contDialog"></div>
        </div>
    </div>
</body>
</html>
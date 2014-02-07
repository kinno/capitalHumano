<?php
include_once("../vacantes/libs/libvacantes.php");
$vacantes = new Vacantes();
$datos=$vacantes->consulta_entrevista();
?>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />  
<title>R.H.</title>
<script src="../../js/jquery.js" type="text/javascript"></script>
<script src="../../js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
<script type='text/javascript' src='../js/fullcalendar.js'></script>
<script type='text/javascript' src='../js/funcionesCalendario.js'></script>
<script type='text/javascript' src='../js/jquery.qtip-1.0.0-rc3.js'></script>
<link rel='stylesheet' type='text/css' href='../css/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='../../css/jquery-ui-1.10.3.customblack.css' />

</head>
<body>
    <?php
    $i=0;
    foreach ($datos as $ent){
     echo '<input type="hidden" id="title'.$i.'" value="'.$ent['nomCandid'].' '.$ent['appCandid'].' '.$ent['apmCandid'].'"/>';   
     echo '<input type="hidden" id="start'.$i.'" value="'.$ent['fecEntrev'].'"/>';  
     //echo '<input type="hidden" id="hora'.$i.'" value="'.$ent['horEntrev'].'"/>';
     echo '<input type="hidden" id="lugar'.$i.'" value="'.$ent['lugarEntrev'].'"/>';
     echo '<input type="hidden" id="proyecto'.$i.'" value="'.$ent['nomProyecto'].'"/>';
     echo '<input type="hidden" id="perfil'.$i.'" value="'.$ent['descPerfil'].'"/>';
     
     $i++;        
    }
    echo '<input type="hidden" id="numEventos" value="'.$i.'"/>'
    ?>
    <div id='calendar' style="margin-top:20px; margin-left: auto; margin-right: auto; width: 1250px;"></div>
</body>
</html>
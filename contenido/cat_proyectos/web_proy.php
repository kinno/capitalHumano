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
	<meta charset='utf8'>
	<title></title>

<!--	<link type="text/css" href="css/style.css" rel="stylesheet" /> -->
	<link type="text/css" href="css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/style.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/funcionesTab.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/funcionesEscolaridad.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.highlight.js"></script>
	<script type='text/javascript' src='../js/libs.js'></script>
	<script type="text/javascript">
	/*$(document).ready(function(){

		$("#nuevo").click(function(){



			$('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
			$.ajax(
				{
					type:'get',  
					url:'proyNuevo.php',  //GMM001
					data:{
						accion:'N',
						
					},
					success:function(data){

						$('#mostrar').html(data);   

					},
					error:function(){
						alert("error !");

					}

				});

		});

	});
*/
	</script>	

</head>
<body>
  <p><span class='titulo' id='candidato'>Catálogo de Proyectos</span></p>
  <?php
  if($permisosEspeciales==1){
        echo "<center><span class='close' id='nuevo'>Agregar</span></center>";
  }
  ?>
<article id="contenido">
	
</article>
<div id="nuevoProyecto" title="Agregar nuevo proyecto">
        <div id="contDialog"></div>
  </div>
</body>
</html>
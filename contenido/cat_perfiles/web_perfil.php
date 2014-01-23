<?php
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;

?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title></title>
	
<!--	<link type="text/css" href="css/style.css" rel="stylesheet" /> -->
	<link type="text/css" href="css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/style.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/funcionesTab.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/funcionesPerfil.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.highlight.js"></script>
	<script type="text/javascript" src='js/libs.js'></script>
        
	
	

	<script type="text/javascript">
            /*
	$(document).ready(function(){

		$("#nuevo").click(function(){



		$('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
			$.ajax(
				{
					type:'get',
					url:'perfilnuevos.php',
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
  <p><span class='titulo' id='candidato'>Catálogo de Perfiles</span></p>
  <?php
  if($permisosEspeciales==1){
      echo "<center><span class='close' id='nuevo'>Agregar</span></center>";
  }
  ?>
<article id="contenido">
	
</article>

  <div id="nuevoPerfil" title="Agregar nuevo perfil">
        <div id="contDialog"></div>
  </div>
</body>
</html>
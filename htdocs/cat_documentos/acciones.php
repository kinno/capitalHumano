<?php
include"../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$id=$_GET['ids'];
$ac=$_GET['accion'];
if($ac=='E'){  //pregunta si la acción es E, M o N que son(ELIMINAR, MODIFICAR O NUEVO), esta acción depende de el botón donde se presione

		
	$sqlU="update tbldocumento set fecbaja=now() where idDocumento=".$id;
	$queryU=mysql_query($sqlU)or die(mysql_error());
	echo"Dato Eliminado";
	echo"<script> 
					$(document).ready(function(){
						window.setTimeout(function()  //SUPONGO QUE ES UNA FUNCION QUE RECARGA LA PAGINA
						{
						$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible')
						},1000);

						window.setTimeout(function()
							{
								location.reload()
							},1000);

					          });
					</script>
					";	


}
else if($ac=='M')
{
//echo"modifi";   //Aqui se recogen los valores de formulario mandados por Ajax
                mysql_query("SET NAMES 'utf8'");
		$ltxtdocumento=$_GET['documento']; //Aqui se obtienen los datos que trae el forumlario que se envia desde documento.php(recluta.php)
                $sqlU="update tbldocumento set desDocumento='$ltxtdocumento' where idDocumento=".$id; //Consulta para actualizar los datos
	        $queryU=mysql_query($sqlU)or die(mysql_error());
		echo"Datos modificados";
		echo"<script> 
		$(document).ready(function(){
		     window.setTimeout(function()
		     {
			$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible')
			},1000);
                      
				window.setTimeout(function()
				{
			        	location.reload()
					},1000);
					});
		     </script>";

		 	
}
else if($ac=='N'){
	
	mysql_query("SET NAMES 'utf8'");
	$ltxtdocumento=trim($_GET['documento']);
        $sqlI="insert into tbldocumento (desDocumento,idUsuario,fecalta,fecbaja) value('$ltxtdocumento','1','1988-02-15',NULL)";
	$queryI=mysql_query($sqlI) or die("No se ejecuta inserción en acciones");
	 echo"Datos Guardados";
		 	echo"<script> 
					$(document).ready(function(){
						window.setTimeout(function()
						{
						$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible')
						},1000);

						window.setTimeout(function()
							{
								location.reload()
							},1000);

					          });
					</script>
					";	
	}

?>
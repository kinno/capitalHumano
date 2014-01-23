<?php
include"../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$id=$_GET['ids'];
$ac=$_GET['accion'];
if($ac=='E'){  //pregunta si la acción es E, M o N que son(ELIMINAR, MODIFICAR O NUEVO), esta acción depende de el botón donde se presione

	//echo"eliminar";
	$sqlU="update tblReclut set fecbaja=now() where idReclut=".$id;
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
                 mysql_query("SET NAMES 'utf8'"); //Permite insertar acentos y ñs a la base de datos
		$ltxtnomReclut=$_GET['nomReclut'];
		$ltxtappReclut=$_GET['appReclut'];
		$ltxtappmReclut=$_GET['apmReclut'];
                $sqlU="update tblReclut set nomReclut='$ltxtnomReclut',appReclut='$ltxtappReclut',apmReclut='$ltxtappmReclut' where idReclut=".$id;
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
	mysql_query("SET NAMES 'utf8'"); //Permite insertar acentos y ñs a la base de datos
	$ltxtNomReclut=trim($_GET['nombre']);
	$ltxtApPatReclut=trim($_GET['apPat']);
	$ltxtApMatReclut=trim($_GET['apMat']);
        $sqlI="insert into tblReclut (nomReclut,appReclut,apmReclut,idusuario,fecalta,fecbaja) value('$ltxtNomReclut','$ltxtApPatReclut','$ltxtApMatReclut','1','1988-02-15',NULL)";
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
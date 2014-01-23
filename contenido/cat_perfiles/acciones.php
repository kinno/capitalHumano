<?php
include"../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();

$id=$_GET['ids'];
$ac=$_GET['accion'];
if($ac=='E'){  //pregunta si la acción es E, M o N que son(ELIMINAR, MODIFICAR O NUEVO), esta acción depende de el botón donde se presione

	//echo"eliminar";
	$sqlU="update tblPerfil set fecbaja=now() where idPerfil=".$id;
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
	mysql_query("SET NAMES 'utf8'"); //Sentencia que permite insertar acentos y ñs en la base de datos
	$ltxtdescPerfil=$_GET['descPerfil'];
	$ltxtperPerfil=$_GET['perfPerfil'];
	$ltxtcompPerfil=$_GET['compPerfil'];
	$ltxtfuncPerfil=$_GET['funcPerfil'];
	$ltxthabPerfil=$_GET['habPerfil'];
	$ltxtconocPerfil=$_GET['conocPerfil'];
	
        $sqlU="update tblPerfil set descPerfil='$ltxtdescPerfil', compPerfil='$ltxtcompPerfil', funcPerfil='$ltxtfuncPerfil', perfPerfil='$ltxtperPerfil', habPerfil='$ltxthabPerfil', conocPerfil='$ltxtconocPerfil', idUsuario='1', fecalta=now(), fecbaja=NULL where idPerfil=".$id;
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
	$ltxtdescPerfil=trim($_GET['descPerfil']);
	$ltxtperPerfil=trim($_GET['perfPerfil']);
	$ltxtcompPerfil=trim($_GET['compPerfil']);
	$ltxtfuncPerfil=trim($_GET['funcPerfil']);
	$ltxthabPerfil=trim($_GET['habPerfil']);
	$ltxtconocPerfil=trim($_GET['conocPerfil']);
        $sqlI="insert into tblperfil (descPerfil,compPerfil,funcPerfil,perfPerfil,habPerfil,conocPerfil,idusuario,fecalta,fecbaja)
	value('$ltxtdescPerfil','$ltxtcompPerfil','$ltxtfuncPerfil','$ltxtperPerfil','$ltxthabPerfil','$ltxtconocPerfil','1',now(),NULL)";
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
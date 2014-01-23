<?php
session_start();
$_SESSION['paswd'];
include"../libs/libs.php";
$funciones = new funciones;
$ltxtpswd1=$_POST['p1'];
$ltxtpswd2=$_POST['p2'];
if($_SESSION['paswd']==md5($ltxtpswd1))
{
echo"Verifica La contraseña es igual a la Asignada";
}
else
{
	$funciones->conectar();
	$sqlU="update tblusuarios set pwdUsuario=md5('$ltxtpswd1') where idUsuario=".$_SESSION['id'];
	$queryU=mysql_query($sqlU) or die('No se ejecuta la actualizacionde PSWD');
	if(mysql_affected_rows()>= 1)
	{	
		$_SESSION['Cpas']=false;
		Echo"Contraseña Modificada";
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

}

?>

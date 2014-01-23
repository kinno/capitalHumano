<?php
include("../libs/libs.php");
include("../../libs/mail.php");
$funciones= new funciones;
$funciones->conectar();
$correo=new mail();

$folio=$_GET['folio'];
$ac=$_GET['accion'];
if($ac=='A'){  //Si la acci�n es A entonces cambiamos el estatus de la solicitud cuyo folio lo guardamos en $folio

	$sqlU="UPDATE tblsolicitud SET statSolici=2 WHERE folSolici=".$folio;
	$queryU=mysql_query($sqlU)or die(mysql_error());
	echo"Solicitud Aceptada";
        
        //Obtenemos los datos del lider de proyecto que realizó la solicitud
        $sqlUsuario="select mailUsuario,nomUsuario,appUsuario from tblusuarios us 
                    join tblsolicitud sol on us.idUsuario = sol.idUsuario
                    where sol.folSolici=$folio";
        $queryUsuario=  mysql_query($sqlUsuario) or die(mysql_error());
        $usuario=  mysql_fetch_array($queryUsuario);
        
        
        //obtener el correo del gerente de RH
        $sqlCorreorh="select mailUsuario from tblusuarios where idRol=2";
        $queryCorreo = mysql_query($sqlCorreorh) or die(mysql_error());
        $correorh=  mysql_fetch_array($queryCorreo);
        
        
        $mensaje = "Estimado(a) <strong>".$usuario['nomUsuario']." ".$usuario['appUsuario']."</strong>:<br>
            <br> Le informamos que la solicitud de personal con folio:<strong> $folio </strong>ha sido aprobada";
        $subject="Aprobación de Solicitud de Personal";
        $correo->enviarMail($usuario['mailUsuario'], $mensaje, $subject,$correorh['mailUsuario']);
        
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
else  //si no fue aceptada entonces fue recahazada la solicitud
{
	$sqlU="UPDATE tblsolicitud SET statSolici=3 WHERE folSolici=".$folio;
	$queryU=mysql_query($sqlU)or die(mysql_error());
	echo"Solicitud Rechazada";
        
        //Obtenemos los datos del lider de proyecto que realizó la solicitud
        $sqlUsuario="select mailUsuario,nomUsuario,appUsuario from tblusuarios us 
                    join tblsolicitud sol on us.idUsuario = sol.idUsuario
                    where sol.folSolici=$folio";
        $queryUsuario=  mysql_query($sqlUsuario) or die(mysql_error());
        $usuario=  mysql_fetch_array($queryUsuario);
        
        
        //obtener el correo del gerente de RH
        $sqlCorreorh="select mailUsuario from tblusuarios where idRol=2";
        $queryCorreo = mysql_query($sqlCorreorh) or die(mysql_error());
        $correorh=  mysql_fetch_array($queryCorreo);
        
        $mensaje = "Estimado(a) <strong>".$usuario['nomUsuario']." ".$usuario['appUsuario']."</strong>:<br>
            <br> Le informamos que la solicitud de personal con folio:<strong> $folio </strong>ha sido rechazada; para más información contacte al Director de Operaciones.";
        $subject="Rechazo de Solicitud de Personal";
        $correo->enviarMail($usuario['mailUsuario'], $mensaje, $subject,$correorh['mailUsuario']);
        
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


?>
<?php
include"../libs/libs.php";
include("../../libs/mail.php");
$funciones= new funciones;
echo $funciones->conectar();
session_start();
mysql_query("SET NAMES 'utf8'");
$id=$_GET['ids'];
$ac=$_GET['accion'];
if($ac=='E'){

	//echo"eliminar";
	$sqlU="update tblusuarios set fecbaja=now(),status=0 where idUsuario=".$id;
	$queryU=mysql_query($sqlU)or die(mysql_error());
	
	echo"Dato Eliminado";
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
else if($ac=='M')
{
//echo"modifi";
		mysql_query("SET NAMES 'utf8'");
		$ltxtnomUs=$_GET['nomUs'];
		$ltxtappUs=$_GET['appUs'];
		$ltxtappmUs=$_GET['apmUs'];
		$ltxtmailUs=$_GET['mailUs'];
		$lintrolUS=$_GET['rolUS'];
		$ltxtnick=$_GET['nickUs'];
		$ltxtpas=$_GET['pasUs'];
		$lintStatus=$_GET['status'];

		//echo"correo recibido get:".$ltxtmailUs;
		  $bandera=0;
		 $sqlT="select * from tblusuarios where idUsuario=".$id;
		 $queryT=mysql_query($sqlT)or die(mysql_error());
		 $rT=mysql_fetch_array($queryT);

		//echo"correo BD:".$rT['mailUsuario'] ;
		 if($rT['mailUsuario'] != $ltxtmailUs)
		 {
		 	$sqlM="select * from tblusuarios where mailUsuario='".$ltxtmailUs."'";
		 	$queryM=mysql_query($sqlM)or die("No se jecuta correo del usuario");
			 $rM=mysql_num_rows($queryM);
			 if($rM>=1){

			 	echo"El correo Esta siendo utilizado por otra cuenta";
			 	$bandera=1;

			 }

		 }
		 if($bandera == 0)
		 {
		 	if($rT['nickUsuario']!=$ltxtnick)
		 	{

			 	
			 	$sqlN="select * from tblusuarios where nickUsuario='".$ltxtnick."'";
			 	$queryN=mysql_query($sqlN)or die("No se ejecuta nombre de usuario");
				 $rN=mysql_num_rows($queryN);
				 if($rN>=1){
				 	echo"El Nombre de Usuario esta siendo utilizado por otra cuenta";
				 	$bandera=1;

				 }
			 }

		 }
		 if($bandera == 0)
		 {

		 	if($ltxtpas=='')
		 	{
		 		$sqlU="update tblusuarios set  nickUsuario='$ltxtnick', nomUsuario='$ltxtnomUs',appUsuario='$ltxtappUs',apmUsuario='$ltxtappmUs',mailUsuario='$ltxtmailUs',idRol=$lintrolUS,moUsuario=".$_SESSION['id'].",status=$lintStatus where idUsuario=".$id;
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
					</script>
					";

		 	}
		 	else
		 	{
		 		
		 		$sqlU="update tblusuarios set  nickUsuario='$ltxtnick',pwdUsuario=MD5('$ltxtpas'), nomUsuario='$ltxtnomUs',appUsuario='$ltxtappUs',apmUsuario='$ltxtappmUs',mailUsuario='$ltxtmailUs',idRol=$lintrolUS,moUsuario=".$_SESSION['id'].",status=$lintStatus where idUsuario=".$id;
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
					</script>
					";	
		 	}
		 }
}
else if($ac=='N'){
	

	mysql_query("SET NAMES 'utf8'");
	$funciones= new funciones;
	$funciones->conectar();
	mysql_query("SET NAMES 'utf8'");
	$ltxtNomUsu=trim($_GET['nombre']);
	$ltxtApPatU=trim($_GET['apPat']);
	$ltxtApMatU=trim($_GET['apMat']);
	$ltxtCorUsu=trim($_GET['correo']);
	$ltxtRolUsu=$_GET['rol'];
	$ltxtUsAp=sanear_string($ltxtNomUsu).".".sanear_string($ltxtApPatU);
        
	//echo " ".$ltxtNomUsu." ".$ltxtApPatU." ".$ltxtApMatU." ".$ltxtCorUsu." ".$ltxtRolUsu;
	$sqlC="select mailUsuario from tblusuarios where mailUsuario='".$ltxtCorUsu."'";
	$queryC=mysql_query($sqlC) or die("NO se ejecuta la de maila");
	if(@mysql_num_rows($queryC)>=1)
	{
		echo"Verifica el Correo Esta siendo utilizado";
	
	}
	else{
		  $sqlI="insert into tblusuarios(nickUsuario,pwdUsuario,nomUsuario,appUsuario,apmUsuario,mailUsuario,idRol,moUsuario,fecalta,fecbaja,status) value('$ltxtUsAp',MD5('$ltxtUsAp'),'$ltxtNomUsu','$ltxtApPatU','$ltxtApMatU','$ltxtCorUsu',$ltxtRolUsu,".$_SESSION['id'].",now(),null,1)";
		 $queryI=mysql_query($sqlI) or die("No se ejecuta inserccion".$sqlI);
                 $mail=new mail();
			$correo=$ltxtCorUsu;	
			$mensaje = "Estimado(a) <strong>".$ltxtNomUsu." ".$ltxtApPatU."</strong>:<br>
                        <br> Sus credenciales para ingresar al Sistema Capital Humano son:<br>
                            Usuario=".$ltxtUsAp."<br>
                            Pass=".$ltxtUsAp."<br><br>
                            Le recordamos que al ingresar al sistema por primera vez tendrá que cambiar su password.";
                        $correorh="regino.tabares@gmail.com";
                        $subject="Credenciales para el sistema";
			if($mail->enviarMail($correo, $mensaje, $subject, $correorh)==true)
			{
				 echo"Datos Guardados";
				
			}
			else
			{
				echo"Ocurrio un error al enviar correo";
			}
			
		
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

function sanear_string($string)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", " "),
        '',
        $string
    );


    return $string;
}
?>
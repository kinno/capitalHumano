<?php
include"../libs/libs.php";
$funciones= new funciones;
echo $funciones->conectar();
session_start();
mysql_query("SET NAMES 'utf8'");

$id=$_GET['ids'];
$ac=$_GET['accion'];
$fecha=date("Y-m-d");  //GMM001 - Fecha

if($ac=='E'){  //pregunta si la acción es E, M o N que son(ELIMINAR, MODIFICAR O NUEVO), esta acción depende de el botón donde se presione
	$sqlU="UPDATE tblescolar SET fecbaja=now(), idUsuario=".$_SESSION['id']." WHERE idEscolar=".$id;
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
	$ltxtEscolar=$_GET['nomEscolar'];
	
	//GMM001 - Valida que no exista nombre de la Escolaridad
	$sqlC="SELECT * FROM tblescolar WHERE nomEscolar='$ltxtEscolar' AND nomEscolar!='' AND fecbaja IS NULL" ;
	$queryC=mysql_query($sqlC) or die(mysql_error());
	if(@mysql_num_rows($queryC)>=1)
  	{
    	echo"El nombre de la Escolaridad ya existe";    	
  	}  	  	
	//--------------------------------------------------
	else
	{
		$sqlU="UPDATE tblescolar SET nomEscolar='$ltxtEscolar', idUsuario=".$_SESSION['id']." WHERE idEscolar=".$id; //Consulta para actualizar los datos
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
}

//$sqlI="insert into tblusuarios value('','$ltxtUsAp',MD5('$ltxtUsAp'),'$ltxtNomUsu','$ltxtApPatU','$ltxtApMatU','$ltxtCorUsu',$ltxtRolUsu,".$_SESSION['id'].",now(),'',1)";

//GNN001 - Se da de Alta el Registro
else if($ac=='N'){
	$funciones= new funciones;
	$funciones->conectar();
	mysql_query("SET NAMES 'utf8'");
	$ltxtEscolar=$_GET['nomEscolar'];
	
	//GMM001 - Valida que no exista nombre de la Escolaridad
	$sqlC="SELECT * FROM tblescolar WHERE nomEscolar='$ltxtEscolar' AND nomEscolar!='' AND fecbaja IS NULL" ;
	$queryC=mysql_query($sqlC) or die(mysql_error());
	if(@mysql_num_rows($queryC)>=1)
  	{
    	echo"El nombre de la Escolaridad ya existe";    	
  	}  	  	
	//--------------------------------------------------
	else
	{
		$sqlI="INSERT INTO tblescolar (nomEscolar,idUsuario,fecalta,fecbaja) value('$ltxtEscolar',".$_SESSION['id'].",'$fecha',NULL)";	
		$queryI=mysql_query($sqlI) OR die("No se ejecuta inserción en acciones");
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
	</script>";
	}
}

?>
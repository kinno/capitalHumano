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
	$sqlU="UPDATE tblproyecto SET fecbaja=now() , idUsuario=".$_SESSION['id']." WHERE idProyecto=".$id;
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
	$ltxtProyecto=$_GET['nomProyecto'];
	
	//GMM001 - Valida que no exista nombre del Proyecto
	$sqlC="SELECT * FROM tblproyecto WHERE nomProyecto='$ltxtProyecto' AND nomProyecto!='' AND fecbaja IS NULL" ;
	$queryC=mysql_query($sqlC) or die(mysql_error());
	if(@mysql_num_rows($queryC)>=1)
  	{
    	echo"Verifica el nombre del Proyecto ya Existe";    	
  	}  	  	
	//--------------------------------------------------
	else
	{
		$sqlU="update tblproyecto set nomProyecto='$ltxtProyecto', idUsuario=".$_SESSION['id']." where idProyecto=".$id; //Consulta para actualizar los datos
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

//GNN001 - Se da de Alta el Registro
else if($ac=='N'){
	$funciones= new funciones;
	$funciones->conectar();
	mysql_query("SET NAMES 'utf8'");
	$ltxtProyecto=$_GET['nomProyecto'];	

	//GMM001 - Valida que no exista nombre del Proyecto
	$sqlC="SELECT * FROM tblproyecto WHERE nomProyecto='$ltxtProyecto' AND nomProyecto!='' AND fecbaja IS NULL" ;
	$queryC=mysql_query($sqlC) or die(mysql_error());
	if(@mysql_num_rows($queryC)>=1)
	{
    	echo"Verifica el nombre del Proyecto ya Existe";    	
  	}  	  	
	//--------------------------------------------------
	else
	{
		$sqlI="insert into tblproyecto (nomProyecto,idUsuario,fecalta,fecbaja) value('$ltxtProyecto',".$_SESSION['id'].",'$fecha',NULL)";	
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
		</script>";
	}
}

?>
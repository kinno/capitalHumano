<?php
include"../libs/libs.php";
$funciones= new funciones;
echo $funciones->conectar();
session_start();
mysql_query("SET NAMES 'utf8'");

$idCandid=$_GET['idCandid'];
$numRef=$_GET['numRef'];
$ac=$_GET['accion'];
$fecha=date("Y-m-d");  //GMM001 - Fecha

//----------------------------------------------------------
//Se da de Alta el Registro
//----------------------------------------------------------
if($ac=='N'){
	//Obtener consecutivo Candidato-Num
	$sqlC="SELECT MAX(numRef) as numero FROM tblreferencias WHERE idCandid=$idCandid";
	$queryC=mysql_query($sqlC)or die('no se ejecuta la selccion');
	$numero=mysql_fetch_array($queryC);
	$numRef=$numero['numero'];
	if (!$numRef){
		$numRef = 1;		
	}
	else{
		$numRef = $numRef + 1;		
	}	
	//--------------------------
	$empRef=$_GET['empRef'];
	$nomRef=$_GET['nomRef'];
	$puestoRef=$_GET['puestoRef'];
	$mesI=$_GET['mesI'];
	$anioI=$_GET['anioI'];
	$mesF=$_GET['mesF'];
	$anioF=$_GET['anioF'];
	$sueldoRef=$_GET['sueldoRef'];
	$motivoRef=$_GET['motivoRef'];
	$ultPuestRef=$_GET['ultPuestRef'];
	$volvRef=$_GET['volvRef'];
	$comentRef=$_GET['comentRef'];
	$respRef=$_GET['respRef'];
	$asistenciaRef=$_GET['asistenciaRef'];
	$puntualidadRef=$_GET['puntualidadRef'];
	$actitudRef=$_GET['actitudRef'];
	$compromisoRef=$_GET['compromisoRef'];
	$honestidadRef=$_GET['honestidadRef'];
	$relsupRef=$_GET['relsupRef'];
	$iniciativaRef=$_GET['iniciativaRef'];
	$lealtadRef=$_GET['lealtadRef'];
	$apegoRef=$_GET['apegoRef'];

	$perIniRef=$anioI."-".$mesI."-1";
	$perFinRef=$anioF."-".$mesF."-1";

	//$mensaje = "Variables leidas ...... ".$perIniRef." --- ".$perFinRef;
	//echo "$mensaje";
	//--------------------------

	$sqlI="INSERT INTO tblreferencias value($idCandid,
											 $numRef,
											'$empRef',
											'$nomRef',
											'$puestoRef',
											'$perIniRef',
											'$perFinRef',
											 $sueldoRef,
											'$motivoRef',
											'$ultPuestRef',											
											 $volvRef,
											'$comentRef',
											 $respRef,
											 $asistenciaRef,
											 $puntualidadRef,
											 $actitudRef,
											 $compromisoRef,
											 $honestidadRef,
											 $relsupRef,
											 $iniciativaRef,
											 $lealtadRef,
											 $apegoRef,
											".$_SESSION['id'].",'$fecha',NULL)";	
	//echo"$sqlI";
	$queryI=mysql_query($sqlI) OR die("No se ejecuta inserción de Referencias");
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

//----------------------------------------------------------
//Baja
//----------------------------------------------------------
else if($ac=='E'){  	
	$sqlU="DELETE FROM tblreferencias WHERE idCandid=".$idCandid ." AND numRef=".$numRef;
	
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

//----------------------------------------------------------
//Modificacion
//----------------------------------------------------------
else if($ac=='M')
{
	$empRef=$_GET['empRef'];
	$nomRef=$_GET['nomRef'];
	$puestoRef=$_GET['puestoRef'];
	$mesI=$_GET['mesI'];
	$anioI=$_GET['anioI'];
	$mesF=$_GET['mesF'];
	$anioF=$_GET['anioF'];
	$sueldoRef=$_GET['sueldoRef'];
	$motivoRef=$_GET['motivoRef'];
	$ultPuestRef=$_GET['ultPuestRef'];
	$volvRef=$_GET['volvRef'];
	$comentRef=$_GET['comentRef'];
	$respRef=$_GET['respRef'];
	$asistenciaRef=$_GET['asistenciaRef'];
	$puntualidadRef=$_GET['puntualidadRef'];
	$actitudRef=$_GET['actitudRef'];
	$compromisoRef=$_GET['compromisoRef'];
	$honestidadRef=$_GET['honestidadRef'];
	$relsupRef=$_GET['relsupRef'];
	$iniciativaRef=$_GET['iniciativaRef'];
	$lealtadRef=$_GET['lealtadRef'];
	$apegoRef=$_GET['apegoRef'];

	$perIniRef=$anioI."-".$mesI."-1";
	$perFinRef=$anioF."-".$mesF."-1";

	$sqlU="UPDATE tblreferencias 
			SET empRef='$empRef', 
				nomRef='$nomRef', 
				puestoRef='$puestoRef', 
				perIniRef='$perIniRef', 
				perFinRef='$perFinRef', 
				sueldoRef='$sueldoRef', 
				motivoRef='$motivoRef', 
				ultPuestRef='$ultPuestRef', 
				volvRef='$volvRef', 
				comentRef='$comentRef', 
				respRef='$respRef', 
				asistenciaRef='$asistenciaRef', 
				puntualidadRef='$puntualidadRef', 
				actitudRef='$actitudRef', 
				compromisoRef='$compromisoRef', 
				honestidadRef='$honestidadRef', 
				relsupRef='$relsupRef', 
				iniciativaRef='$iniciativaRef', 
				lealtadRef='$lealtadRef', 
				apegoRef='$apegoRef', 			
				idUsuario=".$_SESSION['id']." WHERE idCandid=".$idCandid ." AND numRef=".$numRef; 

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

?>

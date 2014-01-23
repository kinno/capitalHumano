<?php
include "libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
mysql_query("SET NAMES 'utf8'");

$ac=$_POST['accion'];

if($ac=='N')
{
/*echo "este es el nombre".*/$nombreC=$_POST['nombreC'];
//echo"<br>";
/*echo " appc".*/$appC=$_POST['appC'];
//echo"<br>";
/*echo " apmc".*/$apmC=$_POST['apmC'];
//echo"<br>";
/*echo " generoc".*/$generoC=$_POST['generoC'];
//echo"<br>";
/*echo "  anioc".*/$anioC=$_POST['anioC'];
//echo"<br>";
/*echo " mesc".*/$mesC=$_POST['mesC'];
//echo"<br>";
/*echo " diaC".*/$diaC=$_POST['diaC'];
//echo"<br>";
/*echo " estadoC: ".*/$estadoC=$_POST['estadoC'];
//echo"<br>";
/*echo " muniC".*/$muniC=$_POST['muniC'];
//echo"<br>";
/*echo " cpC".*/$cpC=$_POST['cpC'];
//echo"<br>";
/*echo " coloniaC".*/$coloniaC=$_POST['coloniaC'];
//echo"<br>";
/*echo " domiC".*/$domiC=$_POST['domiC'];
//echo"<br>";
/*echo " celuC".*/$celuC=$_POST['celuC'];
//echo"<br>";
/*echo "  telC".*/$telC=$_POST['telC'];
//echo"<br>";
/*echo "  mailC".*/$mailC=$_POST['mailC'];
//echo"<br>";
/*echo " trabajoAcC".*/$trabajoC=$_POST['trabajoAcC'];
//echo"<br>";
/*echo " escolaC".*/$escolaC=$_POST['escolaC'];
//echo"<br>";
/*echo " nivelEsC".*/$nivelEsC=$_POST['nivelEsC'];
//echo"<br>";
/*echo " otroEsC".*/$otroEsC=$_POST['otroEsC'];
//echo"<br>";
/*echo " idio0C: ".*/$idio0=$_POST['idio0C'];
if($idio0 == 'on')
{
	$ing=1;

}
else
{
	$ing='';
}

/*echo "  valor idioma 0: ".*/$idi0VP=$_POST['idi0VP'];

//echo"<br>";
/*echo " idio1C: ".*/$idio1=$_POST['idio1C'];
if($idio1 == 'on')
{
	$fra=2;

}
else
{
	$fra='';
}
/*echo " valor idioma 1: ".*/$idi1VP=$_POST['idi1VP'];
//echo"<br>";
/*echo " idio2C: ".*/$idio2=$_POST['idio2C'];
if($idio2 == 'on')
{
	$ale=3;

}
else
{
	$ale='';
}
/*echo " valor idioma 2: ".*/$idi2VP=$_POST['idi2VP'];
//echo"<br>";
/*echo " idio3C: ".*/$idio3=$_POST['idio3C'];
if($idio3 == 'on')
{
	$por=4;

}
else
{
	$por='';
}
/*echo " valor idioma 3: ".*/$idi3VP=$_POST['idi3VP'];
//echo"<br>";
/*echo " preteC".*/$preteC=$_POST['preteC'];
//echo"<br>";
/*echo " conoC".*/$conoC=$_POST['conoC'];
//echo"<br>";
/*echo " areainC".*/$areainC=$_POST['areainC'];
//echo"<br>";
/*echo" arexpC".*/$areaexpC=$_POST['arexpC'];
//echo"<br>";
/*echo " dispoviajeC".*/$dispoviC=$_POST['dispoviajeC'];
//echo"<br>";
/*echo " statusC".*/$statusC=$_POST['statusC'];
//echo"<br>";
/*echo " direcC".*/$dirC=$_POST['direcC'];
//echo"<br>";
$fechaCom=$anioC."-".$mesC."-".$diaC;

//GMM001 - Convertir a Numerico
$estadoC=(int)$estadoC;
$muniC=(int)$muniC;
$coloniaC=(int)$coloniaC;

$sqlIn="insert into tblcandidato values('','$nombreC','$appC','$apmC','$generoC','$fechaCom',$estadoC,$muniC,'$cpC',$coloniaC,'$domiC','$celuC','$telC','$mailC',$trabajoC,$escolaC,'$nivelEsC','$otroEsC','$ing','$idi0VP','$fra','$idi1VP','$ale','$idi2VP','$por','$idi3VP',$preteC,'$conoC','$areainC','$areaexpC',$dispoviC,$statusC,'$dirC',1,now(),'NULL')";
//echo "$sqlIn";
  
$queryIN=mysql_query($sqlIn) or die('no se ejcuta la inserccion de candidatos'); 
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

else if($ac=='E')
{
	//echo "eliminar";
 $id=$_POST['idC'];
 $sqlUpdate="update tblcandidato set statCandid=2 where idCandid=".$id;
 $queryUpdate=mysql_query($sqlUpdate) or die('no se ejecuta la actualizacion');
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
	$idC=$_POST['idC'];
			/*echo "este es el nombre".*/$nombreC=$_POST['nombreC'];
			//echo"<br>";
			/*echo " appc".*/$appC=$_POST['appC'];
			//echo"<br>";
			/*echo " apmc".*/$apmC=$_POST['apmC'];
			//echo"<br>";
			/*echo " generoc".*/$generoC=$_POST['generoC'];
			//echo"<br>";
			/*echo "  anioc".*/$anioC=$_POST['anioC'];
			//echo"<br>";
			/*echo " mesc".*/$mesC=$_POST['mesC'];
			//echo"<br>";
			/*echo " diaC".*/$diaC=$_POST['diaC'];
			//echo"<br>";
			/*echo " estadoC: ".*/$estadoC=$_POST['estadoC'];
			//echo"<br>";
			/*echo " muniC".*/$muniC=$_POST['muniC'];
			//echo"<br>";
			/*echo " cpC".*/$cpC=$_POST['cpC'];
			//echo"<br>";
			/*echo " coloniaC".*/$coloniaC=$_POST['coloniaC'];
			//echo"<br>";
			/*echo " domiC".*/$domiC=$_POST['domiC'];
			//echo"<br>";
			/*echo " celuC".*/$celuC=$_POST['celuC'];
			//echo"<br>";
			/*echo "  telC".*/$telC=$_POST['telC'];
			//echo"<br>";
			/*echo "  mailC".*/$mailC=$_POST['mailC'];
			//echo"<br>";
			/*echo " trabajoAcC".*/$trabajoC=$_POST['trabajoAcC'];
			//echo"<br>";
			/*echo " escolaC".*/$escolaC=$_POST['escolaC'];
			//echo"<br>";
			/*echo " nivelEsC".*/$nivelEsC=$_POST['nivelEsC'];
			//echo"<br>";
			/*echo " otroEsC".*/$otroEsC=$_POST['otroEsC'];
			//echo"<br>";
			/*echo " idio0C: ".*/$idio0=$_POST['idio0C'];

			//Se convierten a entero
			$estadoC=(int)$estadoC;
			$muniC=(int)$muniC;
			$coloniaC=(int)$coloniaC;

			if($idio0 == 'on')
			{
				$ing=1;

			}
			else
			{
				$ing='';
			}
			/*echo" idioma 1: ".*/$ing;

			/*echo "  valor idioma 0: ".*/$idi0VP=$_POST['idi0VP'];

			//echo"<br>";
			/*echo " idio1C: ".*/$idio1=$_POST['idio1C'];
			if($idio1 == 'on')
			{
				$fra=2;

			}
			else
			{
				$fra='';
			}
			/*echo" idioma fran: ".*/$fra;
			/*echo " valor idioma 1: ".*/$idi1VP=$_POST['idi1VP'];
			//echo"<br>";
			/*echo " idio2C: ".*/$idio2=$_POST['idio2C'];
			if($idio2 == 'on')
			{
				$ale=3;

			}
			else
			{
				$ale='';
			}
			/*echo " valor idioma 2: ".*/$idi2VP=$_POST['idi2VP'];
			//echo"<br>";
			/*echo " idio3C: ".*/$idio3=$_POST['idio3C'];
			if($idio3 == 'on')
			{
				$por=4;

			}
			else
			{
				$por='';
			}
			//echo "idioma portugues :".$por;
			/*echo " valor idioma 3: ".*/$idi3VP=$_POST['idi3VP'];
			//echo"<br>";
			/*echo " preteC".*/$preteC=$_POST['preteC'];
			//echo"<br>";
			/*echo " conoC".*/$conoC=$_POST['conoC'];
			//echo"<br>";
			/*echo " areainC".*/$areainC=$_POST['areainC'];
			//echo"<br>";
			/*echo" arexpC".*/$areaexpC=$_POST['arexpC'];
			//echo"<br>";
			/*echo " dispoviajeC".*/$dispoviC=$_POST['dispoviajeC'];
			//echo"<br>";
			/*echo " statusC".*/$statusC=$_POST['statusC'];
			//echo"<br>";
			/*echo " direcC".*/$dirC=$_POST['direcC'];
			//echo"<br>";
		      $fechaCom=$anioC."-".$mesC."-".$diaC;

		      $sqlUp="update tblcandidato set nomCandid='$nombreC', appCandid='$appC',apmCandid='$apmC', genCandid='$generoC', fecNCandid='$fechaCom',id_entidad=$estadoC, id_municipio=$muniC, idCP='$cpC',id_colonia=$coloniaC ,domCandid='$domiC',celCandid='$celuC',telCandid='$telC',mailCandid='$mailC',trabCandid=$trabajoC,idEscolar=$escolaC,nivCandid='$nivelEsC',otrECandid='$otroEsC',idimoma1='$ing',porIdioma1='$idi0VP',idimoma2='$fra',porIdioma2='$idi1VP',idimoma3='$ale',porIdioma3='$idi2VP',idimoma4='$por',porIdioma4='$idi3VP',pretCandid=$preteC,conCandid='$conoC',aintCandid='$areainC',aexpCandid='$areaexpC',viajCandid=$dispoviC,statCandid=$statusC,URLCandid='$dirC', idUsuario=1, fecbaja='now()' where idCandid=".$idC;
		      $queryUP=mysql_query($sqlUp)or die('no se ejecuta la actualizacion');

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




					
?>

<?php
session_start();
require_once("../funciones/funciones.php");
//Extraemos los valores enviados por Ajax
/*
print_r($_POST);
exit();
*/
$folio=$_POST["folios"];
$idSubproyecto=$_POST["idSubproyecto"];
$liderProyecto=$_POST["liderProyecto"];
$tipoVacante=$_POST["tVacante"];
$inicioDSolici=$_POST["inicioDSolici"];
$finDSolici=$_POST["finDSolici"];
$idPerfil=$_POST["perfil"];
$numVacantes=$_POST["nVacantes"];
$diasTrabajo=$_POST["dTrabajo"];
$horaTrabajo=$_POST["hTrabajo"];
$lugarTrabajo=$_POST["lTrabajo"];
$salarioMin=$_POST["sMin"];
$salarioMax=$_POST["sMax"];
$otrasPercep=$_POST["oPercep"];
$fechaRequi=date("Y-m-d H:i:s");
$idioma1=$_POST["idio1"];
$pHablado1=$_POST["pHablado1"];
$pEscrito1=$_POST["pEscrito1"];
$idioma2=$_POST["idio2"];
$pHablado2=$_POST["pHablado2"];
$pEscrito2=$_POST["pEscrito2"];
$idioma3=$_POST["idio3"];
$pHablado3=$_POST["pHablado3"];
$pEscrito3=$_POST["pEscrito3"];
$idioma4=$_POST["idio4"];
$pHablado4=$_POST["pHablado4"];
$pEscrito4=$_POST["pEscrito4"];
$viajar=$_POST["viaje"];
$frecueViajar=$_POST["fViaje"];
$comentario=$_POST["comentario"];
$descActividades=$_POST['descActividades'];
$acciones=$_POST["accion"];
$estatus=1;// Le asignamos el estatus de solicitado
$usuario=$_SESSION['id'];//aqui le asignamos un valor referente a la variable de sesi�n

//le concatenamos comillas simples a las cadenas para facilitar la inserci�n en la base de datos
$diasTrabajo="'$diasTrabajo'";
$horaTrabajo="'$horaTrabajo'";
$otrasPercep="'$otrasPercep'";

$frecueViajar="'$frecueViajar'";
$fechaRequi="'$fechaRequi'";
$comentario="'$comentario'";
$inicioDSolici="'$inicioDSolici'";
$finDSolici="'$finDSolici'";

//print_r($_POST);

if($acciones=='A') //si la acci�n es iguala a A
{
   altaSolicitud($folio, $idSubproyecto,$liderProyecto, $tipoVacante, $inicioDSolici, $finDSolici, $idPerfil, $numVacantes, $diasTrabajo,
                       $horaTrabajo,$fechaRequi, $lugarTrabajo, $salarioMin, $salarioMax, $otrasPercep,$idioma1, $pHablado1, $pEscrito1,
                        $idioma2,$pHablado2,$pEscrito2, $idioma3, $pHablado3,$pEscrito3, $idioma4,$pHablado4,$pEscrito4, $viajar, $frecueViajar,
                       $comentario,$descActividades,$estatus,$usuario);//le enviamos los datos a una funci�n que de de alta la solicitud en la BD
   
   
   
	
}                  
if($acciones=='Aceptado')  //modifica el estatus de la solicitud
{
    modifiSolicitud();//le enviamos los datos a una funci�n que actualize el estatus de la solicitud
    
}
if($acciones=='Rechazado') //modifica el estatus de la solicitud
// echo ("entro");

?>
<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$folSolici = $_POST['folSolici'];
$reclutadorAnterior = $_POST['reclutadorAnterior'];
$reclutadorNuevo = $_POST['reclutadorNuevo'];
$dato = $vacantes->cambiar_reclutador($folSolici, $reclutadorAnterior, $reclutadorNuevo);
if($dato=='ok'){
        $ban=true;
}else{
        $ban=false;
}
if($ban==true){
    $respCorreo=$vacantes->enviar_correo($reclutadorNuevo,$folSolici);
    if($respCorreo){
        echo $respCorreo;
    }else{
        echo 'No se Envio el correo';
    }
}

?>

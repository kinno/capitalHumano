<?php
include_once("libvacantes.php");
$vacantes = new Vacantes();
$folSolici = $_POST['folSolici'];
$idReclutador = $_POST['idReclutador'];
$puestos = $_POST['puestos'];;
$compPerfil = $_POST['compPerfil'];
$statVacante = $_POST['statVacante'];
for($i=0;$i<$puestos;$i++){
    $dato = $vacantes->asignar_reclutadores($folSolici,$idReclutador,$compPerfil,$statVacante);
    if($dato=='ok')
        $ban=true;
    else
        $ban=false;
}
if($ban==true)
    echo 'ok';

?>

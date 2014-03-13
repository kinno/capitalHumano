<?php
session_start();
include_once '../funciones/libreportes.php';
$_SESSION['pAnual']=array();
$_SESSION['pPeriodo']=array();
 echo '<span style="float:right" class="exprt" onclick="exportar(\'proyecto\');">Exportar</span>';
if($_POST['periodo']==1){
    $reportes = new Reportes();
    $reclutador = $reportes->obtiene_reclutadores();
   
for($i=0;$i<count($_POST['idProyecto']);$i++){
$dato = $reportes->totalvacantes_proyectos($_POST['idProyecto'][$i]);
$dato3 = $reportes->canceladas_proyectos($_POST['idProyecto'][$i]);
$dato4 = $reportes->enviados_proyectos($_POST['idProyecto'][$i]);
$dato5 = $reportes->contratados_proyectos($_POST['idProyecto'][$i]);
$dato6 = $reportes->rechazados_proyectos($_POST['idProyecto'][$i]);

?>
<div style="margin-top: 30px;">
<table width="100%" class="ui-widget ui-widget-content ui-corner-all" style="padding:5px;text-align: center;margin-top: 5px;">
    <tr class="ui-state-default"><td><?php echo $_POST['nomProyecto'][$i];?></td><td>Enero</td><td>Febrero</td><td>Marzo</td><td>Abril</td><td>Mayo</td><td>Junio</td><td>Julio</td><td>Agosto</td><td>Septiembre</td><td>Octubre</td><td>Noviembre</td><td>Diciembre</td></tr>
    <tr><td style="text-align: left;">Total de vacantes</td>
        <?php
        $_SESSION['pAnual'][$i]['nombre']=$_POST['nomProyecto'][$i];
        foreach ($dato as $k => $v) {
            echo '<td>'.$v['total'].'</td>';
        $_SESSION['pAnual'][$i]['total'][$k]=$v['total'];
        }
        ?>
    <tr>
    
        <?php
        
        
        foreach ($reclutador as $key => $value) {
            $dato2 = $reportes->vacantesreclutador_proyectos($_POST['idProyecto'][$i],$value['idUsuario']);
            
        echo '<tr><td style="text-align: left;">Vacantes asignadas a '.$value['nomUsuario'].' '.$value['appUsuario'].' '.$value['apmUsuario'].'</td>';
        $_SESSION['pAnual'][$i]['vacantesReclutador'][$key]['nombre']=$value['nomUsuario'].' '.$value['appUsuario'].' '.$value['apmUsuario'];
            foreach ($dato2 as $k => $v2) {
               echo '<td>'.$v2['total'].'</td>';
               $_SESSION['pAnual'][$i]['vacantesReclutador'][$key][$k]=$v2['total'];
               
            }
            echo '</tr>';
        }
        
        echo '<tr><td style="text-align: left;">Vacantes canceladas</td>';
        foreach ($dato3 as $k =>$v){
            echo '<td>'.$v['canceladas'].'</td>';
            $_SESSION['pAnual'][$i]['canceladas'][$k]=$v['canceladas'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Candidatos enviados</td>';
        foreach ($dato4 as $k =>$v){
            echo '<td>'.$v['enviados'].'</td>';
             $_SESSION['pAnual'][$i]['enviados'][$k]=$v['enviados'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Contratados</td>';
        foreach ($dato5 as $k =>$v){
            echo '<td>'.$v['contratados'].'</td>';
             $_SESSION['pAnual'][$i]['contratados'][$k]=$v['contratados'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Rechazados</td>';
        foreach ($dato6 as $k =>$v){
            echo '<td>'.$v['rechazados'].'</td>';
             $_SESSION['pAnual'][$i]['rechazados'][$k]=$v['rechazados'];
        }
        echo '</tr>';
       ?>
    
</table>
</div>    
<?php

}
        }else{
 $reportes = new Reportes();
 $reclutador = $reportes->obtiene_reclutadores();
 for($i=0;$i<count($_POST['idProyecto']);$i++){
     $_SESSION['pPeriodo'][$i]='';
$dato = $reportes->totalvacantes_proyectosP($_POST['idProyecto'][$i], $_POST['inicio'], $_POST['final']);
$dato3 = $reportes->canceladas_proyectosP($_POST['idProyecto'][$i], $_POST['inicio'], $_POST['final']);
$dato4 = $reportes->enviados_proyectosP($_POST['idProyecto'][$i], $_POST['inicio'], $_POST['final']);
$dato5 = $reportes->contratados_proyectosP($_POST['idProyecto'][$i], $_POST['inicio'], $_POST['final']);
$dato6 = $reportes->rechazados_proyectosP($_POST['idProyecto'][$i], $_POST['inicio'], $_POST['final']);
?>
<table width="100%" class="ui-widget ui-widget-content" style="padding:5px; text-align: center;">
    <tr class="ui-state-default"><td style="text-align: center"><?php echo $_POST['nomProyecto'][$i];?></td><td style="text-align: center"><?php echo 'Periodo del '.$_POST['inicio'].' al '.$_POST['final']?></td></tr>
    <tr style="text-align: center">
        <?php
        $_SESSION['pPeriodo'][$i]['nombre']=$_POST['nomProyecto'][$i];
        $_SESSION['pPeriodo'][$i]['fecha']='Periodo del '.$_POST['inicio'].' al '.$_POST['final'];
        foreach ($dato as $k => $v) {
            echo '<td style="text-align: left;">Total de vacantes</td><td>'.$v['total'].'</td>';
            $_SESSION['pPeriodo'][$i]['total']=$v['total'];
        }
        ?>
    </tr>
        <?php
         
        foreach ($reclutador as $key => $value) {
            $dato2 = $reportes->vacantesreclutador_proyectosP($_POST['idProyecto'][$i],$value['idUsuario'],$_POST['inicio'], $_POST['final']);
            
        echo '<tr><td style="text-align: left;">Vacantes asignadas a '.$value['nomUsuario'].' '.$value['appUsuario'].' '.$value['apmUsuario'].'</td>';
            foreach ($dato2 as $k => $v) {
               echo '<td style="text-align: center">'.$v['total'].'</td>';
               $_SESSION['pPeriodo'][$i]['vacantesReclutador'][$key]['nReclutador']=$value['nomUsuario'].' '.$value['appUsuario'].' '.$value['apmUsuario'];
               $_SESSION['pPeriodo'][$i]['vacantesReclutador'][$key]['total']=$v['total'];
            }
            echo '</tr>';
        }
        
         echo '<tr><td style="text-align: left;">Vacantes canceladas</td>';
        foreach ($dato3 as $k =>$v){
            echo '<td style="text-align: center">'.$v['canceladas'].'</td>';
            $_SESSION['pPeriodo'][$i]['canceladas']=$v['canceladas'];
        }
        echo '</tr>';
        
         echo '<tr><td style="text-align: left;">Candidatos enviados</td>';
        foreach ($dato4 as $k =>$v){
            echo '<td style="text-align: center">'.$v['enviados'].'</td>';
            $_SESSION['pPeriodo'][$i]['enviados']=$v['enviados'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Contratados</td>';
        foreach ($dato5 as $k =>$v){
            echo '<td style="text-align: center">'.$v['contratados'].'</td>';
            $_SESSION['pPeriodo'][$i]['contratados']=$v['contratados'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Rechazados</td>';
        foreach ($dato6 as $k =>$v){
            echo '<td style="text-align: center">'.$v['rechazados'].'</td>';
                $_SESSION['pPeriodo'][$i]['rechazados']=$v['rechazados'];
        }
        echo '</tr>';
        ?>
</table>        
<?php
 }
}
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
?>
<?php
include_once '../funciones/libreportes.php';
if($_POST['periodo']==1){
$reportes = new Reportes();
$dato = $reportes->totalvacantes_proyectos($_POST['idProyecto']);
$dato3 = $reportes->canceladas_proyectos($_POST['idProyecto']);
$dato4 = $reportes->enviados_proyectos($_POST['idProyecto']);
$dato5 = $reportes->contratados_proyectos($_POST['idProyecto']);
$dato6 = $reportes->rechazados_proyectos($_POST['idProyecto']);
?>
<div>
<table width="100%" class="ui-widget" style="padding:5px; font-size: 17px; text-align: center;">
    <tr><td></td><td>Enero</td><td>Febrero</td><td>Marzo</td><td>Abril</td><td>Mayo</td><td>Junio</td><td>Julio</td><td>Agosto</td><td>Septiembre</td><td>Octubre</td><td>Noviembre</td><td>Diciembre</td></tr>
    <tr><td style="text-align: left;">Total de vacantes</td>
        <?php
        foreach ($dato as $k => $v) {
            echo '<td>'.$v['total'].'</td>';
        }
        ?>
    <tr>
    
        <?php
        
        $reclutador = $reportes->obtiene_reclutadores();
        foreach ($reclutador as $key => $value) {
            $dato2 = $reportes->vacantesreclutador_proyectos($_POST['idProyecto'],$value['idUsuario']);
            
        echo '<tr><td style="text-align: left;">Vacantes asignadas a '.$value['nomUsuario'].' '.$value['appUsuario'].' '.$value['apmUsuario'].'</td>';
            foreach ($dato2 as $k => $v2) {
               echo '<td>'.$v2['total'].'</td>';
            }
            echo '</tr>';
        }
        
        echo '<tr><td style="text-align: left;">Vacantes canceladas</td>';
        foreach ($dato3 as $k =>$v){
            echo '<td>'.$v['canceladas'].'</td>';
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Candidatos enviados</td>';
        foreach ($dato4 as $k =>$v){
            echo '<td>'.$v['enviados'].'</td>';
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Contratados</td>';
        foreach ($dato5 as $k =>$v){
            echo '<td>'.$v['contratados'].'</td>';
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Rechazados</td>';
        foreach ($dato6 as $k =>$v){
            echo '<td>'.$v['rechazados'].'</td>';
        }
        echo '</tr>';
       ?>
    
</table>
</div>    
<?php
}else{
 $reportes = new Reportes();
$dato = $reportes->totalvacantes_proyectosP($_POST['idProyecto'], $_POST['inicio'], $_POST['final']);
}
?>
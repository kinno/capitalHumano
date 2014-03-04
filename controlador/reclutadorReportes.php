<?php
include_once '../funciones/libreportes.php';
if($_POST['periodo']==1){
$reportes = new Reportes();
$dato = $reportes->totalvacantes_reclutador($_POST['idReclutador']);
$dato3 = $reportes->canceladas_reclutador($_POST['idReclutador']);
$dato4 = $reportes->enviados_reclutador($_POST['idReclutador']);
$dato5 = $reportes->contratados_reclutador($_POST['idReclutador']);
$dato6 = $reportes->rechazados_reclutador($_POST['idReclutador']);
?>
<table width="100%" class="ui-widget" style="font-size: 17px; text-align: center;">
    <tr><td></td><td>Enero</td><td>Febrero</td><td>Marzo</td><td>Abril</td><td>Mayo</td><td>Junio</td><td>Julio</td><td>Agosto</td><td>Septiembre</td><td>Octubre</td><td>Noviembre</td><td>Diciembre</td></tr>
    <tr><td style="text-align: left;">Total de vacantes</td>
        <?php
        foreach ($dato as $k => $v) {
            echo '<td>'.$v['total'].'</td>';
        }
        ?>
    <tr>
    
        <?php
        $proyectos = $reportes->obtiene_proyectos();
        foreach ($proyectos as $key => $value) {
            $dato2 = $reportes->totalproyecto_reclutador($_POST['idReclutador'],$value['idProyecto']);
            
            echo '<tr><td style="text-align: left;">Vacantes para '.$value['nomProyecto'].'</td>';
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
<?php
}else{
    echo 'Reporte por periodos';
}
    ?>
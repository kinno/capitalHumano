<?php
include_once '../funciones/libreportes.php';
if($_POST['periodo']==1){
$reportes = new Reportes();
for($i=0;$i<count($_POST['idReclutador']);$i++){   
$dato = $reportes->totalvacantes_reclutador($_POST['idReclutador'][$i]);
$dato3 = $reportes->canceladas_reclutador($_POST['idReclutador'][$i]);
$dato4 = $reportes->enviados_reclutador($_POST['idReclutador'][$i]);
$dato5 = $reportes->contratados_reclutador($_POST['idReclutador'][$i]);
$dato6 = $reportes->rechazados_reclutador($_POST['idReclutador'][$i]);
?>
<table width="100%" class="ui-widget" style="font-size: 17px; text-align: center;">
    <tr><td><?php echo $_POST['nomReclutador'][$i];?></td><td>Enero</td><td>Febrero</td><td>Marzo</td><td>Abril</td><td>Mayo</td><td>Junio</td><td>Julio</td><td>Agosto</td><td>Septiembre</td><td>Octubre</td><td>Noviembre</td><td>Diciembre</td></tr>
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
            $dato2 = $reportes->totalproyecto_reclutador($_POST['idReclutador'][$i],$value['idProyecto']);
            
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
}

        }else{
    $reportes = new Reportes();
     for($i=0;$i<count($_POST['idReclutador']);$i++){ 
    $dato = $reportes->totalvacantes_reclutadorP($_POST['idReclutador'][$i], $_POST['inicio'], $_POST['final']);
    $dato3 = $reportes->canceladas_reclutadorP($_POST['idReclutador'][$i],$_POST['inicio'], $_POST['final']);
    $dato4 = $reportes->enviados_reclutadorP($_POST['idReclutador'][$i],$_POST['inicio'], $_POST['final']);
    $dato5 = $reportes->contratados_reclutadorP($_POST['idReclutador'][$i],$_POST['inicio'], $_POST['final']);
    $dato6 = $reportes->rechazados_reclutadorP($_POST['idReclutador'][$i],$_POST['inicio'], $_POST['final']);
?>
    <table width="100%" class="ui-widget" style="font-size: 17px; text-align: center;">
    <tr><td><?php echo $_POST['nomReclutador'][$i];?></td><td><?php echo 'Periodo del '.$_POST['inicio'].' al '.$_POST['final']?></td></tr>
    <tr><td style="text-align: left;">Total de vacantes</td>
        <?php
        foreach ($dato as $k => $v) {
            echo '<td>'.$v['total'].'</td>';
        }
        ?>
    </tr>    
        <?php
        $proyectos = $reportes->obtiene_proyectos();
        foreach ($proyectos as $key => $value) {
            $dato2 = $reportes->totalproyecto_reclutadorP($_POST['idReclutador'][$i],$value['idProyecto'],$_POST['inicio'], $_POST['final']);
            
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
}
        }
    ?>
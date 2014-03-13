<?php
session_start();
include_once '../funciones/libreportes.php';
$_SESSION['pAnual']=array();
$_SESSION['pPeriodo']=array();
 echo '<span style="float:right" class="exprt" onclick="exportar(\'reclutador\');">Exportar</span>';
if($_POST['periodo']==1){
$reportes = new Reportes();
for($i=0;$i<count($_POST['idReclutador']);$i++){   
$dato = $reportes->totalvacantes_reclutador($_POST['idReclutador'][$i]);
$dato3 = $reportes->canceladas_reclutador($_POST['idReclutador'][$i]);
$dato4 = $reportes->enviados_reclutador($_POST['idReclutador'][$i]);
$dato5 = $reportes->contratados_reclutador($_POST['idReclutador'][$i]);
$dato6 = $reportes->rechazados_reclutador($_POST['idReclutador'][$i]);
?>
<table width="100%" class="ui-widget ui-widget-content ui-corner-all" style="padding:5px;text-align: center;margin-top: 5px;">
    <tr class="ui-state-default"><td><?php echo $_POST['nomReclutador'][$i];?></td><td>Enero</td><td>Febrero</td><td>Marzo</td><td>Abril</td><td>Mayo</td><td>Junio</td><td>Julio</td><td>Agosto</td><td>Septiembre</td><td>Octubre</td><td>Noviembre</td><td>Diciembre</td></tr>
    <tr><td style="text-align: left;">Total de vacantes</td>
        <?php
        $_SESSION['pAnual'][$i]['nombreReclutador']=$_POST['nomReclutador'][$i];
        
        foreach ($dato as $k => $v) {
            echo '<td>'.$v['total'].'</td>';
            $_SESSION['pAnual'][$i]['total'][$k]=$v['total'];
        }
        ?>
    <tr>
    
        <?php
        $proyectos = $reportes->obtiene_proyectos();
        foreach ($proyectos as $key => $value) {
            $dato2 = $reportes->totalproyecto_reclutador($_POST['idReclutador'][$i],$value['idProyecto']);
            $_SESSION['pAnual'][$i]['vacantesProyecto'][$key]['nombre']=$value['nomProyecto'];
            echo '<tr><td style="text-align: left;">Vacantes para '.$value['nomProyecto'].'</td>';
            foreach ($dato2 as $k => $v2) {
               echo '<td>'.$v2['total'].'</td>';
               $_SESSION['pAnual'][$i]['vacantesProyecto'][$key][$k]=$v2['total'];
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
    <table width="100%" class="ui-widget ui-widget-content" style="padding:5px; text-align: center;">
    <tr class="ui-state-default"><td><?php echo $_POST['nomReclutador'][$i];?></td><td><?php echo 'Periodo del '.$_POST['inicio'].' al '.$_POST['final']?></td></tr>
    <tr><td style="text-align: left;">Total de vacantes</td>
        <?php
        $_SESSION['pPeriodo'][$i]['nombre']=$_POST['nomReclutador'][$i];
        $_SESSION['pPeriodo'][$i]['fecha']='Periodo del '.$_POST['inicio'].' al '.$_POST['final'];
        foreach ($dato as $k => $v) {
            echo '<td>'.$v['total'].'</td>';
            $_SESSION['pPeriodo'][$i]['total']=$v['total'];
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
               $_SESSION['pPeriodo'][$i]['vacantesProyecto'][$key]['nombreProyecto']=$value['nomProyecto'];
               $_SESSION['pPeriodo'][$i]['vacantesProyecto'][$key]['total']=$v['total'];
            }
            echo '</tr>';
        }
        
        echo '<tr><td style="text-align: left;">Vacantes canceladas</td>';
        foreach ($dato3 as $k =>$v){
            echo '<td>'.$v['canceladas'].'</td>';
            $_SESSION['pPeriodo'][$i]['canceladas']=$v['canceladas'];
            
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Candidatos enviados</td>';
        foreach ($dato4 as $k =>$v){
            echo '<td>'.$v['enviados'].'</td>';
            $_SESSION['pPeriodo'][$i]['enviados']=$v['enviados'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Contratados</td>';
        foreach ($dato5 as $k =>$v){
            echo '<td>'.$v['contratados'].'</td>';
            $_SESSION['pPeriodo'][$i]['contratados']=$v['contratados'];
        }
        echo '</tr>';
        
        echo '<tr><td style="text-align: left;">Rechazados</td>';
        foreach ($dato6 as $k =>$v){
            echo '<td>'.$v['rechazados'].'</td>';
            $_SESSION['pPeriodo'][$i]['rechazados']=$v['rechazados'];
        }
        echo '</tr>';       
        ?>
        
    </table>
<?php
}
        }
//        echo '<pre>';
//        print_r($_SESSION);
//        echo '</pre>';
    ?>
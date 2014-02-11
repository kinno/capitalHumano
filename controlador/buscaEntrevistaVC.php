<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$idVacCand = $_POST['idVacCand'];
$dato = $vacantes->entrevista_especifica($idVacCand);

    if(count($dato)>0){
        echo '
                <table cellpadding="0" cellspacing="0" border="0">
                        <tr style="text-align:center;">
                            <td></td>
                            <td>Fecha y hora</td>
                            <td>Lugar</td>
                            <td>Entrevistador</td>
                            <td>Estatus</td>
                            <td>Observaciones</td>
                            
                        </tr>';

                       foreach($dato as $v)
                       {
                                   echo '<tr align=center valign=top>';
                                   echo '<td><span class="resEntrev" onclick="abrirResultados('.$v['idEntrev'].');" title="Registrar resultado"></span></td>';
                                   echo '<td style="width:110px">'.$v['fecEntrev'].'</td>';
                                   echo '<td style="width:110px">'.$v['titulolugar'].'</td>';
                                   echo '<td>'.$v['nomEentrev'].'</td>';
                                   echo '<td>'.$v['descEstatus'].'</td>';
                                   echo '<td>'.$v['ObsEntrev'].'</td>';
                                   echo '</tr>';

                            }

          echo     '
                </table>
                ';
    }
    else{
        echo 'No hay entrevistas registradas.';
    }
?>
    
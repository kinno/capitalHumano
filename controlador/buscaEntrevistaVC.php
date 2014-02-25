<?php
include_once("../funciones/libvacantes.php");
$vacantes = new Vacantes();
$idVacCand = $_POST['idVacCand'];
$dato = $vacantes->entrevista_especifica($idVacCand);
 $idEstado=0;
    if(count($dato)>0){
        
         //FUNCION PARA VERIFICAR SI YA ESTA CONTRATADO O RECHAZADO
           
             $estado=$vacantes->obtener_estadoCandidato('', $idVacCand,'');
             foreach ($estado as $val) {
                 $idEstado = $val['estatus'];
             }
             if($idEstado!=0){
                 if($idEstado==1)
                     $desc='Contratado';
                 else if($idEstado==2)
                     $desc ='Rechazado pero considerado para otra vacante';
                 else if($idEstado==3)
                     $desc ='Rechazado';

                 echo '<center><span class="ui-state-highlight ui-corner-all" style="font-size:18px">Estado de candidato para ésta vacante: '.$desc.'</span></center>
                     ';
                 
             }
          //
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
    
    if($idEstado!=0){
        echo '<script>setTimeout(function(){desactivaOpciones();},100)</script>';
    }
?>
    
<?php
session_start();
require_once 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
include '../funciones/ChromePhp.php';
$objPHPExcel = new PHPExcel();

$meses = array(
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
);
$columnas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P');
$objWorksheet;
if($_GET['tipo']=='proyecto'){
    
    if(count($_SESSION['pAnual'])>0){

        $band = false;    
        for($i=0;$i<count($_SESSION['pAnual']);$i++){
            $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
            
            $objPHPExcel->addSheet($objWorksheet);
            $objWorksheet->setTitle($_SESSION['pAnual'][$i]['nombre']);
            $objPHPExcel->setActiveSheetIndex(($i+1));

            $num=3;
            $objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Reporte por proyecto');
            $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            cellColor('A1:M1', 'E3F1FD');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num.'',$_SESSION['pAnual'][$i]['nombre']);
            $m=0;
            while ($m<count($meses)){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$meses[$m]);
                $m++;
            }
            cellColor('A'.$num.':M'.$num, 'E3F1FD');
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Total de vacantes');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['total'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['total'][$m]);
                $m++;
            }
            $num++;


            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['vacantesReclutador'])){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes asignadas a '.$_SESSION['pAnual'][$i]['vacantesReclutador'][$m]['nombre']);

                $n=1;
                while($n<count($_SESSION['pAnual'][$i]['vacantesReclutador'][$m])){
                    $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$n].$num,$_SESSION['pAnual'][$i]['vacantesReclutador'][$m][$n-1]);
                    $n++;
                }
                $num++;
                $m++;
            }
            //$num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes canceladas');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['canceladas'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['canceladas'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos enviados');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['enviados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['enviados'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos contratados');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['contratados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['contratados'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos rechazados');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['rechazados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['rechazados'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            
        }
        //$objPHPExcel->removeSheetByIndex(0);
    }else{

        $band = false;    
        for($i=0;$i<count($_SESSION['pPeriodo']);$i++){
            $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
            $objPHPExcel->addSheet($objWorksheet);
            $objWorksheet->setTitle($_SESSION['pPeriodo'][$i]['nombre']);
            $objPHPExcel->setActiveSheetIndex(($i+1));

            $num=3;
            $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Reporte por proyecto');
            $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            cellColor('A1:B1', 'E3F1FD');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num.'',$_SESSION['pPeriodo'][$i]['nombre']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$num.'',$_SESSION['pPeriodo'][$i]['fecha']);
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Total de vacantes');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['total'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['total']);
                $m++;
            }
             cellColor('A'.($num-1).':B'.($num-1), 'E3F1FD');
            $num++;


            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['vacantesReclutador'])){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes asignadas a '.$_SESSION['pPeriodo'][$i]['vacantesReclutador'][$m]['nReclutador']);

                $n=1;
                while($n<count($_SESSION['pPeriodo'][$i]['vacantesReclutador'][$m])){
                    $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$n].$num,$_SESSION['pPeriodo'][$i]['vacantesReclutador'][$m]['total']);
                    $n++;
                }
                $num++;
                $m++;
            }
            //$num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes canceladas');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['canceladas'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['canceladas']);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos enviados');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['enviados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['enviados']);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos contratados');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['contratados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['contratados']);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos rechazados');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['rechazados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['rechazados']);
                $m++;
            }
            $num++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        }

    }
}else{
    
    if(count($_SESSION['pAnual'])>0){

        $band = false;    
        for($i=0;$i<count($_SESSION['pAnual']);$i++){
            $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
            $objPHPExcel->addSheet($objWorksheet);
            $objWorksheet->setTitle($_SESSION['pAnual'][$i]['nombreReclutador']);
            $objPHPExcel->setActiveSheetIndex(($i+1));

            $num=3;
            $objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Reporte por reclutador');
            $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            cellColor('A1:M1', 'E3F1FD');

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num.'',$_SESSION['pAnual'][$i]['nombreReclutador']);
            $m=0;
            while ($m<count($meses)){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$meses[$m]);
                $m++;
            }
             cellColor('A'.$num.':M'.$num, 'E3F1FD');
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Total de vacantes');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['total'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['total'][$m]);
                $m++;
            }
            $num++;


            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['vacantesProyecto'])){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes asignadas a '.$_SESSION['pAnual'][$i]['vacantesProyecto'][$m]['nombre']);

                $n=1;
                while($n<count($_SESSION['pAnual'][$i]['vacantesProyecto'][$m])){
                    $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$n].$num,$_SESSION['pAnual'][$i]['vacantesProyecto'][$m][$n-1]);
                    $n++;
                }
                $num++;
                $m++;
            }
            //$num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes canceladas');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['canceladas'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['canceladas'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos enviados');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['enviados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['enviados'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos contratados');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['contratados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['contratados'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos rechazados');
            $m=0;
            while($m<count($_SESSION['pAnual'][$i]['rechazados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pAnual'][$i]['rechazados'][$m]);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        }
    }else{

        $band = false;    
        for($i=0;$i<count($_SESSION['pPeriodo']);$i++){
            $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
            $objPHPExcel->addSheet($objWorksheet);
            $objWorksheet->setTitle($_SESSION['pPeriodo'][$i]['nombre']);
            $objPHPExcel->setActiveSheetIndex(($i+1));

            $num=3;
            $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Reporte por proyecto');
            $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            cellColor('A1:B1', 'E3F1FD');

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num.'',$_SESSION['pPeriodo'][$i]['nombre']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$num.'',$_SESSION['pPeriodo'][$i]['fecha']);
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Total de vacantes');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['total'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['total']);
                $m++;
            }
             cellColor('A'.($num-1).':B'.($num-1), 'E3F1FD');
            $num++;


            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['vacantesProyecto'])){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes asignadas a '.$_SESSION['pPeriodo'][$i]['vacantesProyecto'][$m]['nombreProyecto']);

                $n=1;
                while($n<count($_SESSION['pPeriodo'][$i]['vacantesProyecto'][$m])){
                    $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$n].$num,$_SESSION['pPeriodo'][$i]['vacantesProyecto'][$m]['total']);
                    $n++;
                }
                $num++;
                $m++;
            }
            //$num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Vacantes canceladas');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['canceladas'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['canceladas']);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos enviados');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['enviados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['enviados']);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos contratados');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['contratados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['contratados']);
                $m++;
            }
            $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num,'Candidatos rechazados');
            $m=0;
            while($m<count($_SESSION['pPeriodo'][$i]['rechazados'])){
                $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$_SESSION['pPeriodo'][$i]['rechazados']);
                $m++;
            }
            $num++;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        }

    }
}   
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->removeSheetByIndex(0);
//    echo '<pre>';
//    print_r($objPHPExcel);
//    echo '</pre>';
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Type: application/force-download');
    header('Content-Type: application/octet-stream');
    header('Content-Type: application/download;  charset=utf-8');    
    header("Content-Disposition: attachment;filename=reporte_".date("d-m-Y_H:i:s").".xls");
    header('Content-Transfer-Encoding: binary');    
    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    $objWriter->save("php://output");
    
function cellColor($cells,$color){
    global $objPHPExcel;
    $objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => $color)
            )
        )
    );
}
   

?>

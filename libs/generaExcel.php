<?php
session_start();
require_once 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
$objPHPExcel = new PHPExcel();
//$objRichText = new PHPExcel_RichText();
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

if(count($_SESSION['pAnual']>0)){
    $band = false;    
    for($i=0;$i<count($_SESSION['pAnual']);$i++){
        $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
        $objPHPExcel->addSheet($objWorksheet);
	$objWorksheet->setTitle($_SESSION['pAnual'][$i]['nombre']);
        $objPHPExcel->setActiveSheetIndex(($i+1));
        
        $num=3;
        $objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Reporte por proyecto');

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num.'',$_SESSION['pAnual'][$i]['nombre']);
        $m=0;
        while ($m<count($meses)){
            $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$meses[$m]);
            $m++;
        }
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
        
//         if(!$band){
//             $objPHPExcel->removeSheetByIndex(0);
//             $band=true;
//         }
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
        $objPHPExcel->getActiveSheet()->mergeCells('A1:P1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Reporte por proyecto');

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$num.'',$_SESSION['pAnual'][$i]['nombre']);
        $m=0;
        while ($m<count($meses)){
            $objPHPExcel->getActiveSheet()->SetCellValue($columnas[$m+1].$num,$meses[$m]);
            $m++;
        }
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
        
//         if(!$band){
//             $objPHPExcel->removeSheetByIndex(0);
//             $band=true;
//         }
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    }
}
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

   

?>

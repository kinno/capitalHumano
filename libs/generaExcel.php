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
        
//         if(!$band){
//             $objPHPExcel->removeSheetByIndex(0);
//             $band=true;
//         }
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

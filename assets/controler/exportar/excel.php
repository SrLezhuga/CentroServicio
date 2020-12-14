<?php
include_once "importar.php";
include_once "exportarxls.php";

conectar();
getErrorReporting();
noCli();

/** Include PHPExcel */
require_once '../../vendor/PHPExcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Brandon Lechuga")
							 ->setLastModifiedBy("Brandon Lechuga")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'CODIGO')
            ->setCellValue('B1', 'DESCRIPCION')
            ->setCellValue('C1', 'MARCA')
            ->setCellValue('D1', 'EXISTENCIA')
            ->setCellValue('E1', 'UNIDAD')
            ->setCellValue('F1', 'COSTO');


$i = 2;
$refacciones = getQuery();      
    while ($row = $refacciones->fetch_array(MYSQLI_ASSOC)) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$i", $row['cod_refaccion'])
            ->setCellValue("B$i", $row['desc_refaccion'])
            ->setCellValue("C$i", $row['marca_refaccion'])
            ->setCellValue("D$i", $row['cant_refaccion'])
            ->setCellValue("E$i", $row['unidad_refaccion'])
            ->setCellValue("F$i", $row['costo_refaccion']);
        $i++;
    }


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Inventario');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

getHeaders();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>

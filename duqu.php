<?php
error_reporting(E_ALL);
//require 'PHPExcel.php';
//require 'Classes/PHPExcel/Autoloader.php';
//require 'Classes/PHPExcel/Reader/Excel2007.php';
//require 'Classes/PHPExcel/Reader/Excel5.php';
require_once 'phpexcel.php'; 
require_once 'PHPExcel\IOFactory.php';
require_once 'PHPExcel\Reader\Excel5.php';

$excel_file = 'gaotangpractice.xlsx';

$PHPExcel = new PHPExcel();

$PHPReader = new PHPExcel_Reader_Excel2007();
$PHPExcel = $PHPReader->load($excel_file);

$sheet = $PHPExcel->getActiveSheet();

$allCol=PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
$allRow=$sheet->getHighestRow();
for ($col=0; $col<$allCol;$col++) {
    for ($row=0; $row<$allRow;$row++) {
        echo $sheet->getCellByColumnAndRow($col, $row)->getValue();
    }
}


?>
<?php
//定义一个excel文件 
$workbook = "C:\Users\shen\php\bankInNyc\excelxieru/test1.xlsx"; 
$sheet = "Sheet1"; 

//生成一个com对象$ex 
$ex = new COM("Excel.sheet") or Die ("连不上！！！"); 

//打开一个excel文件 
$book = $ex->application->Workbooks->Open($workbook) or Die ("打不开！！！"); 

$sheets = $book->Worksheets($sheet); 
$sheets->activate; 

//获取一个单元格 
$cell = $sheets->Cells(5,5); 
$cell->activate; 
//给该单元格赋值 
$cell->value = 999; 

//保存为另一文件newtest.xls 
$ex->Application->ActiveWorkbook->SaveAs("newtest.xls"); 

//关掉excel，如果想看效果，则注释掉下面两行，由用户手动关掉excel 
$ex->Application->ActiveWorkbook->Close("False"); 
unset ($ex); 

?>
<?php
//����һ��excel�ļ� 
$workbook = "C:\Users\shen\php\bankInNyc\excelxieru/test1.xlsx"; 
$sheet = "Sheet1"; 

//����һ��com����$ex 
$ex = new COM("Excel.sheet") or Die ("�����ϣ�����"); 

//��һ��excel�ļ� 
$book = $ex->application->Workbooks->Open($workbook) or Die ("�򲻿�������"); 

$sheets = $book->Worksheets($sheet); 
$sheets->activate; 

//��ȡһ����Ԫ�� 
$cell = $sheets->Cells(5,5); 
$cell->activate; 
//���õ�Ԫ��ֵ 
$cell->value = 999; 

//����Ϊ��һ�ļ�newtest.xls 
$ex->Application->ActiveWorkbook->SaveAs("newtest.xls"); 

//�ص�excel������뿴Ч������ע�͵��������У����û��ֶ��ص�excel 
$ex->Application->ActiveWorkbook->Close("False"); 
unset ($ex); 

?>
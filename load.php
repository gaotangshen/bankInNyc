<?php
include "mysql.class.php";
ini_set("memory_limit","1000M");
$db = new mysql("localhost","root","","bankinnyc","utf-8");
//load excel files
function uploadFile($file,$filetempname)
{
	//set up dir
	$filePath = 'C:\Users\shen\php\bankInNyc\EXCEL/';
	$str = "";
	//下面的路径按照你PHPExcel的路径来修改 according to your  phpexcel dir 
	set_include_path('.'. PATH_SEPARATOR .
      'C:\Users\shen\php\bankInNyc\PHPExcel' . PATH_SEPARATOR .    
	get_include_path());

	require_once 'PHPExcel.php';
	require_once 'PHPExcel\IOFactory.php';
	require_once 'PHPExcel\Reader\Excel5.php';
	require_once 'PHPExcel\Reader\Excel2007.php';

	$filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
	$time=date("y-m-d-H-i-s");//去当前上传的时间
	$filename[0]=$time;//取文件名t替换
	$name=implode(".",$filename); //上传后的文件名
	$uploadfile=$filePath.$name;//上传后的文件名地址
	echo $uploadfile;
	echo "<br>";
	echo $filetempname;
	//move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
	$result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
	echo $result;
	if($result) //如果上传文件成功，就执行导入excel操作
	{
	
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format
		$objPHPExcel = $objReader->load($uploadfile);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		echo $highestRow;
		echo "<br>";
		$highestColumn = $sheet->getHighestColumn(); // 取得总列数
		echo $highestColumn;
		//echo "<script language=\"javascript\">alert('$highestColumn');</script>";
		//循环读取excel文件,读取一条,插入一条
		for($j=2;$j<=$highestRow;$j++)
		{
			for($k='A';$k<=$highestColumn;$k++)
			{
				echo $j;
				$str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'#$%';//读取单元格
			}
			
			//explode:函数把字符串分割为数组。
			$strs = explode('#$%',$str);
			//echo $strs[0]; die();
			
			$sql = "INSERT INTO branch (address,city,stalp,zip,name,cert,county,offname,stname)".
    "VALUES('$strs[0]','$strs[1]','$strs[2]','$strs[3]','$strs[4]','$strs[5]','$strs[6]','$strs[7]','$strs[8]')";     
			 
			//mysql_query("set names GBK");
			if(!mysql_query($sql))
			{
				
				return false;
			}
			
			$str = "";
		}
		 
		unlink($uploadfile);
		$msg = "success！";
	}
	else
	{
		$msg = "fail！";
	}
die();
	return $msg;
}


function uploadChecking($file,$filetempname)
{
	echo "test";
	//set up dir
	$filePath = 'C:\Users\shen\php\bankInNyc\EXCEL/';
	$str = "";
	//下面的路径按照你PHPExcel的路径来修改 according to your  phpexcel dir 
	set_include_path('.'. PATH_SEPARATOR .
      'C:\Users\shen\php\bankInNyc\PHPExcel' . PATH_SEPARATOR .    
	get_include_path());

	require_once 'PHPExcel.php';
	require_once 'PHPExcel\IOFactory.php';
	require_once 'PHPExcel\Reader\Excel5.php';
	require_once 'PHPExcel\Reader\Excel2007.php';

	$filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
	$time=date("y-m-d-H-i-s");//去当前上传的时间
	$filename[0]=$time;//取文件名t替换
	$name=implode(".",$filename); //上传后的文件名
	$uploadfile=$filePath.$name;//上传后的文件名地址
	

	//move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
	$result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
	
	if($result) //如果上传文件成功，就执行导入excel操作
	{
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format
		$objPHPExcel = $objReader->load($uploadfile);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		
		$highestColumn = $sheet->getHighestColumn(); // 取得总列数
		
		//echo "<script language=\"javascript\">alert('$highestColumn');</script>";
		//循环读取excel文件,读取一条,插入一条
		for($j=2;$j<=$highestRow;$j++)
		{
			for($k='A';$k<=$highestColumn;$k++)
			{
				
				$str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'#$%';//读取单元格
			}
			
			//explode:函数把字符串分割为数组。
			$strs = explode('#$%',$str);
			//echo $strs[0]; die();
			
			$sql = "INSERT INTO checking (name,cert,checkingName,checkingLink,summary,minimumBalance,monServiceCharge,benefits,onlineBanking)".
    "VALUES('$strs[0]','$strs[1]','$strs[2]','$strs[3]','$strs[4]','$strs[5]','$strs[6]','$strs[7]','$strs[8]')";     
			
			//mysql_query("set names GBK");
			if(!mysql_query($sql))
			{
				var_dump($msg);
				return false;
			}
			
			$str = "";
		}
		 
		unlink($uploadfile);echo "<script language=\"javascript\">alert('success');</script>";
		
		$msg = "success！";
	}
	else
	{
		$msg = "fail！";
	}
	
	return $msg;
	
}

?>

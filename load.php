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
	//�����·��������PHPExcel��·�����޸� according to your  phpexcel dir 
	set_include_path('.'. PATH_SEPARATOR .
      'C:\Users\shen\php\bankInNyc\PHPExcel' . PATH_SEPARATOR .    
	get_include_path());

	require_once 'PHPExcel.php';
	require_once 'PHPExcel\IOFactory.php';
	require_once 'PHPExcel\Reader\Excel5.php';
	require_once 'PHPExcel\Reader\Excel2007.php';

	$filename=explode(".",$file);//���ϴ����ļ����ԡ�.����Ϊ׼��һ�����顣
	$time=date("y-m-d-H-i-s");//ȥ��ǰ�ϴ���ʱ��
	$filename[0]=$time;//ȡ�ļ���t�滻
	$name=implode(".",$filename); //�ϴ�����ļ���
	$uploadfile=$filePath.$name;//�ϴ�����ļ�����ַ
	echo $uploadfile;
	echo "<br>";
	echo $filetempname;
	//move_uploaded_file() �������ϴ����ļ��ƶ�����λ�á����ɹ����򷵻� true�����򷵻� false��
	$result=move_uploaded_file($filetempname,$uploadfile);//�����ϴ�����ǰĿ¼��
	echo $result;
	if($result) //����ϴ��ļ��ɹ�����ִ�е���excel����
	{
	
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format
		$objPHPExcel = $objReader->load($uploadfile);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow(); // ȡ��������
		echo $highestRow;
		echo "<br>";
		$highestColumn = $sheet->getHighestColumn(); // ȡ��������
		echo $highestColumn;
		//echo "<script language=\"javascript\">alert('$highestColumn');</script>";
		//ѭ����ȡexcel�ļ�,��ȡһ��,����һ��
		for($j=2;$j<=$highestRow;$j++)
		{
			for($k='A';$k<=$highestColumn;$k++)
			{
				echo $j;
				$str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'#$%';//��ȡ��Ԫ��
			}
			
			//explode:�������ַ����ָ�Ϊ���顣
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
		$msg = "success��";
	}
	else
	{
		$msg = "fail��";
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
	//�����·��������PHPExcel��·�����޸� according to your  phpexcel dir 
	set_include_path('.'. PATH_SEPARATOR .
      'C:\Users\shen\php\bankInNyc\PHPExcel' . PATH_SEPARATOR .    
	get_include_path());

	require_once 'PHPExcel.php';
	require_once 'PHPExcel\IOFactory.php';
	require_once 'PHPExcel\Reader\Excel5.php';
	require_once 'PHPExcel\Reader\Excel2007.php';

	$filename=explode(".",$file);//���ϴ����ļ����ԡ�.����Ϊ׼��һ�����顣
	$time=date("y-m-d-H-i-s");//ȥ��ǰ�ϴ���ʱ��
	$filename[0]=$time;//ȡ�ļ���t�滻
	$name=implode(".",$filename); //�ϴ�����ļ���
	$uploadfile=$filePath.$name;//�ϴ�����ļ�����ַ
	

	//move_uploaded_file() �������ϴ����ļ��ƶ�����λ�á����ɹ����򷵻� true�����򷵻� false��
	$result=move_uploaded_file($filetempname,$uploadfile);//�����ϴ�����ǰĿ¼��
	
	if($result) //����ϴ��ļ��ɹ�����ִ�е���excel����
	{
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format
		$objPHPExcel = $objReader->load($uploadfile);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow(); // ȡ��������
		
		$highestColumn = $sheet->getHighestColumn(); // ȡ��������
		
		//echo "<script language=\"javascript\">alert('$highestColumn');</script>";
		//ѭ����ȡexcel�ļ�,��ȡһ��,����һ��
		for($j=2;$j<=$highestRow;$j++)
		{
			for($k='A';$k<=$highestColumn;$k++)
			{
				
				$str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'#$%';//��ȡ��Ԫ��
			}
			
			//explode:�������ַ����ָ�Ϊ���顣
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
		
		$msg = "success��";
	}
	else
	{
		$msg = "fail��";
	}
	
	return $msg;
	
}

?>

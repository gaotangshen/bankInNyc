<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div>
<?php 


require_once 'load.php';

if(isset($_POST['leadExcel']))
{
	//get the file name
	$filename = $HTTP_POST_FILES['inputExcel']['name'];
	
	echo "<br>";
	//echo "test";
	//tempname on your server 
	$tmp_name = $_FILES['inputExcel']['tmp_name'];
	echo $tmp_name;
	echo "sss";
	$msg = uploadFile($filename,$tmp_name);
	echo $msg;
	echo "Sucess";
}
?>
<form action="#"  name="form2" method="post" enctype="multipart/form-data">
	<input type="hidden" name="leadExcel" value="true">
	<table align="center" width="90%" border="0">
		<tr>
			<td><input type="file" name="inputExcel"><input type="submit"
				value="submit">
			</td>
		</tr>
	</table>
</form>

<?php 
if(isset($_POST['CheckingExcel']))
{
	//get the file name
	$filename = $HTTP_POST_FILES['inputExcel']['name'];
	echo $filename;
	echo "<br>";
	//echo "test";
	//tempname on your server 
	$tmp_name = $_FILES['inputExcel']['tmp_name'];
	echo $tmp_name;
	die();
	echo $filename;
	$msg = uploadChecking($filename,$tmp_name);
	 
	echo $msg;
	
}else{
	echo "adsfs";
}
?>
<form  action="" name="form2" method="post"enctype="multipart/form-data">
	<input type="hidden" name="CheckingExcel" value="true">
	<table align="center" width="90%" border="0">
		<tr>
			<td><input type="file" name="inputExcel"><input type="submit"
				value="submit">
			</td>
		</tr>
	</table>
</form>
</div>
</body>
</html>
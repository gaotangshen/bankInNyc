<? ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link
	href="http://code.google.com//apis/maps/documentation/javascript/examples/default.css"
	rel="stylesheet" type="text/css">
<link id="main_stylesheet" rel="stylesheet" href="CSS/style.css"
	type="text/css" />
<style>
table,th,td {
	border: 1px;
}
</style>
</head>
<body>
<?php
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
if(isset($_POST['username'])){
	$sql="select username from admin where username='$_POST[username]'";
	$querry=mysql_query($sql)or die('Query failed: ' . mysql_error());
	$row=mysql_fetch_array($querry);
	if($_POST[username]==$row[username]){
		//echo $_POST['pw'];
		$sql1="select password from admin where password='$_POST[pw]'";
		$querry=mysql_query($sql1)or die('Query failed: ' . mysql_error());
		$row1=mysql_fetch_array($querry);

		if($_POST['pw']==$row1[password]){
			setcookie("cookie", "ok");
			setcookie("username","$_POST[username]",time()+3600);
			echo $_COOKIE[username];

			echo "<script language=\"javascript\">location.href='branch.php';</script>";

		}
	}
	else {
		echo "<script language=\"javascript\">alert('username not exist');</script>";
	}
}
?>
	<SCRIPT type="text/javascript">
function Checklogin()
{
	if (myform.id.value=="")
	{
		alert("username");
		myform.id.focus();
		return false;
	}
		if (myform.pw.value=="")
	{
		alert("Password");
		myform.pw.focus();
		return false;
	}
}
</SCRIPT>
	<div class="header">
		<div class="navi">
			<a href="bank_office.php">OFFICE</a> <a href="branch.php">BRANCH</a>
		</div>
	</div>

	<div>
		<form action="" method="post" name="myform"
			onsubmit="return Checklogin();">
			<table>
				<tr>
					<td align="right" height=50><label style="color: #C71585">Username:</label>
					</td>
					<td><input type="text" name="username" /></td>
				</tr>
				<tr>
					<td align="right" height=50><label style="color: #C71585">Password:</label>
					</td>
					<td><input type="password" name="pw" /></td>
				</tr>
				<tr>
					<td height=50></td>
					<td align="center"><input type="submit" name="log in"
						value="log in" /></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>

<? ob_flush(); ?>
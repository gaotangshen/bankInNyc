<!DOCTYPE html>
<html>
<head>
<link
	href="http://code.google.com//apis/maps/documentation/javascript/examples/default.css"
	rel="stylesheet" type="text/css">
<link id="main_stylesheet" rel="stylesheet" href="CSS/style.css"
	type="text/css" />
</head>
<body>
<?php
if(!isset($_COOKIE[username])){
	echo "<script language=\"javascript\">location.href='bank_office.php';</script>";
}
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
if(isset($_GET['branchID'])){
	$branchID=$_GET['branchID'];
	$sql="select * from branch where branchID ='$_GET[branchID]'";
	$querry=mysql_query($sql)or die('Query failed: ' . mysql_error());
	$row=mysql_fetch_array($querry);
}
if(isset($_POST['submit'])){
	$sql1="UPDATE bankinnyc.branch SET branchID='$_POST[branchID]', address='$_POST[address]', city='$_POST[city]',stalp='$_POST[stalp]',
	zip='$_POST[zip]',name='$_POST[name]',cert='$_POST[cert]',county='$_POST[county]',offname='$_POST[offname]',stname='$_POST[stname]',
	latitude='$_POST[latitude]',lngitude='$_POST[lngitude]' WHERE branchID='$branchID'";
	mysql_query($sql1)or die('Query failed: ' . mysql_error());
	$branchlog = "select * from bankinnyc.branchlog where branchID='$branchID'";
	$branchquery = mysql_query($branchlog)or die('Query failed: ' . mysql_error());
	$bankinbranchlog=mysql_fetch_array($branchquery);
	if($bankinbranchlog['branchID']){
		$sql2="UPDATE bankinnyc.branchlog SET branchID='$_POST[branchID]', address='$_POST[address]', city='$_POST[city]',stalp='$_POST[stalp]',
		zip='$_POST[zip]',name='$_POST[name]',cert='$_POST[cert]',county='$_POST[county]',offname='$_POST[offname]',stname='$_POST[stname]',
		latitude='$_POST[latitude]',lngitude='$_POST[lngitude]' WHERE branchID='$branchID'";
		mysql_query($sql2)or die('Query failed: ' . mysql_error());
	}
	else{
		$sql2 = "INSERT INTO  `bankinnyc`.`branchlog`(`branchID` ,`address` ,`city` ,`stalp` ,`zip` ,`name` ,`cert` ,`county` ,`offname` ,`stname` ,`latitude` ,`lngitude`)
		VALUES ('$_POST[branchID]',  '$_POST[address]',  '$_POST[city]', '$_POST[stalp]', '$_POST[zip]',  '$_POST[name]','$_POST[cert]', '$_POST[county]',  '$_POST[offname]' ,  '$_POST[stname]',  '$_POST[latitude]','$_POST[lngitude]'
		);";
		mysql_query($sql2)or die('Query failed: ' . mysql_error());
	}
	echo "<script language=\"javascript\">alert('success');</script>";
	$sql="select * from branch where branchID ='$_POST[branchID]'";
	$querry=mysql_query($sql)or die('Query failed: ' . mysql_error());
	$row=mysql_fetch_array($querry);
}
?>
<?php include 'head_office.php';?>
	<div>
		<form id="myform" action="#" method="post" name="editbranch">
			<table>
				<tr>
					<td>Branch ID</td>
					<td><input type="text" name="branchID"
						value="<?=$row['branchID']?>"></td>
				</tr>
				<tr>
					<td>Branch Name</td>
					<td><input type="text" name="name" value="<?=$row['name']?>"></td>

				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" value="<?=$row['address']?>">
					</td>

				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" name="city" value="<?=$row['city']?>"></td>

				</tr>
				<tr>
					<td>Stalp</td>
					<td><input type="text" name="stalp" value="<?=$row['stalp']?>"></td>

				</tr>
				<tr>
					<td>Zipcode</td>
					<td><input type="text" name="zip" value="<?=$row['zip']?>"></td>

				</tr>

				<tr>
					<td>Cert</td>
					<td><input type="text" name="cert" value="<?=$row['cert']?>"></td>

				</tr>
				<tr>
					<td>County</td>
					<td><input type="text" name="county" value="<?=$row['county']?>"></td>

				</tr>
				<tr>
					<td>Office Name</td>
					<td><input type="text" name="offname" value="<?=$row['offname']?>">
					</td>

				</tr>
				<tr>
					<td>State</td>
					<td><input type="text" name="stname" value="<?=$row['stname']?>"></td>

				</tr>
				<tr>
					<td>Latitude</td>
					<td><input type="text" name="latitude"
						value="<?=$row['latitude']?>"></td>

				</tr>
				<tr>
					<td>Longitude</td>
					<td><input type="text" name="lngitude"
						value="<?=$row['lngitude']?>"></td>

				</tr>
				<tr>
					<td></td>
					<td><input
						style="background-color: blue; height: 25px; color: #ffffff"
						type="submit" name="submit" value="submit" /> <input
						style="background-color: blue; height: 25px; color: #ffffff"
						name="reset" type="reset" id="reset" value="Reset" /></td>
				</tr>
			</table>
		</form>
	</div>






</body>


</html>

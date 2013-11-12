<!DOCTYPE html>
<html>
<head>
<link
	href="http://code.google.com//apis/maps/documentation/javascript/examples/default.css"
	rel="stylesheet" type="text/css">
<link id="main_stylesheet" rel="stylesheet" href="CSS/style.css"
	type="text/css" />
<script type="text/javascript" src="Javascript/locator.js"></script>
</head>
<body>
<?php
if(!isset($_COOKIE[username])){
	echo "<script language=\"javascript\">location.href='bank_office.php';</script>";
}
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
if(isset($_POST['name'])){
	$sql = "INSERT INTO  `bankinnyc`.`branch`(`branchID` ,`address` ,`city` ,`stalp` ,`zip` ,`name` ,`cert` ,`county` ,`offname` ,`stname` ,`latitude` ,`lngitude`)
	VALUES ('',  '$_POST[address]',  '$_POST[city]', '$_POST[stalp]', '$_POST[zip]',  '$_POST[name]','$_POST[cert]', '$_POST[county]',  '$_POST[offname]' ,  '$_POST[stname]',  '$_POST[latitude]','$_POST[lngitude]'
	);";
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	$get_id = mysql_insert_id();

	$sql1 = "INSERT INTO  `bankinnyc`.`branchlog`(`branchID` ,`address` ,`city` ,`stalp` ,`zip` ,`name` ,`cert` ,`county` ,`offname` ,`stname` ,`latitude` ,`lngitude`)
	VALUES ('$get_id',  '$_POST[address]',  '$_POST[city]', '$_POST[stalp]', '$_POST[zip]',  '$_POST[name]','$_POST[cert]', '$_POST[county]',  '$_POST[offname]' ,  '$_POST[stname]',  '$_POST[latitude]','$_POST[lngitude]'
	);";
	mysql_query($sql1)or die('Query failed: ' . mysql_error());
	echo "<script language=\"javascript\">alert('success');</script>";
}
?>
<?php include 'head_office.php';?>
	<div>
		<form id="insertBranch" action="insert_branch.php" method="post"
			name="searchbranch">
			<table>
				<tr>
					<td>Branch Name</td>
					<td><input type="text" name="name"></td>

				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address">
					</td>

				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" name="city"></td>

				</tr>
				<tr>
					<td>Stalp</td>
					<td><input type="text" name="stalp"></td>

				</tr>
				<tr>
					<td>Zipcode</td>
					<td><input type="text" name="zip"></td>

				</tr>

				<tr>
					<td>Cert</td>
					<td><input type="text" name="cert"></td>

				</tr>
				<tr>
					<td>County</td>
					<td><input type="text" name="county"></td>

				</tr>
				<tr>
					<td>Office Name</td>
					<td><input type="text" name="offname">
					</td>

				</tr>
				<tr>
					<td>State</td>
					<td><input type="text" name="stname"></td>

				</tr>
				<tr>
					<td>Latitude</td>
					<td><input type="text" name="latitude"></td>

				</tr>
				<tr>
					<td>Longitude</td>
					<td><input type="text" name="lngitude"></td>

				</tr>
				<tr>
					<td></td>
					<td><input
						style="background-color: blue; height: 25px; color: #ffffff"
						type="button" name="" value="submit" onclick="CheckBranchSubmit()" />
						<input
						style="background-color: blue; height: 25px; color: #ffffff"
						name="reset" type="reset" id="reset" value="Reset" /></td>
				</tr>
			</table>
		</form>
	</div>






</body>


</html>

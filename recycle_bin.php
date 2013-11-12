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
<?php include 'head_office.php';?>
	<div style="margin: 0 auto; width: 500px">
		<div style="float: left;">
			<img alt="RECYCLE" src="CSS/recyclebin.png">
		</div>
		<div>
			<h1
				style="float: left; margin-top: 50px; margin-left: 0%; color: #191970; text-decoration: none; font-family: Calibri, Arial;">Careful
				when you delete!</h1>
		</div>

	</div>
	<div style="clear: both">
	<?php
	include "mysql.class.php";
	$db = new mysql("localhost","root","","bankinnyc","utf-8");
	if(!isset($_COOKIE[username])){
		echo "<script language=\"javascript\">location.href='bank_office.php';</script>";
	}
	if(isset($_GET[delete])){
		$sql1="delete from recyclebin where branchID='$_GET[branchID]'";
		mysql_query($sql1)or die('Query failed: ' . mysql_error());
		echo "<script language=\"javascript\">alert('success');</script>";
	}
	if(isset($_GET[restore])){
		$restore = "select * from recyclebin where branchID='$_GET[branchID]' ";
		$query2 = mysql_query($restore)or die('Query failed: ' . mysql_error());
		$row1=mysql_fetch_array($query2);
		$sql="INSERT INTO  `bankinnyc`.`branch`(`branchID` ,`address` ,`city` ,`stalp` ,`zip` ,`name` ,`cert` ,`county` ,`offname` ,`stname` ,`latitude` ,`lngitude`)
		VALUES ('$row1[branchID]',  '$row1[address]',  '$row1[city]', '$row1[stalp]', '$row1[zip]',  '$row1[name]',
  		'$row1[cert]', '$row1[county]',  '$row1[offname]' ,  '$row1[stname]',  '$row1[latitude]','$row1[lngitude]');";
		mysql_query($sql)or die('Query failed: ' . mysql_error());
		$sql1="delete from recyclebin where branchID='$_GET[branchID]'";
		mysql_query($sql1)or die('Query failed: ' . mysql_error());
		echo "<script language=\"javascript\">alert('success');</script>";
	}
	$pagesize = 10;

	$sql1 = "select count(*) from recyclebin";
	$query1 = mysql_query($sql1)or die('Query failed: ' . mysql_error());
	$myrow = mysql_fetch_array($query1);
	$numrows = $myrow[0];
	$pages=intval($numrows/$pagesize);
	if($numrows%$pagesize)
	$pages++;
	if(isset($_GET['page'])){
		$page = intval($_GET['page']);
	}
	else{
		$page = 1;
	}
	$offset = $pagesize*($page - 1);

	$sql = "select * from recyclebin order by branchID limit $offset,$pagesize";
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	if($row = mysql_fetch_array($query)){

		?>
		<table>
			<tr>
				<th>BranchID</th>
				<th>Address</th>
				<th>City</th>
				<th>Stalp</th>
				<th>Zip</th>
				<th>Name</th>
				<th>Cert</th>
				<th>County</th>
				<th>Office Name</th>
				<th>State</th>
				<th>Manage</th>
			</tr>
			<?php
			do{


				?>
			<tr>
				<td><?=$row['branchID'] ?></td>
				<td><?=$row['address'] ?></td>
				<td><?=$row['city'] ?></td>
				<td><?=$row['stalp'] ?></td>
				<td><?=$row['zip'] ?></td>
				<td><?=$row['name'] ?></td>
				<td><?=$row['cert'] ?></td>
				<td><?=$row['county'] ?></td>
				<td><?=$row['offname'] ?></td>
				<td><?=$row['stname'] ?></td>
				<td><a
					href="recycle_bin.php? branchID=<?= $row['branchID']?>&restore=1$page=<?=$page?>">RESTORE</a>
					<a
					href="recycle_bin.php? branchID=<?= $row['branchID']?>&delete=1&page=<?=$page?>">DELETE</a>
				</td>
			</tr>
			<?php
			}
			while($row = mysql_fetch_array($query));
	}
	?>
		</table>
		<?php
		echo '<div align="center"style="font-family: Calibri, Arial";>total'.$pages.'page('.$page.'/'.$pages.')';
		for($i = 1;$i<$page;$i++){
			echo '<a href = "recycle_bin.php?page='.$i.'">['.$i.']</a>';
		}
		echo '['.$page.']';
		for ($i=$page+1;$i<=$pages;$i++){
			echo '<a href = "recycle_bin.php?page='.$i.'">['.$i.']</a>';
		}

		?>
	</div>






</body>


</html>

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

		<div style="margin: 0 auto; width: 800px">
		<div style="float: left;">
			<img alt="RECYCLE" src="CSS/branchlog.png">
		</div>
		<div >
			<h3 class="office">This is the edit&insert log!Editing here change the real records!</h3>
			<h3 class="office">Deleting here has no influnce on real records!</h3>
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
		$sql1="delete from branchlog where branchID='$_GET[branchID]'";
		mysql_query($sql1)or die('Query failed: ' . mysql_error());
		echo "<script language=\"javascript\">alert('success');</script>";
	}
	$pagesize = 3;
	$sql1 = "select count(*) from branchlog";
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

	$sql = "select * from branchlog order by branchID  limit $offset,$pagesize";
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
				<td><a href="edit_branch.php? branchID=<?= $row['branchID']?>"
					target="_blank">EDIT</a> <a
					href="branch_log.php? branchID=<?= $row['branchID']?>&delete=1&branchname=<?=$_GET[branchname]?>&page=<?=$page?>">DELETE</a>
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
			echo '<a href = "branch_log.php?page='.$i.'&branchname='.$_GET[branchname].'">['.$i.']</a>';
		}
		echo '['.$page.']';
		for ($i=$page+1;$i<=$pages;$i++){
			echo '<a href = "branch_log.php?page='.$i.'&branchname='.$_GET[branchname].'">['.$i.']</a>';
		}

		?>
	</div>






</body>


</html>

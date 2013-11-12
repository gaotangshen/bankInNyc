<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Bank In NYC</title>
<script	src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=geometry"></script>
<script type="text/javascript" src="Javascript/locator.js"></script>
<link href="http://code.google.com//apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css">
<link id="main_stylesheet" rel="stylesheet" href="css/style.css" type="text/css" /> 
</head>
<body onload="initialize()">
<?php
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
//$sql = "select address from bank where zip = ''";
if(isset($_POST['zipcode'])){
	$zipcode = $_POST[zipcode];
	//echo $zipcode;
	$i = 0;
	$addr="";
	$name = "";
	$website="";
	$sql1 = "select * from zipcodelocation where zipcode ='$_POST[zipcode]' limit 1";
	$query1 = mysql_query($sql1) or die('Query failed: ' . mysql_error());
	$latlng = mysql_fetch_array($query1);
	$ziplat=$latlng['latitude'];
	$ziplng = $latlng['longitude'];

	$sql = "select branch.name,address,city,latitude,lngitude,website,personalchekingLink,
	checkingname,summary,minimumBalance,monthlyServiceCharge,bonus,branch.cert
	from branch,personalchecking as p where zip >('$_POST[zipcode]'-10) and zip < ('$_POST[zipcode]'+10)
	and branch.name = p.bankname and branch.cert = p.cert and FreeOrNot = 1 limit 100"  ;
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	while($row = mysql_fetch_array($query)){
		//echo $i;
		//$website.=$row['website'].'@';
		$name.= $row['name'].'@';
		$addr.= $row['address'].'@';
		$lat.=$row['latitude'].'@';
		$lng.=$row['lngitude'].'@';
		$cert.=$row['cert'].'@';
		$personalcheckingLink.=$row['personalchekingLink'].'@';
		$checkingName.=$row['checkingname'].'@';
		//echo $row['checkingname'];
		//echo $row['personalchekingLink'];
		$summary.=$row['summary'].'@';
		$minimumBalance.=$row['minimumBalance'].'@';
		$bonus.=$row['bonus'].'|';
		echo $row['summary'];
		//	$monServiceCharge.=$row['monServiceCharge'].'@';
		//$benefits.=$row['benefits'].'@';
		//$onlineBanking.=$row['onlineBanking'].'@';
		//echo $row['address'];
		$i++;
		$combine.=$row['address'].','.$row['city'].'@';
	}

	?>


	<script type="text/javascript">
		fu = null;
		function showAdd(ziplat,ziplng,addr,bankname,lat,lng,cert,checkingLink,checkingName,summary,minimumBalance,bonus){
			//alert("1");
			//alert(ziplat);
			clearInterval(fu);
			//var web=website.split('@');
			var zipLat = ziplat;
			var zipLng = ziplng;
			var loc = addr.split('@');
			var bname=bankname.split('@');
			var cert = cert.split('@');
			var checkingLink=checkingLink.split('@');
			var checkingName=checkingName.split('@');
			var summary=summary.split('@');
			var minBalance=minimumBalance.split('@');
			var bon = bonus.split('|');
		/*	var monCharge=monServiceCharge.split('@');
			var benefits=benefits.split('@');
			var onlineBanking=onlineBanking.split('@');
			*/
			//alert(zipLat);
			//alert(bon[i]);
			var lat = lat.split('@');
			var lng = lng.split('@');
			 loclength=loc.length;
			
			for( i=0;i<loclength-1;i++){
				//alert(i);
			codeAddress(zipLat,zipLng,loc[i],bname[i],lat[i],lng[i],cert[i],checkingLink[i],checkingName[i],summary[i],minBalance[i],bon[i]);
			}
			

		}
		fu = setInterval(
				showAdd, 
				1000, 
				"<?=$ziplat?>",
				"<?=$ziplng?>",
				"<?=$combine?>",
				"<?=$name?>",
				"<?=$lat?>",
				"<?=$lng?>",
				"<?=$cert?>",
				"<?=$personalcheckingLink?>",
				"<?=$checkingName?>",
				"<?=$summary?>",
				"<?=$minimumBalance?>",
				"<?=$bonus?>"
				);

	
				
		</script>
		<?php
}
?>
<body>
	<div class="header">
		<div class="navi">
			<a href="home.php">HOME</a> <a href="aboutus.php">ABOUT US</a> <a
				href="contactus.php">CONTACT US</a>
		</div>
	</div>

	<nav class = "header">
		<ul>
			<li><a href="#">Personal Checking</a>
				<ul>
					<li><a href="index.php">Free Checking</a>
					</li>
					<li><a href="notfreepersonal.php">Not Free Checking</a>
					</li>

				</ul>
			</li>
			<li><a href="#">Business Checking</a>
				<ul>
					<li><a href="businesschecking.php">Free Checking</a>
					</li>
					<li><a href="notfreebusiness.php">Not Free Checking</a>
					</li>

				</ul>
			</li>
		</ul>
	</nav>

	<div style="margin-top: 50px; margin-bottom: 50px; margin-left: 150px">
		<label style="font-size: 25px; font-weight: bold; color: #0066FF">Welcome</label>
		<div>

			<form id="myform" action="###" method="post" name="zipsubmit">
				<table>
					<tr>
						<td><input type="text" name="zipcode" value="zipcode"
							onclick="this.value='';"></td>
						<td><input
							style="background-color: blue; height: 25px; color: #ffffff"
							type="button" value="submit" onclick="CheckPost()"></td>
					</tr>
				</table>

			</form>
		</div>
	</div>
	<div style="margin: 0 auto; height: 800px; width: 1000px;">
		<div
			style="float: left; margin-left: auto; margin-right: auto; height: 600px; width: 600px;">
			<div id='map'
				style="float: left; border: 1px solid; margin-left: auto; margin-right: auto; height: 600px; width: 600px;">

				<label style="font-size: 25px; font-weight: bold; color: #0066FF">place
					for map</label>
			</div>
		</div>
		<div
			style="float: right; margin-left: auto; margin-right: auto; height: 600px; width: 400px; background-color: #ffffff">

			<div style="padding-left: 10px">

				<div id="showCurrtxt" name="showCurrtxt"></div>
				<div id="shoePager" name="shoePager"></div>
				<div id='side_bar' name="showDBtxt"
					style="border: 1px dotted #ddd; visibility: hidden; display: none">
				</div>

			</div>
		</div>
	</div>



</body>



</html>

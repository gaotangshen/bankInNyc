<?php
require_once 'header.php';
require_once 'web_header.php';
?>
<body onload="initialize()">
<?php
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
//$sql = "select address from bank where zip = ''";
if(isset($_GET['zipcode'])||isset($_POST['zipcode'])){
	if(isset($_GET['zipcode'])&&isset($_POST['zipcode'])){
		$zipcode = $_POST['zipcode'];
	}else{
		$zipcode = $_GET[zipcode];
	}//echo $zipcode;

	//echo $zipcode;
	$i = 0; 
	$addr="";
	$name = "";
	$website="";
	$sql1 = "select * from zipcodelocation where zipcode ='$zipcode' limit 1";
	$query1 = mysql_query($sql1) or die('Query failed: ' . mysql_error());
	$latlng = mysql_fetch_array($query1);
	$ziplat=$latlng['latitude'];
	$ziplng = $latlng['longitude'];

	$sql = "select branch.name,address,city,latitude,lngitude,website,personalchekingLink,
	checkingname,summary,minimumBalance,monthlyServiceCharge,bonus,branch.cert,zip
	from branch,personalchecking as p where zip >('$zipcode'-10) and zip < ('$zipcode'+10)
	and branch.name = p.bankname and branch.cert = p.cert and FreeOrNot = 0"  ;
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	while($row = mysql_fetch_array($query)){
		//echo $i;

		$website.=$row['website'].'@';
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
		$zip.=$row['zip'].'@';

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
		function showAdd(ziplat,ziplng,addr,bankname,lat,lng,cert,checkingLink,checkingName,summary,minimumBalance,bonus,website,zip){
			//alert(zip);
			//alert(ziplat);
			clearInterval(fu);
			var zipcode=zip.split('@');
			var web=website.split('@');
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
			codeAddress(zipLat,zipLng,loc[i],bname[i],lat[i],lng[i],cert[i],checkingLink[i],checkingName[i],summary[i],minBalance[i],bon[i],web[i],zipcode[i]);
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
				"<?=$bonus?>",
				"<?=$website?>",
				"<?=$zip?>"
				);

	
				
		</script>
		<?php
}
?>
	<div style="margin-left: 13%">
		<label>Welcome</label>
		<div>

			<form id="myform" action="#" method="post" name="zipsubmit">
				<table>
					<tr>
						<td><input type="text" name="zipcode"></td>
						<td><input
							style="background-color: #333333; height: 25px; color: #ffffff"
							type="button" value="zipcode" onclick="CheckPost()"></td>
					</tr>
				</table>

			</form>
		</div>
	</div>
	<div class="map_container">
		<div id='map' class="map">

			<label>place for map</label>
		</div>
		<div class="sidebar_map">
			<a href="free_personal.php?zipcode=<?=$zipcode?>"
				class="button"> <span class="button-left"> <span class="button-text">FREE
				</span> </span> </a> <a
				href="not_free_personal.php?zipcode=<?=$zipcode?>"
				class="button"> <span class="button-left"> <span class="button-text">NOT
						FREE</span> </span> </a>

			<div style="padding-left: 10px">

				<div id="showCurrtxt" name="showCurrtxt" class="showCurrtxt"></div>
				<div id="shoePager" name="shoePager" class="format"></div>
				<div id='side_bar' name="showDBtxt"
					style="border: 1px dotted #ddd; visibility: hidden; display: none">
				</div>

			</div>
		</div>
	</div>
	<?php
	require_once 'footer.php';
	?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Google Maps JavaScript API v3 Example: Geocoding Simple</title>
<link
	href="http://code.google.com//apis/maps/documentation/javascript/examples/default.css"
	rel="stylesheet" type="text/css">
<!--    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">-->
<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script>
      var geocoder;
      var map;
      function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(40.694175,-73.964767);
        var mapOptions = {
          zoom: 10,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
      }
     
      function codeAddress(address) {
         // address="11 Hugh J. Grant Circle,Bronx,NY";
        //var address = document.getElementById('address').value;
        geocoder.geocode( { 'address': address}, function(results, status) {
          
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
            //  alert(address);
           
            bindInfoWindow(marker, map, address);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        }
       // if(i<addressArr.length-1)
         // 	setTimeout("showAddress(" + (i+1) + ")",780);
        );
        
       // bindInfoWindow(marker, map, infoWindow, html);
        
     }
        
 
     function bindInfoWindow(marker, map,address) {
         alert(address);
    	 var infowindow = new google.maps.InfoWindow(
    			 {content:address}
    	    	 );
      google.maps.event.addListener(marker, 'click', function() {

        infowindow.open(map, marker);
       });
    }
    </script>
</head>
<body onload="initialize()">
<?php
include "head.php";
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
//$sql = "select address from bank where zip = ''";
if(isset($_POST['zipcode'])){
	$zipcode = $_POST[zipcode];
	//echo $zipcode;
	$i = 0;
	$addr="";
	$sql = "select address from bank where zip = '$_POST[zipcode]'";
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	while($row = mysql_fetch_array($query)){
		echo $i;
		$addr.= $row['address'].'@';
		//echo $row['address'];
		$i++;
	}
	echo $addr;
	?>


	<script type="text/javascript">
		fu = null;
		function showAdd(addr){
			clearInterval(fu);
			var loc = addr.split('@');
			var loclength=loc.length;
			
			for(var i=0;i<loclength-1;i++){
			codeAddress(loc[i]);
			}
			

		}
		
		fu = setInterval(showAdd, 1000,"<?=$addr ?>");
		</script>
<?php
}
?>



	<div style="margin-top: 50px; margin-left: 150px">
		<label style="font-size: 25px; font-weight: bold; color: #0066FF">Welcome</label>
		<div>

			<form action="#" method="post">
				<input type="text" name="zipcode"> <input type="submit"
					name="search" value="search">
			</form>
		</div>
	</div>






	<div style="margin: 0 auto; height: 800px; width: 1000px">
		<div id='map'
			style="float: left; margin-left: auto; margin-right: auto; height: 800px; width: 600px">

			<label style="font-size: 25px; font-weight: bold; color: #0066FF">place
				for map</label>


		</div>
		<div
			style="float: right; margin-left: auto; margin-right: auto; height: 800px; width: 400px; background-color: #00ff0f">


		</div>
	</div>


	<?php

	?>


</body>



</html>

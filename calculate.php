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
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=geometry"></script>

<script>
var loclength;
var geocoder;
var distance;
//var character = 'A';
var start;

var i;
var side_bar_html = ""; 

//marker.setIcon(pinIcon);
var map;
function initialize() {
	geocoder = new google.maps.Geocoder();
	var mapOptions = {
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
map = new google.maps.Map(document.getElementById('map'),mapOptions);

    	  // Try HTML5 geolocation
if(navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
    	var pos = new google.maps.LatLng(position.coords.latitude,
    	                                       position.coords.longitude);
        start = pos;
			//var pinIcon = new google.maps.MarkerImage(
			//		"https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=|FFFFFF|00000");
    	var marker = new google.maps.Marker({
        map: map,
        icon:'http://maps.google.com/mapfiles/ms/icons/green-dot.png',      
        position: pos      
        });
    	initBindInfoWindow(marker, map);
    	    /* var infowindow = new google.maps.InfoWindow({
    	        map: map,
    	        position: pos,
    	        content: 'You are here.'
    	      });
*/
    	 map.setCenter(pos);
    	 }, function() {
    	 handleNoGeolocation(true);
    	    });
    	  } else {
    	    // Browser doesn't support Geolocation
    	  handleNoGeolocation(false);
    	  }
    	}

function initBindInfoWindow(marker,map){
	    	 var infowindow = new google.maps.InfoWindow(
	    			 {content:"Your Position"}
	    	    	 );
	      google.maps.event.addListener(marker, 'mouseover', function() {

	        infowindow.open(map, marker);
	       });
	       google.maps.event.addListener(marker,'mouseout',function(){
			infowindow.close(map,marker);
		       });
			}
      
function handleNoGeolocation(errorFlag) {
    	  if (errorFlag) {
    	    var content = 'Error: The Geolocation service failed.';
    	  } else {
    	    var content = 'Error: Your browser doesn\'t support geolocation.';
    	  }

    	  var options = {
    	    map: map,
    	    position: new google.maps.LatLng(60, 105),
    	    content: content
    	  };

    	  var infowindow = new google.maps.InfoWindow(options);
    	  map.setCenter(options.position);
    	}
    	//google.maps.event.addDomListener(window, 'load', initialize);
var marker;
var gmarkers = []; 
var endArray = new Array();
var count = 0;
var addArray = new Array();
var webArray = [];
var bankArray = [];
var distArray = new Array();
var end = [];
function codeAddress(address,bankname,website) {
			//alert(address);
        	
        	addArray[i] = address;
        	//alert(addArray[i]);
        	webArray[i] = website;
        	//alert(webArray[i]);
        	bankArray[i] = bankname;

        geocoder.geocode( { 'address': address}, function(results, status) {
        	
          if (status == google.maps.GeocoderStatus.OK) {
              end[i] = results[0].geometry.location;
              
         //  alert(end[i]);
             // alert(start);
            map.setCenter(results[0].geometry.location);
           
           // alert(address);
          	distance = google.maps.geometry.spherical.computeDistanceBetween(start,end[i]);
          	
        
			createMarker(distance);			           
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        }
        );
}
function createMarker(distance){
	
	endArray[count] = end[i];
	distArray[count] = parseFloat((distance/1000).toFixed(1));
	count++;
//alert(loclength);
	     	 if(count == loclength-1){
	for(var j = 0;j<count;j++){
		for(var k = j+1;k<count;k++){
			//alert(count);
					
				if(distArray[j]>distArray[k]){
					
					var temend = endArray[j];
					//alert(temdistance);
					endArray[j] = endArray[k];
					
					endArray[k] = temend;
					
						var temdistance = distArray[j];
						//alert(temdistance);
						distArray[j] = distArray[k];
						
						distArray[k] = temdistance;
						//alert(distArray[0]);
						//alert(distArray[0]);
					//alert(distArray[1]);
					//alert(distArray[2]);
						var tembankname = bankArray[j];
						bankArray[j] = bankArray[k];
						bankArray[k] = tembankname;
						var temwebsite = webArray[j];
						webArray[j] = webArray[k];
						webArray[k] = temwebsite;
						var temaddress = addArray[j];
						addArray[j] = addArray[k];
						addArray[k] = temaddress;
						
					//	alert(bankArray[0]);
						//alert(bankArray[1]);
					}
				//else{break;}
			}
		}
	//alert(distArray[0]);
	var temArray = new Array();
		//var adder = 0;
		//var count1 = 0;
outerloop:
	for(var x = 0;x<count;x++){
	//alert(endArray[x]);
		var image = 'Google Maps Markers/red_Marker'+(x+1)+'.png';
		//alert(end[i]);
		//i --;
	 marker = new google.maps.Marker({
          map: map,
    	  icon:image,      
          position: endArray[x]
      });
	 bindInfoWindow(marker, map, addArray[x],bankArray[x],webArray[x]);
	 gmarkers.push(marker);
	 
	 side_bar_html+='<a style=\"color: #191970; text-decoration: none; font-size: 17px;font-family: Calibri, Arial;\"'; 
		side_bar_html+='href=\"' +webArray[x]+ '\" target=\"_blank\">'+bankArray[x]+'<\/a> <br>';
		side_bar_html+='<img height=\"20px\" alt=\"\"src=\"'+image+'\">';
		side_bar_html+='<a href="javascript:myclick('+(gmarkers.length-1)+')"style="font-size:10px;font-family: Calibri, Arial;"><cite>'+addArray[x]+"("+distArray[x]+"miles)"+ '<\/cite> <\/a><br>';
		side_bar_html+='<hr style="border: 1px dotted #ddd; width: 100% ;" />';
		
		document.getElementById("side_bar").innerHTML =side_bar_html;
		

	

		}	
		
}        
       
}
       // 
       // bindInfoWindow(marker, map, infoWindow, html);
        
     

function myclick(i){
	google.maps.event.trigger(gmarkers[i],"click");	
} 
function bindInfoWindow(marker, map,address,bankname,website) {
         //alert(address);
    	 var infowindow = new google.maps.InfoWindow(
    			 {content:bankname+"<br>"+address+"("+distance+")"+"<br>"+'<a href="'+website+'"target="_blank">'+website+'</a>'}
    	    	 );
    	 
      google.maps.event.addListener(marker, 'click', function() {

        infowindow.open(map, marker);
       });
      google.maps.event.addListener(marker, 'mouseover', function() {

          infowindow.open(map, marker);
         });
      //google.maps.event.addListener(marker,'mouseout',function(){
        //  infowindow.close(map,marker);
          //});
    }

function CheckPost()//check if the zipcode is entered;
	{
		
		if (zipsubmit.zipcode.value=="")
		{
			alert("ZIPCODE");
			zipsubmit.zipcode.focus();
			return false;
		}
		document.forms["myform"].submit();
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
	$name = "";
	$website="";
	$sql = "select name,address,city,website from bank where zip > ('$_POST[zipcode]'-10) and zip < ('$_POST[zipcode]'+10)" ;
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	while($row = mysql_fetch_array($query)){
		//echo $i;
		$website.=$row['website'].'@';
		$name.= $row['name'].'@';
		$addr.= $row['address'].'@';
		//echo $row['address'];
		$i++;
		$combine.=$row['address'].','.$row['city'].'@';
	}

	?>


	<script type="text/javascript">
		fu = null;
		function showAdd(addr,bankname,website){
			
			clearInterval(fu);
			var web=website.split('@');
			var loc = addr.split('@');
			var bname=bankname.split('@');
			 loclength=loc.length;
			
			for( i=0;i<loclength-1;i++){
				//alert(i);
			codeAddress(loc[i],bname[i],web[i]);
			}
			

		}
		
		fu = setInterval(showAdd, 1000,"<?=$combine ?>","<?=$name?>","<?=$website?>");

	
				
		</script>
		<?php
}
?>
	<div style="margin-top: 50px; margin-bottom: 50px; margin-left: 150px">
		<label style="font-size: 25px; font-weight: bold; color: #0066FF">Welcome</label>
		<div>

			<form id="myform" action="###" method="post" name="zipsubmit">
				<input type="text" name="zipcode"> <input
					style="background-color: blue; height: 25px; color: #ffffff"
					type="button" value="submit" onclick="CheckPost()">


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


				<div id='side_bar' style="border: 1px dotted #ddd"></div>

			</div>
		</div>
	</div>


</body>



</html>

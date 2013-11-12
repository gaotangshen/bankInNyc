<!DOCTYPE html>
<html>
<head>
<style>
div.hidden {
	display: none;
}
.format{
color: #191970; 
text-decoration: none; 
font-size: 17px;
font-family: Calibri, Arial;
}

button.show {
	
}

td.sidebar {
	font-size: 13px;
	font-family: Calibri, Arial;
}
</style>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>Bank In NYC</title>
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
var start;

var i;
var side_bar_html = ""; 

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
    	var marker = new google.maps.Marker({
        map: map,
        icon:'http://maps.google.com/mapfiles/ms/icons/green-dot.png',      
        position: pos      
        });
    	initBindInfoWindow(marker, map);
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
var marker;
var gmarkers = []; 
var endArray = new Array();
var count = 0;
var addArray = new Array();
var bankArray = [];
var distArray = new Array();
var latArray = [];
var lngArray=[];
var coord = [];
function codeAddress(address,bankname,lat,lng) {
			latArray[i]= lat;
			lngArray[i]=lng;
        	bankArray[i] = bankname;
        	addArray[i] = address;

            coord[i] = new google.maps.LatLng(latArray[i],lngArray[i]);
            map.setCenter(coord[i]);
           
           // alert(address);
          	distance = google.maps.geometry.spherical.computeDistanceBetween(start,coord[i]);
			createMarker(distance);	
		
			ShowPager(0);
		           

}
function createMarker(distance){
	
	endArray[count] = coord[i];
	distArray[count] = parseFloat((distance/1000).toFixed(1));
	count++;
//alert(loclength);
	     	 if(count == loclength-1){
	for(var j = 0;j<count;j++){
		for(var k = j+1;k<count;k++){
			//alert(count);
					
				if(distArray[j]>distArray[k]){
					
					var temend = endArray[j];
				
					endArray[j] = endArray[k];
					
					endArray[k] = temend;
					
						var temdistance = distArray[j];
				
						distArray[j] = distArray[k];
						
						distArray[k] = temdistance;

						var tembankname = bankArray[j];
						bankArray[j] = bankArray[k];
						bankArray[k] = tembankname;

					}
				//else{break;}
			}
		}
	//alert(distArray[0]);
	var temArray = new Array();
		var adder = 0;
		var count1 = 0;
outerloop:
	for(var x = 0;x<count;x++){
		//var temx = x;
		//alert(temx);
		innerloop:
		for(var y = 0; y<=count1-1;y++){
				if(temArray[y]==bankArray[x]){
					//alert(temArray[y]);
					continue outerloop;
					}
			}
		temArray[count1] = bankArray[x];
	//	alert(temArray[count1]);
		count1++;
	//alert(endArray[x]);
		var image = 'Google Maps Markers/red_Marker'+(adder+1)+'.png';
		//alert(end[i]);
		//i --;
	 marker = new google.maps.Marker({
          map: map,
    	  icon:image,      
          position: endArray[x]
      });
	 bindInfoWindow(marker, map, addArray[x],bankArray[x]);
	 bindInfoWindow1(marker, map, addArray[x],bankArray[x]);
	 gmarkers.push(marker);
	

	 side_bar_html+='<a style=\"color: #191970; text-decoration: none; font-size: 17px;font-family: Calibri, Arial;\"'; 
		side_bar_html+='href=\"\" target=\"_blank\">'+bankArray[x]+'<\/a> <br>';
		side_bar_html+='<img height=\"20px\" alt=\"\"src=\"'+image+'\">';
		side_bar_html+='<a href="javascript:myclick('+(gmarkers.length-1)+')"style="font-size:10px;font-family: Calibri, Arial;"><cite>'+addArray[x]+"("+distArray[x]+"miles)"+ '<\/cite> <\/a><br>';
		//side_bar_html+='<a style="color: #191970; text-decoration: none; font-size: 14px;font-family: Calibri, Arial;" href ="'+cLinkArray[x]+'" target="_blank">'+cNameArray[x]+ '</a><button onclick="detail(\'detail'+x+'show\')";>Show Detail</button><br>';
	//	side_bar_html+='<div id = "detail'+x+'show"; class = "hidden";><table><tr><td class="sidebar">Summary: </td><td class="sidebar">'+summaryArray[x]+ '</td></tr><tr><td class="sidebar">Minimum Balance: </td><td class="sidebar">'+minBanArray[x]+ '</td></tr><tr><td class="sidebar">Monthly Service Charge: </td><td class="sidebar">'+monChArray[x]+ '</td></tr><tr><td class="sidebar">Benefits: </td><td class="sidebar">'+beArray[x]+ '</td></tr></tr><tr><td class="sidebar">Online Banking: </td><td class="sidebar">'+onlineBankArray[x]+ '</td></tr></table> </div>';
		
			side_bar_html+='<hr style="border: 1px dotted #ddd; width: 100% ;" />';
if((adder+1)%8==0){
	side_bar_html+='<p>xyz</p>';
}
		
		document.getElementById("side_bar").innerHTML =side_bar_html;
		adder++;

		
		}	
	}              
}
function detail(id){
	//alert(id);
	//alert("sss");
	
	var e =document.getElementById(id);
	//alert(e.style.display);
	e.style.display = ((e.style.display=='block') ? 'none' : 'block');
	}

/*document.querySelector("button").addEventListener("click", function(){
	
    document.querySelector("div.hidden").style.display = "block";
	document.querySelector("button").addEventListener("click", function(){
		
	    document.querySelector("div.hidden").style.display = "none";
	    
	}); 
});
*/





function myclick(i){
	google.maps.event.trigger(gmarkers[i],"click");	
} 
function bindInfoWindow(marker, map,address,bankname,website) {
         //alert(address);
    	 var infowindow = new google.maps.InfoWindow(
    			 {content:bankname+"<br>"+address+"("+distance+")"+"<br>"+'<a href="'+website+'"target="_blank">'+website+'</a>'}
    	    	 );

      google.maps.event.addListener(marker, 'mouseover', function() {

          infowindow.open(map, marker);
         });
      google.maps.event.addListener(marker,'mouseout',function(){
          infowindow.close(map,marker);
          });
    }
function bindInfoWindow1(marker, map,address,bankname,website) {
    //alert(address);
	 var infowindow = new google.maps.InfoWindow(
			 {content:bankname+"<br>"+address+"("+distance+")"+"<br>"+'<a href="'+website+'"target="_blank">'+website+'</a>'}
	    	 );
	 
	 
     google.maps.event.addListener(marker, 'click', function() {

       infowindow.open(map, marker);
      });
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


function ShowPager(currShowPage){
	//alert(currShowPage);
 var showDBtxt=document.getElementById("side_bar");
 var shoePager=document.getElementById("shoePager");
 var showCurrtxt=document.getElementById("showCurrtxt");
 var showTxts=showDBtxt.innerHTML.split("xyz");//分页
 try{
  currShowPage=parseInt(currShowPage);//当前页
  if(currShowPage<0) currShowPage=0;
  if(currShowPage>=showTxts.length) currShowPage=showTxts.length-1;
 }
 catch(err){
  //err.description
  currShowPage=0
 }
 //显示分页
 if(showTxts.length>1){
  var pagerText="<a  class=\"format\" href='javascript:ShowPager("+(currShowPage-1)+");void(0);'>Previous&nbsp;&nbsp;&nbsp;</a><label class=\"format\" >Now</label>"+(currShowPage+1)+"<label class=\"format\" >&nbsp;&nbsp;&nbsp;Total</label>"+showTxts.length+"<label class=\"format\" >Pages&nbsp;&nbsp;&nbsp;</label><a class=\"format\"  href='javascript:ShowPager("+(currShowPage+1)+");void(0);'>Next</a>";
  shoePager.innerHTML=pagerText;
 }


//显示当前页
 for(var showi=0; showi<showTxts.length;showi++){
  if(showi==currShowPage){
   showCurrtxt.innerHTML=showTxts[showi];
   break;
  }
 }
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
	$sql = "select branch.name,address,city,latitude,lngitude	from branch where zip > ('$_POST[zipcode]'-10) and zip < ('$_POST[zipcode]'+10) limit 300" ;
	$query = mysql_query($sql)or die('Query failed: ' . mysql_error());
	while($row = mysql_fetch_array($query)){
		//echo $i;
		//$website.=$row['website'].'@';
		$name.= $row['name'].'@';
		$addr.= $row['address'].'@';
		$lat.=$row['latitude'].'@';
		$lng.=$row['lngitude'].'@';
		//	$checkingLink.=$row['checkingLink'].'@';
		//	$checkingName.=$row['checkingName'].'@';
		//	$summary.=$row['summary'].'@';
		//	$minimumBalance.=$row['minimumBalance'].'@';
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
		function showAdd(addr,bankname,lat,lng){
			
			clearInterval(fu);
			//var web=website.split('@');
			var loc = addr.split('@');
			var bname=bankname.split('@');
		/*	//var checkingLink=checkingLink.split('@');
		//	var checkingName=checkingName.split('@');
			var summary=summary.split('@');
		//	var minBalance=minimumBalance.split('@');
			var monCharge=monServiceCharge.split('@');
			var benefits=benefits.split('@');
			var onlineBanking=onlineBanking.split('@');
			*/
			var lat = lat.split('@');
			var lng = lng.split('@');
			 loclength=loc.length;
			
			for( i=0;i<loclength-1;i++){
				//alert(i);
			codeAddress(loc[i],bname[i],lat[i],lng[i]);
			}
			

		}
		
		fu = setInterval(showAdd, 1000,"<?=$combine?>","<?=$name?>","<?=$lat?>","<?=$lng?>");

	
				
		</script>
		<?php
}
?>
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

    <div id="showCurrtxt" name="showCurrtxt" ></div>
    <div id="shoePager" name="shoePager" ></div>
    <div id='side_bar' name="showDBtxt" style="border: 1px dotted #ddd;visibility:hidden; display:none">
				</div>

			</div>
		</div>
	</div>



</body>



</html>

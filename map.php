<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Geocoding Simple</title>
    <link href="http://code.google.com//apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css">
<!--    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
      var geocoder;
      var map;
      function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(40.694175,-73.964767);
        var mapOptions = {
          zoom: 13,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
      }
      var infoWindow = new google.maps.InfoWindow;
      function codeAddress(address) {
        //var address = document.getElementById('address').value;
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
            bindInfoWindow(marker, map, infoWindow, address);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
       // bindInfoWindow(marker, map, infoWindow, html);
      }
         
 
     function bindInfoWindow(marker, map, infoWindow, address) {
      google.maps.event.addListener(marker, 'click', function() {
      infoWindow.setContent(address);
        infoWindow.open(map, marker);
       });
    }
    </script>
  </head>
  <body onload="initialize()">
  
	<script type="text/javascript">
	fu = null;
	function showAdd(addr){
		codeAddress('<?=$_GET['baddress']?>');
		clearInterval(fu);
	}
	fu = setInterval(showAdd, 1000);
</script>
<!--    <div>-->
<!--      <input id="address" type="textbox" value="<?=$_GET["baddress"] ?>">-->
<!--      <input type="button" value="Geocode" onclick="codeAddress()">-->
<!--    </div>-->
    <div id="map_canvas" style="height:90%;top:30px"></div>
  </body>
</html>

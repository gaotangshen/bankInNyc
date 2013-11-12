<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=geometry"></script>
<?php
include "mysql.class.php";
$db = new mysql("localhost","root","","bankinnyc","utf-8");
define("MAPS_HOST", "maps.googleapis.com");
//define("KEY", "Write in your key here");


$query = "SELECT * FROM branch order by branchID asc limit 0,1000";
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}

//Initialize delay in geocode speed

$delay=0;
$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/json?address=";

while ($row = @mysql_fetch_assoc($result)) {
  $geocode_pending = true;

  while ($geocode_pending){

    $address = $row["address"].",".$row["city"].",".$row["stalp"];
    $id = $row["branchID"];

   

    $request_url = $base_url . "" . urlencode($address) ."&sensor=false";

    sleep(2);

$json = file_get_contents($request_url);
$json_decoded = json_decode($json);

$status = $json_decoded->status;

 if (strcmp($json_decoded->status, "OK") == 0) {

$geocode_pending = false;

      $lat = $json_decoded->results[0]->geometry->location->lat;
      $lng = $json_decoded->results[0]->geometry->location->lng;

echo 'here';

$query = sprintf("UPDATE branch " .
             " SET lat = '%s', lng = '%s' " .
             " WHERE branchID = '%s' LIMIT 1;",
             mysql_real_escape_string($lat),
             mysql_real_escape_string($lng),
             mysql_real_escape_string($id));
      $update_result = mysql_query($query);

      echo $id;

      if (!$update_result) {
        die("Invalid query: " . mysql_error());
      }
    }

   else {
 // failure to geocode
      $geocode_pending = false;
      echo "Address " . $fullAddress . " failed to geocoded. ";
      echo "Received status " . $status . "\n";
    }

  //  usleep($delay);

}

}

?>
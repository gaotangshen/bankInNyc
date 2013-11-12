<?php 
ob_start();
include_once 'testnew.php'; 
ini_set('max_execution_time', 1000);
$key = "AizbRqXTLVQ464LIWltNDCEVHiW7N5zF_eqGYmh1m4cpxj6OiOGFCJa1nbIfDqbb";
$url = "http://spatial.virtualearth.net/REST/v1/Dataflows/Geocode?description=MyJob&input=xml&output=xml&key=".$key;

// STEP 1 - Create a geocode job

// Get the contents of an XML data file
$myfile = "testll.xml";
$data = file_get_contents($myfile);

// Call custom function to generate an HTTP request and get back an HTTP response
$response = do_post_request($url, $data);

// This function constructs and sends an HTTP request with a provided URL and data, and returns an HTTP response object
// This function uses the php_http extension 
function do_post_request($url, $data, $optional_headers = null) {
  $request = new HttpRequest($url, HttpRequest::METH_POST);
  $request->setBody($data);
  $response = $request->send();
  return $response->getBody();
}

// Convert the response body into an XML element so we can extract data
$responseBody = new SimpleXMLElement($response);


// Get data (such as job id, status description, and job status) from the response
$statusDescription = $responseBody->StatusDescription;
$jobId = $responseBody->ResourceSets->ResourceSet->Resources->DataflowJob->Id;
$jobStatus = $responseBody->ResourceSets->ResourceSet->Resources->DataflowJob->Status;
/*
echo "Job Created:<br>";
echo " Request Status: ".$statusDescription."<br>";
echo " Job ID: ".$jobId."<br>";
echo " Job Status: ".$jobStatus."<br><br>";
*/
    
// STEP 2 - Get the status of geocode job(s)

// Call the API to determine the status of all geocode jobs associated with a Bing Maps key
//echo "Checking status until complete...<br>";
while ($jobStatus != "Completed") {

  // Wait 5 seconds, then check the job¡¯s status
  sleep(5);

  // Construct the URL to check the job status, including the jobId
  $checkUrl = "http://spatial.virtualearth.net/REST/v1/Dataflows/Geocode/".$jobId."?output=xml&key=".$key;
  $checkResponse = file_get_contents($checkUrl);
  $responseBody = new SimpleXMLElement($checkResponse);

  // Get and print the description and current status of the job  
  $jobDesc = $responseBody->ResourceSets->ResourceSet->Resources->DataflowJob->Description;
  $jobStatus = $responseBody->ResourceSets->ResourceSet->Resources->DataflowJob->Status;

 // echo $jobDesc." - ".$jobStatus."<br>";

}

// STEP 3 - Obtain results from a successfully geocoded set of data

//Iterate through the links provided with the first geocode job and extract the 'succeeded' link
$Links = $responseBody->ResourceSets->ResourceSet->Resources->DataflowJob->Link;
foreach ($Links as $Link) {
  if ($Link['name'] == "succeeded") 
  { 
    $successUrl = $Link; 
    break; 
  }
}

// Access the URL for the successful requests, and convert response to an XML element
$successUrl .= "?output=xml&key=".$key;
$successResponse = file_get_contents($successUrl);
$successResponseBody = new SimpleXMLElement($successResponse);

// Loop through the geocoded results and output addresses and lat/long coordinates
foreach ($successResponseBody->GeocodeEntity as $entity) {
	$address=$entity->GeocodeResponse->Address['FormattedAddress'];
 // echo $entity->GeocodeResponse->Address['FormattedAddress'],"<br>";
  	$lat=$entity->GeocodeResponse->InterpolatedLocation['Longitude'];
  	$lng=$entity->GeocodeResponse->InterpolatedLocation['Latitude'];
 //   echo $entity->GeocodeResponse->RooftopLocation['Longitude'].", ";
  //  echo $entity->GeocodeResponse->RooftopLocation['Latitude']."<br>";

  $arr[]=array(
  "$address","$lat","$lng"
  );

}
//var_dump($arr);

exportexcel($arr,array("address","lat","lng"));


?>


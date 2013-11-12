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
		zoom : 10,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map'), mapOptions);

	// Try HTML5 geolocation
	if (navigator.geolocation) {
		navigator.geolocation
				.getCurrentPosition(
						function(position) {
							var pos = new google.maps.LatLng(
									position.coords.latitude,
									position.coords.longitude);
							start = pos;
							var marker = new google.maps.Marker(
									{
										map : map,
										icon : 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
										position : pos
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

function initBindInfoWindow(marker, map) {
	var infowindow = new google.maps.InfoWindow({
		content : "Your Position"
	});
	google.maps.event.addListener(marker, 'mouseover', function() {

		infowindow.open(map, marker);
	});
	google.maps.event.addListener(marker, 'mouseout', function() {
		infowindow.close(map, marker);
	});
}

function handleNoGeolocation(errorFlag) {
	if (errorFlag) {
		var content = 'Error: The Geolocation service failed.';
	} else {
		var content = 'Error: Your browser doesn\'t support geolocation.';
	}

	var options = {
		map : map,
		position : new google.maps.LatLng(60, 105),
		content : content
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
var lngArray = [];
var coord = [];
var certArray = [];
var cLinkArray = [];
var cNameArray = [];
var summaryArray = [];
var minBArray = [];
var bonArray = [];
var zipLatitude;
var zipLongitude;
var ziplocation;
var webArray=[];
var zipArray=[];
function codeAddress(zipLat, zipLng, address, bankname, lat, lng, cert,
		checkingLink, checkingName, summary, minBalance, bon,website,zip) {
	latArray[i] = lat;
	lngArray[i] = lng;
	bankArray[i] = bankname;
	addArray[i] = address;
	certArray[i] = cert;
	cLinkArray[i] = checkingLink;
	cNameArray[i] = checkingName;
	summaryArray[i] = summary;
	minBArray[i] = minBalance;
	bonArray[i] = bon;
	zipLatitude = zipLat;
	zipLongitude = zipLng;
	webArray[i] = website;
	zipArray[i] = zip;
	//alert(checkingName);
	//alert(zipLatitude);
	coord[i] = new google.maps.LatLng(latArray[i], lngArray[i]);
	map.setCenter(coord[i]);
	ziplocation = new google.maps.LatLng(zipLatitude, zipLongitude);
	// alert(address);
	distance = google.maps.geometry.spherical.computeDistanceBetween(
			ziplocation, coord[i]);
	createMarker(distance);
	ShowPager(0);
}
function createMarker(distance) {
	endArray[count] = coord[i];
	distArray[count] = parseFloat((distance / 1000).toFixed(1));
	count++;
	if (count == loclength - 1) {
		for ( var j = 0; j < count; j++) {
			for ( var k = j + 1; k < count; k++) {
				if (distArray[j] > distArray[k]) {
					var temend = endArray[j];
					endArray[j] = endArray[k];
					endArray[k] = temend;
					var temadd = addArray[j];
					addArray[j] = addArray[k];
					addArray[k] = temadd;
					var temdistance = distArray[j];
					distArray[j] = distArray[k];
					distArray[k] = temdistance;
					var tembankname = bankArray[j];
					bankArray[j] = bankArray[k];
					bankArray[k] = tembankname;
					var temCert = certArray[j];
					certArray[j] = certArray[k];
					certArray[k] = temCert;
					var temLink = cLinkArray[j];
					cLinkArray[j] = cLinkArray[k];
					cLinkArray[k] = temLink;
					var temCname = cNameArray[j];
					cNameArray[j] = cNameArray[k];
					cNameArray[k] = temCname;
					var temSummary = summaryArray[j];
					summaryArray[j] = summaryArray[k];
					summaryArray[k] = temSummary;
					var temBalance = minBArray[j];
					minBArray[j] = minBArray[k];
					minBArray[k] = temBalance;
					var tembonus = bonArray[j];
					bonArray[j] = bonArray[k];
					bonArray[k] = tembonus;
					var temweb = webArray[j];
					webArray[j] = webArray[k];
					webArray[k] = temweb;
					var temZip = zipArray[j];
					zipArray[j]=zipArray[k];
					zipArray[k]=temZip;
				}
			}
		}
		var temCertArray = new Array();
		var adder = 0;
		var count1 = 0;
		outerloop: for ( var x = 0; x < count; x++) {
			innerloop: for ( var y = 0; y <= count1 - 1; y++) {
				if (temCertArray[y] == certArray[x]) {
					continue outerloop;
				}
			}
			temCertArray[count1] = certArray[x];
			count1++;
			var image = 'Google Maps Markers/red_Marker' + (adder + 1) + '.png';
			marker = new google.maps.Marker({
				map : map,
				icon : image,
				position : endArray[x]
			});
			bindInfoWindow(marker, map, addArray[x],distArray[x], bankArray[x],webArray[x]);
			bindInfoWindow1(marker, map, addArray[x],distArray[x], bankArray[x],webArray[x]);
			gmarkers.push(marker);

		side_bar_html += '<a ';
			side_bar_html += 'href=\"'+webArray[x]+'\" target=\"_blank\">' + bankArray[x]
					+ '<\/a>&nbsp;<label >('+zipArray[x]+')</label> <br>';
			side_bar_html += '<img height=\"20px\" alt=\"\"src=\"' + image
					+ '\">';
			side_bar_html += '<a href="javascript:myclick('
					+ (gmarkers.length - 1)
					+ ')">'
					+ addArray[x] + "(" + distArray[x] + "miles)"
					+ ' <\/a><br>';
			side_bar_html += '<a  href ="'
					+ cLinkArray[x]
					+ '" target="_blank">'
					+ cNameArray[x]
					+ '</a><button onclick="detail(\'detail'
					+ x
					+ 'show\')";>Show Detail</button><br>';
			side_bar_html += '<div id = "detail'
					+ x
					+ 'show"; class = "hidden_sidebar";><table><tr><td class="sidebar">Summary: </td><td class="sidebar">'
					+ summaryArray[x]
					+ '</td></tr><tr><td class="sidebar">Minimum Balance: </td><td class="sidebar">'
					+ minBArray[x]
					+ '</td></tr><tr><td class="sidebar">Bonus: </td><td class="sidebar">'
					+ bonArray[x] + '</td></tr></table> </div>';

			side_bar_html += '<hr style="border: 1px dotted #ddd; width: 100% ;" />';
			if ((adder + 1) % 6 == 0) {
				side_bar_html += '<label>xyz</label>';
			}
			document.getElementById("side_bar").innerHTML = side_bar_html;
			adder++;
		}
	}
}
function detail(id) {
	var e = document.getElementById(id);
//	alert(e.style.display);
	e.style.display = ((e.style.display == 'block') ? 'none' : 'block');
}
function myclick(i) {
	google.maps.event.trigger(gmarkers[i], "click");
}
function bindInfoWindow(marker, map, address,distance, bankname, website) {
	//alert(address);
	var infowindow = new google.maps.InfoWindow({
		content : bankname + "<br>" + address + "(" + distance + "miles)" + "<br>"
				+ '<a href="' + website + '"target="_blank">' + website
				+ '</a>'
	});

	google.maps.event.addListener(marker, 'mouseover', function() {

		infowindow.open(map, marker);
	});
	google.maps.event.addListener(marker, 'mouseout', function() {
		infowindow.close(map, marker);
	});
}
function bindInfoWindow1(marker, map, address,distance, bankname, website) {
	//alert(address);
	var infowindow = new google.maps.InfoWindow({
		content : bankname + "<br>" + address + "(" + distance + "miles)" + "<br>"
				+ '<a href="' + website + '"target="_blank">' + website
				+ '</a>'
	});

	google.maps.event.addListener(marker, 'click', function() {

		infowindow.open(map, marker);
	});
}

function CheckPost()//check if the zipcode is entered;
{

	if (zipsubmit.zipcode.value == "") {
		alert("ZIPCODE");
		zipsubmit.zipcode.focus();
		return false;
	}
	document.forms["myform"].submit();
}

function ShowPager(currShowPage) {
	//alert(currShowPage);
	var showDBtxt = document.getElementById("side_bar");
	var shoePager = document.getElementById("shoePager");
	var showCurrtxt = document.getElementById("showCurrtxt");
	var showTxts = showDBtxt.innerHTML.split("xyz");//∑÷“≥
	//alert(showTxts);
	try {
		currShowPage = parseInt(currShowPage);//µ±«∞“≥
		if (currShowPage < 0)
			currShowPage = 0;
		if (currShowPage >= showTxts.length)
			currShowPage = showTxts.length - 1;
	} catch (err) {
		//err.description
		currShowPage = 0
	}
	//show current page
	for ( var showi = 0; showi < showTxts.length; showi++) {
		if (showi == currShowPage) {
			if(showTxts[showi] == "</label>"){
				//alert("test");
				return;}
			showCurrtxt.innerHTML = showTxts[showi];
			break;
		}
	}
	//show page infomation
	if (showTxts.length > 1) {
		var pagerText = "<a   href='javascript:ShowPager("
				+ (currShowPage - 1)
				+ ");void(0);'>Previous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>"
				+ "</label><a   href='javascript:ShowPager("
				+ (currShowPage + 1) + ");void(0);'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Next</a>";
		shoePager.innerHTML = pagerText;
	}


}
function CheckBranchSubmit()
{
	if (searchbranch.name.value=="")
	{
		alert("Bank Name");
		searchbranch.name.focus();
		return false;
	}		
	document.forms["insertBranch"].submit();
}
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title> �Ѽ�ǧ����ַ��������ת���� Google Map �ľ�γ���������� </title>
<script src="�ȸ��ͼ.js " type="text/javascript"></script>
<script type="text/javascript">
var addressArr=[];
var map = null;
var geocoder = null;

function initialize() {
if (GBrowserIsCompatible()) {
map = new GMap2(document.getElementById("map_canvas"));
map.setCenter(new GLatLng(39.917, 116.397), 13);
geocoder = new GClientGeocoder();
}
}

function showAddress(i) {
var address=addressArr[i];
if (geocoder) {
geocoder.getLatLng(address,function(point){
if (!point) {
document.getElementById("result").innerHTML=document.getElementById("result").innerHTML+address+" : ���ܽ���<br>";
} else {
map.setCenter(point, 13);
var marker = new GMarker(point);
map.addOverlay(marker);
marker.openInfoWindowHtml(address);
document.getElementById("result").innerHTML=document.getElementById("result").innerHTML+address+" : "+point+"<br>";

}
if(i<addressArr.length-1)
setTimeout("showAddress(" + (i+1) + ")",780); //��������Ƶ��
}
);
}
}
function initAddress(addressStr){
addressArr=addressStr.split("\n");
showAddress(0); 
}
</script>
</head>
<body onload="initialize()" onunload="GUnload()">
��ַ����:(ÿ��һ����ַ)
<br>
<textarea cols="30" rows="5" id="address">
�����к�����
�人��������
���
�����
�Ϻ�</textarea>
<div id="result"></div>
<input type="button" value="check!" onClick="initAddress(document.getElementById('address').value);"/>
</p>
<div id="map_canvas" style="width: 500px; height: 300px"></div>
</body>
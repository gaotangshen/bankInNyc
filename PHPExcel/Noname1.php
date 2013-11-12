<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title> 把几千个地址数据批量转换成 Google Map 的经纬度坐标数据 </title>
<script src="谷歌地图.js " type="text/javascript"></script>
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
document.getElementById("result").innerHTML=document.getElementById("result").innerHTML+address+" : 不能解析<br>";
} else {
map.setCenter(point, 13);
var marker = new GMarker(point);
map.addOverlay(marker);
marker.openInfoWindowHtml(address);
document.getElementById("result").innerHTML=document.getElementById("result").innerHTML+address+" : "+point+"<br>";

}
if(i<addressArr.length-1)
setTimeout("showAddress(" + (i+1) + ")",780); //控制请求频率
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
地址输入:(每行一个地址)
<br>
<textarea cols="30" rows="5" id="address">
北京市海淀区
武汉长江大桥
天津
五道口
上海</textarea>
<div id="result"></div>
<input type="button" value="check!" onClick="initAddress(document.getElementById('address').value);"/>
</p>
<div id="map_canvas" style="width: 500px; height: 300px"></div>
</body>
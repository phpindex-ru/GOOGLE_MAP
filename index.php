<?php
class GoogleMap {
	public $name;
	public $address;
	public $lat;
	public $lng; 
	public $type;

	public function __construct($name, $address, $lat, $lng, $type){
     $this->name = $name;
     $this->address = $address;
     $this->lat = $lat;
     $this->lng = $lng; 
     $this->type = $type;
	}
	
	public function InsertMarker() {
		if (isset($_POST['insert'])) {
			include_once('connection.php');
		$query = $pdo->prepare('INSERT INTO markers (name, address, lat, lng, type) VALUES (?, ?, ?, ?, ?)');
		$query->bindvalue(1, $this->name);
		$query->bindvalue(2, $this->address);
		$query->bindvalue(3, $this->lat);
		$query->bindvalue(4, $this->lng);
		$query->bindvalue(5, $this->type);
		$query->execute();
		echo 'Маркер успешно добавлен в базу данных!';
	}
	}
	}
	
	if (isset($_POST['insert'])) {
	$name = $_POST['name'];
	$address=$_POST['address'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$type=1;
	
	$map = new GoogleMap ($name, $address, $lat, $lng, $type);
	$map->InsertMarker();
	}
	?>



<form action="index.php" method="post" autocomplete="off">
<input type="text" name="name" id="name" placeholder="Название"/><br /><br />
<input type="text" name="address" id="address" placeholder="Адрес"/><br /><br />
<input type="text" name="lat" id="lat" placeholder="lat coordinate"/><br /><br />
<input type="text" name="lng" id="lng" placeholder="long coordinate"/><br /><br />
<div id="latlongmap" style="height:300px; width: 600px; "></div>
<span id="latlngspan" class="coordinatetxt"></span>
<span id="mlat" class="coordinatetxt"></span><br /><br />
 <input type="submit" name="insert" value="Добавить" /><br /><br />
</form> 
</div>
<div id="latlongmap" style="height:450px; width: 450px; "></div>
<span id="latlngspan" class="coordinatetxt"></span>
<span id="mlat" class="coordinatetxt"></span>
</main>
<script type="text/javascript">
function initialize() {
var e = new google.maps.LatLng(48.507064, 44.407905), t = {zoom: 10, center: e, panControl: !0, scrollwheel: !1, scaleControl: !0, overviewMapControl: !0, overviewMapControlOptions: {opened: !0}, mapTypeId: google.maps.MapTypeId.roadmap};
map = new google.maps.Map(document.getElementById("latlongmap"), t), geocoder = new google.maps.Geocoder, marker = new google.maps.Marker({position: e, map: map}), map.streetViewControl = !1, infowindow = new google.maps.InfoWindow({content: "(1.10, 1.10)"}), google.maps.event.addListener(map, "click", function (e) {
marker.setPosition(e.latLng);
var t = e.latLng, o = "(" + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")";
infowindow.setContent(o), document.getElementById("lat").value = t.lat().toFixed(6), document.getElementById("lng").value = t.lng().toFixed(6), document.getElementById("latlngspan").innerHTML = o, document.getElementById("coordinatesurl").value = "http://www.latlong.net/c/?lat=" + t.lat().toFixed(6) + "&long=" + t.lng().toFixed(6), document.getElementById("coordinateslink").innerHTML = '&lt;a href="http://www.latlong.net/c/?lat=' + t.lat().toFixed(6) + "&amp;long=" + t.lng().toFixed(6) + '" target="_blank"&gt;(' + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")&lt;/a&gt;", dec2dms()
}), google.maps.event.addListener(map, "mousemove", function (e) {
var t = e.latLng;
document.getElementById("mlat").innerHTML = "(" + t.lat().toFixed(6) + ", " + t.lng().toFixed(6) + ")"
})
}
function codeAddress(e) {
e.preventDefault && e.preventDefault();
var t = document.getElementById("gadres").value;
return"" === t ? void alert("Address can not be empty!") : void geocoder.geocode({address: t}, function (e, t) {
if (t === google.maps.GeocoderStatus.OK) {
map.setCenter(e[0].geometry.location), document.getElementById("lat").value = e[0].geometry.location.lat().toFixed(6), document.getElementById("lng").value = e[0].geometry.location.lng().toFixed(6);
var o = "(" + e[0].geometry.location.lat().toFixed(6) + ", " + +e[0].geometry.location.lng().toFixed(6) + ")";
document.getElementById("latlngspan").innerHTML = o, document.getElementById("coordinatesurl").value = "http://www.latlong.net/c/?lat=" + e[0].geometry.location.lat().toFixed(6) + "&long=" + e[0].geometry.location.lng().toFixed(6), document.getElementById("coordinateslink").innerHTML = '&lt;a href="http://www.latlong.net/c/?lat=' + e[0].geometry.location.lat().toFixed(6) + "&amp;long=" + e[0].geometry.location.lng().toFixed(6) + '" target="_blank"&gt;(' + e[0].geometry.location.lat().toFixed(6) + ", " + e[0].geometry.location.lng().toFixed(6) + ")&lt;/a&gt;", marker.setPosition(e[0].geometry.location), map.setZoom(16), infowindow.setContent(o), infowindow && infowindow.close(), google.maps.event.addListener(marker, "click", function () {
infowindow.open(map, marker)
}), infowindow.open(map, marker), dec2dms()
} else
alert("Lat and long cannot be found.")
})
}
var latlongform = document.getElementById("latlongform");
latlongform.attachEvent ? latlongform.attachEvent("submit", codeAddress) : latlongform.addEventListener("submit", codeAddress);
var map, geocoder, marker, infowindow;
function dec2dms() {
var e = document.getElementById("lat").value, t = document.getElementById("lng").value;
document.getElementById("dms-lat").innerHTML = getdms(e, !0), document.getElementById("dms-lng").innerHTML = getdms(t, !1)
}
function getdms(e, t) {
var n = 0, m = 0, l = 0, a = "X";
return a = t && 0 > e ? "S" : !t && 0 > e ? "W" : t ? "N" : "E", d = Math.abs(e), n = Math.floor(d), l = 3600 * (d - n), m = Math.floor(l / 60), l = Math.round(1e4 * (l - 60 * m)) / 1e4, n + "&deg; " + m + "' " + l + "'' " + a
}
</script>                                                                           
<script src="https://maps.googleapis.com/maps/api/js?callback=initialize&amp;key=AIzaSyBnpR6gXxxDRnsHbOeTE_d6o2e4vQkAy7s " async defer></script>          
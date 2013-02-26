var latLng = new google.maps.LatLng(
	<?php echo $_GET['lat']; ?>,
	<?php echo $_GET['lon']; ?>);
	
var mapOptions = {
	center : latLng,
	zoom : <?php echo $_GET['zm']; ?>,
	mapTypeId : google.maps.MapTypeId.ROADMAP,
	disableDefaultUI: true, };
	
var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

var photoMarker = new google.maps.Marker({
	position: latLng,
	map: map,
	icon: {url: "http://garethcooper.com/wp-content/themes/garethcooper.com.2012/img/photo.png",
          size: new google.maps.Size(32,37)
          },
	title: "Hi"
});
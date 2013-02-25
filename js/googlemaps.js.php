	var mapOptions = {
		center : new google.maps.LatLng(<?php echo $_GET['lat']; ?>, <?php echo $_GET['lon']; ?>),
		zoom : <?php echo $_GET['zm']; ?>,
		mapTypeId : google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"),
			mapOptions);
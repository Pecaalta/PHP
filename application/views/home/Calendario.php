<div id="mapid" style="width: 600px; height: 400px;"></div>
<script>

	var mymap = L.map('mapid').setView([51.505, -0.09], 13);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		id: 'mapbox.streets'
	}).addTo(mymap);

	L.marker([51.5, -0.09]).addTo(mymap)
		.bindPopup("<a href='asd'><b>Hello world!</b><br />I am a popup.<a>").openPopup();

	var restaurante = null;


	var popup = L.popup();

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("Aqui estaria tu restaurante ")
			.openOn(mymap);
		console.log(e.latlng);
		if(restaurante == null) {
			restaurante = L.marker(e.latlng).addTo(mymap);
		} else {
			restaurante.setLatLng(e.latlng); 
		}
	}

	mymap.on('click', onMapClick);

</script>

</body>
</html>

<style>
		.mb--5{
			margin-bottom: -5px;
		}
.mb-0{
    margin-bottom: 0px;
}
.fs-1rem {
	font-size: 1rem;
}
.carousel{
	border-radius: 4px;
    overflow: hidden;
}
.img {
	border-radius: 7px;
	margin: 15px 5px;
	width: 150px;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}
</style>
<script>
function elementosAjax(data) {
	$.ajax({
		url: '<?php echo base_url(); ?>/home/ajax_elementos',
		type: 'GET',
		dataType: 'html',
		data: data,
		beforeSend: function(e) {
			// animacion de carga
		},
		success: function(e){
			$("#elelementos").html(e);
		},
		error: function(e){
			console.log(e);
		},
		complete: function(e) {
			console.log(e);
		},
	});
}
function mapaAjax(data) {
	$.ajax({
		url: '<?php echo base_url(); ?>/home/ajax_mapa',
		type: 'GET',
		dataType: 'json',
		data: data,
		beforeSend: function(e) {
			// animacion de carga
		},
		success: function(e){
			setMarker(e);
		},
		error: function(e){
			console.log(e);
		},
		complete: function(e) {
			console.log(e);
		},
	});
}
function getdata() {
	return {
		"data" : $("#data").val(),
		"per_page" : $("#per_page").val(),
		"limit" : $("#limit").val(),
		"zona" : $("#zona").val(),
		"categoria" : $("#categoria").val(),
		"minimo" : $("#minimo").val(),
		"maximo" : $("#maximo").val(),
	};
}
$(document).ready(function(){
	$(".filtros").change(function(){
		let data = getdata();
		elementosAjax(data);
		mapaAjax(data);
	});
});
</script>
<div class="container">
	<div class="row">
		<div class="col-12  mt-3">
			<div id="mapid" class="z-depth-1" style="width: 100%; height: 400px;"></div>
		</div>
		<form class="col-md-3 mt-3" action="" id="form" id="form" method="get" >
			<div class="row">
				<h3 class="col-12 mt-3">Configuracion</h3>

				<label class="col-md-12 col-sm-4 mt-3">Limite</label>
				<div class="col-md-12 col-sm-8">
					<select class="filtros form-control" id="limit" require>
						<option value="" >Defecto</option>
						<option value="10" 	<?php if (isset($get["limit"]) && $get["limit"] ==  10 ) echo "selected"; ?> > 10</option>
						<option value="25" 	<?php if (isset($get["limit"]) && $get["limit"] ==  25 ) echo "selected"; ?> > 25</option>
						<option value="50" 	<?php if (isset($get["limit"]) && $get["limit"] ==  50 ) echo "selected"; ?> > 50</option>
						<option value="100"	<?php if (isset($get["limit"]) && $get["limit"] == 100 ) echo "selected"; ?> >100</option>
					</select>
				</div>

				<h3 class="col-md-12 mt-3">Filtros</h3>

				<label class="col-md-12 col-sm-4 mt-3">Precio</label>
				<div class="col-md-6 col-sm-4">
					<input class="filtros form-control" type="text" id="minimo" value="<?php if (isset($get['minimo'])) echo $get['minimo']; ?>" placeholder="Minimo">
				</div>
				<div class="col-md-6 col-sm-4">
					<input class="filtros form-control" type="text" id="maximo" value="<?php if (isset($get['maximo'])) echo $get['maximo']; ?>" placeholder="Maximo">
				</div>

				<label class="col-md-12 col-sm-4 mt-3">Zona</label>
				<div class="col-md-12 col-sm-8">
					<select class="filtros form-control" id="zona" require>
						<option value="" >Todas</option>
						<?php foreach ($zonas as $zona):?>
							<option <?php if (isset($get["zona"]) && $zona['id'] == $get["zona"]) echo "selected"; ?> value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
						<?php endforeach;?>
					</select>
				</div>

				<label class="col-md-12 col-sm-4 mt-3">Categoria</label>
				<div class="col-md-12 col-sm-8">
					<select class="filtros form-control" id="Categoria" require>
						<option value="" selected>Todas</option>
						<?php foreach ($categorias as $zona):?>
							<option <?php if (isset($get["Categoria"]) && $zona['id'] == $get["Categoria"]) echo "selected"; ?> value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
						<?php endforeach;?>
					</select>
				</div>

			</div>
		</form>
		<div id="elelementos" class="col-md-9 mt-3">
			<?php echo $tienda ?>
		</div>
	</div>
</div>
<script>
	var mymap = L.map('mapid').locate({setView: true, maxZoom: 16}).setView([51.505, -0.09], 13);


	L.tileLayer(
		'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', 
		{
			maxZoom: 18,
			id: 'mapbox.streets'
		}
	).addTo(mymap);
	var allMarker = L.layerGroup().addTo(mymap);

	setMarker(<?php if(isset($mapalista) && $mapalista != '' ) echo $mapalista; else echo '[]' ?>);

	function setMarker(tiendas) {
		allMarker.clearLayers();
		tiendas.forEach(e => {		
			L.marker([e.lat, e.lng])
				.addTo(allMarker)
				.bindPopup(
					"<a href='"+e.href+"'>"+
					"	<img onerror='javascript:imgError(this)' class='img' src='"+e.avatar+"'/>"+
					"	<h4 class='text-center font-weight-bold card-title'>"+e.nickname+"</h4>"+
					"</a>"
				)
				.openPopup();
		});
	}
</script>

</body>
</html>
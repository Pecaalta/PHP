
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
.msgNoElement {
	text-align: center;
    width: 100%;
    padding: 50px 0;
    color: #999;
}
.badge {
    height: 2rem;
    padding: .5rem 1rem;
    font-size: 1rem;
	margin: 1rem 0.5rem;
}
.badge .close {
    font-size: 1rem;
    margin: 0 0rem 0 0.75rem;
	cursor: pointer;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-12  mt-3">
			<div id="mapid" class="z-depth-1" style="width: 100%; height: 400px;"></div>

		</div>
		<form class="col-md-3 mt-3" action="" name="form" method="get" >
			<div class="row">
				<h3 class="col-12 mt-3">Configuracion</h3>

				<label class="col-md-12 col-sm-4 mt-3">Limite</label>
				<div class="col-md-12 col-sm-8">
					<select onchange="form.submit()" class="form-control" name="limit" require>
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
					<input onchange="form.submit()" class="form-control" type="text" name="minimo" value="<?php if (isset($get['minimo'])) echo $get['minimo']; ?>" placeholder="Minimo">
				</div>
				<div class="col-md-6 col-sm-4">
					<input onchange="form.submit()" class="form-control" type="text" name="maximo" value="<?php if (isset($get['maximo'])) echo $get['maximo']; ?>" placeholder="Maximo">
				</div>

				<label class="col-md-12 col-sm-4 mt-3">Zona</label>
				<div class="col-md-12 col-sm-8">
					<select onchange="form.submit()" class="form-control" name="zona" require>
						<option value="" >Todas</option>
						<?php foreach ($zonas as $zona):?>
							<option <?php if (isset($get["zona"]) && $zona['id'] == $get["zona"]) echo "selected"; ?> value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
						<?php endforeach;?>
					</select>
				</div>

				<label class="col-md-12 col-sm-4 mt-3">Categoria</label>
				<div class="col-md-12 col-sm-8">
					<select onchange="form.submit()" class="form-control" name="Categoria" require>
						<option value="" selected>Todas</option>
						<?php foreach ($categorias as $zona):?>
							<option <?php if (isset($get["Categoria"]) && $zona['id'] == $get["Categoria"]) echo "selected"; ?> value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
						<?php endforeach;?>
					</select>
				</div>

			</div>
		</form>
		<div class="col-md-9 mt-3">
			<div class="row">
				<div class="col-12 mb-3">
					<?php foreach ($filter as $item):?>
						<div class="badge badge-pill badge-default">
								<?php echo $item['key'] . " = " . $item['value'] ?><i data-id="<?php echo $item['key'] ?>" onclick="bag(this)" class="close fas fa-times"></i>
						</div>
					<?php endforeach;?>
				</div>
			</div>
			<div class="row">
				<?php foreach ($tienda as $item):?>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-5">
						<a href="<?php echo base_url() . $item['href'] ?>">
							<div class="card">
								<img class="card-img-top" src="<?php echo $item['imagen'] ?>" srcset="https://mdbootstrap.com/img/Photos/Others/gradient1.jpg" alt="Card image cap"/>
								<div class="card-body text-center">
									<h4 class="text-center font-weight-bold card-title mb--5"><a><?php echo ($item["nombre"] != '')? $item["nombre"] : 'Sin titulo' ?></a></h4>
									<p class="text-center card-text mb-0"><?php echo $item["nombre_restaurante"] ?></p>
									<span><?php echo "$".$item["precio"] ?></span>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach;?>
				<?php if (sizeof($tienda) == 0):?>
				<div class="msgNoElement">
					<h1 >No hay servicios</h1>
					<h2>Pruebe quitar filtros o verifiquela ortografia</h2>
				</div>
				<?php endif;?>
			</div>
			<div class="row">
				<div class="col-12">
					<nav aria-label="Page navigation example">
						<ul class="pagination pagination-circle pg-blue justify-content-center">
							<?php if (isset($page)) echo $page; ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function bag(e) {
		document.getElementsByName(e.getAttribute('data-id'))[0].value = '';
		form.submit();
	}


	var mymap = L.map('mapid').setView([51.505, -0.09], 13);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		id: 'mapbox.streets'
	}).addTo(mymap);
	let tiendas = <?php if(isset($mapalista) && $mapalista != '' ) echo $mapalista; else echo '[]' ?>;
	console.log(tiendas);
	
	tiendas.forEach(e => {		
		L.marker([e.lat, e.lng]).addTo(mymap)
			.bindPopup(
				e.text
				).openPopup();
		
	});
</script>

</body>
</html>
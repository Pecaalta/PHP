
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
.view {
    height: 400px;
	
    display: flex;
    justify-content: center;
    align-items: center;
    background: #333;
}
.card a{
    height: 200px;
	overflow: hidden;
}
.leaflet-popup-content-wrapper {
	width: 100px!important;
}
</style>
<div class="container">

	<?php if($top != null && sizeof($top) != 0):?>
	<div id="carousel-example-2" class="mt-3 mb-5 z-depth-1 carousel slide carousel-fade" data-ride="carousel">
			<!--Indicators-->
			<ol class="carousel-indicators">
				<?php foreach ($top as $item):?>
					<li data-target="#carousel-example-2" data-slide-to="<?php echo $item['index'] ?>" class="<?php if( isset($item['class'])) echo $item['class'] ?>"></li>
				<?php endforeach;?>
			</ol>
			<!--/.Indicators-->
			<!--Slides-->
			<div class="carousel-inner" role="listbox">
				<?php foreach ($top as $item):?>
					<div class="carousel-item <?php if( isset($item['class'])) echo $item['class'] ?>">
						<div class="view">
							<img onerror="javascript:imgError(this)" class="d-block w-100" src="<?php echo base_url() . $item['imagen'] ?>"
								alt="First slide">
							<div class="mask rgba-black-light"></div>
						</div>
						<div class="carousel-caption">
							<h3 class="h3-responsive"><?php echo ($item["nombre"] != '')? $item["nombre"] : 'Sin titulo' ?></h3>
							<p><?php echo $item["nombre_restaurante"] ?></p>
							<a class="btn btn-primary" href="<?php echo base_url() . $item['href'] ?>">Visitar Tienda</a>
						</div>
					</div>
				<?php endforeach;?>
			</div>
			<!--/.Slides-->
			<!--Controls-->
			<a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			<!--/.Controls-->
		</div>
	
	<?php endif;?>
	<?php echo $tienda ?>

</div>

</body>
</html>
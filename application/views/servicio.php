<div class="container">
	<div class="row mb-5">
		<div class="col-lg-12">
			<div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-2 mb-lg-0 mb-4" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php foreach ($img as $item):?>
						<li data-target="#carousel-example-1z" data-slide-to="<?php echo $item["index"] ?>" class="<?php echo $item["class"] ?>"></li>
					<?php endforeach;?>
				</ol>
				<div class="carousel-inner" role="listbox">
					<?php foreach ($img as $item):?>
						<div class="carousel-item <?php echo $item["class"] ?>">
						<img class="d-block w-100" src="<?php echo $item["img"] ?>"
							alt="<?php echo $item["alt"] ?>">
						</div>
					<?php endforeach;?>	
				</div>
				<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Siguiente</span>
				</a>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="text-center">
				<?php foreach ($tags as $tag):?>
					<a href="#!" class="inline-block green-text">
						<h6 class="font-weight-bold mb-3"><i class="fas fa-utensils pr-2"></i><?php echo $tag ?></h6>
					</a>
				<?php endforeach;?>
			</div>
			<h3 class="font-weight-bold mb-3"><strong>Title of the news</strong></h3>
			<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime
				placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis.</p>
			<p>by <a><strong>Carine Fox</strong></a>, 19/08/2018</p>
		</div>
		<div class="col-12">
		
<div id="full-stars-example-two">
    <div class="rating-group">
        <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" type="radio">
        <label aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
        <label aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
        <label aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
        <label aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
        <label aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
        <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
    </div>
</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
				<img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg" alt="Sample image">
				<a>
				<div class="mask rgba-white-slight"></div>
				</a>
			</div>
		</div>
		<div class="col-md-9">
			<h3 class="font-weight-bold mb-3"><strong>Title of the news</strong></h3>
			<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime
				placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis.</p>
		</div>
	</div>
</div>
</body>
</html>
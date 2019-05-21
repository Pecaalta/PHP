

<div class="container">
	<div class="jumbotron" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">
		<div class="text-white text-center py-5 px-4 my-5">
			<div>
				<h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>As tu reserva !! </strong></h2>
				<div class="md-form">
					<input type="date" class="datepicker">
  				</div>
				<a class="btn btn-outline-white btn-md"><i class="fas fa-clone left"></i> View project</a>
			</div>
		</div>
	</div>
	<div class="row">
		<?php foreach ($tienda as $item):?>
			<div class="col-xs-12 col-sm-6 col-md-4 mb-5">
				<div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
					<img class="img-fluid" src="<?php echo $item["imagen"] ?>" alt="Sample image">
					<a>
					<div class="mask rgba-white-slight"></div>
					</a>
				</div>
				<div class="text-center">
					<?php foreach ($item["tags"] as $tag):?>
						<a href="#!" class="inline-block green-text">
							<h6 class="font-weight-bold mb-3"><i class="fas fa-utensils pr-2"></i><?php echo $tag ?></h6>
						</a>
					<?php endforeach;?>
				</div>
				<h3 class="text-center font-weight-bold mb-3"><strong><?php echo $item["nombre"] ?></strong></h3>
				<a class="btn btn-success btn-md margin-auto">Read more</a>
			</div>
		<?php endforeach;?>
	</div>
	<div class="row">
		<div class="col-12">
			<nav aria-label="Page navigation example">
				<ul class="pagination pagination-circle pg-blue justify-content-center">
					<li class="page-item disabled"><a class="page-link">First</a></li>
					<li class="page-item disabled">
					<a class="page-link" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Previous</span>
					</a>
					</li>
					<li class="page-item active"><a class="page-link">1</a></li>
					<li class="page-item"><a class="page-link">2</a></li>
					<li class="page-item"><a class="page-link">3</a></li>
					<li class="page-item"><a class="page-link">4</a></li>
					<li class="page-item"><a class="page-link">5</a></li>
					<li class="page-item">
					<a class="page-link" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
						<span class="sr-only">Next</span>
					</a>
					</li>
					<li class="page-item"><a class="page-link">Last</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>

</body>
</html>
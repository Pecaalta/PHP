<style>
    body{
        background: url("http://backgrounddownload.com/wp-content/uploads/2018/09/food-wallpaper-background-8.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        margin-top: 15px;
    }
    .carousel-inner img {
      width: 100%;
      height: 100%;
  }
</style>

<div class="container contenedor">
  <h1 class="display-4"><?php echo $user["nickname"]?></h1>
  <br>
  <!-- Nav pills -->
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#home">Descripción</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu1">Imágenes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu2">Servicios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu3">Reserva</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <p>Descripcion, vamos a tener que agregar otro campo</p>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <div class="container">

        <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Galería de imágenes</h1>

        <hr class="mt-2 mb-5">

        <div class="row text-center text-lg-left">

            <div class="col-lg-3 col-md-4 col-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
                </a>
            </div>
        </div>

        </div>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Nuestras comidas disponibles:</h3>
      <ul>
        <?php foreach($servicio as $item):?>
          <li><?php echo $item ?></li>
        <?php endforeach;?>
      </ul>
    </div>
    <div id="menu3" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>

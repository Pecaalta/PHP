<style>
    body{
        background: url("http://backgrounddownload.com/wp-content/uploads/2018/09/food-wallpaper-background-8.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        margin-top: 15px;
    }
    .servicios{
        padding: 10px;
    }
    .ancho{
        width: 70%;
    }
</style>

<div class="container contenedor text-center">
  <h1 class="display-4"><?php echo $user["nickname"]?></h1>
  <br>
  <!-- Nav pills -->
  <div class="center-block d-flex align-items-center justify-content-center">
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
  </div>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active text-center servicios"><br>
      <p><strong><?php echo $user["descripcionRestaurante"] ?></strong></p>
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
    <div id="menu2" class="container tab-pane fade ancho"><br>
      <h3>Nuestras comidas disponibles:</h3>
      <div class="accordion md-accordion servicios" id="accordionEx" role="tablist" aria-multiselectable="true">
        <?php foreach($servicio->result() as $item):?>
            <div class="card">

                <div class="card-header" role="tab" id="headingOne1">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?php echo $item->id ?>" aria-expanded="true" aria-controls="collapseOne1">
                        <h5 class="mb-0"><?php echo $item->nombre; ?> <i class="fas fa-angle-down rotate-icon"></i></h5>
                    </a>
                </div>

                <div id="collapseOne<?php echo $item->id ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="md-v-line"></div><i class="fas fa-info mr-4 pr-3"></i>
                                <?php echo $item->descripcion; ?>
                            </li>
                            <li class="list-group-item">
                                <div class="md-v-line"></div><i class="fas fa-dollar-sign mr-4 pr-3"></i>
                                <?php echo $item->precio; ?>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        <?php endforeach;?>
      </div>
    </div>
    <div id="menu3" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>

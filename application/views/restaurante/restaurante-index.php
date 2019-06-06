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
    #block_container {
        display: flex;
        justify-content: center;
    }
    #bloc1, #bloc2 {
        display:inline;
    }
    li{
        list-style: none;
    }
</style>

<div class="container contenedor text-center  z-depth-1">
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
            <?php if($item->is_active):?>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne1">
                        <a href="<?php echo base_url().'restaurante/info_servicio/'. $item->id; ?>" aria-expanded="true" aria-controls="collapseOne1">
                            <li><?php echo $item->nombre . ' '; ?><i class="fas fa-angle-down rotate-icon"></i></li>
                        </a>
                    </div>
                </div>
            <?php endif;?>
        <?php endforeach;?>
      </div>
    </div>
    <div id="menu3" class="container tab-pane fade"><br>
      <h3>Haz tu reserva en este restaurante</h3>
      <a href="<?php echo base_url().'reserva/realizarReserva/'.$id; ?>">Realizar reserva</a>
    </div>
  </div>
</div>

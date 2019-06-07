<style>
    body{
        background: url("https://images.alphacoders.com/289/289223.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        padding: 20px;
        padding-top: 170px;
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
    .carousel-item {
        height: 300px;
    }
    .carousel-item .view{
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;

    }
    .carousel-item .view img{
        width: 100%;
        height: auto;
    }
    .mask-blanco{
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 100;
        background: rgba(255,255,255,0.7);
        background: -moz-linear-gradient(top, rgba(255,255,255,0.7) 0%, rgba(255,255,255,1) 94%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,0.7)), color-stop(57%, rgba(255,255,255,0.96)), color-stop(88%, rgba(255,255,255,1)), color-stop(94%, rgba(255,255,255,1)));
        background: -webkit-linear-gradient(top, rgba(255,255,255,0.7) 0%, rgba(255,255,255,1) 94%);
        background: -o-linear-gradient(top, rgba(255,255,255,0.7) 0%, rgba(255,255,255,1) 94%);
        background: -ms-linear-gradient(top, rgba(255,255,255,0.7) 0%, rgba(255,255,255,1) 94%);
        background: linear-gradient(to bottom, rgba(255,255,255,0.7) 0%, rgba(255,255,255,1) 94%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff', GradientType=0 );

    }
    .z-index-1 {
        z-index: 1;
    }
    #carousel-example-2 {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        width: 100%;
    }

    .border-radius-3px {
        border-radius: 3px;
    }
    .logo-restaurante {
        border-radius: 50%;
        width: 300px;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        margin: 50px auto -150px;
        background: #fff;
        overflow: hidden;
    }
    .logo-restaurante img {
        min-height: 100%;
    }
    .descripcion {
        color: #666;
    }
    .costo {
        font-size: 1.5rem;
        color: rgb(33, 150, 243);;
        font-weight: 900;
    }
</style>
	<div id="carousel-example-2" class="z-index-1 carousel slide carousel-fade" data-ride="carousel">
        <div class="mask-blanco"></div>
		<!--Indicators-->
		<ol class="carousel-indicators">
			<?php foreach ($carusel as $item):?>
				<li data-target="#carousel-example-2" data-slide-to="<?php echo $item['index'] ?>" class="<?php if( isset($item['class'])) echo $item['class'] ?>"></li>
			<?php endforeach;?>
		</ol>
		<!--/.Indicators-->
		<!--Slides-->
		<div class="carousel-inner" role="listbox">
			<?php foreach ($carusel as $item):?>
				<div class="carousel-item <?php if( isset($item['class'])) echo $item['class'] ?>">
					<div class="view">
						<img class="d-block " src="<?php echo base_url() . $item['img'] ?>"
							alt="First slide">
					</div>
				</div>
			<?php endforeach;?>
		</div>

	</div>


    <div class="logo-restaurante z-depth-1">
        <img  src="<?php echo base_url() . $user['avatar'] ?>" alt="">

    </div>

<div class="container contenedor text-center  z-depth-1">
  <h1><?php echo $user["nickname"]?></h1>
  <p class="descripcion"><?php echo $user["descripcionRestaurante"] ?></p>
  <br>
  <!-- Nav pills -->
  <div class="center-block d-flex align-items-center justify-content-center">
    <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item ">
            <a class="nav-link active" data-toggle="pill" href="#menu1">Imágenes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#menu2">Servicios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#menu3">Reserva</a>
        </li>
    </ul>
  </div>

  <!-- CONFIGURACION LINKS -->
  <?php

       $this->load->helper('url');
       $currentURL = current_url();
  //     $url=$currentURL;

     $url=urlencode('http://www.facebook.com/pages/Dressfinity-LLC/208406062583392 ');
   ?>

  <!-- FACEBOOK -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3"></script>
  <div class="fb-share-button" data-href="<?php echo $url ?>"
  data-layout="button" data-size="large"><a target="_blank"
  href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
  class="fb-xfbml-parse-ignore">Compartir</a></div>

  <!-- TWITTER -->
  <a href="<?php echo $url ?>" class="twitter-share-button" data-size="large" data-lang="es" data-show-count="false">Tweet</a>
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="menu1" class="container tab-pane active">
        <div class="row text-center text-lg-left">
            <?php foreach($img as $item):?>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="#" class="d-block mb-4 h-100">
                        <img class="img-fluid z-depth-1 border-radius-3px" src="<?php echo base_url() . $item['img']; ?>" alt="">
                    </a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <div id="menu2" class="container tab-pane fade">
        <h3>Nuestras comidas disponibles:</h3>
        <div class="row">
            <?php foreach($servicio->result() as $item):?>
                <?php if($item->is_active):?>
                    <div class=" col-sm-6 col-md-4">
                        <div class="card">
                            <div class="view overlay">
                                <img class="card-img-top" src="<?php echo base_url() . $item->imagen; ?>" alt="Card image cap">
                                <a href="#!">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $item->nombre; ?> </h4>
                                <p class="card-text"><?php echo $item->text_corto; ?></p>
                                <span class="costo">$<?php echo $item->precio; ?></span>

                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url().'restaurante/info_servicio/'.$item->id ?>" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
        </div>
    </div>
    <div id="menu3" class="container tab-pane fade"><br>
      <h3>Haz tu reserva en este restaurante</h3>
      <a href="<?php echo base_url().'reserva/realizarReserva/'.$user['id']; ?>">Realizar reserva</a>
    </div>
  </div>
</div>

<style>
    body{
        background: <?php echo sizeof($carusel) == 0 ? "url('https://images.alphacoders.com/289/289223.jpg')" : '#fff' ?>;

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
        height: 100%;
    }
    .descripcion {
        color: #666;
    }
    .costo {
        font-size: 1.5rem;
        color: rgb(33, 150, 243);;
        font-weight: 900;
    }
    .msgNoElement {
        text-align: center;
        padding: 20px;
        max-width: 800px;
        margin: auto;
        display: block;
    }
    .msgNoElement img {
        opacity: 0.2;
    }
    .p-15 {
        padding: 15px;
    }
    
    .card {
        overflow: hidden;
    } 
    
    .card .view{
        overflow: hidden;
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;

    }
    .card .view img{
        width: 100%;
        height: auto;
    }
    .card-image {
        overflow: hidden;
        height: 150px;
        max-height: 10vw;
    }
    
    .card-text {
        height: 50px;
    }

    .card h4 {
        margin-bottom: 0!important;
    }
    .modal-content {
        padding: 0!important;
    }

    #compartir{
        font-size: 2em;
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
						<img onerror="javascript:imgError(this)"  class="d-block " src="<?php echo base_url() . $item['img'] ?>"
							alt="First slide">
					</div>
				</div>
			<?php endforeach;?>
		</div>

	</div>


    <div class="logo-restaurante z-depth-1">
        <img  
        data-toggle="modal" data-target="#imgModal" 
        onclick="imgaengrande.src = '<?php echo base_url() . $user['avatar']; ?>'"
        onerror="javascript:imgError(this)" src="<?php echo base_url() . $user['avatar'] ?>" alt="">

    </div>

<div class="container contenedor text-center  z-depth-1">
<a id="compartir" href=<?php echo 'https://www.facebook.com/sharer/sharer.php?u=http%3A//127.0.0.1/PHP/PHP/Restaurante/principal/' . $user['id'] ?> target="_blank"><i class="fab fa-facebook-square"></i></a>
  <h1><?php echo $user["nickname"]?></h1>
  <p class="descripcion"><?php echo $user["descripcionRestaurante"] ?></p>
  <br>
  <!-- Nav pills -->
  <div class="center-block d-flex align-items-center justify-content-center">
    <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item ">
            <a class="nav-link btn btn-primary active" data-toggle="pill" href="#menu1">Imágenes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-primary" data-toggle="pill" href="#menu2">Servicios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-primary" data-toggle="pill" href="#menu3">Reserva</a>
        </li>
    </ul>
  </div>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="menu1" class="container tab-pane active">
        <?php if (sizeof($img) == 0):?>
            <div class="row">
                <div class="msgNoElement">
                    <h3>Parese que no hay imagenes</h3>
                    <img src="<?php echo base_url()?>/public/img/cesta_vacia.png" alt="" srcset="">
                </div>
            </div>
        <?php endif;?>
        <?php if (sizeof($img) != 0):?>
            <div class="row text-center text-lg-left">
                <?php foreach($img as $item):?>
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img 
                            data-toggle="modal" data-target="#imgModal" 
                            onclick="imgaengrande.src = '<?php echo base_url() . $item['img']; ?>'"
                            onerror="javascript:imgError(this)" class="img-fluid z-depth-1 border-radius-3px" src="<?php echo base_url() . $item['img']; ?>" alt="">
                        </a>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
    <div id="menu2" class="container tab-pane fade">
        <?php if (sizeof($servicio->result()) == 0):?>
            <div class="row">
                <div class="msgNoElement">
                    <h3 >Parese que no tiene ningun Servicio aun </h3>
                    <img src="<?php echo base_url()?>/public/img/ambre.png" alt="" srcset="">
                </div>
            </div>
        <?php endif;?>
        <?php if (sizeof($servicio->result()) != 0):?>
        <h3>Nuestras comidas disponibles:</h3>
            <div class="row">
                <?php foreach($servicio->result() as $item):?>
                    <?php if($item->is_active):?>
                        <div class=" col-sm-6 col-md-4">
                            <div class="card mb-4">
                                <div class="card-image">
                                    <img 
                                        data-toggle="modal" data-target="#imgModal" 
                                        onclick="imgaengrande.src = '<?php echo base_url() .  $item->imagen; ?>'"
                                        onerror="javascript:imgError(this)" 
                                        class="card-img-top" src="<?php echo base_url() . $item->imagen; ?>" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo isset($item->nombre) && $item->nombre != '' ? $item->nombre : 'Sin titulo'; ?> </h4>
                                    <p class="card-text"><?php echo isset($item->text_corto) && $item->text_corto != '' ? $item->text_corto : 'Sin descripcion'; ?></p>
                                    <span class="costo"><?php echo isset($item->precio) && $item->precio != '' ? '$'.$item->precio : 'sin precio'; ?></span>
                                </div>
                                <div class="card-footer">
                                    <a href="<?php echo base_url().'servicio/info_servicio/'.$item->id ?>" class="btn btn-primary">Ver</a>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
    <div id="menu3" class="container tab-pane fade p-15"><br>
      <h3>Haz tu reserva en este restaurante</h3>
      <a href="<?php echo base_url().'reserva/realizarReserva/'.$user['id']; ?>">Realizar reserva</a>
    </div>
  </div>
</div>

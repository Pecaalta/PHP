<style>
    body{
        background: url("https://www.aquateknica.com/wp-content/uploads/2018/02/color-alimentos-1024x576.jpg");
        background-size: cover;
    }


    #precio{
        color: #008aff;
        font-weight: 900;
        font-size: 3em;
        line-height: 1.4em;
    }
    #precio::before{   
        content: '$';
    }
    .descripcion {
        font-weight: 300;
        line-height: 1.5em;
        color: #3C4858;
    }
    .p-0 {
        padding: 0;
    }
    .p-15 {
        padding: 20px;
    }
    .added-text {
        color: #666;
    }

    .titule {
        font-size: 2rem;
        color: #3C4858;
        margin-bottom: 0;
    }

    .name {
        display: block!important;
        margin-bottom: -10px;
    }

    .star * {   font-size: 0.5rem; }
    .star .active {   color: #ffa000; }
    .star .inactive { color: #eee; }

    .star[date-satar="5"] .active::before   { content: '\f005 \f005 \f005 \f005 \f005'; }

    .star[date-satar="4"] .active::before   { content: '\f005 \f005 \f005 \f005'; }
    .star[date-satar="4"] .inactive::before { content: '\f005'; }

    .star[date-satar="3"] .active::before   { content: '\f005 \f005 \f005'; }
    .star[date-satar="3"] .inactive::before { content: '\f005 \f005'; }

    .star[date-satar="2"] .active::before   { content: '\f005 \f005'; }
    .star[date-satar="2"] .inactive::before { content: '\f005 \f005 \f005'; }

    .star[date-satar="1"] .active::before   { content: '\f005'; }
    .star[date-satar="1"] .inactive::before { content: '\f005 \f005 \f005 \f005'; }

    .star[date-satar="0"] .inactive::before { content: '\f005 \f005 \f005 \f005 \f005'; }

    .mdb-feed .news .label { 
        display: inline-block;
        float: left;
        margin: 0px 20px 0 0;
    }
    .mdb-feed .news .label img { height: 5rem;width: 5rem; }

    .news {
        border-top: solid 1px rgba(0, 0, 0, .16);
        padding: 15px;
        margin: 15px;
    }
    .avatar {
    }
    @media only screen and (max-width: 990px) {
        .body-servicio {
            text-align: center
        }
    }

    .msjNoComentarios {
        text-align: center;
        color: #666
    }
</style>

<div class="container">
    <!--<a href="<?php echo base_url().'restaurante/principal/'. $id;?>">
    <button mat-button>Volver a Servicios</button>
    </a>-->


    <div class="col-12 mt-4 mb-4 card p-0 z-depth-1">
        <?php foreach($servicio as $item):?>
            <div class="row p-15">
                <div class="col-lg-5 col-xl-4">
                    <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                        <img 
                            data-toggle="modal" data-target="#imgModal" 
                            onerror="javascript:imgError(this)" 
                            onclick="imgaengrande.src = <?php echo base_url( '/uploads/servicios/' . $item->imagen ); ?>"
                            class="img-fluid" 
                            src="<?php echo base_url( '/uploads/servicios/' . $item->imagen ); ?>">
                            
                        <a><div class="mask rgba-white-slight"></div></a>
                    </div>
                </div>
                <div class="body-servicio col-lg-7 col-xl-8">
                    <a class="font-weight-bold text-muted" href="<?php echo base_url('Restaurante/principal/'.$item->IdAutor); ?>"><?php echo isset($item->autor) && $item->autor != null ? 'Visita '. $item->autor : 'Sin autor'; ?></a>
                    <h3 class="font-weight-bold titule"><strong><?php echo isset($item->nombre) && $item->nombre != null ? $item->nombre : 'Sin titulo'; ?></strong></h3>
                    <h5 id="precio"><?php echo " " .  $item->precio;?></h5>
                    <p class="dark-grey-text descripcion"><?php echo isset($item->descripcion) && $item->descripcion != null ? $item->descripcion : 'Sin descripcion'; ?></p>
                </div>
            </div>
        <?php endforeach;?>
    </div>

    <div class="col-12 mt-4 mb-4 p-15 card z-depth-1">
        <div class="row mdb-feed">
            <div class="col-12 text-center">
                <h3>Comentarios</h3>
            </div>
            <?php if(count($comentarios) > 0):?>
                <?php foreach($comentarios as $item):?>
                        <div class="col-12">    
                            <div class="news">
                                <div class="label">
                                    <img onerror="javascript:imgError(this)" src="<?php echo base_url() . '/uploads/servicios/' . $item['avatar']; ?>"  class="rounded-circle z-depth-1-half">
                                </div>
                                <div class="excerpt mb-0">
                                    <div class="brief">
                                        <a class="name"><?php echo $item['nickname'] ?></a>
                                        <span class="star" date-satar="<?php echo isset($item['calificacion']) || $item['calificacion'] != '' ? $item['calificacion'] : '0'; ?>">
                                            <span class="active fas"></span>
                                            <span class="inactive fas"></span>
                                        </span>
                                    </div>
                                    <div class="added-text"><?php echo $item['texto'] ?></div>
                                </div>
                            </div>
                        </div>
                <?php endforeach;?>
            <?php endif;?>
            <?php if(count($comentarios) <= 0):?>
                <div class="col-12 msjNoComentarios">
                    <p>Aún no hay comentarios sobre este servicio!</p>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>




     
                            
                            
                              
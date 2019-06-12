<style>
    body{
        background: url("https://www.aquateknica.com/wp-content/uploads/2018/02/color-alimentos-1024x576.jpg");
        background-size: cover;
    }

    h5{
        font-weight: bold;
    }

    .container img{
        border-radius: 4px;
        margin-right: 20px;
    }

    #div1{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    #div2{
        width: 50%;
        margin-top: 0px;
    }

    li{
        list-style: none;
    }

    .container{
        background-color:  #ebecf0;
        border-radius: 3px;
        padding: 5px 15px 15px 20px;
        
        margin-top: 20px;
        width: 40%;
    }

    h5{
        text-align: center;
        font-size: 2em;
    }

    #precio{
        font-size: 3.5em;
        font-weight: bold;
        text-align: center;
    }

    .comentario{
        border-radius: 6px;
        background-color: rgb(212, 218, 224);
        text-align: left;
    }
</style>

    <div class="container">
        <!--<a href="<?php echo base_url().'restaurante/principal/'. $id;?>">
        <button mat-button>Volver a Servicios</button>
        </a>-->
        <?php foreach($servicio as $item):?>
            <div>
                <br><br>
                <div id="div1">
                        <div>
                        <img class="img-fluid" src="<?php echo base_url() . '/uploads/servicios/' . $item->imagen; ?>" height="300" width="220"  alt="avatar image">
                    </div>
                    <div id="div2">
                    <h5><?php echo $item->nombre; ?></i></h5>
                    <hr>
                        
                            <li id="precio">
                                <i class="fas fa-dollar-sign mr-4 pr-3"><?php echo " " .  $item->precio;?></i>                            
                            </li>
                            <hr>
                            <li>
                                
                                <i class="fas fa-info mr-4 pr-3"></i>
                                <?php echo $item->descripcion; ?>
                            </li>
                        
                    </div>
                </div>
            </div>   
        <?php endforeach;?>
        <div>
            <h3>Comentarios</h3>
            <?php if(count($comentarios) > 0):?>
                <?php foreach($comentarios as $item):?>
                    <div class="comentario">
                        <p><b>Usuario</b> <?php echo $item['nickname'] ?></p>
                        <p><?php echo $item['texto'] ?></p>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
            <?php if(count($comentarios) <= 0):?>
                    <p>Aún no hay comentarios sobre este servicio!</p>
            <?php endif;?>
        </div>
    </div>




     
                            
                            
                              